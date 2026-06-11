<?php 
include('../../condb.php');
session_start();
$d_id = $_POST['d_id'] ?? '';
$u_id = $_POST['u_id'] ?? '';
$pk_id = $_POST['pk_id'] ?? '';
$o_id = $_POST['o_id'] ?? '';
$l_id = $_POST['l_id'] ?? '';
$pt_id = $_POST['pt_id'] ?? '';
$national_id = $_POST['national_id'] ?? '';
$full_name = $_POST['full_name'] ?? '';
$full_lastname = $_POST['full_lastname'] ?? '';
$alias_name = $_POST['alias_name'] ?? '';
$gender = $_POST['gender'] ?? '';
$status_persions = $_POST['status_persions']?? '';
$birth_date = $_POST['birth_date'] ?? '';
$age = $_POST['age'] ?? '';
$date_level = $_POST['date_level'] ?? '';
$serial_number = $_POST['serial_number'] ?? '';
$pro_id = $_POST['pro_id'] ?? '';
$dis_id = $_POST['dis_id'] ?? '';
$v_id = $_POST['v_id'] ?? '';
$numberphone = $_POST['numberphone'] ?? '';
$current_province = '';
$current_district = '';
$current_village = $_POST['current_village'] ?? '';

$current_province_id = $_POST['current_province_id'] ?? '';
$current_district_id = $_POST['current_district_id'] ?? '';

if (!empty($current_province_id)) {
    $p_stmt = $conn->prepare("SELECT pro_name FROM province WHERE pro_id = ? LIMIT 1");
    $p_stmt->bind_param("i", $current_province_id);
    $p_stmt->execute();
    $p_stmt->bind_result($current_province);
    $p_stmt->fetch();
    $p_stmt->close();
}

if (!empty($current_district_id)) {
    $d_stmt = $conn->prepare("SELECT dis_name FROM distict WHERE dis_id = ? LIMIT 1");
    $d_stmt->bind_param("i", $current_district_id);
    $d_stmt->execute();
    $d_stmt->bind_result($current_district);
    $d_stmt->fetch();
    $d_stmt->close();
}
$house_number = $_POST['house_number'] ?? '';
$road = $_POST['road'] ?? '';
$block = $_POST['block'] ?? '';
$id_card_number = $_POST['id_card_number'] ?? '';
$ethnicity = $_POST['ethnicity'] ?? '';
$religion = $_POST['religion'] ?? '';
$confirm_number = $_POST['confirm_number'] ?? '';
$date_join_revolution = $_POST['date_join_revolution'] ?? '';
$date_join_police = $_POST['date_join_police'] ?? '';
$date_join_army = $_POST['date_join_army'] ?? '';
$date_join_party = $_POST['date_join_party'] ?? '';
$backup_party_id = $_POST['backup_party_id'] ?? '';
$date_join = $_POST['date_join'] ?? '';
$full_party_id = $_POST['full_party_id'] ?? '';
$date_join_youth = $_POST['date_join_youth'] ?? '';
$date_join_women = $_POST['date_join_women'] ?? '';
$date_join_union = $_POST['date_join_union'] ?? '';
$party_position = $_POST['party_position'] ?? '';
$state_position = $_POST['state_position'] ?? '';
$culture_level = $_POST['culture_level'] ?? '';
$foreign_language = $_POST['foreign_language'] ?? '';
$lalup_pks = $_POST['lalup_pks'] ?? '';
$paiyin = $_POST['paiyin'] ?? '';
$kananghien = $_POST['kananghien'] ?? '';
$labup = $_POST['labup'] ?? '';
$school_one = $_POST['school_one'] ?? '';
$pihien = $_POST['pihien'] ?? '';
$p_p = $_POST['p_p'] ?? '';
$level_as = $_POST['level_as'] ?? '';
$language_as = $_POST['language_as'] ?? '';
$kananghien_as = $_POST['kananghien_as'] ?? '';
$labup_as = $_POST['labup_as'] ?? '';
$school_as = $_POST['school_as'] ?? '';
$pihien_as = $_POST['pihien_as'] ?? '';
$p_p_as = $_POST['p_p_as'] ?? '';
$level_m = $_POST['level_m'] ?? '';
$kananghien_m = $_POST['kananghien_m'] ?? '';
$labup_m = $_POST['labup_m'] ?? '';
$school_m = $_POST['school_m'] ?? '';
$pihien_m = $_POST['pihien_m'] ?? '';
$p_p_m = $_POST['p_p_m'] ?? '';
$ffull_name = $_POST['ffull_name'] ?? '';
$fage = $_POST['fage'] ?? '';
$fproname = $_POST['fproname'] ?? '';
$fdisname = $_POST['fdisname'] ?? '';
$fvillagename = $_POST['fvillagename'] ?? '';
$foccupation = $_POST['foccupation'] ?? '';
$fworkplace = $_POST['fworkplace'] ?? '';
$fzonpao = $_POST['fzonpao'] ?? '';
$mfull_name = $_POST['mfull_name'] ?? '';
$mage = $_POST['mage'] ?? '';
$mproname = $_POST['mproname'] ?? '';
$mdisname = $_POST['mdisname'] ?? '';
$mvillagename = $_POST['mvillagename'] ?? '';
$moccupation = $_POST['moccupation'] ?? '';
$mworkplace = $_POST['mworkplace'] ?? '';
$mzonpao = $_POST['mzonpao'] ?? '';
$falyfull_name = $_POST['falyfull_name'] ?? '';
$falybirth_date = $_POST['falybirth_date'] ?? '';
$falyages = $_POST['falyages'] ?? '';
$falyzonpao = $_POST['falyzonpao'] ?? '';
$falyzozun = $_POST['falyzozun'] ?? '';
$falyzadsana = $_POST['falyzadsana'] ?? '';
$falyproname = $_POST['falyproname'] ?? '';
$falydisname = $_POST['falydisname'] ?? '';
$falyvillagename = $_POST['falyvillagename'] ?? '';
$falyoccupation = $_POST['falyoccupation'] ?? '';
$falylive = $_POST['falylive'];
$falyworkplace = $_POST['falyworkplace'] ?? '';
$family_date = $_POST['family_date'] ?? '';
$falynumber_of_children = $_POST['falynumber_of_children'] ?? '';
$falyphone = $_POST['falyphone'] ?? '';
$falynotes = $_POST['falynotes'] ?? '';
$is_pgks = $_POST['is_pgks'] ?? '';
$office_date = $_POST['office_date'] ?? '';
$reference_number = $_POST['reference_number'] ?? '';
$department_center = $_POST['department_center'] ?? '';
$graduation_date = $_POST['graduation_date'] ?? '';
$user_id = $_SESSION['user_id'] ?? 1;
$system_status = "ON";

