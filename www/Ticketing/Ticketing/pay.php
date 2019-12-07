<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../common/css/layout.css">
  <script src="script/pay.js"></script>
  <title>영화 | 예매하기</title>
</head>

<body>
  <header>
    <a href="../index.php"><img src="../img/logo.png" alt="logo"></a>
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
    <div class="wrap">
			<?php
      include "../common/db.php";

			$id = $_SESSION['customer_id'];

			$time = $_POST['time'];
			$adult = $_POST['adult'];
			$teen = $_POST['teen'];
			$seats = $_POST['seats'];

			try {
				$timeQuery = $db->query("select * from 영화상영정보 where 상영정보번호= '$time'");
				$timeRes = $timeQuery -> fetch();
				$office = $timeRes["지점번호"];
				$sang = $timeRes["상영관번호"];
				$movie = $timeRes["영화번호"];
				$adultPrice = $timeRes["성인단가"]*$adult;
				$teenPrice =$timeRes["청소년단가"]*$teen;
				$price = $adultPrice + $teenPrice;

				$officeQuery = $db->query("select 지점명 from 지점 where 지점번호 ='$office'");
				$sangQuery = $db->query("select 상영관명 from 상영관 where 상영관번호 ='$sang' and 지점번호 ='$office'");
				$movieQuery = $db->query("select 제목 from 영화 where 영화번호='$movie'");

				$officeRes = $officeQuery -> fetch();
				$sangRes = $sangQuery -> fetch();
				$movieRes = $movieQuery -> fetch();

        $discountQ = $db->query("select * from 회원쿠폰 where 회원아이디 = '$id'");
			} catch (PDOException $ex) {
			?>
			<p>Sorry, a database error occurred. Please try again later.</p>
			<p>(Error details: <?= $ex->getMessage() ?>)</p>
			<?php
			}
			?>

			<script type="text/javascript">
				var seatArr = <?php echo json_encode($seats)?>;
			</script>

			<div class="data">
				<!-- <img src="" alt="영화포스터"> -->
				<h2><?= $movieRes["제목"] ?></h2>
				<p><?= $officeRes["지점명"] ?></p>
				<p><?= $sangRes["상영관명"] ?></p>
				<p><?= $timeRes["일자"] ?> <?= $timeRes["영화시작시간"] ?> ~ (<?= $timeRes["러닝타임"] ?>)</p>
				<p>일반 : <?= $adult ?> <br/>
					청소년 : <?= $teen ?> </p>
				<p id = "seatP">좌석 : <!-- js will edit this --></p>
				<p>가격 <br/>
					일반 : <?= $adultPrice ?> <br/>
					청소년 : <?= $teenPrice ?> <br/>
					총 가격(할인제외) : <?= $price ?> </p>
			</div>


			<form action="php/pay.php" method="post">
				<input type="hidden" name="time" value= "<?= $time ?>"/>
				<input type="hidden" name="adult" value="<?= $adult ?>"/>
				<input type="hidden" name="teen" value="<?= $teen ?>"/>
        <input type="hidden" name="price" value="<?= $price ?>"/>
				<div id="seatsDiv">
					<!-- js will edit this -->
				</div>
				결제수단: <br>
				<input type="radio" name="met" value="신용카드"> 신용카드<br>
				<input type="radio" name="met" value="휴대폰"> 휴대폰결제<br>
				<input type="radio" name="met" value="무통장"> 무통장입금<br><br>
				<div id="discountDiv">
					할인 : <br>
          <?php
          foreach ($discountQ as $k) {
            $cupon = $k["쿠폰번호"];
            $disQ = $db->query("select * from 쿠폰 where 쿠폰번호 = $cupon and 만료일 >= '$today'");
            if ($disQ->rowCount() > 0) {
              $disRes = $disQ -> fetch();
              if ($disRes["쿠폰종류코드"] == 'A') {
                $disPrice = $price * $disRes["할인가_per"];
              }
              else {
                $disPrice = $disRes["할인가_const"];
              } ?>
              <input type="radio" name="dis" value="<?= $disPrice ?>"><?= $disRes["쿠폰이름"] ?><br>
            <?php
            }
          } ?>
          <br>
				</div>
				<button type="submit">결제</button>
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
