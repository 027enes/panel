
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="author" content="Miova">
    <title>

    </title>
    <meta name="description" content="">
    <meta name="keywords" content="

    <meta name="og:title" content="  ">
    <meta name="og:description" content=" ">
    <meta name="og:image" content="">
    <!-- favicon icon -->
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="apple-touch-icon" href="images/">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/images/Hoylu">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/images/Hoylu">
    <!-- google fonts preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- style sheets and font icons  -->
    <link rel="stylesheet" href="<?= site_assets('css/vendors.min.css') ?>"/>
    <link rel="stylesheet" href="<?= site_assets('css/icon.min.css') ?>"/>
    <link rel="stylesheet" href="<?= site_assets('css/style.css?v=0.0.6') ?>"/>
    <link rel="stylesheet" href="<?= site_assets('css/responsive.css') ?>"/>
    <link rel="stylesheet" href="<?= site_assets('css/main.css?v=0.0.7') ?>" />
    <link rel="stylesheet" href="<?= site_assets('css/hoylu.css') ?>" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
    .ekatalog-button{
        background-color: #5E4027!important;
        color: #fff!important;
    }
    .ekatalog-button svg{
        color: #fff!important;
    }
    .ekatalog-button a{
        color: #fff!important;
    }
</style>
</head>
<body data-mobile-nav-style="classic">
<!-- start header -->
<header>
    <!-- start navigation -->
    <nav class="navbar navbar-expand-lg header-light bg-white border-bottom border-color-extra-medium-gray header-reverse" data-header-hover="light">
        <div class="container-fluid">
            <div class="col-auto">
                <a class="navbar-brand" href="<cms:show k_site_link />">
                    <img src="<cms:show k_site_link />assets/images/hoylu/logo-foot.png" data-at2x="<cms:show k_site_link />assets/images/hoylu/logo-foot.png" alt="" class="default-logo">
                    <img src="<cms:show k_site_link />assets/images/hoylu/logo-foot.png" data-at2x="<cms:show k_site_link />assets/images/hoylu/logo-foot.png" alt="" class="alt-logo">
                    <img src="<cms:show k_site_link />assets/images/hoylu/logo-foot.png" data-at2x="<cms:show k_site_link />assets/images/hoylu/logo-foot.png" alt="" class="mobile-logo">
                </a>
            </div>
            <div class="col-auto menu-order left-nav ps-60px lg-ps-20px">
                <button class="navbar-toggler float-start" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav alt-font">
                        <li class="nav-item"><a href="<cms:link masterpage='index.php' />" class="nav-link">Anasayfa</a></li>
                        <li class="nav-item"><a href="<cms:link masterpage='hakkimizda.php' />" class="nav-link">Hakkımızda</a></li>
                        <li class="nav-item dropdown submenu">
                            <a href="#" class="nav-link">Projelerimiz</a>
                            <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink1" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <div class="dropdown-menu mi-border-b-2 mi-border-b-black mi-p-0 mi-h-auto md:mi-h-64 submenu-content" aria-labelledby="navbarDropdownMenuLink1">
                                <div class="d-lg-flex md:mi-h-full nav-mob-mega-menu mega-menu mi-w-full ps-5 pe-5 md-ps-0 md-pe-0 md-pt-15px mi-p-0">
                                    <div class="nav-mob-row  mi-h-full row row-cols-2 row-cols-lg-3 row-cols-sm-3 w-100 mx-0 align-items-center mi-justify-between">
                                        <cms:folders masterpage='projelerimiz.php' order='asc' orderby='weight' include_custom_fields="1">
                                        <div class="nav-mob-text col md-mb-30px mi-h-auto md:mi-h-full  mi-px-[1px]  mi-relative">
                                            <a href="<cms:show k_folder_link />" class="mi-h-full opacity-10  text-center mi-justify-between flex-column d-flex mi-pb-0 mi-overflow-hidden">
                                                                <span class="nav-mob-icon mi-w-full mi-h-full   bg-white d-flex justify-content-center box-shadow-large position-relative projects_hover_after">
                                                                    <img src="<cms:show k_folder_image />" class="mi-w-full mi-h-full mi-object-cover  hover:mi-scale-125 mi-transition-all mi-duration-300 mi-relative " alt="<cms:show k_folder_title />">
                                                                    <span class="text-uppercase alt-font fw-700 mi-text-white fs-12 lh-22 mi-bg-hoylu-700  border-radius-4px position-absolute mi-right-2 top-5px ps-10px pe-10px"><cms:show k_folder_pagecount /></span>
                                                                </span>
                                                <span class="md:mi-px-0 mi-px-4 alt-font fw-600 mi-text-lg md:mi-text-xl mi-text-black  md:mi-text-white mi-relative md:mi-absolute md:mi-bottom-4 md:mi-left-8"><cms:show k_folder_title /></span>
                                            </a>
                                        </div>
                                        </cms:folders>

                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item"><a href="<cms:link masterpage='iletisim.php' />" class="nav-link">İletişim</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- end navigation -->
</header>
<!-- end header -->