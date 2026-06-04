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
<h3 class="card-title">ລາຍງານຂໍ້ມູນ ພະນັກງານເລື່ອນຊັ້ນ</h3>
<a href="index.php" class="btn btn-success float-right"><i class="icon fas fa-plus"></i> ເພີ່ມຂໍ້ມູນ</a>
<button id="sendNotify" class="btn btn-success  float-right mr-2">
🚀 ກົດແຈ້ງ Telegram
</button>
</div>
<!-- /.card-header -->
<div id="result" class="mt-3"></div>
<div class="card-body">
<table id="example1" class="table table-bordered table-hover table-sm">
<thead>
<tr>
<th>ລຳດັບ</th>
<th>ຫ້ອງການ</th>
<th>ພະແນກ</th>
<th>ໜ່ວຍງານ</th>
<th>ໜ້າທີ່ຮັບຜິດຊອບ</th>

<th>ຊັ້ນ</th>
<th>ຊື່ແລະນາມສະກຸນ</th>
<th>ອາຍູ</th>
<th>ວດປເລື່ອນຊັ້ນ</th>
<th>ອາຍຸຊັ້ນ</th>
<th>ກໍານົດອາຍຸການເລື່ອນຊັ້ນ</th>
<th>ໄລຍະເວລາຍັງເຫຼືອ</th>
<th>ວດປຍົກຍ້າຍ</th>
<?php if($_SESSION['role']=="admin"){ ?>
<th>ຄຳສັ່ງ</th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php 
$i = 1;
include('../../condb.php');
$stmt = $conn->prepare("
    SELECT 
        a.*, b.*, c.*, d.*, e.*, f.*, g.*, h.*
    FROM level_up AS d
    INNER JOIN (
        SELECT officer_id, MAX(level_id) AS max_level_id
        FROM level_up
        GROUP BY officer_id
    ) AS latest ON d.level_id = latest.max_level_id
    
    JOIN officers AS c ON c.officer_id = d.officer_id
    JOIN positions_level AS a ON d.l_id = a.l_id
    JOIN rank_position AS b ON a.l_id = b.l_id
    JOIN office AS e ON c.o_id = e.o_id
    JOIN panak AS f ON c.pk_id = f.pk_id
    JOIN positions AS g ON c.pt_id = g.pt_id
    JOIN units AS h ON c.u_id = h.u_id
    
");
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) { ?>
<tr>
<td><?= $i++ ?></td>


<td><?= htmlspecialchars($row['o_name']) ?></td>

<td><?= htmlspecialchars($row['pk_name']) ?></td>
<td><?= htmlspecialchars($row['u_name']) ?></td>
<td><?= htmlspecialchars($row['pt_name']) ?></td>

<td><?= htmlspecialchars($row['l_name']) ?></td>
<td><?= htmlspecialchars($row['full_name']) ?></td>

<td>
<?php
$birth_date =  $row['birth_date']; 
$today = new DateTime(); 
$birth = new DateTime($birth_date);

$interval = $birth->diff($today);

echo "{$interval->y} ປີ {$interval->m} ເດືອນ {$interval->d} ວັນ";
?>
</td>

<td><?= date('d/m/Y', strtotime($row['level_date'])) ?></td>
<td>

<?php
$last_promotion_date= $row['level_date'];
$today = new DateTime(); 
$promotion_date = new DateTime($last_promotion_date);
$interval = $promotion_date->diff($today);

echo "{$interval->y} ປີີ {$interval->m} ເດືອນ {$interval->d} ວັນ";
?>
</td>

<td><?= htmlspecialchars($row['r_years']) ?> ປີ <?= htmlspecialchars($row['r_month']) ?> ເດືອນ</td>

<td>   
<?php
if (!empty($row['level_date'])) {
    $last_date = new DateTime($row['level_date']);
    $l_id = (int)$row['l_id'];

    $stmt_level = $conn->prepare("SELECT r_years, r_month FROM rank_position WHERE l_id = ?");
    $stmt_level->bind_param("i", $l_id);
    $stmt_level->execute();
    $res_level = $stmt_level->get_result();
    $level_data = $res_level->fetch_assoc();

    if ($level_data) {
        $wait_y = (int)$level_data['r_years'];
        $wait_m = (int)$level_data['r_month'];

        $next_date = clone $last_date;
        $next_date->add(new DateInterval("P{$wait_y}Y{$wait_m}M"));

        $today = new DateTime();
        $diff = $today->diff($next_date);

        if ($today < $next_date) {
            echo "<button class='btn btn-warning btn-sm'> {$diff->y} ປີ {$diff->m} ເດືອນ {$diff->d} ວັນ</button>";
        } else {
            echo "<button class='btn btn-danger btn-sm text-white'>ຄົບກຳນົດແລ້ວ</button>";
        }
    } else {
        echo "<span class='text-danger'>ບໍ່ພົບຕຳແໜ່ງ</span>";
    }
} else {
    echo "<span class='text-danger'>ລະບູວັນທີກ່ອນ</span>";
}
?>

</td>
<td><?= date('d/m/Y', strtotime($row['date_office'])) ?></td>
<?php if ($_SESSION['role'] == "admin") { ?>
<td>
<a href="show_table.php?level_id=<?= $row['level_id'] ?>" class="btn btn-danger btn-sm delete">
<i class="fas fa-trash"></i> ລົບ
</a>
<a href="edit.php?level_id=<?= $row['level_id'] ?>" class="btn btn-primary btn-sm edit">
<i class="fas fa-edit"></i> ແກ້ໄຂ
</a>
<a href="detalls_officer_id.php?officer_id=<?= $row['officer_id'] ?>" class="btn btn-info btn-sm ">
<i class="ion-ios-eye"></i> ເປີດ
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
<script>
$(document).ready(function() {
$('#sendNotify').click(function() {
$('#result').html("⏳ ກຳລັງສົ່ງ...");
$.ajax({
url: "notify_send.php",
method: "POST",
data: { send_notify: true },
success: function(response) {
$('#result').html(response);
},
error: function(xhr, status, error) {
$('#result').html("❌ ສົ່ງ Telegram ບໍ່ສຳເລັດ");
}
});
});
});
</script>