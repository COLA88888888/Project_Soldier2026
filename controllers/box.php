<style>
.dashboard-header {
    margin-top: 15px;
    margin-bottom: 25px;
    border-left: 4px solid #0d9488;
    padding-left: 12px;
}
.dashboard-header h4 {
    font-weight: 700;
    color: #1e293b;
    margin: 0;
    font-size: 18px;
}
.dashboard-header p {
    color: #64748b;
    font-size: 13px;
    margin: 4px 0 0 0;
}
.stat-card-custom {
    position: relative;
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 24px;
    color: #fff;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(255, 255, 255, 0.1);
    overflow: hidden;
}
.stat-card-custom:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 30px rgba(0, 0, 0, 0.12);
}
.stat-card-custom::before {
    content: '';
    position: absolute;
    top: -40px;
    right: -40px;
    width: 120px;
    height: 120px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 50%;
    z-index: 1;
    transition: all 0.4s ease;
}
.stat-card-custom:hover::before {
    transform: scale(1.3);
}
.stat-card-custom .card-body-custom {
    position: relative;
    z-index: 2;
}
.stat-card-custom h6 {
    font-size: 14px;
    font-weight: 600;
    margin: 0 0 6px 0;
    opacity: 0.9;
    letter-spacing: 0.3px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.stat-card-custom h3 {
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 6px 0;
}
.stat-card-custom p {
    font-size: 12px;
    margin: 0;
    opacity: 0.85;
}
.stat-card-custom .card-icon {
    position: absolute;
    right: 20px;
    top: 20px;
    font-size: 44px;
    opacity: 0.15;
    transition: transform 0.3s ease;
    z-index: 1;
}
.stat-card-custom:hover .card-icon {
    transform: scale(1.1) rotate(-8deg);
    opacity: 0.25;
}
.stat-card-custom .card-footer-custom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 14px;
    padding-top: 12px;
    border-top: 1px solid rgba(255, 255, 255, 0.15);
    font-size: 12px;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.95);
    text-decoration: none;
    transition: color 0.2s;
    position: relative;
    z-index: 2;
}
.stat-card-custom .card-footer-custom:hover {
    color: #fff;
    text-decoration: none;
}
.stat-card-custom .card-footer-custom i {
    transition: transform 0.2s;
}
.stat-card-custom .card-footer-custom:hover i {
    transform: translateX(3px);
}

