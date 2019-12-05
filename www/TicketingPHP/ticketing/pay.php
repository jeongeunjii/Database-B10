<?php
include "../common/db.php";

$id = $_SESSION['customer_id'];

$time = $_POST['time'];
$adult = $_POST['adult'];
$teen = $_POST['teen'];
$seats = $_POST['seats'];
$met = $_POST["met"];
$dis = $_POST["dis"];
$price = $_POST["price"];
$today = date("Y-m-d h:i:s");

if (!isEmpty($met)) {
  $yemestr = "insert into 예매 (예매번호, 회원아이디, 상영정보번호, 개수_성인, 개수_청소년, 결제방법, 할인적용, 총가격, 예매일자, 예매상태) values(null,'$id',$time,$adult,$teen,'$met',$dis,($price-$dis),'$today','A')";
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
