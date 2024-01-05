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
                        $link4 = strtolower($this->uri->segment(4));
                        ?>
                        <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                            <style>
                                #wajib_isi{color:red;}
                            </style>

                            <h4>Edit Draft Raperda</h4>
                            <div hidden class="form-group">
                                <label class="col-lg-12">Judul <b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <input type="text" name="nama_draft" class="form-control"
                                           value="<?php echo $edit_draft->row()->nama_draft_permohonan;?>" placeholder="Nama.." required>
                                </div>
                            </div>

                            <div hidden class="form-group">
                                <label class="col-lg-11">Jenis<b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <select class="form-control " name="jenis_dokumen" selected=   required>
                                        <option value="">- Pilih Jenis Raperda-</option>
                                        <option value="raperda" <?php if ($edit_draft->row()->jenis_dokumen=='raperda') { echo "selected" ;}?> >Raperda</option>
                                        <option value="raperkada" <?php if ($edit_draft->row()->jenis_dokumen=='raperkada') { echo "selected" ;}?> >Raperkada</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-11">Status<b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <select class="form-control " name="status_dokumen" selected=   required>
                                        <!--'belum_diproses','perbaikan','sedang_diproses','draft_sedang_dibuat','menunggu_koreksi','selesai'-->
                                        <option value="">- Pilih Status-</option>
                                        <option value="belum_diproses" <?php if ($edit_draft->row()->status=='belum_diproses') { echo "selected" ;}?> >Belum Diproses</option>
                                        <option value="sedang_diproses" <?php if ($edit_draft->row()->status=='sedang_diproses') { echo "selected" ;}?> >Sedang Diproses</option>
