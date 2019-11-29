<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<script src="selecMovie.js" type="text/javascript"></script>
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
		<title>select</title>
	</head>

	<body>
		<div class="wrap">
      <?php
			$today = date("Y-m-d");

      // 여기에 고른 지역번호, 지점번호, 날짜, 영화번호 저장
			if (isset($_GET["city"])) { $city = $_GET["city"]; }
			else { $city = ""; }
			if (isset($_GET["office"])) { $office = $_GET["office"]; }
			else { $office = ""; }
			if (isset($_GET["date"])) { $date = $_GET["date"]; }
			else { $date = ""; }
			if (isset($_GET["movie"])) { $movie = $_GET["movie"]; }
			else { $movie = ""; }

			function isEmpty($str) {
				if ($str == null || $str == "") { return true; }
				else { return false; }
			}

			function conlog($data){
    		echo "<script>console.log('" . $data . "');</script>";
			}

			$dbHost = "13.125.252.255";
			$dbName = "movie";
			$dbUser = "root";
			$dbPass = "1234";

			$DB = new PDO("mysql:host={$dbHost};dbname={$dbName}; port=3306", $dbUser, $dbPass);
			$DB->exec("set names utf8"); ?>

			<script type="text/javascript">
				var Dcity = '<?php echo $city ?>';
				var Doffice = '<?php echo $office ?>';
				var Ddate = '<?php echo $date ?>';
				var Dmovie = '<?php echo $movie ?>';
			</script>

      <div class="city">
				<?php
				$cityQuery = $DB->query("select distinct 지역명, 지역번호 from 지역");
				foreach ($cityQuery as $i) {
				$tmpCity = $i["지역번호"] ?>
					<input type='button' value=<?= $i["지역명"]?> onClick= "javascript:reload('<?= $tmpCity ?>','<?= '' ?>','<?= $date ?>','<?= $movie ?>');"/>
				<?php
				} ?>
			</div>

			<div class="office">
				<?php
				if (!isEmpty($city)) {
					$officeQuery = $DB->query("select 지점명, 지점번호 from 지점 where 지역번호 ='$city'");
					foreach ($officeQuery as $j) {
						$tmpoffice = $j["지점번호"] ?>
						<input type='button' value=<?= $j["지점명"] ?> onClick= "javascript:reload('<?= $city ?>','<?= $tmpoffice ?>','<?= $date ?>','<?= $movie ?>');"/>
						<?php
					}
				} ?>
			</div>

			<div class="date">
				<div id='currentMonth'>
					<!-- js will edit this section -->
				</div>
			</div>

			<div class="movie">
				<?php
				if (isEmpty($office) && isEmpty($date)) {
					$movienumQuery = $DB->query("select distinct 영화번호 from 영화상영정보 where 일자>='$today'");
				}
				elseif (!isEmpty($office) && isEmpty($date)) {
					$movienumQuery = $DB->query("select distinct 영화번호 from 영화상영정보 where 일자>='$today' and 지점번호 ='$office'");
				}
				elseif (isEmpty($office) && !isEmpty($date)) {
					$movienumQuery = $DB->query("select distinct 영화번호 from 영화상영정보 where 일자='$date'");
				}
				else {
					$movienumQuery = $DB->query("select distinct 영화번호 from 영화상영정보 where 일자='$date' and 지점번호 ='$office'");
				}

				if ($movienumQuery) {
					foreach ($movienumQuery as $k) {
						$tmpmovie = $k['영화번호'];
						$movieq = $DB->query("select 제목 from 영화 where 영화번호='$tmpmovie'");
						if ($movieq->rowCount() <= 0) {
							conlog("영화번호 : " .$tmpmovie. "번의 영화정보가 존재하지 않습니다.");
							continue;
							}
						$row = $movieq -> fetch(); ?>
						<input type='button' value='<?= $row["제목"] ?>' onClick= "javascript:reload('<?= $city ?>','<?= $office ?>','<?= $date ?>','<?= $tmpmovie ?>');"/>
						<?php
 					}
				} ?>
			</div>

			<div class="submit">
				<input type='button' value='확인' onClick= "javascript:next('<?= $office ?>','<?= $date ?>','<?= $movie ?>');"/>
			</div>
		</div>
  </body>
</html>
