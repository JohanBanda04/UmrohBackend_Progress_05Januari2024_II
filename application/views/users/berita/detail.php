<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?php echo $judul_web; ?></h4>
            </div>
            <div class="panel-body">
                <?php
                echo $this->session->flashdata('msg');
                $level 	= $this->session->userdata('level');
                ?>
                <h4>Informasi</h4>
              <div class="table-responsive">
			                  <table class="table table-bordered table-striped" width="100%">
                  <tbody>
                    <tr>
                      <th valign="top" width="160">Pelaksana Kegiatan</th>
                      <th valign="top" width="1">:</th>
                      <td><?php echo $this->Mcrud->d_pelaksana($query->id_user,'nama_pelaksana'); ?></td>
                    </tr>
                    
					                    <tr>
                      <th valign="top">Nama Kegiatan</th>
                      <th valign="top">:</th>
                      <td><?php echo $query->nama_kegiatan; ?></td>
                    </tr>
                    
					 
					<tr>
                      <th valign="top">Tempat Kegiatan</th>
                      <th valign="top">:</th>
                      <td><?php echo $query->tempat_kegiatan; ?></td>
                    </tr>
                    <tr>
                      <th valign="top">Peserta Hadir</th>
                      <th valign="top">:</th>
                      <td><?php echo $query->peserta; ?></td>
                    </tr>
                    
                    <tr>
                      <th valign="top">Hari / Tgl Kegiatan</th>
                      <th valign="top">:</th>
                      <td><?php echo $query->tgl_kegiatan; ?></td>
                    </tr>
                    <tr>
                      <th valign="top">Poin-poin Kegiatan</th>
                      <th valign="top">:</th>
                      <td><?php echo $query->poin_kegiatan; ?></td>
                    </tr>
                    </tbody>
                </table>
              </div>
              <h4>Dokumen Pendukung</h4>
              <div class="table-responsive">
			                  <table class="table table-bordered table-striped" width="100%">
                  <tbody>
                    <tr>
                      <th valign="top" width="160">Surat Undangan</th>
                      <th valign="top" width="1">:</th>
                      <td>
                        <a href="<?php echo $query->lamp_surat_undangan; ?>" target="_blank"><?php echo $query->lamp_surat_undangan; ?></a>
                      </td>
                    </tr>
                    <tr>
                      <th valign="top">Sambutan</th>
                      <th valign="top">:</th>
                      <td>
                        <a href="<?php echo $query->lamp_sambutan; ?>" target="_blank"><?php echo $query->lamp_sambutan; ?></a>
                      </td>
                    </tr>
                    <tr>
                      <th valign="top">Paparan</th>
                      <th valign="top">:</th>
                      <td>
                        <a href="<?php echo $query->lamp_paparan; ?>" target="_blank"><?php echo $query->lamp_paparan; ?></a>
                      </td>
                    </tr>
                    <tr>
                      <th valign="top">Dokumen Pendukung Lainnya</th>
                      <th valign="top">:</th>
                      <td>
                        <a href="<?php echo $query->lamp_lain; ?>" target="_blank"><?php echo $query->lamp_lain; ?></a>
                      </td>
                    </tr>
                    </tbody>
                </table>
              </div>
              <h4>Dokumentasi</h4>
              <div class="table-responsive">
			                  <table class="table table-bordered table-striped" width="100%">
                  <tbody>
                    <tr>
                      <th valign="top" width="160">Foto 1</th>
                      <th valign="top" width="1">:</th>
                      <td>
                        <a href="<?php echo $query->lamp_foto1; ?>" target="_blank"><?php echo $query->lamp_foto1; ?></a>
                      </td>
                    </tr>
                    <tr>
                      <th valign="top">Foto 2</th>
                      <th valign="top">:</th>
                      <td>
                        <a href="<?php echo $query->lamp_foto2; ?>" target="_blank"><?php echo $query->lamp_foto2; ?></a>
                      </td>
                    </tr>
                    <tr>
                      <th valign="top">Foto 3</th>
                      <th valign="top">:</th>
                      <td>
                        <a href="<?php echo $query->lamp_foto3; ?>" target="_blank"><?php echo $query->lamp_foto3; ?></a>
                      </td>
                    </tr>
                    <tr>
                      <th valign="top">Foto 4</th>
                      <th valign="top">:</th>
                      <td>
                        <a href="<?php echo $query->lamp_foto4; ?>" target="_blank"><?php echo $query->lamp_foto4; ?></a>
                      </td>
                    </tr>
                    <tr>
                      <th valign="top">Foto 5</th>
                      <th valign="top">:</th>
                      <td>
                        <a href="<?php echo $query->lamp_foto5; ?>" target="_blank"><?php echo $query->lamp_foto5; ?></a>
                      </td>
                    </tr>
                    <tr>
                      <th valign="top">Foto 6</th>
                      <th valign="top">:</th>
                      <td>
                        <a href="<?php echo $query->lamp_foto6; ?>" target="_blank"><?php echo $query->lamp_foto6; ?></a>
                      </td>
                    </tr>
                    </tbody>
                </table>
              </div>
              <h4>Keterangan Humas</h4>
              <div class="table-responsive">
			                  <table class="table table-bordered table-striped" width="100%">
                  <tbody>
					          <tr>
                      <th valign="top" width="160">Tanggal Input Bahan</th>
                      <th valign="top" width="1">:</th>
                      <td><?php echo $this->Mcrud->tgl_id(date('d-m-Y H:i:s', strtotime($query->tgl_input)),'full'); ?></td>
                    </tr>
                    <tr>
                      <th valign="top">STATUS</th>
                      <th valign="top">:</th>
                      <td><?php echo $this->Mcrud->cek_status_berita($query->status); ?></td>
                    </tr>
                    <tr>
                      <th valign="top">Ket. Humas</th>
                      <th valign="top">:</th>
                      <td><?php echo $query->pesan_humas; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <hr style="margin-top:0px;">
              <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>.html" class="btn btn-default"><< Kembali</a>
              <?php if($level=='superadmin' OR $level=='humas'): ?>
                <a class="btn btn-success" title="Edit" data-toggle="modal" onclick="modal_show(<?php echo $query->id_berita; ?>);" style="float:right;"><i class="fa fa-pencil"></i> Proses</a>
              <?php elseif ($level=='superadmin' OR $level=='pelaksana'):
								if ($query->status=='menunggu' OR $query->status=='perbaikan'): ?>
                  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/e/<?php echo hashids_encrypt($query->id_berita); ?>" class="btn btn-success" title="Edit" style="float:right;"><i class="fa fa-pencil"></i> Edit</a>
              <?php endif; endif; ?>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->

    <?php $this->load->view('users/berita/modal_konfirm'); ?>