<!DOCTYPE html>
<?php

$cek    = $user->row();

$nama   = $cek->nama_lengkap;
$username   = $cek->username;

$level  = $cek->level;
$foto = "img/user/user-default.jpg";
$tulus_icon = "img/user/tulus_icon.png";

$menu 		= strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
$sub_menu4 = strtolower($this->uri->segment(4));
$sub_menu5 = strtolower($this->uri->segment(5));

$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
$link5 = strtolower($this->uri->segment(5));

?>

<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?= $judul_web; ?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="<?php echo $this->Mcrud->judul_web(); ?>" name="description" />
	<meta name="keywords" content="<?php echo $this->Mcrud->judul_web(); ?>">
	<base href="<?php echo base_url();?>"/>
	<link rel="shortcut icon" href="assets/tulus_icon.png" type="image/x-icon" />
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="assets/panel/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
	<link href="assets/panel/css/animate.min.css" rel="stylesheet" />
	<link href="assets/panel/css/style.min.css" rel="stylesheet" />
	<link href="assets/panel/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/panel/css/theme/default.css" rel="stylesheet" id="theme" />
	<link href="assets/panel/css/style-gue.css" rel="stylesheet">
	<link href="assets/panel/css/custom.css" rel="stylesheet">
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="assets/panel/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <link href="assets/panel/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="assets/panel/plugins/morris/morris.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/panel/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/parsley/src/parsley.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/panel/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="assets/panel/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="assets/panel/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="assets/panel/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="assets/panel/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
    <link href="assets/panel/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
    <link href="assets/panel/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
    <link href="assets/panel/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/panel/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<link rel="stylesheet" type="text/css" href="assets/fancybox/jquery.fancybox.css">
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/fancybox/jquery.fancybox.js"></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</head>
<body>

