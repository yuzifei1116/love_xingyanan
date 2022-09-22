<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\Factory;

class ServerController extends Controller
{
    //
    public function server()
    {
        # code...
        $config = [
            'app_id' => 'wx440170b2078e530b',
            'secret' => '75c523a900af69e3ad910647ccaf7c24',
            'token' => 'test'
        ];
        
        $app = Factory::officialAccount($config);

        $app->server->push(function ($message) {
            switch ($message['MsgType']) {
                case 'event':
                    return '收到事件消息';
                    break;
                case 'text':
                    return '我是邢亚楠';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                case 'file':
                    return '收到文件消息';
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }
        
            // ...
        });

        return $app->server->serve();
    }

    public function user()
    {
        # code...
        dd();
    }
}
