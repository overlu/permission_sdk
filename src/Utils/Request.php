<?php

namespace Overlu\Referee\Utils;

class Request
{
    protected static $headers = ["Content-type:application/json;charset='utf-8'", "Accept:application/json"];

    /**
     * post请求
     * @param string $url
     * @param array $data
     * @return bool|mixed|string
     */
    public static function post(string $url, array $data)
    {
        $data = json_encode($data);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, static::$headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        //将返回的json对象解码成数组对象并返回
        $output = json_decode($output, true);
        return $output;
    }

    /**
     * get请求
     * @param string $url
     * @return bool|mixed|string
     */
    public static function get(string $url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, static::$headers);
        $output = curl_exec($ch);
        curl_close($ch);
        //将返回的json对象解码成数组对象并返回
        $output = json_decode($output, true);
        return $output;
    }
}
