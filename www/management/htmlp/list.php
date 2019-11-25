<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/layout2.css">
    <link rel="stylesheet" type="text/css" href="../css/list.css">
    <script src="../script/list.js" type="text/javascript"></script>
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
                    <li><a href="attenndance.php">근태관리</a></li>
                    <li><a href="floor.php">플로어업무</a></li>
                </ul>
            </li>
            <li >
                <img src="../image/store.png" width="50px" alt="store_icon" /> <span>시설관리</span> 
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
        if ( $_SESSION['DEP'] == "매니저"){
    ?>
            <div>
                <button onclick="addlist();">추가</button>
                <button onclick="editlist();">수정</button>
                <button onclick="deletelist();">삭제</button>
            </div>
    <?php
        }
    ?>
        
    <?php
        try {
            if ( $_SESSION['DEP'] == "매니저"){
                $db = new PDO("mysql:dbname=movie; host=13.125.252.255; port=3306", "root", "1234");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->query("set session character_set_connection=utf8;");
                $db->query("set session character_set_results=utf8;");
                $db->query("set session character_set_client=utf8;");

                $rows = $db->query("SELECT * FROM 직원관리");
                foreach ($rows as $row) {
                ?>
                <li>
                    <?= $row["사번"] ?>
                    <?= $row["이름"] ?>
                    <?= $row["부서"] ?>
                    <?= $row["생년월일"] ?>
                    <?= $row["전화번호"] ?>
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
    <div id="add">
        <form method="post" action="">
            <span>이름 : </span><input type="text" name="password" placeholder="이름"/><br>
            <span>부서 : </span><input type="text" name="department" placeholder="부서"/><br>
            <span>생년월일 : </span><input type="date" name="birth" placeholder="생일"/><br>
            <span>전화번호 : </span><input type="phone" name="phone" placeholder="전화번호"/><br>
            <span></span><input id="addbutton" type="submit" value="정보추가"/>
        </form>
    </div>

    <div id="edit">
        <form method="post" action="">
            <span>이름 : </span><input type="text" name="password" placeholder="이름"/><br>
            <span>부서 : </span><input type="text" name="department" placeholder="부서"/><br>
            <span>생년월일 : </span><input type="date" name="birth" placeholder="생일"/><br>
            <span>전화번호 : </span><input type="phone" name="phone" placeholder="전화번호"/><br>
            <span></span><input id="editbutton" type="submit" value="정보수정"/>
        </form>
    </div>

    <div id="delete">
        <form method="post" action="">
            <span>사번 : </span><input type="text" name="id" placeholder="사번"/><br>
            <span></span><input id="deletebutton" type="submit" value="정보삭제"/>
        </form>
    </div>

    </section>
</body>

</html>