<?php
require '../../condb.php'; 

if (isset($_POST['national_id'])) {
    $national_id = $_POST['national_id'];
    $sql = "SELECT  officer_id FROM officers  WHERE national_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $national_id);
    $stmt->execute();
    $stmt->bind_result($officer_id);
    
    if ($stmt->fetch()) {
        echo $officer_id;
    } else {
        echo 'ບໍ່ມີຂໍ້ມູນກະລຸນນາປ້ອນລະຫັດບັດປະຈຳໂຕຂອງທ່ານໃໝ່';
    }

    $stmt->close();
    $conn->close();
}
?>
