<?php

namespace App\Logger;

use Illuminate\Support\Facades\Log;

/**
 * @class CustomLogger
 * @description A custom logger service that provides methods for logging messages at different levels to a specific
 */
class CustomLogger
{
    /**
     * @param $message
     * @return void
     */
    public static function info($message): void
    {
        Log::channel('custom_log')->info($message);
    }

    /**
     * @param $message
     * @return void
     */
    public static function error($message): void
    {
        Log::channel('custom_log')->error($message);
    }

    /**
     * @param $message
     * @return void
     */
    public static function debug($message): void
    {
        Log::channel('custom_log')->debug($message);
    }

    /**
     * @param $message
     * @return void
     */
    public static function alert($message): void
    {
        Log::channel('custom_log')->alert($message);
    }

    /**
     * @param $message
     * @return void
     */
    public static function critical($message): void
    {
        Log::channel('custom_log')->critical($message);
    }

    /**
     * @param $message
     * @return void
     */
    public static function emergency($message): void
    {
        Log::channel('custom_log')->emergency($message);
    }

    /**
     * @param $message
     * @return void
     */
    public static function warning($message): void
    {
        Log::channel('custom_log')->warning($message);
    }

    /**
     * @param $message
     * @return void
     */
    public static function notice($message): void
    {
        Log::channel('custom_log')->notice($message);
    }
}
