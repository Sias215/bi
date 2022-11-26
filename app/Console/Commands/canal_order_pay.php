<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use xingwenge\canal_php\CanalConnectorFactory;
use xingwenge\canal_php\Fmt;

class canal_order_pay extends Command
{
    const FILTER_TABLES = 'siga_order.sgo_order_extension, siga_order.sgo_orders, siga_order.sgo_pay_fail_logs, siga_order.sgo_user_personal_info_snaps, siga_order.sgo_user_bank_info_snaps, siga_order.sgo_order_products, siga_order.sgo_order_discount, siga_order.sgo_order_grade_quota, siga_order.sgo_order_risk, siga_order.sgo_repayments, siga_pay.sgp_permata_inquiry_logs, siga_pay.sgp_permata_transfer_logs, siga_pay.sgp_pay_flows, siga_pay.sgp_doku_va_logs, siga_pay.sgp_doku_notify_logs, siga_pay.sgp_repay_flows';
    protected $signature = 'canal:order-pay';
    protected $description = 'Command description';
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $client = CanalConnectorFactory::createClient(1);
            $client->connect("192.168.220.120", 11111);
            $client->subscribe("1003", "order", self::FILTER_TABLES);
            while (true) {
                $message = $client->get(100);
                if ($entries = $message->getEntries()) {
                    foreach ($entries as $entry) {
                        //Fmt::println($entry);
                        Fmt::getSql($entry);
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

//
