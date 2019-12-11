<?php
    session_start();
    include "../../common/db.php";

    $time = $_GET['time'];
    $adult = $_GET['adult'];
    $teen = $_GET['teen'];
    $seats = $_GET['seats'];
    $price = $_GET["price"];
    $today = date("Y-m-d h:i:s");

    if (isset($_SESSION['customer_id'])) {
        $id = $_SESSION['customer_id'];
    } else {
        if ($_GET['phone']==="") {
            $url = "../pay.php?phone_miss=1&time=".$time."&adult=".$adult."&teen=".$teen;
            foreach ($_GET['seats'] as $seat) {
                $url = $url."&seats[]=".$seat;
            }
            replace($url);
        } else {
            $id = $_GET['phone'];
        }
    }

    if ($_GET['met'] === NULL) {
        $url = "../pay.php?met_miss=1&time=".$time."&adult=".$adult."&teen=".$teen;
            foreach ($_GET['seats'] as $seat) {
                $url = $url."&seats[]=".$seat;
            }
            replace($url);
    }

    // echo "<pre>";
    // var_dump($_GET['met']);
    // var_dump($_GET['phone']);
    // var_dump($_GET['seats']);
    // foreach ($_GET['seats'] as $seat) {
    //     var_dump($seat);
    // }
    // echo "</pre>";


    $met = $_GET["met"];

    if (isset($_GET["dis"];)) {
      $cupon = $_GET["dis"];
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
    else { $cupon = 0; $disPrice = 0;}

    $price = (int)$price - $disPrice;
    $yemestr = "insert into 예매 values(null,'$id',$time,$adult,$teen,'$met',$cupon,$price,'$today','A')";
    $db->exec($yemestr);
    // echo "<pre>";
    // var_dump($yemestr);
    // echo "</pre>";

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


?>
