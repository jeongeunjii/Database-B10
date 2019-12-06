<?php
    session_start();
    function removez($str) {
        if ($str[0] === '0') {
            $result = $str[1];
        }else{
            $result = $str;
        }
        return $result;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/s1.css">
    <link rel="stylesheet" type="text/css" href="../css/s2.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <link rel="stylesheet" type="text/css" href="../css/attendance.css">
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
            <h2>근태관리</h2>
            <div id="container">
            <?php
                if ($_SESSION['DEP'] == "매니저") {
            ?>
                    <form method="post" action="attendance.php" style="margin: 0px auto; width: 300px;">
                        <input type="date" name="day">
                        <button class="button">검색</button>
                        <!-- 테이블 입력칸에 input하고 검색버튼 누르면 그에 맞는 테이블만 출력 -->
                    </form>
            <?php
                }
            ?>
            <table>
                <thead>
                    <tr>
                        <th>이름</th>
                        <th>날짜</th>
                        <th>출근시간</th>
                        <th>퇴근시간</th>
                        <th>근무시간</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        try {
                            $db = new PDO("mysql:dbname=movie; host=52.78.148.203; port=3306", "root", "1234");
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $db->query("set session character_set_connection=utf8;");
                            $db->query("set session character_set_results=utf8;");
                            $db->query("set session character_set_client=utf8;");

                            date_default_timezone_set("Asia/Seoul");
                            $today = date("Y-m-d");
                            $q_today = $db->quote($today);
                            $time = date("H:i:s"); 
                            $q_time = $db->quote($time);


                            // #없는 날짜인 경우 날짜 추가
                            // $rows = $db->query("SELECT * FROM 근태관리 NATURAL JOIN 직원관리 WHERE 일자 = $q_today");
                            // $rows = $rows->fetchAll();
                            // if (count($rows) === 0) {
                            //     $lists = $db->query("SELECT 사번 FROM 직원관리");
                            //     $lists = $lists->fetchAll();
                            //     foreach ($lists as $list) {
                            //         $num = $list['사번'];
                            //         $q_num = $db->quote($num);
                            //         $db->exec("INSERT INTO 근태관리 VALUE ($q_today, $q_num, NULL, NULL)");
                            //     }
                            //     $rows = $db->query("SELECT * FROM 근태관리 NATURAL JOIN 직원관리 WHERE 일자 = $q_today");
                            //     $rows = $rows->fetchAll();
                            // }
                            
                            #직원이 중간에 추가된 경우 직원의 근태정보 생성
                            $members = $db->query("SELECT 사번 FROM 직원관리");
                            $members = $members->fetchAll();
                            foreach ($members as $member) {
                                $id = $member['사번'];
                                $id = $db->quote($id);
                                $lines = $db->query("SELECT * FROM 근태관리 NATURAL JOIN 직원관리 WHERE 일자 = $q_today AND 사번 = $id");
                                $lines = $lines->fetchAll();
                                if (count($lines) === 0) {
                                    $db->exec("INSERT INTO 근태관리 VALUE ($q_today, $id, NULL, NULL)");
                                }
                            }

                            $rows = $db->query("SELECT * FROM 근태관리 NATURAL JOIN 직원관리 WHERE 일자 = $q_today");
                            $rows = $rows->fetchAll();

                            if (isset($_POST['day'])) {
                                $today = $_POST['day'];
                                $q_today = $db->quote($today);
                                $rows = $db->query("SELECT * FROM 근태관리 NATURAL JOIN 직원관리 WHERE 일자 = $q_today");
                                $rows = $rows->fetchAll();
                            }
                            
                            if ($_SESSION['DEP']=="매니저") {
                                foreach ($rows as $row) {  
                                ?>
                                    <tr>
                                        <td><?=$row['이름']?></td>
                                        <td><?=$row['일자']?></td>
                                        <td>
                                            <?php
                                                if ($row['출근'] == NULL){
                                            ?>
                                                    -
                                            <?php
                                            }else{
                                            ?>
                                                <?=$row['출근']?>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row['퇴근'] == NULL){
                                            ?>
                                                    -
                                            <?php
                                            }else{
                                            ?>
                                                <?=$row['퇴근']?>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row['퇴근'] !== NULL && $row['출근'] !== NULL){
                                                $hour1 = removez(substr($row['퇴근'], 0, 2));
                                                $hour2 = removez(substr($row['출근'], 0, 2));
                                                $hour = (int)$hour1 - (int)$hour2;
                                                $minu1 = removez(substr($row['퇴근'], 3, 2));
                                                $minu2 = removez(substr($row['출근'], 3, 2));
                                                $minu = (int)$minu1 - (int)$minu2;
                                                if ($minu < 0) {
                                                    if ($hour == 0) {
                                                        $hour = 0;
                                                        $minu = 0;
                                                    }else {
                                                        $hour = $hour - 1;
                                                        $minu = $minu + 60;
                                                    }
                                                }
                                            // if ($hour < 10) {
                                            //     $h = "0";
                                            //     $h = $h.(string)$hour;
                                            // }
                                                if ($minu < 10) {
                                                    $m = "0".(string)$minu;
                                                }else {
                                                    $m = $minu;
                                                }
                                            
                                            ?>
                                                <?= "0".(string)$hour.":".$m ?>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                foreach ($rows as $row) {
                                    if ($_SESSION['ID'] == $row['사번']) {
                                ?>
                                    <tr>
                                        <td><?=$row['이름']?></td>
                                        <td><?=$row['일자']?></td>
                                        <td>
                                            <?php
                                            if ($row['출근'] === NULL){
                                            ?>
                                                <form method="post" action="../php/gowork.php">
                                                    <input class="table_button" type="submit" value="출근" />
                                                </form>
                                            <?php
                                            } else {
                                            ?>
                                                <?=$row['출근']?>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row['퇴근'] === NULL){
                                            ?>
                                                <form method="post" action="../php/outwork.php">
                                                    <input class="table_button" type="submit" value="퇴근" />
                                                </form>
                                            <?php
                                            }else{
                                            ?>
                                                <?=$row['퇴근']?>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>

                                        </td>
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
                </tbody>
            </table>
            </div>
        </section>
    </main>

</body>

</html>