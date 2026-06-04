<?php include('../../controllers/head.php'); ?>
<?php 
include('../../condb.php');
if (isset($_POST['submit'])) {
$d_name = trim($_POST['d_name']);
$check = $conn->prepare("SELECT d_id FROM department WHERE d_name = ? AND user_id = ? AND d_id != ?");
$check->bind_param("sii", $d_name, $user_id, $d_id);
$check->execute();
$check_result = $check->get_result();
if ($check_result->num_rows > 0) {
echo "<script>
Swal.fire({
icon: 'warning',
title: 'ຊື່ນີ້ມີຢູ່ແລ້ວ',
text: 'ກະລຸນາໃສ່ຊື່ອື່ນ',
timer: 3000,
showConfirmButton: true
});
</script>";
} else {
$update = $conn->prepare("UPDATE department SET d_name = ? WHERE d_id = ? AND user_id = ?");
$update->bind_param("sii", $d_name, $d_id, $user_id);
if ($update->execute()) {
echo "<script>
Swal.fire({
icon: 'success',
title: 'ອັບເດດຂໍ້ມູນສຳເລັດ',
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
<div class="card card-warning">
<div class="card-header">
<h3 class="card-title">ແກ້ໄຂຂໍ້ມູນກົມກອງ</h3>
</div>
<form action="" method="POST" enctype="multipart/form-data">
<div class="card-body">
<div class="form-group">
<label for="d_name">ກົມກອງ</label>
<input type="text" class="form-control" name="d_name" id="d_name" required value="<?= htmlspecialchars($row['d_name']) ?>">
</div>
</div>
<div class="card-footer text-center">
<button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> ບັນທຶກການແກ້ໄຂ</button>
<a href="show_table.php" class="btn btn-secondary">ຍ້ອນກັບ</a>
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
