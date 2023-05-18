<?php function siparis() { global $db; if (isset($_SESSION["idu"])) { $uyeid = $_SESSION["idu"]; } else { $uyeid = $_SESSION["uyeolmayanid"]; }

    $sepetkontrolu = $db->query("select * from basket where uyeId = '$uyeid' limit 1")->fetch();

    if (isset($sepetkontrolu)) {
        if (isset($sepetkontrolu['id'])) {



    $sorgu = '';
    if ($_POST) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $adres = $_POST['adres'];
        $numara = $_POST['numara'];
        $siparisnot = $_POST['siparisnot'];

        if ($name != '' && $email != '' && $adres != '' && $numara != '') {

            $sepets = $db->query("select * from basket where uyeId = '$uyeid' order by id ASC")->fetchAll();
            foreach ($sepets as $sepet) {
                $sepetid = $sepet['id'];
                $toplamkupon = $sepet['kupon'];
                $toplamuyeId = $sepet['uyeId'];
                $toplamadet = $sepet['adet'];
                $toplamurunid = $sepet['urunId'];

                if ($sepet['secenek']!='0') {
                    foreach (json_decode($sepet['secenekdeger']) as $secenekgecis) {
                        $toplamsecenekdeger[] = $secenekgecis;
                    }
                    $toplamsecenek[] = $sepet['secenek'] * $sepet['secenekfiyat'];
                    $tamsecenek = json_encode($toplamsecenekdeger, JSON_UNESCAPED_UNICODE);
                    $yazdirsecenek = "secenekdeger = '$tamsecenek',";
                } else {
                    $yazdirsecenek = '';
                }

                if (isset($sepet['varyant'])) {
                    $toplamvaryantlar = $sepet['varyant'];
                } else {
                    $toplamvaryantlar = '0';
                }

                $urunbilgi[] = array(
                    "id" => "$toplamurunid",
                    "adet" => "$toplamadet",
                    "varyant" => "$toplamvaryantlar",
                );

                $uruntutar = $db->query("select * from products where id = '$toplamurunid' limit 1")->fetch();
                $toplamuruntutar[] = $toplamadet * $uruntutar['discountedPrice'];

                $kayitSil = $db->exec("DELETE FROM basket WHERE id='$sepetid' limit 1");

            }

            $toplamurunbilgi = json_encode($urunbilgi, JSON_UNESCAPED_UNICODE);

            if (isset($toplamsecenek)) {
                $seceneklerinfiyati = array_sum($toplamsecenek);
            } else {
                $seceneklerinfiyati = '0';
            }
            $toplamtutar = array_sum($toplamuruntutar) + $seceneklerinfiyati;
            if ($toplamkupon!='') {
                $toplamkuponsuz = array_sum($toplamuruntutar) + $seceneklerinfiyati;
                $toplamkuponsuztutar = $toplamkuponsuz - $toplamkupon;
            } else {
                $toplamkuponsuztutar = array_sum($toplamuruntutar) + $seceneklerinfiyati;
            }

            $siparisno = rand();
            $tarih = date('d.m.Y');

            $ekle = $db->exec("
                insert into orders set 
                name = '$name',
                email = '$email',
                adres = '$adres',
                numara = '$numara',
                siparisnot = '$siparisnot',
                siparisNo = '$siparisno',
                tarih = '$tarih',
                kupon = '$toplamkupon',
                uyeId = '$toplamuyeId',
                $yazdirsecenek
                urunbilgi = '$toplamurunbilgi',
                toplamTutar = '$toplamtutar',
                kuponsuzTutar = '$toplamkuponsuztutar',
                secenek = '$seceneklerinfiyati'
            ");

            if (isset($ekle)) {
                $sorgu =
                '
                <div class="alert alert-success" role="alert">
                  Sipariş Verildi
                </div>
                ';
            } elseif (empty($ekle)) {
                $sorgu =
                '
                <div class="alert alert-danger" role="alert">
                  Lütfen Bütün Alanları Doldurunuz
                </div>
                ';
            }

            echo '<script>setTimeout(function(){ window. location. reload(); }, 2000);</script>';
        }
    }

    breadcrump('Anasayfa','Sayfalar','Sipariş'); ?>

    <form method="post">
    <!-- ======================= Product Detail ======================== -->
    <section class="middle">
        <div class="container">

            <?=$sorgu?>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="text-center d-block mb-5">
                        <h2>Sipariş Oluştur</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-between">
                <div class="col-12 col-lg-7 col-md-12">

                        <h5 class="mb-4 ft-medium">Fatura Detayları</h5>
                        <div class="row mb-2">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Ad Soyad *</label>
                                    <input name="name" type="text" class="form-control" placeholder="Ad Soyad" />
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">E-Posta *</label>
                                    <input name="email" type="email" class="form-control" placeholder="E-Posta" />
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Adres *</label>
                                    <input name="adres" type="text" class="form-control" placeholder="Adres" />
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Telefon Numarası *</label>
                                    <input name="numara" type="text" class="form-control" placeholder="Telefon Numarası" />
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Sipariş Notu</label>
                                    <textarea name="siparisnot" class="form-control ht-50"></textarea>
                                </div>
                            </div>

                        </div>


                </div>

                <!-- Sidebar -->
                <div class="col-12 col-lg-4 col-md-12">
                    <div class="d-block mb-3">
                        <h5 class="mb-4">Sipariş öğeleri</h5>
                        <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">

                        <?php $baskets = $db->query("select * from basket where uyeId = '$uyeid' order by id ASC")->fetchAll();
                        foreach ($baskets as $basket) { $urunid = $basket['urunId'];
                            $urun = $db->query("select * from products where id = '$urunid' limit 1")->fetch();
                            $urunvaryant = $db->query("select * from variantoptions where productId = '$urunid' limit 1")->fetch();?>
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <!-- Image -->
                                        <a href="product.html"><img src="../upload/products/<?=$urun['picture']?>" alt="..." class="img-fluid"></a>
                                    </div>
                                    <div class="col d-flex align-items-center">
                                        <div class="cart_single_caption pl-2">
                                            <h4 class="product_title fs-md ft-medium mb-1 lh-1"><?=$urun['name']?></h4>
                                            <?php if ($basket['varyant']!='') { ?>
                                                <p class="mb-1 lh-1"><span class="text-dark"><?=$urunvaryant['variantGroup']?>: <?=$basket['varyant']?></span></p>
                                            <?php } ?>
                                            <p class="mb-3 lh-1"><span class="text-dark">Adet: <?=$basket['adet']?></span></p>
                                            <?php if ($basket['varyant']!='') { ?>
                                                <?php foreach (json_decode($basket['secenekdeger']) as $secenekdeger) { ?>
                                                    <p class="mb-3 lh-1"><span class="text-dark">Ekstra: <?=$secenekdeger?></span><span class="theme-cl"> + <?=$urun['secenekfiyat']?>.00 TL</span></p>
                                                <?php } ?>
                                            <?php } ?>

                                            <span class="text-muted ft-medium line-through mr-2"><?=$basket['adet'] * $urun['price']?>.00 TL</span><span class="ft-bold theme-cl fs-md"><?=$basket['adet'] * $urun['discountedPrice']?>.00 TL</span><br><br>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <?php
                            $price[] = $basket['adet'] * $urun['price'];
                            $discountedPrice[] = $basket['adet'] * $urun['discountedPrice'];
                            ?>
                        <?php } ?>

                        </ul>
                    </div>

                    <?php if (isset($discountedPrice)) { $toplam = array_sum($discountedPrice); } ?>
                    <div class="card mb-4 gray">
                        <div class="card-body">
                            <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                                <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                    <span>Ara Toplam</span> <span class="ml-auto text-dark ft-medium"><?php if (isset($price)) { echo array_sum($price); } ?>.00 TL</span>
                                </li>
                                <li class="list-group-item d-flex text-dark fs-sm ft-regular"><?php if (isset($price) && isset($discountedPrice)) { $discounted = array_sum($price) - array_sum($discountedPrice); } ?>
                                    <span>İndirim</span> <span class="ml-auto text-dark ft-medium"><?php if (isset($discounted)) { echo $discounted; } ?>.00 TL</span>
                                </li>
                                <?php if (isset($basket['kupon'])) {
                                    if ($basket['kupon'] != '') { ?>
                                        <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                            <span>Kupon</span> <span class="ml-auto text-dark ft-medium"><?=$basket['kupon']?>.00 TL</span>
                                        </li>
                                        <?php $toplam = array_sum($discountedPrice) - $basket['kupon'] ?>
                                    <?php } } ?>
                                <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                    <span>Toplam</span> <span class="ml-auto text-dark ft-medium"><?php if (isset($toplam)) { echo $toplam; } ?>.00 TL</span>
                                </li>
                                <li class="list-group-item fs-sm text-center">
                                    Hesaplanan Sepet Tutarı
                                </li>
                            </ul>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-block btn-dark mb-3">Sipariş Oluştur</button>
                </div>

            </div>

        </div>
    </section>
    <!-- ======================= Product Detail End ======================== -->
    </form>

<?php   } else { echo '<script>window.location.href = "sepet";</script>'; } } else { echo '<script>window.location.href = "sepet";</script>'; } ?>
<?php } ?>