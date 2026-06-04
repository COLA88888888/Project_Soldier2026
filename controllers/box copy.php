

<section class="content">
<div class="container-fluid">
<!-- Small boxes (Stat box) -->
<div class="row">
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box bg-info">
<div class="inner">
<h5> ຄະນະຫ້ອງການ</h5>
<?php  
include('../../condb.php');
$sql = "SELECT COUNT(*) as totaltwo,pk_id FROM officers WHERE pk_id = 1"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row1 = mysqli_fetch_assoc($result);
$totaltwo = $row1['totaltwo'];
$sql = "SELECT COUNT(*) as mans FROM officers where gender='ຊາຍ' and pk_id = 1 "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalman = $row['mans'];
$sql = "SELECT COUNT(*) as women FROM officers where gender='ຍິງ' and pk_id = 1 "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalwomen = $row['women'];
?>
<p class="text-white">[ ຍິງ: <?= $totalwomen; ?> || ຊາຍ: <?= $totalman; ?> ] = <?= $totaltwo;?> ສະຫາຍ </p>
</div>
<div class="icon">
<i class="ion-android-contacts"></i>
</div>
<a href="../../form/officers/show_one.php?pk_id=<?php echo $row1['pk_id']; ?>" class="small-box-footer">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box bg-success">
<div class="inner">
<h5>ພົວພັນຕ່າງປະເທດ<sup style="font-size: 20px"></sup></h5>

