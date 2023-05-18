<?php function membersView() { global $db; global $menu;

    $controle='';
    if ($_POST) {

        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $ekle = $db->exec("
            update members set 
            name = '$name',
            phone = '$phone',
            email = '$email'
            where id = '$menu[4]'
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


    $member = $db->query("select * from members where id = $menu[4] limit 1")->fetch();

    breadcrumb('Kontrol Panel','Üyeler','Üye Detay'); ?>

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
                                            <img src="assets/media/svg/avatars/001-boy.svg" alt="image">
                                        </div>

                                        <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                                            <?=$member['name']?>
                                        </a>

                                        <a href="#" class="fs-5 fw-semibold text-muted text-hover-primary mb-6">
                                            <?=$member['email']?>
                                        </a>
                                    </div>

                                    <div class="d-flex flex-stack fs-4 py-3">
                                        <div class="fw-bold">
                                            Detaylar
                                        </div>

                                        <div class="badge badge-light-info d-inline">Üye</div>
                                    </div>

                                    <div class="separator separator-dashed my-3"></div>

                                    <div class="pb-5 fs-6">
                                        <div class="fw-bold mt-5">Hesap Kimliği</div>
                                        <div class="text-gray-600">Kimlik-<?=$member['id']?></div>
                                        <div class="fw-bold mt-5">Telefon Numarası</div>
                                        <div class="text-gray-600"><?=$member['phone']?></div>
                                        <div class="fw-bold mt-5">Faturalandırma E-postası</div>
                                        <div class="text-gray-600"><a href="#" class="text-gray-600 text-hover-primary"><?=$member['email']?></a></div>
                                        <div class="fw-bold mt-5">Teslimat adresi</div>
                                        <div class="text-gray-600"><?=$member['adress']?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex-lg-row-fluid ms-lg-15">
                            <?=$controle?>
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_customer_overview" aria-selected="true" role="tab">Genel</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_customer_general" aria-selected="false" role="tab" tabindex="-1">Genel Ayarlar</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="kt_ecommerce_customer_overview" role="tabpanel">
                                    <div class="card pt-4 mb-6 mb-xl-9">
                                        <div class="card-header border-0">
                                            <div class="card-title">
                                                <h2>İşlem Geçmişi</h2>
                                            </div>
                                        </div>

                                        <div class="card-body pt-0 pb-5">
                                            <div id="kt_ecommerce_products_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div class="table-responsive">
                                                    <table class="table align-middle table-row-dashed gy-5 dataTable no-footer" id="kt_datatable_example">
                                                        <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                                        <tr class="text-start text-muted text-uppercase gs-0">
                                                            <th class="min-w-100px sorting" tabindex="0" rowspan="1" colspan="1">Müşteri No</th>
                                                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Durum</th>
                                                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Fiyat</th>
                                                            <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">Tarih</th></tr>
                                                        </thead>
                                                        <tbody class="fs-6 fw-semibold text-gray-600"><?php $uyeId = $member['id'] ?>
                                                        <?php $orders = $db->query("select * from orders where uyeId = '$uyeId' order by id ASC")->fetchAll();
                                                        foreach ($orders as $order) { ?>
                                                            <tr class="odd">
                                                                <td>
                                                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">#<?=$order['siparisNo']?></a>
                                                                </td>
                                                                <?php $status = ($order['durum'] == '1') ? '<div class="badge badge-light-success">Başarılı</div>' : '<div class="badge badge-light-danger">Başarısız</div>'; ?>
                                                                <td class="pe-0" data-order="Scheduled"><?=$status?></td>
                                                                <td><?=$order['kuponsuzTutar']?> TL</td>
                                                                <td><?=$order['tarih']?></td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_ecommerce_customer_general" role="tabpanel">
                                    <div class="card pt-4 mb-6">
                                        <div class="card-header border-0">
                                            <div class="card-title">
                                                <h2>Profil</h2>
                                            </div>
                                        </div>

                                        <div class="card-body pt-0 pb-5">
                                            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" method="post">

                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <label class="fs-6 fw-semibold mb-2 required">Ad Soyad</label>

                                                    <input type="text" class="form-control form-control-solid" placeholder="" name="name" value="<?=$member['name']?>">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>

                                                <div class="row row-cols-1 row-cols-md-2">
                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <label class="fs-6 fw-semibold mb-2">
                                                                <span>Telefon</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="Telefon numarası aktif olmalıdır" data-bs-original-title="Telefon numarası aktif olmalıdır" data-kt-initialized="1"></i>
                                                            </label>

                                                            <input type="text" class="form-control form-control-solid" placeholder="" name="phone" value="<?=$member['phone']?>">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <label class="fs-6 fw-semibold mb-2">
                                                                <span>E-posta</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="E-posta adresi aktif olmalıdır" data-bs-original-title="E-posta adresi aktif olmalıdır" data-kt-initialized="1"></i>
                                                            </label>

                                                            <input type="email" class="form-control form-control-solid" placeholder="" name="email" value="<?=$member['email']?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" id="kt_ecommerce_customer_profile_submit" class="btn btn-light-primary">
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