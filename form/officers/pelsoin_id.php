<?php include('../../controllers/head.php'); ?>
<?php include('../../controllers/menu_left.php'); ?>
<style>
body {
background: #f4f6f9;
font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.profile-card {
background: #fff;
border-radius: 8px;
overflow: hidden;
box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
border: 1px solid #e2e8f0;
display: flex;
flex-direction: column;
align-items: center;
padding: 15px;
text-align: center;
}
.profile-card:hover {
transform: translateY(-4px);
box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
border-color: #007bff;
}
.profile-card img {
width: 120px;
height: 120px;
object-fit: cover;
border-radius: 6px;
border: 3px solid #f1f5f9;
box-shadow: 0 2px 8px rgba(0,0,0,0.06);
margin-bottom: 12px;
}
.profile-card .rank-badge {
background: #e0f2fe;
color: #0369a1;
font-size: 11px;
font-weight: 700;
padding: 3px 8px;
border-radius: 4px;
margin-bottom: 8px;
text-transform: uppercase;
letter-spacing: 0.5px;
display: inline-block;
}
.profile-card h5 {
font-size: 14px;
font-weight: 600;
color: #1e293b;
margin: 5px 0 8px 0;
line-height: 1.4;
}
.profile-card .dept-name {
color: #64748b;
font-size: 11px;
margin-bottom: 0;
margin-top: 8px;
background: #f8fafc;
width: 100%;
padding: 6px;
border-radius: 4px;
font-weight: 500;
}
.profile-card .btn {
border-radius: 4px;
padding: 5px 5px;
font-size: 14px;
}
a{
    text-decoration: none;
    color: inherit;
}
a:hover {
    text-decoration: none;
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
while ($row = $result->fetch_assoc()) { 
    $photo = htmlspecialchars($row['photo_img']);
    if (empty($photo) || !file_exists("uploads/" . $photo)) {
        $photo = 'default_avatar.png';
    }
    ?>
<div class="col-lg-2 col-6" >
<a href="people_print.php?officer_id=<?= $row['officer_id'] ?>" class="w-100 mt-2 mb-2 d-block">
    <div class="profile-card w-100">
        <img src="uploads/<?= $photo ?>" alt="Profile Image">
        <span class="rank-badge"><?= htmlspecialchars($row['l_name']) ?></span>
        <h5><?= htmlspecialchars($row['full_name'] . ' ' . $row['full_lastname']) ?></h5>
        <p class="dept-name"><?= htmlspecialchars($row['pk_name']) ?></p>
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