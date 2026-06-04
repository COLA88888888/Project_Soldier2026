
<link rel="stylesheet" href="styleprint.css">

<style type="text/css" media="print">
    	/* body{font-family:phetsarath OT;background-color:#white} */
@media print
{
#hd { display: none; }
}

.main-footer{
display: none;
}

.header{
display: none;
}

</style>
<div class="page">
<button id="hd" class="btn btn-primary btn-sm text-white  " onclick="window.print();"><span><i class="fas fa-print"></i></span> ພີມ</button>

    
<!-- <div class="cardimg"> -->
<center><img src="logo/logo1.png" style="width: 2cm;
    height: 2cm;" ></center>
<!-- </div> -->
<div class="pdr">
<p>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</p>
<p>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</p>
</div>
<div class="khom213">
<p class="ml-3">ກົມໃຫຍ່ການເມືອງ  </p>


</div>
<div class="vieng">
<p class="ml-3">ຫ້ອງການກົມໃຫຍ່ການເມືອງ  </p>
<p class="mr-3">ເລກທີ:......../.......... </p>
</div>
<div class="right">
<p class="mr-3">ນະຄອນຫຼວງວຽງຈັນ,ວັນທີ:....../......./......... </p>
</div>
<br>
<div class="centertext"><h3 class=" text-center">ສະຫຼຸບພະນັກງານທັງໝົດ ຫ້ອງການກົມໃຫຍ່ການເມືອງ </h3></div>
<div class="tableshow">

<table border="1" cellspacing="0" style="width: 100%;  ">
<tr align="center">
<th rowspan="3">ລະດັບ</th>
<th rowspan="3">ກົົງຈັກການຈັດຕັ້ງ</th>
<th colspan="4">ການຈັດຕັ້ງປະຕິບັດແຜນການ </th>
</tr>
<tr align="center">
<th colspan="4">ພາຍໃນຫ້ອງການກົມໃຫຍ່ການເມືອງ</th>

</tr>
<tr align="center">
<th>ຊາຍ</th>
<th>ຍິງ</th>
<th>ຄອບຄົວ</th>
<th>ໂສດ</th>
</tr>

<tr align="center">
<th>I</th>
<?php 
include('../../condb.php');
$sql = mysqli_query($conn,"select count(*)as allss from officers  ");
$allss = mysqli_fetch_array($sql);
?>
<th>ພະນັກງານທັງໝົດ <?php echo $allss['allss']; ?> ສະຫາຍ</th>
<?php 
include('../../condb.php');
$sql = mysqli_query($conn,"select count(*)as alls from officers where gender='ຊາຍ' ");
$alls = mysqli_fetch_array($sql);
?>
<th><?php echo $alls['alls']; ?> ສະຫາຍ</th>
<?php 
include('../../condb.php');
$sql = mysqli_query($conn,"select count(*)as allsf from officers where gender='ຍິງ' ");
$allsf = mysqli_fetch_array($sql);
?>
<th><?php echo $allsf['allsf']; ?> ສະຫາຍ</th>
<?php 
include('../../condb.php');
$sql = mysqli_query($conn,"select count(*)as allsfamily from officers where status_persions='ຄອບຄົວ' ");
$allsfamily = mysqli_fetch_array($sql);
?>
<th><?php echo $allsfamily['allsfamily']; ?> ສະຫາຍ</th>
<?php 
include('../../condb.php');
$sql = mysqli_query($conn,"select count(*)as allssing from officers where status_persions='ໂສດ' ");
$allssing = mysqli_fetch_array($sql);
?>
<th><?php echo $allssing['allssing']; ?> ສະຫາຍ</th>
</tr>

<?php 
$i = 1;
include('../../condb.php');
$sql = mysqli_query($conn,"SELECT *FROM positions_level order by l_id asc ");
while($row=mysqli_fetch_array($sql)){ 
    $l_name = $row['l_name'];
$m = mysqli_query($conn,"SELECT a.*,b.*, count(b.officer_id)as tom from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name' and b.gender='ຊາຍ' ");
$tom =mysqli_fetch_array($m);

$m = mysqli_query($conn,"SELECT a.*,b.*, count(b.officer_id)as tof from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name' and b.gender='ຍິງ' ");
$tof =mysqli_fetch_array($m);

$family = mysqli_query($conn,"SELECT a.*,b.*, count(b.officer_id)as tofamily from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name' and b.status_persions='ຄອບຄົວ' ");
$tofamily =mysqli_fetch_array($family);

$single = mysqli_query($conn,"SELECT a.*,b.*, count(b.officer_id)as tosingle from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name' and b.status_persions='ໂສດ' ");
$tosingle =mysqli_fetch_array($single);
    ?>
<tr align="center">
<th><?php echo $i++; ?></th>

<th><?php echo $row['l_name']; ?></th>
<th><?php echo $tom['tom']; ?> ສະຫາຍ</th>
<th><?php echo $tof['tof']; ?> ສະຫາຍ</th>
<th><?php echo $tofamily['tofamily']; ?> ສະຫາຍ</th>
<th><?php echo $tof['tof']; ?> ສະຫາຍ</th>


</tr>
<?php }?>

