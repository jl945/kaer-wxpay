<?php
/**
 * Created by PhpStorm.
 * User: jialei
 * Date: 2016/11/23
 * Time: 下午3:36
 */

namespace Kaer\WxpayForLaravel\Facades;


use Illuminate\Support\Facades\Facade;

class WxpayOpen extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'wxpay.open';
    }
}