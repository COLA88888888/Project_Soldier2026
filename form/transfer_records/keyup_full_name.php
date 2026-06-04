<?php
require '../../condb.php'; 
if (isset($_POST['national_id'])) {
    $national_id = $_POST['national_id'];
    $sql = "SELECT  full_name FROM officers  WHERE national_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $national_id);
    $stmt->execute();
    $stmt->bind_result($full_name);

    if ($stmt->fetch()) {
        echo $full_name;
    } else {
        echo 'ບໍ່ມີຂໍ້ມູນກະລຸນນາປ້ອນລະຫັດບັດປະຈຳໂຕຂອງທ່ານໃໝ່';
    }

    $stmt->close();
    $conn->close();
   exit();
}
?>
