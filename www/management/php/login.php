<?php


    session_start();


    try {
        $db = new PDO("mysql:dbname=movie; host=13.125.252.255; port=3306", "root", "1234");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->query("set session character_set_connection=utf8;");
        $db->query("set session character_set_results=utf8;");
        $db->query("set session character_set_client=utf8;");
        
        $id = $_POST['id'];
        $pw = $_POST['password'];
        $id = $db->quote($id);
        $row = "SELECT 사번, 이름 FROM 직원관리 WHERE 사번 = '$id'";

        ?>
        <script>
            alert("<?php echo "1234".$row['사번'].$row['이름'].$id.$pw; ?>");
        </script>
        <?php
        // if ($row["사번"] == $id) {
        //     if ($row["이름"] == $pw) {
        //         // $_SESSION['ID'] = $id;
        //         // $_SESSION['PW'] = $pw;
        //         header("Location: ../htmlp/home.php");
        //     }
        // }else {
        //     header("Location: ../htmlp/home.php");
        // }
    } catch (PDOException $ex) {
        ?>
        <p>Sorry, a database error occurred. Please try again later.</p>
        <p>(Error details: <?= $ex->getMessage() ?>)</p>
        <?php
    }
?>

