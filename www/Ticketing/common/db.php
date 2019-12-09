<?php
$dbHost = "52.78.148.203";
$dbName = "movie";
$dbUser = "root";
$dbPass = "1234";

$db = new PDO("mysql:host={$dbHost};dbname={$dbName}; port=3306", $dbUser, $dbPass);
$db->query("set session character_set_connection=utf8;");
$db->query("set session character_set_results=utf8;");
$db->query("set session character_set_client=utf8;");
$db->exec("set names utf8");

date_default_timezone_set("Asia/Seoul");
$today = date("Y-m-d");

function isEmpty($str) {
  if ($str == null || $str == "") { return true; }
  else { return false; }
}

function conlog($data){
  echo "<script>console.log('" . $data . "');</script>";
}

function replace($url){
  echo "<script>location.replace('" .$url. "')</script>";
}

function arl($msg){
  echo "<script>alert('" .$msg. "');</script>";
}

?>
