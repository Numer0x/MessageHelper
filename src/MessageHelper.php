<?php

namespace Zacz\MessageHelper;

use http\Client\Curl\User;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;

class MessageHelper
{

    protected mixed $config;

    protected $services;

    protected string $url = 'http://sms.qxcioud.com:9090/sms/batch/v1';

    public function __construct(Application $config, $services = 'example')
    {
        $this->config = $config->configPath($services);
        $this->services = $services;
    }

    public function send($phone, $content)
    {

        $client = new \GuzzleHttp\Client(['timeout' => 600.0]);
        $parms = [
            'appkey' => $this->config['appKey'],
            'appcode' => $this->config['appCode'],
            'sign' => md5($this->config['appKey'] . $this->config['appSecret'] . \Carbon\Carbon::now()->getTimestamp() . '000'),
            'phone' => $phone,
            'msg' => '【' . $this->services . '】' . $content,
            'timestamp' => \Carbon\Carbon::now()->getTimestamp() . '000'
        ];
        $response = $client->request(
            'POST',
            $this->url,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $parms
            ]);

        $body = $response->getBody();
        $stringBody = (string)$body;
        $res = json_decode($stringBody, true);
        return $res;
    }


}
