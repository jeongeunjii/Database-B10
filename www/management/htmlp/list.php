<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/s1.css">
    <link rel="stylesheet" type="text/css" href="../css/s2.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
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
                        <li><img src="../image/order.png" alt="order_icon" /><a href="order.php">
                            물건주문
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
                        <div class="category_name">시설관리/주문발주</div>
                        <li><img src="../image/order.png" alt="order_icon" /><a href="order.php">
                            주문발주
                        </a></li>
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
            <!-- <div class="btn_etc"><button class="button" onclick="addlist();">
                추가</button></div>
            <div class="btn_etc"><button class="button" onclick="deletelist();">
                삭제</button></div>
            <div class="btn_etc"><button class="button" onclick="editlist();">
                수정</button></div> -->
            <div class="btn_etc"><button class="button" onclick = "window.open('../html/popup_emp_edit.html', 'popup' , 'width=300,height=300,location=no,status=no');">
                수정</button></div>
            <div class="btn_etc"><button class="button" onclick = "window.open('../html/popup_emp_del.html', 'popup' , 'width=300,height=300,location=no,status=no');">
                삭제</button></div>
            <div class="btn_etc"><button class="button" onclick = "window.open('../html/popup_emp_add.html', 'popup' , 'width=300,height=300,location=no,status=no');">
                추가</button></div>


            <table>
                <thead>
                    <tr>
                        <th>사번</th>
                        <th>이름</th>
                        <th>부서</th>
                        <th>생년월일</th>
                        <th>전화번호</th>
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

                    $rows = $db->query("SELECT * FROM 직원관리 ORDER BY 부서");
                    foreach ($rows as $row) {
                ?>
                        <tr>
                            <td><?=$row["사번"]?></td>
                            <td><?= $row["이름"] ?></td>
                            <td><?= $row["부서"] ?></td>
                            <td><?= $row["생년월일"] ?></td>
                            <td><?= $row["전화번호"] ?></td>
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
 

    <div id="add">
        
    </div>

    <div id="edit">
        
    </div>

    <div id="delete">
        <form method="post" action="../php/deletelist.php">
            <span>사번 : </span><input type="text" name="id" placeholder="사번"/><br>
            <span></span><input id="deletebutton" type="submit" value="정보삭제"/>
        </form>
    </div>

</body>

</html>