<?php include('../../controllers/head.php'); ?>
<?php
if(isset($_GET['level_id'])){
$level_id = intval($_GET['level_id']);
include('../../condb.php');
$sql = mysqli_query($conn,"DELETE FROM level_up WHERE level_id ='$level_id'");
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
<th>ຊື່ແລະນາມສະກຸນ</th>
<th>ຊັ້ນ</th>
<th>ຫ້ອງການ</th>
<th>ພະແນກ</th>
<th>ໜ່ວຍງານ</th>
<th>ໜ້າທີ່ຮັບຜິດຊອບ</th>

<th>ອາຍູ</th>
<th>ວດປເລື່ອນຊັ້ນ</th>
<th>ອາຍຸຊັ້ນ</th>
<th>ກໍານົດອາຍຸການເລື່ອນຊັ້ນ</th>
<th>ໄລຍະເວລາຍັງເຫຼືອ</th>
<th>ວດປຍົກຍ້າຍ</th>
<?php if($_SESSION['role']=="admin"){ ?>
<!-- <th>ຄຳສັ່ງ</th> -->
<?php } ?>
</tr>
</thead>
<tbody>
<?php 
$i = 1;
include('../../condb.php');
$officer_id = isset($_GET['officer_id']) ? intval($_GET['officer_id']) : 0;
$stmt = $conn->prepare("
    SELECT 
        d.level_id,
        d.officer_id,
        d.level_date,
        d.date_office,
        c.full_name,
        c.full_lastname,
        c.birth_date,
        c.gender,
        COALESCE(a.l_name, 'ບໍ່ມີຊັ້ນ') AS l_name,
        COALESCE(b.r_years, 0) AS r_years,
        COALESCE(b.r_month, 0) AS r_month,
        COALESCE(e.o_name, 'ບໍ່ມີ') AS o_name,
        COALESCE(f.pk_name, 'ບໍ່ມີ') AS pk_name,
        COALESCE(g.pt_name, 'ບໍ່ມີ') AS pt_name,
        COALESCE(h.u_name, 'ບໍ່ມີ') AS u_name
    FROM level_up AS d
    INNER JOIN officers AS c ON c.officer_id = d.officer_id
    LEFT JOIN positions_level AS a ON d.l_id = a.l_id
    LEFT JOIN rank_position AS b ON d.l_id = b.l_id
    LEFT JOIN office AS e ON COALESCE(d.o_id, c.o_id) = e.o_id
    LEFT JOIN panak AS f ON COALESCE(d.pk_id, c.pk_id) = f.pk_id
    LEFT JOIN positions AS g ON COALESCE(d.pt_id, c.pt_id) = g.pt_id
    LEFT JOIN units AS h ON COALESCE(d.u_id, c.u_id) = h.u_id
    WHERE d.officer_id = ?
    ORDER BY d.level_id DESC
");
$stmt->bind_param("i", $officer_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) { ?>
<tr>
<td><?= $i++ ?></td>

<td><?= htmlspecialchars($row['full_name'] . ' ' . $row['full_lastname']) ?></td>
<td><?= htmlspecialchars($row['l_name']) ?></td>
<td><?= htmlspecialchars($row['o_name']) ?></td>

<td><?= htmlspecialchars($row['pk_name']) ?></td>
<td><?= htmlspecialchars($row['u_name']) ?></td>
<td><?= htmlspecialchars($row['pt_name']) ?></td>

<td>
<?php
if (!empty($row['birth_date']) && strtotime($row['birth_date']) && $row['birth_date'] !== '0000-00-00') {
    $birth = new DateTime($row['birth_date']);
    $today = new DateTime(); 
    $interval = $birth->diff($today);
    echo "{$interval->y} ປີ {$interval->m} ເດືອນ {$interval->d} ວັນ";
} else {
    echo "-";
}
?>
</td>

<td><?= !empty($row['level_date']) ? date('d/m/Y', strtotime($row['level_date'])) : '-' ?></td>
<td>

<?php
if (!empty($row['level_date']) && strtotime($row['level_date']) && $row['level_date'] !== '0000-00-00') {
    $promotion_date = new DateTime($row['level_date']);
    $today = new DateTime(); 
    $interval = $promotion_date->diff($today);
    echo "{$interval->y} ປີ {$interval->m} ເດືອນ {$interval->d} ວັນ";
} else {
    echo "-";
}
?>
</td>

<td><?= htmlspecialchars($row['r_years']) ?> ປີ <?= htmlspecialchars($row['r_month']) ?> ເດືອນ</td>

<td>   
<?php
if (!empty($row['level_date']) && strtotime($row['level_date']) && $row['level_date'] !== '0000-00-00') {
    $wait_y = (int)$row['r_years'];
    $wait_m = (int)$row['r_month'];

    if ($wait_y == 0 && $wait_m == 0) {
        echo "<span class='badge badge-secondary'>ບໍ່ໄດ້ກຳນົດເກນ</span>";
    } else {
        $last_date = new DateTime($row['level_date']);
        $next_date = clone $last_date;
        $next_date->add(new DateInterval("P{$wait_y}Y{$wait_m}M"));

        $today = new DateTime();
        $diff = $today->diff($next_date);

        if ($today < $next_date) {
            echo "<button class='btn btn-warning btn-sm'> {$diff->y} ປີ {$diff->m} ເດືອນ {$diff->d} ວັນ</button>";
        } else {
            echo "<button class='btn btn-danger btn-sm text-white'>ຄົບກຳນົດແລ້ວ</button>";
        }
    }
} else {
    echo "<span class='text-danger'>ລະບູວັນທີກ່ອນ</span>";
}
?>

</td>
<td><?= (!empty($row['date_office']) && strtotime($row['date_office']) && $row['date_office'] !== '0000-00-00') ? date('d/m/Y', strtotime($row['date_office'])) : '-' ?></td>
<!-- <?php if ($_SESSION['role'] == "admin") { ?>
<td>
<a href="show_table.php?level_id=<?= $row['level_id'] ?>" class="btn btn-danger btn-sm delete">
<i class="fas fa-trash"></i> ລົບ
</a>
<a href="edit.php?level_id=<?= $row['level_id'] ?>" class="btn btn-primary btn-sm edit">
<i class="fas fa-edit"></i> ແກ້ໄຂ
</a>
<a href="detalls_officer_id.php?officer_id=<?= $row['officer_id'] ?>" class="btn btn-info btn-sm edit">
<i class="fas fa-edit"></i> ເປີດ
</a>
</td>
<?php } ?> -->
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