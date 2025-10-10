<?php
require_once './config.php';

$bot_token = TOKEN; // Замените на токен вашего бота
$ngrok_url = URL; // Замените на ваш ngrok URL

// $webhook_url = $ngrok_url . '/webhook.php';
$webhook_url = $ngrok_url;

$api_url = "https://api.telegram.org/bot{$bot_token}/setWebhook?url={$webhook_url}";

$response = file_get_contents($api_url);
$result = json_decode($response, true);

if ($result['ok']) {
    echo "Webhook установлен успешно!\n";
    echo "URL: " . $webhook_url . "\n";
} else {
    echo "Ошибка: " . $result['description'] . "\n";
}
