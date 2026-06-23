<?php
include(__DIR__ . '/../condb.php');

$result = $conn->query("DESCRIBE officers");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo $row['Field'] . " - " . $row['Type'] . "\n";
    }
} else {
    echo "Error: " . $conn->error;
}
?>
