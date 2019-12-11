<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="../img/fav.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../common/css/layout.css">
        <link rel="stylesheet" type="text/css" href="css/ticketing.css">
        <link
            href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i"
            rel="stylesheet">
        <script src="script/ticketing.js" type="text/javascript"></script>
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
            <div class="wrap">
            <?php
                include "../common/db.php";

                // 여기에 고른 지역번호, 지점번호, 날짜, 영화번호 저장
                if (isset($_GET["city"])) { $city = $_GET["city"]; }
                else { $city = ""; }
                if (isset($_GET["office"])) { $office = $_GET["office"]; }
                else { $office = ""; }
                if (isset($_GET["date"])) { $date = $_GET["date"]; }
                else { $date = ""; }
                if (isset($_GET["movie"])) { $movie = $_GET["movie"]; }
                else { $movie = ""; } ?>

                <script type="text/javascript">
                    var Dcity = '<?php echo $city ?>';
                    var Doffice = '<?php echo $office ?>';
                    var Ddate = '<?php echo $date ?>';
                    var Dmovie = '<?php echo $movie ?>';
                </script>

                <div class="movieSec">
                    <div class="title">
                        <h3>영화</h3>
                    </div>

                    <div class="movie">
                    <?php
                        if (isEmpty($office) && isEmpty($date)) {
                            $movienumQuery = $db->query("select distinct 영화번호 from 영화상영정보 where 일자>='$today'");
                        }
                        elseif (!isEmpty($office) && isEmpty($date)) {
                            $movienumQuery = $db->query("select distinct 영화번호 from 영화상영정보 where 일자>='$today' and 지점번호 ='$office'");
                        }
                        elseif (isEmpty($office) && !isEmpty($date)) {
                            $movienumQuery = $db->query("select distinct 영화번호 from 영화상영정보 where 일자='$date'");
                        }
                        else {
                            $movienumQuery = $db->query("select distinct 영화번호 from 영화상영정보 where 일자='$date' and 지점번호 ='$office'");
                        }

                        if ($movienumQuery) {
                            foreach ($movienumQuery as $k) {
                                $tmpmovie = $k['영화번호'];
                                $movieq = $db->query("select 제목, 영화등급코드 from 영화 where 영화번호='$tmpmovie'");
                                if ($movieq->rowCount() <= 0) {
                                    conlog("영화번호 : " .$tmpmovie. "번의 영화정보가 존재하지 않습니다.");
                                    continue;
                                }
                                $row = $movieq -> fetch();
                                if (isset($movie) && $movie == $tmpmovie) {
                    ?>
                                <div class = "selec" onclick="javascript:reload('<?= $city ?>','<?= $office ?>','<?= $date ?>','<?= $tmpmovie ?>');">
                                    <img src="../img/<?=$row["영화등급코드"]?>.png">
                                    <p><?= $row["제목"] ?></p>
                                </div>

                              <?php } else { ?>
                                <div onclick="javascript:reload('<?= $city ?>','<?= $office ?>','<?= $date ?>','<?= $tmpmovie ?>');">
                                    <img src="../img/<?=$row["영화등급코드"]?>.png">
                                    <p><?= $row["제목"] ?></p>
                                </div>
                    <?php
                              }
                            }
                        }
                    ?>
                    </div>
                </div>

                <div class="theater">
                    <div class="title">
                        <h3>지점</h3>
                    </div>

                    <div class="city">
                        <?php
                            $cityQuery = $db->query("select distinct 지역명, 지역번호 from 지역");
                            foreach ($cityQuery as $i) {
                              $tmpCity = $i["지역번호"];
                              if (isset($city) && $tmpCity == $city) {
                        ?>
                              <div class ="selec" onclick="javascript:reload('<?= $tmpCity ?>','<?= '' ?>','<?= $date ?>','<?= $movie ?>');">
                                <p><?= $i["지역명"]?></p>
                              </div>
                              <?php
                            } else { ?>
                                <div onclick="javascript:reload('<?= $tmpCity ?>','<?= '' ?>','<?= $date ?>','<?= $movie ?>');">
                                    <p><?= $i["지역명"]?></p>
                                </div>
                        <?php
                              }
                          }
                        ?>
                    </div>

                    <div class="office">
                        <?php
                            if (!isEmpty($city)) {
                                $officeQuery = $db->query("select 지점명, 지점번호 from 지점 where 지역번호 ='$city'");
                                foreach ($officeQuery as $j) {
                                $tmpoffice = $j["지점번호"];
                                if (isset($office) && $office == $$tmpoffice) { ?>
                                  <div class = "selec" onclick="javascript:reload('<?= $city ?>','<?= $tmpoffice ?>','<?= $date ?>','<?= $movie ?>');">
                                    <p> <?= str_replace("CGV","10PLEX ",$j["지점명"]) ?></p>
                                  </div>
                      <?php } else { ?>
                                <div onclick="javascript:reload('<?= $city ?>','<?= $tmpoffice ?>','<?= $date ?>','<?= $movie ?>');">
                                    <p> <?= str_replace("CGV","10PLEX ",$j["지점명"]) ?></p>
                                </div>
                        <?php
                                }
                            }
                          }
                        ?>
                    </div>
                </div>

                <div class="date">
                    <div class="title">
                        <h3>날짜</h3>
                    </div>

                    <div id='currentMonth'>
                        <!-- js will edit this section -->
                    </div>
                </div>


            </div>
        </section>
        <div class="submit">
            <div onclick="javascript:next('<?= $office ?>','<?= $date ?>','<?= $movie ?>');">
                시간선택
            </div>
            <div>
                >
            </div>
            <div>
                좌석선택
            </div>
            <div>
                >
            </div>
            <div>
                결제
            </div>
        </div>
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
