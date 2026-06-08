<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');

if (!isset($_GET['d_id'])) {
echo "<script>window.location='show_table.php';</script>";
exit;
}

$d_id = intval($_GET['d_id']);

// ดึงข้อมูลเดิม
$sql = $conn->prepare("SELECT * FROM department WHERE d_id = ?");
$sql->bind_param("i", $d_id);
$sql->execute();
$result = $sql->get_result();
$data = $result->fetch_assoc();

if (!$data) {
echo "<script>alert('ບໍ່ພົບຂໍ້ມູນ'); window.location='show_table.php';</script>";
exit;
}

// เมื่อกด submit ให้ update
if (isset($_POST['submit'])) {
$d_name = trim($_POST['d_name']);

$update = $conn->prepare("UPDATE department SET d_name = ? WHERE d_id = ?");
$update->bind_param("si", $d_name, $d_id);

if ($update->execute()) {
echo "<script>
Swal.fire({
icon: 'success',
title: 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
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
?>

<?php include('../../controllers/menu_left.php'); ?>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<div class="card card-danger">
<div class="card-header">
<h3 class="card-title">ຟອມແກ້ໄຂ ກົມກອງ</h3>
</div>

<!-- ฟอร์มแก้ไข -->
<form action="" method="POST">
<div class="card-body">
<div class="form-group">
<label for="d_name">ກົມກອງ</label>
<input type="text" class="form-control" name="d_name" id="d_name" value="<?= $data['d_name']; ?>" required>
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
<?php include('../../controllers/footer.php'); ?>
