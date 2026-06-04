<?php include('../../controllers/head.php'); ?> 
<?php
include('../../condb.php');
if(isset($_POST['submit'])) {
$officer_id = $_POST['officer_id'];
$user_id = $_SESSION['user_id'];

if (!empty($_POST['name_level'])) {
foreach ($_POST['name_level'] as $i => $name_level) {
$paiy_in = $_POST['paiy_in'][$i];
$kanangvixah = $_POST['kanangvixah'][$i];
$ladub = $_POST['ladub'][$i];
$live_study = $_POST['live_study'][$i];
$study_year = $_POST['study_year'][$i];
$year_to_year = $_POST['year_to_year'][$i];
$lang_english = $_POST['lang_english'][$i];

$stmt = $conn->prepare("INSERT INTO educations 
(officer_id, name_level, paiy_in, kanangvixah, ladub, live_study, study_year, year_to_year, lang_english, user_id) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssssssi", 
$officer_id, $name_level, $paiy_in, $kanangvixah, $ladub, $live_study, $study_year, $year_to_year, $lang_english, $user_id
);
$stmt->execute();
}
echo "<script>
Swal.fire({
icon: 'success',
title: 'ບັນທຶກຂໍ້ມູນສຳເລັດ',
timer: 2000,
showConfirmButton: false
}).then(() => {
window.location = 'index.php'; 
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
<h3 class="card-title">ຟອມບັນທຶກ ການສືກສາ</h3>
</div>
<div class="card-body">
<div class="row">
<div class="col-sm-12">
<form  method="post" action="" enctype="multipart/form-data">

<div class="form-group">
<label for="officer_id">ລະຫັດບັດປະຈຳຕົວ</label>
<input type="number" class="form-control" name="officer_id" id="officer_id" required placeholder="ປ້ອນລະຫັດພະນັກງານ">
</div>

<table class="table table-bordered" id="educationTable">
<thead>
<tr>
<th>ລະດັບວິຊາສະເພາະ</th>
<th>ພາຍໃນ ຫຼື ຕ່າງປະເທດ</th>
<th>ຂະແໜງຮຽນ</th>
<th>ລະບົບ</th>
<th>ບ່ອນຮຽນຢູ່ໃສ</th>
<th>ໄລຍະເວລາຮຽນ</th>
<th>ປີໃດຫາປີໃດ</th>
<th>ພາສາຕ່າງປະເທດ</th>
<th>ລົບ</th>
</tr>
</thead>
<tbody id="eduBody">
<tr>
<td><input type="text" name="name_level[]" class="form-control" required></td>
<td><input type="text" name="paiy_in[]" class="form-control" required></td>
<td><input type="text" name="kanangvixah[]" class="form-control"></td>
<td>
<select name="ladub[]" id="ladub[]" class="form-control">
<option value="ກໍ່ສ້າງ">ກໍ່ສ້າງ</option>
<option value="ບຳລຸງ">ບຳລຸງ</option>
</select>
</td>
<td><input type="text" name="live_study[]" class="form-control"></td>
<td><input type="text" name="study_year[]" class="form-control"></td>
<td><input type="text" name="year_to_year[]" class="form-control"></td>
<td><input type="text" name="lang_english[]" class="form-control"></td>
<td><button type="button" class="btn btn-danger btn-sm removeRow">x</button></td>
</tr>
</tbody>
</table>
<button type="button" class="btn btn-danger" id="addRow">+ ເພີ່ມແຖວ</button>
<button type="submit" name="submit" class="btn btn-success">ບັນທຶກ</button>
</form>
</div>
</div>
</div>


</div>
</div>
</div>
</div>
<?php include('../../controllers/footer.php'); ?>
<script>
document.getElementById('addRow').addEventListener('click', function () {
var row = document.querySelector('#eduBody tr').cloneNode(true);
row.querySelectorAll('input').forEach(input => input.value = '');
document.getElementById('eduBody').appendChild(row);
});

document.getElementById('eduBody').addEventListener('click', function (e) {
if (e.target.classList.contains('removeRow')) {
var rows = document.querySelectorAll('#eduBody tr');
if (rows.length > 1) {
e.target.closest('tr').remove();
}
}
});
</script>

