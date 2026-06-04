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
<div class="col-sm-3">

<div class="form-group">
<label for="d_name">ລະຫັດບັດປະຈຳຕົວ</label>
<input type="hidden" class="form-control" name="officer_id" id="officer_id" value="<?php echo $data['officer_id']; ?>" placeholder="ກະລຸນາປ້ອນ">

<input type="text" class="form-control" name="national_id" id="national_id" value="<?= htmlspecialchars($data['national_id']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>  
<div class="form-group">
<label for="d_name">ຊື່</label>
<input type="text" class="form-control" name="full_name" id="full_name" value="<?= htmlspecialchars($data['full_name']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 

<div class="form-group">
<label for="d_name">ນາມສະກຸນ</label>
<input type="text" class="form-control" name="full_lastname" id="full_lastname" value="<?= htmlspecialchars($data['full_lastname']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຊື່ ຫຼີ້ນ</label>
<input type="text" class="form-control" name="alias_name" id="alias_name" value="<?= htmlspecialchars($data['alias_name']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="">ເພດ</label>
<select name="gender" id="gender" class="form-control">
<option value="">-- ເລືອກເພດ --</option>
<option value="ຊາຍ" <?= $data['gender'] == 'ຊາຍ' ? 'selected' : '' ?>>ຊາຍ</option>
<option value="ຍິງ" <?= $data['gender'] == 'ຍິງ' ? 'selected' : '' ?>>ຍິງ</option>
</select>
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເກີດ</label>
<input type="date" class="form-control" name="birth_date" id="birth_date" value="<?= htmlspecialchars($data['birth_date']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ອາຍຸ</label>
<input type="date" class="form-control" name="age" id="age" value="<?= htmlspecialchars($data['age']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>

<div class="form-group">
<label for="d_name">ວັນເດືອນປີເລື່ອນຊັ້ນ</label>
<input type="date" class="form-control" name="date_level" id="date_level" value="<?= htmlspecialchars($data['date_level']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 

