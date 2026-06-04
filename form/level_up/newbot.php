<?php
$token = "7997554354:AAFOIJvnN3kgAA84luycqWOhUj8UVH3mz64"; // Bot Token
$chat_id = "7162044743"; // Chat ID ของคุณ
$message = "แจ้งเตือน: มีคำสั่งซื้อใหม่เข้ามา! 🎉";

$url = "https://api.telegram.org/bot$token/sendMessage";
$data = [
    'chat_id' => $chat_id,
    'text' => $message,
    'parse_mode' => 'HTML'
];

$options = [
    'http' => [
        'method'  => 'POST',
        'header'  => "Content-Type: application/x-www-form-urlencoded",
        'content' => http_build_query($data)
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result) {
    echo "ส่งข้อความเรียบร้อย!";
} else {
    echo "ส่งไม่สำเร็จ";
}
?>