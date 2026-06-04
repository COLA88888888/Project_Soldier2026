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
?>
    <div class="card">
    <div class="card-header bg-primary">
<h3 class="card-title">ລາຍງານຂໍ້ມູນກົມກອງ</h3>
</div>
<!-- /.card-header -->
<div class="card-body">
<table class='table table-bordered table-hover' id='example1'>
<thead>
    <tr>
        <th>#</th>
        <th>ກົມກອງ</th>
        <th>ຈັດການ</th>
    </tr>
</thead>
<tbody>

<?php
$i = 1;
while ($row = $result->fetch_assoc()):
?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo htmlspecialchars($row['d_name']); ?></td>
        <td>
            <button class='btn btn-warning btn-sm' onclick='editUser(<?php echo $row['d_id']; ?>)'>ແກ້ໄຂ</button>
            <button class='btn btn-danger btn-sm' onclick='deleteUser(<?php echo $row['d_id']; ?>)'>ລົບ</button>
        </td>
    </tr>
<?php
$i++;
endwhile;
?>

</tbody>
</table>
    </div>
</div>