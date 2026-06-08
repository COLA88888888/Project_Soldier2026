<?php include('../../controllers/head.php'); ?>
<?php 
include('../../condb.php');


if (!isset($_GET['u_id'])) {
echo "<script>window.location='show_table.php';</script>";
exit;
}

$u_id = intval($_GET['u_id']);
$user_id = $_SESSION['user_id'];

// ดึงข้อมูลเดิม
$stmt1 = $conn->prepare("SELECT * FROM units WHERE u_id = ?");
$stmt1->bind_param("i", $u_id);
$stmt1->execute();
$result = $stmt1->get_result();
$data = $result->fetch_assoc();
$stmt1->close();

if (!$data) {
echo "<script>alert('ບໍ່ພົບຂໍ້ມູນ'); window.location='show_table.php';</script>";
exit;
}

$selected_d_id = $data['d_id'];
$selected_o_id = $data['o_id'];
$selected_pk_id = $data['pk_id'];
$u_name = $data['u_name'];

// อัปเดตข้อมูล
if (isset($_POST['submit'])) {
$d_id = intval($_POST['d_id']);
$o_id = intval($_POST['o_id']);
$pk_id = intval($_POST['pk_id']);
$u_name = trim($_POST['u_name']);
$u_id_post = intval($_POST['u_id']); // รับจาก hidden input

$stmt2 = $conn->prepare("UPDATE units SET d_id = ?, o_id = ?, pk_id = ?, u_name = ? WHERE u_id = ?");
$stmt2->bind_param("iiisi", $d_id, $o_id, $pk_id, $u_name, $u_id_post);

if ($stmt2->execute()) {
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
title: 'ຜິດພາດ: " . $stmt2->error . "'
});
</script>";
}
$stmt2->close();
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
<h3 class="card-title">ຟອມແກ້ໄຂ ໜ່ວຍງານ</h3>
</div>

<form method="POST">
<div class="card-body">

<input type="hidden" name="u_id" value="<?= htmlspecialchars($u_id) ?>">

<!-- ກົມກອງ -->
<div class="form-group">
<label>ກົມກອງຂື້ນກັບ</label>
<select name="d_id" class="form-control select2" id="d_id" required>
<option value="">-- ເລືອກ --</option>
<?php 
$stmt3 = $conn->prepare("SELECT d_id, d_name FROM department ORDER BY d_name ASC");
$stmt3->execute();
$result = $stmt3->get_result();
while ($row = $result->fetch_assoc()) {
$selected = ($row['d_id'] == $selected_d_id) ? 'selected' : '';
echo "<option value='{$row['d_id']}' $selected>" . htmlspecialchars($row['d_name']) . "</option>";
}
$stmt3->close();
?>
</select>
</div>

<!-- ຫ້ອງການ -->
<div class="form-group">
<label>ຫ້ອງການ</label>
<select name="o_id" class="form-control select2" id="o_id" required>
<option value="">-- ເລືອກ --</option>
<?php 
$stmt4 = $conn->prepare("SELECT o_id, o_name FROM office WHERE d_id = ? ORDER BY o_name ASC");
$stmt4->bind_param("i", $selected_d_id);
$stmt4->execute();
$result = $stmt4->get_result();
while ($row = $result->fetch_assoc()) {
$selected = ($row['o_id'] == $selected_o_id) ? 'selected' : '';
echo "<option value='{$row['o_id']}' $selected>" . htmlspecialchars($row['o_name']) . "</option>";
}
$stmt4->close();
?>
</select>
</div>

<!-- ພະແນກ -->
<div class="form-group">
<label>ພະແນກ</label>
<select name="pk_id" class="form-control select2" id="pk_id" required>
<option value="">-- ເລືອກ --</option>
<?php 
$stmt5 = $conn->prepare("SELECT pk_id, pk_name FROM panak WHERE o_id = ? ORDER BY pk_name ASC");
$stmt5->bind_param("i", $selected_o_id);
$stmt5->execute();
$result = $stmt5->get_result();
while ($row = $result->fetch_assoc()) {
$selected = ($row['pk_id'] == $selected_pk_id) ? 'selected' : '';
echo "<option value='{$row['pk_id']}' $selected>" . htmlspecialchars($row['pk_name']) . "</option>";
}
$stmt5->close();
?>
</select>
</div>

<!-- ໜ່ວຍງານ -->
<div class="form-group">
<label>ໜ່ວຍງານ</label>
<input type="text" class="form-control" name="u_name" value="<?= htmlspecialchars($u_name) ?>" required>
</div>

</div>
<div class="card-footer text-center">
<button type="submit" name="submit" class="btn btn-primary"><i class="ion-android-add"></i> ບັນທຶກ</button>
<button type="reset" class="btn btn-danger"><i class="ion-android-refresh"></i> ຍົກເລີກ</button>
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
$(document).ready(function() {
$('.select2').select2({ width: '100%', placeholder: "-- ເລືອກ --", allowClear: true });

$('#d_id').change(function(){
var d_id = $(this).val();
$.post("ajax_sungkud.php", { d_id: d_id, function: 'd_id' }, function(data){
$('#o_id').html(data).trigger('change');
$('#pk_id').html('<option value="">-- ເລືອກ --</option>');
});
});

$('#o_id').change(function(){
var o_id = $(this).val();
$.post("ajax_sungkud.php", { o_id: o_id, function: 'o_id' }, function(data){
$('#pk_id').html(data);
});
});
});
</script>
