<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 9/11/15
 * Time: 10:05 AM
 */

namespace App\Http\Controllers\Home\Wechat;


use App\Http\Controllers\Controller;
use Overtrue\Wechat\Js;

class VoiceController extends Controller{

    protected $js;

    public function __construct()
    {
        $appId = 'wx2dd4e1e9b5c192be';
        $secret = '649865ddb903fe731aee57b32c226204';
        $this->js = new Js($appId,$secret);
    }
    public function index()
    {
        $js = $this->js;
        $apis = [
            'checkJsApi',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'hideMenuItems',
            'showMenuItems',
            'hideAllNonBaseMenuItem',
            'showAllNonBaseMenuItem',
            'translateVoice',
            'startRecord',
            'stopRecord',
            'onRecordEnd',
            'playVoice',
            'pauseVoice',
            'stopVoice',
            'uploadVoice',
            'downloadVoice',
            'chooseImage',
            'previewImage',
            'uploadImage',
            'downloadImage',
            'getNetworkType',
            'openLocation',
            'getLocation',
            'hideOptionMenu',
            'showOptionMenu',
            'closeWindow',
            'scanQRCode',
            'chooseWXPay',
            'openProductSpecificView',
            'addCard',
            'chooseCard',
            'openCard'
        ];
        $wechatJs = $js->config($apis);
        return view('home.voice.index',compact('wechatJs'));
    }
} 