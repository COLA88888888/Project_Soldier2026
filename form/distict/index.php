<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');

if (isset($_POST['submit'])) {
$pro_id = trim($_POST['pro_id']);
$dis_name = trim($_POST['dis_name']);
$user_id = $_SESSION['user_id'];

$check = $conn->prepare("SELECT dis_name FROM distict WHERE dis_name = ? AND user_id = ?");
$check->bind_param("si", $dis_name, $user_id);
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
$sql = $conn->prepare("INSERT INTO `distict`(`dis_name`, `pro_id`, `user_id`) VALUES (?, ?, ?)");
$sql->bind_param("sii", $dis_name, $pro_id, $user_id);

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
<h3 class="card-title">ຟອມບັນທຶກ ແຂວງ</h3>
</div>
<form method="post" enctype="multipart/form-data">
<div class="card-body">
<div class="form-group">
<label for="pro_name">ແຂວງ</label>
<select name="pro_id" id="pro_id" class="form-control">
<option value="">-- ເລືອກ --</option>
<?php
$sql = $conn->prepare("SELECT * FROM province");
$sql->execute();
$result = $sql->get_result();
while ($row = $result->fetch_assoc()) {
echo '<option value="'.$row['pro_id'].'">'.$row['pro_name'].'</option>';
}
?>
</select>
</div>
<div class="form-group">
<label for="pro_name">ເມືອງ</label>
<input type="text" class="form-control" name="dis_name" id="dis_name" placeholder="ກະລຸນາປ້ອນຊື່ແຂວງ">
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
