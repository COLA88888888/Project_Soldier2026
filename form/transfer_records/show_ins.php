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
<h3 class="card-title">ລາຍງານຂໍ້ມູນ ພະນັກງານ-ຍ້າຍເຂົ້າ</h3>
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
<th>ສະຖານະ</th>
<th>ຫ້ອງການໃດ</th>
<th>ລົງວັນທີ</th>
<th>ເບີໂທ</th>
<th>ໝາຍເຫດ</th>
<th>ເພີ່ມເຕີມ</th>
<?php if($_SESSION['role']=="admin"){ ?>
<th>ຄຳສັ່ງ</th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php
$i = 1;
include('../../condb.php');

$sql = "SELECT 
    e.tran_id,
    e.transfer_tyep,
    e.radson,
    e.number,
    e.transfer_date,
    e.phone,
    e.remark,
    c.officer_id,
    c.full_name,
    c.full_lastname,
    c.gender,
    pl.l_name,
    rp.r_years,
    rp.r_month
FROM transfer_records AS e
INNER JOIN officers AS c ON e.officer_id = c.officer_id
INNER JOIN (
    SELECT lu.*
    FROM level_up lu
    INNER JOIN (
        SELECT officer_id, MAX(level_date) AS max_date
        FROM level_up
        GROUP BY officer_id
    ) x ON lu.officer_id = x.officer_id AND lu.level_date = x.max_date
) d ON d.officer_id = c.officer_id
INNER JOIN positions_level AS pl ON pl.l_id = d.l_id
LEFT JOIN (
    SELECT r1.*
    FROM rank_position r1
    INNER JOIN (
        SELECT l_id, MAX(r_years * 12 + r_month) AS max_months
        FROM rank_position
        GROUP BY l_id
    ) r2 ON r1.l_id = r2.l_id AND (r1.r_years * 12 + r1.r_month) = r2.max_months
) rp ON rp.l_id = pl.l_id
WHERE e.transfer_tyep = 'IN'
ORDER BY e.transfer_date DESC;
";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo '<tr><td colspan="11" class="text-center text-muted py-3">ບໍ່ພົບຂໍ້ມູນ</td></tr>';
} else {
    while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= htmlspecialchars($row['l_name']) ?></td>
            <td><?= htmlspecialchars($row['full_name']) ?></td>
            <td><?= htmlspecialchars($row['full_lastname']) ?></td>
            <td><?= htmlspecialchars($row['gender']) ?></td>
            <td><?= htmlspecialchars($row['transfer_tyep']) ?></td>
            <td><?= htmlspecialchars($row['radson']) ?></td>
            <td><?= htmlspecialchars($row['number']) ?></td>
            <td><?= htmlspecialchars($row['transfer_date']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['remark']) ?></td>

            <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === "admin") { ?>
            <td>
                <a href="show_table.php?tran_id=<?= (int)$row['tran_id'] ?>" class="btn btn-danger btn-sm delete">
                    <i class="fas fa-trash"></i> ລົບ
                </a>
                <a href="edit.php?tran_id=<?= (int)$row['tran_id'] ?>" class="btn btn-primary btn-sm edit">
                    <i class="fas fa-edit"></i> ແກ້ໄຂ
                </a>
            </td>
            <?php } ?>
        </tr>
<?php }
}
$stmt->close();
?>

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
