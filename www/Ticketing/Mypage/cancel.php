<?php
  session_start();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../common/css/layout.css">
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
              location.replace('MyPage.html');
            }
          </script>
          <?php
            include "../common/db.php";
            $id = $_SESSION['customer_id'];
            $yeme = $_POST["yeme"];
            $number = $_POST["number"];
            $seats = $_POST['seats'];

            if ($number == count($seats)) {
              $code = 'C';
            }
            else {
              $code = 'B';
            }

            $yemeQ = $db->query("UPDATE 예매 SET 예매상태 = '$code' WHERE 예매번호='$yeme'");

             foreach ($seats as $i) {
               $row = substr($i, 0, 1);
               $col = substr($i, 1);
               $pp = "UPDATE 품목 SET 품목취소코드= 'A' WHERE 예매번호=$yeme and 좌석번호_행='$row' and  좌석번호_열=$col";
               $pumInsert = $db->query($pp);
             } ?>
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
