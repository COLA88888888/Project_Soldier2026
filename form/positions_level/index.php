<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');

if (isset($_POST['submit'])) {
$l_name = trim($_POST['l_name']);
$user_id = $_SESSION['user_id'];

$check = $conn->prepare("SELECT l_name FROM positions_level WHERE l_name = ?");
$check->bind_param("s", $l_name);
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
$target_dir = "uploads/";
if (!is_dir($target_dir)) {
mkdir($target_dir, 0777, true); 
}
$file_tmp = $_FILES['l_img']['tmp_name'];
$file_ext = pathinfo($_FILES['l_img']['name'], PATHINFO_EXTENSION);
$new_filename = uniqid("user_", true) . "." . $file_ext;
$target_file = $target_dir . $new_filename;
if (move_uploaded_file($file_tmp, $target_file)) {
$img_path = $new_filename; 
} else {
echo "<script>
Swal.fire({
icon: 'error',
title: 'ອັບໂຫຼດຮູບບໍ່ສຳເລັດ',
showConfirmButton: false,
timer: 2000
});
</script>";
exit;
}
$sql = $conn->prepare("INSERT INTO positions_level (l_name, l_img, user_id) VALUES (?, ?, ?)");
$sql->bind_param("ssi", $l_name, $img_path, $user_id);

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
<h3 class="card-title">ຟອມບັນທຶກ ຊັ້ນ</h3>
</div>
<form  method="POST" enctype="multipart/form-data">
<div class="card-body">

<div class="form-group">
<label for="">ຊັ້ນ</label>
<input type="text" class="form-control" name="l_name" id="l_name" placeholder="ກະລຸນາປ້ອນ">
</div>

<div class="form-group">
<label for="exampleInputFile">ຮູບພາບ</label>
<input type="file" id="l_img" name="l_img" class="form-control" accept="image/*"><br>
</div>
</div>
<img id="preview" src="" width="100" style="display:none;">  
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
