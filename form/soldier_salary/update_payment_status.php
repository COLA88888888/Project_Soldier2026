<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('HTTP/1.1 403 Forbidden');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

include('../../condb.php');

if (isset($_POST['salary_id']) && isset($_POST['status'])) {
    $salary_id = intval($_POST['salary_id']);
    $status = $_POST['status'] === 'paid' ? 'paid' : 'unpaid';
    
    $stmt = $conn->prepare("UPDATE salaries SET payment_status = ?, payment_updated_at = NOW() WHERE salary_id = ?");
    $stmt->bind_param("si", $status, $salary_id);
    
    if ($stmt->execute()) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['status' => 'success']);
    } else {
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
    $stmt->close();
} else {
    header('HTTP/1.1 400 Bad Request');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
}
?>
