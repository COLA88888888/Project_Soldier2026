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
<label for="d_name">ຊື່ແລະນາມສະກຸນ</label>
<input type="text" class="form-control" name="ffull_name" id="ffull_name" value="<?= htmlspecialchars($data['ffull_name']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 

<div class="form-group">
<label for="d_name">ອາຍູ</label>
<input type="text" class="form-control" name="fage" id="fage" value="<?= htmlspecialchars($data['fage']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ອາຊີບ</label>
<input type="text" class="form-control" name="foccupation" id="foccupation" value="<?= htmlspecialchars($data['foccupation']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຊົນເຜົ່າ</label>
<input type="text" class="form-control" name="fzonpao" id="fzonpao" value="<?= htmlspecialchars($data['fzonpao']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
 
</div>
<div class="col-sm-6">
<div class="form-group">
<label for="d_name">ບ້ານຢູ່ປັດຈຸບັນ</label>
<input type="text" class="form-control" name="fproname" id="fproname" value="<?= htmlspecialchars($data['fproname']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ເມືອງຢູ່ປັດຈຸບັນ</label>
<input type="text" class="form-control" name="fdisname" id="fdisname" value="<?= htmlspecialchars($data['fdisname']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ແຂວງຢູ່ປັດຈຸບັນ</label>
<input type="text" class="form-control" name="fvillagename" id="fvillagename" value="<?= htmlspecialchars($data['fvillagename']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ບ່ອນປະຈຳການ</label>
<input type="text" class="form-control" name="fworkplace" id="fworkplace" value="<?= htmlspecialchars($data['fworkplace']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>
</div>
</div>

