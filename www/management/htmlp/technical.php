<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css1/layout2.css">
    <script src="../script/technical.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../css1/technical.css">
    
    <title>10Jo</title>
</head>

<body>
    <header>
        <a href="home.php"><h1>10Jo</h1></a>
        <div id="login"><p>
            <?php
                if (isset($_SESSION['ID'])){
                    echo "( ".$_SESSION['ID']." / ".$_SESSION['PW']." / ".$_SESSION['DEP']." )";
            ?>
            </p><a href="../php/logout.php">Logout</a>
            <?php
                }
                else {
                    echo '<a href="login.php">login</a>';
                }
            ?>
        </div>
    </header>
    <section>
    <nav>
        <ul>
            <li>
                <img src="../image/employee.png" width="50px" alt="employee_icon" /> <span>직원관리</span>
                <ul>
                    <?php  
                    if ($_SESSION['DEP'] == "매니저") { 
                    ?>
                        <li><a href="list.php">직원목록</a></li>
                    <?php
                    }
                    ?>
                    <li><a href="attendance.php">근태관리</a></li>
                    <?php 
                    if ($_SESSION['DEP'] == "플로어") { ?>
                        <li><a href="floor.php">플로어업무</a></li>
                    <?php
                    }
                    ?>
                    <?php 
                    if ($_SESSION['DEP'] == "기술지원") { ?>
                        <li><a href="repair.php">정비업무</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </li>
            <li >
                <img src="../image/store.png" width="50px" alt="store_icon" /> <span>시설관리</span> 
                <ul>
                    <li><a href="order.php">주문발주</a></li>
                    <?php  
                    if ($_SESSION['DEP'] == "매니저") { 
                    ?>
                        <li><a href="technical.php">시설정비</a></li>
                        <li><a href="clean.php">청결관리</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </nav>
    <main>
    <?php
        try {
            if ( $_SESSION['DEP'] == "매니저"){
                $db = new PDO("mysql:dbname=movie; host=13.125.252.255; port=3306", "root", "1234");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->query("set session character_set_connection=utf8;");
                $db->query("set session character_set_results=utf8;");
                $db->query("set session character_set_client=utf8;");

                $rows = $db->query("SELECT * FROM 시설물관리
                NATURAL JOIN 시설물");
                foreach ($rows as $row) {
                ?>
                    <li>
                        <?= $row["시설물명"] ?>
                        <?= $row["점검시간"] ?>
                        <?= $row["점검상태"] ?>
                        <?php
                        if ( $row["점검상태"] == "정상") {
                        ?>
                            <form method="post" action="../php/needfix.php">
                            <input type="text" name="facility" value="<?=$row["시설물명"]?>" style="display: none;"/>
                            <input type="submit" value="수리필요"/>
                            </form>
                        <?php
                        } else if ( $row["점검상태"] == "접수완료") {
                        ?>
                            <button onclick="assign('<?=$row['시설물번호']?>')">배정</button>
                        <?php
                        } else {
                            $rows = $db->query("SELECT * FROM 시설물관리
                            NATURAL JOIN 시설물
                            NATURAL JOIN 직원관리");
                            foreach ($rows as $row) {
                            ?>
                                <?= $row["이름"] ?>
                            <?php
                            }
                        }
                        ?>
                    </li>
                <?php
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
    </section>
    
    <div id="assign" style="display: none;">
        <p>미배정 인원</p>
        <form method="post" action="../php/assign.php">
        <input id="facility" type="text" name="facility" value="" style="display: none;">
        <?php
            $rows = $db->query("SELECT * FROM 직원관리
            NATURAL JOIN 기술지원");
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
        <input type="submit" value="선택"/>
        </form>
    </div>
</body>

</html>