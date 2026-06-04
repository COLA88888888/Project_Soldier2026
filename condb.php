
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "project_police2025";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("ເຊື່ອມຖານຂໍ້ມູນ ຜິດພາດ: " . $conn->connect_error);
}
$conn->set_charset("utf8");
?>

