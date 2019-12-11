<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../common/css/layout.css">
    <link rel="stylesheet" type="text/css" href="../common/css/cancel.css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
    <title>myPage</title>
</head>
<body>
    <header>
        <a href="../index.php"><img src="../img/logo.png" alt="logo"></a>
    </header>

    <nav>
        <ul>
            <li id="home"><a href="../index.php">HOME</a></li>
            <li id="movie"><a href="../movie/movie.php">영화</a></li>
            <li id="ticketing"><a href="../Ticketing/ticketing.php">예매</a></li>
            <?php
                if (isset($_SESSION['customer_id'])) {
            ?>
                    <li id="mypage"><a href="../Mypage/Mypage.php">마이페이지</a></li>
            <?php
                } else {
            ?>
                    <li id="login"><a href="../login/login.php">로그인</a></li>
            <?php
                }
            ?>

        </ul>
    </nav>

    <section>
        <div class="wrap">
            <p>취소되었습니다.</p>
            <button type="button" onClick="javascript:toMain()">마이페이지로</button>
            <script type="text/javascript">
                function toMain() {
                location.replace('MyPage.php');
                }
            </script>
            <?php
                include "../common/db.php";
                $id = $_SESSION['customer_id'];
                $yeme = $_POST["yeme"];

                $db->exec("UPDATE 예매 SET 예매상태 = 'C' WHERE 예매번호='$yeme'");
                $db->exec("UPDATE 품목 SET 품목취소코드= 'A' WHERE 예매번호='$yeme'");

                //쿠폰 다시 지급
                $cuponQ = $db->query("select 할인적용 from 예매 where 예매번호='$yeme'");;
                $cuponRes = $disQ -> fetch();
                $cupon = $cuponRes["할인적용"];
                $id = $_SESSION['customer_id'];
                $db->exec("insert into 회원쿠폰 values($cupon,$id)");
            ?>
      </div>
    </section>

    <footer>
        <div>
            <div id="foot_img">
                <img src="../img/logo.png" width="120px">
            </div>
            <div id="foot_p">
                <p>경기도 안산시 상록구 한양대학로 55</p>
                <p>개발자 | 정은지,김재영,박예림,이재원,윤성주 |</p>
                <p>&copy;10PLEX.All Rights Reserved</p>
            </div>
        </div>
    </footer>
</body>
</html>
