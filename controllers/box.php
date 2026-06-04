

<section class="content">
<div class="container-fluid">
<!-- Small boxes (Stat box) -->
<div class="row">
<?php 
include('../../condb.php');
$stmt = $conn->prepare("SELECT *FROM panak ");
$stmt->execute();
$result = $stmt->get_result();
while ($rowbox = $result->fetch_assoc()) {
$pk_id = $rowbox['pk_id'];
    ?>
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box bg-primary">
<div class="inner">
<h6><?php echo $rowbox['pk_name']; ?></h6>
 <?php  
include('../../condb.php');
$sql1 = "SELECT COUNT(*) as totaltwo,pk_id FROM officers WHERE pk_id = '$pk_id' "; // Assuming o_id = 1 is the main office
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$totaltwo = $row1['totaltwo'];
$sql2 = "SELECT COUNT(*) as mans FROM officers where gender='ຊາຍ' and pk_id = '$pk_id' "; // Assuming o_id = 1 is the main office
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$totalman3 = $row2['mans'];
$sql3 = "SELECT COUNT(*) as women FROM officers where gender='ຍິງ' and pk_id = '$pk_id' "; // Assuming o_id = 1 is the main office
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$totalwomen = $row3['women'];
?> 
<p class="text-white">[ ຍິງ: <?= $totalwomen; ?> || ຊາຍ: <?= $totalman3; ?> ] = <?= $totaltwo;?> ສະຫາຍ </p>
</div>
<div class="icon">
<i class="ion-android-contacts"></i>
</div>
<a href="../../form/positions_level/position_level.php?pk_id=<?php echo $pk_id; ?>" class="small-box-footer">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

<?php } $stmt->close(); ?>
<!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->

<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>



<section class="content">
<div class="container-fluid">
<!-- Small boxes (Stat box) -->
<div class="row">
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box " style="background-color:#e83e8c" >
<div class="inner">
<h5 class="text-white"> ພະນັກງານທັງໝົດ</h5>
<?php  
include('../../condb.php');
$sql = "SELECT COUNT(*) as totalalls FROM officers "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$rowalls = mysqli_fetch_assoc($result);
$totalalls = $rowalls['totalalls'];
$sql = "SELECT COUNT(*) as mans FROM officers where gender='ຊາຍ' "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalman = $row['mans'];
$sql = "SELECT COUNT(*) as women FROM officers where gender='ຍິງ' "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalwomen = $row['women'];
?>
<p class="text-white">[ ຍິງ: <?= $totalwomen; ?> || ຊາຍ:<?= $totalman; ?> ] = <?= $totalalls;?> ສະຫາຍ </p>
</div>
<div class="icon">
<i class="ion-ios-people"></i>
</div>
<a href="../../form/officers/show_table.php" class="small-box-footer">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box " style="background-color:#605ca8">
<div class="inner">
<h5 class="text-white">ສາມະຊີກພັກສຳຮອງ<sup style="font-size: 20px"></sup></h5>
<?php  
include('../../condb.php');
$sql = "SELECT COUNT(*) as totalalls FROM officers where date_join_party "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$rowh = mysqli_fetch_assoc($result);
$totalalls = $rowh['totalalls'];
$sql = "SELECT COUNT(*) as mans FROM officers where gender='ຊາຍ' and date_join_party "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalman = $row['mans'];
$sql = "SELECT COUNT(*) as women FROM officers where gender='ຍິງ' and date_join_party "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalwomen = $row['women'];
?>
<p class="text-white">[ ຍິງ: <?= $totalwomen; ?> || ຊາຍ:<?= $totalman; ?> ] = <?= $totalalls;?> ສະຫາຍ </p>

