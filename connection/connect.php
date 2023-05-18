<?php
$db = new PDO("mysql:host=localhost;dbname=ecomsoft", "root", "");
$db->exec("SET NAMES utf8");
$db->exec("SET CHARACTER SET utf8");
$db->exec("SET COLLATION_CONNECTION = 'utf8_general_ci'");
session_start();
?>