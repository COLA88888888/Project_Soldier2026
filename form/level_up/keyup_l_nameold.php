<?php
require '../../condb.php'; 
if (isset($_POST['national_id'])) {
    $national_id = $_POST['national_id'];
    $sql = "SELECT  a.l_name FROM positions_level as a, officers as b WHERE b.national_id = ? AND a.l_id = b.l_id";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $national_id);
    $stmt->execute();
    $stmt->bind_result($l_nameold);

    if ($stmt->fetch()) {
        echo $l_nameold;
    } else {
        echo 'ບໍ່ມີຂໍ້ມູນກະລຸນນາປ້ອນລະຫັດບັດປະຈຳໂຕຂອງທ່ານໃໝ່';
    }

    $stmt->close();
    $conn->close();
   exit();
}
?>
