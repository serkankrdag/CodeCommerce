<?php function profilbilgi() { global $db;

    if (isset($_SESSION['login'])) { $id = $_SESSION["idu"];

        $memberse = $db->query("select * from members where id = '$id' limit 1")->fetch();

        $controle = '';
        if ($_POST) {
            if ($_POST['password']) {
                if (md5(sha1($_POST['password'])) == $memberse['password']) {
                    $name = $_POST['name'];
                    $adress = $_POST['adress'];
                    $password = md5(sha1($_POST['password2']));

                    $ekle = $db->exec("
                    update members set 
                    name = '$name',
                    adress = '$adress',
                    password = '$password'
                    where id = '$id'
                ");
                    $sonuc = '1';
                } else {
                    $sonuc = '2';
                }
            } else {
                $name = $_POST['name'];
                $adress = $_POST['adress'];

                $ekle = $db->exec("
                update members set 
                name = '$name',
                adress = '$adress'
                where id = '$id'
            ");
                $sonuc = '3';
            }

            if ($sonuc == 1) {
                $controle =
                    '
            <div class="alert alert-success" role="alert">
              Başarılı Birşekilde Güncellendi
            </div>
            ';
            } elseif ($sonuc == 2) {
                $controle =
                    '
            <div class="alert alert-danger" role="alert">
              Mevcut Şifre Hatalı
            </div>
            ';
            } elseif ($sonuc == 3) {
                $controle =
                    '
            <div class="alert alert-success" role="alert">
                Başarılı Birşekilde Güncellendi
            </div>
            ';
            }
        }

        $memberss = $db->query("select * from members where id = '$id' limit 1")->fetch();

        breadcrump('Anasayfa','Üye Panel','Profil Bilgi'); ?>

        <!-- ======================= Dashboard Detail ======================== -->
        <section class="middle">
            <div class="container">
                <div class="row align-items-start justify-content-between">

                    <?php membersmenu('profilbilgi'); ?>

                    <div class="col-12 col-md-12 col-lg-8 col-xl-8">
                        <!-- row -->
                        <?=$controle?>
                        <div class="row align-items-center">
                            <form method="post" class="row m-0">

                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="small text-dark ft-medium">Ad Soyad *</label>
                                        <input name="name" type="text" class="form-control" value="<?=$memberss['name']?>" />
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">E-Posta *</label>
                                        <input disabled type="text" class="form-control" value="<?=$memberss['email']?>" />
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="small text-dark ft-medium">Adres *</label>
                                        <textarea name="adress" class="form-control ht-80"><?=$memberss['adress']?></textarea>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="small text-dark ft-medium">Şimdiki Parola *</label>
                                        <input name="password" type="password" class="form-control" value="" />
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="small text-dark ft-medium">Yeni Paralo *</label>
                                        <input name="password2" type="password" class="form-control" value="" />
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-dark">Kaydet</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- row -->
                    </div>

                </div>
            </div>
        </section>
        <!-- ======================= Dashboard Detail End ======================== -->

    <?php } else {
        echo '<script>window.location.href = "giris";</script>';
    }
} ?>