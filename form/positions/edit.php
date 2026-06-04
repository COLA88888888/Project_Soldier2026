<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');

if (!isset($_GET['pt_id'])) {
    echo "<script>window.location='show_table.php';</script>";
    exit;
}

$pt_id = intval($_GET['pt_id']);
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM positions WHERE pt_id = ? AND user_id = ?");
$stmt->bind_param("ii", $pt_id, $user_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$data) {
    echo "<script>alert('ບໍ່ພົບຂໍ້ມູນ'); window.location='show_table.php';</script>";
    exit;
}

if (isset($_POST['submit'])) {
    $pt_name = trim($_POST['pt_name']);

    $sql = $conn->prepare("UPDATE positions SET pt_name = ? WHERE pt_id = ? AND user_id = ?");
    $sql->bind_param("sii", $pt_name, $pt_id, $user_id);

    if ($sql->execute()) {
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
<div class="row">
<div class="col-sm-12">
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">ແກ້ໄຂ ໜ້າທີ່-ຕຳແໜ່ງ</h3>
</div>
<form method="POST">
<div class="card-body">
<div class="form-group">
<label for="">ໜ້າທີ່-ຕຳແໜ່ງ</label>
<input type="text" class="form-control" name="pt_name" id="pt_name" value="<?= htmlspecialchars($data['pt_name']) ?>">
</div>
</div>
<div class="card-footer text-center">
<button type="submit" name="submit" class="btn btn-primary"><i class="ion-android-add"></i> ບັນທຶກ</button>
<a href="show_table.php" class="btn btn-danger">ຍົກເລີກ</a>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('../../controllers/footer.php'); ?>
