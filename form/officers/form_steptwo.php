<div class="row">
<div class="col-sm-3">

<div class="form-group">
<label for="d_name">ລະຫັດບັດປະຈຳຕົວ</label>
<input type="text" class="form-control" name="national_id" id="national_id" placeholder="ກະລຸນາປ້ອນ">
</div>  
<div class="form-group">
<label for="d_name">ຊື່</label>
<input type="text" class="form-control" name="full_name" id="full_name" placeholder="ກະລຸນາປ້ອນ">
</div> 
 
<div class="form-group">
<label for="d_name">ນາມສະກຸນ</label>
<input type="text" class="form-control" name="full_lastname" id="full_lastname" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຊື່ ຫຼີ້ນ</label>
<input type="text" class="form-control" name="alias_name" id="alias_name" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="">ເພດ</label>
<select name="gender" id="gender" class="form-control">
<option value="">-- ເລືອກເພດ --</option>
<option value="ຊາຍ">ຊາຍ</option>
<option value="ຍິງ">ຍິງ</option>
</select>
</div> 
<div class="form-group">
<label for="">ສະຖານະພາບ</label>
<select name="status_persions" id="status_persions" class="form-control">
<option value="">-- ເລືອກສະຖານະພາບ --</option>
<option value="ໂສດ">ໂສດ</option>
<option value="ຄອບຄົວ">ຄອບຄົວ</option>
</select>
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເກີດ</label>
<input type="date" class="form-control" name="birth_date" id="birth_date" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ອາຍຸ</label>
<input type="date" class="form-control" name="age" id="age" placeholder="ກະລຸນາປ້ອນ">
</div>

<div class="form-group">
<label for="d_name">ວັນເດືອນປີເລື່ອນຊັ້ນ</label>
<input type="date" class="form-control" name="date_level" id="date_level" placeholder="ກະລຸນາປ້ອນ">
</div> 

<div class="form-group">
<label for="d_name">ເລກທີ</label>
<input type="text" class="form-control" name="serial_number" id="serial_number" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="">ແຂວງ</label>
<select name="pro_id" class="form-control select2" id="pro_id" >
<option value="">-- ເລືອກແຂວງ --</option>
<?php 
include('../../condb.php');
$stmt = $conn->prepare("SELECT pro_id, pro_name FROM province ORDER BY pro_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
echo '<option value="' . htmlspecialchars($row['pro_id']) . '">' . htmlspecialchars($row['pro_name']) . '</option>';
}
$stmt->close();
?>
</select>
</div>
</div> 
<div class="col-sm-3">
<div class="form-group">
<label for="d_name">ເມືອງເກີດ</label>
<select name="dis_id" class="form-control select2" id="dis_id" required></select>
</div> 
<div class="form-group">
<label for="v_id">ບ້ານເກີດ</label>
<select name="v_id" class="form-control select2" id="v_id" required></select>
</div>  

<div class="form-group">
<label for="d_name">ເບີໂທ</label>
<input type="text" class="form-control" name="numberphone" id="numberphone" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label>ແຂວງຢູ່ປັດຈຸບັນ</label>
<select name="current_province_id" class="form-control select2" id="current_province_id" required>
<option value="">-- ເລືອກແຂວງ --</option>
<?php 
$stmt = $conn->prepare("SELECT pro_id, pro_name FROM province ORDER BY pro_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
echo '<option value="' . htmlspecialchars($row['pro_id']) . '">' . htmlspecialchars($row['pro_name']) . '</option>';
}
$stmt->close();
?>
</select>
</div>

<div class="form-group">
<label>ເມືອງຢູ່ປັດຈຸບັນ</label>
<select name="current_district_id" class="form-control select2" id="current_district_id" required>
<option value="">-- ເລືອກເມືອງ --</option>
</select>
</div> 

<div class="form-group">
<label for="current_village">ບ້ານຢູ່ປັດຈຸບັນ</label>
<input type="text" class="form-control" name="current_village" id="current_village" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ເຮືອນເລກທີ</label>
<input type="text" class="form-control" name="house_number" id="house_number" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ຖະໜົນ</label>
<input type="text" class="form-control" name="road" id="road" placeholder="ກະລຸນາປ້ອນ">

