

        <section class="pb-0 mi-pt-0">
            <div class="w-100">
                <iframe src="<cms:show maps/>" class="-mi-bottom-3" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

<footer class="footer-bg-gradient position-relative">
    <div class="background-position-center-top h-100 w-100 position-absolute left-0px top-0" style="background-image: url('<cms:show k_site_link />assets/images/vertical-line-bg-small.svg')"></div>
    <div class="container mi-text-white text-center text-sm-start position-relative">
        <div class="row mb-5 sm-mb-7 xs-mb-30px">
            <!-- start footer column -->
            <div class="col-lg-3 col-md-4 col-sm-6 d-flex flex-column last-paragraph-no-margin md-mb-40px xs-mb-30px">
                <a href="demo-elearning.html" class="footer-logo mb-15px d-inline-block">
                    <img src="<cms:show k_site_link />assets/images/hoylu/logo-foot-1.png" alt="">
                </a>
                <p class="lh-28">Hoylu İnşaat olarak mimariyi ve yaşam alanlarını oluştururken her ayrıntıya ayrı bir özen ile yaklaşarak kalite anlamında asla taviz vermiyor</p>
                <div class="elements-social social-text-style-01 mt-9 xs-mt-15px">
                    <ul class="small-icon light fw-500">

                            <li><a class="<cms:show socialicon />" style="font-size: 24px" href="<cms:show sociallink />" target="_blank"><i class="fa-brands fa-<cms:show socialicon />"></i></a></li>

                    </ul>
                </div>
            </div>
            <!-- end footer column -->
            <!-- start footer column -->
            <div class="col-lg-3 col-md-4 col-sm-6 ps-4 last-paragraph-no-margin md-mb-40px xs-mb-30px">
                <span class="fw-500 fs-18 d-block text-white mb-10px">Hoylu Yapı</span>
                <ul>
                    <li><a class="mi-text-white" href="<cms:link masterpage='index.php' />">Anasayfa</a></li>
                    <li><a class="mi-text-white" href="<cms:link masterpage='hakkimizda.php' />">Hakkımızda</a></li>
                    <li><a class="mi-text-white" href="<cms:link masterpage='iletisim.php' />">İletişim</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 ps-4 last-paragraph-no-margin md-mb-40px xs-mb-30px">
                <span class="fw-500 fs-18 d-block text-white mb-10px">Projelerimiz</span>
                <ul>
                        <li><a class="mi-text-white" href="<cms:show k_folder_link />"><cms:show k_folder_title /></a></li>

                </ul>
            </div>
            <!-- end footer column -->
            <!-- start footer column -->
            <div class="col-lg-3 col-md-4 col-sm-6 last-paragraph-no-margin xs-mb-30px">

                    <span class="fw-500 fs-18 d-block text-white mb-10px">İletişime Geçin </span>
                        <a href="mailto:<cms:show locationemail />" class="text-decoration-line-bottom lh-22 d-inline-block mb-20px mi-text-white"><cms:show locationemail /></a><br>
                        <a href="tel:<cms:show locationphone />" class="text-decoration-line-bottom lh-22 d-inline-block mi-text-white"><cms:show locationphone /></a>

            </div>
        </div>
        <div class="row align-items-center footer-bottom border-top border-color-transparent-white-light pt-30px g-0">
            <!-- end footer menu -->
            <!-- start copyright -->
            <div class="col-xl-12 last-paragraph-no-margin text-center text-xl-center">
                <p class="fs-16">&copy; <cms:php>echo date('Y');</cms:php> crafted with passion, the <a href="https://miova.com.tr" target="_blank" class="text-white text-decoration-line-bottom">Miova</a> signature.</p>
            </div>
            <!-- start copyright -->
        </div>
    </div>
</footer>
<!-- start scroll progress -->
<div class="scroll-progress d-none d-xxl-block">
    <a href="#" class="scroll-top" aria-label="scroll">
        <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
    </a>
</div>
<!-- end scroll progress -->
<!-- javascript libraries -->
<script type="text/javascript" src="<?= site_assets('js/jquery.js') ?>"></script>
<script type="text/javascript" src="<?= site_assets('js/vendors.min.js') ?>"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCA56KqSJ11nQUw_tXgXyNMiPmQeM7EaSA&callback=initMap"></script>
<script type="text/javascript" src="<?= site_assets('js/main.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script type="module">import { Fancybox } from "https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.esm.js";</script>
<link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
<script>
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 10,
    loop: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 40,
        },
        1024: {
            slidesPerView: 5,
            spaceBetween: 50,
        },
    },
});
</script>


</body>
</html>