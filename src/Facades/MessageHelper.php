<?php

namespace Zacz\MessageHelper\Facades;

use Illuminate\Support\Facades\Facade;

class MessageHelper extends Facade
{

    protected static function getFacadeAccessor(){
        return 'MessageHelper';
    }
}
