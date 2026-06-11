
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for="d_name">ຊື່ ແລະ ນາມສະກຸນຜົວ ຫຼື ເມຍ</label>
<input type="text" class="form-control" name="falyfull_name" id="falyfull_name" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເກີດ</label>
<input type="date" class="form-control" name="falybirth_date" id="falybirth_date" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ອາຍູ</label>
<input type="text" class="form-control" name="falyages" id="falyages" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ອາຊີບ</label>
<input type="text" class="form-control" name="falyoccupation" id="falyoccupation" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຢູ່ໃສ</label>
<input type="text" class="form-control" name="falylive" id="falylive" value="" placeholder="ກະລຸນາປ້ອນ">
</div> 
 
<div class="form-group">
<label>ແຂວງຢູ່ປັດຈຸບັນ</label>
<select name="faly_province_id" class="form-control select2" id="faly_province_id">
<option value="">-- ເລືອກແຂວງ --</option>
<?php 
include_once('../../condb.php');
$stmt_faly_p = $conn->prepare("SELECT pro_id, pro_name FROM province ORDER BY pro_name ASC");
$stmt_faly_p->execute();
$result_faly_p = $stmt_faly_p->get_result();
while ($row = $result_faly_p->fetch_assoc()) {
    echo '<option value="' . htmlspecialchars($row['pro_id']) . '">' . htmlspecialchars($row['pro_name']) . '</option>';
}
$stmt_faly_p->close();
?>
</select>
</div>

<div class="form-group">
<label>ເມືອງຢູ່ປັດຈຸບັນ</label>
<select name="faly_district_id" class="form-control select2" id="faly_district_id">
<option value="">-- ເລືອກເມືອງ --</option>
</select>
</div> 

<div class="form-group">
<label for="falyvillagename">ບ້ານຢູ່ປັດຈຸບັນ</label>
<input type="text" class="form-control" name="falyvillagename" id="falyvillagename" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຊົນຊັນ</label>
<input type="text" class="form-control" name="falyzozun" id="falyzozun" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຊົນເຜົ່າ</label>
<input type="text" class="form-control" name="falyzonpao" id="falyages" placeholder="ກະລຸນາປ້ອນ">
</div> 
</div>
<div class="col-sm-6">


<div class="form-group">
<label for="d_name">ສາດສະໜາ</label>
<input type="text" class="form-control" name="falyzadsana" id="falyzadsana" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ບ່ອນປະຈຳການ</label>
<input type="text" class="form-control" name="falyworkplace" id="falyworkplace" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ວັນເດືອນປີແຕ່ງງານ</label>
<input type="date" class="form-control" name="family_date" id="family_date" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ມີລູກຈັກຄົນ</label>
<input type="text" class="form-control" name="falynumber_of_children" id="falynumber_of_children" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ເບີໂທ</label>
<input type="text" class="form-control" name="falyphone" id="falyphone" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ໝາຍເຫດ</label>
<input type="text" class="form-control" name="falynotes" id="falynotes" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ທະຫານ / ປົກຄອງ</label>
<input type="text" class="form-control" name="is_pgks" id="is_pgks" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ວດປ
ຍົກຍ້າຍມາຢູ່ຫ້ອງການ</label>
<input type="date" class="form-control" name="office_date" id="office_date" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ເລກທີ</label>
<input type="text" class="form-control" name="reference_number" id="reference_number" placeholder="ກະລຸນາປ້ອນ">
</div>


</div>
</div>