/* Gradients */
.grad-teal {
    background: linear-gradient(135deg, #0d9488, #0f766e);
}
.grad-indigo {
    background: linear-gradient(135deg, #4f46e5, #3730a3);
}
.grad-pink {
    background: linear-gradient(135deg, #db2777, #9d174d);
}
.grad-violet {
    background: linear-gradient(135deg, #7c3aed, #5b21b6);
}
.grad-orange {
    background: linear-gradient(135deg, #ea580c, #9a3412);
}
.grad-emerald {
    background: linear-gradient(135deg, #059669, #065f46);
}
.grad-cyan {
    background: linear-gradient(135deg, #0891b2, #075985);
}
.grad-blue {
    background: linear-gradient(135deg, #2563eb, #1e40af);
}
.grad-rose {
    background: linear-gradient(135deg, #f43f5e, #be123c);
}
</style>

<div class="dashboard-header">
    <h4>ລາຍງານຈຳນວນພະນັກງານ ຕາມແຕ່ລະພະແນກ (Officers per Section)</h4>
    <p>ສະແດງຈຳນວນລວມ, ຍິງ, ແລະ ຊາຍ ຂອງພະນັກງານແຕ່ລະພະແນກ</p>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <?php 
            include('../../condb.php');
            $stmt = $conn->prepare("SELECT * FROM panak");
            $stmt->execute();
            $result = $stmt->get_result();
            $idx = 0;
            // List of gradients to cycle through for visual variety
            $gradients = ['grad-teal', 'grad-cyan', 'grad-emerald', 'grad-blue'];
            
            while ($rowbox = $result->fetch_assoc()) {
                $pk_id = $rowbox['pk_id'];
                $grad = $gradients[$idx % count($gradients)];
                $idx++;
                
                // Get counts
                $sql1 = "SELECT COUNT(*) as totaltwo FROM officers WHERE pk_id = '$pk_id'";
                $result1 = mysqli_query($conn, $sql1);
                $row1 = mysqli_fetch_assoc($result1);
                $totaltwo = $row1['totaltwo'];
                
                $sql2 = "SELECT COUNT(*) as mans FROM officers WHERE gender='ຊາຍ' AND pk_id = '$pk_id'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $totalman3 = $row2['mans'];
                
                $sql3 = "SELECT COUNT(*) as women FROM officers WHERE gender='ຍິງ' AND pk_id = '$pk_id'";
                $result3 = mysqli_query($conn, $sql3);
                $row3 = mysqli_fetch_assoc($result3);
                $totalwomen = $row3['women'];
            ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="stat-card-custom <?= $grad ?>">
                    <div class="card-body-custom">
                        <h6><?= htmlspecialchars($rowbox['pk_name']); ?></h6>
                        <h3><?= $totaltwo; ?> <span style="font-size: 13px; font-weight: normal; opacity: 0.95;">ສະຫາຍ</span></h3>
                        <p>[ ຍິງ: <?= $totalwomen; ?> || ຊາຍ: <?= $totalman3; ?> ]</p>
                    </div>
                    <div class="card-icon">
                        <i class="ion-android-contacts"></i>
                    </div>
                    <a href="../../form/positions_level/position_level.php?pk_id=<?= $pk_id ?>" class="card-footer-custom">
                        <span>ເບິ່ງລາຍລະອຽດຊັ້ນ</span>
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <?php 
            } 
            $stmt->close(); 
            ?>
        </div>
    </div>
</section>

<div class="dashboard-header mt-2">
    <h4>ສະຖິຕິ ແລະ ຂໍ້ມູນພະນັກງານໂດຍລວມ (Global System Statistics)</h4>
    <p>ສະຫຼຸບຕົວເລກພະນັກງານທັງໝົດ, ສະມາຊິກພັກ, ການເຄື່ອນໄຫວ ແລະ ຜູ້ໃຊ້ງານ</p>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- All Officers Card -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <?php  
                $sql = "SELECT COUNT(*) as totalalls FROM officers";
                $result = mysqli_query($conn, $sql);
                $rowalls = mysqli_fetch_assoc($result);
                $totalalls = $rowalls['totalalls'];
                
                $sql = "SELECT COUNT(*) as mans FROM officers WHERE gender='ຊາຍ'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $totalman = $row['mans'];
                
                $sql = "SELECT COUNT(*) as women FROM officers WHERE gender='ຍິງ'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $totalwomen = $row['women'];
                ?>
                <div class="stat-card-custom grad-indigo">
                    <div class="card-body-custom">
                        <h6>ພະນັກງານທັງໝົດ</h6>
                        <h3><?= $totalalls; ?> <span style="font-size: 13px; font-weight: normal; opacity: 0.95;">ສະຫາຍ</span></h3>
                        <p>[ ຍິງ: <?= $totalwomen; ?> || ຊາຍ: <?= $totalman; ?> ]</p>
                    </div>
                    <div class="card-icon">
                        <i class="ion-ios-people"></i>
                    </div>
                    <a href="../../form/officers/show_table.php" class="card-footer-custom">
                        <span>ລາຍງານທັງໝົດ</span>
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Reserve Party Members Card -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <?php  
                $sql = "SELECT COUNT(*) as totalalls FROM officers WHERE date_join_party AND date_join_party != '0000-00-00'";
                $result = mysqli_query($conn, $sql);
                $rowh = mysqli_fetch_assoc($result);
                $totalalls_res = $rowh['totalalls'];
                
                $sql = "SELECT COUNT(*) as mans FROM officers WHERE gender='ຊາຍ' AND date_join_party AND date_join_party != '0000-00-00'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $totalman_res = $row['mans'];
                
                $sql = "SELECT COUNT(*) as women FROM officers WHERE gender='ຍິງ' AND date_join_party AND date_join_party != '0000-00-00'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $totalwomen_res = $row['women'];
                ?>
                <div class="stat-card-custom grad-violet">
                    <div class="card-body-custom">
                        <h6>ສະມາຊິກພັກສຳຮອງ</h6>
                        <h3><?= $totalalls_res; ?> <span style="font-size: 13px; font-weight: normal; opacity: 0.95;">ສະຫາຍ</span></h3>
                        <p>[ ຍິງ: <?= $totalwomen_res; ?> || ຊາຍ: <?= $totalman_res; ?> ]</p>
                    </div>
                    <div class="card-icon">
                        <i class="ion-ios-lightbulb-outline"></i>
                    </div>
                    <a href="../../form/officers/show_samsexsumhong.php" class="card-footer-custom">
                        <span>ເບິ່ງລາຍການ</span>
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Full Party Members Card -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <?php  
                $sql = "SELECT COUNT(*) as totalalls FROM officers WHERE date_join AND date_join != '0000-00-00'";
                $result = mysqli_query($conn, $sql);
                $rowb = mysqli_fetch_assoc($result);
                $totalalls_full = $rowb['totalalls'];
                
                $sql = "SELECT COUNT(*) as mans FROM officers WHERE gender='ຊາຍ' AND date_join AND date_join != '0000-00-00'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $totalman_full = $row['mans'];
                
                $sql = "SELECT COUNT(*) as women FROM officers WHERE gender='ຍິງ' AND date_join AND date_join != '0000-00-00'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $totalwomen_full = $row['women'];
                ?>
                <div class="stat-card-custom grad-pink">
                    <div class="card-body-custom">
                        <h6>ສະມາຊິກພັກສົມບູນ</h6>
                        <h3><?= $totalalls_full; ?> <span style="font-size: 13px; font-weight: normal; opacity: 0.95;">ສະຫາຍ</span></h3>
                        <p>[ ຍິງ: <?= $totalwomen_full; ?> || ຊາຍ: <?= $totalman_full; ?> ]</p>
                    </div>
                    <div class="card-icon">
                        <i class="ion-ribbon-b"></i>
                    </div>
                    <a href="../../form/officers/show_samsexsumboun.php" class="card-footer-custom">
                        <span>ເບິ່ງລາຍການ</span>
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Promoted Officers Card -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <?php  
                $sql = "SELECT COUNT(DISTINCT officer_id) as totallevel_up FROM level_up";
                $result = mysqli_query($conn, $sql);
                $rowup = mysqli_fetch_assoc($result);
                $totallevel_up = $rowup['totallevel_up'];
                
                $sql = "SELECT COUNT(DISTINCT b.officer_id) as mans FROM officers as a, level_up as b WHERE a.gender='ຊາຍ' AND a.officer_id = b.officer_id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $totalman_up = $row['mans'];
                
                $sql = "SELECT COUNT(DISTINCT b.officer_id) as women FROM officers as a, level_up as b WHERE a.gender='ຍິງ' AND a.officer_id = b.officer_id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $totalwomen_up = $row['women'];
                ?>
                <div class="stat-card-custom grad-rose">
                    <div class="card-body-custom">
                        <h6>ພະນັກງານເລື່ອນຊັ້ນ</h6>
                        <h3><?= $totallevel_up; ?> <span style="font-size: 13px; font-weight: normal; opacity: 0.95;">ສະຫາຍ</span></h3>
                        <p>[ ຍິງ: <?= $totalwomen_up; ?> || ຊາຍ: <?= $totalman_up; ?> ]</p>
                    </div>
                    <div class="card-icon">
                        <i class="ion-star"></i>
                    </div>
                    <a href="../../form/level_up/show_table.php" class="card-footer-custom">
                        <span>ເບິ່ງລາຍການເລື່ອນຊັ້ນ</span>
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Transfer In Card -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <?php  
                $sql = "SELECT COUNT(*) as totalin FROM transfer_records WHERE transfer_tyep = 'IN'";
                $result = mysqli_query($conn, $sql);
                $rowin = mysqli_fetch_assoc($result);
                $totalin = $rowin['totalin'];
                
                $sql = "SELECT COUNT(*) as mansin FROM officers as a, transfer_records as b WHERE a.officer_id = b.officer_id AND a.gender='ຊາຍ' AND b.transfer_tyep = 'IN'";
                $result = mysqli_query($conn, $sql);
                $mansin = mysqli_fetch_assoc($result);
                $totalman_in = $mansin['mansin'] ?? 0;
                
                $sql = "SELECT COUNT(*) as womenin FROM officers as a, transfer_records as b WHERE a.officer_id = b.officer_id AND a.gender='ຍິງ' AND b.transfer_tyep = 'IN'";
                $result = mysqli_query($conn, $sql);
                $womenin = mysqli_fetch_assoc($result);
                $totalwomen_in = $womenin['womenin'] ?? 0;
                ?>
                <div class="stat-card-custom grad-emerald">
                    <div class="card-body-custom">
                        <h6>ຍ້າຍເຂົ້າ</h6>
                        <h3><?= $totalin; ?> <span style="font-size: 13px; font-weight: normal; opacity: 0.95;">ສະຫາຍ</span></h3>
                        <p>[ ຍິງ: <?= $totalwomen_in; ?> || ຊາຍ: <?= $totalman_in; ?> ]</p>
                    </div>
                    <div class="card-icon">
                        <i class="ion-android-add"></i>
                    </div>
                    <a href="../../form/transfer_records/show_ins.php" class="card-footer-custom">
                        <span>ເບິ່ງລາຍການຍ້າຍເຂົ້າ</span>
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Transfer Out Card -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <?php  
                $sql = "SELECT COUNT(*) as totalout FROM transfer_records WHERE transfer_tyep = 'OUT'";
                $result = mysqli_query($conn, $sql);
                $rowout = mysqli_fetch_assoc($result);
                $totalout = $rowout['totalout'];
                
                $sql = "SELECT COUNT(*) as mansout FROM officers as a, transfer_records as b WHERE a.officer_id = b.officer_id AND a.gender='ຊາຍ' AND b.transfer_tyep = 'OUT'";
                $result = mysqli_query($conn, $sql);
                $mansout = mysqli_fetch_assoc($result);
                $totalmanout = $mansout['mansout'] ?? 0;
                
                $sql = "SELECT COUNT(*) as womenout FROM officers as a, transfer_records as b WHERE a.officer_id = b.officer_id AND a.gender='ຍິງ' AND b.transfer_tyep = 'OUT'";
                $result = mysqli_query($conn, $sql);
                $womenout = mysqli_fetch_assoc($result);
                $totalwomenout = $womenout['womenout'] ?? 0;
                ?>
                <div class="stat-card-custom grad-orange">
                    <div class="card-body-custom">
                        <h6>ຍ້າຍອອກ</h6>
                        <h3><?= $totalout; ?> <span style="font-size: 13px; font-weight: normal; opacity: 0.95;">ສະຫາຍ</span></h3>
                        <p>[ ຍິງ: <?= $totalwomenout; ?> || ຊາຍ: <?= $totalmanout; ?> ]</p>
                    </div>
                    <div class="card-icon">
                        <i class="ion-android-remove"></i>
                    </div>
                    <a href="../../form/transfer_records/show_outs.php" class="card-footer-custom">
                        <span>ເບິ່ງລາຍການຍ້າຍອອກ</span>
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- 10 Years Service Card -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <?php  
                $sql = "SELECT COUNT(*) AS total_10_years_up FROM officers WHERE TIMESTAMPDIFF(YEAR, date_join_revolution, CURDATE()) >= 10";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $total_10_years_up = $row['total_10_years_up'];
                
                $sql = "SELECT COUNT(*) AS total_10man FROM officers WHERE TIMESTAMPDIFF(YEAR, date_join_revolution, CURDATE()) >= 10 AND gender = 'ຊາຍ'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $total_10_man = $row['total_10man'];
                
                $sql = "SELECT COUNT(*) AS total_10woman FROM officers WHERE TIMESTAMPDIFF(YEAR, date_join_revolution, CURDATE()) >= 10 AND gender = 'ຍິງ'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $total_10_woman = $row['total_10woman'];
                ?>
                <div class="stat-card-custom grad-cyan">
                    <div class="card-body-custom">
                        <h6>ອາຍຸການປະຕິວັດ 10 ປີຂຶ້ນໄປ</h6>
                        <h3><?= $total_10_years_up; ?> <span style="font-size: 13px; font-weight: normal; opacity: 0.95;">ສະຫາຍ</span></h3>
                        <p>[ ຍິງ: <?= $total_10_woman; ?> || ຊາຍ: <?= $total_10_man; ?> ]</p>
                    </div>
                    <div class="card-icon">
                        <i class="ion-android-calendar"></i>
                    </div>
                    <a href="../../form/officers/show_over65.php" class="card-footer-custom">
                        <span>ເບິ່ງລາຍການ</span>
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- System Users Card -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <?php  
                $sql = "SELECT COUNT(*) AS usersall FROM users";
                $result = mysqli_query($conn, $sql);
                $rowuser = mysqli_fetch_assoc($result);
                $total_users = $rowuser['usersall'];
                
                $sql = "SELECT COUNT(*) AS user_man FROM users WHERE gender = 'ຊາຍ'";
                $result = mysqli_query($conn, $sql);
                $rowuserman = mysqli_fetch_assoc($result);
                $totalu_man = $rowuserman['user_man'] ?? 0;
                
                $sql = "SELECT COUNT(*) AS user_woman FROM users WHERE gender = 'ຍິງ'";
                $result = mysqli_query($conn, $sql);
                $rowuserwoman = mysqli_fetch_assoc($result);
                $totalu_women = $rowuserwoman['user_woman'] ?? 0;
                ?>
                <div class="stat-card-custom grad-blue">
                    <div class="card-body-custom">
                        <h6>ຜູ້ໃຊ້ລະບົບ</h6>
                        <h3><?= $total_users; ?> <span style="font-size: 13px; font-weight: normal; opacity: 0.95;">ສະຫາຍ</span></h3>
                        <p>[ ຍິງ: <?= $totalu_women; ?> || ຊາຍ: <?= $totalu_man; ?> ]</p>
                    </div>
                    <div class="card-icon">
                        <i class="ion-person-stalker"></i>
                    </div>
                    <a href="../../form/users/show_table.php" class="card-footer-custom">
                        <span>ຈັດການຜູ້ໃຊ້ງານ</span>
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>