<?php
  include "../../common/db.php";

  $id = $_POST["id"];
  $ps = $_POST["ps"];
  $laName = $_POST["laName"];
  $fiName = $_POST["fiName"];
  $birth = (string)$_POST["year"] . "-" . (string)$_POST["mon"] . "-" . (string)$_POST["day"];
  $hp = $_POST["hp"];

  $test_ps = $db->query("select 아이디 from 회원 where 아이디 ='$id'");
  if ($test_ps->rowCount() > 0) {
    arl("오류 : 중복된 아이디 입니다.");
    replace('join.php');
  }
  else if (!isEmpty($id) && !isEmpty($ps) && !isEmpty($laName) && !isEmpty($fiName) && !isEmpty($birth) && !isEmpty(hp)) {
    $join = $db->query("insert into 회원 (아이디,비밀번호,이름_성,이름_이름,생일,전화번호) values('$id','$ps','$laName','$fiName','$birth','$hp')");
    replace('../index.php');
  }
  exit;
 ?>
