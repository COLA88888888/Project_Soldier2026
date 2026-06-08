<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');

if (isset($_POST['submit'])) {
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$password_hash = hash('sha512', trim($password));
$role = trim($_POST['role']);
$name = trim($_POST['name']);
$dob_date = trim($_POST['dob_date']);
$gender = trim($_POST['gender']);
$pro_id = trim($_POST['pro_id']);
$dis_id = trim($_POST['dis_id']);
$v_id = trim($_POST['v_id']);
$email = trim($_POST['email']);
$usphone = trim($_POST['usphone']);
$created_at = date('Y-m-d H:i:s');
$img = '';

// ✅ จัดการรูปภาพ
if (!empty($_FILES['img']['name'])) {
$ext2 = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
$img = uniqid('img_') . '.' . $ext2;
move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/' . $img);
}

// ✅ ตรวจสอบชื่อซ้ำ
$check = $conn->prepare("SELECT username FROM users WHERE username = ? AND user_id = ?");
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
// ✅ เพิ่มข้อมูล
$sql = $conn->prepare("INSERT INTO `users` (`username`, `password`, `role`, `name`, `dob_date`, `gender`, `pro_id`, `dis_id`, `v_id`, `email`, `usphone`, `img`, `created_at`) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$sql->bind_param("ssssssiiissss", $username, $password_hash, $role, $name, $dob_date, $gender, $pro_id, $dis_id, $v_id, $email, $usphone, $img, $created_at);

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

<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">ຟອມບັນທຶກຜູ້ໃຊ້ລະບົບ</h3>
</div>
<form  method="POST" enctype="multipart/form-data">
<div class="card-body">
<div class="row">
<div class="col-sm-6">

<div class="form-group">
<label for="d_name">ຊື່ແລະນາມສະກຸນ</label>
<input type="text" class="form-control" name="name" id="name" placeholder="ກະລຸນາປ້ອນຊື່ແລະນາມສະກຸນ">
</div>
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເກີດ</label>
<input type="date" class="form-control" name="dob_date" id="dob_date" placeholder="ວັນເດືອນປີເກີດ">
</div>
<div class="form-group">
<label for="d_name">ເພດ</label>
<select name="gender" id="gender" class="form-control">
<option value="">-- ເລືອກເພດ --</option>
<option value="ຊາຍ">ຊາຍ</option>
<option value="ຍິງ">ຍິງ</option>
</select>
</div>
<div class="form-group">
<label for="d_name">ຊື່ຜູ້ໃຊ້ລະບົບ</label>
<input type="text" class="form-control" name="username" id="username" placeholder="ກະລຸນາປ້ອນຊື່ຜູ້ໃຊ້ລະບົບ">
</div>
<div class="form-group">
<label for="d_name">ລະຫັດຜ່ານ</label>
<input type="password" class="form-control" name="password" id="password" placeholder="ກະລຸນາປ້ອນລະຫັດຜ່ານ">
</div>
<div class="form-group">
<label for="role">ສະຖານະ</label>
<select name="role" id="role" class="form-control">
<option value="">-- ເລືອກສະຖານະ --</option>
<option value="admin">ແອັດມິນ</option>
<option value="user">ພະນັກງານ</option>
</select>
</div>
</div> 
<div class="col-sm-6">
<div class="form-group">
<label for="d_name">ອີເມວ</label>
<input type="text" class="form-control" name="email" id="email" placeholder="ກະລຸນາປ້ອນອີເມວ">
</div>
<div class="form-group">
<label for="d_name">ເບີໂທ</label>
<input type="text" class="form-control" name="usphone" id="usphone" placeholder="ກະລຸນາປ້ອນເບີໂທ">
</div>
<div class="form-group">
<label for="">ແຂວງ</label>
<select name="pro_id" class="form-control select2" id="pro_id" >
<option value="">-- ເລືອກແຂວງ --</option>
<?php 
include('../../condb.php');
$stmt = $conn->prepare("SELECT pro_id, pro_name FROM province ORDER BY pro_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
echo '<option value="' . htmlspecialchars($row['pro_id']) . '">' . htmlspecialchars($row['pro_name']) . '</option>';
}
$stmt->close();
?>
</select>
</div>
<div class="form-group">
<label for="d_name">ເມືອງເກີດ</label>
<select name="dis_id" class="form-control select2" id="dis_id" required></select>
</div> 
<div class="form-group">
<label for="d_name">ບ້ານເກີດ</label>
<select name="v_id" class="form-control select2" id="v_id" ></select>
</div> 
<div class="form-group">
<label for="d_name">ຮູບພາບ</label>
<input type="file" id="img" name="img" class="form-control" accept="image/*">
</div>
<br>
<img id="preview" src="" width="100" style="display:none;">   
</div>
</div>
<div class="card-footer text-center">
<button type="submit" name="submit" class="btn btn-primary"><i class="ion-android-add"></i> ບັນທຶກ</button>
<button type="reset" class="btn btn-danger"> <i class="ion-android-refresh"></i> ຍົກເລີກ</button>
</div>
</form>
</div>
<div id="show"></div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('../../controllers/footer.php'); ?>
<script>
$('#img').on('change', function() {
const file = this.files[0];
if (file && file.type.startsWith('image/')) {
const reader = new FileReader();
reader.onload = function(e) {
$('#preview').attr('src', e.target.result).show();
}
reader.readAsDataURL(file);
} else {
$('#preview').hide();
}
});
</script>

<script>
$(document).ready(function() {

$('#pro_id').select2({
width: '100%', // หรือ '100%'
placeholder: "-- ເລືອກ --",
allowClear: true
});

$('#dis_id').select2({
width: '100%', // หรือ '100%'
placeholder: "-- ເລືອກ --",
allowClear: true
});
$('#v_id').select2({
width: '100%', // หรือ '100%'
placeholder: "-- ເລືອກ --",
allowClear: true
});

});
</script>

<script>
$('#pro_id').change(function(){
  var pro_id = $(this).val();
  // รีเซ็ตตัวเลือกเมืองและบ้านเป็นค่าเริ่มต้นก่อน
  $('#dis_id').html('<option value="">-- ເລືອກເມືອງ --</option>').trigger('change');
  $('#v_id').html('<option value="">-- ເລືອກບ້ານ --</option>').trigger('change');
  
  if (pro_id) {
    $.ajax({
      type: "post",
      url: "ajax_db.php",
      data: {dis_id: pro_id, function: 'provinces'},
      success: function(data){
        $('#dis_id').html(data).trigger('change');
      }
    });
  }
});
</script>

<script>
$('#dis_id').change(function(){
  var dis_id = $(this).val();
  // รีเซ็ตตัวเลือกบ้านก่อน
  $('#v_id').html('<option value="">-- ເລືອກບ້ານ --</option>').trigger('change');
  
  if (dis_id) {
    $.ajax({
      type: "post",
      url: "ajax_db.php",
      data: {dis_id: dis_id, function: 'districts'},
      success: function(data){
        $('#v_id').html(data).trigger('change');
      }
    });
  }
});
</script>
