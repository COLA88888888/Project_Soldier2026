<?php include('../../controllers/head.php'); ?>
<?php include('../../controllers/menu_left.php'); ?>
<style>
.card-modern {
  border: none;
  border-radius: 20px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  transition: 0.3s ease-in-out;
  background: #E10000FF;
}

.card-modern:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
}

.card-modern img {
  border-radius: 12px;
  object-fit: cover;
}

.card-modern h5 {
  font-weight: 600;
  margin-top: 10px;
  color: #333;
}

.status-badge {
  background: #f1f1f1;
  border-radius: 20px;
  display: inline-block;
  padding: 6px 12px;
  margin-top: 6px;
  font-size: 18px;
  color: #555;
}
h5{
    padding: 0;
    margin: 0;
}
.card-modern .card-title-top-right {
  position: absolute;
  top: 10px;
  right: 15px;
  font-size: 16px;
  font-weight: bold;
  color: #FFFFFF;
   background: #FF0000FF;/* เผื่อให้อ่านง่ายบนภาพ */
  padding: 10px 10px;
  border-radius: 8px;
}
.card-modern {
  position: relative; /* ทำให้ .card เป็นพื้นฐานสำหรับ position absolute */
  border: none;
  border-radius: 20px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  background: #FFFFFFFF;
  padding-top: 40px; /* เผื่อพื้นที่บน */
}
</style>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid">
<div class="row">
<?php 
include('../../condb.php');
$pk_id = $_GET['pk_id'];
$stmt = $conn->prepare("SELECT *FROM positions_level ");
$stmt->execute();
$result = $stmt->get_result();
while ($rowbox = $result->fetch_assoc()) {
$l_id  = $rowbox['l_id'];

$sql = "SELECT COUNT(*) as totalalls FROM officers where l_id=$l_id and pk_id=$pk_id"; // Assuming o_id = 1 is the main office
$result1 = mysqli_query($conn, $sql);
$rowalls = mysqli_fetch_assoc($result1);
$totalalls = $rowalls['totalalls'];
$sql = "SELECT COUNT(*) as mans FROM officers where gender='ຊາຍ' and l_id=$l_id and pk_id=$pk_id"; // Assuming o_id = 1 is the main office
$result2 = mysqli_query($conn, $sql);
$rowmarried = mysqli_fetch_assoc($result2);
$totalman = $rowmarried['mans'];

$sql = "SELECT COUNT(*) as women FROM officers where gender='ຍິງ' and l_id=$l_id and pk_id=$pk_id"; // Assuming o_id = 1 is the main office
$result3 = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result3);
$totalwomen = $row['women'];

$sql = "SELECT COUNT(*) as married FROM officers where status_persions='ຄອບຄົວ' and l_id=$l_id and pk_id=$pk_id"; // Assuming o_id = 1 is the main office
$result4 = mysqli_query($conn, $sql);
$married = mysqli_fetch_assoc($result4);
$totalmarried = $married['married'];

$sql = "SELECT COUNT(*) as single FROM officers where status_persions='ໂສດ' and l_id=$l_id and pk_id=$pk_id"; // Assuming o_id = 1 is the main office
$result5 = mysqli_query($conn, $sql);
$single = mysqli_fetch_assoc($result5);
$totalsingle = $single['single'];

?>
<div class="col-lg-4 col-6">
<a href="../../form/officers/show_position_level_id.php?l_id=<?php echo $rowbox['l_id']; ?>&pk_id=<?php echo $pk_id; ?>" class="text-decoration-none">
    <div class="card card-modern text-center p-3">
  <h5 class="card-title-top-right"><?php echo $rowbox['l_name']; ?></h5>
  <img src="uploads/<?php echo $rowbox['l_img']; ?>" alt="" width="100%" height="100px" class="img-fluid mb-2" style="object-fit: cover; border-radius: 12px;">
  <div class="status-badge">ຍິງ <?php echo $totalwomen; ?> ຊາຍ <?php echo $totalman; ?> = <?php echo $totalalls; ?> [ ໂສດ <?php echo $totalsingle; ?> ຄອບ <?php echo $totalmarried; ?> ]</div>
</div>
</a>
</div>
<?php } ?>
</div>
</div>
</div>
</div>
<?php include('../../controllers/footer.php'); ?>