<?php  
include('../../condb.php');
$sql = "SELECT COUNT(*) as totaltwo,pk_id FROM officers WHERE pk_id = 2"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row2 = mysqli_fetch_assoc($result);
$totaltwo = $row2['totaltwo'];
$sql = "SELECT COUNT(*) as mans FROM officers where gender='ຊາຍ' and pk_id = 2 "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalman = $row['mans'];
$sql = "SELECT COUNT(*) as women FROM officers where gender='ຍິງ' and pk_id = 2 "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalwomen = $row['women'];
?>
<p class="text-white">[ ຍິງ: <?= $totalwomen; ?> || ຊາຍ: <?= $totalman; ?> ] = <?= $totaltwo;?> ສະຫາຍ </p>
</div>
<div class="icon">
<i class="ion-android-contacts"></i>
</div>
<a href="../../form/officers/show_two.php?pk_id=<?php echo $row2['pk_id']; ?>" class="small-box-footer">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box bg-warning">
<div class="inner">
<h5>ເອກະສານຂາເຂົ້າ-ຂາອອກ</h5>
<?php  
include('../../condb.php');
$sql = "SELECT COUNT(*) as totaltwo,pk_id FROM officers WHERE pk_id = 3"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row3 = mysqli_fetch_assoc($result);
$totaltwo = $row3['totaltwo'];
$sql = "SELECT COUNT(*) as mans FROM officers where gender='ຊາຍ' and pk_id = 3 "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalman = $row['mans'];
$sql = "SELECT COUNT(*) as women FROM officers where gender='ຍິງ' and pk_id = 3 "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalwomen = $row['women'];
?>
<p class="text-white">[ ຍິງ: <?= $totalwomen; ?> || ຊາຍ: <?= $totalman; ?> ] = <?= $totaltwo;?> ສະຫາຍ </p>
</div>
<div class="icon">
<i class="ion-android-document"></i>
</div>
<a href="../../form/officers/show_three.php?pk_id=<?php echo $row3['pk_id']; ?>" class="small-box-footer text-white">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box bg-danger">
<div class="inner">
<h5>ບໍລິຫານ-ຈັດຕັ້ງ</h5>
<?php  
include('../../condb.php');
$sql = "SELECT COUNT(*) as totaltwo,pk_id FROM officers WHERE pk_id = 4"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row4 = mysqli_fetch_assoc($result);
$totaltwo = $row4['totaltwo'];
$sql = "SELECT COUNT(*) as mans FROM officers where gender='ຊາຍ' and pk_id = 4 "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalman = $row['mans'];
$sql = "SELECT COUNT(*) as women FROM officers where gender='ຍິງ' and pk_id = 4 "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalwomen = $row['women'];
?>
<p class="text-white">[ ຍິງ: <?= $totalwomen; ?> || ຊາຍ: <?= $totalman; ?> ] = <?= $totaltwo;?> ສະຫາຍ </p>
</div>
<div class="icon">
<i class="ion-android-people"></i>
</div>
<a href="../../form/officers/show_four.php?pk_id=<?php echo $row4['pk_id']; ?>" class="small-box-footer">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
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
<div class="small-box bg-primary">
<div class="inner">
<h5> ການເງິນ</h5>
<?php  
include('../../condb.php');
$sql = "SELECT COUNT(*) as totaltwo,pk_id FROM officers WHERE pk_id = 5"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row5 = mysqli_fetch_assoc($result);
$totaltwo = $row5['totaltwo'];
$sql = "SELECT COUNT(*) as mans FROM officers where gender='ຊາຍ' and pk_id = 5 "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalman = $row['mans'];
$sql = "SELECT COUNT(*) as women FROM officers where gender='ຍິງ' and pk_id = 5 "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalwomen = $row['women'];
?>
<p class="text-white">[ ຍິງ: <?= $totalwomen; ?> || ຊາຍ: <?= $totalman; ?> ] = <?= $totaltwo;?> ສະຫາຍ </p>
</div>
<div class="icon">
<i class="ion-cash"></i>
</div>
<a href="../../form/officers/show_five.php?pk_id=<?php echo $row5['pk_id']; ?>" class="small-box-footer">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box " style="background-color:#6610f2">
<div class="inner">
<h5 class="text-white">ຄຸ້ມຄອງຊັບສິນ<sup style="font-size: 20px"></sup></h5>
<?php  
include('../../condb.php');
$sql = "SELECT COUNT(*) as totaltwo,pk_id FROM officers WHERE pk_id = 6"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row6 = mysqli_fetch_assoc($result);
$totaltwo = $row6['totaltwo'];
$sql = "SELECT COUNT(*) as mans FROM officers where gender='ຊາຍ' and pk_id = 6 "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalman = $row['mans'];
$sql = "SELECT COUNT(*) as women FROM officers where gender='ຍິງ' and pk_id = 6 "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalwomen = $row['women'];
?>
<p class="text-white">[ ຍິງ: <?= $totalwomen; ?> || ຊາຍ: <?= $totalman; ?> ] = <?= $totaltwo;?> ສະຫາຍ </p>
</div>
<div class="icon">
<i class="ion-connection-bars"></i>
</div>
<a href="../../form/officers/show_six.php?pk_id=<?php echo $row6['pk_id']; ?>" class="small-box-footer">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box " style="background-color:#3c8dbc">
<div class="inner">
<h5 class="text-white">ການຜະລິດ</h5>
<?php  
include('../../condb.php');
$sql = "SELECT COUNT(*) as totaltwo,pk_id FROM officers WHERE pk_id = 7"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row7 = mysqli_fetch_assoc($result);
$totaltwo = $row7['totaltwo'];
$sql = "SELECT COUNT(*) as mans FROM officers where gender='ຊາຍ' and pk_id = 7 "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalman = $row['mans'];
$sql = "SELECT COUNT(*) as women FROM officers where gender='ຍິງ' and pk_id = 7 "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalwomen = $row['women'];
?>
<p class="text-white">[ ຍິງ: <?= $totalwomen; ?> || ຊາຍ: <?= $totalman; ?> ] = <?= $totaltwo;?> ສະຫາຍ </p>
</div>
<div class="icon">
<i class="ion-android-contacts"></i>
</div>
<a href="../../form/officers/show_seven.php?pk_id=<?php echo $row7['pk_id']; ?>" class="small-box-footer">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box " style="background-color:#001f3f">
<div class="inner">
<h5 class="text-white">ສູນຮັບຕອນ</h5>
<?php  
include('../../condb.php');
$sql = "SELECT COUNT(*) as totaltwo,pk_id FROM officers WHERE pk_id = 8"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row8 = mysqli_fetch_assoc($result);
$totaltwo = $row8['totaltwo'];
$sql = "SELECT COUNT(*) as mans FROM officers where gender='ຊາຍ' and pk_id = 8 "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalman = $row['mans'];
$sql = "SELECT COUNT(*) as women FROM officers where gender='ຍິງ' and pk_id = 8 "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalwomen = $row['women'];
?>
<p class="text-white">[ ຍິງ: <?= $totalwomen; ?> || ຊາຍ: <?= $totalman; ?> ] = <?= $totaltwo;?> ສະຫາຍ </p>
</div>
<div class="icon">
<i class="ion-android-contacts"></i>
</div>
<a href="../../form/officers/show_eight.php?pk_id=<?php echo $row8['pk_id']; ?>" class="small-box-footer">ເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
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
$sql = "SELECT COUNT(*) as totallevel_up FROM level_up "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$rowup = mysqli_fetch_assoc($result);
$totallevel_up = $rowup['totallevel_up'];
$sql = "SELECT COUNT(b.officer_id) as mans FROM officers as a,level_up as b where a.gender='ຊາຍ' and a.officer_id = b.officer_id"; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalman = $row['mans'];
$sql = "SELECT COUNT(b.officer_id) as women FROM officers as a,level_up as b where a.gender='ຍິງ' and a.officer_id = b.officer_id"; // Assuming o_id = 1 is the main office
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