<div class="form-group">
<label for="d_name">ເລກທີ</label>
<input type="text" class="form-control" name="serial_number" id="serial_number" value="<?= htmlspecialchars($data['serial_number']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label>ແຂວງ</label>
<select name="pro_id" class="form-control select2" id="pro_id" required>
<option value="">-- ເລືອກແຂວງ --</option>
<?php 
$stmt = $conn->prepare("SELECT pro_id, pro_name FROM province ORDER BY pro_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
$selected = ($row['pro_id'] == $data['pro_id']) ? 'selected' : '';
echo "<option value='{$row['pro_id']}' $selected>{$row['pro_name']}</option>";
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
<label for="d_name">ບ້ານເກີດ</label>
<select name="v_id" class="form-control select2" id="v_id" required></select>
</div>  

<div class="form-group">
<label for="d_name">ເບີໂທ</label>
<input type="text" class="form-control" name="numberphone" id="numberphone" value="<?= htmlspecialchars($data['numberphone']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ບ້ານຢູ່ປັດຈຸບັນ</label>
<input type="text" class="form-control" name="current_village" id="current_village" value="<?= htmlspecialchars($data['current_village']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 

<div class="form-group">
<label for="d_name">ເມືອງຢູ່ປັດຈຸບັນ</label>
<input type="text" class="form-control" name="current_district" id="current_district" value="<?= htmlspecialchars($data['current_district']) ?>" placeholder="ກະລຸນາປ້ອນ">

</div> 
<div class="form-group">
<label for="d_name">ແຂວງຢູ່ປັດຈຸບັນ</label>
<input type="text" class="form-control" name="current_province" id="current_province" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ເຮືອນເລກທີ</label>
<input type="text" class="form-control" name="house_number" id="house_number" value="<?= htmlspecialchars($data['house_number']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ຖະໜົນ</label>
<input type="text" class="form-control" name="road" id="road" value="<?= htmlspecialchars($data['road']) ?>" placeholder="ກະລຸນາປ້ອນ">

</div> 
<div class="form-group">
<label for="d_name">ຮ່ອມ</label>
<input type="text" class="form-control" name="block" id="block" value="<?= htmlspecialchars($data['block']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>

<div class="form-group">
<label for="d_name">ເລກທີບັດປະຈຳຕົວ</label>
<input type="text" class="form-control" name="id_card_number" id="id_card_number" value="<?= htmlspecialchars($data['id_card_number']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
</div>
<div class="col-sm-3">



<div class="form-group">
<label for="d_name">ຊົນເຜົ່າ</label>
<input type="text" class="form-control" name="ethnicity" id="ethnicity" value="<?= htmlspecialchars($data['ethnicity']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ສາສະໜາ</label>
<input type="text" class="form-control" name="religion" id="religion" value="<?= htmlspecialchars($data['religion']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ເລກທີບັດຢັ້ງຢືນຊັ້ນ</label>
<input type="text" class="form-control" name="confirm_number" id="confirm_number" value="<?= htmlspecialchars($data['confirm_number']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເຂົ້າການປະຕິວັດ</label>
<input type="date" class="form-control" name="date_join_revolution" id="date_join_revolution" value="<?= htmlspecialchars($data['date_join_revolution']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເຂົ້າຕຳຫຼວດ</label>
<input type="date" class="form-control" name="date_join_police" id="date_join_police" value="<?= htmlspecialchars($data['date_join_police']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 

<div class="form-group">
<label for="d_name">ວັນເດືອນປີເຂົ້າທະຫານ</label>
<input type="date" class="form-control" name="date_join_army" id="date_join_army" value="<?= htmlspecialchars($data['date_join_army']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເຂົ້າພັກສຳຮອງ</label>
<input type="date" class="form-control" name="date_join_party" id="date_join_party" value="<?= htmlspecialchars($data['date_join_party']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ເລກທີເຂົ້າພັກສໍາຮອງ</label>
<input type="text" class="form-control" name="backup_party_id" id="backup_party_id" value="<?= htmlspecialchars($data['backup_party_id']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເຂົ້າພັກສົມບູນ</label>
<input type="date" class="form-control" name="date_join" id="date_join" value="<?= htmlspecialchars($data['date_join']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 

<div class="form-group">
<label for="d_name">ເລກທີເຂົ້າພັກສົມບູນ</label>
<input type="text" class="form-control" name="full_party_id" id="full_party_id" value="<?= htmlspecialchars($data['full_party_id']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
</div> 

<div class="col-sm-3">

<div class="form-group">
<label for="d_name">ວັນເດືອນປີເຂົ້າຊາວໜຸ່ມ</label>
<input type="date" class="form-control" name="date_join_youth" id="date_join_youth" value="<?= htmlspecialchars($data['date_join_youth']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເຂົ້າແມ່ຍິງ</label>
<input type="date" class="form-control" name="date_join_women" id="date_join_women" value="<?= htmlspecialchars($data['date_join_women']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ວັນເດືອນປີເຂົ້າກຳມະບານ</label>
<input type="date" class="form-control" name="date_join_union" id="date_join_union" value="<?= htmlspecialchars($data['date_join_union']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຕຳແໜ່ງເບື້ອງພັກ</label>
<input type="text" class="form-control" name="party_position" id="party_position" value="<?= htmlspecialchars($data['party_position']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ຕຳແໜ່ງເບື້ອງລັດ</label>
<input type="text" class="form-control" name="state_position" id="state_position" value="<?= htmlspecialchars($data['state_position']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
 
<div class="form-group">
<label for="d_name">ລະດັບວັດທະນະທຳ</label>
<select name="culture_level" id="culture_level" class="form-control">
<option value="ປະຖົມ"  <?= $data['culture_level'] == 'ປະຖົມ' ? 'selected' : '' ?>>ປະຖົມ</option>
<option value="ມັດທະຍົມຕົ້ນ" <?= $data['culture_level'] == 'ມັດທະຍົມຕົ້ນ' ? 'selected' : '' ?>>ມັດທະຍົມຕົ້ນ</option>
<option value="ມໍ 6" <?= $data['culture_level'] == 'ມໍ 6' ? 'selected' : '' ?>>ມໍ 6</option>
<option value="ບຳລຸງ" <?= $data['culture_level'] == 'ບຳລຸງ' ? 'selected' : '' ?>>ບຳລຸງ</option>

</select>
</div> 
<div class="form-group">
<label for="d_name">ພາສາຕ່າງປະເທດ</label>
<input type="text" class="form-control" name="foreign_language" id="foreign_language" value="<?= htmlspecialchars($data['foreign_language']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ພະແນກ ແລະ ສູນ</label>
<input type="text" class="form-control" name="department_center" id="department_center" value="<?= htmlspecialchars($data['department_center']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="d_name">ວດປ ຈົບນາຍສິບ </label>
<input type="date" class="form-control" name="graduation_date" id="graduation_date" value="<?= htmlspecialchars($data['graduation_date']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="exampleInputFile">ເລືອກ Files ເອກະສານ</label>
<div class="input-group">
<div class="custom-file">
<input type="hidden" value="<?php echo $data['file_document']; ?>" required class="form-control" name="files2" >

<input type="file" id="file_document"  name="file_document"  class="form-control" accept=".pdf,.doc,.docx,.zip,.pptx,.xlsx">

</div>
</div>
</div>
<div class="form-group">
<label for="exampleInputFile">ຮູບພາບ</label>
<div class="input-group">
<div class="custom-file">
<input type="hidden" value="<?php echo $data['photo_img']; ?>" required class="form-control" name="img2" >
<input type="file" id="photo_img" name="photo_img"  class="form-control" accept="image/*"><br>

</div>

</div>
<?php if (!empty($data['photo_img'])): ?>
<br>
<img src="uploads/<?= $data['photo_img'] ?>" width="100" id="preview">
<?php endif; ?>
</div>
<!-- <img id="preview" src="" width="100" style="display:none;">    -->

</div> 
</div>