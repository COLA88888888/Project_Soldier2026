<?php 
include('../../condb.php');
session_start();
$officer_id = $_POST['officer_id'] ?? '';
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
$birth_date = $_POST['birth_date'] ?? '';
$age = $_POST['age'] ?? '';
$date_level = $_POST['date_level'] ?? '';
$serial_number = $_POST['serial_number'] ?? '';
$pro_id = $_POST['pro_id'] ?? '';
$dis_id = $_POST['dis_id'] ?? '';
$v_id = $_POST['v_id'] ?? '';
$numberphone = $_POST['numberphone'] ?? '';
$current_village = $_POST['current_village'] ?? '';
$current_district = $_POST['current_district'] ?? '';
$current_province = $_POST['current_province'] ?? '';
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
$fzonpao = $_POST['fzonpao'] ?? '';
$fproname = $_POST['fproname'] ?? '';
$fdisname = $_POST['fdisname'] ?? '';
$fvillagename = $_POST['fvillagename'] ?? '';
$foccupation = $_POST['foccupation'] ?? '';
$fworkplace = $_POST['fworkplace'] ?? '';
$mfull_name = $_POST['mfull_name'] ?? '';
$mage = $_POST['mage'] ?? '';
$mzonpao = $_POST['mzonpao'] ?? '';
$mproname = $_POST['mproname'] ?? '';
$mdisname = $_POST['mdisname'] ?? '';
$mvillagename = $_POST['mvillagename'] ?? '';
$moccupation = $_POST['moccupation'] ?? '';
$mworkplace = $_POST['mworkplace'] ?? '';
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
$falylive = $_POST['falylive'] ?? '';
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

$document_file = $_FILES['file_document'];  // หรือเปลี่ยนชื่อให้เหมาะสม เช่น $_FILES['document']
$old_file = $_POST['files2'];  // ใช้กรณีมีไฟล์เก่า
$upload_files = $document_file['name'];

if ($upload_files != '') {
    // กำหนดนามสกุลที่อนุญาต
    $allowed_extensions = array('pdf', 'doc', 'docx', 'xls', 'xlsx'); // เพิ่มหรือปรับตามต้องการ
    $extension = strtolower(pathinfo($upload_files, PATHINFO_EXTENSION));
    $new_filename = uniqid() . '.' . $extension;
    $file_path = 'documents/' . $new_filename;

    if (in_array($extension, $allowed_extensions)) {
        if ($document_file['size'] > 0 && $document_file['error'] == 0) {
            if (move_uploaded_file($document_file['tmp_name'], $file_path)) {
                // สำเร็จ: $new_filename คือชื่อไฟล์ใหม่
            } else {
                echo "<script>alert('อัปโหลดไฟล์ไม่สำเร็จ');</script>";
            }
        }
    } else {
        echo "<script>alert('ไม่อนุญาตให้อัปโหลดไฟล์ประเภทนี้');</script>";
    }
} else {
    // ถ้าไม่ได้อัปโหลดใหม่ ให้ใช้ชื่อไฟล์เก่า
    $new_filename = $old_file;
}



$photo_img = $_FILES['photo_img'];

        $img2 = $_POST['img2'];
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
            $fileNew = $img2;
        }

$sql = "UPDATE officers SET 
  d_id = '$d_id',
  u_id = '$u_id',
  pk_id = '$pk_id',
  o_id = '$o_id',
  l_id = '$l_id',
  pt_id = '$pt_id',
  national_id = '$national_id',
  full_name = '$full_name',
  full_lastname = '$full_lastname',
  alias_name = '$alias_name',
  gender = '$gender',
  birth_date = '$birth_date',
  age = '$age',
  date_level = '$date_level',
  serial_number = '$serial_number',
  pro_id = '$pro_id',
  dis_id = '$dis_id',
  v_id = '$v_id',
  numberphone = '$numberphone',
  current_village = '$current_village',
  current_district = '$current_district',
  current_province = '$current_province',
  house_number = '$house_number',
  road = '$road',
  block = '$block',
  id_card_number = '$id_card_number',
  ethnicity = '$ethnicity',
  religion = '$religion',
  confirm_number = '$confirm_number',
  date_join_revolution = '$date_join_revolution',
  date_join_police = '$date_join_police',
  date_join_army = '$date_join_army',
  date_join_party = '$date_join_party',
  backup_party_id = '$backup_party_id',
  date_join = '$date_join',
  full_party_id = '$full_party_id',
  date_join_youth = '$date_join_youth',
  date_join_women = '$date_join_women',
  date_join_union = '$date_join_union',
  party_position = '$party_position',
  state_position = '$state_position',
  culture_level = '$culture_level',
  foreign_language = '$foreign_language',
  lalup_pks = '$lalup_pks',
  paiyin = '$paiyin',
  kananghien = '$kananghien',
  labup = '$labup',
  school_one = '$school_one',
  pihien = '$pihien',
  p_p = '$p_p',
  level_as = '$level_as',
  language_as = '$language_as',
  kananghien_as = '$kananghien_as',
  labup_as = '$labup_as',
  school_as = '$school_as',
  pihien_as = '$pihien_as',
  p_p_as = '$p_p_as',
  level_m = '$level_m',
  kananghien_m = '$kananghien_m',
  labup_m = '$labup_m',
  school_m = '$school_m',
  pihien_m = '$pihien_m',
  p_p_m = '$p_p_m',
  system_status = '$system_status',
  file_document = '$new_filename',
  photo_img = '$fileNew',
  ffull_name = '$ffull_name',
  fage = '$fage',
  fproname = '$fproname',
  fdisname = '$fdisname',
  fvillagename = '$fvillagename',
  foccupation = '$foccupation',
  fworkplace = '$fworkplace',
  fzonpao = '$fzonpao',
  mfull_name = '$mfull_name',
  mage = '$mage',
  mproname = '$mproname',
  mdisname = '$mdisname',
  mvillagename = '$mvillagename',
  moccupation = '$moccupation',
  mworkplace = '$mworkplace',
  mzonpao = '$mzonpao',
  falyfull_name = '$falyfull_name',
  falybirth_date = '$falybirth_date',
  falyages = '$falyages',
  falyzonpao = '$falyzonpao',
  falyzozun = '$falyzozun',
  falyzadsana = '$falyzadsana',
  falyproname = '$falyproname',
  falydisname = '$falydisname',
  falyvillagename = '$falyvillagename',
  falyoccupation = '$falyoccupation',
  falyworkplace = '$falyworkplace',
  falylive = '$falylive',
  family_date = '$family_date',
  falynumber_of_children = '$falynumber_of_children',
  falyphone = '$falyphone',
  falynotes = '$falynotes',
  is_pgks = '$is_pgks',
  office_date = '$office_date',
  reference_number = '$reference_number',
  department_center = '$department_center',
  graduation_date = '$graduation_date'
WHERE officer_id = '$officer_id' AND user_id = '$user_id'";

$query = mysqli_query($conn, $sql);

if ($query) {
  echo "<script>
    Swal.fire({ icon: 'success', title: 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ', timer: 2000, showConfirmButton: false })
      .then(() => window.location = 'show_table.php');
  </script>";
} else {
  echo "<script>
    Swal.fire({ icon: 'error', title: 'ຜິດພາດ: ".mysqli_error($conn)."' });
  </script>";
}
?>
