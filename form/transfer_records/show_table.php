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
<h3 class="card-title">ລາຍງານຂໍ້ມູນ ພະນັກງານຍ້າຍເຂົ້າ-ຍ້າຍອອກ</h3>
<a href="index.php" class="btn btn-success float-right"><i class="icon fas fa-plus"></i> ເພີ່ມຂໍ້ມູນ</a>
</div>
<!-- /.card-header -->
<div class="card-body">
   <table id="example1" class="table table-bordered table-hover table-sm">
<thead>
<tr>
<th>ລຳດັບ</th>
<th>ຊັ້ນ</th>
<th>ຊື່</th>
<th>ນາມສະກຸນ</th>
<th>ເພດ</th>

<th>ຫ້ອງການໃດ</th>
<th>ລົງວັນທີ</th>
<th>ເບີໂທ</th>
<th>ໝາຍເຫດ</th>
<th>ເພີ່ມເຕີມ</th>
<th>ສະຖານະ</th>
<?php if($_SESSION['role']=="admin"){ ?>
<th>ຄຳສັ່ງ</th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php 
$i = 1;
include('../../condb.php');
$stmt = $conn->prepare("SELECT a.*,b.*,c.*,d.*,e.* FROM positions_level as a, rank_position as b,officers as c,level_up as d,transfer_records as e where a.l_id=b.l_id and a.l_id=d.l_id and c.officer_id=d.officer_id and e.officer_id=c.officer_id;");
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) { ?>
<tr>
<td><?= $i++ ?></td>
<!-- <td><img src="../../form/positions_level/uploads/<?= htmlspecialchars($row['l_img']) ?>" alt="" style="width:100; height:80px;"></td> -->
<td><?= htmlspecialchars($row['l_name']) ?></td>
<td><?= htmlspecialchars($row['full_name']) ?></td>
<td><?= htmlspecialchars($row['full_lastname']) ?></td>
<td><?= htmlspecialchars($row['gender']) ?></td>

<td><?= htmlspecialchars($row['radson']) ?></td>
<td><?= date('d/m/Y', strtotime($row['transfer_date'])) ?></td>
<td><?= htmlspecialchars($row['phone']) ?></td>
<td><?= htmlspecialchars($row['remark']) ?></td>
<td><?= htmlspecialchars($row['number']) ?></td>
<td>
<?php if($row['transfer_tyep']=='IN'){ ?>
<span class="btn btn-success btn-sm"><i class="fas fa-arrow-right"></i></span>
<?php }elseif($row['transfer_tyep']=='OUT'){ ?>
<span class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"></i></span>
<?php } ?>
</td>
<?php if ($_SESSION['role'] == "admin") { ?>
<td>
<a href="show_table.php?tran_id=<?= $row['tran_id'] ?>" class="btn btn-danger btn-sm delete">
<i class="fas fa-trash"></i> ລົບ
</a>
<a href="edit.php?tran_id=<?= $row['tran_id'] ?>" class="btn btn-primary btn-sm edit">
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
