<?php
include('../../condb.php');

if (isset($_POST['send_notify'])) {

    $token = "7997554354:AAFOIJvnN3kgAA84luycqWOhUj8UVH3mz64";
    $chat_id = "7162044743";

    // 📌 JOIN officers และ JOIN ชื่อลำดับจาก positions_level (2 ครั้ง)
    $sql = "
    SELECT 
        o.full_name, 
        o.full_lastname,
        old_l.l_name AS old_level,
        new_l.l_name AS new_level,
        lu.level_date,
        lu.date_office
    FROM level_up lu
    INNER JOIN officers o ON lu.officer_id = o.officer_id
    LEFT JOIN positions_level old_l ON o.l_id = old_l.l_id
    LEFT JOIN positions_level new_l ON lu.l_id = new_l.l_id
    ORDER BY lu.level_date DESC
    ";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $message = "📋 <b>ລາຍການເລືອນຊັ້ນທັງໝົດ:</b>\n\n";

        while ($row = mysqli_fetch_assoc($result)) {
            $full_name = $row['full_name'] . " " . $row['full_lastname'];
            $level_old = $row['old_level'] ?? "–";
            $level_new = $row['new_level'] ?? "–";
            $level_date = date("d/m/Y", strtotime($row['level_date']));
            $date_office = date("d/m/Y", strtotime($row['date_office']));

            $message .= "👮‍♂️ <b>$full_name</b>\n";
            $message .= "📌 ຊັ້ນເກົ່າ: <b>$level_old</b> ➜ ຊັ້ນໃໝ່: <b>$level_new</b>\n";
            $message .= "📅 ເລືອນຊັ້ນ: $level_date\n";
            $message .= "🗂 ເອກະສານລົງວັນທີ: $date_office\n\n";
        }

        // ส่งไป Telegram
        $url = "https://api.telegram.org/bot$token/sendMessage";
        $data = [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'HTML'
        ];

        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/x-www-form-urlencoded",
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result) {
            echo "<div class='alert alert-success'>✅ ສົ່ງ Telegram ສຳເລັດ!</div>";
        } else {
            echo "<div class='alert alert-danger'>❌ ສົ່ງ Telegram ບໍ່ສຳເລັດ!</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>🔇 ບໍ່ພົບຂໍ້ມູນໃນ level_up</div>";
    }
} else {
    echo "<div class='alert alert-danger'>❌ ບໍ່ມີການຮ້ອງຂໍ</div>";
}
?>
