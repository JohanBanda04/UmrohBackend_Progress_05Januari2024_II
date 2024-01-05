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

                            <h4>Informasi Raperdaszz </h4>
                            <div class="form-group">
                                <label class="col-lg-12">Judul <b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <input type="text" name="nama_kegiatan" class="form-control" value="<?php echo $query->nama_kegiatan;?>" placeholder="Nama Kegiatan.." required>
                                </div>
                            </div>


                            <div hidden class="form-group">
                                <label class="col-lg-12">Untuk ID Berita <b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <input type="hidden" id="id_berita" name="id_berita" class="form-control" value="<?php echo $query->id_berita; ?>" placeholder="" >

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12">Jenis<b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <select class="form-control default-select2" name="jenis_dokumen" selected="<?php echo $query->level; ?>" required>
                                        <option value="">- Pilih Jenis Raperda-</option>
                                        <option <?php if ($query->jenis_dokumen=="raperda") { ?> selected <?php } ?>value="raperda">Raperda</option>
                                        <option <?php if ($query->jenis_dokumen=="raperkada") { ?> selected <?php } ?> value="raperkada">Raperkada</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12">Status<b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <select class="form-control default-select2" name="status" id="status">
                                        <!--'belum_diproses','perbaikan','draft_sedang_dibuat','menunggu_koreksi','selesai'-->
                                        <option value="">- Pilih Status -</option>
                                        <option <?php if ($query->status=="belum_diproses") { ?> selected <?php } ?>value="belum_diproses">Belum Diproses</option>
                                        <option <?php if ($query->status=="perbaikan") { ?> selected <?php } ?> value="perbaikan">Perbaikan</option>
                                        <option <?php if ($query->status=="draft_sedang_dibuat") { ?> selected <?php } ?> value="draft_sedang_dibuat">Draft Sedang Dibuat</option>
                                        <option <?php if ($query->status=="menunggu_koreksi") { ?> selected <?php } ?> value="menunggu_koreksi">Menunggu Koreksi</option>
                                        <option <?php if ($query->status=="selesai") { ?> selected <?php } ?> value="selesai">Selesai</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12">Zona<b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <select class="form-control default-select2" name="zona_dokumen"  required>
                                        <option value="">- Pilih -</option>
                                        <option <?php if($query->zona_dokumen=='pemprov_ntb') { ?> selected <?php } ?> value="pemprov_ntb">Pemprov NTB</option>
                                        <option <?php if($query->zona_dokumen=='pemkot_mataram') { ?> selected <?php } ?> value="pemkot_mataram">Pemkot Mataram</option>
                                        <option <?php if($query->zona_dokumen=='pemkot_bima') { ?> selected <?php } ?> value="pemkot_bima">Pemkot Bima</option>
                                        <option <?php if($query->zona_dokumen=='pemkab_sumbawa_barat') { ?> selected <?php } ?> value="pemkab_sumbawa_barat">Pemkab Sumbawa Barat</option>
                                        <option <?php if($query->zona_dokumen=='pemkab_sumbawa') { ?> selected <?php } ?> value="pemkab_sumbawa">Pemkab Sumbawa</option>
                                        <option <?php if($query->zona_dokumen=='pemkab_lombok_utara') { ?> selected <?php } ?> value="pemkab_lombok_utara">Pemkab Lombok Utara</option>
                                        <option <?php if($query->zona_dokumen=='pemkab_lombok_timur') { ?> selected <?php } ?> value="pemkab_lombok_timur">Pemkab Lombok Timur</option>
                                        <option <?php if($query->zona_dokumen=='pemkab_lombok_tengah') { ?> selected <?php } ?> value="pemkab_lombok_tengah">Pemkab Lombok Tengah</option>
                                        <option <?php if($query->zona_dokumen=='pemkab_lombok_barat') { ?> selected <?php } ?> value="pemkab_lombok_barat">Pemkab Lombok Barat</option>
                                        <option <?php if($query->zona_dokumen=='pemkab_dompu') { ?> selected <?php } ?> value="pemkab_dompu">Pemkab Dompu</option>
                                        <option <?php if($query->zona_dokumen=='pemkab_bima') { ?> selected <?php } ?> value="pemkab_bima">Pemkab Bima</option>
                                    </select>
                                </div>
                            </div>



                            <!--tampilan untuk HASIL HARMONISASI-->
                            <div class="form-group">
                                <label class="col-lg-12">Dokumen Hasil Harmonisasiz</label>
                                <div class="col-lg-12">
                                    <input type="file" id="lamp_surat_undangan"
                                           <?php  if ($query->lamp_surat_undangan=="" or $query->lamp_surat_undangan==null or $query->lamp_surat_undangan=="null") {
                                               ?> required onchange="checkSelectedFileSpecial(id)" <?php
                                           } else { ?>
                                               onchange="checkSelectedFileWhenHasBeenFilledBefore(id)"
                                           <?php } ?>
                                           name="lamp_surat_undangan" class="form-control" >
                                    <small class="lh-1" style="color: red"><i>.pdf .doc .docx (max size : 4 MB)</i></small>
                                </div>
                            </div>



                            <div class="form-group ">
                                <ul class="col-lg-12">
                                    <li class="  m-b-5" style="display: flex ;
                                    justify-content: space-between;"
                                        id="list-file-<?= $query->id_berita ?>">
                                        <a class="" target="_blank" href="<?php echo base_url($query->lamp_surat_undangan);?>">
                                            <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                            <?php echo explode("/",$query->lamp_surat_undangan)[2]??"Belum dilampirkan";?>
                                        </a>
                                    </li>
                                </ul>
                            </div>


                            <!--tampilan untuk BERITA ACARA-->
                            <div class="form-group">
                                <label class="col-lg-12">Dokumen Berita Acara</label>
                                <div class="col-lg-12">
                                    <input type="file" id="lamp_berita_acara"
                                        <?php  if ($query->lamp_berita_acara=="" or $query->lamp_berita_acara==null or $query->lamp_berita_acara=="null") {
                                            ?>  onchange="checkSelectedFileSpecial_notRequired(id)" <?php
                                        } else { ?>
                                            onchange="checkSelectedFileWhenHasBeenFilledBefore(id)"
                                        <?php } ?>
                                           name="lamp_berita_acara" class="form-control" >
                                    <small class="lh-1" style="color: red"><i>.pdf .doc .docx (max size : 4 MB)</i></small>
                                </div>
                            </div>



                            <div class="form-group ">
                                <ul class="col-lg-12">
                                    <li class="  m-b-5" style="display: flex ;
                                    justify-content: space-between;"
                                        id="list-file-<?= $query->id_berita ?>">
                                        <a class="" target="_blank" href="<?php echo base_url($query->lamp_berita_acara);?>">
                                            <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                            <?php echo explode("/",$query->lamp_berita_acara)[2]??"Belum dilampirkan";?>
                                        </a>
                                    </li>
                                </ul>
                            </div>



                            <!--tampilan untuk SURAT HASIL-->
                            <div class="form-group">
                                <label class="col-lg-12">Dokumen Surat Hasil</label>
                                <div class="col-lg-12">
                                    <input type="file" id="lamp_surat_hasil"
                                        <?php  if ($query->lamp_surat_hasil=="" or $query->lamp_surat_hasil==null or $query->lamp_surat_hasil=="null") {
                                            ?>  onchange="checkSelectedFileSpecial_notRequired(id)" <?php
                                        } else { ?>
                                            onchange="checkSelectedFileWhenHasBeenFilledBefore(id)"
                                        <?php } ?>
                                           name="lamp_surat_hasil" class="form-control" >
                                    <small class="lh-1" style="color: red"><i>.pdf .doc .docx (max size : 4 MB)</i></small>
                                </div>
                            </div>



                            <div class="form-group ">
                                <ul class="col-lg-12">
                                    <li class="  m-b-5" style="display: flex ;
                                    justify-content: space-between;"
                                        id="list-file-<?= $query->id_berita ?>">
                                        <a class="" target="_blank" href="<?php echo base_url($query->lamp_surat_hasil);?>">
                                            <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                            <?php echo explode("/",$query->lamp_surat_hasil)[2]??"Belum dilampirkan";?>
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
                                    href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $query->zona_dokumen?>"
                                    class="btn btn-default">
                                << Kembali
                            </a>
                            <!--<a
                                href="<?php /*if($query->zona_dokumen=="pemprov_ntb"){
                                    */?>
                                    <?php /*echo strtolower($this->uri->segment(1)); */?>/<?php /*echo strtolower($this->uri->segment(2)); */?>/pemprov_ntb.html
                                <?php
