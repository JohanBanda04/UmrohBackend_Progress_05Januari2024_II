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
                    <label class="control-label col-lg-3">Nama Paket</label>
                    <div class="col-lg-9">
                      <input type="text" name="nama_paket_edit"
                             id="nama_paket_edit" class="form-control"
                             value="<?php echo $query->nama_paket_haji ?>" placeholder="Nama Paket"
                             required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Harga Paket (Rp)</label>
                        <div class="col-lg-9">
                            <input type="number" name="harga_paket_edit"
                                   id="harga_paket_edit" class="form-control"
                                   value="<?php echo $query->harga_paket_haji ?>" placeholder="Harga Paket"
                                   required autofocus onfocus="this.value = this.value;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Jumlah Hari</label>
                        <div class="col-lg-9">
                            <input type="number" name="jumlah_hari_edit"
                                   id="jumlah_hari_edit" class="form-control"
                                   value="<?php echo $query->jumlah_hari_paket_haji ?>" placeholder="Jumlah Hari"
                                   required autofocus onfocus="this.value = this.value;">
                        </div>
                    </div>




                  <hr>
                  <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/paket_haji.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnupdate_haji" class="btn btn-primary" style="float:right;">Update</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
