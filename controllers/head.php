<?php
session_start();
if (!isset($_SESSION['user_id']) && !isset($_SESSION['role'])) {
    echo "
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset='UTF-8'>
      <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
      <style>
        body {
          font-family: 'Saysettha OT';

       
        }
      </style>
    </head>
    <body>
    <script>
      Swal.fire({
        icon: 'warning',
        title: 'ກະລຸນາເຂົ້າລະບົບກ່ອນ',
        showConfirmButton: false,
        timer: 4000
      }).then(() => {
        window.location.href = '../../index.php';
      });
    </script>
    </body>
    </html>
    ";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ລະບົບບໍລິຫານ ບຸກຄະລາກອນ ແລະ ເງິນເດືອນກອງພົນທີ3</title>

<!-- Google Font removed (local Lao fonts used instead for faster loading) -->
<!-- Font Awesome -->
<link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
  <link rel="icon" type="image/png" href="../../logo/1.jfif">
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Theme style (AdminLTE) -->
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Ionicons (local) -->
<link rel="stylesheet" href="../../ionicons-2.0.1/css/ionicons.min.css">

<script src="../../sweetalert/jquery-3.6.0.js"></script>
<script src="../../sweetalert/dist/sweetalert2.all.min.js"></script>

<!-- CSS -->
<link href="../../select2/select2.min.css" rel="stylesheet" />
<link href="../../select2/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<link rel="stylesheet" href="select2-bootstrap-5-theme.min.css" />
<!-- DataTables CSS -->
<!-- <link rel="stylesheet" href="../../form/officers/css_print.css"> -->

<style>
  * {
    font-family: 'Saysettha OT', 'Phetsarath OT', 'Noto Sans Lao', sans-serif;
  }
  
  /* Global Card Beautification */
  .card {
    border: none !important;
    border-radius: 16px !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04) !important;
    overflow: hidden !important;
    transition: all 0.3s ease;
    margin-bottom: 24px;
  }
  .card-header {
    background: linear-gradient(135deg, #0d9488, #0f766e) !important;
    color: #fff !important;
    border-bottom: none !important;
    padding: 18px 24px !important;
  }
  .card-title {
    font-weight: bold !important;
    font-size: 16px !important;
  }
  
  /* Global Form Control Beautification */
  .form-control {
    border-radius: 8px !important;
    border: 1px solid #cbd5e1 !important;
    padding: 10px 14px !important;
    height: auto !important;
    transition: all 0.2s ease-in-out !important;
  }
  .form-control:focus {
    border-color: #0d9488 !important;
    box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15) !important;
  }
  
  /* Global Table Beautification */
  .table {
    border-collapse: separate !important;
    border-spacing: 0 !important;
    border-radius: 8px !important;
    overflow: hidden !important;
    border: 1px solid #cbd5e1 !important;
  }
  .table thead th {
    background: linear-gradient(135deg, #007bff, #0056b3) !important;
    color: #fff !important;
    font-weight: bold !important;
    border: 1px solid #0056b3 !important;
    padding: 12px 8px !important;
    vertical-align: middle !important;
    font-size: 13px;
  }
  .table tbody td {
    padding: 10px 8px !important;
    border: 1px solid #cbd5e1 !important;
    vertical-align: middle !important;
    transition: background-color 0.15s ease;
  }
  .table tbody tr:hover td {
    background-color: #f0fdfa !important; /* Soft premium teal highlight */
  }
  
  /* Global Select2 Customizer */
  .select2-container .select2-selection--single {
    height: 44px !important;
    padding: 8px 12px !important;
    border: 1px solid #cbd5e1 !important;
    border-radius: 8px !important;
    transition: all 0.2s ease-in-out !important;
  }
  .select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #0d9488 !important;
    box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15) !important;
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 42px !important;
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 26px !important;
  }
  
  /* Global Button Beautification */
  .btn {
    border-radius: 8px !important;
    padding: 8px 16px;
    font-weight: 600 !important;
    transition: all 0.2s !important;
  }
  .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<!-- Preloader removed for faster page navigation -->

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
<!-- Left navbar links -->
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
  </li>
  <li class="nav-item d-none d-sm-inline-block">
    <a href="../../form/officers/pelsoin_id.php" class="nav-link">ໜ້າຫຼັກ</a>
  </li>
  
    <li class="nav-item d-none d-sm-inline-block">
    <a href="../../form/admin/index.php" class="nav-link">ລາຍງານຂໍ້ມູນ</a>
  </li>
  <li class="nav-item d-none d-sm-inline-block">
    <span class="nav-link" style="color:red;">
      <b>
        <span id="lao-date"></span> | <span id="txt"></span>
      </b>
    </span>
  </li>
</ul>

<script>
  function updateDateTime() {
    const days = ["ວັນທິດ", "ວັນຈັນ", "ວັນຄານ", "ວັນພຸດ", "ວັນພະຫັດ", "ວັນສຸກ", "ວັນເສົາ"];
    const now = new Date();
    const d = now.getDate().toString().padStart(2, '0');
    const m = (now.getMonth() + 1).toString().padStart(2, '0');
    const y = now.getFullYear();
    const h = now.getHours().toString().padStart(2, '0');
    const min = now.getMinutes().toString().padStart(2, '0');
    const s = now.getSeconds().toString().padStart(2, '0');
    
    const dayName = days[now.getDay()];
    document.getElementById('lao-date').textContent = `${dayName} ${d}-${m}-${y}`;
    document.getElementById('txt').textContent = `${h}:${min}:${s}`;
  }

  setInterval(updateDateTime, 1000);
  updateDateTime(); // เรียกทันทีตอนโหลดหน้า
</script>


<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
<!-- Navbar Search -->
<li class="nav-item">
<a class="nav-link" data-widget="navbar-search" href="#" role="button">
<i class="fas fa-search"></i>
</a>
<div class="navbar-search-block">
<form class="form-inline">
<div class="input-group input-group-sm">
<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
<div class="input-group-append">
<button class="btn btn-navbar" type="submit">
<i class="fas fa-search"></i>
</button>
<button class="btn btn-navbar" type="button" data-widget="navbar-search">
<i class="fas fa-times"></i>
</button>
</div>
</div>
</form>
</div>
</li>
<li class="nav-item topbar-user dropdown hidden-caret">
<a class="btn btn-danger logout btn-sm" href="../../logout.php"> <i class="ion-android-exit"></i>
ອອກຈາກລະບົບ
</a>
</li>
<!-- Messages Dropdown Menu -->

<!-- Notifications Dropdown Menu -->

<li class="nav-item">
<a class="nav-link" data-widget="fullscreen" href="#" role="button">
<i class="fas fa-expand-arrows-alt"></i>
</a>
</li>
<li class="nav-item">
<a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
<i class="fas fa-th-large"></i>
</a>
</li>
</ul>
</nav>