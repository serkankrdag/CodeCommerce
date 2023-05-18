<?php function iletisim() { global $db;

    $sorgu = '';
    if ($_POST) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $title = $_POST['title'];
        $message = $_POST['message'];

        $ekle = $db->exec("
            insert into contact set 
            name = '$name',
            email = '$email',
            title = '$title',
            message = '$message'
        ");

        if ($ekle) {
            $sorgu =
                '
            <div class="alert alert-success" role="alert">
              Mesajınız iletildi
            </div>
            ';
        } elseif (!$ekle) {
            $sorgu =
                '
            <div class="alert alert-danger" role="alert">
              Mesaj iletilirken hata oluştu
            </div>
            ';
        }
    }

    $settings = $db->query("select * from settings where id = '1' limit 1")->fetch();

    breadcrump('Anasayfa','Sayfalar','İletişim'); ?>

    <!-- ======================= Contact Page Detail ======================== -->
    <section class="middle">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h2 class="off_title">Bize Ulaşın</h2>
                        <h3 class="ft-bold pt-3">Temas Kurun</h3>
                    </div>
                </div>
            </div>

            <div class="row align-items-start justify-content-between">

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <div class="card-wrap-body mb-4">
                        <h4 class="ft-medium mb-3 theme-cl">Adres</h4>
                        <p><?=$settings['address']?></p>
                    </div>

                    <div class="card-wrap-body mb-3">
                        <h4 class="ft-medium mb-3 theme-cl">Arama yap</h4>
                        <p class="lh-1"><span class="text-dark ft-medium">Telefon:</span> <?=$settings['phone']?></p>
                        <p class="lh-1"><span class="text-dark ft-medium">E-Posta:</span> <?=$settings['mail']?></p>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-8 col-md-12 col-sm-12">
                    <?=$sorgu?>
                    <form method="post" class="row">

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">Adınız</label>
                                <input name="name" type="text" class="form-control" value="">
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">E-Posta Adresiniz</label>
                                <input name="email" type="text" class="form-control" value="">
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">Konu Başlığı</label>
                                <input name="title" type="text" class="form-control" value="">
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">Mesajınız</label>
                                <textarea name="message" class="form-control ht-80"></textarea>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark">Mesaj Gönder</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>
    <!-- ======================= Contact Page End ======================== -->

<?php } ?>