<!--                                        <option value="draft_sedang_dibuat" --><?php //if ($edit_draft->row()->status=='draft_sedang_dibuat') { echo "selected" ;}?><!-- >Draft Sedang Dibuat</option>-->
<!--                                        <option value="menunggu_koreksi" --><?php //if ($edit_draft->row()->status=='menunggu_koreksi') { echo "selected" ;}?><!-- >Menunggu Koreksi</option>-->
                                        <option value="selesai" <?php if ($edit_draft->row()->status=='selesai') { echo "selected" ;}?> >Selesai</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12">Nama Perancang <b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <input  type="text" name="nama_perancang" id="nama_perancang" class="form-control"
                                           value="<?php echo $edit_draft->row()->nama_perancang??'';?>" placeholder="Nama.." required>
                                </div>
                            </div>


                            <div class="form-group" style="background-color: ">
                                <label class="col-lg-11" style="background-color:">Permohonan Harmonisasi</label>
                                <br>
                                <div class="col-lg-12 hidden">
                                    <input type="file" value="" name="lamp_surat_permohonan_edit"
                                           id="lamp_surat_permohonan_edit" class="form-control" >
                                </div>
                            </div>

                            <div class="">
                                <li class="col-lg-12" style="display: flex ; background-color:  "
                                    id="">
                                    <div class="form-group col-lg-12 m-b-10" style="justify-content: space-between; overflow: auto">
                                        <a class="" style="text-decoration: none; overflow: hidden"
                                           href="<?php echo base_url($edit_draft->row()->lamp_surat_permohonan);?>"
                                           target="_blank">
                                            <!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                            <?= explode('/',$edit_draft->row()->lamp_surat_permohonan)[2];?>

                                        </a>




                                    </div>
                                </li>


                            </div>

                            <div class="form-group" style="background-color: ">
                                <label class="col-lg-11" style="background-color:">Drafts Harmonisasi</label>
                                <br>
                                <div class="col-lg-12 hidden">
                                    <input type="file" value="" name="draft_harmonisasi_edit_kasub_perancang"
                                           id="draft_harmonisasi_edit_kasub_perancang" class="form-control" >
                                </div>
                            </div>

                            <div class="">
                                <li class="col-lg-12" style="display: flex ; background-color:  "
                                    id="">
                                    <div class="form-group col-lg-12 m-b-10" style="justify-content: space-between; overflow: auto">
                                        <a class="" style="text-decoration: none; overflow: hidden"
                                           href="<?php echo base_url($edit_draft->row()->draft_harmonisasi);?>"
                                           target="_blank">
                                            <!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                            <?= explode('/',$edit_draft->row()->draft_harmonisasi)[2];?>

                                        </a>




                                    </div>
                                </li>


                            </div>

                            <div class="form-group" style="background-color: ">
                                <label class="col-lg-11" style="background-color:">Naskah Akademik</label>
                                <br>
                                <div class="col-lg-12 hidden">
                                    <input type="file" value="" name="naskah_akademik_edit_kasub_perancang"
                                           id="naskah_akademik_edit_kasub_perancang" class="form-control" >
                                </div>
                            </div>

                            <div class="">
                                <li class="col-lg-12" style="display: flex ; background-color:  "
                                    id="">
                                    <div class="form-group col-lg-12 m-b-10" style="justify-content: space-between; overflow: auto">
                                        <?php if ($edit_draft->row()->naskah_akademik_dll == null || $edit_draft->row()->naskah_akademik_dll == "null" || $edit_draft->row()->naskah_akademik_dll == "" ){
                                            ?>

                                            <span>tidak dilampirkan</span>
                                            <?php
                                        } else  { ?>
                                            <a class="" style="text-decoration: none; overflow: hidden"
                                               href="<?php echo base_url($edit_draft->row()->naskah_akademik_dll);?>"
                                               target="_blank">
                                                <!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                                <?= explode('/',$edit_draft->row()->naskah_akademik_dll)[2];?>

                                            </a>
                                        <?php } ?>

                                    </div>
                                </li>


                            </div>

                            <div class="form-group" style="background-color: ">
                                <label class="col-lg-11" style="background-color:">Dokumen Tambahan</label>
                                <br>
                                <div class="col-lg-12 hidden">
                                    <input type="file" value="" name="lamp_surat_permohonan_edit"
                                           id="lamp_surat_permohonan_edit" class="form-control" >
                                </div>
                            </div>

                            <input type="hidden" value="<?php echo $edit_draft->row()->url_data_dukung;?>" name="url_data_dukung_old">
                            <input type="hidden" value="<?php echo $edit_draft->row()->id_draft_permohonan;?>" name="id_draft_permohonan">

                            <div class="" style="margin-bottom: 100px">

                                <?php if ($edit_draft->row()->url_data_dukung == null || $edit_draft->row()->url_data_dukung == "null" || $edit_draft->row()->url_data_dukung == "") {
                                    ?>
                                    <li class="col-lg-12" style="display: flex ; background-color:  ">
                                        <div class="form-group col-lg-12 m-b-1" style="justify-content: space-between; overflow: auto">
                                            <span>tidak dilampirkan</span>
                                        </div>
                                    </li>
                                    <?php
                                } else { ?>
                                    <?php
                                    $files = json_decode($edit_draft->row()->url_data_dukung);

                                    foreach ($files as $key=>$file){ ?>
                                        <li class="col-lg-12" style="display: flex ; background-color:  "
                                            id="list-file-<?=$key ?>-<?= $edit_draft->row()->id_draft_permohonan; ?>">
                                            <div class="form-group col-lg-12 m-b-1" style="justify-content: space-between; overflow: auto">
                                                <a style="text-decoration: none" href="<?= base_url($file); ?>" target="_blank">
                                                    <!--                                                <i class="fa fa-check-square m-l-0" style="margin-right: 10px"></i>-->
                                                    <?php echo explode("/", $file)[2]; ?>
                                                </a>

                                            </div>
                                        </li>
                                    <?php  }
                                    ?>
                                <?php } ?>



                            </div>


                            <div hidden class="form-group" style="background-color: ">
                                <!--                        <label class="fw-500">Upload File SK / SP / Nodin / Undangan / Paparan / data pendukung lainnya</label>-->
                                <label class="col-lg-11" style="background-color:  ">Draft Harmonisasi</label>


                                <div id="auth-rows"></div>
                            </div>


                            <div hidden class="" style="margin-bottom: 100px">

                                <?php
                                $files = json_decode($edit_draft->row()->url_data_dukung);

                                foreach ($files as $key=>$file){ ?>
                                    <li class="col-lg-12" style="display: flex ; background-color:  "
                                        id="list-file-<?=$key ?>-<?= $edit_draft->row()->id_draft_permohonan; ?>">
                                        <div class="form-group col-lg-12 m-b-1" style="justify-content: space-between; overflow: auto">
                                            <a style="text-decoration: none" href="<?= base_url($file); ?>" target="_blank">
                                                <!--                                                <i class="fa fa-check-square m-l-0" style="margin-right: 10px"></i>-->
                                                <?php echo explode("/", $file)[2]; ?>
                                            </a>

                                        </div>
                                    </li>
                                <?php  }
                                ?>

                            </div>

                            <?php

                            if($status=="selesai"){
                                ?>

                                <div class="form-group" style="background-color: ">
                                    <label class="col-lg-11" style="background-color:  ">Hasil Harmonisasi</label>

                                </div>

                                <div class="form-group col-lg-12" style="justify-items: end">
                                    <div class="row m-l-10" style=" overflow: hidden;  ">

                                        <a style="text-decoration: none" href="<?php echo base_url($dt_tbl_berita->lamp_surat_undangan);?>" target="_blank">

                                            <span>
                                                <?= explode('/',$dt_tbl_berita->lamp_surat_undangan)[2];?>
                                            </span>

                                        </a>
                                    </div>

                                </div>

                                <?php
                            }

                            ?>


                            <hr>
                            <div class="form-group" style="margin-left: 2pt; margin-top: 30px" >
                                <div class="g-recaptcha" data-sitekey="6LdJ0pAmAAAAAI7vU7S3seu7_Wt9AnJCINpeceU_"
                                     style="">

                                </div>
                            </div>
                            <div class="text-right ">
                                <a href="pemda/draft/<?= $edit_draft->row()->zona_dokumen;?>"
                                   class="m-t-20 btn btn-warning cur-p float-left"
                                   data-dismiss="modal"
                                   name="">
                                    Kembali
                                </a>

