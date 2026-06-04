<?php
session_start();
include("condb.php");

$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';
$password_hash = hash('sha512', trim($pass));

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $user, $password_hash);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
$row = $result->fetch_assoc();

$_SESSION['user_id']   = $row['user_id'];
$_SESSION['username']  = $row['username'];
$_SESSION['name']      = $row['name'];
$_SESSION['role']      = $row['role'];
$_SESSION['checked']   = 1;
$redirectUrl = match($row['role']) {
'admin' => 'form/admin/index.php',
'user' => 'form/officers/pelsoin_id.php',
default => 'index.php',
};

echo "
<script src='sweetalert/dist/sweetalert2.all.min.js'></script>
<script>
Swal.fire({
title: 'ກຳລັງເຂົ້າສູ່ລະບົບ',
icon: 'success',
timer: 1500,
showConfirmButton: false,
didOpen: () => { Swal.showLoading(); }
}).then(() => {
window.location.href = '$redirectUrl';
});
</script>";
} else {
echo "
<script src='sweetalert/dist/sweetalert2.all.min.js'></script>
<script>
Swal.fire({
icon: 'error',
title: 'ຊື່ ຫຼື ລະຫັດຜິດ',
timer: 2000,
showConfirmButton: false
});
</script>";
}
?>
