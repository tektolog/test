<?php
// Простой webhook для Telegram
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Логируем входящие данные
    file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - " . json_encode($input) . "\n", FILE_APPEND);
    
    // Простой ответ для Telegram
    if (isset($input['message'])) {
        $chat_id = $input['message']['chat']['id'];
        $text = "Привет! Я получил твое сообщение: " . $input['message']['text'];
        
        $response = [
            'method' => 'sendMessage',
            'chat_id' => $chat_id,
            'text' => $text
        ];
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    // GET запрос - показываем информацию
    echo "<h1>Webhook Server is Running!</h1>";
    echo "<p>Server time: " . date('Y-m-d H:i:s') . "</p>";
    echo "<p>Use this URL for Telegram webhook</p>";
}

// some comment