<?php include('../../controllers/head.php'); ?>
<?php
if(isset($_GET['r_id'])){
    $r_id = $_GET['r_id'];
    $user_id = $_SESSION['r_id'];
    include('../../condb.php');
    $sql = mysqli_query($conn,"DELETE FROM positions WHERE r_id ='$r_id' AND user_id='$user_id' ");
    if($sql){
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'ລົບຂໍ້ມູນກົມກອງສຳເລັດ',
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
<h3 class="card-title">ລາຍງານຂໍ້ມູນ ກຳນົດປີຂື້ນຊັ້ນ</h3>
<a href="form_add.php" class="btn btn-success float-right"><i class="icon fas fa-plus"></i> ເພີ່ມຂໍ້ມູນ</a>
</div>
<!-- /.card-header -->
<div class="card-body">
   <table id="example1" class="table table-bordered table-hover">
<thead>
<tr>
<th>ລຳດັບ</th>
<th>ຮູບຊັ້ນ</th>
<th>ຊັ້ນ</th>
<th>ຊື່ແລະນາມສະກຸນ</th>
<th>ອາຍູ</th>
<th>ວັນເດືອນເລື່ອນຊັ້ນ</th>
<th>ວັນເດືອນປີຍົກຍ້າຍ</th>
<th>ອາຍຸຊັ້ນ</th>
<th>ກຳນົດເລື່ອນຊັ້ນ</th>

<?php if($_SESSION['role']=="admin"){ ?>
<th>ຄຳສັ່ງ</th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php 
$i = 1;
include('../../condb.php');
$stmt = $conn->prepare("SELECT a.*,b.*,c.*,d.* FROM positions_level as a, rank_position as b,officers as c,level_up as d where a.l_id=b.l_id and a.l_id=d.l_id and c.officer_id=d.officer_id; ");
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) { ?>
<tr>
<td><?= $i++ ?></td>
<td><img src="../../form/positions_level/uploads/<?= htmlspecialchars($row['l_img']) ?>" alt="" style="width:100; height:80px;"></td>
<td><?= htmlspecialchars($row['l_name']) ?></td>
<td><?= htmlspecialchars($row['full_name']) ?></td>
<td><?= htmlspecialchars($row['age']) ?></td>
<td><?= htmlspecialchars($row['level_date']) ?></td>
<td><?= htmlspecialchars($row['date_office']) ?></td>
<td><?= htmlspecialchars($row['r_years']) ?>ປີ <?= htmlspecialchars($row['r_month']) ?>ເດືອນ</td>

<td></td>
<?php if ($_SESSION['role'] == "admin") { ?>
<td>
<a href="show_table.php?r_id=<?= $row['r_id'] ?>" class="btn btn-danger btn-sm delete">
<i class="fas fa-trash"></i> ລົບ
</a>
<a href="edit.php?r_id=<?= $row['r_id'] ?>" class="btn btn-primary btn-sm edit">
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
