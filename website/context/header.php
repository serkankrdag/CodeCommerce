<?php $setting = $db->query("select * from settings where id = '1' limit 1")->fetch(); if (empty($_SESSION["uyeolmayanid"])) { $_SESSION["uyeolmayanid"] = rand(); } ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <base href="http://localhost/ecomsoft/website/">
    <meta charset="utf-8" />
    <meta name="author" content="<?=$setting['shopName']?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?=$setting['metaKeywords']?>">
    <meta name="description" content="<?=$setting['metaDescription']?>">
    <link rel="icon" href="../upload/settings/<?=$setting['favicon']?>">

    <title><?=$setting['metaTitle']?></title>
    <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>
<div class="preloader"></div>
<div id="main-wrapper">
    <div class="header header-light dark-text">
        <div class="container">
            <nav id="navigation" class="navigation navigation-landscape">
                <div class="nav-header">
                    <a class="nav-brand" href="#">
                        <img src="../upload/settings/<?=$setting['logo']?>" class="logo" alt="" />
                    </a>
                    <div class="nav-toggle"></div>
                    <div class="mobile_nav">
                        <ul>
                            <li>
                                <a href="giris">
                                    <i class="lni lni-user"></i>
                                </a>
                            </li>
                            <li>
                                <a href="sepet">
                                    <i class="lni lni-shopping-basket"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="nav-menus-wrapper" style="transition-property: none;">
                    <ul class="nav-menu">

                        <li><a href="javascript:void(0);">Kategoriler</a>
                            <ul class="nav-dropdown nav-submenu">
                                <?php $categories = $db->query("select * from categories order by id ASC")->fetchAll();
                                foreach($categories as $category) { ?>
                                    <li><a href="kategori/<?=$category['id']?>"><?=$category['name']?></a></li>
                                <?php } ?>
                            </ul>
                        </li>

                        <li><a href="javascript:void(0);">Pages</a>
                            <ul class="nav-dropdown nav-submenu">
                                <li><a href="hakkimizda">Hakkımızda</a></li>
                                <li><a href="iletisim">İletişim</a></li>
                            </ul>
                        </li>

                    </ul>

                    <ul class="nav-menu nav-menu-social align-to-right">
                        <li>
                            <a href="giris" >
                                <i class="lni lni-user"></i>
                            </a>
                        </li>
                        <li>
                            <a href="sepet">
                                <i class="lni lni-shopping-basket"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="clearfix"></div>