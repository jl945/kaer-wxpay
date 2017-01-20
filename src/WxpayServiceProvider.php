<?php

namespace Kaer\WxpayForLaravel;

use Illuminate\Support\ServiceProvider;
use Kaer\WxpayForLaravel\App\WxAppPay;
use Kaer\WxpayForLaravel\Open\WxPay;

class WxpayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/kaer-wxpay.php' => config_path('kaer-wxpay.php'),
            __DIR__ . '/config/kaer-wxpay-app.php' => config_path('kaer-wxpay-app.php'),
            __DIR__ . '/config/kaer-wxpay-open.php' => config_path('kaer-wxpay-open.php'),

        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('wxpay.app', function ($app) {
            $wxpay = new WxAppPay();
            $wxpay->setAppid($app->config->get('kaer-wxpay-app.app_id'))
                ->setMchId($app->config->get('kaer-wxpay-app.mch_id'))
                ->setNotifyUrl($app->config->get('kaer-wxpay-app.notify_url'))
                ->setTradeType($app->config->get('kaer-wxpay-app.trade_type'))
                ->setKey($app->config->get('kaer-wxpay-app.key'));
            return $wxpay;
        });
        $this->app->bind('wxpay.open', function ($app) {
            $wxpay = new WxPay();
            $wxpay->setAppid($app->config->get('kaer-wxpay-open.app_id'))
                ->setMchId($app->config->get('kaer-wxpay-open.mch_id'))
                ->setNotifyUrl($app->config->get('kaer-wxpay-open.notify_url'))
                ->setTradeType($app->config->get('kaer-wxpay-open.trade_type'))
                ->setKey($app->config->get('kaer-wxpay-open.key'));
            return $wxpay;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'wxpay.app',
            'wxpay.open',
        ];
    }
}
