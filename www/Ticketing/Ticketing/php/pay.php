<?php
session_start();
include "../../common/db.php";

$id = $_SESSION['customer_id'];

$time = $_POST['time'];
$adult = $_POST['adult'];
$teen = $_POST['teen'];
$seats = $_POST['seats'];
$met = $_POST["met"];
$cupon = $_POST["dis"];
$price = $_POST["price"];
$today = date("Y-m-d h:i:s");

$cupon = (int)$cupon;
$price = (int)$price - $dis;

if (!isEmpty($cupon)) {
  $disQ = $db->query("select * from 쿠폰 where 쿠폰번호 = $cupon");
  if ($disQ->rowCount() > 0) {
    $disRes = $disQ -> fetch();
    if ($disRes["쿠폰종류코드"] == 'A') {
      $disPrice = $price * $disRes["할인가_per"];
    }
    else {
      $disPrice = $disRes["할인가_const"];
    }
  }
  $del = $db->query("delete from 회원쿠폰 where 쿠폰번호 = $cupon");
}
else {$disPrice = 0;}

if (!isEmpty($met)) {
    $yemestr = "insert into 예매 values(null,'$id',$time,$adult,$teen,'$met',$cupon,($price-$disPrice),'$today','A')";
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
