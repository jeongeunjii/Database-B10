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
        
        $facility = $_POST['facility'];
        $q_facility = $db->quote($facility);
        $query = $db->query("SELECT 시설물번호 FROM 시설물 WHERE 시설물명 = $q_facility");
        $query = $query->fetchAll();
        $num = $query[0]['시설물번호'];
        $num = $db->quote($num);

        $check = "UPDATE 시설물관리
        SET 점검상태 = '접수완료'
        WHERE 시설물번호 = $num;";
        $db->exec($check);

        header("Location: ../htmlp/technical.php");
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