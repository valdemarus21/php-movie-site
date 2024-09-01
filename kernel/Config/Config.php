<?php

namespace App\Kernel\Config;

class Config implements ConfigInterface
{

    public function get(string $key, $default = null): mixed
    {
        [$file, $key] = explode('.', $key);

//        $configPath = __DIR__ . "/config/$file.php";
        $configPath = APP_PATH . "/config/$file.php";
//        dd($configPath);
        if (!file_exists($configPath)) {
            return $default;
        }
        $config = require $configPath;
        return $config[$key] ?? $default;


    }
}