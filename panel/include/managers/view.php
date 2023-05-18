<?php function managersView() { global $db; global $menu;

    if (isset($_POST['insert'])) {

        $dosyaYukleme = '';
        if ($_FILES) {

            $yol = "../upload/managers/";
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

                    $sorgu = $db->query("select * from managers where id='$menu[4]'")->fetch();
                    $file = "../upload/managers/".$sorgu['picture'];
                    unlink($file);
                }
            }
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        if ($_POST['password']!='') {
            $password = md5(sha1($_POST['password']));
            $password="password = '$password',";
        } else { $password=""; }

        if ($name!='' && $email!='') {
            $ekle = $db->exec("
            update managers set 
            name = '$name',
            $password
            $dosyaYukleme
            email = '$email'
            where id = '$menu[4]'
            ");
        }
    }

    $manager = $db->query("select * from managers where id = $menu[4] limit 1")->fetch();

    breadcrumb('Kontrol Panel','Yöneticiler','Yönetici Detay'); ?>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">

            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="d-flex flex-column flex-xl-row">
                        <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">

                            <div class="card mb-5 mb-xl-8">
                                <div class="card-body pt-15">
                                    <div class="d-flex flex-center flex-column mb-5">
                                        <div class="symbol symbol-150px symbol-circle mb-7">
                                            <?php $country = ($manager['picture'] != '') ? '../upload/managers/'.$manager['picture'] : 'assets/media/svg/files/blank-image.svg'; ?>
                                            <img src="<?=$country?>" alt="image">
                                        </div>

                                        <a href="javascript:void(0)" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                                            <?=$manager['name']?>
                                        </a>

                                        <a href="javascript:void(0)" class="fs-5 fw-semibold text-muted text-hover-primary mb-6">
                                            <?=$manager['email']?>
                                        </a>
                                    </div>

                                    <div class="d-flex flex-stack fs-4 py-3">
                                        <div class="fw-bold">
                                            Detaylar
                                        </div>

                                        <div class="badge badge-light-success d-inline">Yönetici</div>
                                    </div>

                                    <div class="separator separator-dashed my-3"></div>

                                    <div class="pb-5 fs-6">
                                        <div class="fw-bold mt-5">Telefon Numarası</div>
                                        <div class="text-gray-600">+90 <?=$manager['phone']?></div>
                                        <div class="fw-bold mt-5">E-posta</div>
                                        <div class="text-gray-600"><a href="#" class="text-gray-600 text-hover-primary"><?=$manager['email']?></a></div>
                                        <div class="fw-bold mt-5">Adres</div><?php $country = ($manager['country'] == 'TR') ? 'Türkiye' : 'İngiltere'; ?>
                                        <div class="text-gray-600"><?=$manager['adress']?> <?=$manager['city']?> / <?=$manager['district']?><br><?=$country?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex-lg-row-fluid ms-lg-15">
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_customer_overview" aria-selected="true" role="tab">Genel</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="kt_ecommerce_customer_overview" role="tabpanel">
                                    <div class="card pt-4 mb-6">
                                        <div class="card-header border-0">
                                            <div class="card-title">
                                                <h2>Profil</h2>
                                            </div>
                                        </div>

                                        <div class="card-body pt-0 pb-5">
                                            <form method="post" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                                                <div class="mb-7">
                                                    <div class="mt-1">
                                                        <style>
                                                            .image-input-placeholder {
                                                            <?php if (isset($manager['picture']) && !empty($manager['picture'])) { ?>
                                                                background-image: url(../upload/managers/<?=$manager["picture"]?>);
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
                                                    </div>
                                                </div>

                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <label class="fs-6 fw-semibold mb-2 required">Ad Soyad</label>

                                                    <input type="text" class="form-control form-control-solid" placeholder="" name="name" value="<?=$manager['name']?>">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>

                                                <div class="row row-cols-1 row-cols-md-2">
                                                    <div class="col">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <label class="fs-6 fw-semibold mb-2">
                                                                <span class="required">E-posta</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="E-posta adresi aktif olmalıdır" data-bs-original-title="E-posta adresi aktif olmalıdır" data-kt-initialized="1"></i>
                                                            </label>

                                                            <input type="email" class="form-control form-control-solid" placeholder="" name="email" value="<?=$manager['email']?>">
                                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <label class="fs-6 fw-semibold mb-2">
                                                                <span>Şifre</span>
                                                            </label>

                                                            <input type="password" class="form-control form-control-solid" placeholder="" name="password" value="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-end">
                                                    <button name="insert" type="submit" id="kt_ecommerce_customer_profile_submit" class="btn btn-light-primary">
                                                        <span class="indicator-label">
                                                            Kaydet
                                                        </span>
                                                        <span class="indicator-progress">
                                                            Lütfen bekleyin... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </form>
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




<?php }