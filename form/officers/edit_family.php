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
<label for="d_name">ຊື່ ແລະ ນາມສະກຸນຜົວ ຫຼື ເມຍ</label>
<input type="text" class="form-control" name="falyfull_name" id="falyfull_name" value="<?= htmlspecialchars($data['falyfull_name']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເກີດ</label>
<input type="date" class="form-control" name="falybirth_date" id="falybirth_date" value="<?= htmlspecialchars($data['falybirth_date']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ອາຍູ</label>
<input type="text" class="form-control" name="falyages" id="falyages" value="<?= htmlspecialchars($data['falyages']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ອາຊີບ</label>
<input type="text" class="form-control" name="falyoccupation" id="falyoccupation" value="<?= htmlspecialchars($data['falyoccupation']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຢູ່ໃສ</label>
<input type="text" class="form-control" name="falylive" id="falylive" value="<?= htmlspecialchars($data['falylive']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 

<div class="form-group">
<label for="d_name">ບ່ອນປະຈຳການ</label>
<input type="text" class="form-control" name="falyworkplace" id="falyworkplace" value="<?= htmlspecialchars($data['falyworkplace']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>

<div class="form-group">
<label for="d_name">ບ້ານຢູ່ປັດຈຸບັນ</label>
<input type="text" class="form-control" name="falyvillagename" id="falyvillagename" value="<?= htmlspecialchars($data['falyvillagename']) ?>" placeholder="ກະລຸນາປ້ອນ">

</div> 
<div class="form-group">
<label for="d_name">ເມືອງ</label>
<input type="text" class="form-control" name="falydisname" id="falydisname" value="<?= htmlspecialchars($data['falydisname']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ແຂວງ</label>
<input type="text" class="form-control" name="falyproname" id="falyproname" value="<?= htmlspecialchars($data['falyproname']) ?>" placeholder="ກະລຸນາປ້ອນ">

</div> 


</div>
<div class="col-sm-6">
<div class="form-group">
<label for="d_name">ຊົນຊັນ</label>
<input type="text" class="form-control" name="falyzozun" id="falyzozun" value="<?= htmlspecialchars($data['falyzozun']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຊົນເຜົ່າ</label>
<input type="text" class="form-control" name="falyzonpao" id="falyzonpao" value="<?= htmlspecialchars($data['falyzonpao']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 

<div class="form-group">
<label for="d_name">ສາດສະໜາ</label>
<input type="text" class="form-control" name="falyzadsana" id="falyzadsana" value="<?= htmlspecialchars($data['falyzadsana']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີແຕ່ງງານ</label>
<input type="date" class="form-control" name="family_date" id="family_date" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ມີລູກຈັກຄົນ</label>
<input type="text" class="form-control" name="falynumber_of_children" id="falynumber_of_children" value="<?= htmlspecialchars($data['falynumber_of_children']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ເບີໂທ</label>
<input type="text" class="form-control" name="falyphone" id="falyphone" value="<?= htmlspecialchars($data['falyphone']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ໝາຍເຫດ</label>
<input type="text" class="form-control" name="falynotes" id="falynotes" value="<?= htmlspecialchars($data['falynotes']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ປກສ / ປົກຄອງ</label>
<input type="text" class="form-control" name="is_pgks" id="is_pgks" value="<?= htmlspecialchars($data['is_pgks']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ວດປ
ຍົກຍ້າຍມາຢູ່ຫ້ອງການ</label>
<input type="date" class="form-control" name="office_date" id="office_date" value="<?= htmlspecialchars($data['office_date']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ເລກທີ</label>
<input type="text" class="form-control" name="reference_number" id="reference_number" value="<?= htmlspecialchars($data['reference_number']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>


</div>
</div>

