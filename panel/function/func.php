<?php

function logout() {
    session_destroy();
    echo '<script>window.location.href = "login";</script>';
}

function error() {
    echo '
		<!DOCTYPE html>
        <html lang="tr">
        <head>
            <title>Sesasoft Admin Panel</title>
            <meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
            <meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <meta charset="utf-8" />
            <meta property="og:locale" content="en_US" />
            <meta property="og:type" content="article" />
            <meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
            <meta property="og:url" content="https://keenthemes.com/metronic" />
            <meta property="og:site_name" content="Keenthemes | Metronic" />
            <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
            <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
            <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
        </head>
        <body id="kt_body" class="bg-body">
            <div class="d-flex flex-column flex-root">
                <div class="d-flex flex-column flex-center flex-column-fluid p-10">
                    <img src="assets/media/illustrations/sigma-1/18.png" alt="" class="mw-100 mb-10 h-lg-450px" />
                    <h1 class="fw-bold mb-10" style="color: #A3A3C7">Burada hiçbir şey yok gibi görünüyor</h1>
                    <a href="home" class="btn btn-primary">Panele Dön</a>
                </div>
            </div>
            <script>var hostUrl = "assets/";</script>
            <script src="assets/plugins/global/plugins.bundle.js"></script>
            <script src="assets/js/scripts.bundle.js"></script>
        </body>
        </html>
		';
}

function breadcrumb($var1,$var2,$var3) {
    echo
    '
    <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: 200px, lg: 300px}">
                <div class="container-xxl d-flex align-items-center justify-content-between" id="kt_header_container">
                    <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: #kt_content_container, lg: #kt_header_container}">
                        <h1 class="text-dark fw-bolder my-0 fs-2">'.$var1.'</h1>
                        <ul class="breadcrumb fw-bold fs-base my-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="../../demo7/dist/index.html" class="text-muted">'.$var2.'</a>
                            </li>
                            <li class="breadcrumb-item text-dark">'.$var3.'</li>
                        </ul>
                    </div>
                    <div class="d-flex d-lg-none align-items-center ms-n2 me-2">
                        <div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
                            <span class="svg-icon svg-icon-2x">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                                    <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                                </svg>
                            </span>
                        </div>
                        <a href="home" class="d-flex align-items-center">
                            <img alt="Logo" src="assets/media/logos/logo-demo7.svg" class="h-30px" />
                        </a>
                    </div>
                </div>
            </div>
    ';
}

include 'login.php';
include 'include/home.php';

include 'include/products/list.php';
include 'include/products/add.php';
include 'include/products/edit.php';

include 'include/categories/list.php';
include 'include/categories/add.php';
include 'include/categories/edit.php';

include 'include/brands/list.php';
include 'include/brands/add.php';
include 'include/brands/edit.php';

include 'include/variants/list.php';
include 'include/variants/add.php';
include 'include/variants/edit.php';

include 'include/coupon/list.php';
include 'include/coupon/add.php';
include 'include/coupon/edit.php';

include 'include/orders/list.php';
include 'include/orders/view.php';

include 'include/members/list.php';
include 'include/members/view.php';

include 'include/managers/list.php';
include 'include/managers/view.php';

include 'include/vehicles/settings.php';
include 'include/vehicles/banner.php';
include 'include/vehicles/advert.php';
include 'include/vehicles/about.php';
include 'include/vehicles/contact.php';