<?php
include(__DIR__ . '/../condb.php');

// Fetch valid foreign keys
$d_ids = []; $u_ids = []; $pk_ids = []; $o_ids = [];
$l_ids = []; $pt_ids = []; $pro_ids = []; $dis_ids = []; $v_ids = [];

$res = $conn->query("SELECT d_id FROM department LIMIT 5");
while ($r = $res->fetch_assoc()) $d_ids[] = $r['d_id'];

$res = $conn->query("SELECT u_id FROM units LIMIT 5");
while ($r = $res->fetch_assoc()) $u_ids[] = $r['u_id'];

$res = $conn->query("SELECT pk_id FROM panak LIMIT 5");
while ($r = $res->fetch_assoc()) $pk_ids[] = $r['pk_id'];

$res = $conn->query("SELECT o_id FROM office LIMIT 5");
while ($r = $res->fetch_assoc()) $o_ids[] = $r['o_id'];

$res = $conn->query("SELECT l_id FROM positions_level LIMIT 5");
while ($r = $res->fetch_assoc()) $l_ids[] = $r['l_id'];

$res = $conn->query("SELECT pt_id FROM positions LIMIT 5");
while ($r = $res->fetch_assoc()) $pt_ids[] = $r['pt_id'];

$res = $conn->query("SELECT pro_id FROM province LIMIT 5");
while ($r = $res->fetch_assoc()) $pro_ids[] = $r['pro_id'];

$res = $conn->query("SELECT dis_id FROM distict LIMIT 5");
while ($r = $res->fetch_assoc()) $dis_ids[] = $r['dis_id'];

$res = $conn->query("SELECT v_id FROM village LIMIT 5");
while ($r = $res->fetch_assoc()) $v_ids[] = $r['v_id'];

$res = $conn->query("SELECT user_id FROM users LIMIT 1");
$user_row = $res->fetch_assoc();
$user_id = $user_row ? (int)$user_row['user_id'] : 1;

if (empty($d_ids) || empty($u_ids) || empty($pk_ids) || empty($o_ids) || empty($l_ids) || empty($pt_ids) || empty($pro_ids) || empty($dis_ids) || empty($v_ids)) {
    die("Error: Reference tables must have data.\n");
}

echo "Starting seeding with raw queries...\n";

$first_names = ["ສົມພອນ", "ແກ້ວ", "ບຸນມີ", "ແແສງ", "ສຸກ", "ພຸດ", "ຄຳ", "ວິໄລ", "ວັນ", "ຈັນ", "ພອນ", "ອານຸ", "ໄຊ", "ສີ", "ເພັດ"];
$last_names = ["ວິໄລທອງ", "ແກ້ວມະນີ", "ໄຊຍະເສນ", "ສີປະເສີດ", "ພົມມະຈັນ", "ຫຼວງລາດ", "ແສງດາລາ", "ບຸນເຮືອງ", "ມະນີວົງ", "ສຸວັນນະ"];
$genders = ["ຊາຍ", "ຍິງ"];
$ethnicities = ["ລາວລຸ່ມ", "ລາວເທິງ", "ລາວສູງ"];
$religions = ["ພຸດ", "ຄຣິດ", "ບໍ່ມີ"];
$payment_statuses = ["paid", "unpaid"];

$current_month = date('Y-m');

function esc($conn, $val) {
    if ($val === null) return "NULL";
    return "'" . mysqli_real_escape_string($conn, $val) . "'";
}

