<?php include('../../controllers/head.php'); ?>
<?php
if(isset($_GET['d_id'])){
$d_id = $_GET['d_id'];
$user_id = $_SESSION['user_id'];
include('../../condb.php');
$sql = mysqli_query($conn,"DELETE FROM department WHERE d_id ='$d_id' AND user_id='$user_id' ");
if($sql){
echo "<script>
Swal.fire({
icon: 'success',
title: 'ລົບຂໍ້ມູນສຳເລັດ',
showConfirmButton: false,
timer: 2000
}).then(() => {
location='show_table.php';
});
</script>";
} else {
echo "<script>
Swal.fire({
icon: 'error',
title: 'ຜິດພາດ',
showConfirmButton: false,
timer: 2000
}).then(() => {
location='show_table.php';
});
</script>";
}
}
?> 
<?php include('../../controllers/menu_left.php'); ?>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-header bg-primary">
<h3 class="card-title">ລາຍງານຂໍ້ມູນ ກົມກອງ</h3>
<a href="index.php" class="btn btn-success float-right"><i class="icon fas fa-plus"></i> ເພີ່ມຂໍ້ມູນ</a>
</div>
<!-- /.card-header -->
<div class="card-body">
<table id="example1" class="table table-bordered table-hover table-sm">
<thead>
<tr>
<th>ລຳດັບ</th>
<th>ຊື່ກົມກອງ</th>
<?php if($_SESSION['role']=="admin"){ ?>
<th>ຄຳສັ່ງ</th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php 
$i = 1;
include('../../condb.php');
$stmt = $conn->prepare("SELECT d_id, d_name FROM department ORDER BY d_id DESC");
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) { ?>
<tr>
<td><?= $i++ ?></td>
<td><?= htmlspecialchars($row['d_name']) ?></td>
<?php if ($_SESSION['role'] == "admin") { ?>
<td>
<a href="show_table.php?d_id=<?= $row['d_id'] ?>" class="btn btn-danger btn-sm delete">
<i class="fas fa-trash"></i> ລົບ
</a>
<a href="edit.php?d_id=<?= $row['d_id'] ?>" class="btn btn-primary btn-sm edit">
<i class="fas fa-edit"></i> ແກ້ໄຂ
</a>
</td>
<?php } ?>
</tr>
<?php } $stmt->close(); ?>
</tbody>
</table>
</div>
</div>
</div>
<!-- /.card-body -->
</div>
</div>
</div>
</div>
<?php include('../../controllers/footer.php'); ?>
