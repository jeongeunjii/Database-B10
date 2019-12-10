<?php
include "../common/db.php";

$id = $_SESSION['customer_id'];

$time = $_POST['time'];
$adult = $_POST['adult'];
$teen = $_POST['teen'];
$seats = $_POST['seats'];
$met = $_POST["met"];
$cupon = $_POST["dis"];
$price = $_POST["price"];
$today = date("Y-m-d h:i:s");

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
  $del = $db->query("delete from 회원쿠 where 쿠폰번호 = $cupon");
}
else {$disPrice = 0;}

if (!isEmpty($met)) {
  $yemestr = "insert into 예매 (예매번호, 회원아이디, 상영정보번호, 개수_성인, 개수_청소년, 결제방법, 할인적용, 총가격, 예매일자, 예매상태) values(null,'$id',$time,$adult,$teen,'$met',''$cupon',($price-$disPrice),'$today','A')";
  $yemeInsert = $db->query($yemestr);

  $yemeQ = $db->query("SELECT 예매번호 FROM 예매 ORDER BY 예매번호 DESC LIMIT 1");
  $yemeRes = $yemeQ -> fetch();
  $yeme = $yemeRes["예매번호"];

  foreach ($seats as $i) {
    $row = substr($i, 0, 1);
    $col = substr($i, 1);
    $pp = "insert into 품목 (예매번호,좌석번호_행,좌석번호_열,품목취소코드) values($yeme,'$row',$col,'B')";
    $pumInsert = $db->query($pp);
  }
  replace('complete.html?num='.$yeme);
}
else {
  replace("pay.html");
}
?>
