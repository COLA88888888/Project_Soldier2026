<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');


if (!isset($_GET['pk_id'])) {
echo "<script>window.location='show_table.php';</script>";
exit;
}

$pk_id = intval($_GET['pk_id']);
$user_id = $_SESSION['user_id'];

// ดึงข้อมูลเดิม
$sql = $conn->prepare("SELECT * FROM panak WHERE pk_id = ? AND user_id = ?");
$sql->bind_param("ii", $pk_id, $user_id);
$sql->execute();
$result = $sql->get_result();
$data = $result->fetch_assoc();

if (!$data) {
echo "<script>alert('ບໍ່ພົບຂໍ້ມູນ'); window.location='show_table.php';</script>";
exit;
}

// เก็บค่าเดิมไว้ใช้ใน <select>
$selected_d_id = $data['d_id'];
$selected_o_id = $data['o_id'];
$pk_name = $data['pk_name'];

// เมื่อกดบันทึก
if (isset($_POST['submit'])) {
$d_id = intval($_POST['d_id']);
$o_id = intval($_POST['o_id']);
$pk_name = trim($_POST['pk_name']);

$stmt = $conn->prepare("UPDATE panak SET d_id = ?, o_id = ?, pk_name = ? WHERE pk_id = ? AND user_id = ?");
$stmt->bind_param("iisii", $d_id, $o_id, $pk_name, $pk_id, $user_id);

if ($stmt->execute()) {
echo "<script>
Swal.fire({
icon: 'success',
title: 'ແກ້ໄຂມູນສຳເລັດ',
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
<h3 class="card-title">ຟອມແກ້ໄຂ ພະແນກ</h3>
</div>

<form method="POST">
<div class="card-body">

<!-- กรมกอง -->
<div class="form-group">
<label for="d_id">ກົມກອງຂື້ນກັບ</label>
<select name="d_id" id="d_id" class="form-control select2" required>
<option value="">-- ເລືອກ --</option>
<?php
$res = $conn->query("SELECT * FROM department  ORDER BY d_name ASC");
while ($row = $res->fetch_assoc()) {
$selected = ($row['d_id'] == $selected_d_id) ? 'selected' : '';
echo "<option value='{$row['d_id']}' $selected>{$row['d_name']}</option>";
}
?>
</select>
</div>

<!-- ห้องการ -->
<div class="form-group">
<label for="o_id">ຫ້ອງການ</label>
<select name="o_id" id="o_id" class="form-control select2" required>
<?php
$res = $conn->query("SELECT * FROM office WHERE d_id = $selected_d_id ORDER BY o_name ASC");
while ($row = $res->fetch_assoc()) {
$selected = ($row['o_id'] == $selected_o_id) ? 'selected' : '';
echo "<option value='{$row['o_id']}' $selected>{$row['o_name']}</option>";
}
?>
</select>
</div>

<!-- ชื่อพะแนก -->
<div class="form-group">
<label for="pk_name">ຊື່ພະແນກ</label>
<input type="text" class="form-control" name="pk_name" id="pk_name" value="<?= htmlspecialchars($pk_name) ?>" required>
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

<script>
// ดึงห้องการอัตโนมัติตาม d_id
$('#d_id').change(function(){
var d_id = $(this).val();
$.ajax({
type: "POST",
url: "ajax_office.php",
data: { d_id: d_id },
success: function(data){
$('#o_id').html(data);
}
});
});
</script>
