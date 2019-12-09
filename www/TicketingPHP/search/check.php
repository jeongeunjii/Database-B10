<?php
include "../common/db.php";
$yeme = $_POST["yemenum"];

$yemeQ = $db->query("select * from 예매 where 예매번호 = $yeme");
$yemeRes = $yemeQ -> fetch();
if (isset($yemeRes["회원아이디"])) {
  replace('detail.html?yemenum='.$yeme);
}
else {
  replace('index.html?error=1');
} ?>
