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
    <link rel="stylesheet" type="text/css" href="../css/technical.css">
    <script type="text/javascript" src="../script/technical.js"></script>
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
            <h2>청결관리</h2>
            <div id="container">
            <!-- <form method="POST" action=""> -->
                <!-- <div id="btn_search"><button class="button">검색</button></div> -->
                <!-- 테이블 입력칸에 input하고 검색버튼 누르면 그에 맞는 테이블만 출력 -->
            <table>
                <thead>
                    <tr>
                        <th>시설명</th>
                        <th>청소일시</th>
                        <th>청결상태</th>
                        <th>직원배치</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <tr>
                        <td class="selec_td"><select name="시설명">
                            <option value="전체"></option>
                            <option value="카페">카페</option>
                            <option value="매점">매점</option>
                            <option value="여자화장실6F">여자화장실6F</option>
                            <option value="남자화장실6F">남자화장실6F</option>
                            <option value="여자화장실7F">여자화장실7F</option>
                            <option value="남자화장실7F">남자화장실7F</option>
                            <option value="여자화장실8F">여자화장실8F</option>
                            <option value="남자화장실8F">남자화장실8F</option>
                            <option value="1관">1관</option>
                            <option value="2관">2관</option>
                            <option value="3관">3관</option>
                            <option value="4관">4관</option>
                            <option value="5관">5관</option>
                            <option value="6관">6관</option>
                            <option value="7관">7관</option>
                            <option value="8관">8관</option>
                        </select></td>
                        <td><input type="text" name="청소일시" /></td>
                        <td class="selec_td2"><select name="청결상태">
                            <option value="전체"></option>
                            <option value="정상">정상</option>
                            <option value="청소필요">청소필요</option>
                        </select></td>
                        <td class="selec_td2"><select name="직원배치">
                            <option value="전체"></option>
                            <option value="배치가능">배치가능</option>
                            <option value="배치불가능">배치불가능</option>
                        </select></td>
                    </tr> -->
                    <?php
                        try {
                            $db = new PDO("mysql:dbname=movie; host=52.78.148.203; port=3306", "root", "1234");
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $db->query("set session character_set_connection=utf8;");
                            $db->query("set session character_set_results=utf8;");
                            $db->query("set session character_set_client=utf8;");

                            $rows = $db->query("SELECT * FROM 청결관리
                            NATURAL JOIN 시설물");
                            foreach ($rows as $row) {
                            ?>
                                <tr>
                                <td><?= $row["시설물명"] ?></td>
                                <td><?= $row["청소일시"] ?></td>
                                <td><?= $row["청결상태"] ?></td>
                                <?php
                                if ( $row["청결상태"] == "정상") {
                                ?>
                                    <td>
                                    <form method="post" action="../php/needclean.php">
                                    <input type="text" name="facility" value="<?=$row["시설물명"]?>" style="display: none;"/>
                                    <input class="table_button" type="submit" value="청소필요"/>
                                    </form></td>
                                <?php
                                } else if ( $row["청결상태"] == "접수완료") {
                                ?>
                                    <td>
                                    <button class="table_button" onclick="assign('<?=$row['시설물번호']?>')">배정</button>
                                    </td>
                                <?php
                                } else {
                                    $name = $row["시설물명"];
                                    $name = $db->quote($name);
                                    $rows = $db->query("SELECT * FROM 청결관리
                                    NATURAL JOIN 시설물
                                    NATURAL JOIN 직원관리
                                    WHERE 시설물명 = $name");
                                    foreach ($rows as $row) {
                                    ?>
                                        <td><?= $row["이름"] ?></td>
                                    <?php
                                    }
                                }
                                ?>
                                </tr>
                            <?php
                            }
                        } catch (PDOException $ex) {
                    ?>
                        <p>Sorry, a database error occurred. Please try again later.</p>
                        <p>(Error details:
                            <?= $ex->getMessage() ?>)</p>
                    <?php
                        }
                    ?>

                    <!-- <tr>
                        <td>1관</td>
                        <td>"</td>
                        <td>정상</td>
                        <td>
                            <button class="table_button" onclick = "window.open('popup_staffing.html', 'popup' , 'width=300,height=300,location=no,status=no');" />
                            배치</button></td>
                           //배치 가능한 직원만 배치 버튼 출력
                    </tr> -->
                </tbody>
            </table>
            <!-- </form> -->
            </div>
        </section>
	</main>

    <div id="assign" style="display: none;">
        <img id="plex" src="../image/logo.png" alt="logo" />
        <img id="X" src="../image/clear.svg" alt="X" onclick="windo();">
        <p>미배정 인원</p>
        <form method="post" action="../php/assign.php">
        <input id="facility" type="text" name="facility" value="" style="display: none;">
        <?php
            $rows = $db->query("SELECT * FROM 직원관리
            NATURAL JOIN floor업무관리");
            foreach ($rows as $row) {
                if ($row["시설물번호"] === NULL) {
                ?>
                    <label>
                    <input type="radio" name="num" value="<?= $row["사번"] ?>"/><?= $row["이름"] ?>
                    </label>
                <?php
                }
            }
        ?>
        <br>
        <input id="assignbutton" type="submit" value="선택"/>
        </form>
    </div>
</body>

</html>