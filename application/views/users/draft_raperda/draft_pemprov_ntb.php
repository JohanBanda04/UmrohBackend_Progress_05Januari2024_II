<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
$link5 = strtolower($this->uri->segment(5));

$zona_doc = explode('_',$link3);
$zona_document =  $zona_doc[1]."_".$zona_doc[2];

?>
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <!--boyaq lek tene-->
        <li><a href="dashboard.html">Dashboard</a></li>

        <li class="active"><?php echo $judul_web; ?></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header"> <small><?php echo $judul_web; ?></small></h1>
    <!-- end page-header -->
    <?php


    ?>
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
                    <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/t/<?php echo $zona_document ?>" class="btn btn-primary"><i
                                class="fa fa-plus-circle"></i> Tambah Dokumen</a>
<!--                            --><?//= $zona_document; ?>
<!--                    <a href="harmonisasi/v/t.html">-->
<!--                        <i class="fa fa-plus-square bg-gray"></i>-->
<!--                        <span>Tambah Dokumen</span>-->
<!--                    </a>-->
                    <hr>
                    <div class="row">
                        <div class="col-md-12"><b>Filter</b></div>
                        <div class="col-md-3">
<!--                            'belum_diproses','perbaikan','draft_sedang_dibuat','menunggu_koreksi','selesai'-->
                            <!--'belum_diproses','perbaikan','draft_sedang_dibuat','menunggu_koreksi','selesai'-->
                            <select class="form-control default-select2" id="stt" onchange="window.location.href='pemda/v2/pemprov_ntb/id/'+this.value;">
                                <option value="semua" <?php if('semua'==$link5){ ?> selected <?php }?> >- Semua -</option>
                                <option value="belum_diproses" <?php if('belum_diproses'==$link5){echo "selected";} ?> >Belum diproses</option>
                                <option value="sedang_diproses" <?php if('sedang_diproses'==$link5){echo "selected";} ?> >Sedang Diproses</option>
                                <option value="selesai" <?php if('selesai'==$link5){echo "selected";} ?> >Selesai</option>
                            </select>
                        </div>
                        <div class="col-md-1 hidden">
                            <button class="btn btn-default" onclick="window.location.href='pemda/v2/pemprov_ntb/id/'+$('#stt').val();"><i class="fa fa-search"></i> Filter</button>
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
                                <th width="1%">Nos.</th>
                                <th width="45%">Judul</th>
                                <th>Status</th>
                                <th  width="20%">Perancang</th>
                                <th>Jenis</th>
                                <th width="20%" style="text-align: center">Aksi</th>
<!--                                <th width="" style="text-align: center">Hapus</th>-->
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $no=1;
                            foreach ($query->result() as $baris):?>
                                <tr>
                                    <td><b><?php echo $no++; ?>.</b> </td>
                                    <td><?php echo $baris->nama_draft_permohonan; ?></td>
                                    <td><?php echo $this->Mcrud->cek_status_berita($baris->status) ; ?></td>
                                    <td ><?php echo $baris->nama_perancang ; ?></td>
                                    <td><?php echo $baris->jenis_dokumen; ?></td>

                                    <td align="center">
<!--                                        <a href="--><?php //echo base_url($baris->lamp_surat_undangan);?><!--"-->
<!--                                           class="btn btn-info btn-xs" title="Info Detail"-->
<!--                                           download="">-->
<!---->
<!--                                            <i class="fa fa-info-circle"></i>-->
<!--                                        </a>-->

                                        <a
                                                href=""
                                                class="btn btn-info btn-xs"
                                                data-toggle="modal" title="Lihat Detail"
                                                data-target="#detail_draft_berita<?php echo $baris->id_draft_permohonan; ?>">
                                            <i class="fa fa-info-circle"></i>
                                        </a>


                                        <a
                                                href=""
                                                class="btn btn-danger btn-xs"
                                                data-toggle="modal"
                                                data-target="#delete_confirm<?php echo $baris->id_draft_permohonan; ?>"
                                        ><i class="fa fa-trash-o"></i
                                            ></a>

                                        <a
                                                href=""
                                                class="hidden btn btn-success btn-xs"
                                                data-toggle="modal"
                                                data-target="#edit_draft_berita<?php echo $baris->id_draft_permohonan; ?>"
                                        ><i class="fa fa-edit"></i
                                            ></a>

                                        <a href="pemda/v/ce/<?php echo $baris->id_draft_permohonan; ?>/<?= $link3;?>"
                                           class="btn btn-success btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a href="pemda/v/ce_kasub_perancang/<?php echo $baris->id_draft_permohonan; ?>/<?= $link3;?>"
                                           class="btn btn-warning btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a href="pemda/v/ce_perancang/<?php echo $baris->id_draft_permohonan; ?>/<?= $link3;?>"
                                           class="btn btn-inverse btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>

