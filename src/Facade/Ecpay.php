<?php

namespace wimmike\ECPay\Facade;

use Illuminate\Support\Facades\Facade;

class Ecpay extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ecpay';
    }
}
