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
        $pw = $_POST['password'];
        $num = $db->quote($id);
        $check = "SELECT 사번,이름,부서,지점번호 FROM 직원관리 WHERE 사번 = $num";
        $rows = $db->query($check);
        $result = $rows->fetchAll();
        
        if ($result[0] === NULL or $result[0]['이름'] != $pw){
            header("Location: ../htmlp/home.php");
        }else {
            $_SESSION['REGION'] = $result[0]['지점번호'];
            $_SESSION['ID'] = $id;
            $_SESSION['PW'] = $pw;
            $_SESSION['DEP'] = $result[0]['부서'];
            header("Location: ../htmlp/home.php");
        }
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