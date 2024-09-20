<?php

namespace Zacz\MessageHelper;

use Illuminate\Foundation\Application;

class QixunyunMessageHelper implements \Zacz\MessageHelper\MessageHelperInterface
{

    protected Application $config;

    protected string $services;

    protected string $url;

    public function __construct(Application $config, $services = 'example', $url = 'http://sms.qxcioud.com:9090/sms/batch/v1')
    {
        $this->config = $config;
        $this->url = $url;
        $this->services = $services;
    }

    public function send($phone, $content, $sign)
    {

        $client = new \GuzzleHttp\Client(['timeout' => 600.0]);
        $parms = [
            'appkey' => $this->config[$this->services]['appKey'],
            'appcode' => $this->config[$this->services]['appCode'],
            'sign' => md5($this->config[$this->services]['appKey'] . $this->config[$this->services]['appSecret'] . \Carbon\Carbon::now()->getTimestamp() . '000'),
            'phone' => $phone,
            'msg' => '【' . $sign . '】' . $content,
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
