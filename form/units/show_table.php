<?php include('../../controllers/head.php'); ?>
<?php
include('../../condb.php');

if (isset($_GET['u_id'])) {
$u_id = intval($_GET['u_id']);
$user_id = $_SESSION['user_id'];

$sql = mysqli_query($conn, "DELETE FROM units WHERE u_id = '$u_id' AND user_id = '$user_id' ");
if ($sql) {
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
<h3 class="card-title">ລາຍງານຂໍ້ມູນ ໜ່ວຍງານ</h3>
<a href="index.php" class="btn btn-success float-right"><i class="icon fas fa-plus"></i> ເພີ່ມຂໍ້ມູນ</a>
</div>

<div class="card-body">
<table id="example1" class="table table-bordered table-hover table-sm">
<thead>
<tr>
<th>ລຳດັບ</th>
<th>ກົມກອງ</th>
<th>ຫ້ອງການ</th>
<th>ພະແນກ</th>
<th>ໜ່ວຍງານ</th>
<?php if ($_SESSION['role'] == "admin") { ?>
<th>ຄຳສັ່ງ</th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php 
$i = 1;
$user_id = $_SESSION['user_id'];

$sql = "
SELECT 
u.u_id, u.u_name,
pk.pk_name,
o.o_name,
d.d_name
FROM units u
LEFT JOIN panak pk ON u.pk_id = pk.pk_id
LEFT JOIN office o ON u.o_id = o.o_id
LEFT JOIN department d ON u.d_id = d.d_id
WHERE u.user_id = ?
ORDER BY u.u_id DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
?>
<tr>
<td><?= $i++ ?></td>
<td><?= htmlspecialchars($row['d_name']) ?></td>
<td><?= htmlspecialchars($row['o_name']) ?></td>
<td><?= htmlspecialchars($row['pk_name']) ?></td>
<td><?= htmlspecialchars($row['u_name']) ?></td>

<?php if ($_SESSION['role'] == "admin") { ?>
<td>
<a href="show_table.php?u_id=<?= $row['u_id'] ?>" class="btn btn-danger btn-sm delete">
<i class="fas fa-trash"></i> ລົບ
</a>
<a href="edit.php?u_id=<?= $row['u_id'] ?>" class="btn btn-primary btn-sm edit">
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
</div>
</div>
</div>
</div>
<?php include('../../controllers/footer.php'); ?>
