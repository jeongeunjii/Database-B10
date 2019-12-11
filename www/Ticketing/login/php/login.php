<?php
  session_start();
  include "../../common/db.php";

  $id = $_POST["id"];
  $ps = $_POST["ps"];

  $test_ps = $db->query("select 비밀번호 from 회원 where 아이디 ='$id'");
  $row = $test_ps -> fetch();

  if ($test_ps && $id != null && $ps != null) {
    if ($test_ps->rowCount() > 0) {
      if ($row["비밀번호"] == $ps) {
        $_SESSION['customer_id'] = $id;
        replace('../../index.php');
      }
      else {
        echo "<script>alert(\"비밀번호가 올바르지 않습니다.\");</script>";
        replace('../login.php');
      }
    }
    else {
      echo "<script>alert(\"아이디가 존재하지 않습니다.\");</script>";
      replace('../login.php');
    }
  } 
  exit;  
?>
