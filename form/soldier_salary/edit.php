<?php include('../../controllers/head.php'); ?>
<?php
include('../../condb.php');

if (!isset($_GET['salary_id'])) {
    echo "<script>window.location='show_table.php';</script>";
    exit();
}

$salary_id = intval($_GET['salary_id']);

// Fetch details
$sql = "SELECT s.*, o.full_name, o.full_lastname, o.gender, o.birth_date, o.national_id,
               o.date_join_police, o.date_join_army, o.date_join_revolution,
               l.l_name, p.pt_name
        FROM salaries AS s
        INNER JOIN officers AS o ON s.officer_id = o.officer_id
        LEFT JOIN positions_level AS l ON o.l_id = l.l_id
        LEFT JOIN positions AS p ON o.pt_id = p.pt_id
        WHERE s.salary_id = ? AND s.salary_type = 'soldier'";
        
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $salary_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>window.location='show_table.php';</script>";
    exit();
}

$row = $result->fetch_assoc();
$officer_id = $row['officer_id'];
$birth_date = $row['birth_date'];
$age = 0;
if (!empty($birth_date) && $birth_date !== '0000-00-00') {
    $age = date('Y') - date('Y', strtotime($birth_date));
}

$join_date = '0000-00-00';
if (!empty($row['date_join_police']) && $row['date_join_police'] !== '0000-00-00') {
    $join_date = $row['date_join_police'];
} elseif (!empty($row['date_join_army']) && $row['date_join_army'] !== '0000-00-00') {
    $join_date = $row['date_join_army'];
} elseif (!empty($row['date_join_revolution']) && $row['date_join_revolution'] !== '0000-00-00') {
    $join_date = $row['date_join_revolution'];
}

$years_of_service = 0;
if ($join_date !== '0000-00-00') {
    $years_of_service = date('Y') - date('Y', strtotime($join_date));
}

$stmt->close();

// Update handler
if (isset($_POST['submit'])) {
    $salary_month = trim($_POST['salary_month']);
    $account_number = trim($_POST['account_number']);
    $base_salary = floatval($_POST['base_salary']);
    $salary_increase_15 = floatval($_POST['salary_increase_15']);
    $allowance = floatval($_POST['allowance']);
    $other_allowance = floatval($_POST['other_allowance']);
    
    $deduct_tax = floatval($_POST['deduct_tax']);
    $deduct_other = floatval($_POST['deduct_other']);
    $deduct_phone = floatval($_POST['deduct_phone']);
    
    $policy_sick = floatval($_POST['policy_sick']);
    $policy_discharge = floatval($_POST['policy_discharge']);
    $policy_other = floatval($_POST['policy_other']);
    $policy_bonus = floatval($_POST['policy_bonus']);
    
    $user_id = $_SESSION['user_id'];

    $update = $conn->prepare("UPDATE `salaries` SET
        `salary_month` = ?, `account_number` = ?, 
        `base_salary` = ?, `salary_increase_15` = ?, `allowance` = ?, `other_allowance` = ?, 
        `deduct_tax` = ?, `deduct_other` = ?, `deduct_phone` = ?, 
        `policy_sick` = ?, `policy_discharge` = ?, `policy_other` = ?, `policy_bonus` = ?, 
        `user_id` = ?
        WHERE `salary_id` = ?");
        
    $update->bind_param(
        "ssdddddddddddii",
        $salary_month, $account_number,
        $base_salary, $salary_increase_15, $allowance, $other_allowance,
        $deduct_tax, $deduct_other, $deduct_phone,
        $policy_sick, $policy_discharge, $policy_other, $policy_bonus,
        $user_id, $salary_id
    );
    
    if ($update->execute()) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
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
            title: 'ຜິດພາດ: " . addslashes($conn->error) . "'
        });
        </script>";
    }
    $update->close();
}
?>

