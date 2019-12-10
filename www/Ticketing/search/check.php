<?php
    include "../common/db.php";
    $yeme = $_POST["yemenum"];
    $phone = $_POST["phone"];

    $yemeQ = $db->query("select * from 예매 where 예매번호 = $yeme and 예매상태='A'");
    $yemeRes = $yemeQ -> fetch();
    if ( $yemeRes === false ) {
        replace('index.php?error=1');
    } else if ( $yemeRes["회원아이디"] != $phone) {
        replace('index.php?phone_miss=1');
    } else {
        replace('detail.php?yemenum='.$yeme);
    }
    // echo "<pre>";
    // var_dump($yemeRes);
    // echo "</pre>";
?>
