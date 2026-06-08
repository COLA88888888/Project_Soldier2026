<!DOCTYPE html>
<html lang="lo">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ພິມລາຍງານເງິນເດືອນພົນທະຫານ</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Lao|Source+Sans+Pro:300,400,400i,700&display=swap">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Saysettha OT', 'Phetsarath OT', 'Noto Sans Lao', sans-serif;
            color: #000 !important;
        }
        body {
            background-color: #fff;
            margin: 0;
            padding: 10px;
        }
        .print-container {
            width: 100%;
            margin: 0 auto;
        }
        .header-section {
            text-align: center;
            margin-bottom: 25px;
        }
        .header-section h5 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .header-section h4 {
            font-size: 18px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
        }
        .header-section p {
            font-size: 14px;
            margin: 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px !important;
        }
        th, td {
            border: 1px solid #000 !important;
            padding: 4px 2px !important;
            text-align: center;
            vertical-align: middle !important;
        }
        th {
            font-weight: bold;
            background-color: #f2f2f2 !important;
        }
        .text-left {
            text-align: left !important;
            padding-left: 5px !important;
        }
        .font-weight-bold {
            font-weight: bold !important;
        }
        .signature-section {
            margin-top: 30px;
            width: 100%;
            font-size: 13px;
        }
        .signature-table {
            width: 100%;
            border: none !important;
        }
        .signature-table td {
            border: none !important;
            width: 33.33%;
            padding: 10px !important;
            text-align: center;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                padding: 0;
            }
            @page {
                size: A4 landscape;
                margin: 0.5cm;
            }
        }
    </style>
</head>
<body>
<?php
include('../../condb.php');

$selected_month = $_GET['month'] ?? date('Y-m');
$month_lao = date('m/Y', strtotime($selected_month));