<tr align="center">
<th>II</th>
<th>ແຍກຕາມພະແນກ</th>
<th>ຊາຍ</th>
<th>ຍິງ</th>
<th>ຄອບຄົວ</th>
<th>ໂສດ</th>
</tr>

<?php 
$i = 1;
include('../../condb.php');
$sql = mysqli_query($conn,"SELECT *FROM panak order by pk_id  asc ");
while($row3=mysqli_fetch_array($sql)){ 
$pk_name = $row3['pk_name'];  

$count = mysqli_query($conn,"select count(b.officer_id)as totallss from panak as a,officers as b where a.pk_id =b.pk_id  and a.pk_name='$pk_name'  and b.gender='ຊາຍ' ");
$totallss =mysqli_fetch_array($count);

$countw = mysqli_query($conn,"select count(b.officer_id)as totallsws from panak as a,officers as b where a.pk_id =b.pk_id  and a.pk_name='$pk_name'  and b.gender='ຍິງ' ");
$totallsws =mysqli_fetch_array($countw);

$countf = mysqli_query($conn,"select count(b.officer_id)as totallsfs from panak as a,officers as b where a.pk_id =b.pk_id  and a.pk_name='$pk_name'  and b.status_persions='ຄອບຄົວ' ");
$totallsfs =mysqli_fetch_array($countf);

$counting = mysqli_query($conn,"select count(b.officer_id)as totallsings from panak as a,officers as b where a.pk_id =b.pk_id  and a.pk_name='$pk_name'  and b.status_persions='ໂສດ' ");
$totallsings =mysqli_fetch_array($counting);

    ?>
<tr align="center">
<th><?php echo $i++; ?></th>

<th><?php echo $row3['pk_name']; ?></th>
<th><?php echo $totallss['totallss']; ?> ສະຫາຍ</th>
<th><?php echo $totallsws['totallsws']; ?> ສະຫາຍ</th>
<th><?php echo $totallsfs['totallsfs']; ?> ສະຫາຍ</th>
<th><?php echo $totallsings['totallsings']; ?> ສະຫາຍ</th>

</tr>
<?php }?>


