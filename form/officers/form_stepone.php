<div class="row">
    <div class="col-sm-6">
<div class="form-group">
<label for="">ກົມກອງຂື້ນກັບ</label>
<select name="d_id" class="form-control select2" id="d_id">
<option value="">-- ເລືອກກົມກອງຂື້ນກັບ --</option>
<?php 
include('../../condb.php');
$stmt = $conn->prepare("SELECT * FROM department ORDER BY d_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
echo '<option value="' . htmlspecialchars($row['d_id']) . '">' . htmlspecialchars($row['d_name']) . '</option>';
}
$stmt->close();
?>
</select>

</div>
<div class="form-group">
<label for="o_id">ຫ້ອງການ</label>
<select name="o_id" class="form-control select2" id="o_id" ></select>
</div>
<div class="form-group">
<label for="pk_id">ພະແນກ</label>
<select name="pk_id" class="form-control select2" id="pk_id" ></select>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label for="u_id">ໜ່ວຍງານ</label>
<select name="u_id" class="form-control select2" id="u_id" ></select>
</div>  


<div class="form-group">
<label for="pt_id">ໜ້າທີ່ຮັບຜິດຊອບ</label>
<select name="pt_id" class="form-control select2" id="pt_id" >
<option value="">-- ເລືອກໜ້າທີ່ຮັບຜິດຊອບ --</option>
<?php 
include('../../condb.php');
$stmt = $conn->prepare("SELECT *FROM positions ORDER BY pt_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
echo '<option value="' . htmlspecialchars($row['pt_id']) . '">' . htmlspecialchars($row['pt_name']) . '</option>';
}
$stmt->close();
?>
</select>
</div> 

<div class="form-group">
<label for="rank">ຊັ້ນ</label>
<select name="l_id" class="form-control select2" id="l_id" >
<option value="">-- ເລືອກຊັ້ນ --</option>
<?php 
include('../../condb.php');
$stmt = $conn->prepare("SELECT *FROM positions_level ORDER BY l_name ASC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
echo '<option value="' . htmlspecialchars($row['l_id']) . '">' . htmlspecialchars($row['l_name']) . '</option>';
}
$stmt->close();
?>
</select>
</div> 

</div>
</div>