<?php include('../../controllers/head.php'); ?>
<?php
include('../../condb.php');

if (!isset($_GET['level_id'])) {
echo "<script>window.location='show_table.php';</script>";
exit;
}

$level_id = intval($_GET['level_id']);
$user_id = $_SESSION['user_id'];

// ดึงข้อมูลจาก level_up
$stmt = $conn->prepare("SELECT * FROM level_up WHERE level_id = ? AND user_id = ?");
$stmt->bind_param("ii", $level_id, $user_id);
$stmt->execute();
$level = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$level) {
echo "<script>alert('ບໍ່ພົບຂໍ້ມູນ'); window.location='show_table.php';</script>";
exit;
}

// ดึงข้อมูล officer
$stmt = $conn->prepare("SELECT a.*, b.*, c.*, d.*, e.*, f.*, g.*, h.*
FROM positions_level AS a
JOIN rank_position AS b ON a.l_id = b.l_id
JOIN level_up AS d ON a.l_id = d.l_id
JOIN officers AS c ON c.officer_id = d.officer_id
JOIN office AS e ON e.o_id = c.o_id
JOIN panak AS f ON f.pk_id = c.pk_id
JOIN positions AS g ON g.pt_id = c.pt_id
JOIN units AS h ON h.u_id = c.u_id WHERE c.officer_id = ?");
$stmt->bind_param("i", $level['officer_id']);
$stmt->execute();
$officer = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (isset($_POST['submit'])) {
$l_id = trim($_POST['l_id']);
$o_id = trim($_POST['o_id']);
$pk_id = trim($_POST['pk_id']);
$u_id = trim($_POST['u_id']);
$pt_id = trim($_POST['pt_id']);
$level_date = trim($_POST['level_date']);
$date_office = trim($_POST['date_office']);

$update = $conn->prepare("UPDATE level_up SET l_id=?, o_id=?, pk_id=?, u_id=?, pt_id=?, level_date=?, date_office=? WHERE level_id=? AND user_id=?");
$update->bind_param("iiiiissii", $l_id, $o_id, $pk_id, $u_id, $pt_id, $level_date, $date_office, $level_id, $user_id);

if ($update->execute()) {
$update_officer = $conn->prepare("UPDATE officers SET l_id=?, o_id=?, pk_id=?, u_id=?, pt_id=? WHERE officer_id=? AND user_id=?");
$update_officer->bind_param("iiiiiii", $l_id, $o_id, $pk_id, $u_id, $pt_id, $level['officer_id'], $user_id);
$update_officer->execute();

echo "<script>
Swal.fire({ icon: 'success', title: 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ', timer: 2000, showConfirmButton: false })
.then(() => { window.location = 'show_table.php'; });
</script>";
} else {
echo "<script>Swal.fire({ icon: 'error', title: 'ຜິດພາດ: ".mysqli_error($conn)."' });</script>";
}
}
?>

<?php include('../../controllers/menu_left.php'); ?>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid">
<div class="card card-danger">
<div class="card-header">
<h3 class="card-title">ຟອມແກ້ໄຂ ການເລື່ອນຊັ້ນ</h3>
</div>
<form method="POST">
<div class="card-body">
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label>ລະຫັດບັດພະນັກງານ</label>
<input type="text" class="form-control" value="<?= htmlspecialchars($officer['national_id']) ?>" readonly>
<input type="hidden" name="officer_id" value="<?= $officer['officer_id'] ?>">
</div>
<div class="form-group">
<label>ຊື່</label>
<input type="text" class="form-control" value="<?= htmlspecialchars($officer['full_name']) ?>" readonly>
</div>
<div class="form-group">
<label>ນາມສະກຸນ</label>
<input type="text" class="form-control" value="<?= htmlspecialchars($officer['full_lastname']) ?>" readonly>
</div>
<div class="form-group">
<label>ເພດ</label>
<input type="text" class="form-control" value="<?= htmlspecialchars($officer['gender']) ?>" readonly>
</div>
<div class="form-group">
<label>ຊັ້ນເກົ່າ</label>
<input type="text" class="form-control" value="<?= htmlspecialchars($officer['l_name']) ?>" readonly>
</div>
<div class="form-group">
<label>ຊັ້ນໃໝ່</label>
<select name="l_id" class="form-control">
<option value="">-- ເລືອກຊັ້ນ --</option>
<?php
$stmt = $conn->prepare("SELECT * FROM positions_level ORDER BY l_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
$selected = ($row['l_id'] == $level['l_id']) ? 'selected' : '';
echo "<option value='{$row['l_id']}' $selected>{$row['l_name']}</option>";
}
$stmt->close();
?>
</select>
</div>

</div>
<div class="col-sm-6">
<div class="form-group">
<label>ຫ້ອງການ</label>
<select name="o_id" class="form-control">
<option value="">-- ເລືອກຫ້ອງການ --</option>
<?php
$stmt = $conn->prepare("SELECT * FROM office ORDER BY o_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
$selected = ($row['o_id'] == $level['o_id']) ? 'selected' : '';
echo "<option value='{$row['o_id']}' $selected>{$row['o_name']}</option>";
}
$stmt->close();
?>
</select>
</div>
<div class="form-group">
<label>ພະແນກ</label>
<select name="pk_id" class="form-control">
<option value="">-- ເລືອກພະແນກ --</option>
<?php
$stmt = $conn->prepare("SELECT * FROM panak ORDER BY pk_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
$selected = ($row['pk_id'] == $level['pk_id']) ? 'selected' : '';
echo "<option value='{$row['pk_id']}' $selected>{$row['pk_name']}</option>";
}
$stmt->close();
?>
</select>
</div>
<div class="form-group">
<label>ໜ່ວຍງານ</label>
<select name="u_id" class="form-control">
<option value="">-- ເລືອກໜ່ວຍ --</option>
<?php
$stmt = $conn->prepare("SELECT * FROM units ORDER BY u_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
$selected = ($row['u_id'] == $level['u_id']) ? 'selected' : '';
echo "<option value='{$row['u_id']}' $selected>{$row['u_name']}</option>";
}
$stmt->close();
?>
</select>
</div>
<div class="form-group">
<label>ໜ້າທີ່ຮັບຜິດຊອບ</label>
<select name="pt_id" class="form-control">
<option value="">-- ເລືອກຫ້ານທີ່ --</option>
<?php
$stmt = $conn->prepare("SELECT * FROM positions ORDER BY pt_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
$selected = ($row['pt_id'] == $level['pt_id']) ? 'selected' : '';
echo "<option value='{$row['pt_id']}' $selected>{$row['pt_name']}</option>";
}
$stmt->close();
?>
</select>
</div>
<div class="form-group">
<label>ວັນເລື່ອນຊັ້ນ</label>
<input type="date" class="form-control" name="level_date" value="<?= $level['level_date'] ?>">
</div>
<div class="form-group">
<label>ວັນຍົກຍ້າຍ</label>
<input type="date" class="form-control" name="date_office" value="<?= $level['date_office'] ?>">
</div>
</div>
</div>
<div class="card-footer text-center">
<button type="submit" name="submit" class="btn btn-primary">ບັນທຶກ</button>
<a href="show_table.php" class="btn btn-danger">ຍົກເລີກ</a>
</div>
</form>
</div>
</div>
</div>
</div>
<?php include('../../controllers/footer.php'); ?>
