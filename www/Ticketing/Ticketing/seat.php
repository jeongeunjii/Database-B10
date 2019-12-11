<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>seat</title>
        <link rel="shortcut icon" href="../img/fav.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../common/css/layout.css">
        <link rel="stylesheet" href="css/seat.css">
        <script src="script/seat.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
                <div class="top">
                    <h3>인원/좌석</h3>
                </div>
                <div class="numberofticket">
                    <div class="status">
                        <?php
                            include "../common/db.php";
                            if (isset($_SESSION['customer_id'])){
                                $id = $_SESSION['customer_id'];
                            }

                            // 상영정보번호
                            if (isset($_GET["time"])) { $time = $_GET["time"]; }
                            else { arl("오류 : 상영정보를 받아오지 못했습니다."); replace("../index.php"); }

                            $timeQuery = $db->query("select * from 영화상영정보 natural join 상영관 natural join 지점 where 상영정보번호 = '$time'");
                            $res = $timeQuery -> fetch();
                            $office = $res["지점번호"];
                            $sang = $res["상영관번호"];
                            $adultPrice = $res["성인단가"];
                            $teenPrice = $res["청소년단가"];
                            $namesang = $res["상영관명"];
                            $nameoffice = $res["지점명"];
                            $nameoffice = str_replace("CGV","10PLEX",$nameoffice);
                            $date = $res["일자"];
                            $start = $res["영화시작시간"];
                            $running = $res["러닝타임"];

                            $numrunning = substr($running, 0, -3);
                            $selectedTime = $start.":00";
                            $endTime = strtotime("+".$numrunning." minutes", strtotime($selectedTime));
                            
                        ?>
                            <p class="theater"><?=$nameoffice?> | <?=$namesang?></p>
                            <p class="time"><?=$date?> <?=$start." ~ "?><?=date('H:i', $endTime)?> <?=$running?></p>
                    </div>
                    <div>
                        <p> 일반 </p>
                        <input type="button" value="-" onclick="javascript:tiket(0,-1)">
                        <p id="numOfAdult">0</p>
                        <input type="button" value="+" onclick="javascript:tiket(0,1)">
                    </div>
                    <div>
                        <p>청소년</p>
                        <input type="button" value="-" onclick="javascript:tiket(1,-1)">
                        <p id="numOfTeen">0</p>
                        <input type="button" value="+" onclick="javascript:tiket(1,1)">
                    </div>
                    
                </div>

                    <?php
                        

                        
                    ?>

                <script type="text/javascript">
                    var ptime = '<?php echo $time ?>';
                    var adultPrice = <?php echo $adultPrice ?>;
                    var teenPrice = <?php echo $teenPrice ?>;
                </script>


                <div class="rowarea">

                    <?php 
                        $seatRowQuery = $db->query("select distinct 좌석번호_행 from 좌석 where 상영관번호= '$sang'");
                            foreach ($seatRowQuery as $i) {
                                $row = $i['좌석번호_행'];
                    ?>
                                <div class="row">
                                    <p><?= $row ?></p>
                                    <div class="rowSeat" id="<?= $row ?>">
                    <?php
                                        $seatColQuery = $db->query("select 좌석번호_열 from 좌석 where 상영관번호= '$sang' and 좌석번호_행 = '$row' order by 좌석번호_열");
                                        $empty = 1; #for check empty seat
                                        foreach ($seatColQuery as $j) {
                                            if ($empty != $j['좌석번호_열']){
                                                for ($r = $empty; $r < $j['좌석번호_열']; $r++){
                    ?>                          
                                                    <input
                                                    type="button"
                                                    class="seat"
                                                    id="<?= $row ?><?=$r?>"
                                                    value="<?=$r?>"
                                                    style="visibility:hidden;"/>

                    <?php                            
                                                    $empty=$j['좌석번호_열'];
                                                    continue;                        
                                                }
                                            }
                                            $empty++;
                    ?>
                                            <input
                                                type="button"
                                                class="seat"
                                                id="<?= $row ?><?= $j['좌석번호_열'] ?>"
                                                value="<?= $j['좌석번호_열'] ?>"
                                                onclick="javascript:selec('<?= $row ?><?= $j['좌석번호_열'] ?>')"/>
                    <?php                       
  
                                        }
                    ?>
                                    </div>
                                </div>
                    <?php
                            }
                        $str = "select 좌석번호_열,좌석번호_행 from 예매,품목 where 예매.예매번호=품목.예매번호 and 예매.상영정보번호 =" .$time. " and 품목.품목취소코드 = 'B'";
                        $seatq = $db->query($str);
                        foreach ($seatq as $k) { 
                    ?>
                            <script type="text/javascript">
                            $(function () {
                                var id = '#<?php echo $k["좌석번호_행"] ?><?php echo $k["좌석번호_열"] ?>';
                                $(id).attr('class', 'selected');
                                $(id)
                                .attr('onclick', '')
                                .unbind('click');
                            });
                            </script>
                    <?php
                        }
                    ?>

                </div>

                
            </div>
        </section>
        <div class="submit">
            <div>
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
            <div id="payB">
                <?php
                    $postingStr = "<script> posting() </script>";
                    echo $postingStr;
                ?>
                <!-- js will edit this -->
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
    </body>
</html>