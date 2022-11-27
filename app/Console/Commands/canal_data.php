<?php

namespace App\Console\Commands;

use App\Service\DataService;
use Illuminate\Console\Command;
use xingwenge\canal_php\CanalConnectorFactory;
use xingwenge\canal_php\Fmt;

class canal_data extends Command
{
    //const FILTER_TABLES = 'sg_data.sg_user_channel_flow_buried,singa_collection.tb_collection_performance_report,singa_collection.tb_admin_user,singa_collection.tb_loan_collection,singa_collection.tb_loan_collection_order,singa_collection.tb_loan_collection_order_dispatch_log,singa_collection.tb_loan_collection_group_belong,singa_collection.tb_collection_product_dispatch_log,singa_collection.tb_auto_call_collection_call_log, singa_collection.tb_loan_collection_record_new_bak, singa_collection.tb_loan_collection_user_company, singa_collection.tb_loan_collection_group,fenqi.order_user_info,fenqi.repay_plan,fenqi.user_info';
    const FILTER_TABLES = 'singa_collection.tb_collection_performance_report,singa_collection.tb_admin_user,singa_collection.tb_loan_collection,singa_collection.tb_loan_collection_order,singa_collection.tb_loan_collection_order_dispatch_log,singa_collection.tb_loan_collection_group_belong,singa_collection.tb_collection_product_dispatch_log,singa_collection.tb_auto_call_collection_call_log, singa_collection.tb_loan_collection_record_new_bak, singa_collection.tb_loan_collection_user_company, singa_collection.tb_loan_collection_group';
    protected $signature = 'canal:data';
    protected $description = 'Command description';
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        try {
            $client = CanalConnectorFactory::createClient(1);
            $client->connect("192.168.36.128", 11111);
            $client->subscribe("1093", "example", self::FILTER_TABLES);
            $service = new DataService();
            while (true) {
                $message = $client->get(100);
                if ($entries = $message->getEntries()) {
                    foreach ($entries as $entry) {
                        //Fmt::println($entry);
                        $service->getSql($entry);
                    }
                }
                sleep(1);
            }
            $client->disConnect();
        } catch (\Exception $e) {
            echo $e->getMessage(), PHP_EOL;
        }
    }
}