$file_document = '';
if (!empty($_FILES['file_document']['name'])) {
$ext = pathinfo($_FILES['file_document']['name'], PATHINFO_EXTENSION);
$file_document = uniqid('file_') . '.' . $ext;
move_uploaded_file($_FILES['file_document']['tmp_name'], 'documents/' . $file_document);
}

$photo_img = $_FILES['photo_img'];

$upload = $_FILES['photo_img']['name'];

if ($upload != '') {
$allow = array('jpg', 'jpeg', 'png');
$extension = explode('.', $photo_img['name']);
$fileActExt = strtolower(end($extension));
$fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
$filePath = 'uploads/'.$fileNew;

if (in_array($fileActExt, $allow)) {
if ($photo_img['size'] > 0 && $photo_img['error'] == 0) {
move_uploaded_file($photo_img['tmp_name'], $filePath);
}
}

} else {
$fileNew = $photo_img;
}

$sql = "INSERT INTO officers (d_id, u_id, pk_id, o_id, l_id, pt_id, national_id, full_name, full_lastname, alias_name, gender,status_persions, birth_date, age, date_level, serial_number, pro_id, dis_id, v_id, numberphone, current_village, current_district, current_province, house_number, road, block, id_card_number, ethnicity, religion, confirm_number, date_join_revolution, date_join_police, date_join_army, date_join_party, backup_party_id, date_join, full_party_id, date_join_youth, date_join_women, date_join_union, party_position, state_position, culture_level, foreign_language, lalup_pks, paiyin, kananghien, labup, school_one, pihien, p_p, level_as, language_as, kananghien_as, labup_as, school_as, pihien_as, p_p_as, level_m, kananghien_m, labup_m, school_m, pihien_m, p_p_m, system_status, file_document, photo_img, ffull_name, fage, fproname, fdisname, fvillagename, foccupation, fworkplace, mfull_name, mage, mproname, mdisname, mvillagename, moccupation, mworkplace,mzonpao, falyfull_name, falybirth_date, falyages,falyzonpao,falyzozun,falyzadsana, falyproname, falydisname, falyvillagename, falyoccupation, falyworkplace, falynumber_of_children, falyphone, falynotes, is_pgks, office_date, reference_number, department_center, graduation_date, user_id) VALUES (
'$d_id','$u_id','$pk_id','$o_id','$l_id','$pt_id','$national_id','$full_name','$full_lastname','$alias_name','$gender','$status_persions','$birth_date','$age','$date_level','$serial_number','$pro_id','$dis_id','$v_id', '$numberphone','$current_village','$current_district','$current_province','$house_number','$road','$block','$id_card_number','$ethnicity','$religion','$confirm_number','$date_join_revolution','$date_join_police','$date_join_army','$date_join_party','$backup_party_id','$date_join','$full_party_id','$date_join_youth','$date_join_women','$date_join_union','$party_position','$state_position','$culture_level','$foreign_language','$lalup_pks','$paiyin','$kananghien','$labup','$school_one','$pihien','$p_p','$level_as','$language_as','$kananghien_as','$labup_as','$school_as','$pihien_as','$p_p_as','$level_m','$kananghien_m','$labup_m','$school_m','$pihien_m','$p_p_m','$system_status','$file_document','$fileNew','$ffull_name','$fage','$fproname','$fdisname','$fvillagename','$foccupation','$fworkplace','$mfull_name','$mage','$mproname','$mdisname','$mvillagename','$moccupation','$mworkplace','$mzonpao','$falyfull_name','$falybirth_date','$falyages','$falyzonpao','$falyzozun','$falyzadsana','$falyproname','$falydisname','$falyvillagename','$falyoccupation','$falyworkplace','$falynumber_of_children','$falyphone','$falynotes','$is_pgks','$office_date','$reference_number','$department_center','$graduation_date','$user_id')";

$query = mysqli_query($conn, $sql);

if ($query) {
echo "<script>
Swal.fire({ icon: 'success', title: 'ບັນທຶກຂໍ້ມູນສຳເລັດ', timer: 2000, showConfirmButton: false })
.then(() => window.location = 'show_table.php');
</script>";
} else {
echo "<script>
Swal.fire({ icon: 'error', title: 'ຜິດພາດ: ".mysqli_error($conn)."' });
</script>";
}
?>
