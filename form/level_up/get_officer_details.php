<?php
require '../../condb.php';

header('Content-Type: application/json');

if (isset($_POST['officer_id']) || isset($_POST['national_id'])) {
    
    if (isset($_POST['officer_id']) && !empty($_POST['officer_id'])) {
        $sql = "SELECT a.officer_id, a.full_name, a.full_lastname, a.gender, a.national_id, e.l_name 
                FROM officers AS a
                LEFT JOIN positions_level AS e ON a.l_id = e.l_id
                WHERE a.officer_id = ? AND a.system_status = 'ON'";
        $stmt = $conn->prepare($sql);
        $id_param = intval($_POST['officer_id']);
        $stmt->bind_param("i", $id_param);
    } else {
        $sql = "SELECT a.officer_id, a.full_name, a.full_lastname, a.gender, a.national_id, e.l_name 
                FROM officers AS a
                LEFT JOIN positions_level AS e ON a.l_id = e.l_id
                WHERE a.national_id = ? AND a.system_status = 'ON'";
        $stmt = $conn->prepare($sql);
        $nat_param = trim($_POST['national_id']);
        $stmt->bind_param("s", $nat_param);
    }
            
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        echo json_encode([
            'status' => 'success',
            'officer_id' => $row['officer_id'],
            'national_id' => $row['national_id'],
            'full_name' => $row['full_name'],
            'full_lastname' => $row['full_lastname'],
            'gender' => $row['gender'],
            'l_name' => $row['l_name'] ?? 'ບໍ່ມີຊັ້ນ'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'ບໍ່ມີຂໍ້ມູນກະລຸນາປ້ອນລະຫັດບັດປະຈຳຕົວຂອງທ່ານໃໝ່'
        ]);
    }
    
    $stmt->close();
    $conn->close();
    exit();
}
?>
