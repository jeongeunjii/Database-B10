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
        
        $id = $_POST['id'];
        $num = $db->quote($id);

        $check = "UPDATE floor업무관리
        SET 시설물번호 = NULL,
            상태 = 1
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
?>