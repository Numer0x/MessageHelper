<?php

namespace Zacz\MessageHelper;

use Illuminate\Foundation\Application;

interface MessageHelperInterface
{


    public function __construct(Application $config, $services = 'example', $url = '');

    public function send($phone, $content, $sign);
}
