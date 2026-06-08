<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');

if (isset($_POST['submit'])) {
$officer_id = trim($_POST['officer_id']);
$l_id = trim($_POST['l_id']);
$o_id = trim($_POST['o_id']);
$pk_id = trim($_POST['pk_id']);
$u_id = trim($_POST['u_id']);
$pt_id = trim($_POST['pt_id']);
$level_date = trim($_POST['level_date']);
$date_office = trim($_POST['date_office']);
$user_id = $_SESSION['user_id'];

$sql = $conn->prepare("INSERT INTO `level_up`( `officer_id`, `l_id`, `o_id`, `pk_id`, `u_id`, `pt_id`, `level_date`, `date_office`, `user_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$sql->bind_param("iiiiiissi", $officer_id, $l_id, $o_id, $pk_id, $u_id, $pt_id, $level_date, $date_office, $user_id);

if ($sql->execute()) {
$updateStatus = $conn->prepare("UPDATE officers SET l_id = ?, o_id = ?, pk_id = ?, u_id = ?, pt_id = ? WHERE officer_id = ? and user_id = ?");
$updateStatus->bind_param("iiiiiis", $l_id, $o_id, $pk_id, $u_id, $pt_id, $officer_id, $user_id);
if (!$updateStatus->execute()) {
    echo "Error UPDATE: " . $updateStatus->error;
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
<h3 class="card-title">ຟອມບັນທຶກ ພະນັກງານເລື່ອນຊັ້ນ</h3>
</div>
<form  method="POST" enctype="multipart/form-data">
<div class="card-body">
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for="officer_select">ຄົ້ນຫາ/ເລືອກພະນັກງານ <span class="text-danger">*</span></label>
<select class="form-control select2" id="officer_select" name="officer_id" required>
<option value="">-- ເລືອກພະນັກງານ --</option>
<?php 
$officers_query = $conn->query("SELECT o.officer_id, o.full_name, o.full_lastname, o.national_id, l.l_name 
                                FROM officers o 
                                LEFT JOIN positions_level l ON o.l_id = l.l_id 
                                WHERE o.system_status = 'ON' 
                                ORDER BY o.full_name ASC");
while ($o_row = $officers_query->fetch_assoc()) {
    $lbl = ($o_row['l_name'] ? $o_row['l_name'] . ' - ' : '') . $o_row['full_name'] . ' ' . $o_row['full_lastname'] . ' (' . $o_row['national_id'] . ')';
    echo '<option value="' . htmlspecialchars($o_row['officer_id']) . '">' . htmlspecialchars($lbl) . '</option>';
}
?>
</select>
</div>
<div class="form-group">
<label for="national_id">ລະຫັດບັດພະນັກງານ (ປ້ອນເພື່ອຄົ້ນຫາ)</label>
<input type="text" class="form-control" id="national_id" placeholder="ກະລຸນາປ້ອນ" autocomplete="off">
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
<label for="">ຊັ້ນເກົ່າ</label>
<input type="text" class="form-control" name="l_nameold" id="l_nameold" placeholder="ສະແດງຂໍ້ມູນແບບAuto" readonly>
</div>
<div class="form-group">
<label for="rank">ຊັ້ນໃໝ່</label>
<select name="l_id" class="form-control" id="l_id" >
<option value="">-- ເລືອກຊັ້ນ --</option>
<?php 
include('../../condb.php');
$stmt = $conn->prepare("SELECT *FROM positions_level ORDER BY l_name desc");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
echo '<option value="' . htmlspecialchars($row['l_id']) . '">' . htmlspecialchars($row['l_name']) . '</option>';
}
$stmt->close();
?>
</select>
</div> 
</div>  
<div class="col-sm-6">  
<div class="form-group">
<label for="o_id">ຫ້ອງການ</label>
<select name="o_id" class="form-control select2" id="o_id" >
<option value="">-- ເລືອກຫ້ອງການ --</option>
<?php 
include('../../condb.php');
$stmt = $conn->prepare("SELECT *FROM office ORDER BY o_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
echo '<option value="' . htmlspecialchars($row['o_id']) . '">' . htmlspecialchars($row['o_name']) . '</option>';
}
$stmt->close();
?>
</select>
</div>
<div class="form-group">
<label for="pk_id">ພະແນກ</label>
<select name="pk_id" class="form-control select2" id="pk_id" >
<option value="">-- ເລືອກພະແນກ --</option>
<?php 
include('../../condb.php');
$stmt = $conn->prepare("SELECT * FROM panak ORDER BY pk_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
echo '<option value="' . htmlspecialchars($row['pk_id']) . '">' . htmlspecialchars($row['pk_name']) . '</option>';
}
$stmt->close();
?>
</select>
</div>

<div class="form-group">
<label for="u_id">ໜ່ວຍງານ</label>
<select name="u_id" class="form-control select2" id="u_id" >
<option value="">-- ເລືອກໜ່ວຍງານ --</option>
<?php 
include('../../condb.php');
$stmt = $conn->prepare("SELECT *FROM units ORDER BY u_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
echo '<option value="' . htmlspecialchars($row['u_id']) . '">' . htmlspecialchars($row['u_name']) . '</option>';
}
$stmt->close();
?>
</select>
</div>  
<div class="form-group">
<label for="pt_id">ໜ້າທີ່ຮັບຜິດຊອບ</label>
<select name="pt_id" class="form-control" id="pt_id" >
<option value="">-- ເລືອກໜ້າທີ່ຮັບຜິດຊອບ --</option>
<?php 
include('../../condb.php');
$stmt = $conn->prepare("SELECT *FROM positions ORDER BY pt_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
echo '<option value="' . htmlspecialchars($row['pt_id']) . '">' . htmlspecialchars($row['pt_name']) . '</option>';
}
$stmt->close();
?>
</select>
</div> 
<div class="form-group">
<label for="">ວັນເດືອນປີເລື່ອນຊັ້ນ</label>
<input type="date" class="form-control" name="level_date" id="level_date" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="">ວັນເດືອນປີຍົກຍ້າຍ</label>
<input type="date" class="form-control" name="date_office" id="date_office" placeholder="ກະລຸນາປ້ອນ">
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
</div>
</div>
</div>
<?php include('../../controllers/footer.php'); ?>

<script type="text/javascript">
$(function(){
    // Select dropdown changes
    $('#officer_select').on('change', function() {
        var officer_id = $(this).val();
        if (officer_id) {
            $.post('get_officer_details.php', { officer_id: officer_id }, function(data) {
                if (data.status === 'success') {
                    $('#national_id').val(data.national_id);
                    $('#full_name').val(data.full_name);
                    $('#full_lastname').val(data.full_lastname);
                    $('#gender').val(data.gender);
                    $('#l_nameold').val(data.l_name);
                    $('#national_id').removeClass('is-invalid').addClass('is-valid');
                }
            }, 'json');
        } else {
            clearFields();
        }
    });

    // Lookup by typing national_id
    $('#national_id').on('input', function() {
        var national_id = $(this).val().trim();
        if (national_id.length > 0) {
            $.post('get_officer_details.php', { national_id: national_id }, function(data) {
                if (data.status === 'success') {
                    $('#officer_select').val(data.officer_id).trigger('change.select2');
                    $('#full_name').val(data.full_name);
                    $('#full_lastname').val(data.full_lastname);
                    $('#gender').val(data.gender);
                    $('#l_nameold').val(data.l_name);
                    $('#national_id').removeClass('is-invalid').addClass('is-valid');
                } else {
                    $('#officer_select').val('').trigger('change.select2');
                    clearFields();
                    $('#national_id').removeClass('is-valid').addClass('is-invalid');
                }
            }, 'json');
        } else {
            $('#officer_select').val('').trigger('change.select2');
            clearFields();
        }
    });

    function clearFields() {
        $('#national_id').val('').removeClass('is-valid is-invalid');
        $('#full_name').val('');
        $('#full_lastname').val('');
        $('#gender').val('');
        $('#l_nameold').val('');
    }
});
</script>


<script>
$(document).ready(function() {

$('#officer_select').select2({
width: '100%',
placeholder: "-- ເລືອກພະນັກງານ --",
allowClear: true
});

$('#o_id').select2({
width: '100%', // หรือ '100%'
placeholder: "-- ເລືອກ --",
allowClear: true
});
$('#d_id').select2({
width: '100%', // หรือ '100%'
placeholder: "-- ເລືອກ --",
allowClear: true
});

$('#u_id').select2({
width: '100%', // หรือ '100%'
placeholder: "-- ເລືອກ --",
allowClear: true
});

$('#pk_id').select2({
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
$('#pt_id').select2({
width: '100%', // หรือ '100%'
placeholder: "-- ເລືອກ --",
allowClear: true
});

$('#l_id').select2({
width: '100%', // หรือ '100%'
placeholder: "-- ເລືອກ --",
allowClear: true
});


});
</script>

<script>
$('#d_id').change(function(){
var d_id  = $(this).val();
$.ajax({
type: "post",
url: "ajax_sungkud.php",
data:{d_id  :d_id  ,function:'d_id'},
success: function(data){
$('#o_id').html(data);
}
});
});
$('#o_id').change(function(){
var o_id  = $(this).val();
$.ajax({
type: "post",
url: "ajax_sungkud.php",
data:{o_id  :o_id  ,function:'o_id'},
success: function(data){
$('#pk_id').html(data);
}
});
});

$('#pk_id').change(function(){
var pk_id  = $(this).val();
$.ajax({
type: "post",
url: "ajax_sungkud.php",
data:{pk_id  :pk_id  ,function:'pk_id'},
success: function(data){
$('#u_id').html(data);
}
});
});
</script>