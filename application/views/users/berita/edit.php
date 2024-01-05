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
                  <style>
                    #wajib_isi{color:red;}
                  </style>

                  <h4>Informasi Kegiatan</h4>
                    <div class="form-group">
                      <label class="col-lg-12">Nama Kegiatan<b id='wajib_isi'>*</b></label>
                      <div class="col-lg-12">
                        <input type="text" name="nama_kegiatan" class="form-control" value="<?php echo $query->nama_kegiatan; ?>" placeholder="Nama Kegiatan.." required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-12">Tempat Kegiatan<b id='wajib_isi'>*</b></label>
                      <div class="col-lg-12">
                        <input type="text" name="tempat_kegiatan" class="form-control" value="<?php echo $query->tempat_kegiatan; ?>" placeholder="Tempat Kegiatan..." required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-12">Peserta Hadir<b id='wajib_isi'>*</b></label>
                      <div class="col-lg-12">
                        <input type="text" name="peserta" class="form-control" value="<?php echo $query->peserta; ?>" placeholder="Pimti, Pejabat, dan/atau peserta yang hadir..." required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-12">Tanggal Kegiatan<b id='wajib_isi'>*</b></label>
                      <div class="col-lg-12">
                        <div class="input-group">
                          <input type="date" name="tgl_kegiatan" class="form-control daterange-single" value="<?php echo $query->tgl_kegiatan; ?>" maxlength="10" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-12">Poin-poin Kegiatan<b id='wajib_isi'>*</b></label>
                      <div class="col-lg-12">
                        <div class="input-group">
                          <textarea name="poin_kegiatan" class="form-control" placeholder="Poin-poin kegiatan..." rows="4" cols="100" required><?php echo $query->poin_kegiatan; ?></textarea>
                        </div>
                      </div>
                    </div>
                    
                    <hr>
                    
                    <h4>Unggah Dokumen Pendukung</h4>
                    <div class="alert alert-success">
                      <strong><i>Catatan :</i></strong> Dokumen pendukung digunakan untuk penambahan informasi saat proses verifikasi oleh tim Humas. Dokumen pendukung dapat berupa sambutan, notula, undangan/nota dinas, paparan dan dokumen lain yang bisa menjadi bahan berita. Jika terdapat lebih dari 1 file, seluruh file mohon di-zip terlebih dahulu.
                    </div>
                    <br>
                    <div class="form-group">
                      <label class="col-lg-12">Surat Undangan</label>
                      <div class="col-lg-12">
                        <input type="file" name="lamp_surat_undangan" class="form-control" value="<?php echo $query->lamp_surat_undangan; ?>">
                        <span><strong>File terupload: </strong><a href="<?php echo $query->lamp_surat_undangan; ?>" target="_blank"><?php echo $query->lamp_surat_undangan;?></a></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-12">Sambutan</label>
                      <div class="col-lg-12">
                        <input type="file" name="lamp_sambutan" class="form-control" value="<?php echo $query->lamp_sambutan; ?>">
                        <span><strong>File terupload: </strong><a href="<?php echo $query->lamp_sambutan; ?>" target="_blank"><?php echo $query->lamp_sambutan;?></a></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-12">Paparan</label>
                      <div class="col-lg-12">
                        <input type="file" name="lamp_paparan" class="form-control" value="<?php echo $query->lamp_paparan; ?>">
                        <span><strong>File terupload: </strong><a href="<?php echo $query->lamp_paparan; ?>" target="_blank"><?php echo $query->lamp_paparan;?></a></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-12">Dokumen Pendukung Lainnya</label>
                      <div class="col-lg-12">
                        <input type="file" name="lamp_lain" class="form-control" value="<?php echo $query->lamp_lain; ?>">
                        <span><strong>File terupload: </strong><a href="<?php echo $query->lamp_lain; ?>" target="_blank"><?php echo $query->lamp_lain;?></a></span>
                      </div>
                    </div>
                  <hr>

                  <h4>Unggah Dokumentasi</h4>
                  <div class="alert alert-success">
                    <strong><i>Catatan :</i></strong> Wajib mengunggah minimal 2 foto kegiatan dan maksimal 6 foto kegiatan.
                  </div>
                  <br>
                  <div class="form-group">
                    <label class="col-lg-12">Foto 1<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <input type="file" name="lamp_foto1" class="form-control" value="<?php echo $query->lamp_foto1; ?>">
                      <span><strong>File terupload: </strong><a href="<?php echo $query->lamp_foto1; ?>" target="_blank"><?php echo $query->lamp_foto1;?></a></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Foto 2<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <input type="file" name="lamp_foto2" class="form-control" value="<?php echo $query->lamp_foto2; ?>">
                      <span><strong>File terupload: </strong><a href="<?php echo $query->lamp_foto2; ?>" target="_blank"><?php echo $query->lamp_foto2;?></a></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Foto 3</label>
                    <div class="col-lg-12">
                      <input type="file" name="lamp_foto3" class="form-control" value="<?php echo $query->lamp_foto3; ?>">
                      <span><strong>File terupload: </strong><a href="<?php echo $query->lamp_foto3; ?>" target="_blank"><?php echo $query->lamp_foto3;?></a></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Foto 4</label>
                    <div class="col-lg-12">
                      <input type="file" name="lamp_foto4" class="form-control" value="<?php echo $query->lamp_foto4; ?>">
                      <span><strong>File terupload: </strong><a href="<?php echo $query->lamp_foto4; ?>" target="_blank"><?php echo $query->lamp_foto4;?></a></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Foto 5</label>
                    <div class="col-lg-12">
                      <input type="file" name="lamp_foto5" class="form-control" value="<?php echo $query->lamp_foto5; ?>">
                      <span><strong>File terupload: </strong><a href="<?php echo $query->lamp_foto5; ?>" target="_blank"><?php echo $query->lamp_foto5;?></a></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Foto 6</label>
                    <div class="col-lg-12">
                      <input type="file" name="lamp_foto6" class="form-control" value="<?php echo $query->lamp_foto6; ?>">
                      <span><strong>File terupload: </strong><a href="<?php echo $query->lamp_foto6; ?>" target="_blank"><?php echo $query->lamp_foto6;?></a></span>
                    </div>
                  </div>

                  <hr>
                  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Kirim</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