</div> 
<div class="form-group">
<label for="d_name">ຮ່ອມ</label>
<input type="text" class="form-control" name="block" id="block" placeholder="ກະລຸນາປ້ອນ">
</div>

<div class="form-group">
<label for="d_name">ເລກທີບັດປະຈຳຕົວ</label>
<input type="text" class="form-control" name="id_card_number" id="id_card_number" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຊົນເຜົ່າ</label>
<input type="text" class="form-control" name="ethnicity" id="ethnicity" placeholder="ກະລຸນາປ້ອນ">
</div> 
</div>
<div class="col-sm-3">




<div class="form-group">
<label for="d_name">ສາສະໜາ</label>
<input type="text" class="form-control" name="religion" id="religion" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ເລກທີບັດຢັ້ງຢືນຊັ້ນ</label>
<input type="text" class="form-control" name="confirm_number" id="confirm_number" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເຂົ້າການປະຕິວັດ</label>
<input type="date" class="form-control" name="date_join_revolution" id="date_join_revolution" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເຂົ້າກອງທັບ</label>
<input type="date" class="form-control" name="date_join_police" id="date_join_police" placeholder="ກະລຸນາປ້ອນ">
</div> 

<div class="form-group">
<label for="d_name">ວັນເດືອນປີເຂົ້າທະຫານ</label>
<input type="date" class="form-control" name="date_join_army" id="date_join_army" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເຂົ້າພັກສຳຮອງ</label>
<input type="date" class="form-control" name="date_join_party" id="date_join_party" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ເລກທີເຂົ້າພັກສໍາຮອງ</label>
<input type="text" class="form-control" name="backup_party_id" id="backup_party_id" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເຂົ້າພັກສົມບູນ</label>
<input type="date" class="form-control" name="date_join" id="date_join" placeholder="ກະລຸນາປ້ອນ">
</div> 

<div class="form-group">
<label for="d_name">ເລກທີເຂົ້າພັກສົມບູນ</label>
<input type="text" class="form-control" name="full_party_id" id="full_party_id" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເຂົ້າຊາວໜຸ່ມ</label>
<input type="date" class="form-control" name="date_join_youth" id="date_join_youth" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເຂົ້າແມ່ຍິງ</label>
<input type="date" class="form-control" name="date_join_women" id="date_join_women" placeholder="ກະລຸນາປ້ອນ">
</div> 
</div> 

<div class="col-sm-3">

<div class="form-group">
<label for="d_name">ວັນເດືອນປີເຂົ້າກຳມະບານ</label>
<input type="date" class="form-control" name="date_join_union" id="date_join_union" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຕຳແໜ່ງເບື້ອງພັກ</label>
<input type="text" class="form-control" name="party_position" id="party_position" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຕຳແໜ່ງເບື້ອງລັດ</label>
<input type="text" class="form-control" name="state_position" id="state_position" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ລະດັບວັດທະນະທຳ</label>
<select name="culture_level" id="culture_level" class="form-control">
<option value="ປະຖົມ">ປະຖົມ</option>
<option value="ມັດທະຍົມຕົ້ນ">ມັດທະຍົມຕົ້ນ</option>
<option value="ມໍ 6">ມໍ 6</option>
<option value="ບຳລຸງ">ບຳລຸງ</option>
</select>
</div> 
<div class="form-group">
<label for="d_name">ພາສາຕ່າງປະເທດ</label>
<input type="text" class="form-control" name="foreign_language" id="foreign_language" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ພະແນກ ແລະ ສູນ</label>
<input type="text" class="form-control" name="department_center" id="department_center" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ວດປ ຈົບນາຍສິບ </label>
<input type="date" class="form-control" name="graduation_date" id="graduation_date" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="exampleInputFile">ເລືອກ Files ເອກະສານ</label>
<div class="input-group">
<div class="custom-file">
<input type="file" id="file_document"  name="file_document" class="form-control" accept=".pdf,.doc,.docx,.zip,.pptx,.xlsx">
</div>
</div>
</div>
<div class="form-group">
<label for="exampleInputFile">ຮູບພາບ</label>
<div class="input-group">
<div class="custom-file">

<input type="file" id="photo_img" name="photo_img" class="form-control" accept="image/*"><br>

</div>
</div>
</div>
<img id="preview" src="" width="200px" height="200px" style="display:none;">   

</div> 
</div>
