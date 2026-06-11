<?php include('../../controllers/head.php'); ?>
<?php
include('../../condb.php');

// Handle Delete Action
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    
    $stmt = $conn->prepare("DELETE FROM salaries WHERE salary_id = ? AND salary_type = 'soldier'");
    $stmt->bind_param("i", $delete_id);
    
    if ($stmt->execute()) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'ລົບຂໍ້ມູນສຳເລັດ',
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            window.location = 'show_table.php';
        });
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'ຜິດພາດ',
            text: 'ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້'
        });
        </script>";
    }
    $stmt->close();
}

$selected_month = $_GET['month'] ?? date('Y-m');
?>

<style>
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
        overflow: hidden;
        margin-bottom: 24px;
    }
    .card-header {
        background: linear-gradient(135deg, #0d9488, #0f766e) !important;
        padding: 18px 24px !important;
        border-bottom: none !important;
    }
    .table {
        border-collapse: separate !important;
        border-spacing: 0 !important;
        border-radius: 8px !important;
        overflow: hidden !important;
        border: 1px solid #cbd5e1 !important;
    }
    .table thead th {
        font-weight: bold !important;
        color: #fff !important;
        border: 1px solid #0f766e !important;
        padding: 12px 6px !important;
        text-transform: uppercase;
        font-size: 12px;
        vertical-align: middle !important;
    }
    .table tbody td {
        padding: 8px 6px !important;
        border: 1px solid #e2e8f0 !important;
        vertical-align: middle !important;
        transition: background-color 0.15s ease;
    }
    .table tbody tr:hover td {
        background-color: #f0fdfa !important; /* soft teal hover */
    }
    .btn-teal {
        background: linear-gradient(135deg, #0d9488, #0f766e) !important;
        color: #fff !important;
        border: none !important;
        font-weight: bold !important;
        transition: all 0.2s !important;
    }
    .btn-teal:hover {
        background: linear-gradient(135deg, #0f766e, #115e59) !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(13, 148, 136, 0.2);
    }
    .tfoot-total {
        background: linear-gradient(135deg, #1e293b, #0f172a) !important;
        color: #fff !important;
        font-weight: bold !important;
    }
    .tfoot-total td {
        border-color: #334155 !important;
        padding: 12px 6px !important;
    }
    .form-control-custom {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
        padding: 8px 12px !important;
        height: auto !important;
        font-weight: bold;
    }
    .form-control-custom:focus {
        border-color: #0d9488 !important;
        box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15) !important;
    }
</style>

<?php include('../../controllers/menu_left.php'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <!-- Filter Card -->
            <div class="card mb-3">
                <div class="card-body py-3">
                    <form method="GET" class="form-inline justify-content-between">
                        <div class="form-group mb-2 mb-sm-0">
                            <label for="month" class="mr-2"><b>ເລືອກເດືອນ/ປີ ທີ່ຕ້ອງການລາຍງານ: </b></label>
                            <input type="month" class="form-control form-control-custom" name="month" id="month" value="<?= htmlspecialchars($selected_month) ?>">
                            <button type="submit" class="btn btn-teal ml-2 px-3"><i class="fas fa-filter mr-1"></i> ຄົ້ນຫາ</button>
                        </div>
                        <div>
                            <a href="index.php" class="btn btn-success font-weight-bold px-3"><i class="fas fa-plus mr-1"></i> ບັນທຶກເງິນເດືອນ</a>
                            <a href="print.php?month=<?= $selected_month ?>" target="_blank" class="btn btn-primary font-weight-bold ml-2 px-3"><i class="fas fa-print mr-1"></i> ພິມລາຍງານປະຈຳເດືອນ</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Report Table Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold"><i class="fas fa-table mr-2"></i> ຕາຕະລາງລາຍງານເງິນເດືອນພົນທະຫານ ປະຈຳເດືອນ: <?= date('m/Y', strtotime($selected_month)) ?></h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-striped text-center mb-0 table-sticky" style="font-size: 13px; min-width: 1900px;">
                            <thead>
                                <tr style="background: linear-gradient(135deg, #0f766e, #0d9488) !important;">
                                    <th rowspan="2" class="align-middle sticky-col sticky-col-1">ລ/ດ</th>
                                    <th rowspan="2" class="align-middle sticky-col sticky-col-2">ຊັ້ນ</th>
                                    <th rowspan="2" class="align-middle sticky-col sticky-col-3" style="min-width: 160px;">ຊື່ ແລະ ນາມສະກຸນ</th>
                                    <th rowspan="2" class="align-middle">ໜ້າທີ່</th>
                                    <th rowspan="2" class="align-middle" style="min-width: 100px;">ເລກບັນຊີ</th>
                                    <th rowspan="2" class="align-middle" style="min-width: 80px;">ວດປ ເກີດ</th>
                                    <th rowspan="2" class="align-middle">ປີ</th>
                                    <th colspan="5" style="background-color: #059669 !important; border-color: #047857 !important;">ລາຍຮັບ (LAK)</th>
                                    <th colspan="5" style="background-color: #e11d48 !important; border-color: #be123c !important;">...ລາຍຫັກ (LAK)</th>
                                    <th rowspan="2" class="align-middle" style="background-color: #f59e0b !important; border-color: #d97706 !important; color: #fff !important;">ຍອດຮັບຕົວຈິງ</th>
                                    <th colspan="5" style="background-color: #0284c7 !important; border-color: #0369a1 !important;">ເງິນນະໂຍບາຍອຸດໜູນ (LAK)</th>
                                    <th rowspan="2" class="align-middle" style="background-color: #2563eb !important; border-color: #1e40af !important;">ລວມຮັບທັງໝົດ</th>
                                    <th rowspan="2" class="align-middle no-print" style="min-width: 100px;">ຄຳສັ່ງ</th>
                                </tr>
                                <tr style="background: linear-gradient(135deg, #0f766e, #0d9488) !important;">
                                    <!-- Income -->
                                    <th style="background-color: #059669 !important; border-color: #047857 !important;">ເງິນເດືອນພື້ນຖານ</th>
                                    <th style="background-color: #059669 !important; border-color: #047857 !important;">ປັບປຸງເພີ່ມ 15%</th>
                                    <th style="background-color: #059669 !important; border-color: #047857 !important;">ເງິນອຸດໜູນ</th>
                                    <th style="background-color: #059669 !important; border-color: #047857 !important;">ເງິນກິນ/ອ້າຍນ້ອງ</th>
                                    <th style="background-color: #047857 !important; border-color: #14532d !important; font-weight: bold !important;">ລວມລາຍຮັບ</th>
                                    
                                    <!-- Deductions -->
                                    <th style="background-color: #e11d48 !important; border-color: #be123c !important;">ຫັກ 8%</th>
                                    <th style="background-color: #e11d48 !important; border-color: #be123c !important;">ຫັກອາກອນ</th>
                                    <th style="background-color: #e11d48 !important; border-color: #be123c !important;">ຫັກຄ່າ...</th>
                                    <th style="background-color: #e11d48 !important; border-color: #be123c !important;">ຫັກຄ່າໂທ</th>
                                    <th style="background-color: #be123c !important; border-color: #7f1d1d !important; font-weight: bold !important;">...ລວມຫັກ</th>
 
                                    <!-- Policy -->
                                    <th style="background-color: #0369a1 !important; border-color: #075985 !important;">ປ່ວຍ</th>
                                    <th style="background-color: #0369a1 !important; border-color: #075985 !important;">ປົດ</th>
                                    <th style="background-color: #0369a1 !important; border-color: #075985 !important;">ໂຄສະນາ</th>
                                    <th style="background-color: #0369a1 !important; border-color: #075985 !important;">ບຳເນັດ</th>
                                    <th style="background-color: #075985 !important; border-color: #0c4a6e !important; font-weight: bold !important;">ລວມນະໂຍບາຍ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
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
                                            <td class="sticky-col sticky-col-1"><?= $i++ ?></td>
                                            <td class="font-weight-bold sticky-col sticky-col-2"><?= htmlspecialchars($row['l_name']) ?></td>
                                            <td class="text-left font-weight-bold sticky-col sticky-col-3"><?= htmlspecialchars($row['full_name']) ?> <?= htmlspecialchars($row['full_lastname']) ?></td>
                                            <td><?= htmlspecialchars($row['pt_name']) ?></td>
                                            <td><?= htmlspecialchars($row['account_number'] ?? '-') ?></td>
                                            <td><?= !empty($birth_date) && $birth_date !== '0000-00-00' ? date('d/m/y', strtotime($birth_date)) : '-' ?></td>
                                            <td><?= $age > 0 ? $age : '-' ?></td>
                                            
                                            <!-- Income -->
                                            <td><?= number_format($row['base_salary']) ?></td>
                                            <td><?= number_format($row['salary_increase_15']) ?></td>
                                            <td><?= number_format($row['allowance']) ?></td>
                                            <td><?= number_format($row['other_allowance']) ?></td>
                                            <td class="font-weight-bold text-success" style="background-color: #f0fdf4 !important;"><?= number_format($row_income) ?></td>
                                            
                                            <!-- Deductions -->
                                            <td><?= number_format($row_deduct_8) ?></td>
                                            <td><?= number_format($row['deduct_tax']) ?></td>
                                            <td><?= number_format($row['deduct_other']) ?></td>
                                            <td><?= number_format($row['deduct_phone']) ?></td>
                                            <td class="font-weight-bold text-danger" style="background-color: #fef2f2 !important;"><?= number_format($row_deducts) ?></td>
                                            
                                            <!-- Net -->
                                            <td class="font-weight-bold text-warning" style="background-color: #fffbeb !important;"><?= number_format($row_net) ?></td>
                                            
                                            <!-- Policy -->
                                            <td><?= number_format($row['policy_sick']) ?></td>
                                            <td><?= number_format($row['policy_discharge']) ?></td>
                                            <td><?= number_format($row['policy_other']) ?></td>
                                            <td><?= number_format($row['policy_bonus']) ?></td>
                                            <td class="font-weight-bold text-info" style="background-color: #f0f9ff !important;"><?= number_format($row_policy) ?></td>
                                            
                                            <!-- Grand Total -->
                                            <td class="font-weight-bold text-teal" style="background-color: #f0fdfa !important; font-size: 14px;"><?= number_format($row_grand) ?></td>
                                            
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-teal btn-xs dropdown-toggle" data-toggle="dropdown" data-boundary="window" aria-expanded="false">
                                                        <i class="fas fa-cog mr-1"></i> ຈັດການ
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="edit.php?salary_id=<?= $row['salary_id'] ?>"><i class="fas fa-edit text-primary"></i> ແກ້ໄຂ</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" onclick="confirmDelete(<?= $row['salary_id'] ?>)"><i class="fas fa-trash text-danger"></i> ລົບ</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='24' class='text-center py-5 text-muted'><i class='fas fa-info-circle mr-1'></i> ບໍ່ມີຂໍ້ມູນເງິນເດືອນໃນເດືອນນີ້</td></tr>";
                                }
                                $stmt->close();
                                ?>
                            </tbody>
                            <?php if ($i > 1) { ?>
                            <tfoot class="tfoot-total">
                                <tr>
                                    <td class="sticky-col sticky-col-1"></td>
                                    <td class="sticky-col sticky-col-2"></td>
                                    <td class="sticky-col sticky-col-3 text-right font-weight-bold align-middle">ລວມທັງໝົດ:</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <!-- Income Totals -->
                                    <td><?= number_format($t_base) ?></td>
                                    <td><?= number_format($t_increase) ?></td>
                                    <td><?= number_format($t_allowance) ?></td>
                                    <td><?= number_format($t_other_allowance) ?></td>
                                    <td style="background-color: #047857 !important;"><?= number_format($t_income) ?></td>
                                    
                                    <!-- Deduction Totals -->
                                    <td><?= number_format($t_deduct_8) ?></td>
                                    <td><?= number_format($t_deduct_tax) ?></td>
                                    <td><?= number_format($t_deduct_other) ?></td>
                                    <td><?= number_format($t_deduct_phone) ?></td>
                                    <td style="background-color: #be123c !important;"><?= number_format($t_deducts) ?></td>
                                    
                                    <!-- Net Total -->
                                    <td style="background-color: #f59e0b !important; color: #fff !important;"><?= number_format($t_net) ?></td>
                                    
                                    <!-- Policy Totals -->
                                    <td><?= number_format($t_sick) ?></td>
                                    <td><?= number_format($t_discharge) ?></td>
                                    <td><?= number_format($t_p_other) ?></td>
                                    <td><?= number_format($t_p_bonus) ?></td>
                                    <td style="background-color: #0369a1 !important;"><?= number_format($t_policy) ?></td>
                                    
                                    <!-- Grand Total -->
                                    <td style="background-color: #1e40af !important; font-size: 14px;"><?= number_format($t_grand) ?></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../../controllers/footer.php'); ?>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'ທ່ານຕ້ອງການລົບຂໍ້ມູນນີ້ແທ້ບໍ?',
        text: "ການລົບນີ້ຈະບໍ່ສາມາດກູ້ຄືນຂໍ້ມູນໄດ້!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ຕົກລົງ, ລົບຂໍ້ມູນ!',
        cancelButtonText: 'ຍົກເລີກ'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'show_table.php?delete_id=' + id;
        }
    })
}
</script>
