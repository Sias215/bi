<?php

namespace App\Console\Commands;

use App\Service\FenqiService;
use Illuminate\Console\Command;
use xingwenge\canal_php\CanalConnectorFactory;
use xingwenge\canal_php\Fmt;

class canal_fenqi extends Command
{
    const FILTER_TABLES = 'fenqi.order_user_info, fenqi.repay_plan, fenqi.user_info';
    protected $signature = 'canal:fenqi';
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
            $client->subscribe("1002", "fenqi", self::FILTER_TABLES);
            $service = new FenqiService();
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
