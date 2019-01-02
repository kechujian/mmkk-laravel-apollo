<?php

return [
    'namespaces' => explode(',', config('00apollo.apolloConfig.baseconfig.configurations.namespaces',env('APOLLO_NAMESPACES', 'baseconfig'))),
    'cluster' => config('00apollo.apolloConfig.baseconfig.configurations.cluster',env('APOLLO_CLUSTER', 'dev')),
    'save_dir' => config_path(config('00apollo.apolloConfig.baseconfig.configurations.save_dir', '00apollo')),
    'config_server' => (config('00apollo.apolloConfig.baseconfig.configurations.config_server',env('APOLLO_CONFIG_SERVER', 'http://apolloconfig.mimikoukou.com'))),
    'app_id' => (config('00apollo.apolloConfig.baseconfig.configurations.app_id', env('APP_ID','api.mimikoukou.net.cn'))),
    'timeout_interval' => (config('00apollo.apolloConfig.baseconfig.configurations.timeout_interval', 70)),
];