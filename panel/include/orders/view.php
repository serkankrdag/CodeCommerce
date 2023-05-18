<?php function ordersView() { global $db; global $menu;

    $order = $db->query("select * from orders where id = $menu[4] limit 1")->fetch();

    breadcrumb('Kontrol Panel','Siparişler','Sipariş Detay'); ?>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">

            <div class="d-flex flex-column gap-7 gap-lg-10">
                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">

                    <div class="card card-flush py-4  flex-row-fluid">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Müşteri detayları</h2>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-semibold text-gray-600">
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                                <span class="svg-icon svg-icon-2 me-2">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor"></path>
                                                        <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor"></path>
                                                        <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"></rect>
                                                    </svg>
                                                </span>
                                                Müşteri
                                            </div>
                                        </td>

                                        <td class="fw-bold text-end">
                                            <div class="d-flex align-items-center justify-content-end">
                                                <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">
                                                    <?=$order['name']?>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                                <span class="svg-icon svg-icon-2 me-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor"></path>
                                                        <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                E-posta
                                            </div>
                                        </td>
                                        <td class="fw-bold text-end">
                                            <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">
                                                <?=$order['email']?>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                                <span class="svg-icon svg-icon-2 me-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z" fill="currentColor"></path>
                                                        <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                Telefon
                                            </div>
                                        </td>

                                        <td class="fw-bold text-end"><?=$order['numara']?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card card-flush py-4  flex-row-fluid">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Sipariş Ayrıntıları (#<?=$order['siparisNo']?>)</h2>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-semibold text-gray-600">
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                                <span class="svg-icon svg-icon-2 me-2">
                                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="currentColor"></path>
                                                        <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                Sipariş Tarihi
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Bu sipariş tarafından oluşturulan sipariş tarihi görüntüleyin." data-kt-initialized="1"></i>
                                            </div>
                                        </td>
                                        <td class="fw-bold text-end"><a href="javascript:void(0)" class="text-gray-600 text-hover-primary"><?=$order['tarih']?></a></td>
                                    </tr>

                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                                <span class="svg-icon svg-icon-2 me-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="currentColor"></path>
                                                        <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="currentColor"></path>
                                                        <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                Sipariş No
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Bu sipariş tarafından oluşturulan sipariş no görüntüleyin." data-kt-initialized="1"></i>
                                            </div>
                                        </td>
                                        <td class="fw-bold text-end"><a href="javascript:void(0)" class="text-gray-600 text-hover-primary">#<?=$order['siparisNo']?></a></td>
                                    </tr>

                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                                <span class="svg-icon svg-icon-2 me-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="currentColor"></path>
                                                        <path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                Teslimat Adresi
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Bu sipariş için gönderi adresi." data-kt-initialized="1"></i>
                                            </div>
                                        </td>
                                        <td class="fw-bold text-end"><a href="javascript:void(0)" class="text-gray-600 text-hover-primary"><?=$order['adres']?></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-flush py-4  flex-row-fluid">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Ekstra İstenen Ürünler</h2>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <div class="table-responsive">

                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <tbody class="fw-semibold text-gray-600">
                                <?php if ($order['secenekdeger'] != '') {
                                    foreach (json_decode($order['secenekdeger']) as $secenekbilgi) { ?>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="currentColor"></path>
                                                            <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="currentColor"></path>
                                                            <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    Ekstra Ürün
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end"><?=$secenekbilgi?></td>
                                        </tr>
                                   <?php }
                                } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Sipariş #<?=$order['siparisNo']?></h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                            <thead>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-175px">Ürün Adı</th>
                                                <th class="min-w-100px text-end">Stok Kodu</th>
                                                <th class="min-w-100px text-end">Seçenekler</th>
                                                <th class="min-w-100px text-end">Varyant</th>
                                                <th class="min-w-70px text-end">Adet</th>
                                                <th class="min-w-100px text-end">Birim Fiyat</th>
                                                <th class="min-w-100px text-end">Toplam</th>
                                            </tr>
                                            </thead>

                                            <tbody class="fw-semibold text-gray-600">
                                            <?php foreach (json_decode($order['urunbilgi']) as $urunsayi) {
                                                $urunbilgi = json_decode(json_encode($urunsayi),true); $urunId = $urunbilgi['id'];
                                                $urun = $db->query("select * from products where id = '$urunId' limit 1")->fetch(); ?>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="javascript:void(0)" class="symbol symbol-50px">
                                                                <span class="symbol-label" style="background-image:url(../upload/products/<?=$urun['picture']?>);"></span>
                                                            </a>

                                                            <div class="ms-5">
                                                                <a href="javascript:void(0)" class="fw-bold text-gray-600 text-hover-primary"><?=$urun['name']?></a>
                                                                <div class="fs-7 text-muted">Sipariş Tarihi: <?=$order['tarih']?></div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="text-end">
                                                        <?=$urun['stockCode']?>
                                                    </td>

                                                    <td class="text-end">
                                                        <?=$urun['stockCode']?>
                                                    </td>

                                                    <td class="text-end">
                                                        <?= $varyant = ($urunbilgi['varyant'] == '0') ? 'Yok' : $urunbilgi['varyant']; ?>
                                                    </td>

                                                    <td class="text-end">
                                                        <?=$urunbilgi['adet']?>
                                                    </td>

                                                    <td class="text-end">
                                                        <?=$urun['discountedPrice']?>.00 TL
                                                    </td>

                                                    <td class="text-end">
                                                        <?=$urun['discountedPrice'] * $urunbilgi['adet']?>.00 TL
                                                    </td>
                                                </tr>

                                                <?php
                                                $price[] = $urun['discountedPrice'] * $urunbilgi['adet'];
                                                ?>
                                            <?php } ?>

                                            <tr>
                                                <td colspan="6" class="text-end">
                                                    Ara Toplam
                                                </td>
                                                <td class="text-end">
                                                    <?=array_sum($price)?>.00 TL
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="6" class="text-end">
                                                    Kupon
                                                </td>
                                                <td class="text-end">
                                                    <?= $kupon = ($order['kupon'] == '') ? 0 : $order['kupon']; ?>.00 TL
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="6" class="text-end">
                                                    Ekstra Ürün
                                                </td>
                                                <td class="text-end">
                                                    <?= $secenek = ($order['secenek'] == '') ? 0 : $order['secenek']; ?>.00 TL
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="6" class="fs-3 text-dark text-end">
                                                    Genel Toplam
                                                </td>
                                                <td class="text-dark fs-3 fw-bolder text-end">
                                                    <?=array_sum($price) + $secenek - $kupon?>.00 TL
                                                </td>
                                            </tr>

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
    </div>
<?php }