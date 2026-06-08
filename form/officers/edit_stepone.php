<?php
include('../../condb.php');


if (!isset($_GET['officer_id'])) {
    echo "<script>window.location='show_table.php';</script>";
    exit;
}

$officer_id = intval($_GET['officer_id']);
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM officers WHERE officer_id = ?");
$stmt->bind_param("i", $officer_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$data) {
    echo "<script>alert('ບໍ່ພົບຂໍ້ມູນ'); window.location='show_table.php';</script>";
    exit;
}
// ดึงชื่อห້ອງການ
$o_name = '';
$stmt = $conn->prepare("SELECT o_name FROM office WHERE o_id = ?");
$stmt->bind_param("i", $data['o_id']);
$stmt->execute();
$stmt->bind_result($o_name);
$stmt->fetch();
$stmt->close();

// ดึงชื่อພະແນກ
$pk_name = '';
$stmt = $conn->prepare("SELECT pk_name FROM panak WHERE pk_id = ?");
$stmt->bind_param("i", $data['pk_id']);
$stmt->execute();
$stmt->bind_result($pk_name);
$stmt->fetch();
$stmt->close();

// ดึงชื่อໜ່ວຍງານ
$u_name = '';
$stmt = $conn->prepare("SELECT u_name FROM units WHERE u_id = ?");
$stmt->bind_param("i", $data['u_id']);
$stmt->execute();
$stmt->bind_result($u_name);
$stmt->fetch();
$stmt->close();

?>

<div class="row">
  <div class="col-sm-6">
    <!-- กรม -->
    <div class="form-group">
      <label>ກົມກອງຂື້ນກັບ</label>
      <select name="d_id" class="form-control select2" id="d_id">
        <option value="">-- ເລືອກກົມກອງຂື້ນກັບ --</option>
        <?php
        $stmt = $conn->prepare("SELECT * FROM department ORDER BY d_name ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $selected = ($data['d_id'] == $row['d_id']) ? 'selected' : '';
            echo "<option value='{$row['d_id']}' $selected>{$row['d_name']}</option>";
        }
        $stmt->close();
        ?>
      </select>
    </div>

    <!-- ห้องการ -->
  <div class="form-group">
  <label>ຫ້ອງການ</label>
  <select name="o_id" class="form-control select2" id="o_id">
    <option value="<?= $data['o_id'] ?>" selected><?= htmlspecialchars($o_name) ?></option>
  </select>
</div>

<div class="form-group">
  <label>ພະແນກ</label>
  <select name="pk_id" class="form-control select2" id="pk_id">
    <option value="<?= $data['pk_id'] ?>" selected><?= htmlspecialchars($pk_name) ?></option>
  </select>
</div>

</div>
  <div class="col-sm-6">
    <!-- ຫ້ອງຍ່ອຍ -->
<div class="form-group">
  <label>ໜ່ວຍງານ</label>
  <select name="u_id" class="form-control select2" id="u_id">
    <option value="<?= $data['u_id'] ?>" selected><?= htmlspecialchars($u_name) ?></option>
  </select>
</div>
    <!-- ໜ້າທີ່ຮັບຜິດຊອບ -->
    <div class="form-group">
      <label>ໜ້າທີ່ຮັບຜິດຊອບ</label>
      <select name="pt_id" class="form-control select2" id="pt_id">
        <option value="">-- ເລືອກໜ້າທີ່ --</option>
        <?php
        $stmt = $conn->prepare("SELECT * FROM positions ORDER BY pt_name ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $selected = ($data['pt_id'] == $row['pt_id']) ? 'selected' : '';
            echo "<option value='{$row['pt_id']}' $selected>{$row['pt_name']}</option>";
        }
        $stmt->close();
        ?>
      </select>
    </div>

    <!-- ຊັ້ນ -->
    <div class="form-group">
      <label>ຊັ້ນ</label>
      <select name="l_id" class="form-control select2" id="l_id">
        <option value="">-- ເລືອກຊັ້ນ --</option>
        <?php
        $stmt = $conn->prepare("SELECT * FROM positions_level ORDER BY l_name ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $selected = ($data['l_id'] == $row['l_id']) ? 'selected' : '';
            echo "<option value='{$row['l_id']}' $selected>{$row['l_name']}</option>";
        }
        $stmt->close();
        ?>
      </select>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $('#d_id').change(function() {
    $.post("ajax_sungkud.php", {
      d_id: $(this).val(),
      function: 'd_id'
    }, function(data) {
      $('#o_id').html(data);
    });
  });

  $('#o_id').change(function() {
    $.post("ajax_sungkud.php", {
      o_id: $(this).val(),
      function: 'o_id'
    }, function(data) {
      $('#pk_id').html(data);
    });
  });

  $('#pk_id').change(function() {
    $.post("ajax_sungkud.php", {
      pk_id: $(this).val(),
      function: 'pk_id'
    }, function(data) {
      $('#u_id').html(data);
    });
  });
});
</script>