<!--                                        <a href="--><?php //echo $link1; ?><!--/v/e/--><?php //echo hashids_encrypt($baris->id_berita); ?><!--/pemprov_ntb"-->
<!--                                           class="btn btn-success btn-xs" title="Edit">-->
<!--                                            <i class="fa fa-edit"></i>-->
<!--                                        </a>-->

                                    </td>



                                </tr>
                                <div class="modal fade" id="delete_confirm<?php echo $baris->id_draft_permohonan; ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="bd p-15"><h5 class="m-0">Hapus Data</h5></div>
                                            <div class="modal-body">
<!--                                                <form method="POST" action="pemda/v/h">-->
                                                <form method="POST" action="<?php echo $link1; ?>/<?php echo $link2; ?>/h/<?php echo $zona_document ?>">
                                                    <input type="hidden" value="<?php echo $baris->id_draft_permohonan; ?>" name="id_draft_permohonan" />
                                                    <div>Apakah Anda yakin akan menghapus data draft raperda ini?</div>
                                                    <hr>
                                                    <div class="text-right">
                                                        <button
                                                                class="btn btn-primary cur-p float-left"
                                                                data-dismiss="modal"
                                                                name="">Tidak
                                                        </button>
                                                        <button class="btn btn-danger cur-p"
                                                                name="">Ya
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="detail_draft_berita<?php echo $baris->id_draft_permohonan; ?>">

                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Detail Draft Raperda</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-horizontal">
                                                    <span style="font-weight: bold; font-size: 15px">Judul :</span>
                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->nama_draft_permohonan; ?></span>

                                                    <br>
                                                    <div style="height: 15px"></div>

                                                    <span style="font-weight: bold; font-size: 15px">Jenis :</span>
                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->jenis_dokumen; ?></span>

                                                    <br>
                                                    <div style="height: 15px"></div>

                                                    <span style="font-weight: bold; font-size: 15px">Permohonan Harmonisasi :</span>
                                                    <br>
                                                    <div style="height: 15px"></div>

                                                    <div class="form-group col-lg-12" style="justify-items: end; background-color: ">
                                                        <div class="row m-l-1" style=" overflow: hidden;  ">
                                                            <a style="text-decoration: none" href="<?php echo base_url($baris->lamp_surat_permohonan);?>" target="_blank">
                                                                <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                                                <?= explode('/',$baris->lamp_surat_permohonan)[2];?>

                                                            </a>
                                                        </div>

                                                    </div>

                                                    <br>
                                                    <div style="height: 15px"></div>

                                                    <span style="font-weight: bold; font-size: 15px">Drafts Harmonisasi :</span>
                                                    <br>
                                                    <div style="height: 20px"></div>


                                                    <div class="form-group col-lg-12" style="justify-items: end; background-color: ">

                                                        <?php

                                                        foreach ($this->Mcrud->url_data_dukung($baris->url_data_dukung) as $key => $element){ ?>


                                                                <div class="row m-l-1" style=" overflow: auto;  ">
                                                                    <a style="text-decoration: none" href="<?= base_url($element); ?>" target="_blank">
                                                                        <i class="fa fa-check-square" style="margin-left: 0px; margin-right: 15px"></i>
                                                                        <?php echo explode("/", $element)[2]; ?>
                                                                    </a>
                                                                </div>




                                                        <?php  }
                                                        ?>

                                                    </div>

                                                    <?php
                                                    $dt_tbl_berita = $this->db->get_where("tbl_berita", array('id_draft'=> $baris->id_draft_permohonan))->row();
                                                    $status = $dt_tbl_berita->status;

                                                    if($status=="selesai"){
                                                        ?>

                                                        <span style="font-weight: bold; font-size: 15px">Hasil Harmonisasi :</span>
                                                        <br>
                                                        <div style="height: 15px"></div>

                                                        <div class="form-group col-lg-12" style="justify-items: end">
                                                            <div class="row m-l-1" style=" overflow: hidden;  ">

                                                                <a style="text-decoration: none" href="<?php echo base_url($dt_tbl_berita->lamp_surat_undangan);?>" target="_blank">
                                                                    <i class="fa fa-check-square" style=" "></i>
                                                                    <span>
                                                                        <?= explode('/',$dt_tbl_berita->lamp_surat_undangan)[2];?>
                                                                    </span>



                                                                </a>
                                                            </div>

                                                        </div>

                                                        <?php
                                                    }
                                                    ?>




                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="edit_draft_berita<?php echo $baris->id_draft_permohonan; ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Edit Draft Raperda</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="pemda/v/se/<?php echo strtolower($this->uri->segment(3)); ?>" enctype="multipart/form-data">
                                                    <input type="hidden" value="<?= $baris->id_draft_permohonan;?>" name="id_draft_permohonan_edit">
                                                    <div class="form-group" for="judul_draft_permohonan_edit">
                                                        <label class="fw-500" style="font-weight: bold">Judul</label>
                                                        <br>

                                                        <input
                                                                class="form-control border-grey"
                                                                rows="5"
                                                                name="judul_draft_permohonan_edit"
                                                                id="judul_draft_permohonan_edit" value="<?php echo $baris->nama_draft_permohonan ?>"
                                                                required
                                                        >
                                                    </div>
                                                    <div class="form-group" style="align-items: flex-start" for="jenis_dokumen_edit">
                                                        <label class="" style="font-weight: bold">Jenis</label>

                                                        <br>
                                                        <div class="">
                                                            <select class="form-control " name="jenis_dokumen_edit" selected=   required>
                                                                <option value="">- Pilih Jenis Raperda-</option>
                                                                <option value="raperda" <?php if ($baris->jenis_dokumen=='raperda') { echo "selected" ;}?> >Raperda</option>
                                                                <option value="raperkada" <?php if ($baris->jenis_dokumen=='raperkada') { echo "selected" ;}?> >Raperkada</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" for="lamp_surat_permohonan_edit">
                                                        <label class="" style="font-weight: bold">Permohonan Harmonisasi</label>
                                                        <div class="m-b-10">
                                                            <input  type="file" value="" name="lamp_surat_permohonan_edit" id="lamp_surat_permohonan_edit" class="form-control" >
                                                        </div>

                                                        <div style="overflow: hidden ">
                                                            <a href="<?php echo base_url($baris->lamp_surat_permohonan);?>" target="_blank">
                                                                <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                                                <?= explode('/',$baris->lamp_surat_permohonan)[2];?>
                                                            </a>
                                                        </div>

                                                    </div>
                                                    <div class="form-group" style="background-color: " for="">
                                                        <label class=" " style="font-weight: bold">Upload Draft Harmonisasi</label>
                                                        <br>

                                                        <button class="btn btn-success m-b-10" id="add-more-edit-<?php echo $baris->id_draft_permohonan; ?>"
                                                                type="button">
                                                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah / Ubah file
                                                        </button>
                                                        <div id="auth-rows-edit-<?php echo $baris->id_draft_permohonan; ?>"></div>

                                                    </div>

                                                    <div class="mb-4">

                                                        <?php
                                                        $files = json_decode($baris->url_data_dukung);

                                                        foreach ($files as $key=>$file){ ?>
                                                            <li style="display: flex ; justify-content: space-between"
                                                                id="list-file-<?=$key ?>-<?= $baris->id_draft_permohonan; ?>">
                                                                <div class="form-group" style="justify-items: end">
                                                                    <a href="<?= base_url($file); ?>" target="_blank">
                                                                        <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                                                        <?php echo explode("/", $file)[2]; ?>
                                                                    </a>
                                                                    <a style="" href="javascript:;"
                                                                       class="td-n c-red-500 cH-blue-500 fsz-md p-5"
                                                                       onclick="deleteFile('<?php echo $file;?>',<?= $key?>, <?= $baris->id_draft_permohonan; ?>)">
                                                                        <i class="fa fa-trash btn btn-danger"></i>
                                                                    </a>


                                                                </div>
                                                                <!--<a href="javascript:;"
                                                                   class="td-n c-red-500 cH-blue-500 fsz-md p-5"
                                                                   onclick="deleteFile('<?php /*echo $file;*/?>',<?/*= $key*/?>, <?/*= $baris->id_draft_permohonan; */?>)">
                                                                    <i class="fa fa-trash btn btn-danger"></i>
                                                                </a>-->
                                                            </li>
                                                        <?php  }
                                                        ?>

                                                    </div>



                                                    <div class="text-right">
                                                        <button
                                                                class="btn btn-info cur-p float-left"
                                                                data-dismiss="modal"
                                                                name="">
                                                            Kembali
                                                        </button>
                                                        <button
                                                                class="btn btn-warning cur-p"
                                                                name="">
                                                            Simpan Edit
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
<!--                                            <div class="modal-footer">-->
<!--                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--                                            </div>-->
                                        </div>
                                    </div>
                                </div>



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

