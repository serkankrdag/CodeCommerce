<?php function kategori() { global $db; global $menu; $id = $menu['4'];
    $products = $db->query("select * from products where category = '$id' and status = '1' ")->fetchAll();
    $categories = $db->query("select * from categories where status = '1' ")->fetchAll();
    $categori = $db->query("select * from categories where id = '$id' ")->fetch();
    breadcrump('Anasayfa','Kategoriler',$categori['name']); ?>

    <!-- ======================= Shop Style 1 ======================== -->
    <section class="bg-cover" style="background:url(../upload/categories/<?=$categori['picture']?>) no-repeat;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="text-center py-5 mt-3 mb-3">
                        <h1 class="ft-medium mb-3"><?=$categori['name']?></h1>
                        <ul class="shop_categories_list m-0 p-0">
                            <?php foreach ($categories as $category) { ?>
                                <li><a href="kategori/<?=$category['id']?>"><?=$category['name']?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Shop Style 1 ======================== -->

    <!-- ======================= All Product List ======================== -->
    <section class="middle">
        <div class="container">

            <div class="row align-items-center rows-products">

                <?php foreach ($products as $product) { ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                        <div class="product_grid card b-0">
                            <?php $indirim = ($product['discountType'] == '1') ? '' : 'İndirimde';?>
                            <div class="badge bg-success text-white position-absolute ft-regular ab-left text-upper"><?=$indirim?></div>
                            <div class="card-body p-0">
                                <div class="shop_thumb position-relative">
                                    <a class="card-img-top d-block overflow-hidden" href="urunDetay/<?=$product['id']?>"><img class="card-img-top" src="../upload/products/<?=$product['picture']?>" alt="..."></a>
                                </div>
                            </div>
                            <div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
                                <div class="text-left">
                                    <div class="text-left">
                                        <h5 class="fs-md mb-0 lh-1 mb-1"><a href="urunDetay/<?=$product['id']?>"><?=$product['name']?></a></h5>
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
    <!-- ======================= All Product List ======================== -->

<?php }