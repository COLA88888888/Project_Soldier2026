<?php include('../../controllers/head.php'); ?>
<?php 
include('../../condb.php');

if (!isset($_GET['user_id'])) {
echo "<script>window.location='show_table.php';</script>";
exit;
}

$user_id = intval($_GET['user_id']);

$stmt = $conn->prepare("SELECT u.*, v.v_name FROM users AS u LEFT JOIN village AS v ON u.v_id = v.v_id WHERE u.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$data) {
echo "<script>alert('ບໍ່ພົບຂໍ້ມູນ'); window.location='show_table.php';</script>";
exit;
}

if (isset($_POST['submit'])) {
$username   = trim($_POST['username']);
$password   = trim($_POST['password']);
$role       = trim($_POST['role']);
$name       = trim($_POST['name']);
$dob_date   = trim($_POST['dob_date']);
$gender     = trim($_POST['gender']);
$pro_id     = intval($_POST['pro_id']);
$dis_id     = intval($_POST['dis_id']);
$v_name     = trim($_POST['v_name']);
$email      = trim($_POST['email']);
$usphone    = trim($_POST['usphone']);
$img        = $data['img'];

if (!empty($_FILES['img']['name'])) {
$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
$img = uniqid('img_') . '.' . $ext;
move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/' . $img);
}

$password_hash = !empty($password) ? hash('sha512', $password) : $data['password'];

$current_user_id = $_SESSION['user_id'] ?? 1;
$v_id = 0;
if (!empty($v_name)) {
    $v_stmt = $conn->prepare("SELECT v_id FROM village WHERE v_name = ? AND dis_id = ? LIMIT 1");
    $v_stmt->bind_param("si", $v_name, $dis_id);
    $v_stmt->execute();
    $v_stmt->bind_result($existing_v_id);
    if ($v_stmt->fetch()) {
        $v_id = $existing_v_id;
    }
    $v_stmt->close();

    if ($v_id === 0) {
        $insert_v = $conn->prepare("INSERT INTO village (v_name, dis_id, pro_id, user_id) VALUES (?, ?, ?, ?)");
        $insert_v->bind_param("siii", $v_name, $dis_id, $pro_id, $current_user_id);
        $insert_v->execute();
        $v_id = $insert_v->insert_id;
        $insert_v->close();
    }
}

// ✅ ตรวจสอบชื่อซ้ำ (ยกเว้นตัวเอง)
$check = $conn->prepare("SELECT username FROM users WHERE username = ? AND user_id != ?");
$check->bind_param("si", $username, $user_id);
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
$sql = $conn->prepare("UPDATE users 
SET username=?, password=?, role=?, name=?, dob_date=?, gender=?, 
pro_id=?, dis_id=?, v_id=?, email=?, usphone=?, img=? 
WHERE user_id=?");

$sql->bind_param("ssssssiiisssi", 
$username, $password_hash, $role, $name, $dob_date, $gender,
$pro_id, $dis_id, $v_id, $email, $usphone, $img, $user_id
);

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
<div class="card card-danger">
<div class="card-header">
<h3 class="card-title">ແກ້ໄຂຜູ້ໃຊ້</h3>
</div>
<form method="POST" enctype="multipart/form-data">
<div class="card-body">
<div class="row">
<!-- Column Left -->
<div class="col-sm-6">
<div class="form-group">
<label>ຊື່-ນາມສະກຸນ</label>
<input type="text" class="form-control" name="name" value="<?= htmlspecialchars($data['name']) ?>" required>
</div>
<div class="form-group">
<label>ວັນເດືອນປີເກີດ</label>
<input type="date" class="form-control" name="dob_date" value="<?= $data['dob_date'] ?>" required>
</div>
<div class="form-group">
<label>ເພດ</label>
<select name="gender" class="form-control select2" required>
<option value="">-- ເລືອກເພດ --</option>
<option value="ຊາຍ" <?= $data['gender'] == 'ຊາຍ' ? 'selected' : '' ?>>ຊາຍ</option>
<option value="ຍິງ" <?= $data['gender'] == 'ຍິງ' ? 'selected' : '' ?>>ຍິງ</option>
</select>
</div>
<div class="form-group">
<label>ຊື່ຜູ້ໃຊ້</label>
<input type="text" class="form-control" name="username" value="<?= htmlspecialchars($data['username']) ?>" required>
</div>
<div class="form-group">
<label>ລະຫັດຜ່ານ</label>
<input type="password" class="form-control" name="password" placeholder="******">
</div>
<div class="form-group">
<label>ສະຖານະ</label>
<select name="role" class="form-control select2" required>
<option value="admin" <?= $data['role'] == 'admin' ? 'selected' : '' ?>>ແອັດມິນ</option>
<option value="user" <?= $data['role'] == 'user' ? 'selected' : '' ?>>ພະນັກງານ</option>
</select>
</div>
</div>

<!-- Column Right -->
<div class="col-sm-6">
<div class="form-group">
<label>ອີເມວ</label>
<input type="email" class="form-control" name="email" value="<?= htmlspecialchars($data['email']) ?>" required>
</div>
<div class="form-group">
<label>ເບີໂທ</label>
<input type="text" class="form-control" name="usphone" value="<?= htmlspecialchars($data['usphone']) ?>">
</div>
<div class="form-group">
<label>ແຂວງ</label>
<select name="pro_id" class="form-control select2" id="pro_id" required>
<option value="">-- ເລືອກແຂວງ --</option>
<?php 
$stmt = $conn->prepare("SELECT pro_id, pro_name FROM province ORDER BY pro_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
$selected = ($row['pro_id'] == $data['pro_id']) ? 'selected' : '';
echo "<option value='{$row['pro_id']}' $selected>{$row['pro_name']}</option>";
}
$stmt->close();
?>
</select>
</div>
<div class="form-group">
<label>ເມືອງ</label>
<select name="dis_id" id="dis_id" class="form-control select2" required></select>
</div>
<div class="form-group">
<label>ບ້ານ</label>
<input type="text" class="form-control" name="v_name" id="v_name" value="<?= htmlspecialchars($data['v_name'] ?? '') ?>" placeholder="ກະລຸນາປ້ອນບ້ານເກີດ" required>
</div>
<div class="form-group">
<label>ຮູບພາບ</label>
<input type="file" id="img" name="img" class="form-control" accept="image/*">
<?php if (!empty($data['img'])): ?>
<br>
<img src="uploads/<?= $data['img'] ?>" width="100" id="preview">
<?php else: ?>
<img id="preview" src="#" width="100" style="display:none;">
<?php endif; ?>
</div>
</div>
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
<?php include('../../controllers/footer.php'); ?>
<script>
$(document).ready(function () {
$('.select2').select2({ width: '100%', placeholder: "-- ເລືອກ --", allowClear: true });

const proId = "<?= $data['pro_id'] ?>";
const disId = "<?= $data['dis_id'] ?>";

// โหลดเมืองตามจังหวัด
if (proId) {
$.post("ajax_db.php", { dis_id: proId, function: 'provinces' }, function (data) {
$('#dis_id').html(data);
$('#dis_id').val(disId).trigger('change');
});
}

// เปลี่ยนจังหวัด => โหลดเมืองใหม่
$('#pro_id').change(function () {
let dis_id = $(this).val();
$('#dis_id').html('<option value="">-- ເລືອກເມືອງ --</option>');
$('#v_name').val('');
$.post("ajax_db.php", { dis_id: dis_id, function: 'provinces' }, function (data) {
$('#dis_id').html(data).trigger('change');
});
});

// แสดง preview รูปภาพทันทีเมื่อเลือก
$('#img').on('change', function () {
const file = this.files[0];
if (file && file.type.startsWith('image/')) {
const reader = new FileReader();
reader.onload = function (e) {
$('#preview').attr('src', e.target.result).show();
};
reader.readAsDataURL(file);
} else {
$('#preview').hide();
}
});
});
</script>

