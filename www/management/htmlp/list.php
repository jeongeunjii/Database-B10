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
    <link rel="stylesheet" type="text/css" href="../css/list.css">
    <script type="text/javascript" src="../script/list.js"></script>
    <title>10Jo</title>
</head>

<body>
    <header>
        <a href="attendance.php"><img src="../image/logo.png" alt="logo" /></a>
        
        <div id="login">
            <?php
                if ( ($_SESSION['ID'])){
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
            <h2>직원목록</h2>
            <div id="container">
            
            <!-- 테이블 입력칸에 input하고 검색버튼 누르면 그에 맞는 테이블만 출력 -->
            <div class="btn_etc"><button class="button" onclick="addlist();">
                추가</button></div>
            <div class="btn_etc"><button class="button" onclick="deletelist();">
                삭제</button></div>
            <div class="btn_etc"><button class="button" onclick="editlist();">
                수정</button></div>
            <!-- <div class="btn_etc"><button class="button" onclick = "window.open('../html/popup_emp_edit.html', 'popup' , 'width=300,height=300,location=no,status=no');">
                수정</button></div>
            <div class="btn_etc"><button class="button" onclick = "window.open('../html/popup_emp_del.html', 'popup' , 'width=300,height=300,location=no,status=no');">
                삭제</button></div>
            <div class="btn_etc"><button class="button" onclick = "window.open('../html/popup_emp_add.html', 'popup' , 'width=300,height=300,location=no,status=no');">
                추가</button></div> -->


            <table>
                <thead>
                    <tr>
                        <th>사번</th>
                        <th>이름</th>
                        <th>부서</th>
                        <th>생년월일</th>
                        <th>전화번호</th>
                        <th></th>
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

                    #상세정보 배열
                    $rows = $db->query("SELECT * FROM 직원관리");
                    $idset = array( array() );
                    $index=0;
                    $arrive=0;
                    $late=0;
                    foreach ($rows as $row) {
                        $idset[$index][0] = $row['사번'];
                        $idset[$index][1] = $row['이름'];
                        $index = $index+1;
                    }
                    for ($i=0; $i < count($idset); $i++) {
                        $num = $idset[$i][0];
                        $num = $db->quote($num);
                        $lines = $db->query("SELECT * FROM 근태관리 WHERE 사번=$num");
                        foreach($lines as $line) {
                            if ($line['출근'] !== NULL){
                                $hour = removez(substr($line['출근'], 0, 2));
                                if ($hour < 9) {
                                    $arrive = $arrive + 1;
                                }else {
                                    $late = $late + 1;
                                }
                            }
                        }
                        $idset[$i][2] = $arrive;
                        $idset[$i][3] = $late; 
                        $arrive = 0;
                        $late = 0;
                    }

                    for ($i=0; $i < count($idset); $i++) {
                        $num = $idset[$i][0];
                        $num = $db->quote($num);
                        $lines = $db->query("SELECT * FROM 직원관리 WHERE 사번=$num");
                        $lines = $lines->fetchAll();
                        foreach ($lines as $line){
                            if ($lines[0]['부서'] == "플로어") {
                                $floors = $db->query("SELECT * FROM floor업무관리 NATURAL JOIN 시설물 WHERE 사번=$num");
                                $floors = $floors->fetchAll();
                                if (count($floors) == 0) {
                                    $idset[$i][4] = 'NO';
                                }else {
                                    $idset[$i][4] = $floors[0]['시설물명'].' 청소중';
                                }
                            }else if ($lines[0]['부서'] == "기술지원") {
                                $techs = $db->query("SELECT * FROM 기술지원 NATURAL JOIN 시설물 WHERE 사번=$num");
                                $techs = $techs->fetchAll();
                                if (count($techs) == 0) {
                                    $idset[$i][4] = 'NO';
                                }else {
                                    $idset[$i][4] = $techs[0]['시설물명'].' 수리중';
                                }
                            } else {
                                $idset[$i][4] = "NO staff";
                            }
                        }
                    }
                    
                    $rows = $db->query("SELECT * FROM 직원관리 ORDER BY 부서");
                    $input = str_replace("\"","'",json_encode($idset, JSON_UNESCAPED_UNICODE));
                    foreach ($rows as $row) {
                ?>
                        <tr>
                            <td><?=$row["사번"]?></td>
                            <td><?= $row["이름"] ?></td>
                            <td><?= $row["부서"] ?></td>
                            <td><?= $row["생년월일"] ?></td>
                            <td><?= $row["전화번호"] ?></td>
                            <td><button class="table_button" onclick="showinfo( '<?=$row['사번']?>', <?=$input?> );">상세정보</button></td>
                        </tr>
                <?php
                    }
                    
                } catch (PDOException $ex) {
                ?>
                    <p>Sorry, a database error occurred. Please try again later.</p>
                    <p>(Error details: <?= $ex->getMessage() ?>)</p>
                <?php
                    }
                ?>		
                </tbody>
            </table>
        </div>
        </section>
    </main>

    <div id="delete" style="display=none;">
        <img id="plex" src="../image/logo.png" alt="logo" />
        <img id="X" src="../image/clear.svg" alt="X" onclick="deletelist();">
        <form method="post" action="../php/deletelist.php">
            <span>사번 : </span><input type="text" name="id" placeholder="사번"/><br>
            <input id="deletebutton" type="submit" value="정보삭제"/>
        </form>
    </div>

    <div id="edit" style="display=none;">
        <img id="plex" src="../image/logo.png" alt="logo" />
        <img id="X" src="../image/clear.svg" alt="X" onclick="editlist();">
        <form method="post" action="../php/editlist.php">
            <input type="text" name="id" placeholder="사번"/><br>
            <input type="text" name="name" placeholder="이름"/><br>
            <input type="text" name="department" placeholder="부서"/><br>
            <input type="date" name="birth" placeholder="생일"/><br>
            <input type="phone" name="phone" placeholder="전화번호"/><br>
            <input id="editbutton" type="submit" value="정보수정"/>
        </form>
    </div>

    <div id="add" style="display=none;">
        <img id="plex" src="../image/logo.png" alt="logo"/>
        <img id="X" src="../image/clear.svg" alt="X" onclick="addlist();">
        <form method="post" action="../php/addlist.php">
            <input type="text" name="name" placeholder="이름"/><br>
            <input type="text" name="department" placeholder="부서"/><br>
            <input type="date" name="birth" placeholder="생일"/><br>
            <input type="phone" name="phone" placeholder="전화번호"/><br>
            <input id="addbutton" type="submit" value="정보추가"/>
        </form>
    </div>

    <div id="info" style="display=none;">
        <img id="plex" src="../image/logo.png" alt="logo"/>
        <img id="X" src="../image/clear.svg" alt="X" onclick="windo();">
        <p id="p1"></p>
        <p id="p2"></p>
        <p id="p3"></p>
        <p id="p4"></p>
    </div>



</body>

</html>