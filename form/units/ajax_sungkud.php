<?php
  include('../../condb.php');
if(isset($_POST['function'])  && $_POST['function'] == 'd_id'){

$d_id = $_POST['d_id'];
$sql = "SELECT * FROM office where d_id='$d_id'";
$query = mysqli_query($conn,$sql);
echo '<option value="">-- ເລືອກຫ້ອງການ --</option>';
foreach($query as $value){
echo '<option value="'.$value['o_id'].'">'.$value['o_name'].'</option>';
}
exit();
}
if(isset($_POST['function'])  && $_POST['function'] == 'o_id'){
$o_id  = $_POST['o_id'];
$sql = "SELECT * FROM panak where o_id='$o_id'";
$query = mysqli_query($conn,$sql);
echo '<option value="">-- ເລືອກບ້ານ --</option>';
foreach($query as $value){
echo '<option value="'.$value['pk_id'].'">'.$value['pk_name'].'</option>';
}
exit();
}

if(isset($_POST['function'])  && $_POST['function'] == 'pk_id'){
$pk_id  = $_POST['pk_id'];
$sql = "SELECT * FROM units where pk_id='$pk_id'";
$query = mysqli_query($conn,$sql);
echo '<option value="">-- ເລືອກບ້ານ --</option>';
foreach($query as $value){
echo '<option value="'.$value['u_id'].'">'.$value['u_name'].'</option>';
}
exit();
}

?>

