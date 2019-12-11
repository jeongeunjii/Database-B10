<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/fav.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../common/css/layout.css">
    <link rel="stylesheet" type="text/css" href="../common/css/search.css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet"> -->
    <!-- <script src="../common/script/index.js" type="text/javascript"></script> -->
    <title>Best of Best, 쉽조영화관</title>
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
        <?php
            include "../common/db.php";
            if (isset($_GET["error"])) { $error = $_GET["error"]; }
            else { $error=0; }
            if ($error==1) {arl("잘못된 예매번호 입니다.");}
            if (isset($_GET["phone_miss"])) { $error = $_GET["phone_miss"]; }
            else { $error=0; }
            if ($error==1) {arl("전화번호가 일치하지 않습니다.");} 
        ?>
        <form class="" action="check.php" method="post">
            <p>예매번호 입력</p><input type="text" name="yemenum" />
            <p>핸드폰번호</p><input type="text" name="phone">
            <button type="submit">조회</button>
        </form>
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
