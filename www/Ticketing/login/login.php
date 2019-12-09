<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../common/css/layout.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
    <title>로그인 | 회원서비스</title>
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
        <div class="content">
            <h1>로그인</h1>
            <form action="php/login.php" method="post">
                <p>아이디 </p><input type="text" id="username" name="id" /><br>
                <p>비밀번호 </p><input type="password" id="password" name="ps" /><br>
                <input type="submit" class="submit" value="로그인">
                <input type="button" class="submit" onclick="location.href='join.php'" value="회원가입">
            </form>
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
