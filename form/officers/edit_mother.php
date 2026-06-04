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
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for="d_name">ຊື່ແລະນາມສະກຸນ</label>
<input type="text" class="form-control" name="mfull_name" id="mfull_name" value="<?= htmlspecialchars($data['mfull_name']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ອາຍູ</label>
<input type="text" class="form-control" name="mage" id="mage" value="<?= htmlspecialchars($data['mage']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ບ້ານຢູ່ປັດຈຸບັນ</label>
<input type="text" class="form-control" name="mproname" id="mproname" value="<?= htmlspecialchars($data['mproname']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ເມືອງຢູ່ປັດຈຸບັນ</label>
<input type="text" class="form-control" name="mdisname" id="mdisname" value="<?= htmlspecialchars($data['mdisname']) ?>"  placeholder="ກະລຸນາປ້ອນ">
</div> 
</div>
<div class="col-sm-6">
<div class="form-group">
<label for="d_name">ແຂວງຢູ່ປັດຈຸບັນ</label>
<input type="text" class="form-control" name="mvillagename" id="mvillagename" value="<?= htmlspecialchars($data['mvillagename']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ອາຊີບ</label>
<input type="text" class="form-control" name="moccupation" id="moccupation" value="<?= htmlspecialchars($data['moccupation']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ບ່ອນປະຈຳການ</label>
<input type="text" class="form-control" name="mworkplace" id="mworkplace" value="<?= htmlspecialchars($data['mworkplace']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>
</div>
</div>

