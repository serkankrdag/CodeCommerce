<?php function sepet() { global $db; if (isset($_SESSION["idu"])) { $uyeid = $_SESSION["idu"]; } else { $uyeid = $_SESSION["uyeolmayanid"]; }

    $sorgu = '';
    if ($_POST) {
        if (isset($_POST['adet'])) {
            $id = $_POST['id'];
            $adet = $_POST['adet'];

            $ekle = $db->exec("
                update basket set 
                adet = '$adet'
                where id = '$id'
            ");
        }

        if (isset($_POST['sil'])) {
            $id = $_POST['sil'];
            $kayitSil = $db->exec("DELETE FROM basket WHERE id='$id' limit 1");
        }

        if (isset($_POST['kupon'])) {
            $kupon = $_POST['kupon'];
            $kuponSorgu = $db->query("select * from coupons where code = '$kupon' limit 1")->fetch();

            if (isset($kuponSorgu['discount'])) {
                $indirim = $kuponSorgu['discount'];

                $ekle2 = $db->exec("
                    update basket set 
                    kupon = '$indirim'
                    where uyeId = '$uyeid'
                ");
            }

            if (isset($ekle2)) {
                $sorgu =
                    '
            <div class="alert alert-success" role="alert">
              Kupon Kodu Kabul Edildi
            </div>
            ';
            } elseif (empty($ekle2)) {
                $sorgu =
                    '
            <div class="alert alert-danger" role="alert">
              Kupon Kodu Hatalı
            </div>
            ';
            }
        }
    }

    breadcrump('Anasayfa','Sayfalar','Sepet'); ?>

    <!-- ======================= Product Detail ======================== -->
    <section class="middle">
        <div class="container">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="text-center d-block mb-5">
                        <h2>Alışveriş Sepeti</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-between">
                <div class="col-12 col-lg-7 col-md-12">
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">

                        <?php $baskets = $db->query("select * from basket where uyeId = '$uyeid' order by id ASC")->fetchAll();
                        foreach ($baskets as $basket) { $urunid = $basket['urunId'];
                            $urun = $db->query("select * from products where id = '$urunid' limit 1")->fetch();
                            $urunvaryant = $db->query("select * from variantoptions where productId = '$urunid' limit 1")->fetch();?>
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <a href="javascript:void(0)"><img src="../upload/products/<?=$urun['picture']?>" alt="..." class="img-fluid"></a>
                                    </div>
                                    <div class="col d-flex align-items-center justify-content-between">
                                        <div class="cart_single_caption pl-2">
                                            <h4 class="product_title fs-md ft-medium mb-1 lh-1"><?=$urun['name']?></h4>
                                            <?php if ($basket['varyant']!='') { ?>
                                                <p class="mb-1 lh-1"><span class="text-dark"><?=$urunvaryant['variantGroup']?>: <?=$basket['varyant']?></span></p>
                                            <?php } ?>
                                            <?php if ($basket['varyant']!='') { ?>
                                                <?php foreach (json_decode($basket['secenekdeger']) as $secenekdeger) { ?>
                                                    <p class="mb-3 lh-1"><span class="text-dark">Ekstra: <?=$secenekdeger?></span><span class="theme-cl"> + <?=$urun['secenekfiyat']?>.00 TL</span></p>
                                                <?php } ?>
                                            <?php } ?>
                                            <span class="text-muted ft-medium line-through mr-2"><?=$basket['adet'] * $urun['price']?>.00 TL</span><span class="ft-bold theme-cl fs-md"><?=$basket['adet'] * $urun['discountedPrice']?>.00 TL</span><br><br>
                                            <form method="post">
                                                <select name="adet" class="mb-2 custom-select w-auto">
                                                    <option <?= $selected = ($basket['adet'] == '1') ? 'selected' : ''; ?> value="1">1</option>
                                                    <option <?= $selected = ($basket['adet'] == '2') ? 'selected' : ''; ?> value="2">2</option>
                                                    <option <?= $selected = ($basket['adet'] == '3') ? 'selected' : ''; ?> value="3">3</option>
                                                    <option <?= $selected = ($basket['adet'] == '4') ? 'selected' : ''; ?> value="4">4</option>
                                                    <option <?= $selected = ($basket['adet'] == '5') ? 'selected' : ''; ?> value="5">5</option>
                                                </select>
                                                <input type="hidden" name="id" value="<?=$basket['id']?>">
                                            </form>
                                        </div>
                                        <form method="post">
                                            <input type="hidden" name="sil" value="<?=$basket['id']?>">
                                            <div class="fls_last"><button type="submit" class="close_slide gray"><i class="ti-close"></i></button></div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <?php
                                $price[] = $basket['adet'] * $urun['price'];
                                $discountedPrice[] = $basket['adet'] * $urun['discountedPrice'];
                            ?>
                        <?php } ?>

                        <script>
                            document.querySelectorAll('.custom-select').forEach(function(element) {
                                element.addEventListener('change', function() {
                                    this.form.submit();
                                });
                            });
                        </script>

                    </ul>

                    <?=$sorgu?>
                    <div class="row align-items-end justify-content-between mb-10 mb-md-0">
                        <div class="col-12 col-md-7">
                            <form method="post" class="mb-7 mb-md-0">
                                <label class="fs-sm ft-medium text-dark">Kupon Kodu:</label>
                                <div class="row form-row">
                                    <div class="col">
                                        <input name="kupon" class="form-control" type="text" placeholder="Kupon kodunu girin">
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-dark" type="submit">Uygula</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php if (isset($discountedPrice)) { $toplam = array_sum($discountedPrice); } ?>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card mb-4 gray mfliud">
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

                    <a class="btn btn-block btn-dark mb-3" href="siparis">Sipariş Ver</a>

                    <a class="btn-link text-dark ft-medium" href="anasayfa">
                        <i class="ti-back-left mr-2"></i> Alışverişe Devam
                    </a>
                </div>

            </div>

        </div>
    </section>
    <!-- ======================= Product Detail End ======================== -->

<?php } ?>