<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<script src="script/time.js" type="text/javascript"></script>
		<title>db testing</title>
	</head>

	<body>
		<div class="wrap">
      <?php
			include "../common/db.php";

      // 앞의 페이지에서 고른 지점번호, 날짜 영화번호
			if (isset($_GET["office"])) { $office = $_GET["office"]; }
			else { arl("오류 : 잘못된 접근입니다."); replace("../index.html"); }
			if (isset($_GET["date"])) { $date = $_GET["date"]; }
			else { arl("오류 : 잘못된 접근입니다."); replace("../index.html"); }
			if (isset($_GET["movie"])) { $movie = $_GET["movie"]; }
			else { arl("오류 : 잘못된 접근입니다."); replace("../index.html"); }

			$sangyoungganQuery = $db->query("select 상영관번호, 상영관명, 좌석수,상영관종류코드 from 상영관 where 지점번호= '$office'");

			foreach ($sangyoungganQuery as $i) {
				$sang = $i["상영관번호"];
				$str = "select 상영정보번호,영화시작시간 from 영화상영정보 where 지점번호= " . $office . " and 상영관번호 = '" .$sang. "' and  일자= '" .$date. "' and 영화번호= " .$movie;
				$timeQuery = $db->query($str);

				if ($timeQuery->rowCount() > 0) {

					$code = $i["상영관종류코드"];
					$codeQuery = $db->query("select 코드값 from 서브코드 where 메인코드 = 'A' and 서브코드 = '$code'");
					$codeValue = $codeQuery-> fetch(); ?>
					<div class = "<?= $sang ?>" >
						<p><?= $codeValue["코드값"] ?> <?= $i["상영관명"] ?> (총 <?= $i["좌석수"] ?>석)</p>

					<?php
					// 예매 정보를 참조하여 남은 좌석 수를 계산합니다.
					foreach ($timeQuery as $j) {
						$time = $j["상영정보번호"];
						$yemeQuery = $db->query("select count(*) from 예매,품목 where 예매.예매번호=품목.예매번호 and 예매.상영정보번호 = '$time' and 품목.품목취소코드 = 'B'");
						$selctedSeat = $yemeQuery-> fetch();
						$left_seat = $i["좌석수"] - $selctedSeat["count(*)"]; ?>
						<div class="<?= $time ?>" >
							<input type='button' value='<?= $j["영화시작시간"] ?>' onClick="javascript:next('<?= $time ?>');" />
							<p><?= $left_seat ?></p>
						</div>
						<?php
					} ?>
					</div>
					<?php
				}
			} ?>
		</div>
  </body>
</html>
