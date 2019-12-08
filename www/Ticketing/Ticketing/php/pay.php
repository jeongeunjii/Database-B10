<?php
session_start();
include "../../common/db.php";

$id = $_SESSION['customer_id'];

$time = $_POST['time'];
$adult = $_POST['adult'];
$teen = $_POST['teen'];
$seats = $_POST['seats'];
$met = $_POST["met"];
$dis = $_POST["dis"];
$price = $_POST["price"];
$today = date("Y-m-d h:i:s");

$dis = (int)$dis;
$price = (int)$price - $dis;

if (!isEmpty($met)) {
    $yemestr = "insert into 예매 values(null,'$id',$time,$adult,$teen,'$met',$dis,$price,'$today','A')";
    $db->exec($yemestr);
    echo "<pre>";
    var_dump($yemestr);
   
    echo "</pre>";

    $yemeQ = $db->query("SELECT 예매번호 FROM 예매 ORDER BY 예매번호 DESC LIMIT 1");
    $yemeRes = $yemeQ -> fetch();
    $yeme = $yemeRes["예매번호"];

    foreach ($seats as $i) {
        $row = substr($i, 0, 1);
        $col = substr($i, 1);
        $pp = "insert into 품목 (예매번호,좌석번호_행,좌석번호_열,품목취소코드) values($yeme,'$row',$col,'B')";
        $db->exec($pp);
    }
    replace('../complete.php?num='.$yeme);
}
else {
    replace("../pay.php");
}
?>
