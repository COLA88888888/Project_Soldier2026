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

// Resolve Father's stored text address back to database IDs
$f_pro_id = null;
$f_dis_id = null;

if (!empty($data['fproname'])) {
    $p_stmt = $conn->prepare("SELECT pro_id FROM province WHERE pro_name = ? LIMIT 1");
    $p_stmt->bind_param("s", $data['fproname']);
    $p_stmt->execute();
    $p_stmt->bind_result($f_pro_id);
    $p_stmt->fetch();
    $p_stmt->close();
}

if (!empty($data['fdisname']) && !empty($f_pro_id)) {
    $d_stmt = $conn->prepare("SELECT dis_id FROM distict WHERE dis_name = ? AND pro_id = ? LIMIT 1");
    $d_stmt->bind_param("si", $data['fdisname'], $f_pro_id);
    $d_stmt->execute();
    $d_stmt->bind_result($f_dis_id);
    $f_dis_id = $d_stmt->fetch() ? $f_dis_id : null;
    $d_stmt->close();
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
<label>ແຂວງຢູ່ປັດຈຸບັນ</label>
<select name="f_province_id" class="form-control select2" id="f_province_id" required>
<option value="">-- ເລືອກແຂວງ --</option>
<?php 
$stmt_fp = $conn->prepare("SELECT pro_id, pro_name FROM province ORDER BY pro_name ASC");
$stmt_fp->execute();
$result_fp = $stmt_fp->get_result();
while ($row = $result_fp->fetch_assoc()) {
    $selected = ($row['pro_id'] == $f_pro_id) ? 'selected' : '';
    echo "<option value='{$row['pro_id']}' $selected>{$row['pro_name']}</option>";
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
<input type="text" class="form-control" name="fvillagename" id="fvillagename" value="<?= $data['fvillagename'] === '0' ? '' : htmlspecialchars($data['fvillagename']) ?>" placeholder="ກະລຸນາປ້ອນ" required>
</div> 
<div class="form-group">
<label for="d_name">ບ່ອນປະຈຳການ</label>
<input type="text" class="form-control" name="fworkplace" id="fworkplace" value="<?= htmlspecialchars($data['fworkplace']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>
</div>
</div>

