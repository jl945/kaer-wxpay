<?php

namespace Kaer\Wxpay;

use Illuminate\Support\ServiceProvider;
use Kaer\Wxpay\App\WxAppPay;

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
        ];
    }
}
