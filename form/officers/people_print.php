<?php include('../../controllers/head.php'); ?>
<?php include('../../controllers/menu_left.php'); ?>
<style>
*{
box-sizing: border-box;
-moz-box-sizing: border-box;
font-family: "phetsarath ot";
margin: 0;
padding: 0;
}
.page{
width: 21cm;
min-height: 29.7cm;
padding: 20px;
margin: 20px auto;

}
@media print {
.d-print-none,.main-footer {
display: none !important;
}
}
@page {
size: A4;
margin: 20px;
size: A4 portrait;
margin: 2cm;
}

.imgtop{
width: 3cm;
height: 4cm;


}
.img4x6{
width: 3cm;
height: 4cm;
float: left;
margin-right: 20px;
margin-bottom: 10px;
clear: both;
}
.texthistory{
margin-bottom: 20px;
padding-top: 20px;
font-size: 22px;
font-weight: bold;
}

.details{
margin-left: 50px;
clear: both;
font-size: 16px;
}
p{
    margin: 0;
    padding: 0;
}
.fullname{
    margin-top: 40px;
    padding-top: 40px;
}
</style>
<?php 
include('../../condb.php');
$officer_id = $_GET['officer_id'];
$stmt = $conn->prepare("SELECT 
  a.*, 
  b.*, 
  c.*, 
  d.*, 
  e.*, 
  f.*, 
  g.*,
  p.*,
  di.*,
  v.*
FROM officers AS a
INNER JOIN department AS b ON a.d_id = b.d_id
INNER JOIN units AS c ON a.u_id = c.u_id
INNER JOIN panak AS d ON a.pk_id = d.pk_id
INNER JOIN office AS g ON a.o_id = g.o_id
INNER JOIN positions_level AS e ON a.l_id = e.l_id
INNER JOIN positions AS f ON a.pt_id = f.pt_id
INNER JOIN province AS p ON a.pro_id = p.pro_id
INNER JOIN distict AS di ON a.dis_id = di.dis_id
INNER JOIN village AS v ON a.v_id = v.v_id
 where a.officer_id='$officer_id'
 ");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>
<div class="content-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="text-right mb-3 d-print-none mt-3">
<button class="btn btn-primary" onclick="window.print()">
🖨️ ພິມເອກະສານ
</button>
</div>
<div class="page">
<img src="uploads/<?php echo $row['photo_img']; ?>" class="img4x6" alt="">
<center><h5 class="texthistory">ຊິວະປະຫວັດພະນັກງານ-ນັກຮົບ</h5></center>


<div class="fullname">
<p>ຊື່: <?php echo $row['full_name']; ?></p>   
<p>
  <span style="margin-right: 10rem;">
    ນາມສະກຸນ: <?php echo $row['full_lastname']; ?>
  </span>
  <span>
    ເພດ: <?php echo $row['gender']; ?>
  </span>
</p>
</div>
<div class="details">
<div class="text-details">
<p> <span style="margin-right: 10rem;">ກົມກອງຂື້ນກັບ: <?php echo $row['d_name']; ?> </span>  <span>ຫ້ອງ, ກົມ: <?php echo $row['u_name']; ?></span></p>   
<p><span style="margin-right: 10rem;">ພະແນກ: <?php echo $row['pk_name']; ?></span>   <span>ໜ່ວຍງານ: <?php echo $row['o_name']; ?></span></p>
<p><span style="margin-right: 10rem;">ວັນ, ເດືອນ, ປີເກີດ:  <?php echo $row['birth_date']; ?></span>  ຊັ້ນປັດຈຸບັນ: <?php echo $row['l_name']; ?></p>
<p><span>ວັນ, ເດືອນ, ປີປະດັບຊັ້ນ: <?php echo $row['date_level']; ?></span>  <span>ວັນ, ເດືອນ, ປີເລືອ່ນຊັ້ນ: <?php echo $row['date_level']; ?></span></p>
<p><span style="margin-right: 10rem;">ຊົນເຜົ່າ: <?php echo htmlspecialchars($row['ethnicity']); ?></span> <span style="margin-right: 10rem;"> ສາດສະໜາ: <?php echo htmlspecialchars($row['religion']); ?></span>  <span>ບ້ານເກີດ: <?php echo htmlspecialchars($row['v_name']); ?></span></p>
<p><span style="margin-right: 10rem;">ເມືອງ: <?php echo htmlspecialchars($row['dis_name']); ?></span>  ແຂວງ: <?php echo htmlspecialchars($row['pro_name']); ?></p>
<p><span style="margin-right: 5rem;">ບ້ານຢູ່ປັດຈຸບັນ: <?php echo $row['current_village'] === '0' ? '' : htmlspecialchars($row['current_village']); ?></span>   <span style="margin-right: 5rem;">ເມືອງ: <?php echo $row['current_district'] === '0' ? '' : htmlspecialchars($row['current_district']); ?> </span>  <span>ແຂວງ: <?php echo $row['current_province'] === '0' ? '' : htmlspecialchars($row['current_province']); ?></span></p>
<p><span style="margin-right: 10rem;">ເບີໂທ: </span> <?php echo htmlspecialchars($row['numberphone']); ?></p>
<p><span style="margin-right: 10rem;">ວັນ, ເດືອນ, ປີເຂົ້າການປະຕິວັດ:  <?php echo htmlspecialchars($row['date_join_revolution']); ?></span></p>
<p><span style="margin-right: 10rem;">ວັນເດືອນປີເຂົ້າກອງທັບ: </span> <?php echo htmlspecialchars($row['date_join_police']); ?></p>
<p><span style="margin-right: 10rem;">ວັນ, ເດືອນ, ປີເຂົາພັກສຳຮອງ: </span> <?php echo htmlspecialchars($row['date_join_party']); ?></p>
<p><span style="margin-right: 10rem;">ວัน, ເດືອນ, ປີເຂົາພັກສົມບູນ: </span> <?php echo htmlspecialchars($row['date_join']); ?></p>
<p><span style="margin-right: 10rem;">ວັນ, ເດືອນ, ປີເຂົາຊາວໜຸ່ມ: </span> <?php echo htmlspecialchars($row['date_join_youth']); ?></p>
<p><span style="margin-right: 10rem;">ວັນ, ເດືອນ, ປີເຂົາແມ່ຍິງ: </span> <?php echo htmlspecialchars($row['date_join_women']); ?></p>
<p><span style="margin-right: 10rem;">ວັນ, ເດືອນ, ປີເຂົ້າກຳມະບານ: </span>  <?php echo htmlspecialchars($row['date_join_union']); ?></p>
<p><span style="margin-right: 10rem;">ລະດັບວັດທະນາທຳ: </span> <?php echo htmlspecialchars($row['culture_level']); ?></p>
<p><span style="margin-right: 10rem;">ລະດັບວິຊາສະເພາະປ້ອງກັນຄວາມສະຫງົບ ສູງສຸດ:</span>  <?php echo htmlspecialchars($row['lalup_pks']); ?></p>
<p><span  style="margin-right: 10rem;">ຂະແໜ່ງວິຊາຮຽນ:  <?php echo htmlspecialchars($row['kananghien']); ?> </span><span>ລະບົບ: <?php echo htmlspecialchars($row['labup']); ?> </span></p>
<p> <span  style="margin-right: 10rem;">ບ່ອນຮຽນຢູ່ໃສ:  <?php echo htmlspecialchars($row['school_one']); ?></span></p>
<p><span  style="margin-right: 10rem;"> ແຕ່ປີໃດຫາປີໃດ:  <?php echo htmlspecialchars($row['pihien']); ?></span></p>
<p><span  style="margin-right: 10rem;">ລະດັບທິດສະດີສູງສຸດ:  <?php echo htmlspecialchars($row['level_m']); ?></span></p>
<p><span  style="margin-right: 10rem;">ຂະແໜ່ງວິຊາຮຽນ:  <?php echo htmlspecialchars($row['kananghien_m']); ?> <span>ລະບົບ: <?php echo htmlspecialchars($row['labup_m']); ?> </span> </p>
<p><span  style="margin-right: 10rem;">ບ່ອນຮຽນຢູ່ໃສ:  <?php echo htmlspecialchars($row['school_m']); ?></span></p>
<p><span  style="margin-right: 10rem;">ແຕ່ປີໃດຫາປີໃດ:  <?php echo htmlspecialchars($row['pihien_m']); ?></span></p>
<p><span  style="margin-right: 10rem;">ລະດັບວິຊາສະເພາະອື່ນຂະແໜ່ງການອື່ນ:  <?php echo htmlspecialchars($row['level_as']); ?></span></p>
<p><span  style="margin-right: 10rem;">ຂະແໜ່ງວິຊາຮຽນ:  <?php echo htmlspecialchars($row['kananghien_as']); ?> </span><span>ລະບົບ: <?php echo htmlspecialchars($row['labup_as']); ?> </span></p>
<p><span  style="margin-right: 10rem;">ບ່ອນຮຽນຢູ່ໃສ:  <?php echo htmlspecialchars($row['school_as']); ?></span></p>
<p><span  style="margin-right: 10rem;">ແຕ່ປີໃດຫາປີໃດ:  <?php echo htmlspecialchars($row['pihien_as']); ?></span></p>
<p><span  style="margin-right: 10rem;">ແຕ່ປີໃດຫາປີໃດ:  <?php echo htmlspecialchars($row['p_p_as']); ?></span></p>
<p><span  style="margin-right: 10rem;">ລະດັບພາສາຕ່າງປະເທດ:  <?php echo htmlspecialchars($row['language_as']); ?></span></p>
<p><u><b>I. ສະພາບຄອບຄົວ:</b></u></p>
<p><span style="margin-right: 10rem;"> ຊື່ ແລະ ນາມສະກຸນພໍ່: <?php echo htmlspecialchars($row['ffull_name']); ?></span>  <span style="margin-right: 10rem;"> ອາຍູ:  <?php echo htmlspecialchars($row['fage']); ?></span></p>
<p><span style="margin-right: 10rem;">ອາຊີບ: <?php echo htmlspecialchars($row['foccupation']); ?></span> <span style="margin-right: 10rem;"> ຊົນເຜົ່າ: <?php echo htmlspecialchars($row['fzonpao']); ?></span>   <span>ບ້ານຢູ່ປັດຈຸບັນ: <?php echo $row['fvillagename'] === '0' ? '' : htmlspecialchars($row['fvillagename']); ?></span></p>
<p><span>ເມືອງ: <?php echo $row['fdisname'] === '0' ? '' : htmlspecialchars($row['fdisname']); ?></span>  <span>ແຂວງ: <?php echo $row['fproname'] === '0' ? '' : htmlspecialchars($row['fproname']); ?></span></p>
<p><b>ອ້າຍ, ເອື້ອຍ, ນ້ອງຄີງ ຂອງພໍ່ມີຈັກຄົນ ແຕ່ລະຄົນຊື່ຫຍັງ? ອາຍູ ເຮັດຫຍັງຢູ່ໃສ ?</b></p>
<p><span style="margin-right: 10rem;">ຊື່ ແລະ ນາມສະກຸນແມ່: <?php echo htmlspecialchars($row['mfull_name']); ?></span>  <span>ອາຍູ: <?php echo htmlspecialchars($row['mage']); ?></span></p>
<p><span style="margin-right: 10rem;">ອາຊີບ: <?php echo htmlspecialchars($row['moccupation']); ?></span> <span style="margin-right: 10rem;"> ຊົນເຜົ່າ: <?php echo htmlspecialchars($row['mzonpao']); ?> </span>  <span > ບ້ານຢູ່ປັດຈຸບັນ:<?php echo $row['mvillagename'] === '0' ? '' : htmlspecialchars($row['mvillagename']); ?></span></p>
<p><span style="margin-right: 10rem;">ເມືອງ: <?php echo $row['mdisname'] === '0' ? '' : htmlspecialchars($row['mdisname']); ?></span>   <span>ແຂວງ: <?php echo $row['mproname'] === '0' ? '' : htmlspecialchars($row['mproname']); ?></span></p>
<p><b>ອ້າຍ, ເອື້ອຍ, ນ້ອງຄີງ ຂອງພໍ່ມີຈັກຄົນ ແຕ່ລະຄົນຊື່ຫຍັງ? ອາຍູ ເຮັດຫຍັງຢູ່ໃສ ?</b></p>
<p><span style="margin-right: 10rem;">ຊື່ຜົວ ຫຼື ເມຍ: <?php echo htmlspecialchars($row['falyfull_name']); ?></span>  <span>ອາຍູ: <?php echo htmlspecialchars($row['falyages']); ?></span></p>
<p><span style="margin-right: 10rem;">ອາຊີບ: <?php echo htmlspecialchars($row['falyoccupation']); ?></span> <span style="margin-right: 10rem;">  <span > ບ້ານຢູ່ປັດຈຸບັນ: <?php echo $row['falyvillagename'] === '0' ? '' : htmlspecialchars($row['falyvillagename']); ?></span></p>
<p><span style="margin-right: 10rem;">ເມືອງ: <?php echo $row['falydisname'] === '0' ? '' : htmlspecialchars($row['falydisname']); ?></span>  <span>ແຂວງ: <?php echo $row['falyproname'] === '0' ? '' : htmlspecialchars($row['falyproname']); ?></span></p>
<p><span style="margin-right: 10rem;">ຊົນຊັ້ນ: <?php echo $row['falyzozun'] === '0' ? '' : htmlspecialchars($row['falyzozun']); ?></span>  <span style="margin-right: 10rem;"> ຊົນເຜົ່າ: <?php echo htmlspecialchars($row['falyzonpao']); ?></span> <span>ສາດສະໜາ: <?php echo $row['falyzadsana'] === '0' ? '' : htmlspecialchars($row['falyzadsana']); ?></span></p>
<p><span style="margin-right: 10rem;">ວັນ, ເດືອນ, ປີແຕ່ງງານ: <?php echo htmlspecialchars($row['family_date']); ?></span>  <span>ໄດ້ລຸກນຳກັນຈັກຄົນຊື່ຫຍັງ: <?php echo htmlspecialchars($row['falynumber_of_children']); ?></span></p>
<!-- <p><u><b>II. ສະພາບຄົນເອງ: </b></u></p>
<p>ການເຄື່ອນໄຫວຂອງຕົນເອງນັບຕັ້ງແຕ່ອາຍູ 08 ປີເຖີງປັດຈຸບັນ:</p>
<p>1, ຈຸດດີ:</p>
<p>2, ຈຸດອອ່ນ:</p>
<p><b>ຜ່ານມາຕົນເອງຮັບໃບຍ້ອງຍໍຈັກໃບ:</b></p>
<p><b>ສຸຂະພາບທີ່ຜ່ານມາເຄີຍເຈັບຫຍັງ:</b></p> -->
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('../../controllers/footer.php'); ?>
