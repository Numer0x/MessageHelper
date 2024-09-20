<?php

namespace Zacz\MessageHelper;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;

class MessageHelper
{

    protected mixed $config;

    public function __construct(Application $config)
    {
        $this->config = $config;
    }

    public function generate($provider = 'Qixunyun', $services = 'example', $url = 'http://sms.qxcioud.com:9090/sms/batch/v1')
    {
        return new $provider . 'MessageHelper'($this->config, $services, $url);

    }

}
