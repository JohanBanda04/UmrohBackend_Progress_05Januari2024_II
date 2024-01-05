<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
?>
<script type="text/javascript">

    //$(function(){
    //    $('#tempat_lahir').autocomplete({
    //        source:"<?php //echo site_url(); ?>///jamaah/cari_pilihan_nama_kota",
    //        minLength:2,
    //    });
    //});

    $(document).ready(function () {

        $("#tempat_lahir").autocomplete({
            source: function(request, response){
                $.ajax({
                    url: "<?php echo site_url(); ?>/jamaah/cari_pilihan_nama_kota",
                    type: "POST",
                    dataType: "json",
                    data: {
                        nama: request.term
                    },
                    success: function(data){
                        response(data);
                    }
                });
            },
            autofocus: true,
        });


        $("#pilihan_paket").change(function () {
            cari_jenis_paket();
            cari_jenis_pembayaran();
            cari_harga_pembayaran();

        });

        $("#jenis_paket").change(function(){
            cari_jenis_pembayaran();
            cari_harga_pembayaran();
        });

        $("#jenis_pembayaran").change(function () {
           cari_harga_pembayaran();

        });

        

        // $("#jenis_paket").change(function(){
        //     cari_pilihan_dp();
        // });


        
        function cari_harga_pembayaran() {
            var pilihan_paket = $("#pilihan_paket").val();
            var jenis_paket = $("#jenis_paket").val();
            var jenis_pembayaran = $("#jenis_pembayaran").val();

            $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>/jamaah/cari_harga_pembayaran",
                data: "pilihan_paket=" + pilihan_paket+"&jenis_paket="+jenis_paket+"&jenis_pembayaran="+jenis_pembayaran,
                cache: false,
                success: function(data){

                    $('#uang_pembayaran').html(data);
                }
            });

        }

        function cari_jenis_pembayaran(){
            var pilihan_paket = $("#pilihan_paket").val();
            var jenis_paket = $("#jenis_paket").val();
            console.log("pilihan paket :" + pilihan_paket);
            console.log("jenis paket :" + jenis_paket);

            $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>/jamaah/cari_jenis_pembayaran",
                data: "pilihan_paket=" + pilihan_paket+"&jenis_paket="+jenis_paket,
                cache: false,
                success: function(data){
                    console.log(data);
                    $('#jenis_pembayaran').html(data);
                }
            });
        }

        function cari_pilihan_dp(){
            var jenis_paket = $("#jenis_paket").val();
            var pilihan_paket = $("#pilihan_paket").val();
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url(); ?>/jamaah/cari_pilihan_dp",
                data: "jenis_paket=" + jenis_paket+"&pilihan_paket="+pilihan_paket,
                cache: false,
                success: function (data) {
                    console.log(data);
                    $('#uang_muka').html(data);
                },
            });
        }

        function cari_jenis_paket() {
            var pilihan_paket = $("#pilihan_paket").val();
            console.log(pilihan_paket);

            $.ajax({
                type: 'POST',
                url: "<?php echo site_url(); ?>/jamaah/cari_jenis_paket",
                data: "pilihan_paket=" + pilihan_paket,
                cache: false,
                success: function (data) {
                    console.log(data);
                    $('#jenis_paket').html(data);
                },

            });
        }


    });
