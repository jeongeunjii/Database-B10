<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css1/layout2.css">
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
            $db = new PDO("mysql:dbname=movie; host=13.125.252.255; port=3306", "root", "1234");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->query("set session character_set_connection=utf8;");
            $db->query("set session character_set_results=utf8;");
            $db->query("set session character_set_client=utf8;");

            date_default_timezone_set("Asia/Seoul");
            $today = date("Y-m-d");
            $q_today = $db->quote($today);
            $time = date("H:i:s"); 
            $q_time = $db->quote($time);

            $rows = $db->query("SELECT * FROM 근태관리 NATURAL JOIN 직원관리 WHERE 일자 = $q_today");
            $rows = $rows->fetchAll();
            
            if (count($rows) === 0) {
                $lists = $db->query("SELECT 사번 FROM 직원관리");
                $lists = $lists->fetchAll();
                foreach ($lists as $list) {
                    $num = $list['사번'];
                    $q_num = $db->quote($num);
                    $db->exec("INSERT INTO 근태관리 VALUE ($q_today, $q_num, NULL, NULL)");
                }
                $rows = $db->query("SELECT * FROM 근태관리 NATURAL JOIN 직원관리 WHERE 일자 = $q_today");
                $rows = $rows->fetchAll();
            }

            if ($_SESSION['DEP']=="매니저") {
                foreach ($rows as $row) {
                ?>
                <li>
                    <?=$row['일자']?>
                    <?=$row['이름']?>
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
                </li>
                <?php
                }
            } else {
                foreach ($rows as $row) {
                    if ($_SESSION['ID'] == $row['사번']) {
                ?>
                    <li>
                        <?=$row['일자']?>
                        <?=$row['이름']?>
                        <?php
                        if ($row['출근'] == NULL){
                        ?>
                            <form method="post" action="../php/gowork.php">
                                <input type="submit" value="출근" />
                            </form>
                        <?php
                        } else {
                        ?>
                            <?=$row['출근']?>
                        <?php
                        }

                        if ($row['퇴근'] == NULL){
                        ?>
                            <form method="post" action="../php/outwork.php">
                                <input type="submit" value="퇴근" />
                            </form>
                        <?php
                        }else{
                        ?>
                            <?=$row['퇴근']?>
                        <?php
                        }
                        ?>
                    </li>
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
    </section>

</body>

</html>