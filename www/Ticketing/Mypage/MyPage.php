<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../img/fav.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../common/css/layout.css">
        <link rel="stylesheet" type="text/css" href="../common/css/mypage.css">
        <link
            href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i"
            rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="mypage.js"></script>
        <title>myPage</title>
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
                    <a href="../Ticketing/ticketing.php">예매</a>
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
                <div class="top">
                    <h1>My Page</h1>
                </div>
                
                <?php
                    include "../common/db.php";
                    $id = $_SESSION['customer_id'];

                    $test_ps = $db->query("select * from 회원 where 아이디 ='$id'");
                    $row = $test_ps -> fetch();
                ?>
                <div class="hello">
                    <p><?= $row["이름_성"]?><?= $row["이름_이름"]?>님의 마이페이지</p>
                </div>
                <div class="TicketingList">
                    <h2>예매 내역</h2>
                    <table>
                        <th>예매번호</th>
                        <th>지점</th>
                        <th>영화</th>
                        <th>상영일</th>
                        <th>가격</th>
                        <th>예매일</th>
                        <th>예매상태</th>
        <?php
                        $yemeQ = $db->query("select * from 예매 where 회원아이디 ='$id'");
                        foreach ($yemeQ as $i) {
                            $yeme = $i["예매번호"];
                            $time = $i["상영정보번호"];
                            $price = $i["총가격"];
                            $yemeD = $i["예매일자"];
                            $yemeC = $i["예매상태"];

                            $codeQ = $db->query("select 코드값 from 서브코드 where 메인코드 ='B' and 서브코드 = '$yemeC'");
                            $code = $codeQ -> fetch();
                            $yemeV = $code["코드값"];

                            $timeQuery = $db->query("select * from 영화상영정보 where 상영정보번호= $time");
                            $timeRes = $timeQuery -> fetch();

                            $office = $timeRes["지점번호"];
                            // $sang = $timeRes["상영관번호"];
                            $movie = $timeRes["영화번호"];
                            $movie_date = $timeRes["일자"];
                            $movie_time = $timeRes["영화시작시간"];

                            // (지점명, 상영관명, 영화제목)

                            $officeQuery = $db->query("select 지점명 from 지점 where 지점번호 ='$office'");
                            // $sangQuery = $db->query("select 상영관명 from 상영관 where 상영관번호 ='$sang' and 지점번호 ='$office'");
                            $movieQuery = $db->query("select 제목 from 영화 where 영화번호='$movie'");

                            $officeRes = $officeQuery -> fetch();
                            // $sangRes = $sangQuery -> fetch();
                            $movieRes = $movieQuery -> fetch(); 
        ?>
                        <tr class="row" id="<?= $yeme ?>">
                            <td><?= $yeme ?></td>
                            <td><?= $officeRes["지점명"] ?></td>
                            <td><?= $movieRes["제목"] ?></td>
                            <td><?= $movie_date ?>
                                <?= $movie_time ?></td>
                            <td><?= $price ?></td>
                            <td><?= $yemeD ?></td>
                            <td><?= $yemeV ?></td>
                        </tr>
        <?php 
            }
        ?>
                    </table>
                </div>
            </div>
            <div class="logout">
                <a href="logout.php"><button class="button">Logout</button></a>
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