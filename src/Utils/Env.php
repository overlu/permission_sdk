<?php

namespace Overlu\Referee\Utils;

class Env
{
    public $env_file;

    public function __construct()
    {
        $this->env_file = realpath($_SERVER['DOCUMENT_ROOT'] . '/../') . '/.env';
        if (!is_file($this->env_file)) {
            file_put_contents($this->env_file, '');
        }
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function getEnv(string $key, $default = null)
    {
//        $key = strtoupper($key);
        if ($value = getenv($key)) {
            return $value;
        }
        $this->parse();
        return getenv($key) ?? $default;
    }

    /**
     * @return array
     */
    public function parse()
    {
        $envs = [];
        if (is_file($this->env_file)) {
            $temps = file($this->env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($temps as $temp) {
                $data = explode('=', $temp);
                if (count($data) == 2) {
                    $envs[trim($data[0])] = trim($data[1]);
                    putenv("$data[0]=$data[1]");
                }
            }
        }
        return $envs;
    }


    /**
     * @param string $key
     * @param null $value
     * @return bool
     */
    public function setEnv(string $key, $value = null)
    {
//        $key = strtoupper($key);
        if (isset($_ENV[$key])) {
            if (is_bool($_ENV[$key])) {
                $old = $_ENV[$key] ? 'true' : 'false';
            } elseif ($_ENV[$key] === null) {
                $old = 'null';
            } else {
                $old = $_ENV[$key];
            }
            file_put_contents($this->env_file, str_replace(
                "$key=" . $old, "$key=" . $value, file_get_contents($this->env_file)
            ));
        } else {
            file_put_contents($this->env_file, "$key=" . $value . PHP_EOL, FILE_APPEND);
        }
        return putenv("$key=$value");
    }

    /**
     * @param array $data
     */
    public function setEnvs(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->setEnv($key, $value);
        }
    }
}
