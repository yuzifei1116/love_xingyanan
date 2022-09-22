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
            // 'app_id' => 'wx440170b2078e530b',
            'app_id' => 'wx461c8601b484bd03',
            'secret' => '58567cc5411fe20a7d105059d283b571',
            // 'secret' => '75c523a900af69e3ad910647ccaf7c24',
            'token' => 'yuzifei'
        ];
        
        $app = Factory::officialAccount($config);
        
        $response = $app->server->serve();
        // dd($response);
        return $response;
    }
}
