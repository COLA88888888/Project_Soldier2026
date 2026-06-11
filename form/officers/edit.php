<?php
include('../../controllers/head.php');
include('../../controllers/menu_left.php');
?>
<?php
include('../../condb.php');
if (!isset($_GET['officer_id'])) {
    echo "<script>window.location='show_table.php';</script>";
    exit;
}

$officer_id = intval($_GET['officer_id']);
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM officers WHERE officer_id = ?");
$stmt->bind_param("i", $officer_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$data) {
    echo "<script>alert('ບໍ່ພົບຂໍ້ມູນ'); window.location='show_table.php';</script>";
    exit;
}
?>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">ຟອມແກ້ໄຂ ປະຫວັດພະນັກງານ</h3>
</div>
<form id="uploadForm" enctype="multipart/form-data">
<div class="card-body">
<!-- Step Navigation -->
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="step1-tab" data-toggle="pill" href="#step1" role="tab">ບ່ອນສັງກັດ</a>
</li>
<li class="nav-item">
<a class="nav-link" id="step2-tab" data-toggle="pill" href="#step2" role="tab">ປະຫວັດພະນັກງານ</a>
</li>
<li class="nav-item">
<a class="nav-link" id="step3-tab" data-toggle="pill" href="#step3" role="tab">ລະດັບວິຊາສະເພາະ ທະຫານ</a>
</li>
<li class="nav-item">
<a class="nav-link" id="step4-tab" data-toggle="pill" href="#step4" role="tab">ສາຍອື່ນໆ</a>
</li>

<li class="nav-item">
<a class="nav-link" id="step5-tab" data-toggle="pill" href="#step5" role="tab">ລະດັບທິດສະດີການເມືອງ</a>
</li>

<li class="nav-item">
<a class="nav-link" id="step6-tab" data-toggle="pill" href="#step6" role="tab">ປະຫວັດພໍ່</a>
</li>

<li class="nav-item">
<a class="nav-link" id="step7-tab" data-toggle="pill" href="#step7" role="tab">ປະຫວັດແມ່</a>
</li>

<li class="nav-item">
<a class="nav-link" id="step8-tab" data-toggle="pill" href="#step8" role="tab">ສາຍພົວພັນຄອບຄົວ</a>
</li>

</ul>

<!-- Steps Content -->
<div class="tab-content" id="pills-tabContent">
<div class="tab-pane fade show active" id="step1" role="tabpanel">
<!-- Include fields from step 1 -->
<?php include('edit_stepone.php'); ?>
</div>

<div class="tab-pane fade" id="step2" role="tabpanel">
<!-- Include fields from step 2 -->
<?php include('edit_teptwo.php'); ?>
</div>

<div class="tab-pane fade" id="step3" role="tabpanel">
<!-- Include fields from step 3 -->
<?php include('edit_stepthree.php'); ?>
</div>

<div class="tab-pane fade" id="step4" role="tabpanel">
<!-- Include fields from step 4 -->
<?php include('edit_stepfour.php'); ?>
</div>

<div class="tab-pane fade" id="step5" role="tabpanel">
<!-- Include fields from step 5 -->
<?php include('edit_stepfive.php'); ?>
</div>

<div class="tab-pane fade" id="step6" role="tabpanel">
<!-- Include fields from step 5 -->
<?php include('edit_fathers.php'); ?>
</div>

<div class="tab-pane fade" id="step7" role="tabpanel">
<!-- Include fields from step 5 -->
<?php include('edit_mother.php'); ?>
</div>

<div class="tab-pane fade" id="step8" role="tabpanel">
<!-- Include fields from step 5 -->
<?php include('edit_family.php'); ?>
</div>

</div>
</div>
<div class="card-footer text-center">
<button type="button" class="btn btn-secondary" id="prevBtn">ກ່ອນໜ້າ</button>
<button type="button" class="btn btn-info" id="nextBtn">ຖັດໄປ</button>
<button type="submit"  class="btn btn-primary" style="display:none">ບັນທຶກ</button>
</div>
</form>

<div id="show"></div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include('../../controllers/footer.php'); ?>


