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

$stmt = $conn->prepare("SELECT * FROM officers WHERE officer_id = ? AND user_id = ?");
$stmt->bind_param("ii", $officer_id, $user_id);
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
<a class="nav-link" id="step5-tab" data-toggle="pill" href="#step6" role="tab">ປະຫວັດພໍ່</a>
</li>

<li class="nav-item">
<a class="nav-link" id="step5-tab" data-toggle="pill" href="#step7" role="tab">ປະຫວັດແມ່</a>
</li>

<li class="nav-item">
<a class="nav-link" id="step5-tab" data-toggle="pill" href="#step8" role="tab">ສາຍພົວພັນຄອບຄົວ</a>
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
// กำหนดค่า Select2
$('#pro_id').select2({
width: '100%', // หรือ '100%'
placeholder: '-- ເລືອກແຂວງ --',
allowClear: true
});
});
</script>

<script>
$(document).ready(function() {

$('#o_id').select2({
width: '100%', // หรือ '100%'
placeholder: "-- ເລືອກ --",
allowClear: true
});
$('#d_id').select2({
width: '100%', // หรือ '100%'
placeholder: "-- ເລືອກ --",
allowClear: true
});

$('#u_id').select2({
width: '100%', // หรือ '100%'
placeholder: "-- ເລືອກ --",
allowClear: true
});

$('#pk_id').select2({
width: '100%', // หรือ '100%'
placeholder: "-- ເລືອກ --",
allowClear: true
});



$('#dis_id').select2({
width: '100%', // หรือ '100%'
placeholder: "-- ເລືອກ --",
allowClear: true
});

$('#v_id').select2({
width: '100%', // หรือ '100%'
placeholder: "-- ເລືອກ --",
allowClear: true
});
$('#pt_id').select2({
width: '100%', // หรือ '100%'
placeholder: "-- ເລືອກ --",
allowClear: true
});

$('#l_id').select2({
width: '100%', // หรือ '100%'
placeholder: "-- ເລືອກ --",
allowClear: true
});


});
</script>
<script>
$(document).ready(function () {
  $('.select2').select2({ width: '100%', placeholder: "-- ເລືອກ --", allowClear: true });

  const proId = "<?= $data['pro_id'] ?>";
  const disId = "<?= $data['dis_id'] ?>";
  const vId   = "<?= $data['v_id'] ?>";

  // โหลดเมืองตามจังหวัด
  if (proId) {
    $.post("ajax_db.php", { dis_id: proId, function: 'provinces' }, function (data) {
      $('#dis_id').html(data);
      $('#dis_id').val(disId).trigger('change');

      // โหลดบ้านตามเมือง
      if (disId) {
        $.post("ajax_db.php", { dis_id: disId, function: 'districts' }, function (data) {
          $('#v_id').html(data);
          $('#v_id').val(vId).trigger('change');
        });
      }
    });
  }

  // เปลี่ยนจังหวัด => โหลดเมืองใหม่
  $('#pro_id').change(function () {
    let dis_id = $(this).val();
    $('#dis_id').html('<option value="">-- ເລືອກເມືອງ --</option>');
    $('#v_id').html('<option value="">-- ເລືອກບ້ານ --</option>');
    $.post("ajax_db.php", { dis_id: dis_id, function: 'provinces' }, function (data) {
      $('#dis_id').html(data).trigger('change');
    });
  });

  // เปลี่ยนเมือง => โหลดบ้านใหม่
  $('#dis_id').change(function () {
    let dis_id = $(this).val();
    $('#v_id').html('<option value="">-- ເລືອກບ້ານ --</option>');
    $.post("ajax_db.php", { dis_id: dis_id, function: 'districts' }, function (data) {
      $('#v_id').html(data).trigger('change');
    });
  });

  // แสดง preview รูปภาพทันทีเมื่อเลือก
  $('#img').on('change', function () {
    const file = this.files[0];
    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function (e) {
        $('#preview').attr('src', e.target.result).show();
      };
      reader.readAsDataURL(file);
    } else {
      $('#preview').hide();
    }
  });
});
</script>

<script>

$('#pk_id').change(function(){
var pk_id  = $(this).val();
$.ajax({
type: "post",
url: "ajax_sungkud.php",
data:{pk_id  :pk_id  ,function:'pk_id'},
success: function(data){
$('#u_id').html(data);
}
});
});
</script>


<script>
$('#pro_id').change(function(){
var dis_id  = $(this).val();
$.ajax({
type: "post",
url: "ajax_db.php",
data:{dis_id  :dis_id  ,function:'provinces'},
success: function(data){
$('#dis_id').html(data);
}
});
});
</script>

<script>
$('#dis_id').change(function(){
var vill_id   = $(this).val();
$.ajax({
type: "post",
url: "ajax_db.php",
data:{vill_id  :vill_id  ,function:'districts'},
success: function(data){
$('#v_id').html(data);
}
});
});
</script>


