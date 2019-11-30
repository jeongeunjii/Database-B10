<?php
    session_start();
    session_destroy();
    header("Location: ../htmlp/login.php");
    exit;
?>