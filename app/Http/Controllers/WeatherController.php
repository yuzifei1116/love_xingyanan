<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $hour = date('H', time());
        $cache_hour = Cache::get('hour');
        if($hour != $cache_hour) {
            Cache::forget('weather');
        }
        if (Cache::get('weather')) {
            $data = Cache::get('weather');
        } else {
            $url = 'https://v0.yiketianqi.com/api?unescape=1&version=v9&appid=94184759&appsecret=pk7EJOLz&cityid=101010700&city=昌平';
            $data = $this->weather($url);
            // 循环小时天气 组成实时气温
            # code...
            foreach ($data['data'][0]['hours'] as $k => $v) {
                # code...
                $h = intval($v['hours']);
                if ($h < 10) {
                    $h = '0' . $h;
                }
                if ($h == $hour) {
                    Cache::put('hour', $h, 600);
                    $data['now_weather'] = $v;
                    $data['now'] = $hour.'点';
                }
            }
            Cache::put('weather', $data, 300);
        }
        return response()->json(['success' => ['message' => '获取成功!', 'data' => $data]]);
    }

    public function weather($url)
    {
        $headerArray = array("Content-type:application/json;", "Accept:application/json");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output, true);
        return $output;
    }
}
