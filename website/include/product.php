<?php function urunDetay() { global $db; global $menu; $id = $menu['4']; global $setting; if (isset($_SESSION["idu"])) { $uyeid = $_SESSION["idu"]; } else { $uyeid = $_SESSION["uyeolmayanid"]; }
    $product = $db->query("select * from products where id = '$id' ")->fetch(); $categoriId = $product['category'];
    $categori = $db->query("select * from categories where id = '$categoriId' ")->fetch();
    $variants = $db->query("select * from variantoptions where productId = '$id'  limit 1")->fetch();


    if ($_POST) {
        if (isset($_POST['secenekler'])) {
            $secenek = count($_POST['secenekler']);
            $secenekdeger = json_encode($_POST['secenekler'], JSON_UNESCAPED_UNICODE);
            $secenekfiyat = $product['secenekfiyat'];
            $secenekekle = "secenekdeger = '$secenekdeger',";
            $secenekekle2 = "secenekfiyat = '$secenekfiyat',";
        } else {
            $secenek = 0;
            $secenekekle = '';
            $secenekekle2 = '';
        }

        if (isset($_POST['varyant'])) {
            $varyant = $_POST['varyant'];
            $varyantekle = "varyant = '$varyant',";
        } else {
            $varyantekle = '';
        }

        $adet = $_POST['adet'];

        $ekle = $db->exec("
            insert into basket set 
            secenek = '$secenek',
            $secenekekle
            $secenekekle2
            $varyantekle
            adet = '$adet',
            urunId = '$id',
            uyeId = '$uyeid'
        ");

        echo '<script>window.location.href = "sepet";</script>';
    }


    breadcrump('Anasayfa',$categori['name'],$product['name']); ?>

    <!-- ======================= Product Detail ======================== -->
    <form method="post">
    <section class="middle">
        <div class="container">
            <div class="row">

                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="sp-loading"><img src="../upload/products/<?=$product['picture']?>" alt=""><br>Resim Yükleniyor</div>
                    <div class="sp-wrap">
                        <?php if ($product['pictures'] != '') {
                            foreach (json_decode($product['pictures']) as $pictures) { ?>
                                <a href="../upload/products/<?=$pictures?>"><img src="../upload/products/<?=$pictures?>" alt=""></a>
                            <?php } ?>
                        <?php } else { ?>
                            <a href="../upload/products/<?=$product['picture']?>"><img src="../upload/products/<?=$product['picture']?>" alt=""></a>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="prd_details">

                        <?= $indirim = ($product['discountType'] == '1') ? '' : '<div class="prt_01 mb-2"><span class="text-success bg-light-success rounded px-2 py-1">İndirimde</span></div>';?>
                        <div class="prt_02 mb-3">
                            <h2 class="ft-bold mb-1"><?=$product['name']?></h2>
                            <div class="text-left">
                                <?php if ($product['discountType'] == '1') { ?>
                                    <div class="elis_rty"><span class="ft-bold theme-cl fs-md"><?=$product['price']?>.00 TL</span></div>
                                <?php } else { ?>
                                    <div class="elis_rty"><span class="text-muted ft-medium line-through mr-2"><?=$product['price']?>.00 TL</span><span class="ft-bold theme-cl fs-md"><?=$product['discountedPrice']?>.00 TL</span></div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="prt_03 mb-4">
                            <p><?=$product['description']?></p>
                        </div>

                        <?php if ($variants != '') { ?>
                            <div class="prt_04 mb-4">
                                <p class="d-flex align-items-center mb-0 text-dark ft-medium">Seçenekler:</p>
                                <div class="text-left pb-0 pt-2">
                                    <?php foreach (json_decode($product['optionUrun']) as $optionUrun) { ?>
                                        <label for="<?=$optionUrun?>">
                                            <input type="checkbox" id="<?=$optionUrun?>" name="secenekler[]" value="<?=$optionUrun?>">
                                            <?=$optionUrun?> <span class="ft-bold theme-cl fs-md">+ <?=$product['secenekfiyat']?> TL</span>
                                        </label><br>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="prt_04 mb-4">
                                <p class="d-flex align-items-center mb-0 text-dark ft-medium"><?=$variants['variantGroup']?>:</p>
                                <div class="text-left pb-0 pt-2">
                                    <?php foreach (json_decode($variants['variantContent']) as $key => $variant) { ?>
                                        <div class="form-check size-option form-option form-check-inline mb-2">
                                            <input class="form-check-input" type="radio" name="varyant" id="<?=$variant?>" value="<?=$variant?>">
                                            <label class="form-option-label" for="<?=$variant?>"><?=$variant?></label>
                                            <input type="hidden" name="varyantsonuc" value="<?=$variant?>">
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="prt_04 mb-4">
                            <p class="d-flex align-items-center mb-1">Kategori:<strong class="fs-sm text-dark ft-medium ml-1"><?=$categori['name']?></strong></p>
                            <p class="d-flex align-items-center mb-0">SKU:<strong class="fs-sm text-dark ft-medium ml-1"><?=$product['stockCode']?></strong></p>
                        </div>

                        <div class="prt_05 mb-4">
                            <div class="form-row mb-7">
                                <div class="col-12 col-lg-auto">
                                    <!-- Quantity -->
                                    <select name="adet" class="mb-2 custom-select">
                                        <option value="1" selected="">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-12 col-lg">
                                    <!-- Submit -->
                                    <button type="submit" class="btn btn-block custom-height bg-dark mb-2">
                                        <i class="lni lni-shopping-basket mr-2"></i>Sepete Ekle
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="prt_06">
                            <p class="mb-0 d-flex align-items-center">
                                <span class="mr-4">Sosyal Medya:</span>
                                <a target="_blank" class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted mr-2" href="https://<?=$setting['twitter']?>">
                                    <i class="fab fa-twitter position-absolute"></i>
                                </a>
                                <a target="_blank" class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted mr-2" href="https://<?=$setting['facebook']?>">
                                    <i class="fab fa-facebook-f position-absolute"></i>
                                </a>
                                <a target="_blank" class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted mr-2" href="https://<?=$setting['youtube']?>">
                                    <i class="fab fa-youtube position-absolute"></i>
                                </a>
                                <a target="_blank" class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted mr-2" href="https://<?=$setting['instagram']?>">
                                    <i class="fab fa-instagram position-absolute"></i>
                                </a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    </form>
    <!-- ======================= Product Detail End ======================== -->

    <!-- ======================= Similar Products Start ============================ -->
    <section class="middle pt-0">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h2 class="off_title">Benzer Ürünler</h2>
                        <h3 class="ft-bold pt-3">Eşleşen Ürünler</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="slide_items">

                        <?php $products = $db->query("select * from products where category = '$categoriId' order by id ASC limit 9")->fetchAll();
                        foreach($products as $key => $product) { ?>

                            <div class="single_itesm">
                                <div class="product_grid card b-0 mb-0">
                                    <?php $indirim = ($product['discountType'] == '1') ? '' : 'İndirimde';?>
                                    <div class="badge bg-success text-white position-absolute ft-regular ab-left text-upper"><?=$indirim?></div>
                                    <button class="snackbar-wishlist btn btn_love position-absolute ab-right"><i class="far fa-heart"></i></button>
                                    <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                            <a class="card-img-top d-block overflow-hidden" href="urunDetay"><img class="card-img-top" src="../upload/products/<?=$product['picture']?>" alt="..." style=""></a>
                                        </div>
                                    </div>
                                    <div class="card-footer b-0 p-3 pb-0 d-flex align-items-start justify-content-center">
                                        <div class="text-left">
                                            <div class="text-center">
                                                <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="urunDetay"><?=$product['name']?></a></h5>
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
    <!-- ======================= Similar Products Start ============================ -->

<?php }