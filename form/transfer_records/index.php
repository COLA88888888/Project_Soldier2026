<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');

if (isset($_POST['submit'])) {
$officer_id = trim($_POST['officer_id']);
$transfer_tyep = trim($_POST['transfer_tyep']);
$radson = trim($_POST['radson']);
$number = trim($_POST['number']);
$transfer_date = trim($_POST['transfer_date']);
$phone = trim($_POST['phone']);
$remark = trim($_POST['remark']);
$approved_by = $_POST['approved_by'];
$user_id = $_SESSION['user_id'];

$sql = $conn->prepare("INSERT INTO `transfer_records`(`officer_id`, `transfer_tyep`, `radson`, `number`, `transfer_date`, `phone`, `remark`, `approved_by`, `user_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$sql->bind_param("isssssssi", $officer_id, $transfer_tyep, $radson, $number, $transfer_date, $phone, $remark, $approved_by, $user_id);
if ($sql->execute()) {
if ($transfer_tyep === "OUT") {
$updateStatus = $conn->prepare("UPDATE officers SET system_status = 'OUT' WHERE officer_id = ? and user_id = ?");
$updateStatus->bind_param("ii", $officer_id, $user_id);
if (!$updateStatus->execute()) {
echo "Error UPDATE OUT: " . $updateStatus->error;
}
} elseif ($transfer_tyep === "IN") {
$updateStatus = $conn->prepare("UPDATE officers SET system_status = 'IN' WHERE officer_id = ? and user_id = ?");
$updateStatus->bind_param("ii", $officer_id, $user_id);
if (!$updateStatus->execute()) {
echo "Error UPDATE IN: " . $updateStatus->error;
}
}

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
?>

<?php include('../../controllers/menu_left.php'); ?>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid">

<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">ຟອມບັນທຶກ ພະນັກງານຍ້າຍເຂົ້າ-ຍ້າຍອອກ</h3>
</div>
<form  method="POST" enctype="multipart/form-data">
<div class="card-body">
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for="">ລະຫັດບັດພະນັກງານ</label>
<input type="text" class="form-control" name="national_id" id="national_id" placeholder="ກະລຸນາປ້ອນ">
<input type="hidden" class="form-control" name="officer_id" id="officer_id" placeholder="">
</div>
<div class="form-group">
<label for="">ຊື່</label>
<input type="text" class="form-control" name="full_name" id="full_name" placeholder="ສະແດງຂໍ້ມູນແບບAuto" readonly>
</div>

<div class="form-group">
<label for="">ນາມສະກຸນ</label>
<input type="text" class="form-control" name="full_lastname" id="full_lastname" placeholder="ສະແດງຂໍ້ມູນແບບAuto" readonly>
</div>
<div class="form-group">
<label for="">ເພດ</label>
<input type="text" class="form-control" name="gender" id="gender" placeholder="ສະແດງຂໍ້ມູນແບບAuto" readonly>
</div>
<div class="form-group">
<label for="">ຊັ້ນ</label>
<input type="text" class="form-control" name="l_nameold" id="l_nameold" placeholder="ສະແດງຂໍ້ມູນແບບAuto" readonly>
</div>
<div class="form-group">
<label for="rank">ເຫດຜົນ</label>
<select name="transfer_tyep" class="form-control" id="transfer_tyep" >
<option value="IN">ຍ້າຍເຂົ້າ</option>
<option value="OUT">ຍ້າຍອອກ</option>
</select>
</div> 

</div>
<div class="col-sm-6">

<div class="form-group">
<label for="">ຫ້ອງການໃດ</label>
<input type="text" class="form-control" name="radson" id="radson" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="">ເລກທີ</label>
<input type="text" class="form-control" name="number" id="number" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="">ລົງວັນທີ</label>
<input type="date" class="form-control" name="transfer_date" id="transfer_date" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="">ເບີໂທ</label>
<input type="text" class="form-control" name="phone" id="phone" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="">ໝາຍເຫດ</label>
<input type="text" class="form-control" name="remark" id="remark" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="">ເພີ່ມເຕີມ</label>
<input type="text" class="form-control" name="approved_by" id="approved_by" placeholder="ກະລຸນາປ້ອນ">
</div>
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
<?php include('../../controllers/footer.php'); ?>

<script type="text/javascript">
$(function(){

$('#national_id').keyup(function(){
var national_id = $('#national_id').val();
$.post('keyup_national_id.php', { national_id: national_id }, function(data){
$('#officer_id').val(data);
});
});

$('#national_id').keyup(function(){
var national_id = $('#national_id').val();
$.post('keyup_full_name.php', { national_id: national_id }, function(data){
$('#full_name').val(data);
});
});

$('#national_id').keyup(function(){
var national_id = $('#national_id').val();
$.post('keyup_full_lastname.php', { national_id: national_id }, function(data){
$('#full_lastname').val(data);
});
});

$('#national_id').keyup(function(){
var national_id = $('#national_id').val();
$.post('keyup_gender.php', { national_id: national_id }, function(data){
$('#gender').val(data);
});
});

$('#national_id').keyup(function(){
var national_id = $('#national_id').val();
$.post('keyup_l_nameold.php', { national_id: national_id }, function(data){
$('#l_nameold').val(data);
});
});

});
</script>

