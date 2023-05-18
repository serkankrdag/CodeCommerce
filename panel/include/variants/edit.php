<?php function variantsEdit() { global $db; global $menu;

    $controle='';
    if ($_POST) {

        $dosyaYukleme = '';
        if ($_FILES) {

            $yol = "../upload/variants/";
            $dosyaUzantisi = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
            $picture = time() . '.' . $dosyaUzantisi;
            $yuklemeYeri = $yol . $picture;
            if ($_FILES["picture"]["size"]  > 1000000) {
                // "Dosya boyutu sınırı";
            } else {
                if ($dosyaUzantisi != "jpeg" && $dosyaUzantisi != "jpg" && $dosyaUzantisi != "png") {
                    // "Sadece jpeg, jpg ve png uzantılı dosyalar yüklenebilir.";
                } else {
                    $sonuc = move_uploaded_file($_FILES["picture"]["tmp_name"], $yuklemeYeri);
                    $dosyaYukleme = "picture = '$picture',";

                    $sorgu = $db->query("select * from variants where id='$menu[4]'")->fetch();
                    $file = "../upload/variants/".$sorgu['picture'];
                    unlink($file);
                }
            }
        }

        $name=''; $contents=''; $status='';
        if (isset($_POST["varyant"])) {
            $name = $_POST['name'];
            $contents = $_POST["varyant"];
            for ($i=0;$i<count($_POST["varyant"]);$i++) {
                $contentss[]=$contents[$i]['contents'];
            }
            $contentss=json_encode($contentss,JSON_UNESCAPED_UNICODE);
            $status = $_POST['status'];
        }

        if ($name!='' && $contents!='' && $status!='') {
            $ekle = $db->exec("
            update variants set 
            name = '$name',
            contents = '$contentss',
            $dosyaYukleme
            status = '$status'
            where id=$menu[4]
        ");
        } else {
            $ekle='';
        }

        if($ekle) {
            $controle=
                '
                <div class="alert alert-success d-flex align-items-success p-5">
                    <span class="svg-icon svg-icon-2hx svg-icon-success me-3">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                            <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-dark">Kategori Eklendi</h4>
                        <span>Kategori ekleme işlemi başarılı bir şekilde gerçekleşti.</span>
                    </div>
                </div>
                ';
        } elseif (!$ekle) {
            $controle=
                '
                <div class="alert alert-danger d-flex align-items-danger p-5">
                    <span class="svg-icon svg-icon-2hx svg-icon-danger me-3">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                            <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-dark">Kategori Eklenemedi</h4>
                        <span>Kategori ekleme işlemi başarısız lütfen bütün alanları doldurun.</span>
                    </div>
                </div>
                ';
        }
    }

    $variant = $db->query("select * from variants where id = $menu[4] limit 1")->fetch();

    breadcrumb('Kontrol Panel','Varyantlar','Varyant Düzenleme'); ?>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">

            <?=$controle?>
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <form method="post" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" data-kt-redirect="/metronic8/demo1/../demo1/apps/ecommerce/catalog/categories.html">
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Varyant Fotoğrafı</h2>
                                    </div>
                                </div>

                                <div class="card-body text-center pt-0">
                                    <style>
                                        .image-input-placeholder {
                                        <?php if (isset($variant['picture']) && !empty($variant['picture'])) { ?>
                                            background-image: url(../upload/variants/<?=$variant["picture"]?>);
                                        <?php } else { ?>
                                            background-image: url(assets/media/svg/files/blank-image.svg);
                                        <?php } ?>
                                        }
                                    </style>

                                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                        <div class="image-input-wrapper w-150px h-150px"></div>

                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Avatarı değiştir" data-bs-original-title="Avatarı değiştir" data-kt-initialized="1">
                                            <i class="bi bi-pencil-fill fs-7"></i>

                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                                            <input type="hidden" name="avatar_remove">
                                        </label>

                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Avatarı Sil" data-bs-original-title="Avatarı Sil" data-kt-initialized="1">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>

                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Avatarı Sil" data-bs-original-title="Avatarı Sil" data-kt-initialized="1">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                    </div>

                                    <div class="text-muted fs-7">Varyant küçük resmini ayarlayın. Yalnızca *.png, *.jpg ve *.jpeg resim dosyaları kabul edilir</div>
                                </div>
                            </div>
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Durum</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <select name="status" class="form-select mb-2" data-control="select2" data-placeholder="Bir seçenek seçin">
                                        <option></option>
                                        <option <?= $selected = ($variant['status'] == '1') ? 'selected' : ''; ?> value="1">Aktif</option>
                                        <option <?= $selected = ($variant['status'] == '0') ? 'selected' : ''; ?> value="0">Pasif</option>
                                    </select>
                                    <div class="text-muted fs-7">Varyant durumunu ayarlayın.</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Genel</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <label class="required form-label">Varyant Adı</label>

                                        <input type="text" name="name" class="form-control mb-2" placeholder="Kategori adı" value="<?=$variant['name']?>">

                                        <div class="text-muted fs-7">Bir varyant adı gereklidir ve benzersiz olması önerilir.</div>
                                        <div class="fv-plugins-message-container invalid-feedback"></div></div>

                                    <div>
                                        <label class="form-label">Varyant İçeriği</label>

                                        <div id="urunvaryantlar">

                                            <div class="form-group">
                                                <div data-repeater-list="varyant">
                                                    <?php $variants=json_decode($variant['contents']);
                                                    foreach ($variants as $variantss) { ?>
                                                    <div data-repeater-item>
                                                        <div class="form-group row mb-5">
                                                            <div class="col-md-3">
                                                                <input name="contents" type="text" class="form-control mb-2 mb-md-0" placeholder="Varyant İçeriği" value="<?=$variantss?>"/>
                                                            </div>
                                                            <div class="col-md-2 mt-2">
                                                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-2mb2">
                                                                    <i class="la la-trash-o fs-3"></i>Sil
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="form-group mb-2">
                                                <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
                                                    <i class="la la-plus"></i>Başka bir varyasyon ekle
                                                </a>
                                            </div>
                                            <div class="text-muted fs-7">Daha iyi filtreleme için varyant içeriği ayarlayın.</div>
                                        </div>
                                    </div>
                                </div></div>

                            <div class="d-flex justify-content-end">
                                <a href="javascript:void(0)" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">
                                    Geri
                                </a>

                                <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                    <span class="indicator-label">
                                        Değişiklikleri Kaydet
                                    </span>
                                    <span class="indicator-progress">
                                        Lütfen bekleyin... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
<?php }