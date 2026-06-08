<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');

if (!isset($_GET['pro_id'])) {
    echo "<script>window.location='show_table.php';</script>";
    exit;
}

$pro_id = intval($_GET['pro_id']);
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM province WHERE pro_id = ?");
$stmt->bind_param("i", $pro_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$data) {
    echo "<script>alert('ບໍ່ພົບຂໍ້ມູນ'); window.location='show_table.php';</script>";
    exit;
}

if (isset($_POST['submit'])) {
    $pro_name = trim($_POST['pro_name']);

    $sql = $conn->prepare("UPDATE province SET pro_name = ? WHERE pro_id = ?");
    $sql->bind_param("si", $pro_name, $pro_id);

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
<div class="card card-danger">
<div class="card-header">
<h3 class="card-title">ຟອມແກ້ໄຂ ແຂວງ</h3>
</div>
<form method="post">
<div class="card-body">
<div class="form-group">
<label for="pro_name">ແຂວງ</label>
<input type="text" class="form-control" name="pro_name" id="pro_name" value="<?= htmlspecialchars($data['pro_name']) ?>">
</div>
</div>
<div class="card-footer text-center">
<button type="submit" name="submit" class="btn btn-primary"><i class="ion-android-add"></i> ບັນທຶກ</button>
<button type="reset" class="btn btn-danger"> <i class="ion-android-refresh"></i> ຍົກເລີກ</button>
</div>
</form>
</div>
<div id="show"></div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('../../controllers/footer.php'); ?>