<?php
$conn = new mysqli('localhost', 'root', '', 'mydb');

if ($conn->connect_error) {
    die('Connection failed: '.$conn->connect_error);
}
/* echo '[core] Connected successfully'; */

error_reporting(0);
$og = $_SERVER['REQUEST_URI'];
session_start();
if (isset($_SESSION['user_id'])) {
    $user_a = $conn->query( "SELECT * FROM user WHERE user_id=$_SESSION[user_id]" );
    $user_q = $user_a->fetch_assoc();
}

$w = md5(time());

if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $site = 'https://';
} else {
    $site = 'http://';
}

$site .= $_SERVER['HTTP_HOST'];

$settings_a = $conn->query( "SELECT sitename, description, keywords FROM settings" );
$settings_q = $settings_a->fetch_assoc();

$sitename = $settings_q['sitename'];
$description = $settings_q['description'];
$keywords = $settings_q['keywords'];
