<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');

if (!isset($_GET['dis_id'])) {
    echo "<script>window.location='show_table.php';</script>";
    exit;
}

$dis_id = intval($_GET['dis_id']);
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM distict WHERE dis_id = ? AND user_id = ?");
$stmt->bind_param("ii", $dis_id, $user_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$data) {
    echo "<script>alert('ບໍ່ພົບຂໍ້ມູນ'); window.location='show_table.php';</script>";
    exit;
}

if (isset($_POST['submit'])) {
    $pro_id = trim($_POST['pro_id']);
    $dis_name = trim($_POST['dis_name']);
    $sql = $conn->prepare("UPDATE distict SET pro_id = ?, dis_name = ? WHERE dis_id = ? AND user_id = ?");
    $sql->bind_param("isii", $pro_id, $dis_name, $dis_id, $user_id);

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
<h3 class="card-title">ຟອມບັນທຶກ ແຂວງ</h3>
</div>
<form method="post" enctype="multipart/form-data">
<div class="card-body">
<div class="form-group">
<label for="pro_name">ແຂວງ</label>
<select name="pro_id" id="pro_id" class="form-control">
<option value="">-- ເລືອກ --</option>
<?php
$sql = $conn->prepare("SELECT * FROM province");
$sql->execute();
$result = $sql->get_result();
while ($row = $result->fetch_assoc()) {
echo '<option value="'.$row['pro_id'].'">'.$row['pro_name'].'</option>';
}
?>
</select>
</div>
<div class="form-group">
<label for="pro_name">ເມືອງ</label>
<input type="text" class="form-control" name="dis_name" id="dis_name" value="<?= htmlspecialchars($data['dis_name']) ?>" placeholder="ກະລຸນາປ້ອນຊື່ແຂວງ">
</div>
</div>
<div class="card-footer text-center">
<button type="submit" name="submit" class="btn btn-primary"><i class="ion-android-add"></i> ບັນທຶກ</button>
<button type="reset" class="btn btn-danger"> <i class="ion-android-refresh"></i> ຍົກເລີກ</button>
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
