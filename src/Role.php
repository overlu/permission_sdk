<?php


namespace Overlu\Referee;


use Overlu\Referee\Utils\Request;

class Role
{
    public static function referee($user_id, $rule, $app_code = null)
    {
        $data = [
            'origin_id' => $user_id,
            'rule' => $rule,
            'app_code' => $app_code ?? env('APP_CODE')
        ];
        $url = env('PERMISSION_SERVER') . '/api/referee?' . http_build_query($data);
        if ($response = Request::get($url)) {
            return $response['result'];
        }
        return false;
    }
}
