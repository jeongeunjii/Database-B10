<?php
    include "../common/db.php";
    $yeme = $_POST["yemenum"];

    $yemeQ = $db->query("select * from 예매 where 예매번호 = $yeme and 예매상태='A'");
    $yemeRes = $yemeQ -> fetch();
    if (count($yemeRes)) {
        replace('detail.php?yemenum='.$yeme);
    }
    else {
        replace('index.php?error=1');
    }
?>
