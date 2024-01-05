<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
$link5 = strtolower($this->uri->segment(5));

?>
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="dashboard.html">Dashboard</a></li>
        <li class="active"><?php echo $judul_web; ?></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header"> <small><?php echo $judul_web; ?></small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <?php
            echo $this->session->flashdata('msg');
            $level 	= $this->session->userdata('level');
            $link3  = strtolower($this->uri->segment(3));
            ?>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Daftar Raperda / Raperkada</h4>
                </div>
                <div class="panel-body">


                    <?php if ($_SESSION['level']!="perancang" && $_SESSION['level']!="pemda"){ ?>
                        <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/t.html" <?php if ($_SESSION['nama_zona']=='superadmin') { ?>
                            class="btn btn-primary"
                        <?php } else if ($_SESSION['nama_zona']=='kasub_perancang') { ?>
                            class="btn btn-primary"
                        <?php } else { ?>
                            class="hidden btn btn-primary"
                        <?php }?>><i
                                    class="fa fa-plus-circle"></i> Tambah Dokumen</a>
                    <?php } ?>

                    <hr>
                    <div class="row">
                        <div class="col-md-12"><b>Filter</b></div>
                        <div class="col-md-3">
                            <select class="form-control default-select2" id="stt" onchange="window.location.href='harmonisasi/v2/pemkab_lombok_tengah/id/'+this.value;">
                                <option value="semua" <?php if('semua'==$link5){ ?> selected <?php }?> >- Semua -</option>
                                <option value="belum_diproses" <?php if('belum_diproses'==$link5){echo "selected";} ?> >Belum diproses</option>
                                <option value="draft_sedang_dibuat" <?php if('draft_sedang_dibuat'==$link5){echo "selected";} ?> >Draft sedang dibuat</option>
                                <option value="menunggu_koreksi" <?php if('menunggu_koreksi'==$link5){ ?> selected <?php } ?> >Menunggu koreksi</option>
                                <option value="selesai" <?php if('selesai'==$link5){echo "selected";} ?> >Selesai</option>
                            </select>
                        </div>
                        <div class="col-md-1 hidden">
                            <button class="btn btn-default" onclick="window.location.href='harmonisasi/v2/pemkab_lombok_tengah/id/'+$('#stt').val();"><i class="fa fa-search"></i> Filter</button>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-2">
                            <?php if ($level=='pelaksana'): ?>
                                <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/t.html" class="btn btn-primary" style="float:right;">Tambah Bahan Berita</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="1%">No.</th>
                                <th width="45%">Judul</th>
                                <th>Status</th>
                                <th>Tgl Upload</th>
                                <th>Jenis</th>
                                <th width="15%" style="text-align: center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $no=1;
                            foreach ($query->result() as $baris):?>
                                <tr>
                                    <td><b><?php echo $no++; ?>.</b> </td>
                                    <td><?php echo $baris->nama_kegiatan; ?></td>
                                    <td><?php echo $this->Mcrud->cek_status_berita($baris->status); ?></td>
                                    <?php
                                    $explode_all = explode(' ', $this->Mcrud->tgl_id($baris->tgl_input));
                                    $explode_date_only = explode('-', $explode_all[0]);

                                    $tgl_indonesia = $explode_date_only[2]."-".$explode_date_only[1]."-".$explode_date_only[0];
                                    ?>
                                    <td><?php echo $tgl_indonesia; ?></td>
                                    <td><?php echo $baris->jenis_dokumen; ?></td>
                                    <td align="center">
                                        <?php if ($baris->lamp_surat_undangan==""){ ?>
                                            <!--Cara disabled on click pada a href-->
                                            <a href="javascript:void(0)"
                                                <?php if ($baris->lamp_surat_undangan=="") { ?>
                                                    class="btn btn-info btn-xs" disabled <?php }
                                                else { ?> class="btn btn-info btn-xs"<?php } ?>
                                               title="Hasil Harmonisasi Belum Ada"
                                               download="">

                                                <i class="fa fa-download"></i>
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url($baris->lamp_surat_undangan); ?>"
                                                <?php if ($baris->lamp_surat_undangan=="") { ?>
                                                    class="btn btn-info btn-xs hidden" <?php }
                                                else { ?> class="btn btn-info btn-xs "<?php } ?>
                                               title="Download"
                                               download="">

                                                <i class="fa fa-download"></i>
                                            </a>
                                        <?php } ?>

                                        <?php if ($_SESSION['level']!="perancang" && $_SESSION['level']!="pemda"){ ?>
                                            <a href="<?php echo $link1; ?>/v/h/<?php echo hashids_encrypt($baris->id_berita); ?>/pemkab_lombok_tengah"
                                                <?php if ($_SESSION['nama_zona']=='superadmin') { ?>
                                                    class="btn btn-danger btn-xs"
                                                <?php } else if ($_SESSION['nama_zona']=='kasub_perancang') { ?>
                                                    class="btn btn-danger btn-xs"
                                                <?php } else { ?>
                                                    class="hidden btn btn-danger btn-xs"
                                                <?php }?>
                                               title="Hapus Dokumen" onclick="return confirm('Anda yakin?');">
                                                <i class="fa fa-trash-o"></i>
                                            </a>

                                            <a href="<?php echo $link1; ?>/v/e/<?php echo hashids_encrypt($baris->id_berita); ?>/pemkab_lombok_tengah"
                                                <?php if ($_SESSION['nama_zona']=='superadmin') { ?>
                                                    class="btn btn-success btn-xs"
                                                <?php } else if ($_SESSION['nama_zona']=='kasub_perancang') { ?>
                                                    class="btn btn-success btn-xs"
                                                <?php } else { ?>
                                                    class="hidden btn btn-success btn-xs"
                                                <?php }?> title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        <?php } ?>


                                        <a
                                                href=""
                                                class="btn btn-info btn-xs"
                                                data-toggle="modal" title="Lihat Detail"
                                                data-target="#detail_hasil_harmonisasi<?php echo $baris->id_berita; ?>">
                                            <i class="fa fa-info-circle"></i>
                                        </a>
                                    </td>
<!--                                    <td style="text-align: center">-->
<!--                                        <a href="--><?php //echo base_url($baris->lamp_surat_undangan);?><!--"-->
<!--                                           class="btn btn-info btn-xs" title="Detail"-->
<!--                                           download="">-->
<!---->
<!--                                            <i class="fa fa-download"></i>-->
<!--                                        </a>-->
<!--                                    </td>-->

                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->
</div>
<!-- end #content -->


<?php
$this->load->view('users/harmonisasi/modaldialog/detail_hasil_harmonisasi')
?>
