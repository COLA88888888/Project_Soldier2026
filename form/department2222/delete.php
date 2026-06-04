<?php
session_start();
include('../../condb.php');

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo "คุณไม่มีสิทธิ์เข้าถึง";
    exit;
}

$user_id = $_SESSION['user_id'];
$d_id = intval($_POST['d_id'] ?? 0);

// ตรวจสอบว่ามี d_id และเป็นของ user นี้หรือไม่
$stmt = $conn->prepare("DELETE FROM department WHERE d_id = ? AND user_id = ?");
$stmt->bind_param("ii", $d_id, $user_id);

if ($stmt->execute() && $stmt->affected_rows > 0) {
    echo "✅ ลบข้อมูลเรียบร้อยแล้ว";
} else {
    http_response_code(500);
    echo "❌ ไม่สามารถลบข้อมูลนี้ได้ หรือไม่มีสิทธิ์";
}
