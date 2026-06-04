<?php
  include('../../condb.php');
if(isset($_POST['function'])  && $_POST['function'] == 'd_id'){

$d_id = $_POST['d_id'];
$sql = "SELECT * FROM office where d_id='$d_id'";
$query = mysqli_query($conn,$sql);
echo '<option value="">-- ເລືອກ --</option>';
foreach($query as $value){
echo '<option value="'.$value['o_id'].'">'.$value['o_name'].'</option>';
}
exit();

}
?>