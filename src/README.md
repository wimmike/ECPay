## Ecpay

### Ecpay - Laravel 5 version - forked from https://github.com/flamelin/ECPay

<br>

**Installation **<br>
composer require wimmike/ecpay master

```

<br>
Add the service provider to your $providers array in config/app.php file like:
```

wimmike\ECPay\EcpayServiceProvider::class,

<br>
Add the alias to your $aliases array in config/app.php file like:
'Ecpay' => wimmike\ECPay\Facade\Ecpay::class,

```

<br>
**step 3 : Publish config to your project**<br>
```

php artisan vendor:publish --provider "wimmike\ECPay\EcpayServiceProvider"

````

## Configuration

* After installation, you will need to add your ecpay settings. Following is the code you will find in **config/ecpay.php**, which you should update accordingly.
```php
return [
    'ServiceURL' => env('PAY_SERVICE_URL', 'https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V2'),
    'HashKey' => env('PAY_HASH_KEY', '5294y06JbISpM5x9'),
    'HashIV' => env('PAY_HASH_IV', 'v77hoKGq4kWxNNIS'),
    'MerchantID' => env('PAY_MERCHANT_ID', '2000132'),
];
````

<br>
* Add this to `.env`<br>
```ini
#Payment testing : Use default value in config/ecpay.php.
APP_PAY_TEST=true

PAY_SERVICE_URL=https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V2
PAY_HASH_KEY=5294y06JbISpM5x9
PAY_HASH_IV=v77hoKGq4kWxNNIS
PAY_MERCHANT_ID=2000132

````

---

### How To Use
```php
use Ecpay;
````

```php
public function Demo()
{
    //Official Example :
    //https://github.com/ECPay/ECPayAIO_PHP/blob/master/AioSDK/example/sample_Credit_CreateOrder.php

    //基本參數(請依系統規劃自行調整)
    Ecpay::i()->Send['ReturnURL']         = "http://www.ecpay.com.tw/receive.php" ;
    Ecpay::i()->Send['MerchantTradeNo']   = "Test".time() ;           //訂單編號
    Ecpay::i()->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');      //交易時間
    Ecpay::i()->Send['TotalAmount']       = 2000;                     //交易金額
    Ecpay::i()->Send['TradeDesc']         = "good to drink" ;         //交易描述
    Ecpay::i()->Send['ChoosePayment']     = \ECPay_PaymentMethod::ALL ;     //付款方式

    //訂單的商品資料
    array_push(Ecpay::i()->Send['Items'], array('Name' => "緑界黑芝麻豆漿", 'Price' => (int)"2000",
               'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed"));

    //Go to ECPay
    echo "緑界頁面導向中...";
    echo Ecpay::i()->CheckOutString();
}
```

Use `CheckOutString()` instead of `CheckOut()`

```php

//Payment Success callback
public function doneDemo(Request $request)
{
    $arFeedback = Ecpay::i()->CheckOutFeedback($request->all());
    print Ecpay::i()->getResponse($arFeedback);
}
```

## <br>
