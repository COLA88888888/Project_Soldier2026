<?php
include(__DIR__ . '/../condb.php');

$sql = "ALTER TABLE salaries ADD COLUMN payment_updated_at datetime DEFAULT NULL";
if ($conn->query($sql)) {
    echo "Column payment_updated_at added successfully!\n";
} else {
    echo "Error adding column: " . $conn->error . "\n";
}
?>
