<?php
include(__DIR__ . '/../condb.php');
$res = $conn->query("DESCRIBE users");
while ($row = $res->fetch_assoc()) {
    echo "{$row['Field']} - {$row['Type']}\n";
}
?>
