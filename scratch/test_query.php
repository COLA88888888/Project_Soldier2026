<?php
include('d:/xampp/htdocs/project_soldier2025/condb.php');

$officer_id = 1; // dummy ID or we can query any ID from officers table first

// Let's get one officer_id first
$res = $conn->query("SELECT officer_id FROM officers LIMIT 1");
if ($res && $row = $res->fetch_assoc()) {
    $officer_id = $row['officer_id'];
    echo "Testing with officer_id: " . $officer_id . "\n";
} else {
    echo "No officers found in database or error: " . $conn->error . "\n";
    exit;
}

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

if (!$stmt) {
    echo "Prepare failed: " . $conn->error . "\n";
    exit;
}

$stmt->bind_param("s", $officer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo "Success! Officer name: " . $row['full_name'] . " " . $row['full_lastname'] . "\n";
} else {
    echo "Officer not found.\n";
}
$stmt->close();
?>
