<?php
session_start();
header('Content-Type: application/json');
include('../../condb.php');

$d_name = trim($_POST['d_name']);
$user_id = $_SESSION['user_id'];

try {
    // ตรวจสอบชื่อซ้ำในตาราง department
    $check = $conn->prepare("SELECT d_name FROM department WHERE d_name = ? AND user_id = ?");
    $check->bind_param("si", $d_name, $user_id);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {
        echo json_encode([
            "status" => "warning",
            "message" => "❗ ຊື່ນີ້ມີແລ້ວ ກະລຸນາໃສ່ຊື່ອື່ນ"
        ]);
    } else {
        // เพิ่มข้อมูลใหม่
        $sql = $conn->prepare("INSERT INTO department (d_name, user_id) VALUES (?, ?)");
        $sql->bind_param("si", $d_name, $user_id);
        $sql->execute();

        echo json_encode([
            "status" => "success",
            "message" => "✅ ເພີ່ມຂໍ້ມູນສຳເລັດ"
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "❌ ເກີດຂໍ້ຜິດພາດ: " . $e->getMessage()
    ]);
}
?>
