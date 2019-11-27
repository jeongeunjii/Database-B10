<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css1/popup.css">
    <title>10Jo</title>
</head>

<body>
    <header>
        <h1>10Jo</h1>
        <div id="login"></div>
    </header>
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

</body>

</html>