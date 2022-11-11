<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    /**
     * @description: 获取天气
     * @return {*}
     */    
    public function getWeather(Request $request)
    {
        # code...
        if(Cache::get('weather')) {
            $data = Cache::get('weather');
        } else {
            $url = 'https://v0.yiketianqi.com/api?unescape=1&version=v9&appid=94184759&appsecret=pk7EJOLz&cityid=101010700&city=昌平';
            $data = $this->weather($url);
            Cache::put('weather',$data,3600);
        }
        return response()->json(['success'=>['message' => '获取成功!', 'data' => $data]]);
    }

    public function weather($url){
        $headerArray =array("Content-type:application/json;","Accept:application/json");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headerArray);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output,true);
        return $output;
    }
}