<style>
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06) !important;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .card-header {
        background: linear-gradient(135deg, #0d9488, #0f766e) !important;
        color: #fff !important;
        border-bottom: none !important;
        padding: 20px 24px !important;
    }
    .form-control {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
        padding: 10px 14px !important;
        height: auto !important;
        transition: all 0.2s ease-in-out !important;
    }
    .form-control:focus {
        border-color: #0d9488 !important;
        box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15) !important;
    }
    .summary-box {
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }
    .summary-box::before {
        content: "";
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.08);
        transform: rotate(45deg);
        border-radius: 50%;
    }
    .summary-box-success {
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        border-left: 5px solid #22c55e;
        color: #166534;
    }
    .summary-box-danger {
        background: linear-gradient(135deg, #fef2f2, #fee2e2);
        border-left: 5px solid #ef4444;
        color: #991b1b;
    }
    .summary-box-info {
        background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
        border-left: 5px solid #0ea5e9;
        color: #075985;
    }
    .summary-box-teal {
        background: linear-gradient(135deg, #0d9488, #115e59);
        color: #fff;
        box-shadow: 0 8px 25px rgba(13, 148, 136, 0.2);
    }
    .summary-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.08);
    }
    .btn-teal {
        background: linear-gradient(135deg, #0d9488, #0f766e) !important;
        color: #fff !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 12px 30px !important;
        font-weight: 600 !important;
        transition: all 0.2s !important;
    }
    .btn-teal:hover {
        background: linear-gradient(135deg, #0f766e, #115e59) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 20px rgba(13, 148, 136, 0.3) !important;
    }
    .border-custom-teal {
        border-bottom: 2px solid #0d9488 !important;
        color: #0d9488 !important;
        font-weight: bold !important;
    }
</style>

<?php include('../../controllers/menu_left.php'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold"><i class="fas fa-edit mr-2"></i> ແກ້ໄຂຂໍ້ມູນ ເງິນເດືອນພົນທະຫານ</h3>
                </div>
                <form method="POST">
                    <div class="card-body">
                        <!-- Section 1: Officer Info (Readonly) -->
                        <h5 class="border-custom-teal pb-2 mb-3"><i class="fas fa-user-shield mr-2"></i> I. ຂໍ້ມູນພົນທະຫານ</h5>
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>ເລກບັດປະຈຳຕົວພົນທະຫານ</label>
                                    <input type="text" class="form-control bg-light font-weight-bold" value="<?= htmlspecialchars($row['national_id']) ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>ຊື່</label>
                                    <input type="text" class="form-control bg-light font-weight-bold" value="<?= htmlspecialchars($row['full_name']) ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>ນາມສະກຸນ</label>
                                    <input type="text" class="form-control bg-light font-weight-bold" value="<?= htmlspecialchars($row['full_lastname']) ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>ເພດ</label>
                                    <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($row['gender']) ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>ຊັ້ນ</label>
                                    <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($row['l_name'] ?? '') ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>ໜ້າທີ່/ຕຳແໜ່ງ</label>
                                    <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($row['pt_name'] ?? '') ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>ອາຍຸ (ປີ)</label>
                                    <input type="text" class="form-control bg-light" value="<?= $age ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>ປີການ (ປີ)</label>
                                    <input type="text" class="form-control bg-light" value="<?= $years_of_service ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Salary Month & Account Number -->
                        <h5 class="border-custom-teal pb-2 mb-3 mt-4"><i class="fas fa-credit-card mr-2"></i> II. ຂໍ້ມູນບັນຊີ ແລະ ປະຈຳເດືອນ</h5>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="salary_month">...ປະຈຳເດືອນ/ປີ <span class="text-danger">*</span></label>
                                    <input type="month" class="form-control font-weight-bold" name="salary_month" id="salary_month" value="<?= htmlspecialchars($row['salary_month']) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="account_number">ເລກບັນຊີທະນາຄານ</label>
                                    <input type="text" class="form-control font-weight-bold" name="account_number" id="account_number" value="<?= htmlspecialchars($row['account_number'] ?? '') ?>" placeholder="ກະລຸນາປ້ອນເລກບັນຊີ">
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Salary Components -->
                        <div class="row mt-4">
                            <!-- Income Column -->
                            <div class="col-md-4">
                                <div class="card card-outline card-success shadow-sm">
                                    <div class="card-header"><h3 class="card-title font-weight-bold"><i class="fas fa-plus-circle text-success mr-1"></i> ລາຍຮັບ (LAK)</h3></div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="base_salary">ເງິນເດືອນພື້ນຖານ</label>
                                            <input type="number" class="form-control calc-trigger font-weight-bold text-success" name="base_salary" id="base_salary" value="<?= intval($row['base_salary']) ?>" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="salary_increase_15">ປັບປຸງເພີ່ມ 15% (30% ຂອງພື້ນຖານ)</label>
                                            <input type="number" class="form-control calc-trigger font-weight-bold text-success" name="salary_increase_15" id="salary_increase_15" value="<?= intval($row['salary_increase_15']) ?>" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="allowance">ເງິນອຸດໜູນ</label>
                                            <input type="number" class="form-control calc-trigger" name="allowance" id="allowance" value="<?= intval($row['allowance']) ?>" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="other_allowance">ເງິນກິນ/ເງິນອ້າຍນ້ອງ</label>
                                            <input type="number" class="form-control calc-trigger" name="other_allowance" id="other_allowance" value="<?= intval($row['other_allowance']) ?>" min="0">
                                        </div>
                                        
                                        <div class="summary-box summary-box-success mt-4">
                                            <span class="text-sm font-weight-bold text-success uppercase">ລວມລາຍຮັບທັງໝົດ</span>
                                            <h3 id="total_income_display" class="font-weight-bold text-success mt-1 mb-0">0</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Deduction Column -->
                            <div class="col-md-4">
                                <div class="card card-outline card-danger shadow-sm">
                                    <div class="card-header"><h3 class="card-title font-weight-bold"><i class="fas fa-minus-circle text-danger mr-1"></i> ລາຍຫັກ (LAK)</h3></div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="deduct_8">ຫັກປະກັນໄພສັງຄົມ (8%)</label>
                                            <input type="number" class="form-control calc-trigger font-weight-bold text-danger" name="deduct_8" id="deduct_8" value="0" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="deduct_tax">ຫັກອາກອນ (5%, 10%)</label>
                                            <input type="number" class="form-control calc-trigger font-weight-bold text-danger" name="deduct_tax" id="deduct_tax" value="<?= intval($row['deduct_tax']) ?>" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="deduct_other">ຫັກອື່ນໆ / ຫັກຄ່າ...</label>
                                            <input type="number" class="form-control calc-trigger" name="deduct_other" id="deduct_other" value="<?= intval($row['deduct_other']) ?>" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="deduct_phone">ຫັກຄ່າໂທລະສັບ</label>
                                            <input type="number" class="form-control calc-trigger" name="deduct_phone" id="deduct_phone" value="<?= intval($row['deduct_phone']) ?>" min="0">
                                        </div>

                                        <div class="summary-box summary-box-danger mt-4">
                                            <span class="text-sm font-weight-bold text-danger uppercase">ລວມຍອດຫັກ</span>
                                            <h3 id="total_deductions_display" class="font-weight-bold text-danger mt-1 mb-0">0</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Policy & Summary Column -->
                            <div class="col-md-4">
                                <div class="card card-outline card-info shadow-sm">
                                    <div class="card-header"><h3 class="card-title font-weight-bold"><i class="fas fa-gift text-info mr-1"></i> ນະໂຍບາຍ & ຍອດຮັບ (LAK)</h3></div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="policy_sick">ນະໂຍບາຍ ປ່ວຍ</label>
                                            <input type="number" class="form-control calc-trigger font-weight-bold text-info" name="policy_sick" id="policy_sick" value="<?= intval($row['policy_sick']) ?>" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="policy_discharge">ນະໂຍບາຍ ປົດ</label>
                                            <input type="number" class="form-control calc-trigger font-weight-bold text-info" name="policy_discharge" id="policy_discharge" value="<?= intval($row['policy_discharge']) ?>" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="policy_other">ນະໂຍບາຍ ໂຄສະນາ</label>
                                            <input type="number" class="form-control calc-trigger" name="policy_other" id="policy_other" value="<?= intval($row['policy_other']) ?>" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="policy_bonus">ນະໂຍບາຍ ບຳເນັດ</label>
                                            <input type="number" class="form-control calc-trigger" name="policy_bonus" id="policy_bonus" value="<?= intval($row['policy_bonus']) ?>" min="0">
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="summary-box summary-box-info p-3 mb-2" style="font-size:12px;">
                                                    <span class="font-weight-bold">ນະໂຍບາຍ</span>
                                                    <h5 id="total_policy_display" class="font-weight-bold text-info mb-0">0</h5>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="summary-box p-3 mb-2" style="font-size:12px; background:#f8fafc; border-left:5px solid #64748b; color:#334155;">
                                                    <span class="font-weight-bold">ຍອດຮັບຕົວຈິງ</span>
                                                    <h5 id="net_salary_display" class="font-weight-bold mb-0">0</h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="summary-box summary-box-teal mt-3">
                                            <span class="text-sm font-weight-bold text-white-50 uppercase">ລວມຮັບທັງໝົດ (ຍອດຮັບ + ນະໂຍບາຍ)</span>
                                            <h3 id="grand_total_display" class="font-weight-bold text-white mt-1 mb-0">0</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center bg-white border-top py-4">
                        <button type="submit" name="submit" class="btn btn-teal"><i class="fas fa-save mr-2"></i> ບັນທຶກການແກ້ໄຂ</button>
                        <a href="show_table.php" class="btn btn-secondary btn-lg px-4 ml-2"><i class="fas fa-arrow-left mr-1"></i> ຍ້ອນກັບ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('../../controllers/footer.php'); ?>

<script>
$(document).ready(function() {
    // Run initial calculation
    calculateSalary();

    // Auto calculate 15% increase as 30% of base_salary when base_salary changes
    $('#base_salary').on('input', function() {
        var base = parseFloat($(this).val()) || 0;
        var inc = Math.round(base * 0.30);
        $('#salary_increase_15').val(inc);
        calculateSalary();
    });

    // Handle interactive calculations on any numeric inputs
    $('.calc-trigger').on('input change', function() {
        calculateSalary();
    });

    function calculateSalary() {
        var base = parseFloat($('#base_salary').val()) || 0;
        var increase = parseFloat($('#salary_increase_15').val()) || 0;
        var allowance = parseFloat($('#allowance').val()) || 0;
        var other_allowance = parseFloat($('#other_allowance').val()) || 0;

        var total_income = base + increase + allowance + other_allowance;
        $('#total_income_display').text(formatNumber(total_income));

        if ($('#base_salary').is(':focus') || $('#salary_increase_15').is(':focus') || $('#allowance').is(':focus') || $('#other_allowance').is(':focus')) {
            var deduct_8_val = Math.round(total_income * 0.08);
            $('#deduct_8').val(deduct_8_val);
        } else {
            if ($('#deduct_8').val() == '0') {
                var db_deduct_8 = Math.round(total_income * 0.08);
                $('#deduct_8').val(db_deduct_8);
            }
        }

        var deduct_8 = parseFloat($('#deduct_8').val()) || 0;
        var deduct_tax = parseFloat($('#deduct_tax').val()) || 0;
        var deduct_other = parseFloat($('#deduct_other').val()) || 0;
        var deduct_phone = parseFloat($('#deduct_phone').val()) || 0;

        var total_deductions = deduct_8 + deduct_tax + deduct_other + deduct_phone;
        $('#total_deductions_display').text(formatNumber(total_deductions));

        var net_salary = total_income - total_deductions;
        $('#net_salary_display').text(formatNumber(net_salary));

        var policy_sick = parseFloat($('#policy_sick').val()) || 0;
        var policy_discharge = parseFloat($('#policy_discharge').val()) || 0;
        var policy_other = parseFloat($('#policy_other').val()) || 0;
        var policy_bonus = parseFloat($('#policy_bonus').val()) || 0;

        var total_policy = policy_sick + policy_discharge + policy_other + policy_bonus;
        $('#total_policy_display').text(formatNumber(total_policy));

        var grand_total = net_salary + total_policy;
        $('#grand_total_display').text(formatNumber(grand_total));
    }

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
});
</script>
