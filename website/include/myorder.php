<?php function siparislerim() { global $db;

    if (isset($_SESSION['login'])) {
        $uyeId = $_SESSION["idu"];
        $orders = $db->query("select * from orders where uyeId = '$uyeId' order by id ASC")->fetchAll();

        breadcrump('Anasayfa','Üye Panel','Siparişlerim'); ?>

        <!-- ======================= Dashboard Detail ======================== -->
        <section class="middle">
            <div class="container">
                <div class="row align-items-start justify-content-between">

                    <?php membersmenu('siparislerim'); ?>

                    <div class="col-12 col-md-12 col-lg-8 col-xl-8 text-center">

                        <?php foreach ($orders as $order) { ?>
                        <div class="ord_list_wrap border mb-4 mfliud">
                            <div class="ord_list_head gray d-flex align-items-center justify-content-between px-3 py-3">
                                <div class="olh_flex">
                                    <h6 class="mb-0 ft-medium">#<?=$order['siparisNo']?></h6>
                                </div>
                                <div class="olh_flex">
                                    <h6 class="mb-0 ft-medium"><?=$order['tarih']?></h6>
                                </div>
                            </div>
                            <div class="ord_list_body text-left">

                                <?php foreach (json_decode($order['urunbilgi']) as $urungecis) {
                                    $urunbilgi = json_decode(json_encode($urungecis),true); $urunId = $urunbilgi['id'];
                                    $urun = $db->query("select * from products where id = '$urunId' limit 1")->fetch(); ?>
                                    <div class="row align-items-center justify-content-center m-0 py-4 br-bottom">
                                        <div class="col-xl-5 col-lg-5 col-md-5 col-12">
                                            <div class="cart_single d-flex align-items-start mfliud-bot">
                                                <div class="cart_selected_single_thumb">
                                                    <a href="#"><img src="../upload/products/<?=$urun['picture']?>" width="75" class="img-fluid rounded" alt=""></a>
                                                </div>
                                                <div class="cart_single_caption pl-3">
                                                    <h4 class="product_title fs-sm ft-medium mb-1 lh-1"><?=$urun['name']?></h4>
                                                    <h4 class="fs-sm ft-bold mb-0 lh-1">Adet: <?=$urunbilgi['adet']?></h4>
                                                    <h4 class="fs-sm ft-bold mb-0 lh-1"><?=$urun['discountedPrice']?>.00 TL</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-6">
                                            <p class="mb-1 p-0"><span class="text-muted">Durum</span></p>
                                            <div class="delv_status"><span class="ft-medium small text-warning bg-light-warning rounded px-3 py-1">Sipariş Verildi</span></div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-6">
                                            <p class="mb-1 p-0"><span class="text-muted">Sipariş Tarihi:</span></p>
                                            <h6 class="mb-0 ft-medium fs-sm"><?=$order['tarih']?></h6>
                                        </div>
                                    </div>

                                    <?php $price[] = $urun['discountedPrice'] * $urunbilgi['adet']; ?>
                                <?php } ?>
                            </div>
                            <?php $kupon = ($order['kupon'] == '') ? 0 : $order['kupon']; ?>
                            <?php $secenek = ($order['secenek'] == '') ? 0 : $order['secenek']; ?>
                            <div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3">
                                <div class="col-xl-12 col-lg-12 col-md-12 pr-0 py-2 olf_flex d-flex align-items-center justify-content-between">
                                    <div class="olf_flex_inner hide_mob"><p class="m-0 p-0"><span class="text-muted medium">Ekstra Ürünler Ve indirimler hesaplandığında</span></p></div>
                                    <div class="olf_inner_right"><h5 class="mb-0 fs-sm ft-bold">Toplam: <?=array_sum($price) + $secenek - $kupon?>.00 TL</h5></div>
                                </div>
                            </div>
                        </div>
                            <?php $price = array(); ?>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </section>
        <!-- ======================= Dashboard Detail End ======================== -->

    <?php } else {
        echo '<script>window.location.href = "giris";</script>';
    }
} ?>