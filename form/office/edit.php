<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');


// ตรวจสอบค่า o_id
if (!isset($_GET['o_id'])) {
echo "<script>window.location='show_table.php';</script>";
exit;
}

$o_id = intval($_GET['o_id']);

// ดึงข้อมูลเดิมจากฐานข้อมูล
$stmt = $conn->prepare("SELECT * FROM office WHERE o_id = ?");
$stmt->bind_param("i", $o_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
echo "<script>alert('ບໍ່ພົບຂໍ້ມູນ'); window.location='show_table.php';</script>";
exit;
}

$selected_d_id = $data['d_id'];
$o_name = $data['o_name'];

// เมื่อกด submit
if (isset($_POST['submit'])) {
$d_id = intval($_POST['d_id']);
$o_name = trim($_POST['o_name']);

// ตรวจสอบชื่อซ้ำ (ยกเว้นตัวเอง)
$check = $conn->prepare("SELECT o_name FROM office WHERE o_name = ? AND o_id != ?");
$check->bind_param("si", $o_name, $o_id);
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
// UPDATE ข้อมูล
$sql = $conn->prepare("UPDATE office SET d_id = ?, o_name = ? WHERE o_id = ?");
$sql->bind_param("isi", $d_id, $o_name, $o_id);

if ($sql->execute()) {
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
<h3 class="card-title">ຟອມແກ້ໄຂ ຫ້ອງການ</h3>
</div>
<form method="POST">
<div class="card-body">

<!-- กรมกอง -->
<div class="form-group">
<label for="d_id">ກົມກອງຂື້ນກັບ</label>
<select name="d_id" class="form-control select2" id="d_id" required>
<option value="">-- ເລືອກ --</option>
<?php 
$stmt = $conn->prepare("SELECT * FROM department ORDER BY d_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
$selected = ($row['d_id'] == $selected_d_id) ? 'selected' : '';
echo '<option value="' . $row['d_id'] . '" ' . $selected . '>' . $row['d_name'] . '</option>';
}
$stmt->close();
?>
</select>
</div>

<!-- ชื่อห้องการ -->
<div class="form-group">
<label for="o_name">ຊື່ຫ້ອງການ</label>
<input type="text" class="form-control" name="o_name" id="o_name" value="<?= htmlspecialchars($o_name) ?>" required>
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
