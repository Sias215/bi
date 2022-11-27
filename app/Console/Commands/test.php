<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;


class test extends Command
{
    const FILTER_TABLES = 'singa_collection.tb_collection_performance_report,singa_collection.tb_admin_user,singa_collection.tb_loan_collection,singa_collection.tb_loan_collection_order,singa_collection.tb_loan_collection_order_dispatch_log,singa_collection.tb_loan_collection_group_belong,singa_collection.tb_collection_product_dispatch_log,singa_collection.tb_auto_call_collection_call_log, singa_collection.tb_loan_collection_record_new_bak, singa_collection.tb_loan_collection_user_company, singa_collection.tb_loan_collection_group';
    protected $signature = 'canal:test';
    protected $description = 'Command description';
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        while (true) {
            file_put_contents('/www/bi/app/Console/Commands',"111".PHP_EOL, FILE_APPEND);
            sleep(1);
        }
    }
}
