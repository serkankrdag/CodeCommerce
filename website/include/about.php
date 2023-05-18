<?php function hakkimizda() { global $db;

    $about = $db->query("select * from about where id = '1' limit 1")->fetch();

    breadcrump('Anasayfa','Sayfalar','Hakkımızda'); ?>

    <!-- ======================= About Us Detail ======================== -->
    <section class="middle">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="abt_caption">
                        <h2 class="ft-medium mb-4"><?=$about['title']?></h2>
                        <p class="mb-4"><?=$about['description']?></p>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="abt_caption">
                        <img src="../upload/about/<?=$about['picture']?>" class="img-fluid rounded" alt="" />
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ======================= About Us End ======================== -->

<?php } ?>