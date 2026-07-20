<?php include('../../controllers/head.php'); ?>
<?php
if(isset($_GET['officer_id'])){
$officer_id = $_GET['officer_id'];
$user_id = $_SESSION['user_id'];
include('../../condb.php');
$sql = mysqli_query($conn,"DELETE FROM officers WHERE officer_id ='$officer_id' ");
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

<?php
include('../../condb.php');
$o_id = isset($_GET['o_id']) ? intval($_GET['o_id']) : 0;
$pk_id = isset($_GET['pk_id']) ? intval($_GET['pk_id']) : 0;
$u_id = isset($_GET['u_id']) ? intval($_GET['u_id']) : 0;
$d_id = isset($_GET['d_id']) ? intval($_GET['d_id']) : 0;

$filter_title = "";
if ($o_id > 0) {
    $r_filter = mysqli_query($conn, "SELECT o_name FROM office WHERE o_id = '$o_id'");
    if ($row_f = mysqli_fetch_assoc($r_filter)) {
        $filter_title = " (ຫ້ອງການ: " . htmlspecialchars($row_f['o_name']) . ")";
    }
} elseif ($pk_id > 0) {
    $r_filter = mysqli_query($conn, "SELECT pk_name FROM panak WHERE pk_id = '$pk_id'");
    if ($row_f = mysqli_fetch_assoc($r_filter)) {
        $filter_title = " (ພະແນກ: " . htmlspecialchars($row_f['pk_name']) . ")";
    }
} elseif ($u_id > 0) {
    $r_filter = mysqli_query($conn, "SELECT u_name FROM units WHERE u_id = '$u_id'");
    if ($row_f = mysqli_fetch_assoc($r_filter)) {
        $filter_title = " (ໜ່ວຍງານ: " . htmlspecialchars($row_f['u_name']) . ")";
    }
} elseif ($d_id > 0) {
    $r_filter = mysqli_query($conn, "SELECT d_name FROM department WHERE d_id = '$d_id'");
    if ($row_f = mysqli_fetch_assoc($r_filter)) {
        $filter_title = " (ກົມກອງ: " . htmlspecialchars($row_f['d_name']) . ")";
    }
}
?>

<div class="card mt-2">

<div class="card-header bg-primary d-flex align-items-center justify-content-between">
<h3 class="card-title m-0">ລາຍງານຂໍ້ມູນ ປະຫວັດພະນັກງານ<?= $filter_title ?></h3>
<div>
<?php if ($o_id > 0 || $pk_id > 0 || $u_id > 0 || $d_id > 0) { ?>
<a href="show_table.php" class="btn btn-warning btn-sm mr-2"><i class="fas fa-undo"></i> ສະແດງທັງໝົດ</a>
<?php } ?>
<a href="index.php" class="btn btn-success btn-sm"><i class="icon fas fa-plus"></i> ເພີ່ມຂໍ້ມູນ</a>
</div>
</div>
<!-- /.card-header -->
<div class="card-body">
<style>
.officer-photo {
    width: 44px;
    height: 44px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid #0d9488;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: all 0.2s ease-in-out;
    cursor: pointer;
}
.officer-photo:hover {
    transform: scale(1.8);
    z-index: 999;
    position: relative;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
}

/* Custom Profile Details Modal styling */
.modal-content-custom {
    border-radius: 16px !important;
    border: none !important;
    box-shadow: 0 20px 50px rgba(0,0,0,0.15) !important;
    overflow: hidden;
}
.modal-header-custom {
    background: linear-gradient(135deg, #0d9488, #0f766e) !important;
    color: #fff !important;
    border-bottom: none !important;
    padding: 20px 24px !important;
}
.modal-header-custom .modal-title {
    font-weight: 700 !important;
    font-size: 18px !important;
}
.modal-header-custom .close {
    color: #fff !important;
    opacity: 0.8;
    text-shadow: none !important;
    outline: none !important;
    transition: all 0.2s;
}
.modal-header-custom .close:hover {
    opacity: 1;
    transform: scale(1.1);
}
.detail-modal-tabs .nav-link {
    border-radius: 8px !important;
    margin-right: 6px;
    font-size: 13.5px;
    font-weight: 600;
    color: #475569 !important;
    background-color: #f1f5f9;
    border: 1px solid #e2e8f0;
    transition: all 0.2s ease-in-out;
    padding: 8px 16px;
}
.detail-modal-tabs .nav-link.active {
    background: linear-gradient(135deg, #0d9488, #0f766e) !important;
    color: #fff !important;
    border-color: #0d9488 !important;
    box-shadow: 0 4px 10px rgba(13, 148, 136, 0.15);
}
.profile-modal-img {
    width: 140px;
    height: 180px;
    object-fit: cover;
    border-radius: 12px;
    border: 4px solid #fff;
    box-shadow: 0 6px 16px rgba(0,0,0,0.1);
}
.profile-summary-card {
    background: #f8fafc;
    border-radius: 12px;
    padding: 16px;
    border: 1px solid #e2e8f0;
}
.detail-group {
    margin-bottom: 12px;
    border-bottom: 1px dashed #f1f5f9;
    padding-bottom: 8px;
}
.detail-group:last-child {
    border-bottom: none;
    padding-bottom: 0;
    margin-bottom: 0;
}
.detail-label {
    font-size: 11px;
    color: #64748b;
    text-transform: uppercase;
    font-weight: 600;
    margin-bottom: 2px;
    text-align: left;
}
.detail-value {
    font-size: 13.5px;
    color: #1e293b;
    font-weight: 600;
    text-align: left;
}
.section-title-custom {
    font-size: 14.5px;
    font-weight: 700;
    color: #0f766e;
    border-left: 4px solid #0d9488;
    padding-left: 8px;
    margin-top: 15px;
    margin-bottom: 15px;
    text-align: left;
}
.clickable-row-item {
    cursor: pointer;
    transition: color 0.15s ease;
}
.clickable-row-item:hover {
    color: #0d9488 !important;
    text-decoration: underline;
}
</style>
<table id="example1" class="table table-bordered table-hover table-sm text-center">
<thead>
<tr>
<th>ລຳດັບ</th>
<th>ຊື່ແລະນາມສະກຸນ</th>
<th>ເພດ</th>
<th>ຊັ້ນ</th>
<th>ເລກບັດປະຈຳຕົວ</th>
<th>ໜ້າທີ່ຕຳແໜ່ງ</th>
<th>ກົມກອງ</th>
<th>ເອກະສານ</th>
<?php if($_SESSION['role']=="admin"){ ?>
<th>ຄຳສັ່ງ</th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php 
$i = 1;

$where_clauses = [];
$types = "";
$params = [];

if ($o_id > 0) {
    $where_clauses[] = "a.o_id = ?";
    $types .= "i";
    $params[] = $o_id;
}
if ($pk_id > 0) {
    $where_clauses[] = "a.pk_id = ?";
    $types .= "i";
    $params[] = $pk_id;
}
if ($u_id > 0) {
    $where_clauses[] = "a.u_id = ?";
    $types .= "i";
    $params[] = $u_id;
}
if ($d_id > 0) {
    $where_clauses[] = "a.d_id = ?";
    $types .= "i";
    $params[] = $d_id;
}

$sql_query = "SELECT 
a.*, 
b.d_name, 
c.u_name, 
d.pk_name, 
g.o_name, 
e.l_name, 
f.pt_name,
p.pro_name,
di.dis_name,
v.v_name
FROM officers AS a
LEFT JOIN department AS b ON a.d_id = b.d_id
LEFT JOIN units AS c ON a.u_id = c.u_id
LEFT JOIN panak AS d ON a.pk_id = d.pk_id
LEFT JOIN office AS g ON a.o_id = g.o_id
LEFT JOIN positions_level AS e ON a.l_id = e.l_id
LEFT JOIN positions AS f ON a.pt_id = f.pt_id
LEFT JOIN province AS p ON a.pro_id = p.pro_id
LEFT JOIN distict AS di ON a.dis_id = di.dis_id
LEFT JOIN village AS v ON a.v_id = v.v_id";

if (count($where_clauses) > 0) {
    $sql_query .= " WHERE " . implode(" AND ", $where_clauses);
}

$sql_query .= " ORDER BY a.officer_id DESC";

$stmt = $conn->prepare($sql_query);
if (count($params) > 0) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) { 
$fileLink = '';
if (!empty($row['file_document'])) {
$file = $row['file_document'];
$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

if ($ext === 'pdf') {
$fileLink = "
<a href='documents/{$file}' target='_blank' class='btn btn-success btn-xs'><i class='fas fa-file-pdf'></i> ເປີດ</a>";
} else {
$fileLink = "<a href='documents/{$file}' class='btn btn-success btn-xs' target='_blank'><i class='fas fa-download'></i> ດາວໂຫຼດ</a>";
}
}

?>
<tr>
<td><?= $i++ ?></td>
<td class="font-weight-bold">
<a href="#" class="view-details clickable-row-item text-dark" data-id="<?= $row['officer_id'] ?>" title="ຄລິກເພື່ອເບິ່ງລາຍລະອຽດ">
<?= htmlspecialchars($row['full_name']) ?> <?= htmlspecialchars($row['full_lastname']) ?>
</a>
</td>
<td class="text-center">
    <?php if ($row['gender'] === 'ຍິງ') { ?>
        <span class="badge-gender-woman"><i class="fas fa-venus"></i> ຍິງ</span>
    <?php } else { ?>
        <span class="badge-gender-man"><i class="fas fa-mars"></i> ຊາຍ</span>
    <?php } ?>
</td>
<td class="font-weight-bold"><?= htmlspecialchars($row['l_name']) ?></td>
<td><?= htmlspecialchars($row['national_id']) ?></td>
<td><?= htmlspecialchars($row['pt_name']) ?></td>
<td><?= htmlspecialchars($row['d_name']) ?></td>
<td class="text-center"><?= $fileLink ?></td>
<?php if ($_SESSION['role'] == "admin") { ?>
<td class="text-center">
    
<div class="btn-group">
  <button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" data-boundary="window" aria-expanded="false">
   <i class="fas fa-cog"></i> ຄຳສັ່ງ
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item view-details" href="#" data-id="<?= $row['officer_id'] ?>"><i class="fas fa-info-circle text-info"></i> ເບິ່ງລາຍລະອຽດ</a>
    <a class="dropdown-item" href="people_print.php?officer_id=<?= $row['officer_id'] ?>"><i class="ion-ios-printer text-success"></i> ພີມ</a>
    <a class="dropdown-item" href="show_table.php?officer_id=<?= $row['officer_id'] ?>"><i class="fas fa-trash text-danger"></i> ລົບ</a>
    <a class="dropdown-item" href="edit.php?officer_id=<?= $row['officer_id'] ?>"><i class="fas fa-edit text-primary"></i> ແກ້ໄຂ</a>
  </div>
</div>

</td>
<?php } ?>
</tr>
<?php } $stmt->close(); ?>

</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div> <!-- /.content-wrapper -->

<!-- Modal for Employee Details -->
<div class="modal fade" id="officerDetailModal" tabindex="-1" role="dialog" aria-labelledby="officerDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-content-custom">
      <div class="modal-header modal-header-custom">
        <h5 class="modal-title" id="officerDetailModalLabel"><i class="fas fa-id-card-alt mr-2"></i> ລາຍລະອຽດປະຫວັດພະນັກງານ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-white">
        
        <!-- Header summary profile section -->
        <div class="row align-items-center mb-4">
          <div class="col-md-3 text-center mb-3 mb-md-0">
            <img src="uploads/default_avatar.png" id="detail-photo" class="profile-modal-img" alt="ຮູບຖ່າຍພະນັກງານ">
          </div>
          <div class="col-md-9">
            <div class="profile-summary-card">
              <h4 class="font-weight-bold text-dark mb-2" id="detail-full-name">-</h4>
              <p class="mb-2"><span class="badge badge-teal" style="background-color: #0d9488; color: #fff; font-size: 13.5px; padding: 5px 12px; border-radius: 8px;" id="detail-rank">-</span></p>
              
              <div class="row mt-3">
                <div class="col-sm-6">
                  <span class="detail-label"><i class="fas fa-user-tag mr-1"></i> ຕຳແໜ່ງ:</span>
                  <div class="detail-value" id="detail-position">-</div>
                </div>
                <div class="col-sm-6">
                  <span class="detail-label"><i class="fas fa-sitemap mr-1"></i> ສັງກັດກົມກອງ:</span>
                  <div class="detail-value" id="detail-department">-</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Custom tabs navigation -->
        <ul class="nav nav-pills detail-modal-tabs mb-3 justify-content-center" id="modal-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="tab-personal-tab" data-toggle="pill" href="#tab-personal" role="tab" aria-selected="true"><i class="fas fa-user mr-1"></i> ຂໍ້ມູນສ່ວນຕົວ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tab-work-tab" data-toggle="pill" href="#tab-work" role="tab" aria-selected="false"><i class="fas fa-briefcase mr-1"></i> ຂໍ້ມູນສັງກັດ & ຊັ້ນ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tab-education-tab" data-toggle="pill" href="#tab-education" role="tab" aria-selected="false"><i class="fas fa-graduation-cap mr-1"></i> ການສຶກສາ & ວິຊາສະເພາະ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tab-family-tab" data-toggle="pill" href="#tab-family" role="tab" aria-selected="false"><i class="fas fa-users mr-1"></i> ຂໍ້ມູນຄອບຄົວ</a>
          </li>
        </ul>

        <!-- Tab contents -->
        <div class="tab-content border-top pt-3" id="modal-tabContent">
          
          <!-- Tab 1: Personal Info -->
          <div class="tab-pane fade show active" id="tab-personal" role="tabpanel">
            <div class="row">
              <div class="col-md-6">
                <h5 class="section-title-custom">ທົ່ວໄປ</h5>
                <div class="detail-group">
                  <div class="detail-label">ເພດ</div>
                  <div class="detail-value" id="detail-gender">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ວັນ, ເດືອນ, ປີເກີດ (ອາຍຸ)</div>
                  <div class="detail-value" id="detail-birth-date">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ຊົນເຜົ່າ & ສາດສະໜາ</div>
                  <div class="detail-value" id="detail-ethnicity-religion">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ເລກບັດປະຈຳຕົວ</div>
                  <div class="detail-value" id="detail-national-id">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ເບີໂທລະສັບ</div>
                  <div class="detail-value" id="detail-phone">-</div>
                </div>
              </div>
              <div class="col-md-6">
                <h5 class="section-title-custom">ທີ່ຢູ່ ແລະ ບ່ອນເກີດ</h5>
                <div class="detail-group">
                  <div class="detail-label">ບ້ານເກີດ</div>
                  <div class="detail-value" id="detail-birthplace">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ທີ່ຢູ່ປັດຈຸບັນ</div>
                  <div class="detail-value" id="detail-current-address">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ເລກທີເຮືອນ & ເສັ້ນທາງ</div>
                  <div class="detail-value" id="detail-home-road">-</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Tab 2: Work & Organization Info -->
          <div class="tab-pane fade" id="tab-work" role="tabpanel">
            <div class="row">
              <div class="col-md-6">
                <h5 class="section-title-custom">ການຈັດຕັ້ງສັງກັດ</h5>
                <div class="detail-group">
                  <div class="detail-label">ກົມກອງຂຶ້ນກັບ</div>
                  <div class="detail-value" id="detail-org-dept">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ຫ້ອງ / ກົມ</div>
                  <div class="detail-value" id="detail-org-unit">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ພະແນກ</div>
                  <div class="detail-value" id="detail-org-section">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ໜ່ວຍງານ</div>
                  <div class="detail-value" id="detail-org-office">-</div>
                </div>
              </div>
              <div class="col-md-6">
                <h5 class="section-title-custom">ວັນທີເຂົ້າອົງການຈັດຕັ້ງຕ່າງໆ</h5>
                <div class="detail-group">
                  <div class="detail-label">ວັນທີປະດັບຊັ້ນ / ເລື່ອນຊັ້ນ</div>
                  <div class="detail-value" id="detail-rank-date">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ວັນທີເຂົ້າການປະຕິວັດ</div>
                  <div class="detail-value" id="detail-revolution-date">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ວັນທີເຂົ້າກອງທັບ / ຕຳຫຼວດ</div>
                  <div class="detail-value" id="detail-police-date">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ວັນທີເຂົ້າພັກ (ສຳຮອງ / ສົມບູນ)</div>
                  <div class="detail-value" id="detail-party-date">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ວັນທີເຂົ້າອົງການຈັດຕັ້ງມະຫາຊົນ</div>
                  <div class="detail-value" id="detail-unions-date">-</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Tab 3: Education & Specialty Info -->
          <div class="tab-pane fade" id="tab-education" role="tabpanel">
            <div class="row">
              <div class="col-md-12">
                <div class="detail-group">
                  <div class="detail-label">ລະດັບວັດທະນະທຳ</div>
                  <div class="detail-value" id="detail-culture-level">-</div>
                </div>
              </div>
              
              <div class="col-md-6">
                <h5 class="section-title-custom">ລະດັບວິຊາສະເພາະ ປກສ</h5>
                <div class="detail-group">
                  <div class="detail-label">ລະດັບວິຊາສະເພາະ ສູງສຸດ</div>
                  <div class="detail-value" id="detail-pks-level">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ຂະແໜງວິຊາຮຽນ & ລະບົບ</div>
                  <div class="detail-value" id="detail-pks-major-system">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ສະຖາບັນການສຶກສາ / ປີຮຽນ</div>
                  <div class="detail-value" id="detail-pks-school-years">-</div>
                </div>
              </div>

              <div class="col-md-6">
                <h5 class="section-title-custom">ລະດັບທິດສະດີການເມືອງ</h5>
                <div class="detail-group">
                  <div class="detail-label">ລະດັບທິດສະດີ ສູງສຸດ</div>
                  <div class="detail-value" id="detail-pol-level">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ຂະແໜງວິຊາຮຽນ & ລະບົບ</div>
                  <div class="detail-value" id="detail-pol-major-system">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ສະຖາບັນການສຶກສາ / ປີຮຽນ</div>
                  <div class="detail-value" id="detail-pol-school-years">-</div>
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <h5 class="section-title-custom">ລະດັບວິຊາສະເພາະອື່ນໆ</h5>
                <div class="detail-group">
                  <div class="detail-label">ລະດັບວິຊາສະເພາະອື່ນໆ</div>
                  <div class="detail-value" id="detail-other-level">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ຂະແໜງວິຊາຮຽນ & ລະບົບ</div>
                  <div class="detail-value" id="detail-other-major-system">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ສະຖາບັນການສຶກສາ / ປີຮຽນ</div>
                  <div class="detail-value" id="detail-other-school-years">-</div>
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <h5 class="section-title-custom">ພາສາຕ່າງປະເທດ</h5>
                <div class="detail-group">
                  <div class="detail-label">ລະດັບພາສາຕ່າງປະເທດ</div>
                  <div class="detail-value" id="detail-languages">-</div>
                </div>
              </div>

            </div>
          </div>

          <!-- Tab 4: Family Info -->
          <div class="tab-pane fade" id="tab-family" role="tabpanel">
            <div class="row">
              <div class="col-md-6">
                <h5 class="section-title-custom">ປະຫວັດຂອງພໍ່</h5>
                <div class="detail-group">
                  <div class="detail-label">ຊື່ ແລະ ນາມສະກຸນພໍ່ (ອາຍຸ)</div>
                  <div class="detail-value" id="detail-father-name">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ອາຊີບ & ຊົນເຜົ່າ</div>
                  <div class="detail-value" id="detail-father-job-ethnicity">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ທີ່ຢູ່ປັດຈຸບັນ</div>
                  <div class="detail-value" id="detail-father-address">-</div>
                </div>
              </div>

              <div class="col-md-6">
                <h5 class="section-title-custom">ປະຫວັດຂອງແມ່</h5>
                <div class="detail-group">
                  <div class="detail-label">ຊື່ ແລະ ນາມສະກຸນແມ່ (ອາຍຸ)</div>
                  <div class="detail-value" id="detail-mother-name">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ອາຊີບ & ຊົນເຜົ່າ</div>
                  <div class="detail-value" id="detail-mother-job-ethnicity">-</div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">ທີ່ຢູ່ປັດຈຸບັນ</div>
                  <div class="detail-value" id="detail-mother-address">-</div>
                </div>
              </div>

              <div class="col-md-12 mt-3">
                <h5 class="section-title-custom">ປະຫວັດຄູ່ສົມລົດ (ຜົວ ຫຼື ເມຍ)</h5>
                <div class="row">
                  <div class="col-md-6">
                    <div class="detail-group">
                      <div class="detail-label">ຊື່ ແລະ ນາມສະກຸນຄູ່ສົມລົດ (ອາຍຸ)</div>
                      <div class="detail-value" id="detail-spouse-name">-</div>
                    </div>
                    <div class="detail-group">
                      <div class="detail-label">ອາຊີບ & ຊົນເຜົ່າ</div>
                      <div class="detail-value" id="detail-spouse-job-ethnicity">-</div>
                    </div>
                    <div class="detail-group">
                      <div class="detail-label">ຊົນຊັ້ນ & ສາດສະໜາ</div>
                      <div class="detail-value" id="detail-spouse-class-religion">-</div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="detail-group">
                      <div class="detail-label">ວັນທີແຕ່ງງານ</div>
                      <div class="detail-value" id="detail-marriage-date">-</div>
                    </div>
                    <div class="detail-group">
                      <div class="detail-label">ຈຳນວນລູກ</div>
                      <div class="detail-value" id="detail-spouse-children">-</div>
                    </div>
                    <div class="detail-group">
                      <div class="detail-label">ທີ່ຢູ່ປັດຈຸບັນ</div>
                      <div class="detail-value" id="detail-spouse-address">-</div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"></i> ປິດ</button>
      </div>
    </div>
  </div>
</div>

<?php include('../../controllers/footer.php'); ?>

<script>
$(document).ready(function() {
  $(document).on('click', '.view-details', function(e) {
    e.preventDefault();
    var officerId = $(this).data('id');
    
    // Reset modal fields to loading state
    resetModalFields();
    
    // Fetch details via AJAX
    $.ajax({
      url: 'get_officer_details.php',
      type: 'GET',
      data: { officer_id: officerId },
      dataType: 'json',
      success: function(data) {
        if (data.error) {
          Swal.fire({
            icon: 'error',
            title: 'ຜິດພາດ',
            text: data.error
          });
          return;
        }
        
        // Photo
        var photoName = data.photo_img ? data.photo_img : 'default_avatar.png';
        $('#detail-photo').attr('src', 'uploads/' + photoName);
        
        // Name & basic summary
        var fullName = (data.full_name || '') + ' ' + (data.full_lastname || '');
        $('#detail-full-name').text(fullName);
        $('#detail-rank').text(data.l_name || '-');
        $('#detail-position').text(data.pt_name || '-');
        $('#detail-department').text(data.d_name || '-');
        
        // TAB 1: Personal Info
        $('#detail-gender').html(
          data.gender === 'ຍິງ' 
            ? '<span class="badge-gender-woman"><i class="fas fa-venus"></i> ຍິງ</span>' 
            : '<span class="badge-gender-man"><i class="fas fa-mars"></i> ຊາຍ</span>'
        );
        
        var birthDateStr = data.birth_date ? formatDate(data.birth_date) : '-';
        var ageStr = data.age ? ' (' + data.age + ' ປີ)' : '';
        $('#detail-birth-date').text(birthDateStr + ageStr);
        
        var ethRel = (data.ethnicity || '-') + ' / ' + (data.religion || '-');
        $('#detail-ethnicity-religion').text(ethRel);
        
        $('#detail-national-id').text(data.national_id || '-');
        $('#detail-phone').text(data.numberphone || '-');
        
        // Address Birthplace
        var birthplace = (data.v_name || '-') + ', ' + (data.dis_name || '-') + ', ' + (data.pro_name || '-');
        $('#detail-birthplace').text(birthplace);
        
        // Address Current
        var currentAddr = (data.current_village || '-') + ', ' + (data.current_district || '-') + ', ' + (data.current_province || '-');
        $('#detail-current-address').text(currentAddr);
        
        var homeRoad = 'ເຮືອນເລກທີ: ' + (data.house_number || '-') + ' / ທາງ: ' + (data.road || '-') + ' / ໜ່ວຍ: ' + (data.block || '-');
        $('#detail-home-road').text(homeRoad);
        
        // TAB 2: Work & Organization Info
        $('#detail-org-dept').text(data.d_name || '-');
        $('#detail-org-unit').text(data.u_name || '-');
        $('#detail-org-section').text(data.pk_name || '-');
        $('#detail-org-office').text(data.o_name || '-');
        
        $('#detail-rank-date').text(data.date_level ? formatDate(data.date_level) : '-');
        $('#detail-revolution-date').text(data.date_join_revolution ? formatDate(data.date_join_revolution) : '-');
        $('#detail-police-date').text(data.date_join_police ? formatDate(data.date_join_police) : '-');
        
        var backupParty = data.date_join_party ? formatDate(data.date_join_party) : '-';
        var activeParty = data.date_join ? formatDate(data.date_join) : '-';
        $('#detail-party-date').html('ສຳຮອງ: ' + backupParty + ' <br> ສົມບູນ: ' + activeParty);
        
        var youthD = data.date_join_youth ? formatDate(data.date_join_youth) : '-';
        var womenD = data.date_join_women ? formatDate(data.date_join_women) : '-';
        var unionD = data.date_join_union ? formatDate(data.date_join_union) : '-';
        $('#detail-unions-date').html('ຊາວໜຸ່ມ: ' + youthD + ' | ແມ່ຍິງ: ' + womenD + ' | ກຳມະບານ: ' + unionD);
        
        // TAB 3: Education & Specialty Info
        $('#detail-culture-level').text(data.culture_level || '-');
        
        // PKS Specialty
        $('#detail-pks-level').text(data.lalup_pks || '-');
        var pksMajorSystem = 'ຂະແໜງ: ' + (data.kananghien || '-') + ' / ລະບົບ: ' + (data.labup || '-');
        $('#detail-pks-major-system').text(pksMajorSystem);
        var pksSchoolYears = 'ບ່ອນຮຽນ: ' + (data.school_one || '-') + ' / ປີຮຽນ: ' + (data.pihien || '-');
        $('#detail-pks-school-years').text(pksSchoolYears);
        
        // Political Theory
        $('#detail-pol-level').text(data.level_m || '-');
        var polMajorSystem = 'ຂະແໜງ: ' + (data.kananghien_m || '-') + ' / ລະບົບ: ' + (data.labup_m || '-');
        $('#detail-pol-major-system').text(polMajorSystem);
        var polSchoolYears = 'ບ່ອນຮຽນ: ' + (data.school_m || '-') + ' / ປີຮຽນ: ' + (data.pihien_m || '-');
        $('#detail-pol-school-years').text(polSchoolYears);
        
        // Other Specialty
        $('#detail-other-level').text(data.level_as || '-');
        var otherMajorSystem = 'ຂະແໜງ: ' + (data.kananghien_as || '-') + ' / ລະບົບ: ' + (data.labup_as || '-');
        $('#detail-other-major-system').text(otherMajorSystem);
        var otherSchoolYears = 'ບ່ອນຮຽນ: ' + (data.school_as || '-') + ' / ປີຮຽນ: ' + (data.pihien_as || '-');
        $('#detail-other-school-years').text(otherSchoolYears);
        
        // Languages
        $('#detail-languages').text(data.language_as || '-');
        
        // TAB 4: Family Info
        // Father
        var fatherAge = data.fage ? ' (' + data.fage + ' ປີ)' : '';
        $('#detail-father-name').text((data.ffull_name || '-') + fatherAge);
        $('#detail-father-job-ethnicity').text('ອາຊີບ: ' + (data.foccupation || '-') + ' / ຊົນເຜົ່າ: ' + (data.fzonpao || '-'));
        var fatherAddr = (data.fvillagename || '-') + ', ' + (data.fdisname || '-') + ', ' + (data.fproname || '-');
        $('#detail-father-address').text(fatherAddr === '0, 0, 0' ? '-' : fatherAddr);
        
        // Mother
        var motherAge = data.mage ? ' (' + data.mage + ' ປີ)' : '';
        $('#detail-mother-name').text((data.mfull_name || '-') + motherAge);
        $('#detail-mother-job-ethnicity').text('ອາຊີບ: ' + (data.moccupation || '-') + ' / ຊົນເຜົ່າ: ' + (data.mzonpao || '-'));
        var motherAddr = (data.mvillagename || '-') + ', ' + (data.mdisname || '-') + ', ' + (data.mproname || '-');
        $('#detail-mother-address').text(motherAddr === '0, 0, 0' ? '-' : motherAddr);
        
        // Spouse
        var spouseAge = data.falyages ? ' (' + data.falyages + ' ປີ)' : '';
        $('#detail-spouse-name').text((data.falyfull_name || '-') + spouseAge);
        $('#detail-spouse-job-ethnicity').text('ອາຊີບ: ' + (data.falyoccupation || '-') + ' / ຊົນເຜົ່າ: ' + (data.falyzonpao || '-'));
        $('#detail-spouse-class-religion').text('ຊົນຊັ້ນ: ' + (data.falyzozun || '-') + ' / ສາດສະໜາ: ' + (data.falyzadsana || '-'));
        $('#detail-marriage-date').text(data.family_date ? formatDate(data.family_date) : '-');
        $('#detail-spouse-children').text((data.falynumber_of_children || '0') + ' ຄົນ');
        var spouseAddr = (data.falyvillagename || '-') + ', ' + (data.falydisname || '-') + ', ' + (data.falyproname || '-');
        $('#detail-spouse-address').text(spouseAddr === '0, 0, 0' ? '-' : spouseAddr);
        
        // Open the modal
        $('#officerDetailModal').modal('show');
      },
      error: function(xhr, status, error) {
        Swal.fire({
          icon: 'error',
          title: 'ຜິດພາດ',
          text: 'ບໍ່ສາມາດເຊື່ອມຕໍ່ຂໍ້ມູນໄດ້'
        });
      }
    });
  });
  
  function resetModalFields() {
    $('#detail-photo').attr('src', 'uploads/default_avatar.png');
    $('#detail-full-name').text('ກຳລັງໂຫຼດ...');
    $('#detail-rank').text('-');
    $('#detail-position').text('-');
    $('#detail-department').text('-');
    
    // Reset tab content
    $('#modal-tabContent .detail-value').html('-');
    $('#tab-personal-tab').tab('show'); // Switch back to first tab
  }
  
  function formatDate(dateStr) {
    if (!dateStr || dateStr === '0000-00-00') return '-';
    var parts = dateStr.split('-');
    if (parts.length === 3) {
      return parts[2] + '/' + parts[1] + '/' + parts[0];
    }
    return dateStr;
  }
});
</script>

