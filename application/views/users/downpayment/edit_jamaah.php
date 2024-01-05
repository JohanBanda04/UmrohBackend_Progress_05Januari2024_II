<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#pilihan_paket_edit").change(function () {
            cari_jenis_paket_edit();
            cari_pilihan_dp_edit();
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

        $("#jenis_paket_edit").change(function(){
            cari_pilihan_dp_edit();
        });
        
        function cari_pilihan_dp_edit() {
            var jenis_paket_edit = $("#jenis_paket_edit").val();
            var pilihan_paket_edit = $("#pilihan_paket_edit").val();

            $.ajax({
                type: 'POST',
                url: "<?php echo site_url();?>/jamaah/cari_pilihan_dp_edit",
                data: "jenis_paket_edit=" + jenis_paket_edit+"&pilihan_paket_edit="+pilihan_paket_edit,
                cache: false,
                success: function (data) {
                    console.log(data);
                    $('#uang_muka_edit').html(data);
                },
            });
        }

        function cari_jenis_paket_edit() {
            // console.log("tes");
            // $('#uang_muka_edit').val("");
            var pilihan_paket_edit = $("#pilihan_paket_edit").val();
            // console.log(pilihan_paket);

            $.ajax({
                type: 'POST',
                url: "<?php echo site_url();?>/jamaah/cari_jenis_paket_edit",
                data: "pilihan_paket_edit=" + pilihan_paket_edit,
                cache: false,
                success: function (data) {
                    console.log(data);
                    $('#jenis_paket_edit').html(data);
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
                                    <label class="control-label col-lg-3">Nama Jamaah</label>
                                    <div class="col-lg-9">
                                        <input type="hidden" name="id_jamaah_edit"
                                               id="id_jamaah_edit" class="form-control"
                                               value="<?php echo $query->id_jamaah; ?>" placeholder="id_jamaah_edit"
                                               >

                                        <input type="text" name="nama_jamaah_edit"
                                               id="nama_jamaah_edit" class="form-control"
                                               value="<?php echo $query->nama_jamaah; ?>" placeholder="Nama Jamaah"
                                               required autofocus onfocus="this.value = this.value;">
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
                                            <input type="date" id="tgl_lahir_edit" name="tgl_lahir_edit"
                                                   class="form-control daterange-single"
                                                   value="<?php echo $tgl_lahir[0]; ?>" maxlength="10"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Usia (tahun)</label>
                                    <div class="col-lg-9">
                                        <input type="number" name="usia_edit"
                                               id="usia_edit" class="form-control"
                                               value="<?php echo $query->usia; ?>" placeholder="Usia (tahun)"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">No. Paspor</label>
                                    <div class="col-lg-9">
                                        <input onkeyup="this.value = this.value.toUpperCase();" type="text"
                                               name="no_paspor_edit"
                                               id="no_paspor_edit" class="form-control"
                                               value="<?php echo $query->no_paspor; ?>" placeholder="No Paspor"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Tgl Paspor Diterbitkan</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $tgl_paspor_publish = explode(" ", $query->tgl_paspor_publish);
                                        ?>
                                        <div class="input-group">
                                            <input type="date" id="tgl_paspor_publish_edit"
                                                   name="tgl_paspor_publish_edit"
                                                   class="form-control daterange-single"
                                                   value="<?php echo $tgl_paspor_publish[0]; ?>" maxlength="10"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Masa Berlaku Paspor (sampai dengan)</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $tgl_paspor_expired = explode(" ", $query->masa_berlaku_paspor);
                                        ?>
                                        <div class="input-group">
                                            <input type="date" id="tgl_paspor_expired_edit"
                                                   name="tgl_paspor_expired_edit"
                                                   class="form-control daterange-single"
                                                   value="<?php echo $tgl_paspor_expired[0]; ?>" maxlength="10"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Tempat Paspor Diterbitkan</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="tempat_paspor_publish_edit"
                                               id="tempat_paspor_publish_edit" class="form-control"
                                               value="<?php echo $query->tempat_paspor_publish; ?>"
                                               placeholder="Tempat Paspor Terbit"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Alamat Lengkap</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="alamat_lengkap_edit"
                                               id="alamat_lengkap_edit" class="form-control"
                                               value="<?php echo $query->alamat_lengkap; ?>"
                                               placeholder="Alamat Lengkap"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Jenis Kelamin</label>
                                    <div class="col-lg-9">
                                        <select class="form-control default-select2"
                                                name="jenis_kelamin_edit" id="jenis_kelamin_edit" required
                                                autofocus onfocus="this.value = this.value;">
                                            <option style="text-align: center"
                                                    value="" <?php if ('semua' == $link5) { ?> selected <?php } ?> >
                                                -Jenis Kelamin-
                                            </option>
                                            <option style="text-align: center"
                                                    value="L" <?php if ('L' == $query->jenis_kelamin) {
                                                echo "selected";
                                            } ?> >Laki-laki
                                            </option>
                                            <option style="text-align: center"
                                                    value="P" <?php if ('P' == $query->jenis_kelamin) {
                                                echo "selected";
                                            } ?> >Perempuan
                                            </option>

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">No. Telpon (Whatssap)</label>
                                    <div class="col-lg-9">
                                        <input type="number" name="no_telp_edit"
                                               id="no_telp_edit" class="form-control"
                                               value="<?php echo $query->no_telp_wa; ?>"
                                               placeholder="No telpon (Whatssap)"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Pekerjaan</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="pekerjaan_edit"
                                               id="pekerjaan_edit" class="form-control"
                                               value="<?php echo $query->pekerjaan; ?>" placeholder="Pekerjaan"
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
                                                if($agen->nama_agen!="Administrator"){
                                                    ?>
                                                    <option <?php if($query->agen_pemilik_id==$agen->id_agen){
                                                        ?> selected <?php
                                                    } ?>
                                                            value="<?= $agen->id_agen;?>">
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
                                        <input type="text" name="nama_mahram_edit"
                                               id="nama_mahram_edit" class="form-control"
                                               value="<?php echo $query->nama_mahram; ?>" placeholder="Nama Mahram"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Hubungan Mahram</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="hub_mahram_edit"
                                               id="hub_mahram_edit" class="form-control"
                                               value="<?php echo $query->hub_mahram; ?>" placeholder="Hubungan Mahram"
                                               required autofocus onfocus="this.value = this.value;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Rencana Umroh / Haji</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $rencana_umroh_or_haji = explode(" ", $query->rencana_umroh_or_haji);
                                        ?>
                                        <div class="input-group">
                                            <input type="date" id="tgl_rencana_umroh_or_haji_edit"
                                                   name="tgl_rencana_umroh_or_haji_edit"
                                                   class="form-control daterange-single"
                                                   value="<?php echo $rencana_umroh_or_haji[0]; ?>" maxlength="10"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Pernah Umroh / Haji</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $pernah_umroh_or_haji_thn = explode(" ", $query->pernah_umroh_or_haji_thn);
                                        ?>
                                        <div class="input-group">
                                            <input type="date" id="pernah_umroh_or_haji_edit"
                                                   name="pernah_umroh_or_haji_edit"
                                                   class="form-control daterange-single"
                                                   value="<?php echo $pernah_umroh_or_haji_thn[0]; ?>" maxlength="10"
                                                   required>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-lg-3">Menggunakan Kursi Roda</label>
                                    <div class="col-lg-9">
                                        <select class="form-control default-select2"
                                                name="kursi_roda_edit" id="kursi_roda_edit" required>
                                            <option style="text-align: center"
                                                    value="" <?php if ('semua' == $link5) { ?> selected <?php } ?> >
                                                -Kursi Roda-
                                            </option>
                                            <option style="text-align: center"
                                                    value="Y" <?php if ('Y' == $query->kursi_roda) {
                                                echo "selected";
                                            } ?> >Ya
                                            </option>
                                            <option style="text-align: center"
                                                    value="T" <?php if ('T' == $query->kursi_roda) {
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
                                                name="embarkasi_edit" id="embarkasi_edit" required>
                                            <option style="text-align: center"
                                                    value="" <?php if ('semua' == $link5) { ?> selected <?php } ?> >
                                                -Pilih Embarkasi-
                                            </option>


                                            <?php
                                            //$data_zonaAll = $this->db->get("tbl_zona");
                                            $data_embarkasi_all = $this->db->get("tbl_embarkasi");
                                            // echo "<pre>"; print_r($data_zonaAll);
                                            foreach ($data_embarkasi_all->result() as $index => $embarkasi) {
                                                ?>
                                                <option value="<?= $embarkasi->id_embarkasi ?>"
                                                    <?php if ($embarkasi->id_embarkasi == $query->embarkasi) { ?>
                                                        selected
                                                    <?php } ?> ><?= $embarkasi->nama_embarkasi ?></option>

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
                                                    value="paket_haji" <?php if ($query->paket_haji_id != "") { ?>
                                                selected
                                            <?php } ?> >
                                                Paket Haji
                                            </option>
                                            <option style="text-align: center"
                                                    value="paket_umroh" <?php if ($query->paket_umroh_id != "") { ?>
                                                selected
                                            <?php } ?> >
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
                                            <option value="">-Jenis Paket-</option>
                                            <?php
                                            $pilihan_paket = "";
                                            $id_paket = "";
                                            if ($query->paket_haji_id != "") {
                                                $pilihan_paket = "paket_haji";
                                                $id_paket = $query->paket_haji_id;
                                                $dt_dp = $query->uang_muka;

                                                $data_paket = $this->db->get("tbl_paket_haji");
                                                foreach ($data_paket->result() as $index => $data) { ?>
                                                    <option value="<?= $data->id_paket_haji; ?>" <?php if ($data->id_paket_haji == $query->paket_haji_id) {
                                                        echo "selected";
                                                    } ?> ><?php echo $data->nama_paket_haji; ?></option>
                                                <?php }
                                                ?>

                                                <?php
                                            } else if ($query->paket_umroh_id != "") {
                                                $pilihan_paket = "paket_umroh";
                                                $id_paket = $query->paket_umroh_id;
                                                $dt_dp = $query->uang_muka;
                                                $data_paket = $this->db->get("tbl_paket_umroh");
                                                foreach ($data_paket->result() as $index => $data) {
                                                    ?>
                                                    <option value="<?= $data->id_paket_umroh; ?>" <?php if ($data->id_paket_umroh == $query->paket_umroh_id) {
                                                        echo "selected";
                                                    } ?> >
                                                        <?php echo $data->nama_paket_umroh; ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>

                                    </div>


                                </div>

                                <!--METODE PEMBAYARAN-->

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Pilih Metode Pembayaran</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $id_paket_haji = "";
                                        ?>
                                        <select name="jenis_pembayaran" id="jenis_pembayaran"
                                                class="form-control default-select2" required>

                                            <option value="">-Pilih Jenis Pembayaran-</option>

                                            <?php
                                            if($query->paket_haji_id!=""){
                                                $pilihan_paket="paket_haji";
                                                $get_dt_pk_haji = $this->db->get("tbl_paket_haji");
                                                ?>
                                                <option <?php if($query->status_pembayaran=="bayar_dp_haji"){ echo "selected"; }?> value="bayar_dp_haji">
                                                    Pembayaran DP Haji
                                                </option>
                                                <option <?php if($query->status_pembayaran=="bayar_lunas_haji"){ echo "selected"; }?> value="bayar_lunas_haji">
                                                    Pelunasan Langsung Haji
                                                </option>
                                                <?php
                                            } else if($query->paket_umroh_id!="") {
                                                $pilihan_paket="paket_umroh";
                                                $get_dt_pk_haji = $this->db->get("tbl_paket_haji");
                                                ?>
                                                <option <?php if($query->status_pembayaran=="bayar_dp_umroh"){ echo "selected"; }?> value="bayar_dp_umroh">
                                                    Pembayaran DP Umroh
                                                </option>
                                                <option <?php if($query->status_pembayaran=="bayar_lunas_umroh"){ echo "selected"; }?> value="bayar_lunas_umroh">
                                                    Pelunasan Langsung Umroh
                                                </option>
                                                <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-lg-3">Uang Pembayaran</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $id_paket_haji = "";
                                        ?>
                                        <select name="uang_pembayaran" id="uang_pembayaran"
                                                class="form-control default-select2" required>

                                            <option value="">-Uang Pembayaran-</option>
                                            <?php
                                            if($query->status_pembayaran!=""){
                                                if($query->status_pembayaran=="bayar_dp_haji"){
                                                    $dt_tbl_paket = $this->db->get_where("tbl_paket_haji",
                                                        array(
                                                                "id_paket_haji"=>$query->paket_haji_id
                                                        )
                                                    )->row();

                                                    $dt_dp = $this->db->get_where("tbl_dp",
                                                        array(
                                                             "id_dp" => $dt_tbl_paket->dp_id,
                                                        )
                                                    );
                                                    foreach ($dt_dp->result() as $id=>$dts){
                                                        ?>
                                                        <option <?php if($query->uang_pembayaran==$dts->harga_dp1){ echo "selected"; }?> value="<?= $dts->harga_dp1;?>">
                                                            Rp <?= number_format($dts->harga_dp1);?>
                                                        </option>
                                                        <option <?php if($query->uang_pembayaran==$dts->harga_dp2){ echo "selected"; }?> value="<?= $dts->harga_dp2;?>">
                                                            Rp <?= number_format($dts->harga_dp2);?>
                                                        </option>
                                                        <?php
                                                    }
                                                } else if($query->status_pembayaran=="bayar_lunas_haji"){
                                                    ?>
                                                    <option <?php if($query->uang_pembayaran){ echo "selected"; }?> value="<?= $query->uang_pembayaran;?>">
                                                        Rp <?= number_format($query->uang_pembayaran);?>
                                                    </option>
                                                    <?php
                                                } else if($query->status_pembayaran=="bayar_dp_umroh"){
                                                    $dt_tbl_paket = $this->db->get_where("tbl_paket_umroh",
                                                        array(
                                                            "id_paket_umroh"=>$query->paket_umroh_id
                                                        )
                                                    )->row();

                                                    $dt_dp = $this->db->get_where("tbl_dp",
                                                        array(
                                                            "id_dp" => $dt_tbl_paket->dp_id,
                                                        )
                                                    );
                                                    foreach ($dt_dp->result() as $id=>$dts){
                                                        ?>
                                                        <option <?php if($query->uang_pembayaran==$dts->harga_dp1){ echo "selected"; }?> value="<?= $dts->harga_dp1;?>">
                                                            Rp <?= number_format($dts->harga_dp1);?>
                                                        </option>
                                                        <option <?php if($query->uang_pembayaran==$dts->harga_dp2){ echo "selected"; }?> value="<?= $dts->harga_dp2;?>">
                                                            Rp <?= number_format($dts->harga_dp2);?>
                                                        </option>
                                                        <?php
                                                    }
                                                } else if($query->status_pembayaran=="bayar_lunas_umroh"){
                                                    ?>
                                                    <option <?php if($query->uang_pembayaran){ echo "selected"; }?> value="<?= $query->uang_pembayaran;?>">
                                                        Rp <?= number_format($query->uang_pembayaran);?>
                                                    </option>
                                                    <?php
                                                }



                                            } else if($query->status_pembayaran==""){

                                            }



                                            ?>


                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Lampiran Bukti Transfer Jamaah</label>
                                    <div class="col-lg-9">
                                        <input id="lamp_bukti_tf_jamaah_edit"
                                               type="file"
                                               onchange="checkSelectedFile(id)"
                                               name="lamp_bukti_tf_jamaah_edit" class="form-control"
                                             >
                                        <small class="lh-1" style="color: red"><i>.jpeg .jpg .png (*wajib)</i></small>
                                    </div>
                                </div>

                                <div class="">


                                    <li class="col-lg-12" style="display: flex ; background-color:  "
                                        id="">
                                        <div class="form-group col-lg-12 m-b-1"
                                             style="justify-content: space-between; overflow: auto; margin-left: 100px;">
                                            <?php if($query->lamp_bukti_tf_jamaah!=""){ ?>
                                                <a style="text-decoration: none; overflow: hidden" href="<?php echo base_url($query->lamp_bukti_tf_jamaah);?>" target="_blank">
                                                    <!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                                    <?= explode('/',$query->lamp_bukti_tf_jamaah)[2];?>

                                                </a>
                                                <?php

                                            } else {
                                                ?>
                                                <span style="color: #0000AA">
                                                    -Belum Ada Bukti Transfer Jamaah-
                                                </span>
                                                <?php
                                            }?>


                                        </div>
                                    </li>


                                </div>

                                <div style="height: 50px">

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-3">Tanggal Berangkat</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $tgl_brgkt = explode(" ", $query->tgl_berangkat);
                                        ?>
                                        <div class="input-group">
                                            <input type="date" id="tgl_berangkat_edit" name="tgl_berangkat_edit"
                                                   class="form-control daterange-single"
                                                   value="<?php echo $tgl_brgkt[0] ?>" maxlength="10"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <hr>

                            <button type="submit" name="btnupdate_jamaah" class="btn btn-primary" style="float:right;">
                                Simpan
                            </button>
                            <a style="background-color: #a89292;float: right; margin-right:10px "
                               href="<?php echo $link1; ?>/<?php echo $link2; ?>/aksi/id/<?= hashids_encrypt($this->session->userdata('id_user'))?>" class="btn btn-default"><<
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
