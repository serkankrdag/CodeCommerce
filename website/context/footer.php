<footer class="dark-footer skin-dark-footer style-2">
    <div class="footer-middle">
        <div class="container">
            <div class="row">

                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                    <div class="footer_widget">
                        <div class="row">
                            <div class="col-6">
                                <img src="../upload/settings/<?=$setting['logo']?>" class="img-footer small mb-2" alt="" />
                            </div>
                            <div class="col-6">
                                <div class="address mt-3">
                                    <?=$setting['address']?>
                                </div>
                                <div class="address mt-3">
                                    <?=$setting['phone']?><br><?=$setting['mail']?>
                                </div>
                                <div class="address mt-3">
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><a href="https://<?=$setting['facebook']?>"><i class="lni lni-facebook-filled"></i></a></li>
                                        <li class="list-inline-item"><a href="https://<?=$setting['twitter']?>"><i class="lni lni-twitter-filled"></i></a></li>
                                        <li class="list-inline-item"><a href="https://<?=$setting['youtube']?>"><i class="lni lni-youtube"></i></a></li>
                                        <li class="list-inline-item"><a href="https://<?=$setting['instagram']?>"><i class="lni lni-instagram-filled"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-6">
                    <div class="footer_widget">
                        <h4 class="widget_title">Kategoriler</h4>
                        <ul class="footer-menu">
                            <?php $categories = $db->query("select * from categories order by id ASC")->fetchAll();
                            foreach($categories as $category) { ?>
                                <li><a href="kategori/<?=$category['id']?>"><?=$category['name']?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-6">
                    <div class="footer_widget">
                        <h4 class="widget_title">Şirket</h4>
                        <ul class="footer-menu">
                            <li><a href="hakkimizda">Hakkımızda</a></li>
                            <li><a href="iletisim">İletişim</a></li>
                            <li><a href="giris">Giriş / Üye Ol</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 text-center">
                    <p class="mb-0">Copyright © 2023 <a href="https://www.sesasoft.com.tr/">sesasoft</a>. Tüm hakları saklıdır.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>


</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/ion.rangeSlider.min.js"></script>
<script src="assets/js/slick.js"></script>
<script src="assets/js/slider-bg.js"></script>
<script src="assets/js/lightbox.js"></script>
<script src="assets/js/smoothproducts.js"></script>
<script src="assets/js/snackbar.min.js"></script>
<script src="assets/js/jQuery.style.switcher.js"></script>
<script src="assets/js/custom.js"></script>

<script>
    function openWishlist() {
        document.getElementById("Wishlist").style.display = "block";
    }
    function closeWishlist() {
        document.getElementById("Wishlist").style.display = "none";
    }
</script>

<script>
    function openCart() {
        document.getElementById("Cart").style.display = "block";
    }
    function closeCart() {
        document.getElementById("Cart").style.display = "none";
    }
</script>

<script>
    function openSearch() {
        document.getElementById("Search").style.display = "block";
    }
    function closeSearch() {
        document.getElementById("Search").style.display = "none";
    }
</script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</body>
</html>