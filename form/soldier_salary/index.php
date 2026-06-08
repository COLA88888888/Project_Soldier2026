<?php include('../../controllers/head.php'); ?> 
<?php 
include('../../condb.php');

if (isset($_POST['submit'])) {
    $officer_id = trim($_POST['officer_id']);
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
    $salary_type = 'soldier';

    if (empty($officer_id)) {
        echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'ກະລຸນາເລືອກພົນທະຫານ',
            confirmButtonText: 'ຕົກລົງ'
        });
        </script>";
    } else {
        // Check if salary already exists
        $check = $conn->prepare("SELECT salary_id FROM salaries WHERE officer_id = ? AND salary_month = ? AND salary_type = ?");
        $check->bind_param("iss", $officer_id, $salary_month, $salary_type);
        $check->execute();
        $check->store_result();
        
        if ($check->num_rows > 0) {
            echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'ຂໍ້ມູນເງິນເດືອນເດືອນນີ້ມີໃນລະບົບແລ້ວ',
                confirmButtonText: 'ຕົກລົງ'
            });
            </script>";
        } else {
            $sql = $conn->prepare("INSERT INTO `salaries` (
                `officer_id`, `salary_type`, `salary_month`, `account_number`, 
                `base_salary`, `salary_increase_15`, `allowance`, `other_allowance`, 
                `deduct_tax`, `deduct_other`, `deduct_phone`, 
                `policy_sick`, `policy_discharge`, `policy_other`, `policy_bonus`, 
                `user_id`
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $sql->bind_param(
                "isssdddddddddddi", 
                $officer_id, $salary_type, $salary_month, $account_number,
                $base_salary, $salary_increase_15, $allowance, $other_allowance,
                $deduct_tax, $deduct_other, $deduct_phone,
                $policy_sick, $policy_discharge, $policy_other, $policy_bonus,
                $user_id
            );
            
            if ($sql->execute()) {
                echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'ບັນທຶກຂໍ້ມູນສຳເລັດ',
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
            $sql->close();
        }
        $check->close();
    }
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
    .select2-container--default .select2-selection--single {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        height: 44px !important;
        padding: 8px 12px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 42px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 26px !important;
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
                    <h3 class="card-title font-weight-bold"><i class="fas fa-coins mr-2"></i> ຟອມບັນທຶກ ເງິນເດືອນພົນທະຫານ</h3>
                </div>
                <form method="POST">
                    <div class="card-body">
                        <!-- Section 1: Officer Search and General Info -->
                        <h5 class="border-custom-teal pb-2 mb-3"><i class="fas fa-user-shield mr-2"></i> I. ຂໍ້ມູນພົນທະຫານ</h5>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="officer_select">ຄົ້ນຫາ/ເລືອກພົນທະຫານ <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="officer_select" name="officer_id" required>
                                        <option value="">-- ເລືອກພົນທະຫານ --</option>
                                        <?php
                                        $officers_query = $conn->query("SELECT o.officer_id, o.full_name, o.full_lastname, o.national_id, l.l_name 
                                                                        FROM officers o 
                                                                        LEFT JOIN positions_level l ON o.l_id = l.l_id 
                                                                        WHERE o.system_status = 'ON' 
                                                                        ORDER BY o.full_name ASC");
                                        while ($o_row = $officers_query->fetch_assoc()) {
                                            $lbl = ($o_row['l_name'] ? $o_row['l_name'] . ' - ' : '') . $o_row['full_name'] . ' ' . $o_row['full_lastname'] . ' (' . $o_row['national_id'] . ')';
                                            echo '<option value="' . $o_row['officer_id'] . '">' . htmlspecialchars($lbl) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6">
                                <div class="form-group">
                                    <label for="national_id">ເລກບັດປະຈຳຕົວ</label>
                                    <input type="text" class="form-control font-weight-bold" id="national_id" placeholder="ປ້ອນເພື່ອຄົ້ນຫາ" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="full_name">ຊື່</label>
                                    <input type="text" class="form-control bg-light font-weight-bold" id="full_name" readonly placeholder="ຊື່ພົນທະຫານ">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="full_lastname">ນາມສະກຸນ</label>
                                    <input type="text" class="form-control bg-light font-weight-bold" id="full_lastname" readonly placeholder="ນາມສະກຸນ">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6">
                                <div class="form-group">
                                    <label for="gender">ເພດ</label>
                                    <input type="text" class="form-control bg-light" id="gender" readonly placeholder="-">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="l_name">ຊັ້ນ</label>
                                    <input type="text" class="form-control bg-light" id="l_name" readonly placeholder="-">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="pt_name">ໜ້າທີ່/ຕຳແໜ່ງ</label>
                                    <input type="text" class="form-control bg-light" id="pt_name" readonly placeholder="-">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6">
                                <div class="form-group">
                                    <label for="age">ອາຍຸ (ປີ)</label>
                                    <input type="text" class="form-control bg-light" id="age" readonly placeholder="-">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6">
                                <div class="form-group">
                                    <label for="years_of_service">ປີການ (ປີ)</label>
                                    <input type="text" class="form-control bg-light" id="years_of_service" readonly placeholder="-">
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Salary Month & Account Number -->
                        <h5 class="border-custom-teal pb-2 mb-3 mt-4"><i class="fas fa-credit-card mr-2"></i> II. ຂໍ້ມູນບັນຊີ ແລະ ປະຈຳເດືອນ</h5>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="salary_month">ປະຈຳເດືອນ/ປີ <span class="text-danger">*</span></label>
                                    <input type="month" class="form-control font-weight-bold" name="salary_month" id="salary_month" value="<?= date('Y-m') ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="account_number">ເລກບັນຊີທະນາຄານ</label>
                                    <input type="text" class="form-control font-weight-bold" name="account_number" id="account_number" placeholder="ກະລຸນາປ້ອນເລກບັນຊີ">
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Salary Components -->
                        <div class="row mt-4">
                            <!-- Income Column -->
                            <div class="col-md-4">
                                <div class="card card-outline card-success shadow-sm">
                                    <div class="card-header bg-success-gradient"><h3 class="card-title font-weight-bold"><i class="fas fa-plus-circle text-success mr-1"></i> ລາຍຮັບ (LAK)</h3></div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="base_salary">ເງິນເດືອນພື້ນຖານ</label>
                                            <input type="number" class="form-control calc-trigger font-weight-bold text-success" name="base_salary" id="base_salary" value="0" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="salary_increase_15">ປັບປຸງເພີ່ມ 15% (30% ຂອງພື້ນຖານ)</label>
                                            <input type="number" class="form-control calc-trigger font-weight-bold text-success" name="salary_increase_15" id="salary_increase_15" value="0" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="allowance">ເງິນອຸດໜູນ</label>
                                            <input type="number" class="form-control calc-trigger" name="allowance" id="allowance" value="0" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="other_allowance">ເງິນກິນ/ເງິນອ້າຍນ້ອງ</label>
                                            <input type="number" class="form-control calc-trigger" name="other_allowance" id="other_allowance" value="0" min="0">
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
                                            <input type="number" class="form-control calc-trigger font-weight-bold text-danger" name="deduct_tax" id="deduct_tax" value="0" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="deduct_other">ຫັກອື່ນໆ / ຫັກຄ່າ...</label>
                                            <input type="number" class="form-control calc-trigger" name="deduct_other" id="deduct_other" value="0" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="deduct_phone">ຫັກຄ່າໂທລະສັບ</label>
                                            <input type="number" class="form-control calc-trigger" name="deduct_phone" id="deduct_phone" value="0" min="0">
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
                                            <input type="number" class="form-control calc-trigger font-weight-bold text-info" name="policy_sick" id="policy_sick" value="0" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="policy_discharge">ນະໂຍບາຍ ປົດ</label>
                                            <input type="number" class="form-control calc-trigger" name="policy_discharge" id="policy_discharge" value="0" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="policy_other">ນະໂຍບາຍ ໂຄສະນາ</label>
                                            <input type="number" class="form-control calc-trigger" name="policy_other" id="policy_other" value="0" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="policy_bonus">ນະໂຍບາຍ ບຳເນັດ</label>
                                            <input type="number" class="form-control calc-trigger" name="policy_bonus" id="policy_bonus" value="0" min="0">
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
                        <button type="submit" name="submit" class="btn btn-teal"><i class="fas fa-save mr-2"></i> ບັນທຶກຂໍ້ມູນ</button>
                        <button type="reset" class="btn btn-secondary btn-lg px-4 ml-2" onclick="clearFields();"><i class="fas fa-sync mr-1"></i> ຍົກເລີກ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('../../controllers/footer.php'); ?>

<script>
$(document).ready(function() {
    // Initialize Select2
    $('#officer_select').select2({
        width: '100%',
        placeholder: "-- ເລືອກພົນທະຫານ --",
        allowClear: true
    });

    // Select dropdown changes
    $('#officer_select').on('change', function() {
        var officer_id = $(this).val();
        if (officer_id) {
            $.post('get_officer_details.php', { officer_id: officer_id }, function(data) {
                if (data.status === 'success') {
                    $('#national_id').val(data.national_id);
                    $('#full_name').val(data.full_name);
                    $('#full_lastname').val(data.full_lastname);
                    $('#gender').val(data.gender);
                    $('#l_name').val(data.l_name);
                    $('#pt_name').val(data.pt_name);
                    $('#age').val(data.age);
                    $('#years_of_service').val(data.years_of_service);
                    $('#national_id').removeClass('is-invalid').addClass('is-valid');
                }
            }, 'json');
        } else {
            clearFields();
        }
    });

    // Lookup by typing national_id
    $('#national_id').on('input', function() {
        var national_id = $(this).val().trim();
        if (national_id.length > 0) {
            $.post('get_officer_details.php', { national_id: national_id }, function(data) {
                if (data.status === 'success') {
                    $('#officer_select').val(data.officer_id).trigger('change.select2');
                    $('#full_name').val(data.full_name);
                    $('#full_lastname').val(data.full_lastname);
                    $('#gender').val(data.gender);
                    $('#l_name').val(data.l_name);
                    $('#pt_name').val(data.pt_name);
                    $('#age').val(data.age);
                    $('#years_of_service').val(data.years_of_service);
                    $('#national_id').removeClass('is-invalid').addClass('is-valid');
                } else {
                    $('#officer_select').val('').trigger('change.select2');
                    clearFields();
                    $('#national_id').removeClass('is-valid').addClass('is-invalid');
                }
            }, 'json');
        } else {
            $('#officer_select').val('').trigger('change.select2');
            clearFields();
        }
    });

    function clearFields() {
        $('#national_id').val('').removeClass('is-valid is-invalid');
        $('#full_name').val('');
        $('#full_lastname').val('');
        $('#gender').val('');
        $('#l_name').val('');
        $('#pt_name').val('');
        $('#age').val('');
        $('#years_of_service').val('');
    }

    // Auto calculate 15% increase as 30% of base_salary when base_salary changes
    $('#base_salary').on('input', function() {
        var base = parseFloat($(this).val()) || 0;
        var inc = Math.round(base * 0.30);
        $('#salary_increase_15').val(inc);
        calculateSalary();
    });

    // Handle calculations
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
