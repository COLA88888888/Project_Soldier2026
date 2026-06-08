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
<label for="d_name">ລະດັບວິຊາສະເພາະ ທະຫານ</label>
<input type="text" class="form-control" name="lalup_pks" id="lalup_pks" value="<?= htmlspecialchars($data['lalup_pks']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ພາຍໃນ ຫຼື ຕ່າງປະເທດ</label>
<input type="text" class="form-control" name="paiyin" id="paiyin" value="<?= htmlspecialchars($data['paiyin']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຂະແໜງຮຽນ</label>
<input type="text" class="form-control" name="kananghien" id="kananghien" value="<?= htmlspecialchars($data['kananghien']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ລະບົບ</label>
<input type="text" class="form-control" name="labup" id="labup" value="<?= htmlspecialchars($data['labup']) ?>"  placeholder="ກະລຸນາປ້ອນ">
</div> 
</div> 

<div class="col-sm-6">
<div class="form-group">
<label for="d_name">ໂຮງຮຽນ</label>
<input type="text" class="form-control" name="school_one" id="school_one" value="<?= htmlspecialchars($data['school_one']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>


<div class="form-group">
<label for="d_name">ປີຮຽນ</label>
<input type="text" class="form-control" name="pihien" id="pihien" value="<?= htmlspecialchars($data['pihien']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>

<div class="form-group">
<label for="d_name">ປີໃດຫາປີໃດ</label>
<input type="text" class="form-control" name="p_p" id="p_p" value="<?= htmlspecialchars($data['p_p']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>
</div>
</div>

