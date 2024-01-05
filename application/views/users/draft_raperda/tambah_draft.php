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

                  <h4>Informasi Draft Raperda</h4>
                    <div class="form-group">
                      <label class="col-lg-12">Judull <b id='wajib_isi'>*</b></label>
                      <div class="col-lg-12">
                        <input type="text" name="nama_draft" class="form-control" value="" placeholder="Nama.." required>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-11">Jenis<b id='wajib_isi'>*</b></label>
                        <div class="col-lg-12">
                            <select class="form-control default-select2" name="jenis_dokumen" selected="<?php echo $query->level; ?>" required>
                                <option value="">- Pilih Jenis Raperdaa-</option>
                                <option value="raperda">Raperda</option>
                                <option value="raperkada">Raperkada</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                      <label class="col-lg-12">Surat Permohonan</label>
                      <div class="col-lg-12">
                        <input id="lamp_surat_permohonan"
                               type="file"
                               onchange="checkSelectedFile(id)"
                               name="lamp_surat_permohonan" class="form-control">
                          <small class="lh-1" style="color: red"><i>.pdf .doc .docx (*wajib)</i></small>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12">Draft Harmonisasi</label>
                        <div class="col-lg-12">
                            <input id="draft_harmonisasi"
                                   type="file"
                                   onchange="checkSelectedFileDocOnly(id)"
                                   name="draft_harmonisasi" class="form-control text-field" >
                            <small class="lh-1" style="color: red"><i>.doc .docx (*wajib)</i></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12">Surat Naskah Akademik/Penjelasan/Keterangan</label>
                        <div class="col-lg-12">
                            <input id="naskah_akademik_dll"
                                   type="file"
                                   onchange="checkSelectedFileOptional(id)"
                                   name="naskah_akademik_dll" class="form-control text-field" >
                            <small class="lh-1" style="color: red"><i>.pdf .doc .docx (*opsional)</i></small>
                        </div>
                    </div>


                    <div class="form-group" style="background-color: ">
                        <!--                        <label class="fw-500">Upload File SK / SP / Nodin / Undangan / Paparan / data pendukung lainnya</label>-->
                        <label class="col-lg-12 " style="background-color:  ">Dokumen Tambahan</label>
                        <br>
                        <button class="btn btn-success m-l-15" id="add-more" type="button"
                                style="background-color: ">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Dokumen
                        </button>
                        <small class="lh-1" style="color: red"><i>.pdf .doc .docx (*opsional)</i></small>

                        <div id="auth-rows"></div>
                    </div>



                    <div class="form-group " style="margin-left: 2pt" >
                        <div class="g-recaptcha" data-sitekey="6LdJ0pAmAAAAAI7vU7S3seu7_Wt9AnJCINpeceU_"
                             style="width: 40px">

                        </div>
                    </div>


                  <hr>



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
    <!-- /dashboard content -->
      <script type="text/javascript">
          $( document ).ready(function() {
              console.log( "ready!" );

              $('#lamp_surat_permohonan').prop('required', true);
              $('#naskah_akademik_dll').prop('required', false);
              $('#draft_harmonisasi').prop('required', true);

          });
          // $('.clockpicker').clockpicker();

          function checkSelectedFileOptional(id) {


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

          function checkSelectedFileDocOnly(id) {


              fileName = document.querySelector('#' + id).value;
              extension = fileName.split('.').pop();


              if( document.getElementById(id).files.length == 0 ){
                  console.log("no files selected");
                  $('#'+id).prop('required', true);
                  // $('.text-field').prop('required',true);
              } else {
                  console.log("there are files selected");
                  // $('#'+id).prop('required',false);

                  if(extension == 'doc' || extension=='docx'){

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


                  } else {
                      alert("ekstensi file harus DOC, atau DOCX");

                      document.querySelector('#' + id).value = '';
                      $('#'+id).prop('required',true);
                  }



              }

          }


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

                      if (oFile.size > (5*(1024*1024))) // 500Kb for bytes.
                      {
                          alert("size file terlalu besar");

                          document.querySelector('#' + id).value = '';
                          $('#'+id).prop('required',true);
                      }
                  }



              }

          }

          //cara cek file extension dari zanul
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

          var counter = 0;

          $("#add-more").click(function(e){
              var html3 = '<div class="form-group input-dinamis m-20"><div class="row">' +
                  '<div class="col-input-dinamis col-lg-10">' +
                  '<input type="file" name="url_files[]" class="form-control border-grey" ' +
                  'id="peserta'+counter+'" onchange="checkSelectedFile(id)" ' +
                  'placeholder="Upload file" required>' +
                  '</div>' +
                  '<div class="col-input-dinamis col-lg-2">' +
                  '<button class="btn btn-danger remove" type="button"><i class="fa fa-minus-circle"></i><' +
                  '/button>' +
                  '</div>' +
                  '</div>' +
                  '</div>';


              $('#auth-rows').append(html3);
              counter++;
          });

          // $("#add-more").click(function(e){
          //
          //     var html3 = '<div class="form-group input-dinamis m-20">' +
          //         '<div class="row">' +
          //         '<div class="col-input-dinamis col-lg-10 ">' +
          //         '<input type="file" name="url_files[]" class="form-control border-grey" id="peserta" placeholder="Upload file" required>' +
          //         '</div>' +
          //         '<div class="col-input-dinamis col-lg-2"><button class="btn btn-danger remove" type="button">' +
          //         '<i class="fa fa-minus-circle">' +
          //         '</i></button>' +
          //         '</div>' +
          //         '</div>' +
          //         '</div>';
          //
          //     $('#auth-rows').append(html3);
          // });

          $('#auth-rows').on('click', '.remove', function(e){
              e.preventDefault();
              $(this).parents('.input-dinamis').remove();
          });

          $(document).on('click', '#btnsimpan', function() {
              var response = grecaptcha.getResponse();
              if (response.length == 0) {
                  alert("Please verify you are not a robot.");
                  return false;
              }
          });



          $('#auth-rows').on('click', '.remove', function(e){
              e.preventDefault();
              $(this).parents('.input-dinamis').remove();
          });



      </script>
