<?php
include('../../condb.php');

if (isset($_POST['function']) && $_POST['function'] == 'provinces') {
  $pro_id = $_POST['dis_id'];
  $sql = "SELECT * FROM distict WHERE pro_id='$pro_id'";
  $query = mysqli_query($conn, $sql);
  echo '<option value="">-- ເລືອກເມືອງ --</option>';
  foreach ($query as $row) {
    echo '<option value="'.$row['dis_id'].'">'.$row['dis_name'].'</option>';
  }
  exit();
}

if (isset($_POST['function']) && $_POST['function'] == 'districts') {
  $dis_id = $_POST['dis_id'];
  $sql = "SELECT * FROM village WHERE dis_id='$dis_id'";
  $query = mysqli_query($conn, $sql);
  echo '<option value="">-- ເລືອກບ້ານ --</option>';
  foreach ($query as $row) {
    echo '<option value="'.$row['v_id'].'">'.$row['v_name'].'</option>';
  }
  exit();
}
?>
