<?php
include '../connection/connect.php';
include 'function/func.php';

$url = $_SERVER['REQUEST_URI'];
$menu = explode('/',$url);

if (isset($_SESSION['loginp'])) {
    if ($menu[3]!='' && $menu[3]!='login') {
        if (function_exists($menu[3])) {
            include 'context/header.php';
            $menu[3]();
            include 'context/footer.php';
        } else {
            error(); // Fonksiyon Bulunamadı
        }
    } else {
        include 'context/header.php';
        home(); // Karşılama Ekranı
        include 'context/footer.php';
    }
} else { login(); }
