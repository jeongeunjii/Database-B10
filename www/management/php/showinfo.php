<?php
    $db = new PDO("mysql:dbname=movie; host=52.78.148.203; port=3306", "root", "1234");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query("set session character_set_connection=utf8;");
    $db->query("set session character_set_results=utf8;");
    $db->query("set session character_set_client=utf8;");

    $rows = $db->query("SELECT * FROM 직원관리 ORDER BY 부서");
                    // foreach ($rows as $row) {


?>