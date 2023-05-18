<?php function anasayfa() { global $db; global $setting;
    $banner = $db->query("select * from banner where id = '1' limit 1")->fetch(); ?>

    <!-- ======================= Category Style 1 ======================== -->
    <section class="p-0">
        <div class="container-fluid p-0">
            <div class="row no-gutters">

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <a href="#" class="card card-overflow card-scale no-radius mb-0">
                        <div class="bg-image" style="background:url(../upload/banner/<?=$banner['banner1']?>)no-repeat;" data-overlay="2"></div>
                        <div class="ct_body">
                            <div class="ct_body_caption">
                                <h1 class="mb-0 ft-bold text-light"></h1>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <a href="#" class="card card-overflow card-scale no-radius mb-0">
                        <div class="bg-image" style="background:url(../upload/banner/<?=$banner['banner2']?>)no-repeat;" data-overlay="2"></div>
                        <div class="ct_body">
                            <div class="ct_body_caption">
                                <h1 class="mb-0 ft-bold text-light"></h1>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <a href="#" class="card card-overflow card-scale no-radius mb-0">
                        <div class="bg-image" style="background:url(../upload/banner/<?=$banner['banner3']?>)no-repeat;" data-overlay="2"></div>
                        <div class="ct_body">
                            <div class="ct_body_caption">
                                <h1 class="mb-0 ft-bold text-light"></h1>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>
    <!-- ======================= Category Style 1 ======================== -->

    <!-- ======================= Product List ======================== -->
    <section class="space min">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h2 class="off_title">Trend Ürünler</h2>
                        <h3 class="ft-bold pt-3">Trend Olan Ürünlerimiz</h3>
                    </div>
                </div>
            </div>

            <div class="row align-items-center rows-products">

                <?php $products = $db->query("select * from products where status = '1' order by id ASC limit 40")->fetchAll();
                    foreach($products as $key => $product) {
                        $id = $product['id']; ?>

                    <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                        <div class="product_grid card b-0">
                            <?php $indirim = ($product['discountType'] == '1') ? '' : 'İndirimde';?>
                            <div class="badge bg-success text-white position-absolute ft-regular ab-left text-upper"><?=$indirim?></div>
                            <button class="btn btn_love position-absolute ab-right snackbar-wishlist"><i class="far fa-heart"></i></button>
                            <div class="card-body p-0">
                                <div class="shop_thumb position-relative">
                                    <a class="card-img-top d-block overflow-hidden" href="urunDetay/<?=$product['id']?>"><img class="card-img-top" src="../upload/products/<?=$product['picture']?>" alt="..." style=""></a>
                                </div>
                            </div>
                            <div class="card-footers b-0 pt-3 px-2 bg-white d-flex align-items-start justify-content-center">
                                <div class="text-left">
                                    <div class="text-center">
                                        <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="urunDetay/<?=$product['id']?>"><?=$product['name']?></a></h5>
                                        <?php if ($product['discountType'] == '1') { ?>
                                            <div class="elis_rty"><span class="ft-bold theme-cl fs-md"><?=$product['price']?>.00 TL</span></div>
                                        <?php } else { ?>
                                            <div class="elis_rty"><span class="text-muted ft-medium line-through mr-2"><?=$product['price']?>.00 TL</span><span class="ft-bold theme-cl fs-md"><?=$product['discountedPrice']?>.00 TL</span></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>

        </div>
    </section>
    <!-- ======================= Product List ======================== -->

    <!-- ======================= Deals of The Day ====================== -->
    <?php $advert = $db->query("select * from advert where id = '1' limit 1")->fetch(); ?>

    <section class="bg-cover" style="background:url(../upload/advert/<?=$advert['picture']?>) no-repeat;" data-overlay="5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-9 col-md-12 col-sm-12">

                    <div class="deals_wrap text-center">
                        <h2 class="ft-bold text-light"><?=$advert['title']?></h2>
                        <p class="text-light"><?=$advert['description']?></p>
                        <div class="mt-5">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Deals of The Day ====================== -->

    <!-- ======================= Good Deals Start ============================ -->
    <section class="space gray">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h2 class="off_title">İndirim fırsatları</h2>
                        <h3 class="ft-bold pt-3">Günün Fırsatları</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="slide_items">

                        <?php $products = $db->query("select * from products where discountType != '1' and status = '1' order by id ASC limit 9")->fetchAll();
                            foreach($products as $key => $product) { ?>

                            <div class="single_itesm">
                                <div class="product_grid card b-0 mb-0">
                                    <?php $indirim = ($product['discountType'] == '1') ? '' : 'İndirimde';?>
                                    <div class="badge bg-success text-white position-absolute ft-regular ab-left text-upper"><?=$indirim?></div>
                                    <button class="snackbar-wishlist btn btn_love position-absolute ab-right"><i class="far fa-heart"></i></button>
                                    <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                            <a class="card-img-top d-block overflow-hidden" href="urunDetay/<?=$product['id']?>"><img class="card-img-top" src="../upload/products/<?=$product['picture']?>" alt="..." style=""></a>
                                        </div>
                                    </div>
                                    <div class="card-footer b-0 p-3 pb-0 d-flex align-items-start justify-content-center">
                                        <div class="text-left">
                                            <div class="text-center">
                                                <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="urunDetay/<?=$product['id']?>"><?=$product['name']?></a></h5>
                                                <div class="elis_rty"><span class="text-muted ft-medium line-through mr-2"><?=$product['price']?>.00 TL</span><span class="ft-bold theme-cl fs-md"><?=$product['discountedPrice']?>.00 TL</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- ======================= Good Deals Start ============================ -->

<?php }