<script>
$(document).ready(function (e) {
$("#uploadForm").on('submit',(function(e) {
e.preventDefault();
$.ajax({
url: "edit_data.php",
type: "POST",
data: new FormData(this),
contentType: false,
cache: false,
processData:false,
success: function(data)
{
$("#show").html(data);
},
error: function() 
{
} 
});
}));

$('#photo_img').on('change', function() {
    const file = this.files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#preview').attr('src', e.target.result).show();
        }
        reader.readAsDataURL(file);
    } else {
        $('#preview').hide();
    }
});
});

</script>

<script>
$(document).ready(() => {
  let currentStep = 0; // 👉 เริ่มที่ Step5
  const steps = ["#step1", "#step2", "#step3", "#step4", "#step5", "#step6", "#step7", "#step8"];
  const tabLinks = ["#step1-tab", "#step2-tab", "#step3-tab", "#step4-tab", "#step5-tab", "#step6-tab", "#step7-tab", "#step8-tab"];

  function showStep(index) {
    currentStep = index;
    $(tabLinks[index]).tab('show');
    $('#prevBtn').toggle(index > 0);
    $('#nextBtn').toggle(index < steps.length - 1);
    $('button[type=submit]').toggle(index === steps.length - 1);
  }

  $('#nextBtn').click(() => {
    if (currentStep < steps.length - 1) {
      currentStep++;
      showStep(currentStep);
    }
  });

  $('#prevBtn').click(() => {
    if (currentStep > 0) {
      currentStep--;
      showStep(currentStep);
    }
  });

  // ✅ เมื่อกดเปลี่ยน tab ด้วย nav-pills
  $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
    const targetId = $(e.target).attr('href'); // เช่น #step2
    const newIndex = steps.indexOf(targetId);
    if (newIndex !== -1) {
      showStep(newIndex);
    }
  });

  showStep(currentStep); // เริ่มต้นที่ Step5
});

</script>

<script>
$(document).ready(function() {
  $('#o_id').select2({ width: '100%', placeholder: "-- ເລືອກ --", allowClear: true });
  $('#d_id').select2({ width: '100%', placeholder: "-- ເລືອກ --", allowClear: true });
  $('#u_id').select2({ width: '100%', placeholder: "-- ເລືອກ --", allowClear: true });
  $('#pk_id').select2({ width: '100%', placeholder: "-- ເລືອກ --", allowClear: true });
  $('#pt_id').select2({ width: '100%', placeholder: "-- ເລືອກ --", allowClear: true });
  $('#l_id').select2({ width: '100%', placeholder: "-- ເລືອກ --", allowClear: true });
  $('#current_province_id').select2({ width: '100%', placeholder: "-- ເລືອກແຂວງ --", allowClear: true });
  $('#current_district_id').select2({ width: '100%', placeholder: "-- ເລືອກເມືອງ --", allowClear: true });
  $('#f_province_id').select2({ width: '100%', placeholder: "-- ເລືອກແຂວງ --", allowClear: true });
  $('#f_district_id').select2({ width: '100%', placeholder: "-- ເລືອກເມືອງ --", allowClear: true });
  $('#m_province_id').select2({ width: '100%', placeholder: "-- ເລືອກແຂວງ --", allowClear: true });
  $('#m_district_id').select2({ width: '100%', placeholder: "-- ເລືອກເມືອງ --", allowClear: true });
  $('#faly_province_id').select2({ width: '100%', placeholder: "-- ເລືອກແຂວງ --", allowClear: true });
  $('#faly_district_id').select2({ width: '100%', placeholder: "-- ເລືອກເມືອງ --", allowClear: true });
});
</script>