</div>
<div class="icon">
<i class="ion-ios-lightbulb-outline"></i>
</div>
<a href="../../form/officers/show_samsexsumhong.php" class="small-box-footer">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box " style="background-color:#f012be">
<div class="inner">
<h5 class="text-white">ສາມະຊີກພັກສົມບູນ</h5>
<?php  
include('../../condb.php');
$sql = "SELECT COUNT(*) as totalalls FROM officers where date_join "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$rowb = mysqli_fetch_assoc($result);
$totalalls = $rowb['totalalls'];
$sql = "SELECT COUNT(*) as mans FROM officers where gender='ຊາຍ' and date_join "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalman = $row['mans'];
$sql = "SELECT COUNT(*) as women FROM officers where gender='ຍິງ' and date_join "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalwomen = $row['women'];
?>
<p class="text-white">[ ຍິງ: <?= $totalwomen; ?> || ຊາຍ:<?= $totalman; ?> ] = <?= $totalalls;?> ສະຫາຍ </p>

</div>
<div class="icon">
<i class="ion-ribbon-b"></i>
</div>
<a href="../../form/officers/show_samsexsumhong.php" class="small-box-footer">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box " style="background-color:#e83e8c">
<div class="inner">
<h5 class="text-white">ພະນັກງານເລື່ອນຊັ້ນ</h5>
<?php  
include('../../condb.php');
$sql = "SELECT COUNT(DISTINCT officer_id) as totallevel_up FROM level_up";
$result = mysqli_query($conn, $sql);
$rowup = mysqli_fetch_assoc($result);
$totallevel_up = $rowup['totallevel_up'];
$sql = "SELECT COUNT(DISTINCT b.officer_id) as mans FROM officers as a,level_up as b where a.gender='ຊາຍ' and a.officer_id = b.officer_id"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalman = $row['mans'];
$sql = "SELECT COUNT(DISTINCT b.officer_id) as women FROM officers as a,level_up as b where a.gender='ຍິງ' and a.officer_id = b.officer_id"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalwomen = $row['women'];
?>
<p class="text-white">[ ຍິງ: <?= $totalwomen; ?> || ຊາຍ:<?= $totalman; ?> ] = <?= $totallevel_up;?> ສະຫາຍ </p>

</div>
<div class="icon">
<i class="ion-star"></i>
</div>
<a href="../../form/level_up/show_table.php" class="small-box-footer">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->

<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>

<section class="content">
<div class="container-fluid">
<!-- Small boxes (Stat box) -->
<div class="row">
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box " style="background-color:#d81b60" >
<div class="inner">
<h5 class="text-white">ຍ້າຍເຂົ້າ</h5>
<?php  
include('../../condb.php');
$sql = "SELECT COUNT(*) as totalin FROM transfer_records WHERE transfer_tyep = 'IN'"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$rowin = mysqli_fetch_assoc($result);
$totalin = $rowin['totalin'];
$sql = "SELECT COUNT(*) as mansin FROM officers as a,transfer_records as b where a.officer_id =b.officer_id and a.gender='ຊາຍ' and b.transfer_tyep = 'IN' "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$mansin = mysqli_fetch_assoc($result);
$totalman = $mansin['mansin'];
$sql = "SELECT COUNT(*) as womenin FROM officers as a,transfer_records as b where a.officer_id =b.officer_id and a.gender='ຍິງ' and  b.transfer_tyep = 'IN' "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$womenin = mysqli_fetch_assoc($result);
$totalwomen = $womenin['womenin'];
?>
<p class="text-white">[ ຍິງ: <?= $totalwomen; ?> || ຊາຍ:<?= $totalman; ?> ] = <?= $totalin;?> ສະຫາຍ </p>

</div>
<div class="icon">
<i class="ion-android-add"></i>
</div>
<a href="../../form/transfer_records/show_ins.php" class="small-box-footer">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box " style="background-color:#ff851b">
<div class="inner">
<h5 class="text-white">ຍ້າຍອອກ<sup style="font-size: 20px"></sup></h5>
<?php  
include('../../condb.php');
$sql = "SELECT COUNT(*) as totalout FROM transfer_records WHERE transfer_tyep = 'OUT'"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$totalout = mysqli_fetch_assoc($result);
$totalout = $totalout['totalout'];

