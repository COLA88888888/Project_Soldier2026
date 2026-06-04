
<?php 
include('../../condb.php');
$d_id = $_POST['d_id'];
$u_id = $_POST['u_id'];
$pk_id = $_POST['pk_id'];
$o_id = $_POST['o_id'];
$l_id = $_POST['l_id'];
$pt_id = $_POST['pt_id'];
$national_id = $_POST['national_id'];
$full_name = $_POST['full_name'];
$alias_name = $_POST['alias_name'];
$gender = $_POST['gender'];
$birth_date = $_POST['birth_date'];
$age = $_POST['age'];
$date_level = $_POST['date_level'];
$serial_number = $_POST['serial_number'];
$pro_id = $_POST['pro_id'];
$dis_id = $_POST['dis_id'];
$v_id = $_POST['v_id'];
$current_village = $_POST['current_village'];
$current_district = $_POST['current_district'];
$current_province = $_POST['current_province'];
$house_number = $_POST['house_number'];
$road = $_POST['road'];
$block = $_POST['block'];
$id_card_number = $_POST['id_card_number'];
$ethnicity = $_POST['ethnicity'];
$religion = $_POST['religion'];
$confirm_number = $_POST['confirm_number'];
$date_join_revolution = $_POST['date_join_revolution'];
$date_join_police = $_POST['date_join_police'];
$date_join_army = $_POST['date_join_army'];
$date_join_party = $_POST['date_join_party'];
$backup_party_id = $_POST['backup_party_id'];
$date_join = $_POST['date_join'];
$full_party_id = $_POST['full_party_id'];
$date_join_youth = $_POST['date_join_youth'];
$date_join_women = $_POST['date_join_women'];
$date_join_union = $_POST['date_join_union'];
$party_position = $_POST['party_position'];
$state_position = $_POST['state_position'];
$culture_level = $_POST['culture_level'];
$foreign_language = $_POST['foreign_language'];
$lalup_pks = $_POST['lalup_pks'];
$paiyin = $_POST['paiyin'];
$kananghien = $_POST['kananghien'];
$labup = $_POST['labup'];
$school_one = $_POST['school_one'];
$pihien = $_POST['pihien'];
$p_p = $_POST['p_p'];
$level_as = $_POST['level_as'];
$language_as = $_POST['language_as'];
$kananghien_as = $_POST['kananghien_as'];
$labup_as = $_POST['labup_as'];
$school_as = $_POST['school_as'];
$pihien_as = $_POST['pihien_as'];
$p_p_as = $_POST['p_p_as'];
$level_m = $_POST['level_m'];
$kananghien_m = $_POST['kananghien_m'];
$labup_m = $_POST['labup_m'];
$school_m = $_POST['school_m'];
$pihien_m = $_POST['pihien_m'];
$p_p_m = $_POST['p_p_m'];
$system_status = "active";
// ตรวจสอบไฟล์อัพโหลด
$file_document = '';
// อัปโหลดรูปภาพ
if (!empty($_FILES['file_document']['name'])) {
    $ext = pathinfo($_FILES['file_document']['name'], PATHINFO_EXTENSION);
    $file_document = uniqid('file_') . '.' . $ext;
    move_uploaded_file($_FILES['file_document']['tmp_name'], 'documents/' . $file_document);
}

// อัปโหลดไฟล์แนบ
if (!empty($_FILES['photo_img']['name'])) {
    $ext2 = pathinfo($_FILES['photo_img']['name'], PATHINFO_EXTENSION);
    $photo_img = uniqid('img_') . '.' . $ext2;
    move_uploaded_file($_FILES['photo_img']['tmp_name'], 'uploads/' . $photo_img);
}

$sql = mysqli_query($conn, "INSERT INTO officers (
d_id, u_id, pk_id, o_id, l_id, pt_id, national_id, full_name, alias_name, gender,
birth_date, age, date_level, serial_number, pro_id, dis_id, v_id,
current_village, current_district, current_province, house_number, road, block,
id_card_number, ethnicity, religion, confirm_number, date_join_revolution, date_join_police,
date_join_army, date_join_party, backup_party_id, date_join, full_party_id, date_join_youth,
date_join_women, date_join_union, party_position, state_position, culture_level,
foreign_language, lalup_pks, paiyin, kananghien, labup, school_one, pihien, p_p,
level_as, language_as, kananghien_as, labup_as, school_as, pihien_as, p_p_as,
level_m, kananghien_m, labup_m, school_m, pihien_m, p_p_m,
system_status, file_document,photo_img
) VALUES (
'$d_id','$u_id','$pk_id','$o_id','$l_id','$pt_id','$national_id','$full_name','$alias_name','$gender',
'$birth_date','$age','$date_level','$serial_number','$pro_id','$dis_id','$v_id',
'$current_village','$current_district','$current_province','$house_number','$road','$block',
'$id_card_number','$ethnicity','$religion','$confirm_number','$date_join_revolution','$date_join_police',
'$date_join_army','$date_join_party','$backup_party_id','$date_join','$full_party_id','$date_join_youth',
'$date_join_women','$date_join_union','$party_position','$state_position','$culture_level',
'$foreign_language','$lalup_pks','$paiyin','$kananghien','$labup','$school_one','$pihien','$p_p',
'$level_as','$language_as','$kananghien_as','$labup_as','$school_as','$pihien_as','$p_p_as',
'$level_m','$kananghien_m','$labup_m','$school_m','$pihien_m','$p_p_m',
'active','$file_document','$photo_img'
)");

if ($sql) {
echo "<script>
Swal.fire({
icon: 'success',
title: 'ບັນທຶກຂໍ້ມູນກົມກອງສຳເລັດ',
timer: 2000,
showConfirmButton: false
}).then(() => {
window.location = 'show_table.php'; 
});
</script>";
} else {
echo "<script>
Swal.fire({
icon: 'error',
title: 'ຜິດພາດ: ".mysqli_error($conn)."'
});
</script>";
}

?>