<script>
$(document).ready(function () {
  $('.select2').select2({ width: '100%', placeholder: "-- ເລືອກ --", allowClear: true });

  const proId = "<?= $data['pro_id'] ?>";
  const disId = "<?= $data['dis_id'] ?>";

  // ໂຫຼດເມືອງຕາມຈັງຫວັດທີ່ມີຢູ່ແລ້ວ
  if (proId) {
    $.post("ajax_db.php", { pro_id: proId, function: 'provinces' }, function (data) {
      $('#dis_id').html(data);
      $('#dis_id').val(disId).trigger('change');
    });
  }

  // ປ່ຽນຈັງຫວັດ => ໂຫຼດເມືອງໃໝ່
  $('#pro_id').change(function () {
    let pro_id = $(this).val();
    $('#dis_id').html('<option value="">-- ເລືອກເມືອງ --</option>');
    $.post("ajax_db.php", { pro_id: pro_id, function: 'provinces' }, function (data) {
      $('#dis_id').html(data).trigger('change');
    });
  });

  // ໂຫຼດເມືອງຕາມຈັງຫວັດປັດຈຸບັນທີ່ມີຢູ່ແລ້ວ
  const currentProId = "<?= $curr_pro_id ?? '' ?>";
  const currentDisId = "<?= $curr_dis_id ?? '' ?>";

  if (currentProId) {
    $.post("ajax_db.php", { pro_id: currentProId, function: 'provinces' }, function (data) {
      $('#current_district_id').html(data);
      $('#current_district_id').val(currentDisId).trigger('change');
    });
  }

  // ປ່ຽນຈັງຫວັດປັດຈຸບັນ => ໂຫຼດເມືອງປັດຈຸບັນໃໝ່
  $('#current_province_id').change(function () {
    let pro_id = $(this).val();
    $('#current_district_id').html('<option value="">-- ເລືອກເມືອງ --</option>');
    if (pro_id) {
      $.post("ajax_db.php", { pro_id: pro_id, function: 'provinces' }, function (data) {
        $('#current_district_id').html(data).trigger('change');
      });
    }
  });

  // ໂຫຼດເມືອງຕາມຈັງຫວັດຂອງພໍ່ທີ່ມີຢູ່ແລ້ວ
  const fProId = "<?= $f_pro_id ?? '' ?>";
  const fDisId = "<?= $f_dis_id ?? '' ?>";

  if (fProId) {
    $.post("ajax_db.php", { pro_id: fProId, function: 'provinces' }, function (data) {
      $('#f_district_id').html(data);
      $('#f_district_id').val(fDisId).trigger('change');
    });
  }

  // ປ່ຽນຈັງຫວັດຂອງພໍ່ => ໂຫຼດເມືອງໃໝ່
  $('#f_province_id').change(function () {
    let pro_id = $(this).val();
    $('#f_district_id').html('<option value="">-- ເລືອກເມືອງ --</option>');
    if (pro_id) {
      $.post("ajax_db.php", { pro_id: pro_id, function: 'provinces' }, function (data) {
        $('#f_district_id').html(data).trigger('change');
      });
    }
  });

  // ໂຫຼດເມືອງຕາມຈັງຫວັດຂອງແມ່ທີ່ມີຢູ່ແລ້ວ
  const mProId = "<?= $m_pro_id ?? '' ?>";
  const mDisId = "<?= $m_dis_id ?? '' ?>";

  if (mProId) {
    $.post("ajax_db.php", { pro_id: mProId, function: 'provinces' }, function (data) {
      $('#m_district_id').html(data);
      $('#m_district_id').val(mDisId).trigger('change');
    });
  }

  // ປ່ຽນຈັງຫວັດຂອງແມ່ => ໂຫຼດເມືອງໃໝ່
  $('#m_province_id').change(function () {
    let pro_id = $(this).val();
    $('#m_district_id').html('<option value="">-- ເລືອກເມືອງ --</option>');
    if (pro_id) {
      $.post("ajax_db.php", { pro_id: pro_id, function: 'provinces' }, function (data) {
        $('#m_district_id').html(data).trigger('change');
      });
    }
  });

  // ໂຫຼດເມືອງຕາມຈັງຫວັດຂອງຄູ່ສົມລົດທີ່ມີຢູ່ແລ້ວ
  const falyProId = "<?= $faly_pro_id ?? '' ?>";
  const falyDisId = "<?= $faly_dis_id ?? '' ?>";

  if (falyProId) {
    $.post("ajax_db.php", { pro_id: falyProId, function: 'provinces' }, function (data) {
      $('#faly_district_id').html(data);
      $('#faly_district_id').val(falyDisId).trigger('change');
    });
  }

  // ປ່ຽນຈັງຫວັດຂອງຄູ່ສົມລົດ => ໂຫຼດເມືອງໃໝ່
  $('#faly_province_id').change(function () {
    let pro_id = $(this).val();
    $('#faly_district_id').html('<option value="">-- ເລືອກເມືອງ --</option>');
    if (pro_id) {
      $.post("ajax_db.php", { pro_id: pro_id, function: 'provinces' }, function (data) {
        $('#faly_district_id').html(data).trigger('change');
      });
    }
  });
});
</script>
