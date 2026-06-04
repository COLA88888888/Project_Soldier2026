<?php
include('../../condb.php');

// ✅ กรณีขอข้อมูลเฉพาะ record (เช่น edit)
if (isset($_GET['d_id'])) {
    $d_id = intval($_GET['d_id']);
    $sql = $conn->prepare("SELECT * FROM department WHERE d_id = ?");
    $sql->bind_param("i", $d_id);
    $sql->execute();
    $result = $sql->get_result()->fetch_assoc();
    echo json_encode($result);
    exit;
}

// ✅ แสดงตารางทั้งหมด
$sql = "SELECT * FROM department ORDER BY d_id DESC";
$result = $conn->query($sql);

// ✅ เริ่มต้นตารางด้วย thead + tbody (สำคัญมากสำหรับ DataTables)
$output = "
<table class='table table-bordered' id='example1'>
<thead>
    <tr>
        <th>#</th>
        <th>ກົມກອງ</th>
        <th>ຈັດການ</th>
    </tr>
</thead>
<tbody>
";

$i = 1;
while ($row = $result->fetch_assoc()) {
    $output .= "<tr>
        <td>{$i}</td>
        <td>{$row['d_name']}</td>
        <td>
            <button class='btn btn-warning btn-sm' onclick='editUser({$row['d_id']})'>ແກ້ໄຂ</button>
            <button class='btn btn-danger btn-sm' onclick='deleteUser({$row['d_id']})'>ລົບ</button>
        </td>
    </tr>";
    $i++;
}

$output .= "</tbody></table>";

echo $output;
?>
