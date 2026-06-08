<?php
include('../../condb.php');

$q = trim($_GET['q'] ?? '');

$sql = "SELECT a.*, b.*, c.*, d.*, e.*, f.*, g.*, p.*, di.*, v.*
        FROM officers AS a
        INNER JOIN department AS b ON a.d_id = b.d_id
        INNER JOIN units AS c ON a.u_id = c.u_id
        INNER JOIN panak AS d ON a.pk_id = d.pk_id
        INNER JOIN office AS g ON a.o_id = g.o_id
        INNER JOIN positions_level AS e ON a.l_id = e.l_id
        INNER JOIN positions AS f ON a.pt_id = f.pt_id
        INNER JOIN province AS p ON a.pro_id = p.pro_id
        INNER JOIN distict AS di ON a.dis_id = di.dis_id
        INNER JOIN village AS v ON a.v_id = v.v_id
        WHERE a.full_name LIKE ? OR a.full_lastname LIKE ? 
        ORDER BY a.full_name ASC";

$stmt = $conn->prepare($sql);
$keyword = "%{$q}%";
$stmt->bind_param("ss", $keyword, $keyword);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo '<div class="col-12 text-center text-muted mt-3">
            <strong>ບໍ່ພົບຂໍ້ມູນທີ່ທ່ານຕ້ອງການຄົ້ນຫາ</strong>
          </div>';
} else {
    while ($row = $result->fetch_assoc()) {
        $photo = htmlspecialchars($row['photo_img']);
        if (empty($photo) || !file_exists("uploads/" . $photo)) {
            $photo = 'default_avatar.png';
        }
        ?>
        <div class="col-lg-2 col-6">
            <a href="people_print.php?officer_id=<?= $row['officer_id'] ?>" class="w-100 mt-2 mb-2 d-block">
                <div class="profile-card w-100">
                    <img src="uploads/<?= $photo ?>" alt="Profile Image">
                    <span class="rank-badge"><?= htmlspecialchars($row['l_name']) ?></span>
                    <h5><?= htmlspecialchars($row['full_name'] . ' ' . $row['full_lastname']) ?></h5>
                    <p class="dept-name"><?= htmlspecialchars($row['pk_name']) ?></p>
                </div>
            </a>
        </div>
        <?php
    }
}
?>
