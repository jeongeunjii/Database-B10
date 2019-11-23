<!-- <!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta
name="viewport" content="width=device-width, initial-scale=1.0"> <meta
http-equiv="X-UA-Compatible" content="ie=edge"> <title>Document</title> </head>
<body> </form> </body> </html> -->
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/layout2.css">
        <title>10Jo</title>
    </head>

    <body>
        <header>
            <h1>10Jo</h1>
        </header>

        <nav>
            <ul>
                <li>
                    <img src="../image/employee.png" width="50px" alt="employee_icon"/>직원관리
                    <ul>
                        <li>
                            <a href="list.php">직원목록</a>
                        </li>
                        <li>
                            <a href="attenndance.php">근태관리</a>
                        </li>
                        <li>
                            <a href="floor.php">플로어업무</a>
                        </li>
                    </ul>
                </li>
                <li >
                    <img src="../image/store.png" width="50px" alt="store_icon"/>
                    <span>시설관리</span>
                    <ul>
                        <li>
                            <a href="order.php">주문발주</a>
                        </li>
                        <li>
                            <a href="technical.php">시설정비</a>
                        </li>
                        <li>
                            <a href="clean.php">청결관리</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <main>
            <p>감</p>
            <form method="post" action="../php/login.php">
            <input type="text" name="id" placeholder="사번"/>
            <input type="text" name="password" placeholder="이름"/>
            <input type="submit" value="login"/>
        </main>
    </body>

</html>