<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../common/css/layout.css">
        <link rel="stylesheet" type="text/css" href="css/complete.css">
        <title>영화 | 예매하기</title>
    </head>

    <body>
        <header>
            <a href="../index.php"><img src="../img/logo.png" alt="logo"></a>
        </header>

        <nav>
            <ul>
                <li id="home">
                    <a href="../index.php">HOME</a>
                </li>
                <li id="movie">
                    <a href="../movie/movie.php">영화</a>
                </li>
                <li id="ticketing">
                    <a href="ticketing.php">예매</a>
                </li>
                <?php
                    if (isset($_SESSION['customer_id'])) {
                ?>
                <li id="mypage">
                    <a href="../Mypage/Mypage.php">마이페이지</a>
                </li>
            <?php
                    } else {
                ?>
                <li id="login">
                    <a href="../login/login.php">로그인</a>
                </li>
                <?php
                    }
                ?>
            </ul>
        </nav>

        <section>
            <p>결제 완료!</p>
            <?php
                $yeme = $_GET['num'];
            ?>
            <p>예매번호 : <?= $yeme ?></p>
            <button type="button" onclick="javascript:toMain()">메인페이지로</button>
            <script type="text/javascript">
                function toMain() {
                    location.replace('../index.php');
                }
            </script>
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