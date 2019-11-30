<?php
    try {
        $db = new PDO("mysql:dbname=movie; host=52.78.148.203; port=3306", "root", "1234");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->query("set session character_set_connection=utf8;");
        $db->query("set session character_set_results=utf8;");
        $db->query("set session character_set_client=utf8;");
        
        $id = $_POST['id'];
        $id = $db->quote($id);
        $name = $_POST['name'];
        $name = $db->quote($name);
        $department = $_POST['department'];
        $department = $db->quote($department);
        $birth = $_POST['birth'];
        $birth = $db->quote($birth);
        $phone = $_POST['phone'];
        $phone = $db->quote($phone);

        $check = "UPDATE 직원관리
        SET 이름 = $name,
            부서 = $department,
            생년월일 = $birth,
            전화번호 = $phone
        WHERE 사번 = $id;";
        $db->exec($check);

        header("Location: ../htmlp/list.php");

    } catch (PDOException $ex) {
        ?>
        <p>Sorry, a database error occurred. Please try again later.</p>
        <p>(Error details: <?= $ex->getMessage() ?>)</p>
        <?php
    }
    exit;
?>