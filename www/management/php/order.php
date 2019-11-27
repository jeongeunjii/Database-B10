<?php
    session_start();
?>

<?php
    try {
        $db = new PDO("mysql:dbname=movie; host=13.125.252.255; port=3306", "root", "1234");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->query("set session character_set_connection=utf8;");
        $db->query("set session character_set_results=utf8;");
        $db->query("set session character_set_client=utf8;");
        
        $stuff = $_POST['stuff'];
        $q_stuff = $db->quote($stuff);

        $check = "UPDATE 물품주문
        SET 주문량 = $q_stuff,
        WHERE 물품 = $q_stuff";
        $db->exec($check);

        header("Location: ../htmlp/floor.php");
        // echo "<pre>";
        // var_dump($result[0]);
        // echo "</pre>";

    } catch (PDOException $ex) {
        ?>
        <p>Sorry, a database error occurred. Please try again later.</p>
        <p>(Error details: <?= $ex->getMessage() ?>)</p>
        <?php
    }
    exit;
?>