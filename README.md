Yii2 iFLYTEK
============
Yii2 iFLYTEK

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist ginkgo/yii2-iflytek "*"
```

or add

```
"ginkgo/yii2-iflytek": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
    'components' => [
        'iflytek' => [
            'class' => 'ginkgo\iflytek\Iflytek',
            'appId' => 'YOUR_APP_ID',
            'appKey' => 'YOUR_APP_KEY',
        ],
    ],

    Yii::$app->iflytek->tts('科大讯飞是中国最大的智能语音技术提供商');
```