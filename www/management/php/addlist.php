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
        
        $region = $_SESSION['REGION'];
        $region = $db->quote($region);
        $name = $_POST['name'];
        $name = $db->quote($name);
        $department = $_POST['department'];
        $department = $db->quote($department);
        $birth = $_POST['birth'];
        $birth = $db->quote($birth);
        $phone = $_POST['phone'];
        $phone = $db->quote($phone);

        $check = "INSERT INTO 직원관리
        VALUE ($region, NULL, $name, $department, $birth, $phone)";
        $db->exec($check);


        $check = "SELECT 사번 FROM 직원관리 WHERE 이름 = $name AND 부서 = $department AND 전화번호 = $phone";
        $rows = $db->query($check);      
        $result = $rows->fetchAll();
        $num = $result[0]['사번'];
        $num = $db->quote($num);
 

        if ($department == "'플로어'") {
            $check = "INSERT INTO floor업무관리
            VALUE ($num, NULL, 1)";
            $db->exec($check);
        }

        if ($department == "'기술지원'") {
            $check = "INSERT INTO 기술지원
            VALUE ($num, NULL, 1)";
            $db->exec($check);
        }


        header("Location: ../htmlp/list.php");
        // echo "<pre>";
        // var_dump($result);
        // var_dump($num);
        // echo "</pre>";
    } catch (PDOException $ex) {
        ?>
        <p>Sorry, a database error occurred. Please try again later.</p>
        <p>(Error details: <?= $ex->getMessage() ?>)</p>
        <?php
    }
    exit;
?>