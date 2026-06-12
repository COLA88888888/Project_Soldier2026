<?php include('../../controllers/head.php'); ?>
<?php
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    include('../../condb.php');
    $sql = mysqli_query($conn, "DELETE FROM users WHERE user_id ='$user_id'  ");
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
<h3 class="card-title">ລາຍງານຂໍ້ມູນຜູ້ໃຊ້ລະບົບ</h3>
<a href="index.php" class="btn btn-success float-right"><i class="icon fas fa-plus"></i> ເພີ່ມຂໍ້ມູນ</a>
</div>
<div class="card-body">
<table id="example1" class="table table-bordered table-hover table-sm">
<thead>
<tr>
<th>ລຳດັບ</th>
<th>ຮູບພາບ</th>
<th>ຊື່ແລະນາມສະກຸນ</th>
<th>ວັນເດືອນປີເກີດ</th>
<th>ເພດ</th>
<th>ຊື່ຜູ້ໃຊ້ລະບົບ</th>
<th>ລະຫັດຜ່ານ</th>
<th>ສະຖານະ</th>
<th>ອີເມວ</th>
<th>ເບີໂທ</th>
<th>ແຂວງ</th>
<th>ເມືອງເກີດ</th>
<th>ບ້ານເກີດ</th>
<?php if ($_SESSION['role'] == "admin") { ?>
<th>ຄຳສັ່ງ</th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php
$i = 1;
include('../../condb.php');
$stmt = $conn->prepare("SELECT d.*, a.pro_name, b.dis_name, c.v_name FROM users as d LEFT JOIN village as c ON d.v_id = c.v_id LEFT JOIN distict as b ON d.dis_id = b.dis_id LEFT JOIN province as a ON d.pro_id = a.pro_id ORDER BY d.user_id DESC");
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) { ?>
<tr>
<td><?= $i++ ?></td>
 <td><img src="uploads/<?= htmlspecialchars($row['img']) ?>" alt="" width="50px" height="50px"></td>

<td><?= htmlspecialchars($row['name']) ?></td>
<td><?= htmlspecialchars($row['dob_date']) ?></td>
<td><?= htmlspecialchars($row['gender']) ?></td>
<td><?= htmlspecialchars($row['username']) ?></td>
<td><?php echo substr($row['password'],0,10); ?></td>
<td><?= htmlspecialchars($row['role']) ?></td>
<td><?= htmlspecialchars($row['email']) ?></td>
<td><?= htmlspecialchars($row['usphone']) ?></td>
<td><?= htmlspecialchars($row['pro_name']) ?></td>
<td><?= htmlspecialchars($row['dis_name']) ?></td>
<td><?= htmlspecialchars($row['v_name']) ?></td>
<?php if ($_SESSION['role'] == "admin") { ?>
<td>
<a href="show_table.php?user_id=<?= $row['user_id'] ?>" class="btn btn-danger btn-sm delete">
<i class="fas fa-trash"></i> ລົບ
</a>
<a href="edit.php?user_id=<?= $row['user_id'] ?>" class="btn btn-primary btn-sm edit">
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