<tr align="center">
<th>III</th>
<?php 
include('../../condb.php');
$sql = mysqli_query($conn,"select count(*)as allss from officers where date_join_party  ");
$allss = mysqli_fetch_array($sql);
?>
<th>ສະມະຊີກສຳຮອງ <?php echo $allss['allss']; ?> ສະຫາຍ</th>
<?php 
include('../../condb.php');
$sql = mysqli_query($conn,"select count(*)as alls from officers where gender='ຊາຍ' and date_join_party ");
$alls = mysqli_fetch_array($sql);
?>
<th><?php echo $alls['alls']; ?> ສະຫາຍ</th>
<?php 
include('../../condb.php');
$sql = mysqli_query($conn,"select count(*)as allsf from officers where gender='ຍິງ' and date_join_party ");
$allsf = mysqli_fetch_array($sql);
?>
<th><?php echo $allsf['allsf']; ?> ສະຫາຍ</th>
<?php 
include('../../condb.php');
$sql = mysqli_query($conn,"select count(*)as allsfamily from officers where status_persions='ຄອບຄົວ' and date_join_party ");
$allsfamily = mysqli_fetch_array($sql);
?>
<th><?php echo $allsfamily['allsfamily']; ?> ສະຫາຍ</th>
<?php 
include('../../condb.php');
$sql = mysqli_query($conn,"select count(*)as allssing from officers where status_persions='ໂສດ' and date_join_party ");
$allssing = mysqli_fetch_array($sql);
?>
<th><?php echo $allssing['allssing']; ?> ສະຫາຍ</th>
</tr>
<?php 
$i = 1;
include('../../condb.php');
$sql = mysqli_query($conn,"SELECT *FROM positions_level order by l_id   asc ");
while($row=mysqli_fetch_array($sql)){ 
$l_name = $row['l_name'];
$m = mysqli_query($conn,"SELECT a.*,b.*, count(b.officer_id)as tom from positions_level as a,officers as b where a.l_id =b.l_id  and a.l_name='$l_name' and b.gender='ຊາຍ' and b.date_join_party");
$tom =mysqli_fetch_array($m);

$m = mysqli_query($conn,"SELECT a.*,b.*, count(b.officer_id)as tof from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name' and b.gender='ຍິງ' and b.date_join_party");
$tof =mysqli_fetch_array($m);

$family = mysqli_query($conn,"SELECT a.*,b.*, count(b.officer_id)as tofamily from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name' and b.status_persions='ຄອບຄົວ' and b.date_join_party");
$tofamily =mysqli_fetch_array($family);

$single = mysqli_query($conn,"SELECT a.*,b.*, count(b.officer_id)as tosingle from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name' and b.status_persions='ໂສດ' and b.date_join_party ");
$tosingle =mysqli_fetch_array($single);
    ?>
<tr align="center">
<th><?php echo $i++; ?></th>

<th><?php echo $row['l_name']; ?></th>
<th><?php echo $tom['tom']; ?> ສະຫາຍ</th>
<th><?php echo $tof['tof']; ?> ສະຫາຍ</th>
<th><?php echo $tofamily['tofamily']; ?> ສະຫາຍ</th>
<th><?php echo $tosingle['tosingle']; ?> ສະຫາຍ</th>
</tr>
<?php }?>


<tr align="center">
<th>IV</th>
<?php 
include('../../condb.php');
$sql = mysqli_query($conn,"select count(*)as allss from officers where date_join  ");
$allss = mysqli_fetch_array($sql);
?>
<th>ສະມະຊີກສຳມບູນ <?php echo $allss['allss']; ?> ສະຫາຍ</th>
<?php 
include('../../condb.php');
$sql = mysqli_query($conn,"select count(*)as alls from officers where gender='ຊາຍ' and date_join ");
$alls = mysqli_fetch_array($sql);
?>
<th><?php echo $alls['alls']; ?> ສະຫາຍ</th>
<?php 
include('../../condb.php');
$sql = mysqli_query($conn,"select count(*)as allsf from officers where gender='ຍິງ' and date_join ");
$allsf = mysqli_fetch_array($sql);
?>
<th><?php echo $allsf['allsf']; ?> ສະຫາຍ</th>
<?php 
include('../../condb.php');
$sql = mysqli_query($conn,"select count(*)as allsfamily from officers where status_persions='ຄອບຄົວ' and date_join ");
$allsfamily = mysqli_fetch_array($sql);
?>
<th><?php echo $allsfamily['allsfamily']; ?> ສະຫາຍ</th>
<?php 
include('../../condb.php');
$sql = mysqli_query($conn,"select count(*)as allssing from officers where status_persions='ໂສດ' and date_join ");
$allssing = mysqli_fetch_array($sql);
?>
<th><?php echo $allsfamily['allsfamily']; ?> ສະຫາຍ</th>
</tr>
<?php 
$i = 1;
include('../../condb.php');
$sql = mysqli_query($conn,"SELECT *FROM positions_level order by l_id   asc ");
while($row=mysqli_fetch_array($sql)){ 
    $l_name = $row['l_name'];
$m = mysqli_query($conn,"SELECT a.*,b.*, count(b.officer_id)as tom from positions_level as a,officers as b where a.l_id =b.l_id  and a.l_name='$l_name' and b.gender='ຊາຍ' and b.date_join");
$tom =mysqli_fetch_array($m);

$m = mysqli_query($conn,"SELECT a.*,b.*, count(b.officer_id)as tof from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name' and b.gender='ຍິງ' and b.date_join");
$tof =mysqli_fetch_array($m);

$family = mysqli_query($conn,"SELECT a.*,b.*, count(b.officer_id)as tofamily from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name' and b.status_persions='ຄອບຄົວ' and b.date_join");
$tofamily =mysqli_fetch_array($family);

$single = mysqli_query($conn,"SELECT a.*,b.*, count(b.officer_id)as tosingle from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name' and b.status_persions='ໂສດ' and b.date_join");
$tosingle =mysqli_fetch_array($single);
    ?>
<tr align="center">
<th><?php echo $i++; ?></th>

<th><?php echo $row['l_name']; ?></th>
<th><?php echo $tom['tom']; ?> ສະຫາຍ</th>
<th><?php echo $tof['tof']; ?> ສະຫາຍ</th>
<th><?php echo $tofamily['tofamily']; ?> ສະຫາຍ</th>
<th><?php echo $tosingle['tosingle']; ?> ສະຫາຍ</th>
</tr>
<?php }?>


