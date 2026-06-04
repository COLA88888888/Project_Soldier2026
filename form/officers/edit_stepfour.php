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
<label for="d_name">ລະດັບສາຍອື່ນໆ</label>
<input type="text" class="form-control" name="level_as" id="level_as" value="<?= htmlspecialchars($data['level_as']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 

<div class="form-group">
<label for="d_name">ພາຍໃນ ຫຼື ຕ່າງປະເທດ</label>
<input type="text" class="form-control" name="language_as" id="language_as" value="<?= htmlspecialchars($data['language_as']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 

<div class="form-group">
<label for="d_name">ຂະແໜງຮຽນ</label>
<input type="text" class="form-control" name="kananghien_as" id="kananghien_as" value="<?= htmlspecialchars($data['kananghien_as']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ລະບົບ</label>
<input type="text" class="form-control" name="labup_as" id="labup_as" value="<?= htmlspecialchars($data['labup_as']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="d_name">ໂຮງຮຽນ</label>
<input type="text" class="form-control" name="school_as" id="school_as" value="<?= htmlspecialchars($data['school_as']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ປີຮຽນ</label>
<input type="text" class="form-control" name="pihien_as" id="pihien_as" value="<?= htmlspecialchars($data['pihien_as']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
<div class="form-group">
<label for="d_name">ປີໃດຫາປີໃດ</label>
<input type="text" class="form-control" name="p_p_as" id="p_p_as" value="<?= htmlspecialchars($data['p_p_as']) ?>" placeholder="ກະລຸນາປ້ອນ">
</div> 
</div>
 </div>