$sql = "SELECT COUNT(*) as mansout FROM officers as a,transfer_records as b where a.officer_id =b.officer_id and a.gender='ຊາຍ' and b.transfer_tyep = 'OUT' "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$mansout = mysqli_fetch_assoc($result);
$totalmanout = $mansout['mansout'];
$sql = "SELECT COUNT(*) as womenout FROM officers as a,transfer_records as b where a.officer_id =b.officer_id and a.gender='ຍິງ' and  b.transfer_tyep = 'OUT' "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$womenout = mysqli_fetch_assoc($result);
$totalwomenout = $womenout['womenout'];
?>
<p class="text-white">[ ຍິງ: <?= $totalmanout; ?> || ຊາຍ:<?= $totalwomenout; ?> ] = <?= $totalout;?> ສະຫາຍ </p>

</div>
<div class="icon">
<i class="ion-android-remove"></i>
</div>
<a href="../../form/transfer_records/show_outs.php" class="small-box-footer">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box " style="background-color:#01ff70">
<div class="inner">
<h5 class="text-white">ອາຍູການປະຕິວັດ 10 ປີ</h5>
<?php  
include('../../condb.php');
$sql = "SELECT COUNT(*) AS total_10_years_up FROM officers WHERE TIMESTAMPDIFF(YEAR, date_join_revolution, CURDATE()) >= 10"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_10_years_up = $row['total_10_years_up'];

$sql = "SELECT COUNT(*) AS total_10man FROM officers WHERE TIMESTAMPDIFF(YEAR, date_join_revolution, CURDATE()) >= 10 and gender = 'ຊາຍ'"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_10_man = $row['total_10man'];
$sql = "SELECT COUNT(*) AS total_10woman FROM officers WHERE TIMESTAMPDIFF(YEAR, date_join_revolution, CURDATE()) >= 10 and gender = 'ຍິງ'"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_10_woman = $row['total_10woman'];
?>
<p class="text-white">[ ຍິງ: <?= $total_10_woman; ?> || ຊາຍ:<?= $total_10_man; ?> ] = <?= $total_10_years_up;?> ສະຫາຍ </p>

</div>
<div class="icon">
<i class="ion-android-calendar"></i>
</div>
<a href="../../form/officers/show_over65.php" class="small-box-footer">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box " style="background-color:#39cccc">
<div class="inner">
<h5 class="text-white">ຜູ້ໃຊ້ລະບົບ</h5>
<?php  
include('../../condb.php');
// $sql = "SELECT COUNT(*) AS total_retired_due FROM officers WHERE (gender = 'ຊາຍ' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 65)OR(gender = 'ຍິງ' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 55)"; // Assuming o_id = 1 is the main office

$sql = "SELECT COUNT(*) AS usersall FROM users"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$rowuser = mysqli_fetch_assoc($result);
$total_users = $rowuser['usersall'];

$sql = "SELECT COUNT(*) AS user_man FROM users where gender = 'ຊາຍ'"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$rowuserman = mysqli_fetch_assoc($result);
$totalu_man = $rowuserman['user_man'];
$sql = "SELECT COUNT(*) AS user_woman FROM users where gender = 'ຍິງ'"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$rowuserwoman = mysqli_fetch_assoc($result);
$totalu_women = $rowuserwoman['user_woman'];
?>
<p class="text-white">[ ຍິງ: <?= $totalu_women; ?> || ຊາຍ:<?= $totalu_man; ?> ] = <?= $total_users;?> ສະຫາຍ </p>

</div>
<div class="icon">
<i class="ion-person-stalker"></i>
</div>
<a href="../../form/users/show_table.php" class="small-box-footer">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->

<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>