<?php include('../../controllers/head.php'); ?> 
<?php
include('../../condb.php');

if (!isset($_GET['tran_id'])) {
    echo "<script>window.location='show_table.php';</script>";
    exit;
}

$tran_id = intval($_GET['tran_id']);
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM transfer_records WHERE tran_id = ? AND user_id = ?");
$stmt->bind_param("ii", $tran_id, $user_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$data) {
    echo "<script>alert('ບໍ່ພົບຂໍ້ມູນ'); window.location='show_table.php';</script>";
    exit;
}

if (isset($_POST['submit'])) {
    $officer_id = trim($_POST['officer_id']);
    $transfer_tyep = trim($_POST['transfer_tyep']);
    $radson = trim($_POST['radson']);
    $number = trim($_POST['number']);
    $transfer_date = trim($_POST['transfer_date']);
    $phone = trim($_POST['phone']);
    $remark = trim($_POST['remark']);
    $approved_by = $_POST['approved_by'];

    $sql = $conn->prepare("UPDATE transfer_records SET officer_id=?, transfer_tyep=?, radson=?, number=?, transfer_date=?, phone=?, remark=?, approved_by=? WHERE tran_id=? AND user_id=?");
    $sql->bind_param("issssssssi", $officer_id, $transfer_tyep, $radson, $number, $transfer_date, $phone, $remark, $approved_by, $tran_id, $user_id);

    if ($sql->execute()) {
        if ($transfer_tyep === "OUT") {
            $updateStatus = $conn->prepare("UPDATE officers SET system_status = 'OUT' WHERE officer_id = ? and user_id = ?");
            $updateStatus->bind_param("ii", $officer_id, $user_id);
            $updateStatus->execute();
        } elseif ($transfer_tyep === "IN") {
            $updateStatus = $conn->prepare("UPDATE officers SET system_status = 'IN' WHERE officer_id = ? and user_id = ?");
            $updateStatus->bind_param("ii", $officer_id, $user_id);
            $updateStatus->execute();
        }

        echo "<script>
        Swal.fire({
        icon: 'success',
        title: 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
        timer: 2000,
        showConfirmButton: false
        }).then(() => {
        window.location = 'show_table.php';
        });
        </script>";
    } else {
        echo "<script>
        Swal.fire({
        icon: 'error',
        title: 'ຜິດພາດ: ".mysqli_error($conn)."'
        });
        </script>";
    }
}
?>

<?php include('../../controllers/menu_left.php'); ?>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid">
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">ແກ້ໄຂຂໍ້ມູນການຍ້າຍ</h3>
</div>
<form method="POST">
<div class="card-body">
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label>ລະຫັດພະນັກງານ</label>
<input type="text" class="form-control" value="<?= htmlspecialchars($data['officer_id']) ?>" readonly>
<input type="hidden" name="officer_id" value="<?= $data['officer_id'] ?>">
</div>
<div class="form-group">
<label>ເຫດຜົນ</label>
<select name="transfer_tyep" class="form-control">
<option value="IN" <?= $data['transfer_tyep'] == 'IN' ? 'selected' : '' ?>>ຍ້າຍເຂົ້າ</option>
<option value="OUT" <?= $data['transfer_tyep'] == 'OUT' ? 'selected' : '' ?>>ຍ້າຍອອກ</option>
</select>
</div>
<div class="form-group">
<label>ຫ້ອງການໃດ</label>
<input type="text" class="form-control" name="radson" value="<?= htmlspecialchars($data['radson']) ?>">
</div>
<div class="form-group">
<label>ເລກທີ</label>
<input type="text" class="form-control" name="number" value="<?= htmlspecialchars($data['number']) ?>">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>ວັນທີຍ້າຍ</label>
<input type="date" class="form-control" name="transfer_date" value="<?= $data['transfer_date'] ?>">
</div>
<div class="form-group">
<label>ເບີໂທ</label>
<input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($data['phone']) ?>">
</div>
<div class="form-group">
<label>ໝາຍເຫດ</label>
<input type="text" class="form-control" name="remark" value="<?= htmlspecialchars($data['remark']) ?>">
</div>
<div class="form-group">
<label>ເພີ່ມເຕີມ</label>
<input type="text" class="form-control" name="approved_by" value="<?= htmlspecialchars($data['approved_by']) ?>">
</div>
</div>
</div>
<div class="card-footer text-center">
<button type="submit" name="submit" class="btn btn-primary">ບັນທຶກ</button>
<a href="show_table.php" class="btn btn-danger">ຍົກເລີກ</a>
</div>
</form>
</div>
</div>
</div>
</div>
<?php include('../../controllers/footer.php'); ?>
