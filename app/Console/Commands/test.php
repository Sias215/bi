<?php

namespace App\Console\Commands;
use App\Service\TestService;
use Illuminate\Console\Command;
use xingwenge\canal_php\CanalConnectorFactory;


class test extends Command
{
    //const FILTER_TABLES = 'singa_collection.tb_loan_collection_order';
    const FILTER_TABLES = 'singa_collection.tb_loan_collection_order';
    protected $signature = 'canal:test';
    protected $description = 'Command description';
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $client = CanalConnectorFactory::createClient(1);
            $client->connect("127.0.0.1", 11111);
            $client->subscribe("1006", "test", self::FILTER_TABLES);
            $client->disConnect();
            $service = new TestService();
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
