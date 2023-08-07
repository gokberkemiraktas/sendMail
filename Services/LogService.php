<?php

namespace Services;

class LogService
{
    private const logFolder = "logs/";

    public function __construct()
    {
        if (!file_exists(self::logFolder)) {
            mkdir(self::logFolder);
        }
    }

    /**
     * @param string $text
     * @return void
     */
    public static function add(string $text)
    {
        $data = date("H:i:s") . "   " . $text . PHP_EOL;
        $logFileName = self::logFolder . date("Y-m-d") . ".log";
        if (file_exists($logFileName)) {
            file_put_contents($logFileName, $data, FILE_APPEND);
        } else {
            file_put_contents($logFileName, $data);
        }
    }
}