<!--                                <button --><?php //if($status=="selesai") { ?><!-- disabled --><?php //} ?><!-- -->
<!--                                        type="submit" name="btnsimpan_update_kasub_perancang"-->
<!--                                        class="m-t-20 btn btn-primary ">-->
<!--                                    Proses-->
<!--                                </button>-->

                                <input <?php if($status=="selesai") {?> disabled <?php } ?>
                                        style="float:right;" type="submit" id="btnsimpan_update_kasub_perancang"
                                        name="btnsimpan_update_kasub_perancang" class="m-l-10 m-t-20 btn btn-primary "
                                        value="Prosess" />
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- /dashboard content -->
        <script type="text/javascript">
            // $('.clockpicker').clockpicker();

            $("#add-more").click(function(e){

                var html3 = '<div class="form-group input-dinamis m-20"><div class="row"><div class="col-input-dinamis col-lg-10 "><input type="file" name="url_files[]" class="form-control border-grey" id="peserta" placeholder="Upload file" required></div><div class="col-input-dinamis col-lg-2"><button class="btn btn-danger remove" type="button"><i class="fa fa-minus-circle"></i></button></div></div></div>';

                $('#auth-rows').append(html3);
            });

            $('#auth-rows').on('click', '.remove', function(e){
                e.preventDefault();
                $(this).parents('.input-dinamis').remove();
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
                        console.log($path+" "+$file_id+" "+$row_id);
                        $("#list-file-"+$file_id+"-"+$row_id).remove();
                    });
                }

                // alert("tesss");

            }

            $(document).on('click', '#btnsimpan_update_kasub_perancang', function() {
                var response = grecaptcha.getResponse();
                if (response.length == 0) {
                    alert("Please verify you are not a robot.");
                    return false;
                }
            });

        </script>
