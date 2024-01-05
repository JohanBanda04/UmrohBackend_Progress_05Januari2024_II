<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
?>
<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?php echo $judul_web; ?></h4>
            </div>
            <div class="panel-body">
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama Pengguna</label>
                    <div class="col-lg-9">
                      <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $query->nama_agen; ?>" placeholder="Nama" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Level</label>
                    <div class="col-lg-9">

                      <select class="form-control default-select2" name="level" id="level" selected="<?php echo $query->role_agen_id; ?>" required>
                        <option value="">- Pilih Level -</option>
                          <?php
                          $get_data_role_agen = $this->db->get("tbl_role_agen");

                          foreach ($get_data_role_agen->result() as $ind=>$itm){
                              /*diberi if agak utk role administrator tidak ditampilkan*/
                              if($itm->nama_role_agen!="administrator"){
                                ?>
                                  <option <?php if($query->role_agen_id==$itm->id_role_agen){ ?>selected<?php } ?>
                                          value="<?= $itm->id_role_agen?>"><?= $itm->nama_role_agen_lengkap; ?></option>
                                  <?php
                              }
                          }
                          ?>



                      </select>
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="control-label col-lg-3">Cabang</label>
                    <div class="col-lg-9">

                      <select class="form-control default-select2" name="cabang" id="cabang" selected="<?php echo $query->role_agen_id; ?>" required>
                        <option value="">- Pilih Cabang -</option>
                          <?php
                          $get_data_tbl_cabang = $this->db->get("tbl_cabang");

                          foreach ($get_data_tbl_cabang->result() as $ind=>$itm){
                              /*diberi if agak utk role administrator tidak ditampilkan*/
                              if($itm->nama_cabang!="Superadmin"){
                                ?>
                                  <option <?php if($query->role_agen_id==$itm->id_role_agen){ ?>selected<?php } ?>
                                          value="<?= $itm->id_role_agen?>"><?= $itm->nama_role_agen_lengkap; ?></option>
                                  <?php
                              }
                          }
                          ?>



                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Username</label>
                    <div class="col-lg-9">
                      <input readonly type="text" name="username" class="form-control" value="<?php echo $query->username; ?>"
                             placeholder="Username" style="color: black; font-weight: bold" required>
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="control-label col-lg-3">Email</label>
                    <div class="col-lg-9">
                      <input type="text" name="email" class="form-control" value="<?php echo $query->email; ?>"
                             placeholder="email" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Password</label>
                    <div class="col-lg-9">
                      <input type="password" name="password" class="form-control" value="<?php echo $query->password; ?>" placeholder="Password" required>
					  <i style="color: red;">*Password tidak boleh kosong.</i>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Re-Password</label>
                    <div class="col-lg-9">
                      <input type="password" name="password2" class="form-control" value="<?php echo $query->password; ?>" placeholder="Konfirmasi Password" required>
                    </div>
                  </div>
                  <hr>
                  <a href="<?php echo $link1; ?>/<?php echo $link2; ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->

