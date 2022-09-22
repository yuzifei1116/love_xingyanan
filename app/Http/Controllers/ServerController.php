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

        $user = $app->oauth->scopes(['snsapi_userinfo'])
                          ->redirect();

        dd($user);

        return $app->server->serve();
    }
}
