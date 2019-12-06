<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="common/css/layout.css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
    <title>Best of Best, 쉽조영화관</title>
</head>
<body>
    <header>
        <a href="index.php"><img src="img/logo.png" alt="logo"></a>
    </header>

    <nav>
        <ul>
            <li id="home"><a href="index.php">HOME</a></li>
            <li id="movie"><a href="movie/movie.php">영화</a></li>
            <li id="ticketing"><a href="Ticketing/ticketing.php">예매</a></li>
            <?php
                if (isset($_SESSION['customer_id'])) {
            ?>
                    <li id="mypage"><a href="Mypage/Mypage.php">마이페이지</a></li>
            <?php
                } else {
            ?>
                    <li id="login"><a href="login/login.php">로그인</a></li>
            <?php
                }
            ?>
            
        </ul>
    </nav>

    <section>
      <p>환영합니다!</p>
    </section>

    <footer>
        <div>
            <div id="foot_img">
                <img src="img/logo.png" width="120px">
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