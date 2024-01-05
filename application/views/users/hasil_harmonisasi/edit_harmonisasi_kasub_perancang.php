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
                        //                        echo $link1;
                        ?>
                        <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                            <style>
                                #wajib_isi{color:red;}
                            </style>

                            <h4>Informasi Raperda</h4>
                            <div class="form-group">
                                <label class="col-lg-12">Judul <b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <input type="text" id="id_berita" name="id_berita"
                                           class="hidden form-control"
                                           value="<?php echo $edit_hasil_harmonisasi->row()->id_berita;?>"
                                           placeholder="" >
                                    <input type="text" id="nama_kegiatan" name="nama_kegiatan"
                                           class="form-control"
                                           value="<?php echo $edit_hasil_harmonisasi->row()->nama_kegiatan;?>"
                                           placeholder="Nama Kegiatan.." required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12">Jenis<b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <select class="form-control default-select2" name="jenis_dokumen" selected="<?php echo $query->level; ?>" required>
                                        <option value="">- Pilih Jenis Raperda-</option>
                                        <option <?php if ($edit_hasil_harmonisasi->row()->jenis_dokumen=="raperda") { ?> selected <?php } ?>value="raperda">Raperda</option>
                                        <option <?php if ($edit_hasil_harmonisasi->row()->jenis_dokumen=="raperkada") { ?> selected <?php } ?> value="raperkada">Raperkada</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12">Status<b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <select class="form-control default-select2" name="status" id="status">
                                        <!--'belum_diproses','perbaikan','draft_sedang_dibuat','menunggu_koreksi','selesai'-->
                                        <option value="">- Pilih Status -</option>
                                        <option <?php if ($edit_hasil_harmonisasi->row()->status=="belum_diproses") { ?> selected <?php } ?>value="belum_diproses">Belum Diproses</option>
                                        <option <?php if ($edit_hasil_harmonisasi->row()->status=="perbaikan") { ?> selected <?php } ?> value="perbaikan">Perbaikan</option>
                                        <option <?php if ($edit_hasil_harmonisasi->row()->status=="draft_sedang_dibuat") { ?> selected <?php } ?> value="draft_sedang_dibuat">Draft Sedang Dibuat</option>
                                        <option <?php if ($edit_hasil_harmonisasi->row()->status=="menunggu_koreksi") { ?> selected <?php } ?> value="menunggu_koreksi">Menunggu Koreksi</option>
                                        <option <?php if ($edit_hasil_harmonisasi->row()->status=="selesai") { ?> selected <?php } ?> value="selesai">Selesai</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12">Zona<b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <select class="form-control default-select2" name="zona_dokumen" id="zona_dokumen"  required>
                                        <option value="">- Pilih -</option>
                                        <?php
                                            $dt_zona = $dt_tbl_zona = $this->db->get("tbl_zona");

                                            foreach ($dt_zona->result() as $id=>$val){
                                                if($val->nama_zona!='superadmin' and $val->nama_zona!='kasub_perancang'){
                                                    ?>
                                                    <option <?php if($val->nama_zona==$edit_hasil_harmonisasi->row()->zona_dokumen) {
                                                        ?> selected <?php
                                                    } ?>
                                                        value="<?php echo $val->nama_zona; ?>" >
                                                        <?php echo $val->nama_panjang?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                        ?>

                                    </select>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-lg-12">Dokumen Hasil Harmonisasii</label>
                                <div class="col-lg-12">
                                    <input type="file" id="lamp_surat_undangan"
                                        <?php  if ($edit_hasil_harmonisasi->row()->lamp_surat_undangan=="" or $edit_hasil_harmonisasi->row()->lamp_surat_undangan==null or $edit_hasil_harmonisasi->row()->lamp_surat_undangan=="null") {
                                            ?> required onchange="checkSelectedFileSpecial(id)" <?php
                                        } else { ?>
                                            onchange="checkSelectedFileWhenHasBeenFilledBefore(id)"
                                        <?php } ?>
                                           name="lamp_surat_undangan" class="form-control" >
                                    <small class="lh-1" style="color: red"><i>.pdf .doc .docx</i></small>
                                </div>
                            </div>



                            <div class="form-group " style="">
                                <ul class="col-lg-12">
                                    <li class="  m-b-10" style="display: flex ;
                                    justify-content: space-between; overflow: auto"
                                        id="list-file-<?= $edit_hasil_harmonisasi->row()->id_berita ?>">
                                        <a class="" target="_blank" href="<?php echo base_url($edit_hasil_harmonisasi->row()->lamp_surat_undangan);?>">
                                            <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                            <?php echo explode("/",$edit_hasil_harmonisasi->row()->lamp_surat_undangan)[2];?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group m-b-10" style="margin-left: 2pt" >
                                <div class="g-recaptcha" data-sitekey="6LdJ0pAmAAAAAI7vU7S3seu7_Wt9AnJCINpeceU_"
                                     style="width: 40px">

                                </div>
                            </div>

                            <!--LANJUTKAN DISINI MASBROS UNTUK LINK 'KEMBALI'-->
                            <a
                                href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $edit_hasil_harmonisasi->row()->zona_dokumen?>"
                                class="btn btn-default">
                                << Kembali
                            </a>

                            <input style="float:right;" type="submit" id="btnsimpan_edit"
                                   name="btnsimpan_edit" class="btn btn-primary" value="Update Data" />
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <script type="text/javascript">

            $(document).on('click', '#btnsimpan_edit', function() {
                var response = grecaptcha.getResponse();
                if (response.length == 0) {
                    alert("Please verify you are not a robot.");
                    return false;
                }
            });

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

            function checkFileExtension_edit(id) {
                //alert(id);
                fileName = document.querySelector('#' + id).value;

                extension = fileName.split('.').pop();
                //alert(extension);
                if (extension != 'pdf' && extension != 'doc' && extension!='docx') {
                    alert("ekstensi file harus PDF, DOC, atau DOCX");

                    document.querySelector('#' + id).value = '';
                }

                const oFile = document.getElementById(id).files[0];
                console.log(id);
                console.log(oFile);

                if (oFile.size > 5*1024*1024) // 500Kb for bytes.
                {
                    alert("size file terlalu besar");

                    document.querySelector('#' + id).value = '';
                }

            }

        </script>

        <!-- /dashboard content -->