<script type="text/javascript">


    // var currentId = 0;


    $("[id^='add-more-edit-']").click(function (e) {

        var html4 = '<div class="form-group input-dinamis-edit">' +
            '<div class="row">' +
            '<div class="col-input-dinamis-edit col-lg-10">' +
            '<input type="file" name="url_files_edit[]" ' +
            'class="form-control border-grey" id="peserta" placeholder="Upload file" required>' +
            '</div>' +
            '<div class="col-input-dinamis-edit col-lg-2"><button class="btn btn-danger remove-edit" type="button">' +
            '<i class="fa fa-minus-circle"></i>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</div>';

        $("[id^='auth-rows-edit-']").append(html4);
    });

    $("[id^='auth-rows-edit-']").on('click', '.remove-edit', function (e) {
        e.preventDefault();
        $(this).parents('.input-dinamis-edit').remove();
    });



    function deleteFile($path,$file_id,$row_id){
        // $path = nama file;
        // $file_id = index file dari record db;
        // $row_id= id unique;
        // confirm("Hapus File?",);
        if (confirm("Hapus File Lampiran?") == true) {
            $.post("pemda/v/df",{

                path : $path,
                id : $row_id,

                file_id : $file_id
            }).done(function (response) {
                // console.log(response);
                console.log($path);
                $("#list-file-"+$file_id+"-"+$row_id).remove();
            });
        }

        // alert("tesss");

    }
</script>



