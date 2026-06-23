<?php
include(__DIR__ . '/../condb.php');

$result = $conn->query("DESCRIBE salaries");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo $row['Field'] . " - " . $row['Type'] . " - Null: " . $row['Null'] . " - Default: " . $row['Default'] . "\n";
    }
} else {
    echo "Error describing table: " . $conn->error;
}
?>
