<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');
$user_id = $_SESSION['user_id'];

// ตรวจสอบว่ามีการส่ง l_id มาหรือไม่
if (!isset($_GET['l_id'])) {
    echo "<script>window.location='show_table.php';</script>";
    exit;
}

$l_id = intval($_GET['l_id']);

// ดึงข้อมูลเดิม
$stmt = $conn->prepare("SELECT * FROM positions_level WHERE l_id = ? AND user_id = ?");
$stmt->bind_param("ii", $l_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    echo "<script>Swal.fire({ icon: 'error', title: 'ບໍ່ພົບຂໍ້ມູນ' });</script>";
    exit;
}
$row = $result->fetch_assoc();

if (isset($_POST['submit'])) {
    $l_name = trim($_POST['l_name']);
        $img_path = $row['l_img']; // ใช้รูปเดิมเป็นค่าเริ่มต้น
        if (!empty($_FILES['l_img']['name'])) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true); 
            }
            $file_tmp = $_FILES['l_img']['tmp_name'];
            $file_ext = pathinfo($_FILES['l_img']['name'], PATHINFO_EXTENSION);
            $new_filename = uniqid("user_", true) . "." . $file_ext;
            $target_file = $target_dir . $new_filename;
            if (move_uploaded_file($file_tmp, $target_file)) {
                $img_path = $new_filename;
            } else {
                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'ອັບໂຫຼດຮູບບໍ່ສຳເລັດ',
                    timer: 2000
                });
                </script>";
                exit;
            }
        }

        $sql = $conn->prepare("UPDATE positions_level SET l_name = ?, l_img = ? WHERE l_id = ? AND user_id = ?");
        $sql->bind_param("ssii", $l_name, $img_path, $l_id, $user_id);
        
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
                title: 'ຜິດພາດ',
                text: '".mysqli_error($conn)."'
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
<h3 class="card-title">ຟອມແກ້ໄຂ ຊັ້ນ</h3>
</div>
<form method="POST" enctype="multipart/form-data">
<div class="card-body">

<div class="form-group">
<label for="">ຊັ້ນ</label>
<input type="text" class="form-control" name="l_name" id="l_name" value="<?= htmlspecialchars($row['l_name']) ?>" required>
</div>

<div class="form-group">
<label for="l_img">ຮູບພາບ</label>
<input type="file" id="l_img" name="l_img" class="form-control" accept="image/*">
<?php if (!empty($row['l_img'])): ?>
<br><img src="uploads/<?= $row['l_img'] ?>" width="100">
<?php endif; ?>
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
