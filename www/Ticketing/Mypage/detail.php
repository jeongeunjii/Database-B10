<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../common/css/layout.css">
    <link rel="stylesheet" type="text/css" href="../common/css/detail.css">
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
            <div class="top">
                <h1>예매 상세</h1>
            </div>
            
            <?php
                include "../common/db.php";
                $id = $_SESSION['customer_id'];
                $yeme = $_GET["num"];

                $yemeQ = $db->query("select * from 예매 where 예매번호 = $yeme");
                foreach ($yemeQ as $i) {
                    $yeme = $i["예매번호"];
                    $time = $i["상영정보번호"];
                    $price = $i["총가격"];
                    $yemeD = $i["예매일자"];
                    $yemeC = $i["예매상태"];
                    $isCanceled = $i["예매상태"];

                    $codeQ = $db->query("select 코드값 from 서브코드 where 메인코드 ='B' and 서브코드 = '$yemeC'");
                    $code = $codeQ -> fetch();
                    $yemeV = $code["코드값"];

                    $timeQuery = $db->query("select * from 영화상영정보 where 상영정보번호= $time");
                    $timeRes = $timeQuery -> fetch();

                    $office = $timeRes["지점번호"];
                    $sang = $timeRes["상영관번호"];
                    $movie = $timeRes["영화번호"];
                    $movie_date = $timeRes["일자"];
                    $movie_time = $timeRes["영화시작시간"];

                    // (지점명, 상영관명, 영화제목)

                    $officeQuery = $db->query("select 지점명 from 지점 where 지점번호 ='$office'");
                    $sangQuery = $db->query("select 상영관명 from 상영관 where 상영관번호 ='$sang' and 지점번호 ='$office'");
                    $movieQuery = $db->query("select 제목 from 영화 where 영화번호='$movie'");

                    $officeRes = $officeQuery -> fetch();
                    $sangRes = $sangQuery -> fetch();
                    $movieRes = $movieQuery -> fetch();
                }
            ?>
                <div class="detail">
                    <div class="succeed">
                        <p>예매번호</p>
                        <p>지점</p>
                        <p>영화</p>
                        <p>상영일</p>
                        <p>일반</p>
                        <p>청소년</p>
                        <p>가격</p>                   
                        <p>예매일</p>                    
                        <p>예매상태</p>
                    </div>
                    <div class="information">
                        <p><?= $yeme ?></p>
                        <p><?= $officeRes["지점명"] ?> <?= $sangRes["상영관명"]?></p>
                        <p><?= $movieRes["제목"] ?></p>
                        <p><?= $movie_date ?> <?= $movie_time ?></p>
                        <p><?= $i["개수_성인"]?></p>
                        <p><?= $i["개수_청소년"]?></p>
                        <p><?= $price ?></p>
                        <p><?= $yemeD ?></p>
                        <p><?= $yemeV ?></p>
                    </div>
                </div>
                
            <?php
                if ($isCanceled != "C"){
            ?>
                    <div class="cancel_reserve">
                        <h2>예매취소하기</h2>
                        <form action="cancel.php" method="post">
                            <input type="hidden" name="yeme" value= "<?= $yeme ?>"/>
                            <button type="submit">취소</button>
                        </form>
                    </div>
            <?php
                } else {
            ?>
                    <button type="button" onClick="javascript:toMain()">마이페이지로</button>
                    <script type="text/javascript">
                        function toMain() {
                            location.replace('../Mypage/Mypage.php');
                        }
                    </script>

            <?php
                }
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