// Query Data
$sql = "SELECT s.*, o.full_name, o.full_lastname, o.birth_date, l.l_name, p.pt_name
        FROM salaries AS s
        INNER JOIN officers AS o ON s.officer_id = o.officer_id
        LEFT JOIN positions_level AS l ON o.l_id = l.l_id
        LEFT JOIN positions AS p ON o.pt_id = p.pt_id
        WHERE s.salary_type = 'soldier' AND s.salary_month = ?
        ORDER BY s.salary_id ASC";
        
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $selected_month);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="print-container">
    <!-- Action Button for Manual Printing -->
    <div class="no-print text-right mb-3">
        <button onclick="window.print()" class="btn btn-primary btn-lg"><i class="fas fa-print"></i> ພິມເອກະສານ (Print)</button>
        <button onclick="window.close()" class="btn btn-secondary btn-lg ml-2">ປິດໜ້າຕ່າງ (Close)</button>
    </div>

    <!-- Header matching Lao administration style -->
    <div class="header-section">
        <h5>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</h5>
        <h5>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</h5>
        <h4 class="mt-4"><b>ບັນຊີລາຍຊື່ສັງລວມເງິນເດືອນ ແລະ ເງິນນະໂຍບາຍພົນທະຫານ ປະຈຳເດືອນ: <?= htmlspecialchars($month_lao) ?></b></h4>
        <p>ສັງກັດຢູ່: ກອງບັນຊາການທະຫານ ແຂວງ</p>
    </div>

    <!-- The 23-column Table -->
    <table>
        <thead>
            <tr>
                <th rowspan="2">ລ/ດ</th>
                <th rowspan="2">ຊັ້ນ</th>
                <th rowspan="2" style="width: 150px;">ຊື່ ແລະ ນາມສະກຸນ</th>
                <th rowspan="2">ໜ້າທີ່</th>
                <th rowspan="2" style="width: 90px;">ເລກບັນຊີ</th>
                <th rowspan="2" style="width: 65px;">ວດປ ເກີດ</th>
                <th rowspan="2">ປີ</th>
                <th colspan="5">ລາຍຮັບ (LAK)</th>
                <th colspan="5">ລາຍຫັກ (LAK)</th>
                <th rowspan="2" style="background-color: #e6e6e6 !important;">ຍອດຮັບຕົວຈິງ</th>
                <th colspan="5">ເງິນນະໂຍບາຍອຸດໜູນ (LAK)</th>
                <th rowspan="2" style="background-color: #d9d9d9 !important;">ລວມຮັບທັງໝົດ</th>
            </tr>
            <tr>
                <!-- Income -->
                <th>ເງິນເດືອນພື້ນຖານ</th>
                <th>ປັບປຸງເພີ່ມ 15%</th>
                <th>ເງິນອຸດໜູນ</th>
                <th>ເງິນກິນ/ອ້າຍນ້ອງ</th>
                <th class="font-weight-bold">ລວມລາຍຮັບ</th>
                
                <!-- Deductions -->
                <th>ຫັກ 8%</th>
                <th>ຫັກອາກອນ</th>
                <th>ຫັກຄ່າ...</th>
                <th>ຫັກຄ່າໂທ</th>
                <th class="font-weight-bold">ລວມຫັກ</th>

                <!-- Policy -->
                <th>ປ່ວຍ</th>
                <th>ປົດ</th>
                <th>ໂຄສະນາ</th>
                <th>ບຳເນັດ</th>
                <th class="font-weight-bold">ລວມນະໂຍບາຍ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            
            // Totals variables
            $t_base = 0; $t_increase = 0; $t_allowance = 0; $t_other_allowance = 0; $t_income = 0;
            $t_deduct_8 = 0; $t_deduct_tax = 0; $t_deduct_other = 0; $t_deduct_phone = 0; $t_deducts = 0;
            $t_net = 0;
            $t_sick = 0; $t_discharge = 0; $t_p_other = 0; $t_p_bonus = 0; $t_policy = 0;
            $t_grand = 0;
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $birth_date = $row['birth_date'];
                    $age = 0;
                    if (!empty($birth_date) && $birth_date !== '0000-00-00') {
                        $age = date('Y') - date('Y', strtotime($birth_date));
                    }
                    
                    // Calculations
                    $row_income = $row['base_salary'] + $row['salary_increase_15'] + $row['allowance'] + $row['other_allowance'];
                    $row_deduct_8 = round($row_income * 0.08);
                    $row_deducts = $row_deduct_8 + $row['deduct_tax'] + $row['deduct_other'] + $row['deduct_phone'];
                    $row_net = $row_income - $row_deducts;
                    $row_policy = $row['policy_sick'] + $row['policy_discharge'] + $row['policy_other'] + $row['policy_bonus'];
                    $row_grand = $row_net + $row_policy;
                    
                    // Sum Totals
                    $t_base += $row['base_salary'];
                    $t_increase += $row['salary_increase_15'];
                    $t_allowance += $row['allowance'];
                    $t_other_allowance += $row['other_allowance'];
                    $t_income += $row_income;
                    
                    $t_deduct_8 += $row_deduct_8;
                    $t_deduct_tax += $row['deduct_tax'];
                    $t_deduct_other += $row['deduct_other'];
                    $t_deduct_phone += $row['deduct_phone'];
                    $t_deducts += $row_deducts;
                    
                    $t_net += $row_net;
                    
                    $t_sick += $row['policy_sick'];
                    $t_discharge += $row['policy_discharge'];
                    $t_p_other += $row['policy_other'];
                    $t_p_bonus += $row['policy_bonus'];
                    $t_policy += $row_policy;
                    
                    $t_grand += $row_grand;
            ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($row['l_name'] ?? '') ?></td>
                        <td class="text-left font-weight-bold"><?= htmlspecialchars($row['full_name']) ?> <?= htmlspecialchars($row['full_lastname']) ?></td>
                        <td><?= htmlspecialchars($row['pt_name'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['account_number'] ?? '-') ?></td>
                        <td><?= !empty($birth_date) && $birth_date !== '0000-00-00' ? date('d/m/y', strtotime($birth_date)) : '-' ?></td>
                        <td><?= $age > 0 ? $age : '-' ?></td>
                        
                        <!-- Income -->
                        <td><?= number_format($row['base_salary']) ?></td>
                        <td><?= number_format($row['salary_increase_15']) ?></td>
                        <td><?= number_format($row['allowance']) ?></td>
                        <td><?= number_format($row['other_allowance']) ?></td>
                        <td class="font-weight-bold"><?= number_format($row_income) ?></td>
                        
                        <!-- Deductions -->
                        <td><?= number_format($row_deduct_8) ?></td>
                        <td><?= number_format($row['deduct_tax']) ?></td>
                        <td><?= number_format($row['deduct_other']) ?></td>
                        <td><?= number_format($row['deduct_phone']) ?></td>
                        <td class="font-weight-bold"><?= number_format($row_deducts) ?></td>
                        
                        <!-- Net -->
                        <td class="font-weight-bold" style="background-color: #f9f9f9 !important;"><?= number_format($row_net) ?></td>
                        
                        <!-- Policy -->
                        <td><?= number_format($row['policy_sick']) ?></td>
                        <td><?= number_format($row['policy_discharge']) ?></td>
                        <td><?= number_format($row['policy_other']) ?></td>
                        <td><?= number_format($row['policy_bonus']) ?></td>
                        <td class="font-weight-bold"><?= number_format($row_policy) ?></td>
                        
                        <!-- Grand Total -->
                        <td class="font-weight-bold" style="background-color: #f2f2f2 !important;"><?= number_format($row_grand) ?></td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='23' class='text-center py-4'>ບໍ່ມີຂໍ້ມູນເງິນເດືອນໃນເດືອນນີ້</td></tr>";
            }
            $stmt->close();
            ?>
        </tbody>
        <?php if ($i > 1) { ?>
        <tfoot class="font-weight-bold" style="background-color: #eaeaea !important;">
            <tr>
                <td colspan="7" class="text-right">ລວມທັງໝົດ:</td>
                <!-- Income Totals -->
                <td><?= number_format($t_base) ?></td>
                <td><?= number_format($t_increase) ?></td>
                <td><?= number_format($t_allowance) ?></td>
                <td><?= number_format($t_other_allowance) ?></td>
                <td><?= number_format($t_income) ?></td>
                
                <!-- Deduction Totals -->
                <td><?= number_format($t_deduct_8) ?></td>
                <td><?= number_format($t_deduct_tax) ?></td>
                <td><?= number_format($t_deduct_other) ?></td>
                <td><?= number_format($t_deduct_phone) ?></td>
                <td><?= number_format($t_deducts) ?></td>
                
                <!-- Net Total -->
                <td><?= number_format($t_net) ?></td>
                
                <!-- Policy Totals -->
                <td><?= number_format($t_sick) ?></td>
                <td><?= number_format($t_discharge) ?></td>
                <td><?= number_format($t_p_other) ?></td>
                <td><?= number_format($t_p_bonus) ?></td>
                <td><?= number_format($t_policy) ?></td>
                
                <!-- Grand Total -->
                <td><?= number_format($t_grand) ?></td>
            </tr>
        </tfoot>
        <?php } ?>
    </table>

    <!-- Signatures section at the bottom -->
    <div class="signature-section">
        <table class="signature-table">
            <tr>
                <td></td>
                <td></td>
                <td>
                    <p>ທີ່ ກອງພັນປ້ອງກັນຕົວເມືອງ, ວັນທີ ...... ເດືອນ ...... ປີ ..........</p>
                </td>
            </tr>
            <tr style="font-weight: bold;">
                <td>ຜູ້ສະຫຼຸບ</td>
                <td>ກວດກາໂດຍ ຫົວໜ້າການເງິນ</td>
                <td>ອະນຸມັດໂດຍ ຫົວໜ້າກອງພັນ</td>
            </tr>
            <tr style="height: 80px;">
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 14px;">
                <td>(.......................................................)</td>
                <td>(.......................................................)</td>
                <td>(.......................................................)</td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>

