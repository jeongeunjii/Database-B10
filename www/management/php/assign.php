<?php

try {
    $db = new PDO("mysql:dbname=movie; host=13.125.252.255; port=3306", "root", "1234");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query("set session character_set_connection=utf8;");
    $db->query("set session character_set_results=utf8;");
    $db->query("set session character_set_client=utf8;");
    
    $facility = $_POST['facility'];
    $q_facility = $db->quote($facility);
    $num = $_POST['num'];
    $q_num = $db->quote($num);


    $query = $db->query("SELECT 부서 FROM 직원관리 WHERE 사번 = $q_num");
    $query = $query->fetchAll();
    $dep = $query[0]['부서'];
    
    // echo "<pre>";
    // var_dump($dep);
    // echo "</pre>";

    if ($dep == '기술지원') {

        $query = "UPDATE 기술지원
        SET 시설물번호 = $q_facility,
        상태 = 0
        WHERE 사번 = $q_num";

        $db->exec($query);

        $check = "UPDATE 시설물관리
        SET 점검상태 = '수리중',
        사번 = $q_num
        WHERE 시설물번호 = $q_facility";

        $db->exec($check);
        header("Location: ../htmlp/technical.php");

    } else if ($dep == '플로어') {
        // echo "<pre>";
        // var_dump($dep);
        // echo "</pre>";
        $query = "UPDATE floor업무관리
        SET 시설물번호 = $q_facility,
        상태 = 0
        WHERE 사번 = $q_num";
        $db->exec($query);

        $check = "UPDATE 청결관리
        SET 청결상태 = '청소중',
        사번 = $q_num
        WHERE 시설물번호 = $q_facility";

        $db->exec($check);
        header("Location: ../htmlp/clean.php");
    }

    // echo "<pre>";
    // var_dump($query);
    // var_dump($check);
    // echo "</pre>";



} catch (PDOException $ex) {
    ?>
    <p>Sorry, a database error occurred. Please try again later.</p>
    <p>(Error details: <?= $ex->getMessage() ?>)</p>
    <?php
}
exit;

?>