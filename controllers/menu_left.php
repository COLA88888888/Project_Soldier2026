<?php
if (session_status() === PHP_SESSION_NONE) session_start();
// ດຶງຂໍ້ມູນຜູ້ໃຊ້ທີ່ login ຈາກ DB
$_sidebar_user_name  = isset($_SESSION['name'])    ? $_SESSION['name']    : 'ຜູ້ໃຊ້';
$_sidebar_user_img   = '';
$_sidebar_user_role  = isset($_SESSION['role'])    ? $_SESSION['role']    : '';
if (isset($_SESSION['user_id'])) {
    include_once('../../condb.php');
    $__sid  = (int)$_SESSION['user_id'];
    $__stmt = $conn->prepare("SELECT name, img FROM users WHERE user_id = ? LIMIT 1");
    $__stmt->bind_param("i", $__sid);
    $__stmt->execute();
    $__r = $__stmt->get_result()->fetch_assoc();
    $__stmt->close();
    if ($__r) {
        $_sidebar_user_name = $__r['name']  ?: $_sidebar_user_name;
        $_sidebar_user_img  = $__r['img']   ?: '';
    }
}
// ກຳນົດ path ຮູບ
$_sidebar_img_path = (!empty($_sidebar_user_img) && file_exists("../../form/users/uploads/" . $_sidebar_user_img))
    ? "../../form/users/uploads/" . $_sidebar_user_img
    : "../../logo/1.jfif";
// badge role
$_sidebar_badge = ($_sidebar_user_role === 'admin') ? '🛡️ Admin' : '👤 ຜູ້ໃຊ້';
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<style>
  .brand-link {
    overflow: hidden;
  }
  .brand-text-custom {
    display: block;
    font-size: 13.5px !important;
    font-weight: 600;
    line-height: 1.3;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 180px;
    color: #fff;
    letter-spacing: 0.2px;
  }
  /* User panel style */
  .user-panel .info a.d-block {
    font-size: 13px;
    font-weight: 700;
    color: #fff;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 140px;
  }
  .user-panel .info .role-badge {
    font-size: 10px;
    color: #94d3c9;
    margin-top: 2px;
    display: block;
  }
  .user-panel .image img {
    width: 34px;
    height: 34px;
    object-fit: cover;
    border: 2px solid #0d9488;
  }
</style>
<a href="../../form/admin/index.php" class="brand-link" title="ລະບົບບໍລິຫານ ບຸກຄະລາກອນ ແລະ ເງີນເດືອນກອງພົນທີ3">
<img src="../../logo/1.jfif" alt="AdminLTE Logo" class="brand-image elevation-3"
 style="opacity: .9; border-radius: 4px;">
<span class="brand-text brand-text-custom">ລະບົບບໍລິຫານ ບຸກຄະລາກອນ ແລະ ເງີນເດືອນກອງພົນທີ3</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
<!-- Sidebar user panel -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
<div class="image">
  <img src="<?= htmlspecialchars($_sidebar_img_path) ?>"
       class="img-circle elevation-2"
       alt="<?= htmlspecialchars($_sidebar_user_name) ?>"
       onerror="this.src='../../logo/1.jfif'">
</div>
<div class="info">
  <a href="#" class="d-block" title="<?= htmlspecialchars($_sidebar_user_name) ?>">
    <?= htmlspecialchars($_sidebar_user_name) ?>
  </a>
  <span class="role-badge"><?= $_sidebar_badge ?></span>
</div>
</div>
<!-- SidebarSearch Form -->
<!-- Sidebar Menu -->
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon ion-home"></i>
<p>
ໜ້າຫຼັກ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/officers/pelsoin_id.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ໜ້າຫຼັກ</p>
</a>
</li>

<li class="nav-item">
<a href="../../form/admin/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li>

<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon ion-android-list"></i>
<p>
ປະຫວັດພະນັກງານ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/officers/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>

<li class="nav-item">
<a href="../../form/officers/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li>
<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon ion-cash"></i>
<p>
ເງິນເດືອນພົນທະຫານ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/soldier_salary/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທຶກ</p>
</a>
</li>
<li class="nav-item">
<a href="../../form/soldier_salary/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li><!-- 
<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon fas fa-table"></i>
<p>
ສາຍພົວພັນຄອບຄົວ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/officers/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>

<li class="nav-item">
<a href="../../form/officers/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li>

<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon fas fa-table"></i>
<p>
ການສືກສາ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/educations/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>

<li class="nav-item">
<a href="../../form/educations/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li> -->
 




<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon ion-android-star-half"></i>
<p>
ເລື່ອນຊັ້ນ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/level_up/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>
<li class="nav-item">
<a href="../../form/level_up/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li>


<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon ion-arrow-swap"></i>
<p>
ຍ້າຍເຂົ້າ-ຍ້າຍອອກ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/transfer_records/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>
<li class="nav-item">
<a href="../../form/transfer_records/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li>

<!-- <li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon fas fa-table"></i>
<p>
ພະນັກງານບຳນານ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/categoreis/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>
<li class="nav-item">
<a href="../../form/categoreis/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li> -->


<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon ion-home"></i>
<p>
ກົມກອງ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/department/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>
<li class="nav-item">
<a href="../../form/department/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li>

<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon ion-ios-book-outline"></i>
<p>
ກົມ/ຫ້ອງ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/office/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>
<li class="nav-item">
<a href="../../form/office/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li>
<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon ion-ios-bookmarks"></i>
<p>
ພະແນກ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/panak/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>
<li class="nav-item">
<a href="../../form/panak/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li>
<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon ion-ios-color-filter"></i>
<p>
ໜ່ວຍງານ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/units/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>
<li class="nav-item">
<a href="../../form/units/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li>

<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon ion-android-star-half"></i>
<p>
ຊັ້ນ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/positions_level/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>
<li class="nav-item">
<a href="../../form/positions_level/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li>
<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon ion-android-calendar"></i>
<p>
ກຳນົດປີເລື່ອນຊັ້ນ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/rank_position/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>
<li class="nav-item">
<a href="../../form/rank_position/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li>

<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon ion-ios-list-outline"></i>
<p>
ໜ້າທີ່ຕຳແໜ່ງ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/positions/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>
<li class="nav-item">
<a href="../../form/positions/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li>
<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon ion-ios-location"></i>
<p>
ແຂວງ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/province/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>
<li class="nav-item">
<a href="../../form/province/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li>
<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon ion-android-home"></i>
<p>
ເມືອງ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/distict/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>
<li class="nav-item">
<a href="../../form/distict/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li>
<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon ion-android-home"></i>
<p>
ບ້ານ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/village/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>
<li class="nav-item">
<a href="../../form/village/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li>
<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon ion-ios-people"></i>
<p>
ຜູ້ນຳໃຊ້ລະບົບ
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="../../form/users/index.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ບັນທືກ</p>
</a>
</li>
<li class="nav-item">
<a href="../../form/users/show_table.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>ລາຍງານຂໍ້ມູນ</p>
</a>
</li>
</ul>
</li>




</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>