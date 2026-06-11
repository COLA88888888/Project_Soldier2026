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

// Resolve Mother's stored text address back to database IDs
$m_pro_id = null;
$m_dis_id = null;

if (!empty($data['mproname'])) {
    $p_stmt = $conn->prepare("SELECT pro_id FROM province WHERE pro_name = ? LIMIT 1");
    $p_stmt->bind_param("s", $data['mproname']);
    $p_stmt->execute();
    $p_stmt->bind_result($m_pro_id);
    $p_stmt->fetch();
    $p_stmt->close();
}

if (!empty($data['mdisname']) && !empty($m_pro_id)) {
    $d_stmt = $conn->prepare("SELECT dis_id FROM distict WHERE dis_name = ? AND pro_id = ? LIMIT 1");
    $d_stmt->bind_param("si", $data['mdisname'], $m_pro_id);
    $d_stmt->execute();
    $d_stmt->bind_result($m_dis_id);
    $m_dis_id = $d_stmt->fetch() ? $m_dis_id : null;
    $d_stmt->close();
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
<label for="d_name">ອາຊີບ</label>
<input type="text" class="form-control" name="moccupation" id="moccupation" value="<?= htmlspecialchars($data['moccupation']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
</div>
<div class="col-sm-6">
<div class="form-group">
<label>ແຂວງຢູ່ປັດຈຸບັນ</label>
<select name="m_province_id" class="form-control select2" id="m_province_id">
<option value="">-- ເລືອກແຂວງ --</option>
<?php 
$stmt_mp = $conn->prepare("SELECT pro_id, pro_name FROM province ORDER BY pro_name ASC");
$stmt_mp->execute();
$result_mp = $stmt_mp->get_result();
while ($row = $result_mp->fetch_assoc()) {
    $selected = ($row['pro_id'] == $m_pro_id) ? 'selected' : '';
    echo "<option value='{$row['pro_id']}' $selected>{$row['pro_name']}</option>";
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
<input type="text" class="form-control" name="mvillagename" id="mvillagename" value="<?= $data['mvillagename'] === '0' ? '' : htmlspecialchars($data['mvillagename']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>

<div class="form-group">
<label for="d_name">ບ່ອນປະຈຳການ</label>
<input type="text" class="form-control" name="mworkplace" id="mworkplace" value="<?= htmlspecialchars($data['mworkplace']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div>
</div>
</div>

