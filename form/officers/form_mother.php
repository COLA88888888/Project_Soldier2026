
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for="d_name">ຊື່ແລະນາມສະກຸນ</label>
<input type="text" class="form-control" name="mfull_name" id="mfull_name" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ອາຍູ</label>
<input type="text" class="form-control" name="mage" id="mage" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ອາຊີບ</label>
<input type="text" class="form-control" name="moccupation" id="moccupation" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຊົນເຜົ່າ</label>
<input type="text" class="form-control" name="mzonpao" id="mzonpao" placeholder="ກະລຸນາປ້ອນ">
</div>

</div>
<div class="col-sm-6">
<div class="form-group">
<label>ແຂວງຢູ່ປັດຈຸບັນ</label>
<select name="m_province_id" class="form-control select2" id="m_province_id">
<option value="">-- ເລືອກແຂວງ --</option>
<?php 
include_once('../../condb.php');
$stmt_mp = $conn->prepare("SELECT pro_id, pro_name FROM province ORDER BY pro_name ASC");
$stmt_mp->execute();
$result_mp = $stmt_mp->get_result();
while ($row = $result_mp->fetch_assoc()) {
    echo '<option value="' . htmlspecialchars($row['pro_id']) . '">' . htmlspecialchars($row['pro_name']) . '</option>';
}
$stmt_mp->close();
?>
</select>
</div>

<div class="form-group">
<label>ເມືອງຢູ່ປັດຈຸບັນ</label>
<select name="m_district_id" class="form-control select2" id="m_district_id">
<option value="">-- ເລືອກເມືອງ --</option>
</select>
</div> 

<div class="form-group">
<label for="mvillagename">ບ້ານຢູ່ປັດຈຸບັນ</label>
<input type="text" class="form-control" name="mvillagename" id="mvillagename" placeholder="ກະລຸນາປ້ອນ">
</div> 

<div class="form-group">
<label for="d_name">ບ່ອນປະຈຳການ</label>
<input type="text" class="form-control" name="mworkplace" id="mworkplace" placeholder="ກະລຸນາປ້ອນ">
</div>
</div>
</div>

