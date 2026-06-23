<?php
include(__DIR__ . '/../condb.php');

$sql = "ALTER TABLE salaries ADD COLUMN payment_status varchar(20) NOT NULL DEFAULT 'unpaid'";
if ($conn->query($sql)) {
    echo "Column payment_status added successfully!\n";
} else {
    echo "Error adding column: " . $conn->error . "\n";
}
?>
