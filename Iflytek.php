<?php

namespace ginkgo\iflytek;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\helpers\FileHelper;
use yii\httpclient\Client;
use yii\web\ServerErrorHttpException;

/**
 * iflytek web api
 */
class Iflytek extends \yii\base\Component
{
    public $appId;
    public $appKey;

    public function init()
    {
        if ($this->appId === null) {
            throw new InvalidConfigException('App ID 必填');
        }
        if ($this->appKey === null) {
            throw new InvalidConfigException('App Key 必填');
        }
    }

    public function tts($text)
    {
        $url = 'http://api.xfyun.cn/v1/service/v1/tts';

        $params = base64_encode(Json::encode([
            'auf' => 'audio/L16;rate=16000',
            'aue' => 'lame',
            'voice_name' => 'xiaoyan',
            'speed' => '50',
            'volume' => '50',
            'pitch' => '50',
            'engine_type' => 'intp65',
            'text_type' => 'text'
        ]));
        $current = time();

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl($url)
            ->setData(['text' => $text])
            ->addHeaders([
                'X-Appid' => $this->appId,
                'X-CurTime' => $current,
                'X-Param' => $params,
                'X-CheckSum' => md5($this->appKey . $current . $params),
            ])
            ->send();

        if ('audio/mpeg' == $response->getHeaders()->get('Content-Type')) {
            return ['status' => 200, 'content' => $response->getContent()];
        } else {
            return ['status' => 500];
        }
    }
}