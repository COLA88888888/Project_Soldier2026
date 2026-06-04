<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');


if (isset($_POST['submit'])) {
    $officer_id = trim($_POST['officer_id']);
    $l_id = trim($_POST['l_id']);
    $level_date = trim($_POST['level_date']); 
$level_date_th = DateTime::createFromFormat('Y-m-d', $level_date)->format('d/m/Y');

    $date_office = trim($_POST['date_office']);
    $user_id = $_SESSION['user_id'];

    // 1. ດຶງຂໍ້ມູນຊື່ພະນັກງານ
    $stmt_info = $conn->prepare("SELECT full_name, full_lastname FROM officers WHERE officer_id = ?");
    $stmt_info->bind_param("i", $officer_id);
    $stmt_info->execute();
    $stmt_info->bind_result($full_name, $full_lastname);
    $stmt_info->fetch();
    $stmt_info->close();

    // 2. ບັນທຶກການເລືອນຊັ້ນ
    $sql = $conn->prepare("INSERT INTO `level_up`(`officer_id`, `l_id`, `level_date`, `date_office`, `user_id`) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("iissi", $officer_id, $l_id, $level_date, $date_office, $user_id);

    if ($sql->execute()) {

        // 3. ສົ່ງແຈ້ງເຕືອນ Telegram
        $token = "7997554354:AAFOIJvnN3kgAA84luycqWOhUj8UVH3mz64";
        $chat_id = "7162044743";
        $officer_name = $full_name . " " . $full_lastname;

        $message = "📣 <b>ແຈ້ງເຕືອນ:</b>\nມີການເລືອນຊັ້ນໃຫ້ພະນັກງານ\n👮‍♂️ ຊື່: <b>$officer_name</b>\n📅 ວັນທີ່ເລືອນຊັ້ນ: <b>$level_date_th</b>";

        $url = "https://api.telegram.org/bot$token/sendMessage";
        $data = [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'HTML'
        ];

        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/x-www-form-urlencoded",
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        // 4. ແຈ້ງ Swal
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'ບັນທຶກຂໍ້ມູນສຳເລັດ',
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
<h3 class="card-title">ຟອມບັນທຶກ ພະນັກງານເລື່ອນຊັ້ນ</h3>
</div>
<form  method="POST" enctype="multipart/form-data">
<div class="card-body">
<div class="form-group">
<label for="">ລະຫັດບັດພະນັກງານ</label>
<input type="text" class="form-control" name="national_id" id="national_id" placeholder="ກະລຸນາປ້ອນ">
<input type="hidden" class="form-control" name="officer_id" id="officer_id" placeholder="">
</div>
<div class="form-group">
<label for="rank">ຊັ້ນ</label>
<select name="l_id" class="form-control" id="l_id" >
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
<!-- <div class="form-group">
<label for="">ກຳປີເລື່ອນຊັ້ນ</label>
<select name="" id="" class="form-control">

</select>
</div> -->

<div class="form-group">
<label for="">ວັນເດືອນປີເລື່ອນຊັ້ນ</label>
<input type="date" class="form-control" name="level_date" id="level_date" placeholder="ກະລຸນາປ້ອນ">
</div>
<div class="form-group">
<label for="">ວັນເດືອນຍົກຍ້າຍ</label>
<input type="date" class="form-control" name="date_office" id="date_office" placeholder="ກະລຸນາປ້ອນ">
</div>

</div>
<img id="preview" src="" width="100" style="display:none;">  
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

<script type="text/javascript">
$(function(){
$('#national_id').keyup(function(){
var national_id = $('#national_id').val();

$.post('keyup_national_id.php', { national_id: national_id }, function(data){
$('#officer_id').val(data);
});
});
});
</script>
