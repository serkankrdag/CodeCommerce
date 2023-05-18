<?php function settings() { global $db;

    $controle='';
    if ($_POST) {

        $dosyaYukleme = '';
        if ($_FILES['logo']) {

            $yol = "../upload/settings/";
            $dosyaUzantisi = pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);
            $logo = time() . '.' . $dosyaUzantisi;
            $yuklemeYeri = $yol . $logo;
            if ($_FILES["logo"]["size"]  > 1000000) {
                // "Dosya boyutu sınırı";
            } else {
                if ($dosyaUzantisi != "jpeg" && $dosyaUzantisi != "jpg" && $dosyaUzantisi != "png") {
                    // "Sadece jpeg, jpg ve png uzantılı dosyalar yüklenebilir.";
                } else {
                    $sonuc = move_uploaded_file($_FILES["logo"]["tmp_name"], $yuklemeYeri);
                    $dosyaYukleme = "logo = '$logo',";

                    $sorgu = $db->query("select * from settings where id='1'")->fetch();
                    $file = "../upload/settings/".$sorgu['logo'];
                    if (isset($sorgu['logo']) && !empty($sorgu['logo'])) {unlink($file);}
                }
            }
        }

        $dosyaYukleme2= '';
        if ($_FILES['favicon']) {

            $yol = "../upload/settings/";
            $dosyaUzantisi = pathinfo($_FILES["favicon"]["name"], PATHINFO_EXTENSION);
            $favicon = time() . '.' . $dosyaUzantisi;
            $yuklemeYeri = $yol . $favicon;
            if ($_FILES["favicon"]["size"]  > 1000000) {
                // "Dosya boyutu sınırı";
            } else {
                if ($dosyaUzantisi != "jpeg" && $dosyaUzantisi != "jpg" && $dosyaUzantisi != "png") {
                    // "Sadece jpeg, jpg ve png uzantılı dosyalar yüklenebilir.";
                } else {
                    $sonuc = move_uploaded_file($_FILES["favicon"]["tmp_name"], $yuklemeYeri);
                    $dosyaYukleme2 = "favicon = '$favicon',";

                    $sorgu = $db->query("select * from settings where id='1'")->fetch();
                    $file = "../upload/settings/".$sorgu['favicon'];
                    if (isset($sorgu['favicon']) && !empty($sorgu['favicon'])) {unlink($file);}
                }
            }
        }

        $metaTitle = $_POST['metaTitle'];
        $metaDescription = $_POST['metaDescription'];
        $metaKeywords = $_POST['metaKeywords'];
        $shopName = $_POST['shopName'];
        $shopOwner = $_POST['shopOwner'];
        $address = $_POST['address'];
        $mail = $_POST['mail'];
        $phone = $_POST['phone'];
        $instagram = $_POST['instagram'];
        $twitter = $_POST['twitter'];
        $youtube = $_POST['youtube'];
        $facebook = $_POST['facebook'];

        $ekle = $db->exec("
            update settings set 
            metaTitle = '$metaTitle',
            $dosyaYukleme
            metaDescription = '$metaDescription',
            $dosyaYukleme2
            metaKeywords = '$metaKeywords',
            shopName = '$shopName',
            shopOwner = '$shopOwner',
            address = '$address',
            mail = '$mail',
            phone = '$phone',
            instagram = '$instagram',
            twitter = '$twitter',
            youtube = '$youtube',
            facebook = '$facebook'
            where id = '1'
        ");

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
                        <h4 class="mb-1 text-dark">Ayarlar Güncellendi</h4>
                        <span>Ayar güncelleme işlemi başarılı bir şekilde gerçekleşti.</span>
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
                        <h4 class="mb-1 text-dark">Ayarlar Güncellenemedi</h4>
                        <span>Ayar güncelleme işlemi başarısız lütfen bütün alanları doldurun.</span>
                    </div>
                </div>
                ';
        }
    }


    $setting = $db->query("select * from settings where id = '1' limit 1")->fetch();

    breadcrumb('Kontrol Panel','Araçlar','Genel Ayarlar'); ?>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">

            <?=$controle?>
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="card card-flush">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-15" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-active-primary pb-5 active" data-bs-toggle="tab" href="#kt_ecommerce_settings_general" aria-selected="true" role="tab">
                                        <span class="svg-icon svg-icon-2 me-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11 2.375L2 9.575V20.575C2 21.175 2.4 21.575 3 21.575H9C9.6 21.575 10 21.175 10 20.575V14.575C10 13.975 10.4 13.575 11 13.575H13C13.6 13.575 14 13.975 14 14.575V20.575C14 21.175 14.4 21.575 15 21.575H21C21.6 21.575 22 21.175 22 20.575V9.575L13 2.375C12.4 1.875 11.6 1.875 11 2.375Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        Genel
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-active-primary pb-5" data-bs-toggle="tab" href="#kt_ecommerce_settings_store" aria-selected="false" tabindex="-1" role="tab">
                                        <span class="svg-icon svg-icon-2 me-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M18 10V20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20V10H18Z" fill="currentColor"></path>
                                                <path opacity="0.3" d="M11 10V17H6V10H4V20C4 20.6 4.4 21 5 21H12C12.6 21 13 20.6 13 20V10H11Z" fill="currentColor"></path>
                                                <path opacity="0.3" d="M10 10C10 11.1 9.1 12 8 12C6.9 12 6 11.1 6 10H10Z" fill="currentColor"></path>
                                                <path opacity="0.3" d="M18 10C18 11.1 17.1 12 16 12C14.9 12 14 11.1 14 10H18Z" fill="currentColor"></path>
                                                <path opacity="0.3" d="M14 4H10V10H14V4Z" fill="currentColor"></path>
                                                <path opacity="0.3" d="M17 4H20L22 10H18L17 4Z" fill="currentColor"></path>
                                                <path opacity="0.3" d="M7 4H4L2 10H6L7 4Z" fill="currentColor"></path>
                                                <path d="M6 10C6 11.1 5.1 12 4 12C2.9 12 2 11.1 2 10H6ZM10 10C10 11.1 10.9 12 12 12C13.1 12 14 11.1 14 10H10ZM18 10C18 11.1 18.9 12 20 12C21.1 12 22 11.1 22 10H18ZM19 2H5C4.4 2 4 2.4 4 3V4H20V3C20 2.4 19.6 2 19 2ZM12 17C12 16.4 11.6 16 11 16H6C5.4 16 5 16.4 5 17C5 17.6 5.4 18 6 18H11C11.6 18 12 17.6 12 17Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        Mağaza
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-active-primary pb-5" data-bs-toggle="tab" href="#kt_ecommerce_settings_localization" aria-selected="false" tabindex="-1" role="tab">
                                        <span class="svg-icon svg-icon-2 me-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z" fill="currentColor"></path>
                                                <path d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        Yerelleştirme
                                    </a>
                                </li>
                            </ul>

                            <form action="" method="post" enctype="multipart/form-data">

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="kt_ecommerce_settings_general" role="tabpanel">


                                        <div class="row mb-7">
                                            <div class="col-md-9 offset-md-3">
                                                <h2>Genel Ayarlar</h2>
                                            </div>
                                        </div>

                                        <div class="row fv-row mb-7 fv-plugins-icon-container">
                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span class="required">Meta Başlık</span>

                                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="SEO için mağazanın başlığını belirleyin." data-bs-original-title="SEO için mağazanın başlığını belirleyin." data-kt-initialized="1"></i>
                                                </label>
                                            </div>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-solid" name="metaTitle" value="<?=$setting['metaTitle']?>">
                                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                        </div>

                                        <div class="row fv-row mb-7">
                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Meta Tag Açıklama</span>

                                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="SEO için mağazanın açıklamasını ayarlayın." data-bs-original-title="SEO için mağazanın açıklamasını ayarlayın." data-kt-initialized="1"></i>
                                                </label>
                                            </div>

                                            <div class="col-md-9">
                                                <textarea class="form-control form-control-solid" name="metaDescription"><?=$setting['metaDescription']?></textarea>
                                            </div>
                                        </div>

                                        <div class="row fv-row mb-7">
                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Anahtar Kelimeler</span>

                                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="Mağaza için virgülle ayrılmış anahtar kelimeler belirleyin." data-bs-original-title="Mağaza için virgülle ayrılmış anahtar kelimeler belirleyin." data-kt-initialized="1"></i>
                                                </label>
                                            </div>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-solid" name="metaKeywords" value="<?=$setting['metaKeywords']?>">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="row fv-row mb-7">
                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Logo</span>

                                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="Mağaza için logo ayarlayın." data-bs-original-title="Mağaza için logo ayarlayın." data-kt-initialized="1"></i>
                                                </label>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="card-body text-center pt-0">
                                                    <?php $logo = ($setting['logo'] != "") ? "../upload/settings/".$setting["logo"] : "assets/media/svg/files/blank-image.svg"; ?>
                                                    <style>
                                                        .image-input-placeholder-logo {
                                                            background-image: url(<?=$logo?>);
                                                        }
                                                    </style>

                                                    <div class="image-input image-input-empty image-input-outline image-input-placeholder-logo mb-3" data-kt-image-input="true">
                                                        <div class="image-input-wrapper w-150px h-150px"></div>

                                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Avatarı değiştir" data-bs-original-title="Avatarı değiştir" data-kt-initialized="1">
                                                            <i class="bi bi-pencil-fill fs-7"></i>

                                                            <input type="file" name="logo" accept=".png, .jpg, .jpeg">
                                                            <input type="hidden" name="logo">
                                                        </label>

                                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Avatarı Sil" data-bs-original-title="Avatarı Sil" data-kt-initialized="1">
                                                            <i class="bi bi-x fs-2"></i>
                                                        </span>

                                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Avatarı Sil" data-bs-original-title="Avatarı Sil" data-kt-initialized="1">
                                                            <i class="bi bi-x fs-2"></i>
                                                        </span>
                                                    </div>

                                                    <div class="text-muted fs-7">Logo ayarlayın. Yalnızca *.png, *.jpg ve *.jpeg resim dosyaları kabul edilir</div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Favicon</span>

                                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="Mağaza için favicon ayarlayın." data-bs-original-title="Mağaza için favicon ayarlayın." data-kt-initialized="1"></i>
                                                </label>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="card-body text-center pt-0">
                                                    <?php $favicon = ($setting['favicon'] != "") ? "../upload/settings/".$setting["favicon"] : "assets/media/svg/files/blank-image.svg"; ?>
                                                    <style>
                                                        .image-input-placeholder-favicon {
                                                            background-image: url(<?=$favicon?>);
                                                        }
                                                    </style>

                                                    <div class="image-input image-input-empty image-input-outline image-input-placeholder-favicon mb-3" data-kt-image-input="true">
                                                        <div class="image-input-wrapper w-150px h-150px"></div>

                                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Avatarı değiştir" data-bs-original-title="Avatarı değiştir" data-kt-initialized="1">
                                                            <i class="bi bi-pencil-fill fs-7"></i>

                                                            <input type="file" name="favicon" accept=".png, .jpg, .jpeg">
                                                            <input type="hidden" name="favicon">
                                                        </label>

                                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Avatarı Sil" data-bs-original-title="Avatarı Sil" data-kt-initialized="1">
                                                            <i class="bi bi-x fs-2"></i>
                                                        </span>

                                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Avatarı Sil" data-bs-original-title="Avatarı Sil" data-kt-initialized="1">
                                                            <i class="bi bi-x fs-2"></i>
                                                        </span>
                                                    </div>

                                                    <div class="text-muted fs-7">Favicon ayarlayın. Yalnızca *.png, *.jpg ve *.jpeg resim dosyaları kabul edilir</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row py-5">
                                            <div class="col-md-9 offset-md-3">
                                                <div class="d-flex">
                                                    <button type="reset" data-kt-ecommerce-settings-type="cancel" class="btn btn-light me-3">
                                                        Geri
                                                    </button>

                                                    <button name="genelSubmit" type="submit" data-kt-ecommerce-settings-type="submit" class="btn btn-primary">
                                                        <span class="indicator-label">
                                                            Kaydet
                                                        </span>
                                                        <span class="indicator-progress">
                                                            Lütfen bekleyin... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div class="tab-pane fade" id="kt_ecommerce_settings_store" role="tabpanel">
                                        <div class="row mb-7">
                                            <div class="col-md-9 offset-md-3">
                                                <h2>Mağaza Ayarları</h2>
                                            </div>
                                        </div>

                                        <div class="row fv-row mb-7 fv-plugins-icon-container">
                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span class="required">Dükkan adı</span>

                                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="Mağazanın adını belirleyin" data-bs-original-title="Mağazanın adını belirleyin" data-kt-initialized="1"></i>
                                                </label>
                                            </div>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-solid" name="shopName" value="<?=$setting['shopName']?>">
                                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                        </div>

                                        <div class="row fv-row mb-7 fv-plugins-icon-container">
                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span class="required">Dükkan sahibi</span>

                                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="Mağaza sahibinin adını belirleyin" data-bs-original-title="Mağaza sahibinin adını belirleyin" data-kt-initialized="1"></i>
                                                </label>
                                            </div>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-solid" name="shopOwner" value="<?=$setting['shopOwner']?>">
                                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                        </div>

                                        <div class="row fv-row mb-7 fv-plugins-icon-container">
                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span class="required">Adres</span>

                                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="Mağazanın tam adresini ayarlayın." data-bs-original-title="Mağazanın tam adresini ayarlayın." data-kt-initialized="1"></i>
                                                </label>
                                            </div>

                                            <div class="col-md-9">
                                                <textarea class="form-control form-control-solid" name="address"><?=$setting['address']?></textarea>
                                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                        </div>

                                        <div class="row fv-row mb-7 fv-plugins-icon-container">
                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span class="required">E-posta</span>
                                                </label>
                                            </div>

                                            <div class="col-md-9">
                                                <input type="email" class="form-control form-control-solid" name="mail" value="<?=$setting['mail']?>">
                                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                        </div>

                                        <div class="row fv-row mb-7 fv-plugins-icon-container">
                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span class="required">Telefon</span>
                                                </label>
                                            </div>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-solid" name="phone" value="<?=$setting['phone']?>">
                                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                        </div>

                                        <div class="row fv-row mb-7">
                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>İnstagram</span>
                                                </label>
                                            </div>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-solid" name="instagram" value="<?=$setting['instagram']?>">
                                            </div>
                                        </div>

                                        <div class="row fv-row mb-7">
                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Twitter</span>
                                                </label>
                                            </div>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-solid" name="twitter" value="<?=$setting['twitter']?>">
                                            </div>
                                        </div>

                                        <div class="row fv-row mb-7">
                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Youtube</span>
                                                </label>
                                            </div>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-solid" name="youtube" value="<?=$setting['youtube']?>">
                                            </div>
                                        </div>

                                        <div class="row fv-row mb-7">
                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Facebook</span>
                                                </label>
                                            </div>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-solid" name="facebook" value="<?=$setting['facebook']?>">
                                            </div>
                                        </div>

                                        <div class="row py-5">
                                            <div class="col-md-9 offset-md-3">
                                                <div class="d-flex">
                                                    <button type="reset" data-kt-ecommerce-settings-type="cancel" class="btn btn-light me-3">
                                                        Geri
                                                    </button>

                                                    <button name="magazaSubmit" type="submit" data-kt-ecommerce-settings-type="submit" class="btn btn-primary">
                                                        <span class="indicator-label">
                                                            Kaydet
                                                        </span>
                                                        <span class="indicator-progress">
                                                            Lütfen bekleyin... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div class="tab-pane fade" id="kt_ecommerce_settings_localization" role="tabpanel">
                                        <div class="row mb-7">
                                            <div class="col-md-9 offset-md-3">
                                                <h2>Yerelleştirme Ayarları</h2>
                                            </div>
                                        </div>

                                        <div class="row fv-row mb-7 fv-plugins-icon-container">
                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span class="required">Ülke</span>
                                                </label>
                                            </div>

                                            <div class="col-md-9">
                                                <select class="form-select form-select-solid mb-2" data-control="select2" data-placeholder="Bir seçenek seçin">
                                                    <option></option>
                                                    <option value="1">Türkiye</option>
                                                    <option value="2">İngiltere</option>
                                                    <option value="2">Amerika</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row fv-row mb-7 fv-plugins-icon-container">
                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span class="required">Dil</span>
                                                </label>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="w-100">
                                                    <select class="form-select form-select-solid mb-2" data-control="select2" data-placeholder="Bir seçenek seçin">
                                                        <option></option>
                                                        <option value="1">Türkce</option>
                                                        <option value="2">İngilizce</option>
                                                    </select>
                                                </div>
                                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                        </div>

                                        <div class="row fv-row mb-7 fv-plugins-icon-container">
                                            <div class="col-md-3 text-md-end">
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span class="required">Para Birimi</span>
                                                </label>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="w-100">
                                                    <select class="form-select form-select-solid mb-2" data-control="select2" data-placeholder="Bir seçenek seçin">
                                                        <option></option>
                                                        <option value="1">TL</option>
                                                        <option value="2">USD</option>
                                                        <option value="2">EU</option>
                                                    </select>
                                                </div>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="row py-5">
                                            <div class="col-md-9 offset-md-3">
                                                <div class="d-flex">
                                                    <button type="reset" data-kt-ecommerce-settings-type="cancel" class="btn btn-light me-3">
                                                        Geri
                                                    </button>

                                                    <button name="yerelSubmit" type="submit" data-kt-ecommerce-settings-type="submit" class="btn btn-primary">
                                                        <span class="indicator-label">
                                                            Kaydet
                                                        </span>
                                                        <span class="indicator-progress">
                                                            Lütfen bekleyin... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php }