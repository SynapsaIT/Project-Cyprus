<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "cyprus";
$users_table = "users";
$personaldata_table = "personal_data";
$attachments_table = "attachments";
$emails_table = "emails";
//error_reporting(0);
// Create connection
$db = new mysqli($servername, $username, $password, $db_name);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
