<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>asdfcvdsf</p>
    <?php
        try {
            $db = new PDO("mysql:dbname=movie; host=13.125.252.255; port=3306", "root", "1234");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->query("set session character_set_connection=utf8;");
            $db->query("set session character_set_results=utf8;");
            $db->query("set session character_set_client=utf8;");
            //php 변수 쓸려면 
            //$title = $_GET["movietitle"];
            //$title = $db->quote($title);
            //$rows = $db->query("SELECT year FROM movies WHERE name = $title");
            $rows = $db->query("SELECT 청소일시, 시설물명 FROM 청결관리 c
            JOIN 시설물 s ON c.시설물번호 = s.시설물번호
            ");
            foreach ($rows as $row) {
                ?>
                <li> <?= $row["청소일시"] ?> <?= $row["시설물명"] ?></li>
                
                <?php
            }
        } catch (PDOException $ex) {
            ?>
            <p>Sorry, a database error occurred. Please try again later.</p>
            <p>(Error details: <?= $ex->getMessage() ?>)</p>
            <?php
        }
    ?>
    <p>asdfcvdsf</p>
</body>
</html>