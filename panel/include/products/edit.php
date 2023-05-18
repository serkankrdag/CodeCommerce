<?php function productsEdit() { global $db; global $menu;

    $controle='';
    if ($_POST) {

        $dosyaYukleme = '';
        if ($_FILES) {
            $yol = "../upload/products/";
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
                }
            }
        }


        $name = $_POST['name'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $category = $_POST['category'];
        $brand = $_POST['brand'];
        $price = $_POST['price'];
        $discountType = $_POST['discountType'];
        $discount = $_POST['discount'];
        $kdv = $_POST['kdv'];
        $stockCode = $_POST['stockCode'];
        $barcode = $_POST['barcode'];
        $stockShelf = $_POST['stockShelf'];
        $stockTank = $_POST['stockTank'];
        $metaTitle = $_POST['metaTitle'];
        $metaDescription = $_POST['metaDescription'];
        $metaKeywords = $_POST['metaKeywords'];
        if ($_POST['secenekfiyat']!='') {
            $secenekfiyat = $_POST['secenekfiyat'];
        } else {
            $secenekfiyat = '';
        }

        if ($discountType==2) {
            $discountedPriceMap = $price * $discount / 100;
            $discountedPrice = $price - $discountedPriceMap;
        } elseif ($discountType==3) {
            $discountedPrice = $price - $discount;
        } else {
            $discountedPrice = 0;
            $discount = 0;
        }


        if ($name!='' && $description!='' && $status!='' && $category!='' && $brand!=''
            && $discountType!='' && $discount!='' && $kdv!='' && $stockShelf!='' && $stockTank!=''
            && $price!='' && $metaTitle!='' && $metaDescription!='' && $metaKeywords!='') {

            $ekle = $db->exec("
            update products set 
            name = '$name',
            description = '$description',
            status = '$status',
            $dosyaYukleme
            category = '$category',
            brand = '$brand',
            price = '$price',
            discountType = '$discountType',
            discount = '$discount',
            discountedPrice = '$discountedPrice',
            kdv = '$kdv',
            stockCode = '$stockCode',
            barcode = '$barcode',
            stockShelf = '$stockShelf',
            stockTank = '$stockTank',
            metaTitle = '$metaTitle',
            metaDescription = '$metaDescription',
            secenekfiyat = '$secenekfiyat',
            metaKeywords = '$metaKeywords'
            where id = '$menu[4]'
        ");
            $lastId = $db->lastInsertId();
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
                        <h4 class="mb-1 text-dark">Ürün Güncellendi</h4>
                        <span>Ürün güncelleme işlemi başarılı bir şekilde gerçekleşti.</span>
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
                        <h4 class="mb-1 text-dark">Ürün Güncellenemedi</h4>
                        <span>Ürün güncelleme işlemi başarısız lütfen bütün alanları doldurun.</span>
                    </div>
                </div>
                ';
        }
    }

    $product = $db->query("select * from products where id = $menu[4] limit 1")->fetch();

    breadcrumb('Kontrol Panel','Ürünler','Ürün Düzenleme'); ?>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">

            <?=$controle?>
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <form method="post" id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework">
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Ürün Fotoğrafı</h2>
                                    </div>
                                </div>

                                <div class="card-body text-center pt-0">

                                    <style>
                                        .image-input-placeholder {
                                        <?php if (isset($product['picture']) && !empty($product['picture'])) { ?>
                                            background-image: url(../upload/products/<?=$product["picture"]?>);
                                        <?php } else { ?>
                                            background-image: url(assets/media/svg/files/blank-image.svg);
                                        <?php } ?>
                                        }
                                    </style>

                                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                        <div class="image-input-wrapper w-150px h-150px"></div>

                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Avatarı Değiştir" data-bs-original-title="Avatarı Değiştir" data-kt-initialized="1">
                                            <i class="bi bi-pencil-fill fs-7"></i>

                                            <input type="file" name="picture" accept=".png, .jpg, .jpeg">
                                            <input type="hidden" name="avatar_remove">
                                        </label>

                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Avatarı Sil" data-bs-original-title="Avatarı Sil" data-kt-initialized="1">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>

                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Avatarı Sil" data-bs-original-title="Avatarı Sil" data-kt-initialized="1">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                    </div>

                                    <div class="text-muted fs-7">Ürün küçük fotoğrafını ayarlayın. Yalnızca *.png, *.jpg ve *.jpeg resim dosyaları kabul edilir</div>
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
                                        <option <?= $selected = ($product['status'] == '1') ? 'selected' : ''; ?> value="1">Aktif</option>
                                        <option <?= $selected = ($product['status'] == '0') ? 'selected' : ''; ?> value="0">Pasif</option>
                                    </select>

                                    <div class="text-muted fs-7">Ürün durumunu ayarlayın.</div>
                                </div>
                            </div>

                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Ürün Kategorisi</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">

                                    <select name="category" class="form-select mb-2" data-control="select2" data-placeholder="Bir seçenek seçin">
                                        <option></option>
                                        <?php $categories = $db->query("select * from categories where status = '1' order by id ASC")->fetchAll();
                                        foreach($categories as $categorie) { ?>
                                            <option <?= $selected = ($product['category'] == $categorie['id']) ? 'selected' : ''; ?> value="<?=$categorie['id']?>"><?=$categorie['name']?></option>
                                        <?php } ?>
                                    </select>

                                    <div class="text-muted fs-7 mb-7">Bir kategoriye ürün ekleyin.</div>

                                    <a href="javascript:void(0)" class="btn btn-light-primary btn-sm">
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect>
                                                <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                        Yeni kategori oluştur
                                    </a>
                                </div>
                            </div>

                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="card-title d-flex flex-column">
                                            <div class="d-flex align-items-center">
                                                <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">TL</span>
                                                <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">0</span>
                                                <span class="badge badge-light-success fs-base">
                                                    <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor"></rect>
                                                            <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    0%
                                                </span>
                                            </div>
                                            <span class="text-gray-400 pt-1 fw-semibold fs-6">Ortalama Günlük Satışlar</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Ürün Markası</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">

                                    <select name="brand" class="form-select mb-2" data-control="select2" data-placeholder="Bir seçenek seçin">
                                        <option></option>
                                        <?php $brands = $db->query("select * from brands where status = '1' order by id ASC")->fetchAll();
                                        foreach($brands as $brand) { ?>
                                            <option <?= $selected = ($product['brand'] == $brand['id']) ? 'selected' : ''; ?> value="<?=$brand['id']?>"><?=$brand['name']?></option>
                                        <?php } ?>
                                    </select>

                                    <div class="text-muted fs-7 mb-7">Bir markaya ürün ekleyin.</div>

                                    <a href="javascript:void(0)" class="btn btn-light-primary btn-sm">
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect>
                                                <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                        Yeni Marka oluştur
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general" aria-selected="true" role="tab">Genel</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced" aria-selected="false" tabindex="-1" role="tab">Gelişmiş</a>
                                </li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                    <div class="d-flex flex-column gap-7 gap-lg-10">

                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Genel</h2>
                                                </div>
                                            </div>

                                            <div class="card-body pt-0">
                                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Ürün adı</label>

                                                    <input type="text" name="name" class="form-control mb-2" placeholder="Ürün adı" value="<?=$product['name']?>">

                                                    <div class="text-muted fs-7">Bir ürün adı gereklidir ve benzersiz olması önerilir.</div>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>

                                                <div>
                                                    <label class="form-label">Tanım</label>

                                                    <textarea name="description" id="description" class="form-control mb-2" cols="30" rows="10"><?=$product['description']?></textarea>
                                                    <div class="text-muted fs-7">Daha iyi görünürlük için ürüne bir açıklama ayarlayın.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Ürün Diğer Resimleri</h2>
                                                </div>
                                            </div>

                                            <div class="card-body pt-0">

                                                <div class="form-group">
                                                    <label for="photo-upload" class="form-label">Fotoğraf Yükle</label>

                                                    <div class="photo-preview">
                                                        <?php foreach (json_decode($product['pictures']) as $picture) { ?>
                                                            <div class="photo-item">
                                                                <img src="../upload/products/<?=$picture?>">
                                                                <button type="button">X</button>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="input-group">
                                                        <input id="photo-upload" type="file" name="pictures[]" multiple class="form-control" accept="image/*">
                                                        <button type="button" class="btn btn-primary" id="photo-clear">Seçilenleri Temizle</button>
                                                    </div>
                                                </div>


                                                <div class="text-muted fs-7">Ürün medya galerisini ayarlayın.</div>
                                            </div>
                                        </div>

                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Fiyatlandırma</h2>
                                                </div>
                                            </div>

                                            <div class="card-body pt-0">
                                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Taban Fiyat</label>

                                                    <input type="text" name="price" class="form-control mb-2" placeholder="Taban Fiyat" value="<?=$product['price']?>">

                                                    <div class="text-muted fs-7">Ürün fiyatını belirleyin.</div>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>

                                                <div class="fv-row mb-10">
                                                    <label class="fs-6 fw-semibold mb-2">
                                                        İndirim Türü
                                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" aria-label="Bu ürüne uygulanacak bir indirim türü seçin" data-bs-original-title="Bu ürüne uygulanacak bir indirim türü seçin" data-kt-initialized="1"></i>
                                                    </label>

                                                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']" data-kt-initialized="1">
                                                        <div class="col">
                                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary <?= $active = ($product['discountType'] == '1') ? 'active' : ''; ?> d-flex text-start p-6" data-kt-button="true">
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input class="form-check-input" type="radio" name="discountType" value="1" <?= $checked = ($product['discountType'] == '1') ? 'checked="checked"' : ''; ?>>
                                                                </span>

                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bold text-gray-800 d-block">İndirim Yok</span>
                                                                </span>
                                                            </label>
                                                        </div>

                                                        <div class="col">
                                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary <?= $checked = ($product['discountType'] == '2') ? 'active' : ''; ?> d-flex text-start p-6" data-kt-button="true">
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input class="form-check-input" type="radio" name="discountType" value="2" <?= $checked = ($product['discountType'] == '2') ? 'checked="checked"' : ''; ?>>
                                                                </span>

                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bold text-gray-800 d-block">Yüzde %</span>
                                                                </span>
                                                            </label>
                                                        </div>

                                                        <div class="col">
                                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary <?= $active = ($product['discountType'] == '3') ? 'active' : ''; ?> d-flex text-start p-6" data-kt-button="true">
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input class="form-check-input" type="radio" name="discountType" value="3" <?= $checked = ($product['discountType'] == '3') ? 'checked="checked"' : ''; ?>>
                                                                </span>

                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bold text-gray-800 d-block">Sabit Fiyat</span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-wrap gap-5">
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <label class="form-label">İmdirim Tutarı</label>

                                                        <input name="discount" type="text" class="form-control mb-2" value="<?=$product['discount']?>">

                                                        <div class="text-muted fs-7">Ürün indirimini ayarlayın.</div>
                                                    </div>

                                                    <div class="fv-row w-100 flex-md-root">
                                                        <label class="form-label">KDV Tutarı (%)</label>

                                                        <input name="kdv" type="text" class="form-control mb-2" value="<?=$product['kdv']?>">

                                                        <div class="text-muted fs-7">Ürün KDV'sini yaklaşık olarak ayarlayın.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                                    <div class="d-flex flex-column gap-7 gap-lg-10">

                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Envanter</h2>
                                                </div>
                                            </div>

                                            <div class="card-body pt-0">
                                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Stok Kod</label>

                                                    <input type="text" name="stockCode" class="form-control mb-2" placeholder="Stok Kodu" value="<?=$product['stockCode']?>">

                                                    <div class="text-muted fs-7">Ürün stok kodunu giriniz.</div>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>

                                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">barkod</label>

                                                    <input type="text" name="barcode" class="form-control mb-2" placeholder="Barkod numarası" value="<?=$product['barcode']?>">

                                                    <div class="text-muted fs-7">Ürün barkod numarasını giriniz.</div>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>

                                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Miktar</label>

                                                    <div class="d-flex gap-3">
                                                        <input type="number" name="stockShelf" class="form-control mb-2" placeholder="Rafta" value="<?=$product['stockShelf']?>">
                                                        <input type="number" name="stockTank" class="form-control mb-2" placeholder="Depoda" value="<?=$product['stockTank']?>">
                                                    </div>

                                                    <div class="text-muted fs-7">Ürün miktarını giriniz.</div>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Varyasyonlar</h2>
                                                </div>
                                            </div>

                                            <div class="card-body pt-0">
                                                <div class="" data-kt-ecommerce-catalog-add-product="auto-options">

                                                    <div id="kt_ecommerce_add_product_options">
                                                        <div id="urunvaryantlar">
                                                            <div class="form-group">
                                                                <div data-repeater-list="varyant">
                                                                    <div data-repeater-item>
                                                                        <div class="form-group row mb-5">
                                                                            <?php $options = $db->query("select * from variantoptions where productId = $menu[4] limit 1")->fetchAll();
                                                                            foreach ($options as $option) {
                                                                                foreach(json_decode($option['variantContent']) as $variantSorgu) {
                                                                                    $sorguArray[] = $variantSorgu;
                                                                                }
                                                                            }

                                                                            $variants = $db->query("select * from variants where status = '1' order by id ASC")->fetchAll();
                                                                            foreach($variants as $key => $variant) { ?>
                                                                                <div class="col-md-3">
                                                                                    <label class="form-label"><?=$variant['name']?></label>
                                                                                    <select multiple name="contents<?=$key?>" class="form-select" data-kt-repeater="select2" data-placeholder="Bir seçenek seçin">
                                                                                        <option></option>
                                                                                        <?php foreach(json_decode($variant['contents']) as $variantOption) {
                                                                                            if (in_array($variantOption, $sorguArray)) { $selected = 'selected'; } else { $selected = ''; } ?>
                                                                                            <option <?=$selected?> value="<?=$variantOption?>"><?=$variantOption?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            <?php } ?>
                                                                            <div class="col-md-2 mt-10">
                                                                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-2mb2">
                                                                                    <i class="la la-trash-o fs-3"></i>Sil
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Ürün Seçenekleri</h2>
                                                </div>
                                            </div>

                                            <div class="card-body pt-0">
                                                <div class="" data-kt-ecommerce-catalog-add-product="auto-options">

                                                    <div id="kt_ecommerce_add_product_options">
                                                        <div id="urunvaryantlar2">

                                                            <div class="form-group">
                                                                <div data-repeater-list="options">
                                                                    <div class="col-md-5">
                                                                        <label for="secenekfiyat">Ürün Seçenek Fiyat</label>
                                                                        <input type="text" id="secenekfiyat" name="secenekfiyat" class="form-control mb-5" placeholder="Ürün Seçenek Fiyat" value="<?=$product['secenekfiyat']?>">
                                                                    </div>
                                                                    <?php foreach (json_decode($product['optionUrun']) as $optionUrun) { ?>
                                                                    <div data-repeater-item>
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-md-3">
                                                                                <input type="text" name="option" class="form-control mb-2" placeholder="Ürün Seçenek" value="<?=$optionUrun?>">
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-2mb2">
                                                                                    <i class="la la-trash-o fs-3"></i>Sil
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>



                                                            <div class="form-group">
                                                                <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
                                                                    <i class="la la-plus"></i>Başka bir seçenek ekle
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Meta Seçenekleri</h2>
                                                </div>
                                            </div>

                                            <div class="card-body pt-0">
                                                <div class="mb-10">
                                                    <label class="form-label">Meta Etiket Başlığı</label>

                                                    <input type="text" class="form-control mb-2" name="metaTitle" placeholder="Meta tag name" value="<?=$product['metaTitle']?>">

                                                    <div class="text-muted fs-7">Bir meta etiket başlığı ayarlayın. Basit ve kesin anahtar kelimeler olması önerilir.</div>
                                                </div>

                                                <div class="mb-10">
                                                    <label class="form-label">Meta Tag Açıklama</label>

                                                    <textarea name="metaDescription" id="metaDescription" class="form-control mb-2" cols="30" rows="5"><?=$product['metaDescription']?></textarea>
                                                    <div class="text-muted fs-7">Artan SEO sıralaması için ürüne bir meta etiket açıklaması ayarlayın.</div>
                                                </div>

                                                <div>
                                                    <label class="form-label">Meta Etiket Anahtar Kelimeleri</label>

                                                    <input name="metaKeywords" class="form-control mb-2" value="<?=$product['metaKeywords']?>">
                                                    <div class="text-muted fs-7">Ürünün ilgili olduğu anahtar kelimelerin bir listesini belirleyin. Her anahtar kelimenin arasına <code>,</code> koyarak anahtar kelimeleri ayırın.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="javascript:void(0)" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">
                                    Geri
                                </a>

                                <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
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