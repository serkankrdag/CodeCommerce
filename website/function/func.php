<?php

function cikis() {
    session_destroy();
    echo '<script>window.location.href = "giris";</script>';
}

function error() {
    echo '
		<h1>Error</h1>
		';
}

function membersmenu($var1) { global $db; $id = $_SESSION["idu"];
    $siparislerim = ($var1 == 'siparislerim') ? 'class="active"' : '';
    $profilbilgi = ($var1 == 'profilbilgi') ? 'class="active"' : '';

    $members = $db->query("select * from members where id = '$id' limit 1")->fetch();
    echo
    '
    <div class="col-12 col-md-12 col-lg-4 col-xl-4 text-center miliods">
        <div class="d-block border rounded">
            <div class="dashboard_author px-2 py-5">
                <div class="dash_auth_thumb circle p-1 border d-inline-flex mx-auto mb-2">
                    <img src="../panel/assets/media/svg/avatars/001-boy.svg" class="img-fluid circle" width="100" alt="" />
                </div>
                <div class="dash_caption">
                    <h4 class="fs-md ft-medium mb-0 lh-1">'.$members["name"].'</h4>
                </div>
            </div>

            <div class="dashboard_author">
                <h4 class="px-3 py-2 mb-0 lh-2 gray fs-sm ft-medium text-muted text-uppercase text-left">Üye Panosu</h4>
                <ul class="dahs_navbar">
                    <li><a href="siparislerim" '.$siparislerim.'><i class="lni lni-shopping-basket mr-2"></i>Siparişlerim</a></li>
                    <li><a href="profilbilgi" '.$profilbilgi.'><i class="lni lni-user mr-2"></i>Profil bilgisi</a></li>
                    <li><a href="cikis"><i class="lni lni-power-switch mr-2"></i>Çıkış Yap</a></li>
                </ul>
            </div>

        </div>
    </div>
    ';
}

function breadcrump($var1,$var2, $var3) {
    echo
    '
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">'.$var1.'</a></li>
                            <li class="breadcrumb-item"><a href="#">'.$var2.'</a></li>
                            <li class="breadcrumb-item active" aria-current="page">'.$var3.'</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    ';
}

include 'include/home.php';
include 'include/product.php';
include 'include/category.php';
include 'include/login.php';
include 'include/myorder.php';
include 'include/profilinfo.php';
include 'include/about.php';
include 'include/concent.php';
include 'include/basket.php';
include 'include/siparis.php';