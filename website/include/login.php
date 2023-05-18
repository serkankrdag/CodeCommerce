<?php function giris() { global $db;

    if (empty($_SESSION['login'])) {

    $sorgu='';
    if ($_POST) {
        if ($_POST['controle'] == 1) {
            $login = $db->prepare("select COUNT(*) from members where email = ? and password = ?");
            $login->execute([$_POST['email'],md5(sha1($_POST['password']))]);
            $count = $login->fetchColumn();
            if ($count>0) {
                $login = $db->prepare("select * from members where email = ? and password = ?");
                $login->execute([$_POST['email'],md5(sha1($_POST['password']))]);
                $sorgu = $login->fetch();

                $_SESSION["login"] = 'success';
                $_SESSION["idu"] = $sorgu['id'];
                echo '<script>window.location.href = "siparislerim";</script>';
            } else {
                $ekle = '3';
            }
        }

        if ($_POST['controle'] == 2) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];

            $members = $db->query("select * from members where email = '$email' limit 1")->fetch();

            if ($password == $password2) {
                if (!$members) {
                    $passwordEkle = md5(sha1($password));

                    $ekle = $db->exec("
                    insert into members set 
                    name = '$name',
                    email = '$email',
                    password = '$passwordEkle'
                "); $ekle='0';
                } else {
                    $ekle='1';
                }
            } else {
                $ekle='2';
            }
        }

        if ($ekle == 2) {
            $sorgu =
            '
            <div class="alert alert-danger" role="alert">
              Girilen Şifreler Uyuşmuyor
            </div>
            ';
        } elseif ($ekle == 1) {
            $sorgu =
            '
            <div class="alert alert-danger" role="alert">
              Girilen E-Posta Kullanılıyor
            </div>
            ';
        } elseif ($ekle == 0) {
            $sorgu =
            '
            <div class="alert alert-success" role="alert">
                Kayıt İşlemi Başarılı
            </div>
            ';
        } elseif ($ekle == 3) {
            $sorgu =
            '
            <div class="alert alert-danger" role="alert">
              Kullanıcı Adı veya Şifre Hatalı
            </div>
            ';
        }
    }

    breadcrump('Anasayfa','Sayfalar','Giriş'); ?>

    <!-- ======================= Login Detail ======================== -->
    <section class="middle">
        <div class="container">
            <?=$sorgu?>
            <div class="row align-items-start justify-content-between">

                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <form method="post" class="border p-3 rounded">
                        <div class="form-group">
                            <label>E-Posta</label>
                            <input name="email" type="text" class="form-control" placeholder="E-Posta">
                        </div>

                        <div class="form-group">
                            <label>Şifre</label>
                            <input name="password" type="password" class="form-control" placeholder="Şifre">
                        </div>

                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="eltio_k2">
                                    <a href="iletisim">Şifreni mi unuttun?</a>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="controle" value="1">

                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Giriş yap</button>
                        </div>
                    </form>
                </div>


                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mfliud">
                    <form method="post" class="border p-3 rounded">

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Ad Soyad *</label>
                                <input name="name" type="text" class="form-control" placeholder="Ad Soyad">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>E-Posta *</label>
                            <input name="email" type="text" class="form-control" placeholder="E-Posta">
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Şifre *</label>
                                <input name="password" type="password" class="form-control" placeholder="Şifre">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Şifre Tekrar *</label>
                                <input name="password2" type="password" class="form-control" placeholder="Şifre Tekrar">
                            </div>
                        </div>

                        <div class="form-group">
                            <p>Bilgilerinizi kaydederek, Şartlar ve Koşullarımızı ve Gizlilik ve Çerez Politikamızı kabul etmiş olursunuz.</p>
                        </div>

                        <input type="hidden" name="controle" value="2">

                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Bir hesap oluşturun</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
    <!-- ======================= Login End ======================== -->

<?php } else {
        echo '<script>window.location.href = "siparislerim";</script>';
    }
 } ?>