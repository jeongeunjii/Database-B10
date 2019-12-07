<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../common/css/layout.css">
    <link rel="stylesheet" type="text/css" href="../common/css/movie.css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
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
        <h1>영화상세</h1>
        <hr>
        
          <?php
            include "../common/db.php";
            
            $id = $_SESSION['customer_id'];
            $today = "2019-11-18";

            $movienumQuery = $db->query("select distinct 영화번호 from 영화상영정보 where 일자>='$today'");
            foreach ($movienumQuery as $k) {
              $tmpmovie = $k['영화번호'];
              $imgurl = "http://img.cgv.co.kr/Movie/Thumbnail/Poster/0000".$tmpmovie[0].$tmpmovie[1]."/".$tmpmovie."/".$tmpmovie."_1000.jpg";
              $movieq = $db->query("select * from 영화 where 영화번호='$tmpmovie'");
              if ($movieq->rowCount() <= 0) {
                conlog("영화번호 : " .$tmpmovie. "번의 영화정보가 존재하지 않습니다.");
                continue;
              }
              $row = $movieq -> fetch();
              $movieC = $row["영화등급코드"];
              $codeQ = $db->query("select 코드값 from 서브코드 where 메인코드='C' and 서브코드 = '$movieC'");
              $movieV = $codeQ -> fetch(); ?>
              <article>
              <div class="movieInform">
                <img src="<?= $imgurl ?>" alt="" width="300px" height="450px">
                <h2><?= $row["제목"] ?></h2>
                <p>감독 : <?= $row["감독"] ?></p>
                <p>주연 : <?= $row["배우"] ?></p>
                <p>장르 : <?= $row["장르"] ?></p>
                <p>기본 : <?= $movieV["코드값"] ?>, <?= $row["상영시간"] ?></p>
                <hr>
                <div>
                  <?= $row["줄거리"] ?>
                </div>
              </div>
              </article>
              <?php
            }
           ?>
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
