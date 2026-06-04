<?php include('../../controllers/head.php'); ?>
<?php include('../../controllers/menu_left.php'); ?>
<div class="content-wrapper">

<div class="container-fluid">
<div class="row">
<div class="col-lg-12">

  <style>
    @page {
      size: A4 portrait;
      margin: 20mm;
    }

    body {
      font-family: 'Phetsarath OT', sans-serif;
      font-size: 14px;
      padding: 10mm;
      background: white;
    }

    .container-a4 {
      width: 210mm;
      min-height: 297mm;
      margin: 0 auto;
      padding: 20px;
      background: #fff;
      border: 1px solid #ddd;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }

    .form-header {
      text-align: center;
      font-weight: bold;
      margin-bottom: 20px;
      font-size: 20px;
    }

    .photo-box {
      width: 120px;
      height: 150px;
      border: 1px solid #000;
      background: url('uploads/photo.jpg') center center no-repeat;
      background-size: cover;
    }

    .form-section {
      margin-bottom: 10px;
    }

    .form-line {
      border-bottom: 1px dotted #000;
      display: inline-block;
      min-width: 100px;
      margin: 0 5px;
      height: 24px;
    }

    .checkbox-group {
      display: inline-block;
      margin: 0 10px;
    }

    @media print {
      body {
        padding: 0;
        background: none;
      }

      .container-a4 {
        box-shadow: none;
        border: none;
      }
    }
    @media print {
  .d-print-none,.main-footer {
    display: none !important;
  }
}

  </style>
</head>
<body>
<div class="text-right mb-3 d-print-none">
  <button class="btn btn-primary" onclick="window.print()">
    🖨️ ພິມເອກະສານ
  </button>
</div>

  <div class="container-a4">
    <div class="form-header">ປະຫວັດສ່ວນຕົວຂອງຂ້າຮາຊການ</div>

    <div class="row mb-3">
      <div class="col-md-2 text-center">
        <div class="photo-box"></div>
      </div>
      <div class="col-md-10">
        <div class="form-section">
          ຊື່: <span class="form-line" style="width:200px;"></span>
          ນາມສະກຸນ: <span class="form-line" style="width:200px;"></span>
          ເພດ:
          <label class="checkbox-group"><input type="checkbox"> ຍິງ</label>
          <label class="checkbox-group"><input type="checkbox"> ຊາຍ</label>
        </div>

        <div class="form-section">
          ສັນຊາດ: <span class="form-line" style="width:150px;"></span>
          ຊົນເຜົ່າ: <span class="form-line" style="width:150px;"></span>
          ສາສະໜາ: <span class="form-line" style="width:150px;"></span>
        </div>

        <div class="form-section">
          ສະຖານທີ່ເກີດ: <span class="form-line" style="width:300px;"></span>
        </div>

        <div class="form-section">
          ວັນ, ເດືອນ, ປີເກີດ: <span class="form-line" style="width:200px;"></span>
          ອາຍຸ: <span class="form-line" style="width:60px;"></span> ປີ
        </div>

        <div class="form-section">
          ສູງ: <span class="form-line" style="width:60px;"></span> ຊມ.
          ໜັກ: <span class="form-line" style="width:60px;"></span> ກິໂລກຣາມ
        </div>

        <div class="form-section">
          ເລກບັດປະຈຳຕົວ: <span class="form-line" style="width:200px;"></span>
          ເລກປະຈຳຕົວປະຊາຊົນ: <span class="form-line" style="width:200px;"></span>
        </div>

        <div class="form-section">
          ເຂົ້າຮັບລາຊການວັນທີ: <span class="form-line" style="width:150px;"></span>
          ເຂົ້າພັກປະຊາຊົນ: <span class="form-line" style="width:150px;"></span>
        </div>

        <div class="form-section">
          ເຂົ້າເປັນສະມາຊິກຍະວະຊົນ: <span class="form-line" style="width:150px;"></span>
          ເຂົ້າພັກແບບເຕັມ: <span class="form-line" style="width:150px;"></span>
        </div>

        <div class="form-section">
          ລະດັບການສຶກສາສູງສຸດ:
          <label class="checkbox-group"><input type="checkbox"> ປະຖົມ</label>
          <label class="checkbox-group"><input type="checkbox"> ມ.ຕົ້ນ</label>
          <label class="checkbox-group"><input type="checkbox" checked> ມ.7</label>
        </div>

        <div class="form-section">
          ວຸດທິການສຶກສາສາຂາວິຊາ:
          <span class="form-line" style="width:250px;"></span>
        </div>

        <div class="form-section">
          ຄວາມສາມາດພິເສດ:
          <span class="form-line" style="width:250px;"></span>
        </div>

        <div class="form-section">
          ພາສາຕ່າງປະເທດທີ່ສື່ສານໄດ້:
          <span class="form-line" style="width:250px;"></span>
        </div>

        <div class="form-section">
          ຮູ້ກົດໝາຍແຜ່ນດິນ ແລະສະໝັກໃຈຮັບໃຊ້:
          <label class="checkbox-group"><input type="checkbox" checked> ແມ່ນ</label>
          <label class="checkbox-group"><input type="checkbox"> ບໍ່ແມ່ນ</label>
        </div>
      </div>
    </div>
  </div>



</div>
</div>
</div>
</div>
</div>
<?php include('../../controllers/footer.php'); ?>