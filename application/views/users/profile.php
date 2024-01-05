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
                GANTI PASSWORD PENGGUNA
              </legend>
              <?php
              echo $this->session->flashdata('msg');
              ?>
                <!--ini adalah kunci kesuksesan untuk action pada form-->
              <form class="form-horizontal" action="<?= $link1; ?>/<?= $link2; ?>/se/<?= $_SESSION['id_user']?>" method="post" data-parsley-validate="true" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="control-label col-lg-3">Username</label>
                    <div class="col-lg-9">
                      <input style="color: black; font-weight: bold" type="text" name="username" id="username" class="form-control"
                             value="<?php echo strtoupper($user->username); ?>" placeholder="Nama Pengguna" readonly>
                    </div>
                  </div>
                  <div hidden class="form-group">
                    <label class="control-label col-lg-3">Nama</label>
                    <div class="col-lg-9">
                      <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?php echo $user->nama_lengkap; ?>" placeholder="Nama Lengkap" maxlength="100" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Password Lama</label>
                    <div class="col-lg-9">
                      <input type="password" name="old_password" id="old_password" class="form-control"
                             value="<?php echo $password_lama??''; ?>" placeholder="Password Lama"
                             maxlength="100" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Password Baru</label>
                    <div class="col-lg-9">
                      <input type="password" name="new_password_1" id="new_password_1" class="form-control"
                             value="<?php echo $password_baru_1??''; ?>" placeholder="Password Baru"
                             maxlength="100" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Konfirmasi Password Baru</label>
                    <div class="col-lg-9">
                      <input type="password" name="new_password_2" id="new_password_2" class="form-control"
                             value="<?php echo $password_baru_2??''; ?>" placeholder="Konfirmasi Password Baru"
                             maxlength="100" >
                    </div>
                  </div>


                  <div  class="form-group">
                    <label class="control-label col-lg-3">Level</label>
                    <div class="col-lg-9">
                      <input style="font-weight: bold; color: black" type="text" name="" class="form-control"
                             value="<?php echo $this->session->userdata("nama_level_lengkap"); ?>" placeholder="Level User" readonly>
                    </div>
                  </div>

                  <div class="form-group" style="margin-left: 2pt" >
                      <div class="g-recaptcha" data-sitekey="6LdJ0pAmAAAAAI7vU7S3seu7_Wt9AnJCINpeceU_"
                           style="width: 40px">

                      </div>
                  </div>
                
                <hr>
                
            </fieldset>
              <input style="float:right;" type="submit" id="btnupdate_pass" name="btnupdate_pass" class="btn btn-primary" value="Update" />
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
