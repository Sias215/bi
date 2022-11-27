<?php
namespace App\Service;


use Com\Alibaba\Otter\Canal\Protocol\EntryType;
use Com\Alibaba\Otter\Canal\Protocol\EventType;
use Com\Alibaba\Otter\Canal\Protocol\RowChange;
use Illuminate\Support\Facades\DB;

class TestService{

    protected $defaultValue = [];
    public function getSql($entry)
    {
        switch ($entry->getEntryType()) {
            case EntryType::TRANSACTIONBEGIN:
            case EntryType::TRANSACTIONEND:
                return;
                break;
        }
        $rowChange = new RowChange();
        $rowChange->mergeFromString($entry->getStoreValue());
        $evenType = $rowChange->getEventType();
        $header = $entry->getHeader();
        foreach ($rowChange->getRowDatas() as $rowData) {
            switch ($evenType) {
                case EventType::DELETE:
                    $this->delete($rowData, $header);
                    break;
                case EventType::INSERT:
                    $this->insert($rowData, $header);
                    break;
                default:
                    $this->update($rowData, $header);
                    break;
            }
        }
    }

    private function insert($rowData, $header)
    {
        $name = '(';
        $value = '(';
        foreach ($rowData->getAfterColumns() as $column){
            $name .= '`'.$column->getName().'`,';
            $v = $column->getValue();

            if(empty($v) && strlen($v) <= 0){
                $v = 'NULL' ;
                $k = $header->getTableName().'.'.$column->getName();
                if(in_array($k, $this->defaultValue['defaultEmpty'])){
                    $v = '\'\'';
                }
                $value .= $v.',';
            }else{
                $value .= '\''.$v.'\',';
            }
        }
        $name = substr($name, 0, strlen($name)-1);
        $value = substr($value, 0, strlen($value)-1);
        $name .= ')';
        $value .= ')';
        $sql = "INSERT INTO ".  $header->getTableName() .$name."VALUES ". $value.PHP_EOL;
        $this->log($header->getTableName(),1, $sql, date('Y-m-d H:i:s', time()));
    }

    private function update($rowData, $header)
    {
        $value = '';
        $where = '';
        foreach ($rowData->getAfterColumns() as $column){
            $where .= $this->getWhere($column, $header);
            if($column->getUpdated()){
                $value .= '`'. $column->getName().'` = \''. $column->getValue(). '\' ,';
            }
        }
        $value = substr($value, 0, strlen($value) - 1);
        $sql = "UPDATE ".  $header->getTableName() ." SET ". $value. ' WHERE ' . $where. PHP_EOL;
        $this->log($header->getTableName(),1, $sql, date('Y-m-d H:i:s', time()));
    }

    private function delete($rowData, $header)
    {
        $where = '';
        foreach ($rowData->getBeforeColumns() as $column){
            $where .= $this->getWhere($column, $header);
        }
        $sql = "DELETE FROM ". $header->getTableName() ."  where ". $where;
        $this->log($header->getTableName(),1, $sql, date('Y-m-d H:i:s', time()));
    }

    protected function log($table, $type, $sql, $time)
    {
        $sql = "INSERT INTO `canal_test` (`type`, `sql`, `time`) VALUES  (".$type. ", \"". $sql. "\", \"" . $time ."\" )" ;
        echo $sql.PHP_EOL;
        DB::insert($sql);
    }

    private function getWhere($column, $header){
        $where = '';

        if(!empty($this->defaultValue['primary_key']) && in_array($header->getTableName(),array_keys($this->defaultValue['primary_key']))){
            $primaryId = $this->defaultValue['primary_key'][$header->getTableName()];
            if($column->getName() == $primaryId){
                $where = '`'.$primaryId.'` =' . $column->getValue();
            }
        }elseif ($column->getName() == 'id'){
            $where = '`id` = ' . $column->getValue();
        }
        return $where;
    }
}
