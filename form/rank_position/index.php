<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');

if (isset($_POST['submit'])) {
$l_id = trim($_POST['l_id']);
$r_years = trim($_POST['r_years']);
$r_month = trim($_POST['r_month']);
$user_id = $_SESSION['user_id'];

$check = $conn->prepare("SELECT l_id FROM rank_position WHERE l_id = ? AND user_id = ?");
$check->bind_param("ii", $l_id, $user_id);
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
$sql = $conn->prepare("INSERT INTO rank_position (l_id, r_years, r_month, user_id) VALUES (?, ?, ?, ?)");
$sql->bind_param("iiii", $l_id, $r_years, $r_month, $user_id);

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
<h3 class="card-title">ຟອມບັນທຶກ ກຳນົດປີເລື່ອນຊັ້ນ</h3>
</div>
<form  method="POST" enctype="multipart/form-data">
<div class="card-body">
<div class="form-group">
<label for="rank">ຊັ້ນ</label>
<select name="l_id" class="form-control" id="l_id" >
<option value="">-- ເລືອກຊັ້ນ --</option>
<?php 
include('../../condb.php');
$stmt = $conn->prepare("SELECT *FROM positions_level ORDER BY l_id  DESC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
echo '<option value="' . htmlspecialchars($row['l_id']) . '">' . htmlspecialchars($row['l_name']) . '</option>';
}
$stmt->close();
?>
</select>
</div> 
<div class="form-group">
<label for="">ກຳນົດປີເລື່ອນຊັ້ນ</label>
<input type="text" class="form-control" name="r_years" id="r_years" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="">ກຳນົດເດືອນເລື່ອນຊັ້ນ</label>
<input type="text" class="form-control" name="r_month" id="r_month" placeholder="ກະລຸນາປ້ອນ">
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
