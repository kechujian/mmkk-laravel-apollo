<?php

namespace kechujian\apollo\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Org\Multilinguals\Apollo\Client\ApolloClient;

class StartMmkkApolloAgent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mmkk.apollo.start-agent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start apollo agent. ';


    /**
     * @var ApolloClient
     */
    private $apolloClient;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    private function initApolloClient() {
        if (empty(Config::get('apollo.config_server'))) {
            throw new \Exception('ConfigServer must be specified!');
        }

        if (empty(Config::get('apollo.app_id'))) {
            throw new \Exception('AppId must be specified!');
        }

        if (empty(Config::get('apollo.namespaces'))) {
            $namespaces = ['application'];
        } else {
            $namespaces = array_map(function($namespace) {
                return trim($namespace);
            }, Config::get('apollo.namespaces'));
        }
        $apolloClient = new ApolloClient(Config::get('apollo.config_server'), Config::get('apollo.app_id'), $namespaces);
        $apolloClient->setIntervalTimeout(Config::get('apollo.timeout_interval'));
        if(!is_dir(Config::get('apollo.save_dir')))
            mkdir(Config::get('apollo.save_dir'));
        $apolloClient->setSaveDir(Config::get('apollo.save_dir'));
        $apolloClient->setCluster(Config::get('apollo.cluster'));
        return $apolloClient;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $apolloClient = $this->initApolloClient();

            $error = $apolloClient->start();
            Log::error($error);
            return false;
        }
        catch (\Exception $e)
        {
            print_r($e->getMessage());
        }
    }
}