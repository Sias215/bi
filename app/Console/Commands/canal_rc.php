<?php

namespace App\Console\Commands;

use App\Service\RcService;
use Illuminate\Console\Command;
use xingwenge\canal_php\CanalConnectorFactory;

class canal_rc extends Command
{
    const FILTER_TABLES = 'singa_rc.cloudun_amount,singa_rc.loan_info,singa_rc.cloudun_audit';
    protected $signature = 'canal:rc';
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
            $client->subscribe("1020", "test", self::FILTER_TABLES);
            $client->disConnect();
            $service = new RcService();
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