<style type="text/css"></style>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed in"> <!--page-sidebar-minified-->
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="" class="navbar-brand" style="width: 500px">
                        <span class="navbar-logo">
                        <img style="width: 30px; height: 32px; margin-top: -10px; margin-left: -5px;" src="<?php echo $tulus_icon;?>" alt="" />
                            <?php
                            $nama_user = explode('_',$_SESSION['username']);
                            if(count($nama_user)==3){
                                $nama_user_fix = $nama_user[0]." ".$nama_user[1]." ".$nama_user[2];
                            } else if (count($nama_user)==2){
                                $nama_user_fix = $nama_user[0]." ".$nama_user[1];
                            } else if (count($nama_user)==1){
                                $nama_user_fix = $nama_user[0];
                            }
                            ?>
                        </span> &nbsp;<b>Sitaroh App V1.1</b>
                    </a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->

				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown hidden">
						<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle icon" aria-expanded="false">
							<i class="ion-ios-bell"></i>
							<span class="label" id="jml_notif_bell"><span class="badge badge-danger pull-right">0</span>
						</a>
						<ul class="dropdown-menu media-list pull-right animated fadeInDown" id="notif_bell"></ul>
					</li>
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<span class="user-image online">
								<img src="<?php echo $foto;?>" alt="" />
							</span>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li <?php if($menu=='profile'){echo " class='active'";}?> >
                                 <!-- <a href="profile.html">Ganti Password</a>-->
                                <a href="users/profile/e/<?= hashids_encrypt($_SESSION['id_user']); ?>">Ganti Password</a>
                            </li>
							<li class="divider"></li>
							<li><a href="web/logout.html">Logout</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->

		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%" style="background-color: #2c4974">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile" style="background-color: #2c4974">
						<div class="image">
							<a href="profile"><img src="<?php echo $foto;?>" alt="" /></a>
						</div>
						<div class="info">

							<?php echo ucwords($nama_panjang_admin); ?>
                            <?php
                            if($this->session->userdata('nama_level')=="baitullah_mujahid"){
                                $exp = explode("_",$this->session->userdata("nama_level"));
                                $nama_level = $exp[1]." ".$exp[0];
                            } else {
                                $nama_level = $this->session->userdata("nama_level_lengkap");
                            }
                            ?>
							<small style="color: white">@<?php echo strtoupper($username)." (".strtoupper($nama_level).")"; ?></small>
						</div>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<!-- MENU AMERTA  -->
					<li class="nav-header" style="color: white"><big ">Menu Navigasi</big></li>
					<li class="has-sub<?php if($menu=='users' AND $sub_menu==''
                        or ($menu=='dashboard' and $sub_menu="")){echo " active";} ?>">
						<a style="color: white" href="dashboard.html">
						    <i class="ion-ios-pulse-strong"></i>
						    <span>Dashboard</span>
					   </a>
					</li>
                    <?php
                    /*menu DATA PENGGUNA hanya akan tampil bagi user dgn level administrator*/
                        if($this->session->userdata("nama_level")=="administrator"){
                            ?>
                            <li class=" has-sub<?php if($menu=='datapengguna' AND $sub_menu==''
                                or $menu=='datapengguna'){echo " active";} ?>">
                                <a style="color: white" href="datapengguna/v.html">
                                    <i class="fa fa-user bg-gray"></i>
                                    <span>Data Pengguna </span>
                                </a>
                            </li>
                            <?php
                        }
                    ?>


                    <?php
                    if($this->session->userdata('nama_level')=='administrator'){
                        ?>
                        <li class="has-sub<?php if($menu=='cabang' AND $sub_menu=='v'
                            or $menu=='cabang'){echo " active";} ?>">
                            <a style="color: white" href="cabang.html">
                                <i class="fa fa-circle"></i>
                                <span>Data Cabang</span>
                            </a>
                        </li>
                        <?php
                    }
                    ?>

                    <?php
                    $dt_tbl_zona = $this->db->get("tbl_zona");
                    ?>
                    <?php
                    if($this->session->userdata('nama_level')=="administrator"){ ?>
                        <li class="has-sub <?php if($menu=='paket' AND $sub_menu=='v' ){
                            echo "active";
                        } ?> ">
                            <a style="color: white" href="javascript:;">
                                <b class="caret pull-right"></b>
                                <i class="fa fa-gift bg-gray"></i>
                                <span>Data Paket</span>
                            </a>
                            <!--ini dia sidebar menu-->
                            <ul class="sub-menu">

                                <li hidden <?php if(($menu=='paket' and $sub_menu=='v' and $sub_menu3=='paket_haji')
                                    or ($menu=='paket' and $sub_menu=='v' and $sub_menu3=='t_haji')
                                    or($menu=='paket' and $sub_menu=='v' and $sub_menu3=='e_haji') ){
                                    ?>class="active" <?php
                                } ?> >
                                    <a style="" href="paket/v/paket_haji.html">
                                        <i class="fa fa-file-text"></i> <span>Paket Haji</span>
                                    </a>
                                </li>

                                <li  <?php if(($menu=='paket' and $sub_menu=='v' and $sub_menu3=='paket_umroh')
                                    or ($menu=='paket' and $sub_menu=='v' and $sub_menu3=='t_umroh')
                                    or($menu=='paket' and $sub_menu=='v' and $sub_menu3=='e_umroh') ){
                                    ?>class="active" <?php
                                } ?> >
                                    <a style="" href="paket/v/paket_umroh.html">
                                        <i class="fa fa-file-text"></i> <span>Paket Umroh</span>
                                    </a>
                                </li>







                            </ul>
                        </li>
                        <?php

                    }
                    ?>


                    <!--menu DATA DOWN PAYMENT DARI SINI-->
                    <?php
                    /*disini nanti diubah jadi 'presiden_direktur' jika data jamaah ingin dihilangkan pada akun presdir*/
                    if(($this->session->userdata('nama_level')=="administrator")){
                        ?>
                        <li class="hidden has-sub<?php if($menu=='downpayment' AND $sub_menu=='v'
                            or $menu=='downpayment'){echo " active";} ?>">
                            <!--cara arahkan routing bro jo-->
                            <a style="color: white" href="downpayment/v/aksi/id/<?php echo hashids_encrypt($this->session->userdata('id_user'))?>">
                                <i class="fa fa-chevron-down"></i>
                                <span>Data Down Payment <br>
                                    <?php
                                    //echo site_url();
                                    //echo $this->session->userdata('nama_level');
                                    ?>
                            </span>
                            </a>
                        </li>
                        <?php

                    }
                    ?>
                    <!--menu DATA DOWN PAYMENT SAMPAI SINI-->






                    <?php
                    /*disini nanti diubah jadi 'presiden_direktur' jika data jamaah ingin dihilangkan pada akun presdir*/
                    if(($this->session->userdata('nama_level')!="presdir")){
                        ?>
                        <li class="has-sub<?php if($menu=='jamaah' AND $sub_menu=='v'
                            or $menu=='jamaah'){echo " active";} ?>">
                            <!--cara arahkan routing bro jo-->
                            <a style="color: white" href="jamaah/v/aksi/id/<?php echo hashids_encrypt($this->session->userdata('id_user'))?>">
                                <i class="fa fa-file-archive-o"></i>
                                <span>Data Jamaah <br>
                                    <?php
                                    //echo site_url();
                                    //echo $this->session->userdata('nama_level');
                                    ?>
                            </span>
                            </a>
                        </li>
                        <?php

                    }
                    ?>



                    <li class="has-sub<?php if($menu=='bonus' AND $sub_menu=='v'
                        or $menu=='bonus'){echo " active";} ?>">
                        <!--cara arahkan routing bro jo-->
                        <a style="color: white" href="bonus/v/aksi/id/<?php echo hashids_encrypt($this->session->userdata('id_user'))?>">
                            <i class="fa fa-money"></i>
                            <span>History Bonus <br>
                                <?php
                                //echo site_url();
                                //echo $this->session->userdata('nama_level');
                                ?>
                            </span>
                        </a>
                    </li>


                    <?php
                    $data_role_agen_all = $this->db->get("tbl_role_agen");
                    ?>

                    <?php if($this->session->userdata('nama_level')=='administrator'
                        or $this->session->userdata('nama_level')=="presiden_direktur"
                        or $this->session->userdata('nama_level')=="direktur_mujahid"
                        or  $this->session->userdata('nama_level')=="manajer_mujahid") { ?>
                        <li  class=" has-sub <?php
                        foreach ($data_role_agen_all->result() as $index => $dt){
                            if(($menu=='agen' and $sub_menu=='v' and $sub_menu3==$dt->nama_role_agen)){
                                echo "active";
                            } else if($menu=='agen' and $sub_menu=='v' and $sub_menu4==hashids_encrypt($dt->id_role_agen) and $sub_menu5=='t_agen'){
                                echo "active";
                            }
                        }
                        ?>">
                            <a style="color: white" href="javascript:;">
                                <b class="caret pull-right"></b>
                                <i class="fa fa-pencil-square-o"></i>
                                <span>Data Agen </span>
                                <?php
                                $level_bawahan = "";
                                if($this->session->userdata('level')=="90"){
                                    $level_bawahan="91";
                                } else if($this->session->userdata('level')=="91"){
                                    $level_bawahan="93";
                                } else if($this->session->userdata('level')=="93"){
                                    $level_bawahan="95";
                                } else if($this->session->userdata('level')=="93"){
                                    $level_bawahan="jamaah";
                                }else if($this->session->userdata('level')=="1"){
                                    $level_bawahan="all_agen";
                                }
                                ?>
                            </a>
                            <!--ini dia sidebar menu-->
                            <ul class="sub-menu">
                                <?php
                                $data_role_agen_all = $this->db->get("tbl_role_agen");
                                foreach ($data_role_agen_all->result() as $index => $dt){
                                    /*karena di tbl_role_agen ada 1 record jenis role agen : administrator*/
                                    if($dt->nama_role_agen!='administrator'){
                                        if($level_bawahan==$dt->id_role_agen){
                                            ?>
                                            <li  class="<?php if(($menu=='agen' and $sub_menu=='v' and $sub_menu3==$dt->nama_role_agen)) {
                                                echo "active";
                                            } else if($menu=='agen' and $sub_menu=='v' and $sub_menu4==hashids_encrypt($dt->id_role_agen) and $sub_menu5=='t_agen' ){
                                                echo "active";
                                            }?>" >
                                                <a style="color: white" href="agen/v/<?php echo $dt->nama_role_agen; ?>/<?php echo hashids_encrypt($dt->id_role_agen); ?>" >
                                                    <i class="fa fa-file-text"></i> <span>Data <?= $dt->nama_role_agen_lengkap;?> </span>
                                                </a>

                                            </li>
                                            <?php
                                        } else if($level_bawahan=="all_agen") {
                                            ?>
                                            <li  class="<?php if(($menu=='agen' and $sub_menu=='v' and $sub_menu3==$dt->nama_role_agen)) {
                                                ?> active  <?php
                                            } else if($menu=='agen' and $sub_menu=='v' and $sub_menu4==hashids_encrypt($dt->id_role_agen) and $sub_menu5=='t_agen' ){
                                                ?> active <?php
                                            }?>" >
                                                <a style="color: " href="agen/v/<?php echo $dt->nama_role_agen; ?>/<?php echo hashids_encrypt($dt->id_role_agen); ?>" >
                                                    <i class="fa fa-file-text"></i> <span>Data <?= $dt->nama_role_agen_lengkap;?> </span>
                                                </a>

                                            </li>
                                            <?php
                                        }


                                    }

                                }
                                ?>

                            </ul>
                        </li>
                    <?php } ?>

                    <li class="hidden has-sub<?php if($menu=='pendaftar' AND $sub_menu=='v'
                        or $menu=='pendaftar'){echo " active";} ?>">
                        <a style="color: white" href="pendaftar.html">
                            <i class="fa fa-paint-brush"></i>
                            <span>Data Pendaftar</span>
                        </a>
                    </li>


					<li class="hidden has-sub<?php if($menu=='berita' AND $sub_menu=='' and $sub_menu3='' or $menu=='berita'){echo " active";} ?>">
						<a href="berita/v.html">
							<i class="fa fa-newspaper-o bg-gray"></i>
							<span>Bahan Berita</span>
						</a>
					</li>
                    <!--aktifkan yg dibawah ini JIKA MAU TETAP TER-EXPAND "HASIL HARMONISASI" -->
                    <li class="has-sub <?php if($menu=='harmonisasi' OR ($menu=='harmonisasi' AND $sub_menu=='v') OR ($menu=='folder_data_dukung' AND $sub_menu=='v') OR ($menu=='data_dukung' AND $sub_menu=='v') OR ($menu=='rpd' AND $sub_menu=='v') OR ($menu=='ankabut' AND $sub_menu=='v')){echo " active";} ?>">
                    <?php $dt_tbl_zona = $this->db->get('tbl_zona'); ?>
                    <li  class="hidden has-sub <?php foreach ($dt_tbl_zona->result() as $id=>$val){
                        if($menu=='harmonisasi2' AND $sub_menu=='hasil2' and $sub_menu3==$val->nama_zona){
                            echo "active";
                        }
                    }?>" >
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <i class="fa fa-file-pdf-o bg-gray"></i>
                            <!--sidebar ato navbar -->
                            <span>Hasil Harmonisasizz</span>
                        </a>
                        <!--ini dia sidebar menu-->
                        <ul class="sub-menu">
                            <!--coba dengan data kota / pemkab dari tbl_zona dari database, mulai dari sini-->
                            <?php
                                $dt_zona_harmonisasi = $this->db->get('tbl_zona');
                                foreach ($dt_zona_harmonisasi->result() as $index=>$value){ ?>
                                    <li <?php if($value->nama_zona=='superadmin' or $value->nama_zona=='kasub_perancang' or $value->nama_zona=="perancang"){ ?> hidden <?php } ?>
                                        <?php if(($menu=='harmonisasi2' and $sub_menu=='hasil2' and $sub_menu3==$value->nama_zona) or ($menu=='harmonisasi2' and $sub_menu=='hasil2' and $sub_menu3==$value->nama_zona)) { echo " class='active' ";}?>
                                        <?php if($_SESSION['nama_zona']==$value->nama_zona){?> class="" <?php } else if ($_SESSION['nama_zona']=='superadmin') { ?> class=""<?php } else if($_SESSION['nama_zona']=='kasub_perancang') { ?> class="" <?php } else { ?> class="hidden" <?php } ?> >
                                        <a href="harmonisasi2/hasil2/<?= $value->nama_zona; ?>" >
                                            <i class="fa fa-file-text"></i> <span><?= $value->nama_panjang;?></span>
                                        </a>
                                    </li>
                                <?php }
                            ?>
                            <!--sampai sini-->
                            <li <?php if(($menu=='harmonisasi' and $sub_menu=='v' and $sub_menu3=='pemprov_ntb') or ($menu=='harmonisasi' and $sub_menu=='v2' and $sub_menu3=='pemprov_ntb')){ echo " class='active'"; } ?>

                                <?php if($_SESSION['nama_zona']=='pemprov_ntb'){?> class="" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class=""<?php } else if($_SESSION['nama_zona']=='kasub_perancang') {?> class="" <?php } else { ?> class="hidden" <?php } ?> >
                                <a href="harmonisasi/v/pemprov_ntb.html">
                                    <i class="fa fa-file-text"></i> <span>Pemprov NTBs</span>
                                </a>
                            </li>


                            <li <?php if(($menu=='harmonisasi' AND $sub_menu=='v' and $sub_menu3=='pemkot_mataram') or ($menu=='harmonisasi' AND $sub_menu=='v2' and $sub_menu3=='pemkot_mataram')){echo " class='active'";} ?>
                                <?php if($_SESSION['nama_zona']=='pemkot_mataram'){?> class="" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class=""<?php } else if($_SESSION['nama_zona']=='kasub_perancang') { ?> class="" <?php } else { ?> class="hidden" <?php } ?> >
                                <a href="harmonisasi/v/pemkot_mataram.html">
                                    <i class="fa fa-file-text"></i> <span>Pemkot Mataram</span>
                                </a>
                            </li>
                            <li <?php if(($menu=='harmonisasi' AND $sub_menu=='v' and $sub_menu3=='pemkot_bima') or ($menu=='harmonisasi' AND $sub_menu=='v2' and $sub_menu3=='pemkot_bima')){echo " class='active'";} ?>

                                <?php if($_SESSION['nama_zona']=='pemkot_bima'){?> class="" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class=""<?php } else if($_SESSION['nama_zona']=='kasub_perancang') { ?> class="" <?php } else { ?> class="hidden" <?php } ?> >
                                <a href="harmonisasi/v/pemkot_bima.html">
                                    <i class="fa fa-file-text"></i> <span>Pemkot Bima</span>
                                </a>
                            </li>
                            <!--sinicuy-->
                            <li <?php if(($menu=='harmonisasi' AND $sub_menu=='v' and $sub_menu3=='pemkab_sumbawa_barat') or ($menu=='harmonisasi' AND $sub_menu=='v2' and $sub_menu3=='pemkab_sumbawa_barat')){echo " class='active'";} ?>

                                <?php if($_SESSION['nama_zona']=='pemkab_sumbawa_barat'){?> class="" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class=""<?php } else if($_SESSION['nama_zona']=='kasub_perancang') { ?> class="" <?php } else { ?> class="hidden" <?php } ?> >
                                <a href="harmonisasi/v/pemkab_sumbawa_barat.html">
                                    <i class="fa fa-file-text"></i> <span>Pemkab Sumbawa Barat</span>
                                </a>
                            </li>
                            <li <?php if(($menu=='harmonisasi' and $sub_menu=='v' and $sub_menu3=='pemkab_sumbawa') or ($menu=='harmonisasi' and $sub_menu=='v2' and $sub_menu3=='pemkab_sumbawa')){echo " class='active'";} ?>
                                <?php if($_SESSION['nama_zona']=='pemkab_sumbawa'){?> class="" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class=""<?php } else if($_SESSION['nama_zona']=='kasub_perancang') { ?> class="" <?php } else { ?> class="hidden" <?php } ?> >
                                <a href="harmonisasi/v/pemkab_sumbawa.html">
                                    <i class="fa fa-file-text"></i> <span>Pemkab Sumbawa</span>
                                </a>
                            </li>


                            <li <?php if(($menu=='harmonisasi' AND $sub_menu=='v' and $sub_menu3=='pemkab_lombok_utara') or ($menu=='harmonisasi' AND $sub_menu=='v2' and $sub_menu3=='pemkab_lombok_utara')){echo " class='active'";} ?>
                                <?php if($_SESSION['nama_zona']=='pemkab_lombok_utara'){?> class="" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class=""<?php } else if($_SESSION['nama_zona']=='kasub_perancang') { ?> class="" <?php } else { ?> class="hidden" <?php } ?> >
                                <a href="harmonisasi/v/pemkab_lombok_utara.html">
                                    <i class="fa fa-file-text"></i> <span>Pemkab Lombok Utara</span>
                                </a>
                            </li>
                            <li <?php if(($menu=='harmonisasi' AND $sub_menu=='v' and $sub_menu3=='pemkab_lombok_timur') or ($menu=='harmonisasi' AND $sub_menu=='v2' and $sub_menu3=='pemkab_lombok_timur')){echo " class='active'";} ?>
                                <?php if($_SESSION['nama_zona']=='pemkab_lombok_timur'){?> class="" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class=""<?php } else if($_SESSION['nama_zona']=='kasub_perancang') { ?> class="" <?php } else { ?> class="hidden" <?php } ?> >
                                <a href="harmonisasi/v/pemkab_lombok_timur.html">
                                    <i class="fa fa-file-text"></i> <span>Pemkab Lombok Timur</span>
                                </a>
                            </li>
                            <li <?php if(($menu=='harmonisasi' AND $sub_menu=='v' and $sub_menu3=='pemkab_lombok_tengah') or ($menu=='harmonisasi' AND $sub_menu=='v2' and $sub_menu3=='pemkab_lombok_tengah')){echo " class='active'";} ?>
                                <?php if($_SESSION['nama_zona']=='pemkab_lombok_tengah'){?> class="" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class=""<?php } else if($_SESSION['nama_zona']=='kasub_perancang') { ?> class="" <?php } else { ?> class="hidden" <?php } ?> >
                                <a href="harmonisasi/v/pemkab_lombok_tengah.html">
                                    <i class="fa fa-file-text"></i> <span>Pemkab Lombok Tengah</span>
                                </a>
                            </li>
                            <li <?php if(($menu=='harmonisasi' and $sub_menu=='v' and $sub_menu3=='pemkab_lombok_barat') or ($menu=='harmonisasi' and $sub_menu=='v2' and $sub_menu3=='pemkab_lombok_barat')){echo " class='active'";} ?>
                                <?php if($_SESSION['nama_zona']=='pemkab_lombok_barat'){?> class="" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class=""<?php } else if($_SESSION['nama_zona']=='kasub_perancang') { ?> class="" <?php } else { ?> class="hidden" <?php } ?> >
                                <a href="harmonisasi/v/pemkab_lombok_barat.html">
                                    <i class="fa fa-file-text"></i> <span>Pemkab Lombok Barat</span>
                                </a>
                            </li>


                            <li <?php if(($menu=='harmonisasi' AND $sub_menu=='v' and $sub_menu3=='pemkab_dompu') or ($menu=='harmonisasi' AND $sub_menu=='v2' and $sub_menu3=='pemkab_dompu')){echo " class='active'";} ?>
                                <?php if($_SESSION['nama_zona']=='pemkab_dompu'){?> class="" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class=""<?php } else if($_SESSION['nama_zona']=='kasub_perancang') { ?> class="" <?php } else { ?> class="hidden" <?php } ?> >
                                <a href="harmonisasi/v/pemkab_dompu.html">
                                    <i class="fa fa-file-text"></i> <span>Pemkab Dompu</span>
                                </a>
                            </li>
                            <li <?php if(($menu=='harmonisasi' AND $sub_menu=='v' and $sub_menu3=='pemkab_bima') or($menu=='harmonisasi' AND $sub_menu=='v2' and $sub_menu3=='pemkab_bima')){echo " class='active'";} ?>
                                <?php if($_SESSION['nama_zona']=='pemkab_bima'){?> class="" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class=""<?php } else if($_SESSION['nama_zona']=='kasub_perancang') { ?> class="" <?php } else { ?> class="hidden" <?php } ?> >
                                <a href="harmonisasi/v/pemkab_bima.html">
                                    <i class="fa fa-file-text"></i> <span>Pemkab Bima</span>
                                </a>
                            </li>

                        </ul>
                    </li>


                    <!--menu untuk pemda-->
                    <?php
                    $dt_tbl_zona = $this->db->get("tbl_zona");
                    ?>
                    <li  class="hidden has-sub <?php foreach ($dt_tbl_zona->result() as $id=>$val) {
                        if($menu=='pemda' AND $sub_menu=='draft' AND $sub_menu3==$val->nama_zona){
                            echo "active";
                        }
                    } ?> ">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <i class="fa fa-language bg-gray"></i>
                            <span>Draft Raperdasz</span>
                        </a>
                        <!--ini dia sidebar menu-->
                        <ul class="sub-menu">
                            <!--dihidden, abaikan dari sini-->
                            <li hidden <?php if(($menu=='pemda' and $sub_menu=='v' and $sub_menu3=='draft_pemprov_ntb') or ($menu=='pemda' and $sub_menu=='v2' and $sub_menu3=='draft_pemprov_ntb')){ echo " class='active'"; } ?>>
                                <a href="pemda/v/draft_pemprov_ntb.html">
                                    <i class="fa fa-file-text"></i> <span>Draft Pemprov NTB</span>
                                </a>
                            </li>
                            <!--sampai sini-->

                            <?php
                                $dt_tbl_zona = $this->db->get("tbl_zona");
                                foreach ($dt_tbl_zona->result() as $id=>$val){ ?>
                                    <li <?php if ($val->nama_zona=="superadmin"){?> hidden <?php } else if($val->nama_zona=="kasub_perancang"){?> hidden <?php } else if($val->nama_zona=="perancang"){ ?> hidden <?php } ?>
                                    <?php if(($menu=='pemda' and $sub_menu=='draft' and $sub_menu3==$val->nama_zona) or ($menu=='pemda' and $sub_menu=='draft' and $sub_menu3==$val->nama_zona)){ echo " class='active'"; } ?>
                                        <?php if($_SESSION['nama_zona']==$val->nama_zona){?> class="" <?php } else if ($_SESSION['nama_zona']=='superadmin') { ?> class=""<?php } else if($_SESSION['nama_zona']=='kasub_perancang') { ?> class="" <?php } else { ?> class="hidden" <?php } ?> >
                                        <a href="pemda/draft/<?= $val->nama_zona; ?>" >
                                            <i class="fa fa-file-text"></i> <span><?= $val->nama_panjang;?></span>
                                        </a>

                                    </li>
                                <?php }
                            ?>



                        </ul>
                    </li>
                    <!--dihidden, abaikan dari sini-->
                    <li class="hidden has-sub<?php if($menu=='harmonisasi' and $sub_menu=='v' and $sub_menu3=='t'){ echo " active"; } ?>">
						<a href="harmonisasi/v/t.html">
							<i class="fa fa-plus-square bg-gray"></i>
							<span>Tambah Dokumen</span>
						</a>
					</li>

                    <li class="hidden has-sub<?php if($menu=='pemda' and $sub_menu=='v' and $sub_menu3=='t'){ echo " active"; } ?>">
                        <a href="pemda/v/t.html">
                            <i class="fa fa-plus-square bg-gray"></i>
                            <span>Tambah Draft Raperda</span>
                        </a>
                    </li>
                    <!--sampai sini-->





				<!-- MENU UMUM DARI SINI -->
					<!-- <li class="nav-header"><big ">Menu Navigasi</big></li>
					<li class="has-sub<?php if($menu=='users' AND $sub_menu=='' or $menu=='dashboard'){echo " active";} ?>">
						<a href="dashboard.html">
						    <i class="ion-ios-pulse-strong"></i>
						    <span>Dashboard</span>
					   </a>
					</li> -->
				<!-- MENU UMUM SAMPAI SINI -->
				
					<!-- MENU SUPER ADMIN -->
					<!-- <?php if ($level=='superadmin'): ?>
						<li class="has-sub <?php if($menu=='pengaduan'){echo " active";} ?>">
							<a href="javascript:;">
								<b class="caret pull-right"></b>
								<i class="fa fa-users bg-gray"></i>
								<span>Masyarakat</span>
							</a>
							<ul class="sub-menu">
								<li <?php if($menu=='pengaduan' AND $sub_menu=='v'){echo " class='active'";} ?>>
									<a href="pengaduan/v.html">
										<i class="fa fa-comments"></i> <span>Pengaduan Masyarakat</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="has-sub <?php if($menu=='obh' OR ($menu=='laporan' AND $sub_menu=='v') OR $menu=='tambahobh' OR ($menu=='laporan_semester' AND $sub_menu=='v')){echo " active";} ?>">
							<a href="javascript:;">
								<b class="caret pull-right"></b>
								<i class="fa fa-user bg-gray"></i>
								<span>OBH</span>
							</a>
							<ul class="sub-menu">
								<li <?php if($menu=='obh'){echo " class='active'";} ?>>
									<a href="obh/v.html">
										<i class="fa fa-user-circle"></i> <span>Data OBH</span>
									</a>
								</li>
								<li <?php if($menu=='tambahobh'){echo " class='active'";} ?>>
									<a href="tambahobh/v.html">
										<i class="fa fa-user-plus"></i> <span>Registrasi OBH</span>
									</a>
								</li>
								<li <?php if($menu=='laporan' AND $sub_menu=='v'){echo " class='active'";} ?>>
									<a href="laporan/v.html">
										<i class="fa fa-file-text"></i> <span>Laporan Kegiatan OBH</span>
									</a>
								</li>
								<li <?php if($menu=='laporan_semester' AND $sub_menu=='v'){echo " class='active'";} ?>>
									<a href="laporan_semester/v.html">
										<i class="fa fa-calendar-check-o"></i> <span>Laporan Semester OBH</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="has-sub <?php if($menu=='file_manager'){echo " active";} ?>">
							<a href="javascript:;">
								<b class="caret pull-right"></b>
								<i class="fa fa-newspaper-o bg-gray"></i>
								<span>Info Publik</span>
							</a>
							<ul class="sub-menu">
								<li <?php if($menu=='file_manager'){echo " class='active'";} ?>>
									<a href="file_manager/v.html">
										<i class="fa fa-folder-open"></i> <span>File Manager</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="has-sub <?php if($menu=='kategori_lap'){echo " active";} ?>">
							<a href="javascript:;">
								<b class="caret pull-right"></b>
								<i class="fa fa-cogs bg-gray"></i>
								<span>Kategori Laporan</span>
							</a>
							<ul class="sub-menu">
								<li<?php if($menu=='kategori_lap' AND $sub_menu='v'){echo " class='active'";} ?>><a href="kategori_lap/v.html">Kategori Laporan</a></li>
								<li<?php if($menu=='kategori_lap' AND $sub_menu='sub'){echo " class='active'";} ?>><a href="kategori_lap/sub.html">Sub Kategori</a></li>
							</ul>
						</li>
					<?php endif; ?> -->
					<!-- akhir sesi super admin -->
					
					<!-- MENU OBH -->
					<!-- <?php if ($level=='obh'): ?>
						<li <?php if($menu=='laporan' AND $sub_menu=='v'){echo " class='active'";} ?>>
							<a href="laporan/v.html">
								<div class="icon-img"><i class="fa fa-file-text"></i></div>
							  <span>Laporan Kegiatan</span>
							</a>
						</li>
						<li <?php if($menu=='laporan_semester' AND $sub_menu=='v'){echo " class='active'";} ?>>
							<a href="laporan_semester/v.html">
								<div class="icon-img"><i class="fa fa-calendar-check-o"></i></div>
							  <span>Laporan Semester</span>
							</a>
						</li>
						<li <?php if($menu=='permohonan_bankum' AND $sub_menu=='v'){echo " class='active'";} ?>>
							<a href="permohonan_bankum/v.html">
								<div class="icon-img"><i class="fa fa-envelope"></i></div>
							  <span>Permohonan Bantuan</span>
							</a>
						</li>
					<?php endif; ?> -->
					
					<!-- AKHIR MENU NOTARIS-->
					<li class="nav-header"></li>
					<li>
						<a style="color: white" href="web/logout.html">
							<div class="icon-img">
						    <i class="fa fa-sign-out bg-red"></i>
						    </div>
						    <span>Logout</span>
						</a>
					</li>
					    <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="ion-ios-arrow-left"></i> <span></span></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
