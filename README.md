# kaer-wxpay
微信支付 app 支付

###目标
快速的接入微信app支付
###安装
composer require kaer/wxpay-for-laravel
###使用
注册服务提供者

找到 ``config/app.php`` 配置文件中，``key``为 ``providers`` 的数组，在数组中添加服务提供者。

```
'providers' => [
        // ...
	Kaer\WxpayForLaravel\WxpayServiceProvider::class,
]

```
运行 ``php artisan vendor:publish`` 命令，发布配置文件到你的项目中。
###说明
配置文件``kaer-wxpay-app.php``为app 微信支付

###例子🌰
app下单

```
$wxpay = app('wxpay.app');
$wxpay->setBody("app在线支付")
      ->setTradeNo($trade_no)
      ->setTotalFee(($order->money * 100));
$result = $wxpay->unifiedOrder();//统一下单结果
if ($result['return_code'] === 'SUCCESS' &&$result['result_code'] == 'SUCCESS') {
   $prepay_id = $result['prepay_id'];
   $rst = $wxpay->getAppPayParams($prepay_id);
   return $rst;
} else {
 //统一下单失败
}
```
回调通知

```

        $WXPay = app('wxpay.app');
        $data = $WXPay->getNotifyData();
        // 验证请求。
        if (!$WXPay->verify()) {
            //验证失败
            return $WXPay->replyFailNotify();
        }
        if ($data['result_code'] == "SUCCESS") {
            $money = ($data['total_fee'] / 100);
            $out_trade_no = $data['out_trade_no'];
            $wx_trade_no = $data['transaction_id'];
            //你的业务
        }
        return $WXPay->replySuccessNotify();
```