/*                                } else if($query->zona_dokumen=="pemkot_mataram"){ */?>
                                    <?php /*echo strtolower($this->uri->segment(1)); */?>/<?php /*echo strtolower($this->uri->segment(2)); */?>/pemkot_mataram.html
                                <?php /*} else if($query->zona_dokumen=="pemkot_bima"){ */?>
                                    <?php /*echo strtolower($this->uri->segment(1)); */?>/<?php /*echo strtolower($this->uri->segment(2)); */?>/pemkot_bima.html
                                <?php /*} else if($query->zona_dokumen=="pemkab_sumbawa_barat"){ */?>
                                    <?php /*echo strtolower($this->uri->segment(1)); */?>/<?php /*echo strtolower($this->uri->segment(2)); */?>/pemkab_sumbawa_barat.html
                                <?php /*} else if($query->zona_dokumen=="pemkab_sumbawa"){ */?>
                                    <?php /*echo strtolower($this->uri->segment(1)); */?>/<?php /*echo strtolower($this->uri->segment(2)); */?>/pemkab_sumbawa.html
                                <?php /*} */?>  "
                                class="btn btn-default">
                                << Kembali
                            </a>-->
<!--                            <button type="submit" name="btnsimpan_edit" class="btn btn-primary" style="float:right;">-->
<!--                                Kirim-->
<!--                            </button>-->
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

            function checkSelectedFileSpecial_notRequired(id) {


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

                        if (oFile.size > (6*1024*1024)) // 500Kb for bytes.
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

                        if (oFile.size > (6*1024*1024)) // 500Kb for bytes.
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

                        if (oFile.size > (6*1024*1024)) // 500Kb for bytes.
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
