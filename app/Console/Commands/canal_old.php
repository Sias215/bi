<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use xingwenge\canal_php\CanalConnectorFactory;
use xingwenge\canal_php\Fmt;

class canal_old extends Command
{
    const FILTER_TABLES = 'singa.users,singa.sg_appsflyer_push';
    protected $signature = 'canal:old';
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
            $client->subscribe("1003", "test", self::FILTER_TABLES);
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
