<?php

require_once 'config/conf.php';
require_once 'config/mysql.class.php';
global $db, $tasks;
session_start();

if(!isset($_SESSION['user']) || $_SESSION['user'] == ''){
  header("Location: error.php");
}

$user= $_SESSION['user'];
$sgid= $_POST['sgid'];
$sql = "INSERT INTO $tasks ('group_id','user_id' ) VALUES ('$sgid', '$user')";
$db->query($sql);
