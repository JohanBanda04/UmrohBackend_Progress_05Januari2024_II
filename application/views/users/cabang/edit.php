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
                    <label class="control-label col-lg-3">Nama Cabang</label>
                    <div class="col-lg-9">
                      <input type="text" name="nama_cabang_edit"
                             id="nama_cabang_edit" class="form-control"
                             value="<?php echo $query->nama_cabang; ?>" placeholder="Nama Cabang" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                    <div class="form-group">
                        <label class="control-label col-lg-3">Provinsi</label>
                        <div class="col-lg-9">
                            <select class="form-control default-select2"
                                    name="prov_id_edit" id="prov_id_edit"  required>
                                <option value="">- Pilih Provinsi -</option>
                                <?php
                                /*cara get semua records di database*/
                                //                                $data_zonaAll = $this->db->get("tbl_zona");
                                $data_provinsiAll = $this->db->get("tbl_provinsi");
                                // echo "<pre>"; print_r($data_zonaAll);
                                foreach ($data_provinsiAll->result() as $index=>$provinsi){
                                    if($provinsi->nama_provinsi!='Superadmin'){ ?>
                                        <option <?php if($provinsi->id_provinsi==$query->provinsi_id){ ?>
                                                selected
                                        <?php } ?> value="<?= $provinsi->id_provinsi?>"><?= $provinsi->nama_provinsi?></option>
                                    <?php } ?>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Pimpinan Cabang</label>
                        <div class="col-lg-9">
                            <select class="form-control default-select2"
                                    name="pimpinan_cab_edit" id="pimpinan_cab_edit"  required>
                                <option value="">- Pimpinan Cabang -</option>
                                <?php
                                /*cara get semua records di database*/
                                //                                $data_zonaAll = $this->db->get("tbl_zona");
                                $users = $this->db->get("tbl_user");
                                foreach ($users->result() as $index=>$user){
                                    if($user->level!='superadmin'){ ?>
                                        <option <?php if($user->id_user==$query->user_id) { ?>
                                            selected
                                        <?php } ?> value="<?= $user->id_user?>"><?= $user->nama_lengkap?></option>
                                    <?php } ?>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">No. Telpon</label>
                        <div class="col-lg-9">
                            <input type="number" name="telpon_edit"
                                   id="telpon_edit" class="form-control"
                                   value="<?php echo $query->no_telp; ?>" placeholder="Telpon"
                                   required autofocus onfocus="this.value = this.value;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Email</label>
                        <div class="col-lg-9">
                            <input type="email" name="email_edit"
                                   id="email_edit" class="form-control"
                                   value="<?php echo $query->email; ?>" placeholder="Email"
                                   required autofocus onfocus="this.value = this.value;">
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

