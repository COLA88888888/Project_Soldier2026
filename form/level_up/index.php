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
    $updateStatus = $conn->prepare("UPDATE officers SET l_id = ?, o_id = ?, pk_id = ?, u_id = ?, pt_id = ? WHERE officer_id = ?");
    $updateStatus->bind_param("iiiiii", $l_id, $o_id, $pk_id, $u_id, $pt_id, $officer_id);
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
<label for="national_id">ລະຫັດບັດພະນັກງານ <span class="text-danger">*</span></label>
<input type="text" class="form-control" name="national_id" id="national_id" placeholder="ກະລຸນາປ້ອນລະຫັດບັດພະນັກງານ" autocomplete="off" required>
<input type="hidden" name="officer_id" id="officer_id" required>
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
<label>ຫ້ອງການ</label>
<input type="text" class="form-control bg-light" id="o_name" readonly placeholder="ສະແດງຂໍ້ມູນແບບAuto">
<input type="hidden" name="o_id" id="o_id" required>
</div>
<div class="form-group">
<label>ພະແນກ</label>
<input type="text" class="form-control bg-light" id="pk_name" readonly placeholder="ສະແດງຂໍ້ມູນແບບAuto">
<input type="hidden" name="pk_id" id="pk_id" required>
</div>
<div class="form-group">
<label>ໜ່ວຍງານ</label>
<input type="text" class="form-control bg-light" id="u_name" readonly placeholder="ສະແດງຂໍ້ມູນແບບAuto">
<input type="hidden" name="u_id" id="u_id" required>
</div>
<div class="form-group">
<label>ໜ້າທີ່ຮັບຜິດຊອບ</label>
<input type="text" class="form-control bg-light" id="pt_name" readonly placeholder="ສະແດງຂໍ້ມູນແບບAuto">
<input type="hidden" name="pt_id" id="pt_id" required>
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
    // Lookup by typing national_id
    $('#national_id').on('input', function() {
        var national_id = $(this).val().trim();
        if (national_id.length > 0) {
            $.post('get_officer_details.php', { national_id: national_id }, function(data) {
                if (data.status === 'success') {
                    $('#officer_id').val(data.officer_id);
                    $('#full_name').val(data.full_name);
                    $('#full_lastname').val(data.full_lastname);
                    $('#gender').val(data.gender);
                    $('#l_nameold').val(data.l_name);
                    $('#national_id').removeClass('is-invalid').addClass('is-valid');
                    
                    // Populate read-only text fields and hidden input values
                    $('#o_name').val(data.o_name);
                    $('#o_id').val(data.o_id);
                    $('#pk_name').val(data.pk_name);
                    $('#pk_id').val(data.pk_id);
                    $('#u_name').val(data.u_name);
                    $('#u_id').val(data.u_id);
                    $('#pt_name').val(data.pt_name);
                    $('#pt_id').val(data.pt_id);
                } else {
                    $('#officer_id').val('');
                    clearFieldsExceptSearch();
                    $('#national_id').removeClass('is-valid').addClass('is-invalid');
                }
            }, 'json');
        } else {
            $('#officer_id').val('');
            clearFieldsExceptSearch();
        }
    });

    function clearFieldsExceptSearch() {
        $('#full_name').val('');
        $('#full_lastname').val('');
        $('#gender').val('');
        $('#l_nameold').val('');
        
        $('#o_name').val('');
        $('#o_id').val('');
        $('#pk_name').val('');
        $('#pk_id').val('');
        $('#u_name').val('');
        $('#u_id').val('');
        $('#pt_name').val('');
        $('#pt_id').val('');
    }
});
</script>

<script>
$(document).ready(function() {
    $('#l_id').select2({
        width: '100%',
        placeholder: "-- ເລືອກ --",
        allowClear: true
    });
});
</script>