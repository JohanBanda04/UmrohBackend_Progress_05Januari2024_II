<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
$link6 = ($this->uri->segment(6));
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


        // $("#pilihan_paket").change(function () {
        //     cari_jenis_paket();
        //
        // });

        $("#jabatan").change(function(){
            cari_atasan_langsung();
        });

        function cari_atasan_langsung(){
            var pilihan_jabatan = $("#jabatan").val();
            console.log(pilihan_jabatan);

            $.ajax({
                type:'POST',
                url:"<?php echo site_url();?>/agen/cari_atasan_langsung",
                data: "pilihan_jabatan=" + pilihan_jabatan,
                cache:  false,
                success:  function(data){
                    console.log(data);
                    $("#sponsor").html(data);
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

        $("#jenis_paket").change(function(){
            cari_pilihan_dp();
        });

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
                        <h4 class="panel-title"><?php echo $judul_web." ".$nama_role_agen_lengkap; ?></h4>
                    </div>

                    <div class="panel-body">
                        <?php
                        echo $this->session->flashdata('msg');
                        ?>
                        <form class="form-horizontal" action="" data-parsley-validate="true" method="post"
                              enctype="multipart/form-data">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Nama Agen </label>
                                    <div class="col-lg-9">
                                        <?php
                                        $user_role_agen_id = $this->db->get_where("tbl_agen",
                                            array(
                                                    "id_agen"=>$query->id_agen
                                            ))->row()->role_agen_id;

                                        $get_role_agen_name = $this->db->get_where("tbl_role_agen",
                                            array(
                                                    "id_role_agen"=>$user_role_agen_id
                                            ))->row()->nama_role_agen;
                                        ?>
                                        <input type="hidden" name="id_agen_edit"
                                               id="id_agen_edit" class="form-control"
                                               value="<?php echo $query->id_agen; ?>" placeholder="id_agen_edit"
                                        >
                                        <input type="text" name="nama_agen_edit"
                                               id="nama_agen_edit" class="form-control"
                                               value="<?php echo $query->nama_agen;?>" placeholder="Nama Agen"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-lg-3">Username</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="username_agen"
                                               id="username_agen" class="form-control"
                                               value="<?php echo $query->username;?>" placeholder="Username"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Password</label>
                                    <div class="col-lg-9">
                                        <input type="password" name="password_agen"
                                               id="password_agen" class="form-control"
                                               value="<?php echo $query->password;?>" placeholder="Password"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Cabang Agen</label>
                                    <div class="col-lg-9">
                                        <select class="form-control default-select2"
                                                name="cabang_id" id="cabang_id" selected="<?php echo $query->role_agen_id; ?>" required>
                                            <option style="text-align: center"
                                                    value="Pilih Cabang" <?php if('semua'==$link5){ ?> selected <?php }?> >-Pilih Cabang-</option>

                                            <?php
                                            $get_data_cabang = $this->db->get("tbl_cabang");
                                            foreach ($get_data_cabang->result() as $id=>$it){
                                                /*agar nama cabang 'Superadmin' pada tbl_cabang tidak ditampilkan*/
                                                if($it->nama_cabang!="Superadmin"){
                                                    ?>
                                                    <option <?php if($it->id_cabang==$query->cabang_id){
                                                            ?>selected<?php
                                                    }?> style="text-align: center" value="<?= $it->id_cabang?>"><?= $it->nama_cabang; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>


                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Tempat Lahir</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="tempat_lahir_edit" autocomplete="off"
                                               id="tempat_lahir_edit" class="form-control"
                                               value="<?php echo $query->tempat_lahir; ?>" placeholder="Tempat Lahir"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Tanggal Lahir</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $tgl_lahir = explode(" ", $query->tgl_lahir);
                                        ?>
                                        <div class="input-group">
                                            <input type="date" id="tgl_lahir_edit"
                                                   name="tgl_lahir_edit"
                                                   class="form-control daterange-single"
                                                   value="<?php echo $tgl_lahir[0]; ?>" maxlength="10"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Jenis Kelamin</label>
                                    <div class="col-lg-9">
                                        <select class="form-control default-select2"
                                                name="jenis_kelamin_edit" id="jenis_kelamin_edit" required
                                                autofocus onfocus="this.value = this.value;">
                                            <option style="text-align: center"
                                                    value=""  >
                                                -Jenis Kelamin-
                                            </option>
                                            <option style="text-align: center"
                                                    value="L" <?php if($query->jenis_kelamin=="L"){ ?>
                                                selected
                                            <?php } ?> >Laki-laki
                                            </option>
                                            <option style="text-align: center"
                                                    value="P" <?php if($query->jenis_kelamin=="P"){ ?>
                                                selected
                                            <?php }?> >Perempuan
                                            </option>

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">No. KTP</label>
                                    <div class="col-lg-9">
                                        <input onkeyup="this.value = this.value.toUpperCase();" type="number"
                                               name="no_ktp_edit"
                                               id="no_ktp_edit" class="form-control"
                                               value="<?php echo $query->no_ktp; ?>" placeholder="No KTP"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Alamat Lengkap</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="alamat_lengkap_edit"
                                               id="alamat_lengkap_edit" class="form-control"
                                               value="<?php echo $query->alamat_lengkap; ?>" placeholder="Alamat Lengkap"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Kota</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="kota_edit"
                                               id="kota_edit" class="form-control"
                                               value="<?php echo $query->kota; ?>" placeholder="Kota"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Kecamatan</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="kecamatan_edit"
                                               id="kecamatan_edit" class="form-control"
                                               value="<?php echo $query->kecamatan; ?>" placeholder="Kecamatan"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Kelurahan</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="kelurahan_edit"
                                               id="kelurahan_edit" class="form-control"
                                               value="<?php echo $query->kelurahan; ?>" placeholder="Kelurahan"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Provinsi</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="provinsi_edit"
                                               id="provinsi_edit" class="form-control"
                                               value="<?php echo $query->provinsi; ?>" placeholder="Provinsi"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>





                            </div>


                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Kode Pos</label>
                                    <div class="col-lg-9">
                                        <input type="number" name="kode_pos_edit"
                                               id="kode_pos_edit" class="form-control"
                                               value="<?php echo $query->kode_pos; ?>" placeholder="Kode Pos"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Email</label>
                                    <div class="col-lg-9">
                                        <input type="email" name="email_edit"
                                               id="email_edit" class="form-control"
                                               value="<?php echo $query->email??"";?>" placeholder="Email"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">No. Handphone</label>
                                    <div class="col-lg-9">
                                        <input type="number" name="no_hp_edit"
                                               id="no_hp_edit" class="form-control"
                                               value="<?= $query->no_hp; ?>"
                                               placeholder="No. Handphone"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Nama Bank</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="nama_bank_edit"
                                               id="nama_bank_edit" class="form-control"
                                               value="<?= $query->nama_bank; ?>"
                                               placeholder="Nama Bank"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Cabang Bank</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="cabang_bank_edit"
                                               id="cabang_bank_edit" class="form-control"
                                               value="<?= $query->cabang_bank; ?>"
                                               placeholder="Cabang Bank"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">No. Rekening</label>
                                    <div class="col-lg-9">
                                        <input type="number" name="no_rekening_edit"
                                               id="no_rekening_edit" class="form-control"
                                               value="<?= $query->no_rekening; ?>"
                                               placeholder="No. Rekening"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Pemilik Rekening</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="pemilik_rekening_edit"
                                               id="pemilik_rekening_edit" class="form-control"
                                               value="<?= $query->pemilik_rekening; ?>"
                                               placeholder="Pemilik Rekening"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Jabatan </label>
                                    <div class="col-lg-9">
                                        <select class="form-control default-select2"
                                                name="jabatan_edit" id="jabatan_edit" required  >
                                            <option style="text-align: center"
                                                    value="" <?php if ('semua' == $link5) { ?> selected <?php } ?> >
                                                -Pilih Jabatan- <?php
                                                //echo $id_role_agen;
                                                ?>
                                            </option>


                                            <?php
                                            /*cara get semua records di database*/
                                            //                                $data_zonaAll = $this->db->get("tbl_zona");
                                            $data_role_agen_all = $this->db->get("tbl_role_agen");
                                            // echo "<pre>"; print_r($data_zonaAll);
                                            foreach ($data_role_agen_all->result() as $index => $dt_role) {
                                                if($query->jabatan==$dt_role->id_role_agen){?>
                                                    <option value="<?= $dt_role->id_role_agen; ?>"
                                                        <?php if($query->jabatan==$dt_role->id_role_agen){?>
                                                            selected
                                                        <?php } ?> >
                                                        <?= $dt_role->nama_role_agen_lengkap ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>

                                                <?php
                                            }
                                            ?>

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Sponsor</label>
                                    <div class="col-lg-9">
                                        <select class="form-control default-select2"
                                                name="sponsor_edit" id="sponsor_edit" required <?php if($query->sponsor_atasan=="1"){
                                            ?> readonly <?php
                                        }?>>
                                            <?php if($query->sponsor_atasan!="1"){
                                                ?>
                                                <option  style="text-align: center" value="">
                                                    -Pilih Sponsor-
                                                </option>
                                                <?php
                                            }?>



                                            <?php
                                            if($query->sponsor_atasan!="1"){
                                                foreach ($data_atasan->result() as $id=>$dt_atasan){
                                                    ?>
                                                    <option <?php if($dt_atasan->id_agen==$query->sponsor_atasan){ ?>
                                                        selected <?php } ?>
                                                            value="<?php echo $dt_atasan->id_agen?>">
                                                        <?php echo $dt_atasan->nama_agen; ?>
                                                    </option>
                                                    <?php
                                                }
                                            } else if($query->sponsor_atasan=="1"){
                                                foreach ($data_atasan->result() as $id=>$dt_atasan){
                                                    ?>
                                                    <option <?php if($dt_atasan->id_agen==$query->sponsor_atasan){
                                                            ?>selected<?php
                                                    }?> value="1">
                                                        -Ini Adalah Jabatan Tertinggi-
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </select>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Nama Ahli Waris</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="nama_ahli_waris_edit"
                                               id="nama_ahli_waris_edit" class="form-control"
                                               value="<?= $query->nama_ahli_waris; ?>"
                                               placeholder="Nama Ahli Waris"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Hubungan dgn Ahli Waris</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="hub_dgn_ahli_waris_edit"
                                               id="hub_dgn_ahli_waris_edit" class="form-control"
                                               value="<?= $query->hub_dgn_ahli_waris; ?>"
                                               placeholder="Hubungan dgn Ahli Waris"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">No. Hp Ahli Waris</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="no_hp_ahli_waris_edit"
                                               id="no_hp_ahli_waris_edit" class="form-control"
                                               value="<?= $query->no_hp_ahli_waris; ?>"
                                               placeholder="No. HP Ahli Waris"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>




                                <?php
                                if($get_role_agen_name!="presiden_direktur"){
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">Lampiran TTD</label>
                                        <div class="col-lg-9">
                                            <input id="lamp_ttd_pict"
                                                   type="file"
                                                   onchange="checkSelectedFile(id)"
                                                   name="lamp_ttd_pict" class="form-control"
                                                <?php if($query->lamp_ttd_agen==""){
                                                    echo "required";
                                                }?> >
                                            <small class="lh-1" style="color: red"><i>.jpeg .jpg .png (*wajib)</i></small>
                                        </div>
                                    </div>
                                    <?php

                                }
                                ?>


                                <div class="">


                                    <li class="col-lg-12" style="display: flex ; background-color:  "
                                        id="">
                                        <div class="form-group col-lg-12 m-b-1"
                                             style="justify-content: space-between; overflow: auto; margin-left: 100px;">
                                            <a style="text-decoration: none; overflow: hidden" href="<?php echo base_url($query->lamp_ttd_agen);?>" target="_blank">
                                                <!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                                <?= explode('/',$query->lamp_ttd_agen)[2];?>

                                            </a>

                                        </div>
                                    </li>


                                </div>
                                <div style="height: 50px">

                                </div>


                            </div>


                            <hr>

                            <button type="submit" name="btnupdate_agen" class="btn btn-primary" style="float:right;">Update
                            </button>
                            <a style="background-color: #a89292;float: right; margin-right:10px "
                               href="<?php echo $link1; ?>/v.html" class="btn btn-default"><<
                                Kembali</a>
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
