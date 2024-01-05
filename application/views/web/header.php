<!DOCTYPE html>
<?php
$menu 		= strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
	<title><?= $judul_web; ?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="<?php echo $this->Mcrud->judul_web(); ?>" name="description" />
	<meta content="<?php echo $this->Mcrud->judul_web(); ?>" name="keywords" />
	<base href="<?php echo base_url(); ?>">
	<link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon" />
  <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&amp;subset=all' rel='stylesheet' type='text/css'>
  <link href="assets/web/plugins/socicon/socicon.css" rel="stylesheet" type="text/css"/>
  <link href="assets/web/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" type="text/css"/>
  <link href="assets/web/plugins/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet">
  <link href="assets/web/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
  <link href="assets/web/plugins/animate/animate.min.css" rel="stylesheet" type="text/css"/>
  <link href="assets/web/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

  <link href="assets/web/plugins/revo-slider/css/settings.css" rel="stylesheet" type="text/css"/>
  <link href="assets/web/plugins/revo-slider/css/layers.css" rel="stylesheet" type="text/css"/>
  <link href="assets/web/plugins/revo-slider/css/navigation.css" rel="stylesheet" type="text/css"/>
  <link href="assets/web/plugins/cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet" type="text/css"/>
  <link href="assets/web/plugins/owl-carousel/assets/owl.carousel.css" rel="stylesheet" type="text/css"/>
  <link href="assets/web/plugins/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
  <link href="assets/web/plugins/slider-for-bootstrap/css/slider.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="assets/web/plugins/leafletjs/leaflet.css" />

  <link href="assets/web/plugins/ilightbox/css/ilightbox.css" rel="stylesheet" type="text/css"/>

  <link href="assets/web/demos/default/css/plugins.css" rel="stylesheet" type="text/css"/>
  <link href="assets/web/demos/default/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
  <link href="assets/web/demos/default/css/themes/default.css" rel="stylesheet" id="style_theme" type="text/css"/>
  <link href="assets/web/demos/default/css/custom.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="assets/web/dataTables/css/jquery.dataTables.min.css">
  <!-- END THEME STYLES -->

</head>
<!-- <script>
var button=document.getElementById("autoKlik");
    setInterval(function(){ 
        button.click();
     }, 10);
    </script> -->
<body class="c-layout-header-fixed c-layout-header-mobile-fixed">
  <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
  <!-- BEGIN: HEADER -->
  <header class="c-layout-header c-layout-header-4 c-layout-header-default-mobile" data-minimize-offset="80">
    <div class="c-navbar web-navbar">
      <div class="container">
        <!-- BEGIN: BRAND -->
        <div class="c-navbar-wrapper clearfix">        
          <div class="row equal">
            <div class="col-md-6 hidden-sm hidden-xs">
              <img class="logo-header" src="img/kanwil_ntb_white.png" alt="logo">
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
              <div class="c-brand c-pull-left hidden-lg hidden-md">
              <a >
                <a href="web" class="c-logo custom-brand" style="font-size:1em;font-weight:600;margin-top:30px;">E-MANDALIKA</a>
              </a>
                <button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
                    <span class="c-line"></span>
        
                    <span class="c-line"></span>
                    <span class="c-line"></span>
                  </button>
                  <button class="c-topbar-toggler" type="button">
                    <i class="fa fa-ellipsis-v"></i>
                  </button>
              </div>


              <!-- Dropdown menu toggle on mobile: c-toggler class can be applied to the link arrow or link itself depending on toggle mode -->
              <nav class="c-mega-menu c-mega-menu-onepage c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold custom-menu-mobile" data-onepage-animation-speed="700">
                <ul class="nav navbar-nav c-theme-nav">
                  <li class="<?php if($menu=='' OR $menu=='web' AND $sub_menu==''){echo "c-active ";} ?>c-menu-type-classic">
                    <a href="web" class="c-link">Beranda</a>
                  </li>
                  <li class="<?php if(($menu=='pengaduan' AND $sub_menu=='') OR ($menu=='pengaduan' AND $sub_menu=='cek') OR ($menu=='permohonan_bankum' AND $sub_menu=='') OR ($menu=='permohonan_bankum' AND $sub_menu=='cek')){echo "c-active ";} ?>c-menu-type-classic">
                    <a href="web" class="c-link dropdown-toggle">Layanan<span class="c-arrow c-toggler"></span></a>
                    <ul class="dropdown-menu c-menu-type-mega dropdown-layanan" style="min-width: auto">
                      <li>
                        <ul class="dropdown-menu c-menu-type-inline">
                          <li>
                            <h3>Permohonan Bantuan Hukum</h3>
                          </li>
                          <li class="<?php if($menu=='permohonan_bankum' AND $sub_menu!='cek'){echo "c-active ";} ?>">
                            <a href="permohonan_bankum">Buat Permohonan</a>
                          </li>
                          <li class="<?php if($menu=='permohonan_bankum' AND $sub_menu=='cek'){echo "c-active ";} ?>">
                            <a href="permohonan_bankum/cek">Tracking Permohonan</a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <ul class="dropdown-menu c-menu-type-inline">
                          <li>
                            <h3>Pengaduan Masyarakat</br>&nbsp;</h3>
                          </li>
                          <li class="<?php if($menu=='pengaduan' AND $sub_menu!='cek'){echo "c-active ";} ?>">
                            <a href="pengaduan">Buat </br>Pengaduan</a>
                          </li>
                          <li class="<?php if($menu=='pengaduan' AND $sub_menu=='cek'){echo "c-active ";} ?>">
                            <a href="pengaduan/cek">Tracking Pengaduan</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="<?php if($menu=='daftarobh' AND $sub_menu==''){echo "c-active ";} ?>c-menu-type-classic">
                    <a href="daftarobh" class="c-link">Daftar OBH</a>
                  </li>
                  <li class="<?php if($menu=='peraturan_terkait' AND $sub_menu==''){echo "c-active ";} ?>c-menu-type-classic">
                    <a class="c-link dropdown-toggle">Informasi<span class="c-arrow c-toggler"></span></a>
                    <ul class="dropdown-menu c-menu-type-classic c-pull-left">
                      <li class="dropdown-submenu">
                        <a href="web#realisasi_anggaran" class="c-link">Realisasi Anggaran</a>
                      </li>
                      <li class="dropdown-submenu <?php if($menu=='peraturan_terkait'){echo "c-active ";} ?>">
                        <a href="peraturan_terkait" class="c-link">Peraturan Terkait</a>
                      </li>
                    </ul>
                  </li>
                  <li class="c-menu-type-classic">
                    <a href="web/login.html" id="autoKlik" class="c-link">LOGIN<span class="c-arrow c-toggler"></span></a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <!-- END: MEGA MENU --><!-- END: LAYOUT/HEADERS/MEGA-MENU -->
          <!-- END: HOR NAV -->
        </div>
        <!-- BEGIN: LAYOUT/HEADERS/QUICK-CART -->
      </div>
    </div>
  </header>
  <!-- END: HEADER --><!-- END: LAYOUT/HEADERS/HEADER-1 -->
