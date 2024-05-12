<?php

namespace App\Core\Logger;

class Logger implements LoggerInterface
{
    public function write(string $message, string $type): void
    {
        $timestamp = date('Y-m-d H:i:s');

        $log_file = APP_PATH . "/logs/$type.log";

        $message = "$timestamp: $message \r\n";

        file_put_contents($log_file, $message, FILE_APPEND);
    }

    public function logs(string $type): string|false
    {
        $log_file = APP_PATH . "/logs/$type.log";

        return file_get_contents($log_file);
    }
}