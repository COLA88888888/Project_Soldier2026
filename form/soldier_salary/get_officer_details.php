<?php
require '../../condb.php';

header('Content-Type: application/json');

if (isset($_POST['officer_id']) || isset($_POST['national_id'])) {
    
    if (isset($_POST['officer_id']) && !empty($_POST['officer_id'])) {
        $sql = "SELECT a.officer_id, a.full_name, a.full_lastname, a.gender, a.birth_date, a.national_id,
                       a.date_join_police, a.date_join_army, a.date_join_revolution,
                       e.l_name, f.pt_name 
                FROM officers AS a
                LEFT JOIN positions_level AS e ON a.l_id = e.l_id
                LEFT JOIN positions AS f ON a.pt_id = f.pt_id
                WHERE a.officer_id = ? AND a.system_status = 'ON'";
        $stmt = $conn->prepare($sql);
        $id_param = intval($_POST['officer_id']);
        $stmt->bind_param("i", $id_param);
    } else {
        $sql = "SELECT a.officer_id, a.full_name, a.full_lastname, a.gender, a.birth_date, a.national_id,
                       a.date_join_police, a.date_join_army, a.date_join_revolution,
                       e.l_name, f.pt_name 
                FROM officers AS a
                LEFT JOIN positions_level AS e ON a.l_id = e.l_id
                LEFT JOIN positions AS f ON a.pt_id = f.pt_id
                WHERE a.national_id = ? AND a.system_status = 'ON'";
        $stmt = $conn->prepare($sql);
        $nat_param = trim($_POST['national_id']);
        $stmt->bind_param("s", $nat_param);
    }
            
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $birth_date = $row['birth_date'];
        $age = 0;
        if (!empty($birth_date) && $birth_date !== '0000-00-00') {
            $age = date('Y') - date('Y', strtotime($birth_date));
        }
        
        $join_date = '0000-00-00';
        if (!empty($row['date_join_police']) && $row['date_join_police'] !== '0000-00-00') {
            $join_date = $row['date_join_police'];
        } elseif (!empty($row['date_join_army']) && $row['date_join_army'] !== '0000-00-00') {
            $join_date = $row['date_join_army'];
        } elseif (!empty($row['date_join_revolution']) && $row['date_join_revolution'] !== '0000-00-00') {
            $join_date = $row['date_join_revolution'];
        }
        
        $years_of_service = 0;
        if ($join_date !== '0000-00-00') {
            $years_of_service = date('Y') - date('Y', strtotime($join_date));
        }
        
        echo json_encode([
            'status' => 'success',
            'officer_id' => $row['officer_id'],
            'national_id' => $row['national_id'],
            'full_name' => $row['full_name'],
            'full_lastname' => $row['full_lastname'],
            'gender' => $row['gender'],
            'l_name' => $row['l_name'] ?? '',
            'pt_name' => $row['pt_name'] ?? '',
            'birth_date' => $birth_date,
            'age' => $age,
            'join_date' => $join_date,
            'years_of_service' => $years_of_service
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