</script>
<!-- Main content -->
<div class="content-wrapper">
    <!-- Content area -->
    <div class="content">

        <!-- Dashboard content -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                               data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                               data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                               data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                               data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title"><?php echo $judul_web; ?></h4>
                    </div>

                    <div class="panel-body">
                        <?php
                        echo $this->session->flashdata('msg');
                        ?>
                        <form class="form-horizontal" action="" data-parsley-validate="true" method="post"
                              enctype="multipart/form-data">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Nama Jamaah </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="nama_jamaah"
                                               id="nama_jamaah" class="form-control"
                                               value="" placeholder="Nama Jamaah"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Tempat Lahir</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="tempat_lahir" autocomplete="off"
                                               id="tempat_lahir" class="form-control"
                                               value="" placeholder="Tempat Lahir"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Tanggal Lahir</label>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <input type="date" id="tgl_lahir" name="tgl_lahir"
                                                   class="form-control daterange-single" value="" maxlength="10"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Usia</label>
                                    <div class="col-lg-9">
                                        <input type="number" name="usia"
                                               id="usia" class="form-control"
                                               value="" placeholder="Usia (tahun)"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">No. Paspor</label>
                                    <div class="col-lg-9">
                                        <input onkeyup="this.value = this.value.toUpperCase();" type="text"
                                               name="no_paspor"
                                               id="no_paspor" class="form-control"
                                               value="" placeholder="No Paspor"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Tgl Paspor Diterbitkan</label>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <input type="date" id="tgl_paspor_publish" name="tgl_paspor_publish"
                                                   class="form-control daterange-single" value="" maxlength="10"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Masa Berlaku Paspor (sampai dengan)</label>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <input type="date" id="tgl_paspor_expired" name="tgl_paspor_expired"
                                                   class="form-control daterange-single" value="" maxlength="10"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Tempat Paspor Diterbitkan</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="tempat_paspor_publish"
                                               id="tempat_paspor_publish" class="form-control"
                                               value="" placeholder="Tempat Paspor Terbit"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Alamat Lengkap</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="alamat_lengkap"
                                               id="alamat_lengkap" class="form-control"
                                               value="" placeholder="Alamat Lengkap"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Jenis Kelamin</label>
                                    <div class="col-lg-9">
                                        <select class="form-control default-select2"
                                                name="jenis_kelamin" id="jenis_kelamin" required
                                                autofocus onfocus="this.value = this.value;">
                                            <option style="text-align: center"
                                                    value="" <?php if ('semua' == $link5) { ?> selected <?php } ?> >
                                                -Jenis Kelamin-
                                            </option>
                                            <option style="text-align: center"
                                                    value="L" <?php if ('direktur_m' == $link5) {
                                                echo "selected";
                                            } ?> >Laki-laki
                                            </option>
                                            <option style="text-align: center"
                                                    value="P" <?php if ('manajer_m' == $link5) {
                                                echo "selected";
                                            } ?> >Perempuan
                                            </option>

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">No. Telpon (Whatssap)</label>
                                    <div class="col-lg-9">
                                        <input type="number" name="no_telp"
                                               id="no_telp" class="form-control"
                                               value="" placeholder="No telpon (Whatssap)"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Pekerjaan</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="pekerjaan"
                                               id="pekerjaan" class="form-control"
                                               value="" placeholder="Pekerjaan"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Agen Pemilik Jamaah</label>
                                    <div class="col-lg-9">
                                        <select class="form-control default-select2"
                                                name="agen_pemilik_id" id="agen_pemilik_id"  required>
                                            <option value="">- Pilih Agen -</option>
                                            <?php


                                            foreach ($nama_agen_all as $index=>$agen ){
                                                if($agen->nama_agen!="Administrator" ){
                                                    ?>
                                                    <option value="<?= $agen->id_agen;?>">
                                                        <?php echo $agen->nama_agen." ";?> (<?= $agen->nama_role_agen_lengkap?>)
                                                    </option>
                                                    <?php

                                                }
                                                ?>

                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">


                                <div class="form-group">
                                    <label class="control-label col-lg-3">Nama Mahram</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="nama_mahram"
                                               id="nama_mahram" class="form-control"
                                               value="" placeholder="Nama Mahram"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Hubungan Mahram</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="hub_mahram"
                                               id="hub_mahram" class="form-control"
                                               value="" placeholder="Hubungan Mahram"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Rencana Umroh / Haji</label>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <input type="date" id="tgl_rencana_umroh_or_haji"
                                                   name="tgl_rencana_umroh_or_haji"
                                                   class="form-control daterange-single" value="" maxlength="10"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Pernah Umroh / Haji</label>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <input type="date" id="pernah_umroh_or_haji" name="pernah_umroh_or_haji"
                                                   class="form-control daterange-single" value="" maxlength="10"
                                                   >
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-lg-3">Menggunakan Kursi Roda</label>
                                    <div class="col-lg-9">
                                        <select class="form-control default-select2"
                                                name="kursi_roda" id="kursi_roda" required>
                                            <option style="text-align: center"
                                                    value="" <?php if ('semua' == $link5) { ?> selected <?php } ?> >
                                                -Kursi Roda-
                                            </option>
                                            <option style="text-align: center" value="Y" <?php if ('ya' == $link5) {
                                                echo "selected";
                                            } ?> >Ya
                                            </option>
                                            <option style="text-align: center" value="T" <?php if ('tidak' == $link5) {
                                                echo "selected";
                                            } ?> >Tidak
                                            </option>

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Embarkasi</label>
                                    <div class="col-lg-9">
                                        <select class="form-control default-select2"
                                                name="embarkasi" id="embarkasi" required>
                                            <option style="text-align: center"
                                                    value="" <?php if ('semua' == $link5) { ?> selected <?php } ?> >
                                                -Pilih Embarkasi-
                                            </option>


                                            <?php
                                            /*cara get semua records di database*/
                                            //                                $data_zonaAll = $this->db->get("tbl_zona");
                                            $data_embarkasi_all = $this->db->get("tbl_embarkasi");
                                            // echo "<pre>"; print_r($data_zonaAll);
                                            foreach ($data_embarkasi_all->result() as $index => $embarkasi) {
                                                ?>
                                                <option value="<?= $embarkasi->id_embarkasi ?>"><?= $embarkasi->nama_embarkasi ?></option>

                                                <?php
                                            }
                                            ?>

                                        </select>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-lg-3">Pilihan Paket</label>
                                    <div class="col-lg-9">
                                        <select class="form-control default-select2"
                                                name="pilihan_paket" id="pilihan_paket" required>
                                            <option style="text-align: center"
                                                    value="" <?php if ('semua' == $link5) { ?> selected <?php } ?> >
                                                -Pilihan Paket-
                                            </option>
                                            <option style="text-align: center"
                                                    value="paket_haji" <?php if ('paket_haji' == $link5) { ?> selected <?php } ?> >
                                                Paket Haji
                                            </option>
                                            <option style="text-align: center"
                                                    value="paket_umroh" <?php if ('paket_umroh' == $link5) { ?> selected <?php } ?> >
                                                Paket Umroh
                                            </option>


                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Jenis Paket</label>

                                    <div class="col-lg-9">
                                        <select name="jenis_paket" id="jenis_paket"
                                                class="form-control default-select2" required>
                                            <option value="" selected="selected">-Jenis Paket-</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Pilih Metode Pembayaran</label>

                                    <div class="col-lg-9">
                                        <select name="jenis_pembayaran" id="jenis_pembayaran"
                                                class="form-control default-select2" required>
                                            <option value="" selected="selected">-Pilih Jenis Pembayaran-</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Uang Pembayaran</label>
                                    <div class="col-lg-9">

                                        <select name="uang_pembayaran" id="uang_pembayaran"
                                                class="form-control default-select2" required>
                                            <option value="" selected="selected">-Uang Pembayaran-</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Lampiran Bukti Transfer Jamaah</label>
                                    <div class="col-lg-9">
                                        <input id="lamp_bukti_tf_jamaah"
                                               type="file"
                                               onchange="checkSelectedFile(id)"
                                               name="lamp_bukti_tf_jamaah" class="form-control" required>
                                        <small class="lh-1" style="color: red"><i>.jpeg .jpg .png (*wajib)</i></small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Tanggal Berangkat</label>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <input type="date" id="tgl_berangkat" name="tgl_berangkat"
                                                   class="form-control daterange-single" value="" maxlength="10"
                                                   required>
                                        </div>
                                    </div>
                                </div>


                            </div>


                            <hr>

                            <button type="submit" name="btnsimpan_jamaah" class="btn btn-primary" style="float:right;">Simpan
                            </button>
                            <a style="background-color: #a89292;float: right; margin-right:10px "
                               href="<?php echo $link1; ?>/<?php echo $link2; ?>/aksi/id/<?= hashids_encrypt($this->session->userdata('id_user'));?>" class="btn btn-default"><<
                                Kembali
                            </a>
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

                    if(extension != 'jpeg' && extension != 'jpg' && extension!='png'){
                        alert("ekstensi file harus JPEG, JPG, atau PNG");

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
