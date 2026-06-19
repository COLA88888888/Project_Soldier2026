<?php
require '../../condb.php';

header('Content-Type: application/json');

if (isset($_POST['officer_id']) || isset($_POST['national_id'])) {
    
    if (isset($_POST['officer_id']) && !empty($_POST['officer_id'])) {
        $sql = "SELECT a.officer_id, a.full_name, a.full_lastname, a.gender, a.national_id, a.o_id, a.pk_id, a.u_id, a.pt_id, e.l_name,
                       o.o_name, pk.pk_name, u.u_name, pt.pt_name 
                FROM officers AS a
                LEFT JOIN positions_level AS e ON a.l_id = e.l_id
                LEFT JOIN office AS o ON a.o_id = o.o_id
                LEFT JOIN panak AS pk ON a.pk_id = pk.pk_id
                LEFT JOIN units AS u ON a.u_id = u.u_id
                LEFT JOIN positions AS pt ON a.pt_id = pt.pt_id
                WHERE a.officer_id = ? AND a.system_status = 'ON'";
        $stmt = $conn->prepare($sql);
        $id_param = intval($_POST['officer_id']);
        $stmt->bind_param("i", $id_param);
    } else {
        $sql = "SELECT a.officer_id, a.full_name, a.full_lastname, a.gender, a.national_id, a.o_id, a.pk_id, a.u_id, a.pt_id, e.l_name,
                       o.o_name, pk.pk_name, u.u_name, pt.pt_name 
                FROM officers AS a
                LEFT JOIN positions_level AS e ON a.l_id = e.l_id
                LEFT JOIN office AS o ON a.o_id = o.o_id
                LEFT JOIN panak AS pk ON a.pk_id = pk.pk_id
                LEFT JOIN units AS u ON a.u_id = u.u_id
                LEFT JOIN positions AS pt ON a.pt_id = pt.pt_id
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
            'l_name' => $row['l_name'] ?? 'ບໍ່ມີຊັ້ນ',
            'o_id' => $row['o_id'] ?? '',
            'pk_id' => $row['pk_id'] ?? '',
            'u_id' => $row['u_id'] ?? '',
            'pt_id' => $row['pt_id'] ?? '',
            'o_name' => $row['o_name'] ?? 'ບໍ່ມີຫ້ອງການ',
            'pk_name' => $row['pk_name'] ?? 'ບໍ່ມີພະແນກ',
            'u_name' => $row['u_name'] ?? 'ບໍ່ມີໜ່ວຍງານ',
            'pt_name' => $row['pt_name'] ?? 'ບໍ່ມີໜ້າທີ່'
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
