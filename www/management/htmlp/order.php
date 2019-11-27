<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/layout2.css">
        <link rel="stylesheet" type="text/css" href="../css/order.css">
        <script src="../script/order.js" type="text/javascript"></script>
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
                        <img src="../image/employee.png" width="50px" alt="employee_icon"/> <span>직원관리</span> 
                        <ul>
                            <li><a href="list.php">직원목록</a></li>
                            <li><a href="attendance.php">근태관리</a></li>
                            <li><a href="floor.php">플로어업무</a></li>
                            <li><a href="repair.php">정비업무</a></li>
                        </ul>
                    </li>
                    <li >
                        <img src="../image/store.png" width="50px" alt="store_icon"/> <span>시설관리</span>
                        <ul>
                            <li><a href="order.php">주문발주</a></li>
                            <li><a href="technical.php">시설정비</a></li>
                            <li><a href="clean.php">청결관리</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <main>
            <?php
                $arr = array("매니저","매표소","청소","플로어","기술지원");
                $found=array_search($_SESSION['DEP'], $arr);
                try {
                    if ($_SESSION['DEP']=="매니저") {
                        $db = new PDO("mysql:dbname=movie; host=13.125.252.255; port=3306", "root", "1234");
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $db->query("set session character_set_connection=utf8;");
                        $db->query("set session character_set_results=utf8;");
                        $db->query("set session character_set_client=utf8;");

                        $rows = $db->query("SELECT * FROM 물품주문
                        NATURAL JOIN 시설물");
                        foreach ($rows as $row) {
                        ?>
                            <li>
                                <?= $row["물품"] ?>
                                <?= $row["주문량"] ?>
                            </li>
                        <?php
                        }
                    }
                    else if ($found === false){
                        $db = new PDO("mysql:dbname=movie; host=13.125.252.255; port=3306", "root", "1234");
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $db->query("set session character_set_connection=utf8;");
                        $db->query("set session character_set_results=utf8;");
                        $db->query("set session character_set_client=utf8;");

                        $rows = $db->query("SELECT * FROM 물품주문
                        NATURAL JOIN 시설물");
                        foreach ($rows as $row) {
                            if ($row['시설물명'] == $_SESSION['DEP'] ) {
                        ?>
                                
                                <li>
                                    <?= $row["물품"] ?>
                                    <?= $row["주문량"] ?>
                                    <button onclick="order();">주문</button>
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
                <div id="order" style="display: none;">
                    <form method="post" action="../php/order.php">
                        <span>물품갯수 : </span><input type="text" name="quantity" placeholder="숫자입력"/><br>
                        <input type="text" name="stuff" value="<?= $stuff ?>">
                        <input id="orderbutton" type="submit" value="주문"/>
                    </form>
                </div>
            </main>
        </section>
    </body>

</html>