<tr align="center">
<th>V</th>
<th>ແຍກຕາມພະແນກ ສະມາຊີກສຳຮອງ</th>
<th>ຊາຍ</th>
<th>ຍິງ</th>
<th>ຄອບຄົວ</th>
<th>ໂສດ</th>
</tr>
<?php 
$i = 1;
include('../../condb.php');
$sql = mysqli_query($conn,"SELECT *FROM positions_level order by l_id asc ");
while($row=mysqli_fetch_array($sql)){ 
    $l_name = $row['l_name']; 

$count = mysqli_query($conn,"select count(b.officer_id)as totalls5 from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name'  and b.gender='ຊາຍ' and b.date_join_party ");
$totalls5 =mysqli_fetch_array($count);

$countw = mysqli_query($conn,"select count(b.officer_id)as totallsw5 from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name'  and b.gender='ຍິງ' and b.date_join_party ");
$totallsw5 =mysqli_fetch_array($countw);

$countf = mysqli_query($conn,"select count(b.officer_id)as totallsf5 from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name'  and b.status_persions='ຄອບຄົວ' and b.date_join_party ");
$totallsf5 =mysqli_fetch_array($countf);

$counting = mysqli_query($conn,"select count(b.officer_id)as totallsing5 from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name'  and b.status_persions='ໂສດ' and b.date_join_party ");
$totallsing5 =mysqli_fetch_array($counting);

    ?>
<tr align="center">
<th><?php echo $i++; ?></th>

<th><?php echo $row['l_name']; ?></th>
<th><?php echo $totalls5['totalls5']; ?> ສະຫາຍ</th>
<th><?php echo $totallsw5['totallsw5']; ?> ສະຫາຍ</th>
<th><?php echo $totallsf5['totallsf5']; ?> ສະຫາຍ</th>
<th><?php echo $totallsing5['totallsing5']; ?> ສະຫາຍ</th>


</tr>
<?php }?>

<tr align="center">
<th>VI</th>
<th>ແຍກຕາມພະແນກ ສະມາຊີກສົມບູນ</th>
<th>ຊາຍ</th>
<th>ຍິງ</th>
<th>ຄອບຄົວ</th>
<th>ໂສດ</th>
</tr>
<?php 
$i = 1;
include('../../condb.php');
$sql = mysqli_query($conn,"SELECT *FROM positions_level order by l_id asc ");
while($row=mysqli_fetch_array($sql)){ 
    $l_name = $row['l_name'];

$count = mysqli_query($conn,"select count(b.officer_id)as totalls6 from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name'  and b.gender='ຊາຍ'  and b.date_join ");
$totalls6 =mysqli_fetch_array($count);

$countw = mysqli_query($conn,"select count(b.officer_id)as totallsw6 from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name'  and b.gender='ຍິງ'  and b.date_join ");
$totallsw6 =mysqli_fetch_array($countw);

$countf = mysqli_query($conn,"select count(b.officer_id)as totallsf6 from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name'  and b.status_persions='ຄອບຄົວ'  and b.date_join ");
$totallsf6 =mysqli_fetch_array($countf);

$counting = mysqli_query($conn,"select count(b.officer_id)as totallsing6 from positions_level as a,officers as b where a.l_id=b.l_id and a.l_name='$l_name'  and b.status_persions='ໂສດ'   and b.date_join");
$totallsing6 =mysqli_fetch_array($counting);

    ?>
<tr align="center">
<th><?php echo $i++; ?></th>

<th><?php echo $row['l_name']; ?></th>
<th><?php echo $totalls6['totalls6']; ?> ສະຫາຍ</th>
<th><?php echo $totallsw6['totallsw6']; ?> ສະຫາຍ</th>
<th><?php echo $totallsf6['totallsf6']; ?> ສະຫາຍ</th>
<th><?php echo $totallsing6['totallsing6']; ?> ສະຫາຍ</th>


</tr>
<?php }?>

</table>
<br>

</div>
</div>
</div>
</div>

<!-- /.content -->


