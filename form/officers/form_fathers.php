
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for="d_name">ຊື່ແລະນາມສະກຸນ</label>
<input type="text" class="form-control" name="ffull_name" id="ffull_name" placeholder="ກະລຸນາປ້ອນ">
</div> 

<div class="form-group">
<label for="d_name">ອາຍູ</label>
<input type="text" class="form-control" name="fage" id="fage" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ອາຊີບ</label>
<input type="text" class="form-control" name="foccupation" id="foccupation" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຊົນເຜົ່າ</label>
<input type="text" class="form-control" name="fzonpao" id="fzonpao" placeholder="ກະລຸນາປ້ອນ">
</div> 

</div>
<div class="col-sm-6">

<div class="form-group">
<label>ແຂວງຢູ່ປັດຈຸບັນ</label>
<select name="f_province_id" class="form-control select2" id="f_province_id" required>
<option value="">-- ເລືອກແຂວງ --</option>
<?php 
include_once('../../condb.php');
$stmt_fp = $conn->prepare("SELECT pro_id, pro_name FROM province ORDER BY pro_name ASC");
$stmt_fp->execute();
$result_fp = $stmt_fp->get_result();
while ($row = $result_fp->fetch_assoc()) {
    echo '<option value="' . htmlspecialchars($row['pro_id']) . '">' . htmlspecialchars($row['pro_name']) . '</option>';
}
$stmt_fp->close();
?>
</select>
</div>

<div class="form-group">
<label>ເມືອງຢູ່ປັດຈຸບັນ</label>
<select name="f_district_id" class="form-control select2" id="f_district_id" required>
<option value="">-- ເລືອກເມືອງ --</option>
</select>
</div> 

<div class="form-group">
<label for="fvillagename">ບ້ານຢູ່ປັດຈຸບັນ</label>
<input type="text" class="form-control" name="fvillagename" id="fvillagename" placeholder="ກະລຸນາປ້ອນ" required>
</div> 

<div class="form-group">
<label for="d_name">ບ່ອນປະຈຳການ</label>
<input type="text" class="form-control" name="fworkplace" id="fworkplace" placeholder="ກະລຸນາປ້ອນ">
</div>
</div>
</div>

