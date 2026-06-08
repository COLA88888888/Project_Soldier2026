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
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for="d_name">ລະດັບທິດສະດີການເມືອງ</label>
<input type="text" class="form-control" name="level_m" id="level_m" value="<?= htmlspecialchars($data['level_m']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຂະແໜງຮຽນ</label>
<input type="text" class="form-control" name="kananghien_m" id="kananghien_m" value="<?= htmlspecialchars($data['kananghien_m']) ?>"  placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ລະບົບ</label>
<input type="text" class="form-control" name="labup_m" id="labup_m" value="<?= htmlspecialchars($data['labup_m']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 

</div>
<div class="col-sm-6">
    <div class="form-group">
<label for="d_name">ໂຮງຮຽນ</label>
<input type="text" class="form-control" name="school_m" id="school_m" value="<?= htmlspecialchars($data['school_m']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ປີຮຽນ</label>
<input type="text" class="form-control" name="pihien_m" id="pihien_m" value="<?= htmlspecialchars($data['pihien_m']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ປີໃດຫາປີໃດ</label>
<input type="text" class="form-control" name="p_p_m" id="p_p_m" value="<?= htmlspecialchars($data['p_p_m']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 

</div>
</div>

