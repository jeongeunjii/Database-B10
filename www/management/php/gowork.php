<?php
    session_start();
?>

<?php
    try {
        $db = new PDO("mysql:dbname=movie; host=13.125.252.255; port=3306", "root", "1234");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->query("set session character_set_connection=utf8;");
        $db->query("set session character_set_results=utf8;");
        $db->query("set session character_set_client=utf8;");

        date_default_timezone_set("Asia/Seoul");
        $today = date("Y-m-d");
        $q_today = $db->quote($today);
        $time = date("H:i:s");
        $q_time = $db->quote($time);
        $id = $_SESSION['ID'];
        $q_id = $db->quote($id);

        $check = "UPDATE 근태관리
        SET 출근 = $q_time
        WHERE 사번 = $q_id AND 일자 = $q_today";
        $db->exec($check);

        header("Location: ../htmlp/attendance.php");

    } catch (PDOException $ex) {
        ?>
        <p>Sorry, a database error occurred. Please try again later.</p>
        <p>(Error details: <?= $ex->getMessage() ?>)</p>
        <?php
    }
    exit;
?>