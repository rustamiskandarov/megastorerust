<?php

namespace App\Logging\Telegram;

use App\Services\Telegram\TelegramBotApi;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Level;
use Monolog\Logger;
use Monolog\LogRecord;

class TelegramLoggerHandler extends AbstractProcessingHandler
{
    protected int $chatId;
    protected string $token;
    public function __construct(array $config)
    {
        $level = Logger::toMonologLevel($config['level']);
        parent::__construct($level);
        $this->token = $config['token'];
        $this->chatId = $config['chat_id'];
    }

    protected function write(LogRecord $record): void
    {
        app(TelegramBotApi::class)::sendMessage($this->chatId, $this->token, $record['formatted']);
        //TelegramBotApi::sendMessage($this->chatId, $this->token, $record['formatted']) ;
    }
}
