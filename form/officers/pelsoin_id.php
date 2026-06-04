<?php include('../../controllers/head.php'); ?>
<?php include('../../controllers/menu_left.php'); ?>
<style>
body {
background: #f4f6f9;
font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.profile-card {
background: #fff;
border-radius: 15px;
padding: 5px;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
max-width: 400px;

text-align: center;
}
.profile-card img {
width: 150px;
height: 150px;
object-fit: cover;
border-radius: 50%;
border: 5px solid #fff;
box-shadow: 0 4px 6px rgba(0,0,0,0.1);
margin-bottom: 10px;
}
.profile-card h5 {
margin-bottom: 10px;
font-weight: 600;
}
.profile-card p {
color: #6c757d;
font-size: 14px;
margin-bottom: 10px;
}
.profile-card .btn {
border-radius: 50px;
padding: 5px 5px;
font-size: 14px;
}
a{
    text-decoration: none;
    color: inherit;
}

</style>

<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid">
<div class="row align-items-center mb-3">
<div class="col-lg-8 col-12" >
<?php  
include('../../condb.php');
$sql = "SELECT COUNT(*) as totalalls FROM officers "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$rowalls = mysqli_fetch_assoc($result);
$totalalls = $rowalls['totalalls'];
$sql = "SELECT COUNT(*) as mans FROM officers where gender='ຊາຍ' "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$rowmarried = mysqli_fetch_assoc($result);
$totalman = $rowmarried['mans'];

$sql = "SELECT COUNT(*) as women FROM officers where gender='ຍິງ' "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalwomen = $row['women'];

$sql = "SELECT COUNT(*) as married FROM officers where status_persions='ຄອບຄົວ' "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$married = mysqli_fetch_assoc($result);
$totalmarried = $married['married'];

$sql = "SELECT COUNT(*) as single FROM officers where status_persions='ໂສດ' "; // Assuming o_id = 1 is the main office
$result = mysqli_query($conn, $sql);
$single = mysqli_fetch_assoc($result);
$totalsingle = $single['single'];

?>
<a href="show_table.php" class="btn btn-primary btn-sm mb-1 mt-1"><i class="fas fa-users"></i> ທັງໝົດ <?php echo $rowalls['totalalls']; ?> ສະຫາຍ</a>
<a href="show_womans.php" class="btn btn-info  btn-sm"><i class="fas fa-female"></i> ຍິງ <?php echo $totalwomen; ?> ສະຫາຍ</a>
<a href="show_mans.php" class="btn btn-success  btn-sm"><i class="fas fa-male"></i> ຊາຍ <?php echo $totalman; ?> ສະຫາຍ</a>
<a href="show_single.php" class="btn btn-danger  btn-sm"><i class="fas fa-user-secret"></i> ໂສດ <?php echo $totalsingle; ?> ສະຫາຍ</a>
<a href="show_family.php" class="btn btn-warning  btn-sm mt-1 mb-1"><i class="fas fa-users"></i> ຄອບຄົວ <?php echo $totalmarried; ?> ສະຫາຍ</a>
<a href="chick_showprint.php" class="btn btn-dark btn-sm">ພີມ <i class="ion-ios-printer-outline"></i></a>
</div>
<div class="col-lg-4 col-12" >
<div class="d-flex align-items-center gap-2">
<div class="input-group">
<input type="text" id="search-product" name="full_name" class="form-control" placeholder="ກະລຸນນາປ້ອນຊື່ແລະນາມະກຸນ" autocomplete="off">
<button class="btn btn-success  btn-sm" id="search-button"><i class="fas fa-search"></i> ຄົ້ນຫາ</button>
</div>
</div>
</div>
</div>

<div id="product-list" class="row" style="height: 600px; overflow-y: auto;">
<?php 
include('../../condb.php');
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

");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) { ?>
<div class="col-lg-2 col-6" >

<a href="people_print.php?officer_id=<?= $row['officer_id'] ?>">
    <div class="profile-card mt-2">
<img src="../../form/officers/uploads/<?php echo $row['photo_img'] ?>" alt="Profile Image">
<p><?php echo $row['l_name'] ?></p>
<h5><?php echo $row['full_name'] ?> <?php echo $row['full_lastname'] ?></h5>

<p><?php echo $row['pk_name'] ?></p>
</div>
</a>
</div>
<?php } ?>
</div>
</div>
</div>
</div>
</div>

<?php include('../../controllers/footer.php'); ?>

<script>
    $(function () {

$('#search-product').on('keyup', function () {
let keyword = $(this).val().trim();
$.get('search_officers.php', {q: keyword}, function (html) {
$('#product-list').html(html);
});
});
    });

</script>