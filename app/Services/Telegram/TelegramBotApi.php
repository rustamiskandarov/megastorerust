<?php

namespace App\Services\Telegram;

use Illuminate\Support\Facades\Http;

class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/bot';
    public static function sendMessage(string $chatId, string $token,  string $message): bool
    {
        try {
            $response = Http::get(self::HOST . $token.'/sendMessage', [
                'chat_id' => $chatId,
                'text' => $message,
            ])->throw()->json();
            return $response['ok'] ?? false;
        }catch (\Throwable $exception){
            throw new TelegramBotApiException($exception->getMessage());
        }

    }
}
