<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<script src="script/pay.js"></script>
		<title>결제</title>
	</head>

	<body>
		<div class="wrap">
			<?php
			function isEmpty($str) {
				if ($str == null || $str == "") { return true; }
				else { return false; }
			}

			session_start();

			$time = $_POST['time'];
			$adult = $_POST['adult'];
			$teen = $_POST['teen'];
			$seats = $_POST['seats'];

			$id = $_SESSION['customer_id'];

			$dbHost = "13.125.252.255";
			$dbName = "movie";
			$dbUser = "root";
			$dbPass = "1234";

			try {
				$DB = new PDO("mysql:host={$dbHost};dbname={$dbName}; port=3306", $dbUser, $dbPass);
				$DB->exec("set names utf8");
				$timeQuery = $DB->query("select * from 영화상영정보 where 상영정보번호= '$time'");
				$timeRes = $timeQuery -> fetch();
				$office = $timeRes["지점번호"];
				$sang = $timeRes["상영관번호"];
				$movie = $timeRes["영화번호"];
				$adultPrice = $timeRes["성인단가"]*$adult;
				$teenPrice =$timeRes["청소년단가"]*$teen;
				$price = $adultPrice + $teenPrice;

				$officeQuery = $DB->query("select 지점명 from 지점 where 지점번호 ='$office'");
				$sangQuery = $DB->query("select 상영관명 from 상영관 where 상영관번호 ='$sang' and 지점번호 ='$office'");
				$movieQuery = $DB->query("select 제목 from 영화 where 영화번호='$movie'");

				$officeRes = $officeQuery -> fetch();
				$sangRes = $sangQuery -> fetch();
				$movieRes = $movieQuery -> fetch();
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
					총 가격 : <?= $price ?> </p>
			</div>


			<form action="pay.php" method="post">
				<input type="hidden" name="time" value= "<?= $time ?>"/>
				<input type="hidden" name="adult" value="<?= $adult ?>"/>
				<input type="hidden" name="teen" value="<?= $teen ?>"/>
				<div id="seatsDiv">
					<!-- js will edit this -->
				</div>
				결제수단: <br>
				<input type="radio" name="met" value="신용카드"> 신용카드<br>
				<input type="radio" name="met" value="휴대폰"> 휴대폰결제<br>
				<input type="radio" name="met" value="무통장"> 무통장입금<br><br>
				<div id="discountDiv">
					할인 : <input type="text" name="discount" /><br>
					<!-- js will edit this -->
				</div>
				<button type="submit">결제</button>
			</form>

			<?php
			$met = $_POST["met"];
			$dis = $_POST["discount"];
			$today = date("Y-m-d");

			if (!isEmpty($met) && !isEmpty($dis)) {
				$yemestr = "insert into 예매 (예매번호, 회원아이디, 상영정보번호, 개수_성인, 개수_청소년, 결제방법, 할인적용, 총가격, 예매일자, 예매상태) values(null,'$id',$time,$adult,$teen,'$met','$dis',$price,'$today','A')";
				$yemeInsert = $DB->query($yemestr);

				$yemeQ = $DB->query("SELECT 예매번호 FROM 예매 ORDER BY 예매번호 DESC LIMIT 1");
				$yemeRes = $yemeQ -> fetch();
				$yeme = $yemeRes["예매번호"];

				foreach ($seats as $i) {
					$row = substr($i, 0, 1);
					$col = substr($i, 1);
					$pumtstr = "insert into 품목 (예매번호,좌석번호_행,좌석번호_열,품목취소코드) values($yeme,'$row',$col,'B')";
					$pumInsert = $DB->query($pumstr);
				}
				echo "<script>location.replace('complete.html')</script>";
			}
			?>
    </div>
  </body>
</html>
