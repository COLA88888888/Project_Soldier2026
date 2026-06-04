
<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');

if (isset($_POST['submit'])) {
$d_id = $_POST['d_id'];
$o_name = trim($_POST['o_name']); // ✅ แก้ตรงนี้
$user_id = $_SESSION['user_id'];

// ตรวจสอบชื่อซ้ำ
$check = $conn->prepare("SELECT o_name FROM office WHERE o_name = ? AND user_id = ?");
$check->bind_param("si", $o_name, $user_id);
$check->execute();
$check_result = $check->get_result();

if ($check_result->num_rows > 0) {
echo "<script>
Swal.fire({
icon: 'warning',
title: 'ຊື່ນີ້ມີແລ້ວ',
text: 'ກະລຸນາໃສ່ຊື່ອື່ນ',
timer: 3000,
showConfirmButton: true
});
</script>";
} else {
$sql = $conn->prepare("INSERT INTO office (d_id, o_name, user_id) VALUES (?, ?, ?)");
$sql->bind_param("isi", $d_id, $o_name, $user_id);

if ($sql->execute()) {
echo "<script>
Swal.fire({
icon: 'success',
title: 'ບັນທຶກຂໍ້ມູນສຳເລັດ',
timer: 2000,
showConfirmButton: false
}).then(() => {
window.location = 'show_table.php'; 
});
</script>";
} else {
echo "<script>
Swal.fire({
icon: 'error',
title: 'ຜິດພາດ: ".mysqli_error($conn)."'
});
</script>";
}
}
}
?>


<?php include('../../controllers/menu_left.php'); ?>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">ຟອມບັນທຶກ ຫ້ອງການ</h3>
</div>
<form  method="POST" enctype="multipart/form-data">
<div class="card-body">

<div class="form-group">
<label for="">ກົມກອງຂື້ນກັບ</label>
<select name="d_id" class="form-control select2" id="d_id">
<option value="">-- ເລືອກ --</option>
<?php 
include('../../condb.php');
$stmt = $conn->prepare("SELECT * FROM department ORDER BY d_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
echo '<option value="' . htmlspecialchars($row['d_id']) . '">' . htmlspecialchars($row['d_name']) . '</option>';
}
$stmt->close();
?>
</select>
</div>

<div class="form-group">
<label for="">ຫ້ອງການ</label>
<input type="text" class="form-control" name="o_name" id="o_name" placeholder="ກະລຸນາປ້ອນ">
</div>
</div>
<div class="card-footer text-center">
<button type="submit" name="submit" class="btn btn-primary"><i class="ion-android-add"></i> ບັນທຶກ</button>
<button type="reset" class="btn btn-danger"> <i class="ion-android-refresh"></i> ຍົກເລີກ</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('../../controllers/footer.php'); ?>
