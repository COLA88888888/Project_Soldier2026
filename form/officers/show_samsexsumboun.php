<?php include('../../controllers/head.php'); ?>
<?php
if(isset($_GET['officer_id'])){
$officer_id = $_GET['officer_id'];
$user_id = $_SESSION['user_id'];
include('../../condb.php');
$sql = mysqli_query($conn,"DELETE FROM officers WHERE officer_id ='$officer_id' AND user_id='$user_id' ");
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
<h3 class="card-title">ລາຍງານຂໍ້ມູນ ປະຫວັດພະນັກງານ</h3>
<a href="index.php" class="btn btn-success float-right"><i class="icon fas fa-plus"></i> ເພີ່ມຂໍ້ມູນ</a>
</div>
<!-- /.card-header -->
<div class="card-body">
<table id="example1" class="table table-bordered table-hover table-sm">
<thead>
<tr>
<th>ລຳດັບ</th>
<th>ກົມກອງ</th>
<th>ຫ້ອງ</th>
<th>ພະແນກ</th>
<th>ໜ່ວຍງານ</th>
<th>ໜ້າທີ່ຕຳແໜ່ງ</th>
<th>ເລກລະຫັດບັດປະຈຳຕົວ</th>
<th>ຊັ້ນ</th>
<th>ຊື່ແລະນາມສະກຸນ</th>
<th>ເພດ</th>
<th>ວດປເກີດ</th>
<th>ວດປເຂົ້າຕຳຫຼວດ</th>
<th>ບ້ານ</th>
<th>ເມືອງ</th>
<th>ແຂວງ</th>
<th>ເອກະສານ</th>
<?php if($_SESSION['role']=="admin"){ ?>
<th>ຄຳສັ່ງ</th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php 
$i = 1;
include('../../condb.php');
$stmt = $conn->prepare("SELECT 
  a.*, 
  b.*, 
  c.*, 
  d.*, 
  e.*, 
  f.*, 
  g.*,
  p.*,
  di.*,
  v.*
FROM officers AS a
INNER JOIN department AS b ON a.d_id = b.d_id
INNER JOIN units AS c ON a.u_id = c.u_id
INNER JOIN panak AS d ON a.pk_id = d.pk_id
INNER JOIN office AS g ON a.o_id = g.o_id
INNER JOIN positions_level AS e ON a.l_id = e.l_id
INNER JOIN positions AS f ON a.pt_id = f.pt_id
INNER JOIN province AS p ON a.pro_id = p.pro_id
INNER JOIN distict AS di ON a.dis_id = di.dis_id
INNER JOIN village AS v ON a.v_id = v.v_id where a.date_join

");
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) { 
$fileLink = '';
if (!empty($row['file_document'])) {
$file = $row['file_document'];
$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

if ($ext === 'pdf') {
$fileLink = "
<a href='documents/{$file}' target='_blank' class='btn btn-success btn-sm'><i class='fas fa-file-pdf'></i> ເປີດ</a>";
} else {
$fileLink = "<a href='documents/{$file}' class='btn btn-success btn-sm' target='_blank'><i class='fas fa-download'></i> ດາວໂຫຼດ</a>";
}
}

?>
<tr>
<td><?= $i++ ?></td>

<td><?= htmlspecialchars($row['d_name']) ?></td>
<td><?= htmlspecialchars($row['u_name']) ?></td>
<td><?= htmlspecialchars($row['pk_name']) ?></td>
<td><?= htmlspecialchars($row['o_name']) ?></td>
<td><?= htmlspecialchars($row['pt_name']) ?></td>
<td><?= htmlspecialchars($row['national_id']) ?></td>
<td><?= htmlspecialchars($row['l_name']) ?></td>
<td><?= htmlspecialchars($row['full_name']) ?> <?= htmlspecialchars($row['full_lastname']) ?></td>
<td><?= htmlspecialchars($row['gender']) ?></td>
<td><?= date('d/m/Y', strtotime($row['birth_date'])) ?></td>
<td><?= date('d/m/Y', strtotime($row['date_join_police'])) ?></td>
<td><?= htmlspecialchars($row['current_village']) ?></td>
<td><?= htmlspecialchars($row['current_district']) ?></td>
<td><?= htmlspecialchars($row['current_province']) ?></td>
<td><?= $fileLink ?></td>
<?php if ($_SESSION['role'] == "admin") { ?>
<td>
<div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
   <i class="fas fa-cog"></i> ຄຳສັ່ງ
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="people_print.php?officer_id=<?= $row['officer_id'] ?>"><i class="ion-ios-printer text-success"></i> ພີມ</a>
    <a class="dropdown-item" href="show_table.php?officer_id=<?= $row['officer_id'] ?>"><i class="fas fa-trash text-danger"></i> ລົບ</a>
    <a class="dropdown-item" href="edit.php?officer_id=<?= $row['officer_id'] ?>"><i class="fas fa-edit text-primary"></i> ແກ້ໄຂ</a>
  </div>
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
