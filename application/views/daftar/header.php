<!DOCTYPE html>
<?php
//echo "suksesss"; die;
//$cek    = $user->row();
//$nama   = $cek->nama_lengkap;
//$username   = $cek->username;
//
//$level  = $cek->level;
//$foto = "img/user/user-default.jpg";
//
//$menu 		= strtolower($this->uri->segment(1));
//$sub_menu = strtolower($this->uri->segment(2));
//$sub_menu3 = strtolower($this->uri->segment(3));
//
//$link1 = strtolower($this->uri->segment(1));
//$link2 = strtolower($this->uri->segment(2));
//$link3 = strtolower($this->uri->segment(3));
//$link4 = strtolower($this->uri->segment(4));
//$link5 = strtolower($this->uri->segment(5));

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


