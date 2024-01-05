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
                            <div class="form-group">
                                <label class="col-lg-12">Judul <b id='wajib_isi'>*</b></label>
                                <div  class="col-lg-12">
                                    <input style="font-weight: bold; color: black" readonly type="text"
                                           name="nama_draft" id="nama_draft" class="form-control"
                                           value="<?php echo $edit_draft->row()->nama_draft_permohonan;?>" placeholder="Nama.." required>
                                </div>
                            </div>

                            <div class="form-group">
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


                            <div class="form-group" style="background-color: ">
                                <label class="col-lg-11" style="background-color:">Permohonan Harmonisasi</label>
                                <br>
                                <div hidden class="col-lg-12 ">
                                    <input type="file" value="" name="lamp_surat_permohonan_edit"
                                           id="lamp_surat_permohonan_edit" class="form-control" >
                                </div>

                            </div>

                            <div class="">


                                <li class="col-lg-12" style="display: flex ; background-color:  "
                                    id="">
                                    <div class="form-group col-lg-12 m-b-10" style="justify-content: space-between; overflow: auto">
                                        <a style="text-decoration: none; overflow: hidden" href="<?php echo base_url($edit_draft->row()->lamp_surat_permohonan);?>" target="_blank">
                                            <!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                            <?= explode('/',$edit_draft->row()->lamp_surat_permohonan)[2];?>

                                        </a>
                                    </div>
                                </li>


                            </div>

                            <div class="form-group" style="background-color: ">
                                <label class="col-lg-11" style="background-color:">Draft Harmonisasi</label>
                                <br>
                                <div hidden class="col-lg-12 ">
                                    <input type="file" value="" name="draft_harmonisasi_edit_perancang"
                                           id="draft_harmonisasi_edit_perancang" class="form-control" >
                                </div>

                            </div>

                            <div class="">


                                <li class="col-lg-12" style="display: flex ; background-color:  "
                                    id="">
                                    <div class="form-group col-lg-12 m-b-10" style="justify-content: space-between; overflow: auto">
                                        <a style="text-decoration: none; overflow: hidden" href="<?php echo base_url($edit_draft->row()->draft_harmonisasi);?>" target="_blank">
                                            <!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                            <?= explode('/',$edit_draft->row()->draft_harmonisasi)[2];?>

                                        </a>
                                    </div>
                                </li>


                            </div>

                            <div class="form-group" style="background-color: ">
                                <label class="col-lg-11" style="background-color:">Naskah Akademik</label>
                                <br>
                                <div hidden class="col-lg-12 ">
                                    <input type="file" value="" name="naskah_akademik_edit_perancang"
                                           id="naskah_akademik_edit_perancang" class="form-control" >
                                </div>

                            </div>

                            <div class="">


                                <li class="col-lg-12" style="display: flex ; background-color:  "
                                    id="">
                                    <div class="form-group col-lg-12 m-b-10" style="justify-content: space-between; overflow: auto">
                                        <?php if ($edit_draft->row()->naskah_akademik_dll == null || $edit_draft->row()->naskah_akademik_dll == "null" || $edit_draft->row()->naskah_akademik_dll == ""){
                                          ?>
                                            <span>tidak dilampirkan</span>
                                            <?php
                                        } else { ?>
                                            <a style="text-decoration: none; overflow: hidden" href="<?php echo base_url($edit_draft->row()->naskah_akademik_dll);?>" target="_blank">
                                                <!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                                <?= explode('/',$edit_draft->row()->naskah_akademik_dll)[2];?>

                                            </a>
                                        <?php } ?>

                                    </div>
                                </li>


                            </div>




                            <div class="form-group" style="background-color: ">
                                <!--                        <label class="fw-500">Upload File SK / SP / Nodin / Undangan / Paparan / data pendukung lainnya</label>-->
                                <label class="col-lg-11" style="background-color:  ">Dokumen Tambahan</label>
                                <br>
                                <button  class="hidden btn btn-success m-l-15" id="add-more" type="button"
                                        style="background-color: ">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Dokumen
                                </button>

                                <div id="auth-rows"></div>
                            </div>
                            <input type="hidden" value="<?php echo $edit_draft->row()->url_data_dukung;?>" name="url_data_dukung_old">
                            <input type="hidden" value="<?php echo $edit_draft->row()->id_draft_permohonan;?>" name="id_draft_permohonan">

                            <div class="">
                                <?php if ($edit_draft->row()->url_data_dukung == null || $edit_draft->row()->url_data_dukung == "null" || $edit_draft->row()->url_data_dukung == ""){
                                    ?>
                                    <div class="form-group col-lg-12 m-b-10 m-l-5">
                                        <span>tidak dilampirkan</span>
                                    </div>

                                    <?php
                                } else { ?>
                                    <?php
                                    $files = json_decode($edit_draft->row()->url_data_dukung);

                                    foreach ($files as $key=>$file){ ?>
                                        <li class="col-lg-12" style="display: flex ; background-color:  "
                                            id="list-file-<?=$key ?>-<?= $edit_draft->row()->id_draft_permohonan; ?>">
                                            <div class="form-group col-lg-12 m-b-10" style="justify-content: space-between; overflow: auto ">
                                                <a style="text-decoration: none" href="<?= base_url($file); ?>" target="_blank">
                                                    <!--                                                <i class="fa fa-check-square m-l-0" style="margin-right: 10px"></i>-->
                                                    <?php echo explode("/", $file)[2]; ?>
                                                </a>
                                                <a hidden style="" href="javascript:;"
                                                   class="td-n c-red-500 cH-blue-500 fsz-md p-5 pull-right"
                                                   onclick="deleteFile('<?php echo $file;?>',<?= $key?>, <?= $edit_draft->row()->id_draft_permohonan; ?>)">
                                                    <i class="fa fa-trash btn btn-danger"></i>
                                                </a>


                                            </div>
                                        </li>
                                    <?php  }
                                    ?>
                                <?php }?>



                            </div>



                            <div class="form-group">
                                <label class="col-lg-12">Hasil Harmonisasii</label>
                                <div class="col-lg-12">
                                    <?php
                                    $id_draft_permohonan =  $edit_draft->row()->id_draft_permohonan;

                                    $cek_data = $this->db->get_where("tbl_berita", array('id_draft' => $id_draft_permohonan));

                                    //echo $cek_data->row()->lamp_surat_undangan;

                                    ?>

                                    <!--dicek lagi logikanya , ketika data pada field lamp_surat_undangan (tabel tbl_berita) kosong/null-->
                                    <input id="lamp_harmonisasi"
                                           type="file"
                                           value=""

                                           name="lamp_harmonisasi"
                                           class="form-control" <?php if ($cek_data->row()->lamp_surat_undangan =="" or $cek_data->row()->lamp_surat_undangan == null or $cek_data->row()->lamp_surat_undangan =="null"){ ?>
                                            required onchange="checkSelectedFileSpecial(id)"
                                        <?php } else {
                                               ?>
                                        onchange="checkSelectedFileWhenHasBeenFilledBefore(id)"
                                        <?php
                                    } ?> >
                                    <small class="lh-1" style="color: red"><i>.pdf .doc .docx</i></small>
