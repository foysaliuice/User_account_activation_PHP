<?php
include 'lib/Session.php';
Session::init();
include 'lib/Database.php';
include 'helpers/Format.php';
spl_autoload_register(function($class){
include_once "classes/".$class.".php";
});
$db = new Database();
$fm = new Format();
$member_regi= new MemberRegi();
$member_login = new MemberLogin();
$submit_paper = new Paper();
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Member Portal</title>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container">
    <div class="card"></div>
    <div class="card">