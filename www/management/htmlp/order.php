<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../image/fav.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/s1.css">
    <link rel="stylesheet" type="text/css" href="../css/s2.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <link rel="stylesheet" type="text/css" href="../css/order.css">
    <script type="text/javascript" src="../script/order.js"></script>
    <title>10Jo</title>
</head>
<body>
    <header>
        <a href="attendance.php"><img src="../image/logo.png" alt="logo" /></a>
        
        <div id="login">
            <?php
                if (isset($_SESSION['ID'])){
                    echo "<p>( ".$_SESSION['ID']." / ".$_SESSION['PW']." / ".$_SESSION['DEP']." )</p>";
            ?>
                    <a href="../php/logout.php"><button class="button">Logout</button></a>
            <?php
                }
                else {
                    header("Location: ../htmlp/login.php");
                }
            ?>
        </div>
    </header>
    <input type="checkbox" id="menu_state" checked>
    <nav>
        <label for="menu_state"><img src="../image/menu.png" alt="menu_icon" /></label>
        <div id="fir_category">
            <ul> 
                <?php 
                    if ($_SESSION['DEP'] == "매니저") {
                ?>
                        <div class="category_name">직원관리</div>
                        <li><img src="../image/employee.png" alt="employee_icon" />
                            <a href="list.php">
                                직원목록
                            </a>
                        </li>
                        <li><img src="../image/attendance.png" alt="attendance_icon" />
                            <a href="attendance.php">
                                근태관리
                            </a>
                        <!--(직원용)<li><a href="attendance_emp.html"onclick="window.open(this.href, 'popup', 'width=300,height=300,location=no,status=no');">플로어업무</a></li>-->
                        </li>
                <?php
                    } else if ($_SESSION['DEP'] == "플로어") {
                ?>
                        <div class="category_name">근태및 업무</div>
                        <li><img src="../image/attendance.png" alt="attendance_icon" /><a href="attendance.php">
                            출근퇴근
                        </a></li>
                        <li><img src="../image/floor.png" alt="floor_icon" /><a href="floor.php">
                            플로어업무
                        </a></li>
                <?php
                    } else if ($_SESSION['DEP'] == "기술지원") {
                ?>
                        <div class="category_name">근태및 업무</div>
                        <li><img src="../image/attendance.png" alt="attendance_icon" /><a href="attendance.php">
                            출근퇴근
                        </a></li>
                        <li><img src="../image/engineer.png" alt="engineer_icon" /><a href="repair.php">
                            기술업무
                        </a></li>
                <?php
                    } else {
                ?>
                        <div class="category_name">근태및 업무</div>
                        <li><img src="../image/attendance.png" alt="attendance_icon" /><a href="attendance.php">
                            출근퇴근
                        </a></li>
                <?php
                    }
                ?>
                
                
                <!--(직원용)<li><a href="popup_floor_emp.html"onclick="window.open(this.href, 'popup', 'width=300,height=300,location=no,status=no');">플로어업무</a></li>-->
                
                <!--(직원용)<li><a href="popup_engineer_emp.html"onclick="window.open(this.href, 'popup', 'width=300,height=300,location=no,status=no');">기술업무</a></li>-->
                <!--기술업무, 플로어업무 직원용 페이지는 새 페이지 띄우는 것보다 팝업으로 하는 게 더 깔끔할 것 같아서 팝업으로 처리 했습니다!-->
            </ul>
        </div>
        <div id="sec_category">
            <ul> 
                <?php
                    if ($_SESSION['DEP'] == "매니저") {
                ?>
                        <div class="category_name">시설관리</div>
                        <li><img src="../image/clean.png" alt="clean_icon" /><a href="clean.php">
                            청결관리
                        </a></li>
                        <li><img src="../image/staffing.png" alt="staffing_icon" /><a href="technical.php">
                            설비관리
                        </a></li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </nav>
	<main>
		<section>
			<h2>주문발주</h2>
			<div id="container">
			<!-- <form method="POST" action=""> -->
			<div id="btn_search"><button class="button">검색</button></div>
			<!-- 테이블 입력칸에 input하고 검색버튼 누르면 그에 맞는 테이블만 출력 -->
			<table>
			<thead>
				<tr>
					<th>물품</th>
					<th>수량</th>
					<th>주문</th>
				</tr>
			</thead>
			<tbody>
				<!-- <tr>
					<td class="selec_td"><select name="물품">
						<option value="전체"></option>
						<option value="팝콘">팝콘</option>
						<option value="커피">커피</option>
						<option value="콜라">콜라</option>
						<option value="마운틴듀">마운틴듀</option>
						<option value="버터오징어">버터오징어</option>
					</select></td>
					<td><input type="text" name="수량" /></td>
					<td></td>
                </tr> -->
                <?php
                    $arr = array("매니저","매표소","청소","플로어","기술지원");
                    $found = array_search($_SESSION['DEP'], $arr);
                    try {
                        if ($_SESSION['DEP']=="매니저") {
                            $db = new PDO("mysql:dbname=movie; host=52.78.148.203; port=3306", "root", "1234");
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $db->query("set session character_set_connection=utf8;");
                            $db->query("set session character_set_results=utf8;");
                            $db->query("set session character_set_client=utf8;");

                            
                            $rows = $db->query("SELECT * FROM 물품주문
                            NATURAL JOIN 시설물");
                            foreach ($rows as $row) {
                            ?>
                                <tr>
                                    <td><?= $row["물품"] ?></td>
                                    <td><?= $row["주문량"] ?></td>
                                    <td></td>
                                </tr>
                            <?php
                            }
                        }
                        else if ($found === false){
                            $db = new PDO("mysql:dbname=movie; host=52.78.148.203; port=3306", "root", "1234");
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $db->query("set session character_set_connection=utf8;");
                            $db->query("set session character_set_results=utf8;");
                            $db->query("set session character_set_client=utf8;");

                            $rows = $db->query("SELECT * FROM 물품주문
                            NATURAL JOIN 시설물");
                            foreach ($rows as $row) {
                                if ($row['시설물명'] == $_SESSION['DEP'] ) {
                            ?>
                                <tr>
                                    <td><?= $row["물품"] ?></td>
                                    <td><?= $row["주문량"] ?></td>
                                    <td><button class="table_button" onclick="order();">주문</button></td>
                                </tr>
                            <?php
                                }
                            }
                        }
                    } catch (PDOException $ex) {
                ?>
                    <p>Sorry, a database error occurred. Please try again later.</p>
                    <p>(Error details:
                        <?= $ex->getMessage() ?>)</p>
                <?php
                    }
                ?>
    </main>
    <div id="order" style="display: none;">
        <form method="post" action="../php/order.php">
            <span>물품갯수 : </span><input type="text" name="quantity" placeholder="숫자입력"/><br>
            <input type="text" name="stuff" value="<?= $stuff ?>">
            <input id="orderbutton" type="submit" value="주문"/>
        </form>
    </div>
</body>

</html>