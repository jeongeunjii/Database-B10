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
        
        $id = $_POST['id'];
        $num = $db->quote($id);
        $check = "DELETE FROM 직원관리
        WHERE 사번 = $num";
        $db->exec($check);

        $num = $db->quote($id);
        $check = "DELETE FROM floor업무관리
        WHERE 사번 = $num";
        $db->exec($check);

        $num = $db->quote($id);
        $check = "DELETE FROM 기술지원
        WHERE 사번 = $num";
        $db->exec($check);

   
        header("Location: ../htmlp/list.php");
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