<!--                                    <input type="file" value="" name="lamp_surat_permohonan_edit"-->
<!--                                           id="lamp_surat_permohonan_edit" class="form-control" >-->
                                </div>
                            </div>

                            <div class="">


                                <li class="col-lg-12" style="display: flex ; background-color:  "
                                    id="">
                                    <?php if ($cek_data->row()->lamp_surat_undangan =="" or $cek_data->row()->lamp_surat_undangan == null or $cek_data->row()->lamp_surat_undangan =="null") {
                                        ?>
                                        <span>Belum diupload</span>
                                        <?php
                                    } else { ?>
                                        <div class="form-group col-lg-12 m-b-10" style="justify-content: space-between; overflow: auto">
                                            <a style="text-decoration: none; overflow: hidden" href="<?php echo base_url($tbl_berita_by_draft_id->row()->lamp_surat_undangan);?>" target="_blank">
                                                <!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                                <?= explode('/',$tbl_berita_by_draft_id->row()->lamp_surat_undangan)[2];?>

                                            </a>
                                        </div>
                                    <?php } ?>

                                </li>


                            </div>



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
<!--                                <button type="submit" name="btnsimpan_update_perancang"-->
<!--                                        class="m-t-20 btn btn-primary ">-->
<!--                                    Simpan Edit-->
<!--                                </button>-->

                                <input style="float:right;" type="submit" id="btnsimpan_update_perancang"
                                        name="btnsimpan_update_perancang" class="m-l-10 m-t-20 btn btn-primary"
                                        value="Simpan Data" />
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- /dashboard content -->
        <script type="text/javascript">
            // $('.clockpicker').clockpicker();
            // $( document ).ready(function() {
                // console.log( "ready!" );

               // $('#lamp_harmonisasi').prop('required', true);
                //$('#naskah_akademik_dll').prop('required', false);
                //$('#draft_harmonisasi').prop('required', true);

            // });



            function checkSelectedFileWhenHasBeenFilledBefore(id) {


                fileName = document.querySelector('#' + id).value;
                extension = fileName.split('.').pop();


                if( document.getElementById(id).files.length == 0 ){
                    console.log("no files selected");
                    $('#'+id).prop('required', false);
                    // $('.text-field').prop('required',true);
                } else {
                    console.log("there are files selected");
                    // $('#'+id).prop('required',false);

                    if(extension != 'pdf' && extension != 'doc' && extension!='docx'){
                        alert("ekstensi file harus PDF, DOC, atau DOCX");

                        document.querySelector('#' + id).value = '';
                        $('#'+id).prop('required',false);
                    } else {
                        const oFile = document.getElementById(id).files[0];
                        console.log(id);
                        console.log(oFile);
                        $('#'+id).prop('required',false);

                        if (oFile.size > 5*1024*1024) // 500Kb for bytes.
                        {
                            alert("size file terlalu besar");

                            document.querySelector('#' + id).value = '';
                            $('#'+id).prop('required',false);
                        }
                    }



                }

            }

            function checkSelectedFileSpecial(id) {


                fileName = document.querySelector('#' + id).value;
                extension = fileName.split('.').pop();


                if( document.getElementById(id).files.length == 0 ){
                    console.log("no files selected");
                    $('#'+id).prop('required', true);
                    // $('.text-field').prop('required',true);
                } else {
                    console.log("there are files selected");
                    // $('#'+id).prop('required',false);

                    if(extension != 'pdf' && extension != 'doc' && extension!='docx'){
                        alert("ekstensi file harus PDF, DOC, atau DOCX");

                        document.querySelector('#' + id).value = '';
                        $('#'+id).prop('required',true);
                    } else {
                        const oFile = document.getElementById(id).files[0];
                        console.log(id);
                        console.log(oFile);
                        $('#'+id).prop('required',false);

                        if (oFile.size > 5*1024*1024) // 500Kb for bytes.
                        {
                            alert("size file terlalu besar");

                            document.querySelector('#' + id).value = '';
                            $('#'+id).prop('required',true);
                        }
                    }



                }

            }

            var count = 0;

            function checkFileExtension_edit_perancang(id){
                fileName = document.querySelector('#'+id).value;
                extension = fileName.split('.').pop();

                if(extension != "pdf" && extension != "doc" && extension != "docx"){
                    alert("ekstensi file harus PDF, DOC, atau DOCX");

                    document.querySelector('#' + id).value = '';
                }
                const oFile = document.getElementById(id).files[0];
                console.log(id);
                console.log(oFile);

                if (oFile.size > (5*1024*1024)) // 500Kb for bytes.
                {
                    alert("size file terlalu besar");

                    document.querySelector('#' + id).value = '';
                }
            }

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

            $(document).on('click', '#btnsimpan_update_perancang', function() {
                var response = grecaptcha.getResponse();
                if (response.length == 0) {
                    alert("Please verify you are not a robot.");
                    return false;
                }
            });

        </script>
