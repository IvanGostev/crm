<?php
require_once 'vendor/autoload.php';
use Telegram\Bot\Api;
$botApiKey = '6136574062:AAHYmcmbNB_NOaD6QT3hxVJVcdRE8LyX4Pw';
$botUsername = '@crm_2023_bot';

$telegram = new Api($botApiKey);
$update = $telegram->getWebhookUpdate();
$chatId = $update->getMessage()->getChat()->getId();
$text = $update->getMessage()->getText();
//switch ($text) {
//    case '/start' :
//        $response = "Добро пожаловать в наш телеграм-бот: " . $botUsername;
//        break;
//    case '/validate' :
//        $response = "Вы проходите валидацию, введите одноразовый код сгенерированный в вашем аккаунте в CRM системе";
//        break;
//    default :
//        $response = "Я не понимаю команду :(";
//        break;
//}
$response = match ($text) {
    '/start' => "Добро пожаловать в наш телеграм-бот: " . $botUsername,
    '/validate' => "Вы проходите валидацию, введите одноразовый код сгенерированный в вашем аккаунте в CRM системе",
    default => "Я не понимаю команду :(",
};

$telegram->sendMessage([
    'chat_id' => $chatId,
    'text' => $response
]);