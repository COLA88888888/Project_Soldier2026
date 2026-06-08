<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');

if (!isset($_GET['r_id'])) {
    echo "<script>window.location='show_table.php';</script>";
    exit;
}

$r_id = intval($_GET['r_id']);
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM rank_position WHERE r_id = ?");
$stmt->bind_param("i", $r_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$data) {
    echo "<script>alert('ບໍ່ພົບຂໍ້ມູນ'); window.location='show_table.php';</script>";
    exit;
}

if (isset($_POST['submit'])) {
    $l_id = trim($_POST['l_id']);
    $r_years = trim($_POST['r_years']);
    $r_month = trim($_POST['r_month']);

    $sql = $conn->prepare("UPDATE rank_position SET l_id = ?, r_years = ?, r_month = ? WHERE r_id = ?");
    $sql->bind_param("iiii", $l_id, $r_years, $r_month, $r_id);

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
<h3 class="card-title">ຟອມແກ້ໄຂ ກຳນົດປີເລື່ອນຊັ້ນ</h3>
</div>
<form method="POST">
<div class="card-body">
<div class="form-group">
<label for="rank">ຊັ້ນ</label>
<select name="l_id" class="form-control" id="l_id">
<option value="">-- ເລືອກຊັ້ນ --</option>
<?php 
$stmt = $conn->prepare("SELECT * FROM positions_level ORDER BY l_id DESC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $selected = $row['l_id'] == $data['l_id'] ? 'selected' : '';
    echo '<option value="' . htmlspecialchars($row['l_id']) . '" ' . $selected . '>' . htmlspecialchars($row['l_name']) . '</option>';
}
$stmt->close();
?>
</select>
</div> 
<div class="form-group">
<label for="">ກຳນົດປີເລື່ອນຊັ້ນ</label>
<input type="text" class="form-control" name="r_years" id="r_years" value="<?= htmlspecialchars($data['r_years']) ?>">
</div>
<div class="form-group">
<label for="">ກຳນົດເດືອນເລື່ອນຊັ້ນ</label>
<input type="text" class="form-control" name="r_month" id="r_month" value="<?= htmlspecialchars($data['r_month']) ?>">
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