for ($i = 1; $i <= 10; $i++) {
    $first = $first_names[array_rand($first_names)];
    $last = $last_names[array_rand($last_names)];
    $gender = ($first === "ພອນ" || $first === "ວິໄລ" || $first === "ຈັນ") ? "ຍິງ" : $genders[array_rand($genders)];
    $national_id = "OFF" . str_pad(rand(10000, 99999), 5, "0", STR_PAD_LEFT);
    $alias_name = $gender === "ຊາຍ" ? "ທ້າວ " . $first : "ນາງ " . $first;
    $age = rand(22, 50);
    $birth_date = date('Y-m-d', strtotime("-" . $age . " years -" . rand(1, 365) . " days"));
    
    $d_id = (int)$d_ids[array_rand($d_ids)];
    $u_id = (int)$u_ids[array_rand($u_ids)];
    $pk_id = (int)$pk_ids[array_rand($pk_ids)];
    $o_id = (int)$o_ids[array_rand($o_ids)];
    $l_id = (int)$l_ids[array_rand($l_ids)];
    $pt_id = (int)$pt_ids[array_rand($pt_ids)];
    $pro_id = (int)$pro_ids[array_rand($pro_ids)];
    $dis_id = (int)$dis_ids[array_rand($dis_ids)];
    $v_id = (int)$v_ids[array_rand($v_ids)];
    
    $numberphone = "020 9" . rand(1000000, 9999999);
    $ethnicity = $ethnicities[array_rand($ethnicities)];
    $religion = $religions[array_rand($religions)];
    
    $date_join_police = date('Y-m-d', strtotime("-5 years -" . rand(1, 365) . " days"));
    $date_join_revolution = date('Y-m-d', strtotime("-7 years"));
    $date_join_party = date('Y-m-d', strtotime("-3 years"));
    $date_join = date('Y-m-d', strtotime("-2 years"));
    $date_join_youth = date('Y-m-d', strtotime("-10 years"));
    $date_join_women = $gender === "ຍິງ" ? date('Y-m-d', strtotime("-10 years")) : null;
    $date_join_union = date('Y-m-d', strtotime("-4 years"));
    
    $culture_level = "ມັດທະຍົມປາຍ";
    $lalup_pks = "ປະລິນຍາຕີ";
    $kananghien = "ບໍລິຫານລັດ";
    $labup = "ຊັ້ນສູງ";
    $school_one = "ສະຖາບັນການເມືອງ";
    $pihien = "2018-2022";
    
    $ffull_name = "ທ້າວ ສີ" . $last;
    $fage = $age + rand(20, 25);
    $foccupation = "ຊາວນາ";
    $fzonpao = "ລາວ";
    
    $mfull_name = "ນາງ ແດງ" . $last;
    $mage = $age + rand(18, 23);
    $moccupation = "ແມ່ບ້ານ";
    $mzonpao = "ລາວ";
    
    $status_persions = "ຄອບຄົວ";
    $falyfull_name = $gender === "ຊາຍ" ? "ນາງ ສີ" . $last : "ທ້າວ ແກ້ວ" . $last;
    $falyages = (string)($age + rand(-2, 3));
    $falyoccupation = "ພະນັກງານ";
    $family_date = date('Y-m-d', strtotime("-3 years"));
    $falynumber_of_children = rand(1, 3);
    
    $sql = "INSERT INTO officers SET 
        d_id = $d_id, u_id = $u_id, pk_id = $pk_id, o_id = $o_id, l_id = $l_id, pt_id = $pt_id, 
        national_id = " . esc($conn, $national_id) . ", 
        full_name = " . esc($conn, $first) . ", 
        full_lastname = " . esc($conn, $last) . ", 
        alias_name = " . esc($conn, $alias_name) . ", 
        gender = " . esc($conn, $gender) . ", 
        status_persions = " . esc($conn, $status_persions) . ", 
        birth_date = " . esc($conn, $birth_date) . ", 
        age = $age, 
        date_level = '2022-01-01 00:00:00', 
        serial_number = 'SN12345', 
        pro_id = $pro_id, dis_id = $dis_id, v_id = $v_id, 
        numberphone = " . esc($conn, $numberphone) . ", 
        current_province = 'ແແຂວງວຽງຈັນ', 
        current_district = 'ເມືອງໂພນໂຮງ', 
        current_village = 'ບ້ານໂພນໂຮງ', 
        house_number = '12', road = 'ຖະໜົນລ້ານຊ້າງ', block = '1', id_card_number = 'ID12345678', 
        ethnicity = " . esc($conn, $ethnicity) . ", 
        religion = " . esc($conn, $religion) . ", 
        date_join_revolution = " . esc($conn, $date_join_revolution) . ", 
        date_join_police = " . esc($conn, $date_join_police) . ", 
        date_join_party = " . esc($conn, $date_join_party) . ", 
        date_join = " . esc($conn, $date_join) . ", 
        date_join_youth = " . esc($conn, $date_join_youth) . ", 
        date_join_women = " . esc($conn, $date_join_women) . ", 
        date_join_union = " . esc($conn, $date_join_union) . ", 
        culture_level = " . esc($conn, $culture_level) . ", 
        lalup_pks = " . esc($conn, $lalup_pks) . ", 
        kananghien = " . esc($conn, $kananghien) . ", 
        labup = " . esc($conn, $labup) . ", 
        school_one = " . esc($conn, $school_one) . ", 
        pihien = " . esc($conn, $pihien) . ", 
        ffull_name = " . esc($conn, $ffull_name) . ", 
        fage = $fage, 
        foccupation = " . esc($conn, $foccupation) . ", 
        fzonpao = " . esc($conn, $fzonpao) . ", 
        mfull_name = " . esc($conn, $mfull_name) . ", 
        mage = $mage, 
        moccupation = " . esc($conn, $moccupation) . ", 
        mzonpao = " . esc($conn, $mzonpao) . ", 
        falyfull_name = " . esc($conn, $falyfull_name) . ", 
        falyages = " . esc($conn, $falyages) . ", 
        falyoccupation = " . esc($conn, $falyoccupation) . ", 
        family_date = " . esc($conn, $family_date) . ", 
        falynumber_of_children = $falynumber_of_children, 
        user_id = $user_id";
        
    if ($conn->query($sql)) {
        $officer_id = $conn->insert_id;
        echo "Officer $i ($first $last) seeded successfully. ID: $officer_id\n";
        
        // Seed Salary
        $base_salary = rand(15, 30) * 100000;
        $salary_increase_15 = round($base_salary * 0.30);
        $allowance = rand(2, 8) * 100000;
        $other_allowance = rand(10, 15) * 10000;
        $deduct_tax = rand(2, 5) * 10000;
        $deduct_other = rand(1, 3) * 10000;
        $deduct_phone = rand(1, 2) * 10000;
        
        $policy_sick = rand(0, 1) * 100000;
        $policy_discharge = 0;
        $policy_other = 0;
        $policy_bonus = rand(0, 1) * 200000;
        
        $payment_status = $payment_statuses[array_rand($payment_statuses)];
        $payment_updated_at = $payment_status === "paid" ? "'" . date('Y-m-d H:i:s') . "'" : "NULL";
        $salary_type = 'soldier';
        $account_number = "160-12-00-" . rand(100000, 999999);
        
        $sal_sql = "INSERT INTO salaries SET
            officer_id = $officer_id, 
            salary_type = '$salary_type', 
            salary_month = '$current_month', 
            account_number = " . esc($conn, $account_number) . ", 
            base_salary = $base_salary, 
            salary_increase_15 = $salary_increase_15, 
            allowance = $allowance, 
            other_allowance = $other_allowance, 
            deduct_tax = $deduct_tax, 
            deduct_other = $deduct_other, 
            deduct_phone = $deduct_phone, 
            policy_sick = $policy_sick, 
            policy_discharge = $policy_discharge, 
            policy_other = $policy_other, 
            policy_bonus = $policy_bonus, 
            user_id = $user_id, 
            payment_status = '$payment_status', 
            payment_updated_at = $payment_updated_at";
        
        if ($conn->query($sal_sql)) {
            echo "  Salary record seeded successfully.\n";
        } else {
            echo "  Error seeding salary: " . $conn->error . "\n";
        }
    } else {
        echo "Error seeding officer $i: " . $conn->error . "\n";
    }
}

echo "Seeding completed successfully!\n";
?>
