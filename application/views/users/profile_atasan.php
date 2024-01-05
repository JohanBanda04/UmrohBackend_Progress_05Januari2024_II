<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
$link5 = strtolower($this->uri->segment(5));

$user = $user->row();
$level = $user->level;

$foto_profile = "img/user/user-default.jpg";
if ($level=='obh') {
	$d_k = $this->db->get_where('tbl_data_obh', array('id_user'=>$user->id_user))->row();
	$foto_k = $d_k->foto_obh;
	if ($foto_k!='') {
		if(file_exists("$foto_k")){
			$foto_profile = $foto_k;
		}
	}
}
?>
<!-- Main content -->
<div class="content-wrapper">

  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
      <div class="panel panel-flat">
          <div class="panel-body">
              <center>
                <img src="<?php echo $foto_profile; ?>" alt="<?php echo $user->nama_lengkap; ?>" class="img-circle" width="176">
              </center>
            
          </div>
      </div>

      <div class="panel panel-flat">
          <div class="panel-body">
            <fieldset class="content-group">
              <legend class="text-bold"><i class="icon-user"></i>
               <center>PROFILE ATASAN</center>
              </legend>
              <?php
              echo $this->session->flashdata('msg');
              ?>
                <!--ini adalah kunci kesuksesan untuk action pada form-->
              <form class="form-horizontal" action="<?= $link1; ?>/<?= $link2; ?>/se/<?= $_SESSION['id_user']?>" method="post" data-parsley-validate="true" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama Atasan</label>
                    <div class="col-lg-9">
                      <input style="font-weight: bold; color: black" type="text" name="nama_atasan" id="nama_atasan" class="form-control" value="<?php echo $nama_atasan_lengkap; ?>"
                             placeholder="Nama Atasan" readonly>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-3">Jabatan Atasan</label>
                    <div class="col-lg-9">
                      <input style="font-weight: bold; color: black" readonly type="text" name="jabatan_atasan" id="jabatan_atasan" class="form-control"
                             value="<?php echo $nama_role_atasan; ?>" placeholder="Jabatan Atasan"
                             maxlength="100" >
                    </div>
                  </div>
                  <div class="hidden form-group">
                    <label class="control-label col-lg-3">Jumlah Agen</label>
                    <div class="col-lg-9">
                      <input style="font-weight: bold; color: black" readonly type="text" name="new_password_1" id="new_password_1" class="form-control"
                             value="<?php echo $jumlah_agen_atasan. "  Agen"; ?>" placeholder="Password Baru"
                             maxlength="100" >
                    </div>
                  </div>





                
                <hr>
                
            </fieldset>
              <a style="background-color: #a89292;float: right; margin-right:10px "
                 href="dashboard.html" class="btn btn-default"><<
                  Kembali
              </a>
              <input hidden style="float:right;" type="submit" id="btnupdate_pass" name="btnupdate_pass" class="hidden btn btn-primary" value="Kembali" />
          </form>
          </div>
      </div>
      </div>


    </div>
    <!-- /dashboard content -->


        <script src="assets/js/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/panel/plugin/datetimepicker/jquery.datetimepicker.css"/>
        <script src="assets/panel/plugin/datetimepicker/jquery.datetimepicker.js"></script>
        <script>
        $('#tgl_1').datetimepicker({
          lang:'en',
          timepicker:false,
          format:'d-m-Y'
        });
        </script>

      <script type="text/javascript">
          $(document).on('click', '#btnupdate_pass', function() {
              var response = grecaptcha.getResponse();
              if (response.length == 0) {
                  alert("Please verify you are not a robot.");
                  return false;
              }
          });
      </script>
