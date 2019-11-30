<?php
    session_start();
?>

<?php
    try {
        $db = new PDO("mysql:dbname=movie; host=52.78.148.203; port=3306", "root", "1234");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->query("set session character_set_connection=utf8;");
        $db->query("set session character_set_results=utf8;");
        $db->query("set session character_set_client=utf8;");
        
        date_default_timezone_set("Asia/Seoul");
        $today = date("Y-m-d H:i:s");
        $q_today = $db->quote($today);
        $id = $_POST['id'];
        $num = $db->quote($id);

        $check = "UPDATE floor업무관리
        SET 시설물번호 = NULL,
            상태 = 1
        WHERE 사번 = $num;";
        $db->exec($check);

        $check = "UPDATE 청결관리
        SET 청소일시 = $q_today,
            청결상태 = '정상',
            사번 = NULL
        WHERE 사번 = $num;";

        $db->exec($check);

        header("Location: ../htmlp/floor.php");
        // echo "<pre>";
        // var_dump($result[0]);
        // echo "</pre>";

    } catch (PDOException $ex) {
        ?>
        <p>Sorry, a database error occurred. Please try again later.</p>
        <p>(Error details: <?= $ex->getMessage() ?>)</p>
        <?php
    }
    exit;
?>