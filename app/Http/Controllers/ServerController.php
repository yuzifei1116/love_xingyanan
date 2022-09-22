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
            'token' => 'lovexingyanan',
            'EncodingAESKey'=>'ta4CwdNTBH963esAy9CUyA4jgT6LVUbMJ4GyS6FuGs8'
            //...
        ];
        
        $app = Factory::officialAccount($config);
        
        $response = $app->server->serve();
    
        return $response;
    }
}
