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
                ?>
                <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                  <style>
                    #wajib_isi{color:red;}
                  </style>

                  <h4>Informasi Raperda</h4>
                    <div class="form-group">
                      <label class="col-lg-12">Judul <b id='wajib_isi'>*</b></label>
                      <div class="col-lg-12">
                        <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control"
                               value="" placeholder="Nama Kegiatan.." required>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12">Jenis<b id='wajib_isi'>*</b></label>
                        <div class="col-lg-12">
                            <select class="form-control default-select2" name="jenis_dokumen" selected="<?php echo $query->level; ?>" required>
                                <option value="">- Pilih Jenis Raperda-</option>
                                <option value="raperda">Raperda</option>
                                <option value="raperkada">Raperkada</option>
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
                            <select class="form-control default-select2" name="zona_dokumen" selected="<?php echo $query->level; ?>" required>
                                <option value="">- Pilih -</option>
                                <option value="pemprov_ntb">Pemprov NTB</option>
                                <option value="pemkot_mataram">Pemkot Mataram</option>
                                <option value="pemkot_bima">Pemkot Bima</option>
                                <option value="pemkab_sumbawa_barat">Pemkab Sumbawa Barat</option>
                                <option value="pemkab_sumbawa">Pemkab Sumbawa</option>
                                <option value="pemkab_lombok_utara">Pemkab Lombok Utara</option>
                                <option value="pemkab_lombok_timur">Pemkab Lombok Timur</option>
                                <option value="pemkab_lombok_tengah">Pemkab Lombok Tengah</option>
                                <option value="pemkab_lombok_barat">Pemkab Lombok Barat</option>
                                <option value="pemkab_dompu">Pemkab Dompu</option>
                                <option value="pemkab_bima">Pemkab Bima</option>
                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                      <label class="col-lg-12">Dokumen Hasil Harmonisasic</label>
                      <div class="col-lg-12">
                        <input id="lamp_surat_undangan" onchange="checkSelectedFile(id)"
                               type="file" name="lamp_surat_undangan" class="form-control" >
                          <small class="lh-1" style="color: red"><i>.pdf .doc .docx</i></small>
                      </div>
                    </div>

                  <hr>

                    <div class="form-group " style="margin-left: 5px" >
                        <div class="g-recaptcha" data-sitekey="6LdJ0pAmAAAAAI7vU7S3seu7_Wt9AnJCINpeceU_"
                             style="width: 40px">

                        </div>
                    </div>



                  <!--<a href="<?php /*echo strtolower($this->uri->segment(1)); */?>/<?php /*echo strtolower($this->uri->segment(2)); */?>.html"
                     class="btn btn-default">
                      << Kembali
                  </a>-->
<!--                  <button type="submit" name="btnsimpan" class="btn btn-primary" style="float:right;">Kirim</button>-->
                    <input style="float:right;" type="submit" id="btnsimpan" name="btnsimpan" class="btn btn-primary" value="Simpan" />
                </form>
            </div>

        </div>
      </div>
    </div>
      <script type="text/javascript">

          $( document ).ready(function() {
              console.log( "ready!" );

              $('#lamp_surat_undangan').prop('required', true);

          });

          $(document).on('click', '#btnsimpan', function() {
              var response = grecaptcha.getResponse();
              if (response.length == 0) {
                  alert("Please verify you are not a robot.");
                  return false;
              }
          });

          function checkSelectedFile(id) {


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

          //nah disini cara validasi ekstensi file uploadan
          function checkFileExtension(id) {
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
