<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('HTTP/1.1 403 Forbidden');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

include('../../condb.php');

if (isset($_GET['officer_id'])) {
    $officer_id = $_GET['officer_id'];
    
    $stmt = $conn->prepare("SELECT 
        a.*, 
        b.d_name, 
        c.u_name, 
        d.pk_name, 
        g.o_name, 
        e.l_name, 
        f.pt_name, 
        p.pro_name, 
        di.dis_name, 
        v.v_name
    FROM officers AS a
    LEFT JOIN department AS b ON a.d_id = b.d_id
    LEFT JOIN units AS c ON a.u_id = c.u_id
    LEFT JOIN panak AS d ON a.pk_id = d.pk_id
    LEFT JOIN office AS g ON a.o_id = g.o_id
    LEFT JOIN positions_level AS e ON a.l_id = e.l_id
    LEFT JOIN positions AS f ON a.pt_id = f.pt_id
    LEFT JOIN province AS p ON a.pro_id = p.pro_id
    LEFT JOIN distict AS di ON a.dis_id = di.dis_id
    LEFT JOIN village AS v ON a.v_id = v.v_id
    WHERE a.officer_id = ?");
    
    $stmt->bind_param("s", $officer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($row, JSON_UNESCAPED_UNICODE);
    } else {
        header('HTTP/1.1 404 Not Found');
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['error' => 'Officer not found']);
    }
    $stmt->close();
} else {
    header('HTTP/1.1 400 Bad Request');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => 'Missing officer_id parameter']);
}
?>
