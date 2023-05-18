<?php function products() { global $db;

    $controle='';
    if(isset($_POST['sil'])){
        $id = $_POST["id"];
        $sorgu = $db->query("select * from products where id='$id'")->fetch();
        if ($sorgu['picture']!=''){
            $file = "../upload/products/".$sorgu['picture'];
            unlink($file);
        }
        if ($sorgu['pictures']!='') {
            foreach (json_decode($sorgu['pictures']) as $pictures) {
                $file = "../upload/products/".$pictures;
                unlink($file);
            }
        }

        $kayitSil = $db->exec("DELETE FROM products WHERE id='$id' limit 1");
        $ozellikSil = $db->exec("DELETE FROM variantoptions WHERE productId='$id'");

        if($kayitSil) {
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
                        <h4 class="mb-1 text-dark">Ürün Silindi</h4>
                        <span>Ürün silme işlemi başarılı bir şekilde gerçekleşti.</span>
                    </div>
                </div>
                ';
        } elseif (!$kayitSil) {
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
                        <h4 class="mb-1 text-dark">Ürün Silinemedi</h4>
                        <span>Ürün silme işlemi başarısız lütfen tekrar deneyin.</span>
                    </div>
                </div>
                ';
        }
    }


    breadcrumb('Kontrol Panel','Ürünler','Ürün Listeleme'); ?>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">

            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Ürün Ara" />
                                </div>
                                <div id="kt_datatable_example_1_export" class="d-none"></div>
                            </div>

                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <a href="javascript:void(0)" class="btn btn-danger">
                                    <i class="fas fa-trash-alt fs-7"></i> Toplu Sil
                                </a>
                                <a href="productsAdd" class="btn btn-primary">
                                    Ürün Ekle
                                </a>
                            </div>
                        </div>


                        <div class="card-body pt-0">
                            <div id="kt_ecommerce_products_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_datatable_example">
                                        <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 29.8906px;">
                                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_products_table .form-check-input" value="1">
                                                </div>
                                            </th>
                                            <th class="min-w-200px sorting" tabindex="0" aria-controls="kt_ecommerce_products_table" rowspan="1" colspan="1" aria-label="Ürün Adı" style="width: 275.812px;">Ürün Adı</th>
                                            <th class="min-w-100px sorting" tabindex="0" rowspan="1" colspan="1" aria-label="Barkod" style="width: 139.656px;">Barkod</th>
                                            <th class="min-w-100px sorting" tabindex="0" rowspan="1" colspan="1" aria-label="Fiyat" style="width: 139.656px;">Fiyat</th>
                                            <th class="min-w-100px sorting" tabindex="0" rowspan="1" colspan="1" aria-label="Durum" style="width: 139.656px;">Durum</th>
                                            <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 139.656px;">İşlem</th>
                                        </tr>
                                        </thead>

                                        <tbody class="fw-semibold text-gray-600" id="table">
                                        <?php $products = $db->query("select * from products order by id ASC")->fetchAll();
                                        foreach($products as $product) { ?>
                                        <tr class="odd">
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0)" class="symbol symbol-50px">
                                                        <span class="symbol-label" style="background-image:url(../upload/products/<?=$product['picture']?>);"></span>
                                                    </a>

                                                    <div class="ms-5">
                                                        <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="product_name"><?=$product['name']?></a>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="pe-0">
                                                <span class="fw-bold"><?=$product['barcode']?></span>
                                            </td>

                                            <td class="pe-0"><?=$product['price']?> TL</td>

                                            <?php $status = ($product['status'] == '1') ? '<div class="badge badge-light-success">Aktif</div>' : '<div class="badge badge-light-danger">pasif</div>'; ?>
                                            <td class="pe-0" data-order="Scheduled"><?=$status?></td>

                                            <form method="post">
                                                <input type="hidden" name="id" value="<?=$product['id']?>">
                                                <td class="text-end">
                                                    <a href="productsEdit/<?=$product['id']?>" class="btn btn-icon btn-light-primary btn-sm"><i class="far fa-edit fs-7"></i></a>
                                                    <button name="sil" type="submit" class="btn btn-icon btn-light-danger btn-sm"><i class="fas fa-trash-alt fs-7"></i></button>
                                                </td>
                                            </form>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }