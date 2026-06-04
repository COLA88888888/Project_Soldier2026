<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');

if (!isset($_GET['v_id'])) {
echo "<script>window.location='show_table.php';</script>";
exit;
}

$v_id = intval($_GET['v_id']);
$user_id = $_SESSION['user_id'];

// ดึงข้อมูลเดิม
$stmt = $conn->prepare("SELECT * FROM village WHERE v_id = ? AND user_id = ?");
$stmt->bind_param("ii", $v_id, $user_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$data) {
echo "<script>alert('ບໍ່ພົບຂໍ້ມູນ'); window.location='show_table.php';</script>";
exit;
}

// เมื่อกด submit
if (isset($_POST['submit'])) {
$pro_id = trim($_POST['pro_id']);
$dis_id = trim($_POST['dis_id']);
$v_name = trim($_POST['v_name']);

$check = $conn->prepare("SELECT v_name FROM village WHERE v_name = ? AND v_id != ? AND user_id = ?");
$check->bind_param("sii", $v_name, $v_id, $user_id);
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
$sql = $conn->prepare("UPDATE village SET pro_id = ?, dis_id = ?, v_name = ? WHERE v_id = ? AND user_id = ?");
$sql->bind_param("iisii", $pro_id, $dis_id, $v_name, $v_id, $user_id);

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
<h3 class="card-title">ຟອມແກ້ໄຂ ຂໍ້ມູນບ້ານ</h3>
</div>
<form method="post">
<div class="card-body">
<div class="form-group">
<label>ແຂວງ</label>
<select name="pro_id" id="pro_id" class="form-control">
<option value="">-- ເລືອກ --</option>
<?php
$stmt = $conn->prepare("SELECT * FROM province");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
$selected = ($row['pro_id'] == $data['pro_id']) ? 'selected' : '';
echo '<option value="'.$row['pro_id'].'" '.$selected.'>'.$row['pro_name'].'</option>';
}
?>
</select>
</div>

<div class="form-group">
<label>ເມືອງ</label>
<select name="dis_id" id="dis_id" class="form-control">
<option value="">-- ເລືອກ --</option>
<?php
$stmt = $conn->prepare("SELECT * FROM distict");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
$selected = ($row['dis_id'] == $data['dis_id']) ? 'selected' : '';
echo '<option value="'.$row['dis_id'].'" '.$selected.'>'.$row['dis_name'].'</option>';
}
?>
</select>
</div>

<div class="form-group">
<label>ຊື່ບ້ານ</label>
<input type="text" class="form-control" name="v_name" value="<?= htmlspecialchars($data['v_name']) ?>" placeholder="ກະລຸນາປ້ອນຊື່ບ້ານ">
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
