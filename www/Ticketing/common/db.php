<?php
$dbHost = "52.78.148.203";
$dbName = "movie";
$dbUser = "root";
$dbPass = "1234";

$db = new PDO("mysql:host={$dbHost};dbname={$dbName}; port=3306", $dbUser, $dbPass);
$db->exec("set names utf8");

session_start();

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
