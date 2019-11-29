<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="seat.js"></script>
		<title>db testing</title>
	</head>

	<body>
		<div class="wrap">
			<div class="numberoftiket">
				<p>일반</p>
				<input type="button" value="+" onClick="javascript:tiket(0,1)">
				<p id = numOfAdult> 0 </p>
				<input type="button" value="-" onClick="javascript:tiket(0,-1)">
				<p>청소년</p>
				<input type="button" value="+" onClick="javascript:tiket(1,1)">
				<p id = numOfTeen> 0 </p>
				<input type="button" value="-" onClick="javascript:tiket(1,-1)">
			</div>

      <?php
      // 상영정보번호
			if (isset($_GET["time"])) { $time = $_GET["time"]; }
			else { echo "<script>alert(\"오류 : 상영정보를 받아오지 못했습니다.\");</script>"; }

			$dbHost = "13.125.252.255";
			$dbName = "movie";
			$dbUser = "root";
			$dbPass = "1234";

			try {
				$DB = new PDO("mysql:host={$dbHost};dbname={$dbName}; port=3306", $dbUser, $dbPass);
				$DB->exec("set names utf8");
				$timeQuery = $DB->query("select 지점번호, 상영관번호, 성인단가, 청소년단가 from 영화상영정보 where 상영정보번호= '$time'");
			} catch (PDOException $ex) {
			?>
			<p>Sorry, a database error occurred. Please try again later.</p>
			<p>(Error details: <?= $ex->getMessage() ?>)</p>
			<?php
			}

			$res = $timeQuery -> fetch();
			$office = $res["지점번호"];
			$sang = $res["상영관번호"];
			$adultPrice = $res["성인단가"];
			$teenPrice = $res["청소년단가"];

			$seatRowQuery = $DB->query("select distinct 좌석번호_행 from 좌석 where 상영관번호= '$sang'");
			foreach ($seatRowQuery as $i) {
				$row = $i['좌석번호_행']; ?>
				<div class="row">
					<p><?= $row ?></p>
					<div class= "rowSeat" id="<?= $row ?>">
					<?php
   				$seatColQuery = $DB->query("select 좌석번호_열 from 좌석 where 상영관번호= '$sang' and 좌석번호_행 = '$row'");
					foreach ($seatColQuery as $j) { ?>
						<input type="button" class= "seat" id="<?= $row ?><?= $j['좌석번호_열'] ?>" value="<?= $j['좌석번호_열'] ?>" onClick="javascript:selec('<?= $row ?><?= $j['좌석번호_열'] ?>')" />
						<?php
 					}?>
					</div>
				</div>
				<?php
 			}
			$str = "select 좌석번호_열,좌석번호_행 from 예매,품목 where 예매.예매번호=품목.예매번호 and 예매.상영정보번호 =" .$time. " and 품목.품목취소코드 = 'B'";
			$seatq = $DB->query($str);
			foreach ($seatq as $k) { ?>
			<script type="text/javascript">
				$(function(){
					var id = '#' + '<?php echo $k["좌석번호_행"] ?>' + '<?php echo $k["좌석번호_열"] ?>';
					$(id).attr('class','selcted');
					$(id).attr('onclick', '').unbind('click');
				});
			</script>
			<?php
			}?>
			<div id="payB">
				<button onclick="javascript:posting('<?= $time ?>',<?= $adultPrice ?>,<?= $teenPrice ?>)">확인</button>
				<!-- js will edit this -->
			</div>
		</div>
  </body>
</html>
