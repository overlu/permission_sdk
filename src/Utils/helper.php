<?php

if (!function_exists('config')) {
    /**
     * @param string|null $key
     * @param null $default
     * @return mixed|null
     */
    function config(string $key = null, $default = null)
    {
        if ($key && $value = env($key)) {
            return $value;
        }
        $values = include_once(__DIR__ . '/../config.php');
        if (!$key) {
            return $values;
        }
        return $values[$key] ?? $default;
    }
}

if (!function_exists('env')) {
    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    function env(string $key, $default = null)
    {
        return (new \Overlu\Log\Utils\Env())->getEnv($key, $default);
    }
}
