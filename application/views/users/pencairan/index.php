<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));

?>

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li>
            <a href="dashboard.html">Dashboard</a>
        </li>
        <li class="active"><?php echo $judul_web; ?></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Data
        <small><?php echo $judul_web; ?></small>
    </h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <?php
            echo $this->session->flashdata('msg');
            ?>
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
                <form action="<?php echo $link1; ?>/<?php echo $link2; ?>/periode/id/<?= hashids_encrypt($this->session->userdata('id_user'))?>" class="" method="post">


                    <div style="margin-top: -20px; margin-top: 10px;" class="row justify-content-center p-15">
                        <center>
                            <h5 style="margin-left: 340px" class="font-weight-bold">

                                <div class="col-md-6">
                                    <label class="ml-5 " for="tanggal">Periode Tanggal</label>

                                </div>


                            </h5>

                            <br>


                        </center>

                    </div>
                    <div style="margin-top: -20px;" class="row justify-content-center p-15">
                        <center>
                            <h5 style="margin-left: 340px" class="font-weight-bold">
                                <div class="col-md-3">
                                    <label class="ml-5 " for="tanggal">Tanggal Awal</label>
                                    <div class="input-group">
                                        <div
                                                class="icon-agenda bgc-white bd bdwR-0"
                                        >
                                            <i class="ti-calendar"></i>
                                        </div>
                                        <input
                                                type="text"
                                                class="form-control border-grey start-date"
                                                data-provide="datepicker"

                                                value="<?php if(!$this->session->has_userdata('tgl_awal_choose')){
                                                    echo $date_one_month_ago;
                                                } else if ($this->session->has_userdata('tgl_awal_choose')){
                                                    echo $this->session->userdata('tgl_awal_choose');
                                                }?>"
                                                data-date-format="d-M-yyyy"
                                                name="tgl_awal"
                                                id="tgl_awal"
                                                style="align-items: center"
                                                required
                                        />
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label class="ml-5 " for="tanggal">Tanggal Akhir</label>
                                    <div class="input-group">
                                        <div
                                                class="icon-agenda bgc-white bd bdwR-0"
                                        >
                                            <i class="ti-calendar"></i>
                                        </div>
                                        <!--cara simple set value old_tanggal-->
                                        <input
                                                type="text"
                                                class="form-control border-grey start-date"
                                                data-provide="datepicker"

                                                value="<?php if(!$this->session->has_userdata('tgl_akhir_choose')){
                                                    echo $date_now;
                                                } else if ($this->session->has_userdata('tgl_akhir_choose')){
                                                    echo $this->session->userdata('tgl_akhir_choose');
                                                }?>"
                                                data-date-format="d-M-yyyy"
                                                name="tgl_akhir"
                                                id="tgl_akhir"
                                                required
                                        />
                                    </div>
                                </div>
                            </h5>

                            <br>


                        </center>

                    </div>
                    <div style="margin-top: -20px;" class="row justify-content-center p-15">
                        <center>
                            <h5 style="margin-left: 340px" class="font-weight-bold">
                                <div class="col-md-6">
                                    <div class="row justify-content-center">
                                        <div class="mb-3 mr-3 ml-4">
                                            <button type="submit" class="btn btn-primary">
                                                <span class="bg-float"></span>
                                                <span class="text">Filter</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </h5>

                            <br>


                        </center>

                    </div>

                </form>

                <div class="panel-body">
                    <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/t/<?= hashids_encrypt($this->session->userdata('id_user'))?>" class=" btn btn-primary"><i
                                class="fa fa-plus-circle"></i> Tambah Permintaan <?php echo $judul_web; ?></a>
                    <hr>

                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="1%">No</th>
<!--                                <th>ID Transaksi</th>-->
                                <th>Tanggal Pengajuan Bonus</th>
                                <th>Pengirim</th>
                                <th>Penerima</th>
                                <th>No. Rekening Penerima</th>
                                <th>Status</th>
                                <th>Bank Penerima</th>
                                <th>Nominal Diajukan</th>

                                <th width="15%" style="text-align: center;">Opsi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            foreach ($query->result() as $baris):
                                ?>
                                <tr>
                                    <td><b><?php echo $no++; ?>.</b></td>
<!--                                    <td>--><?php //echo $baris->id_pencairan; ?><!--</td>-->
                                    <?php
                                    $tgl_lahir_pengajuan = explode(' ', $this->Mcrud->tgl_id(date('d-m-Y H:i:s', strtotime($baris->tgl_input)), 'full'));

                                    ?>
                                    <td><?php echo  $tgl_lahir_pengajuan[0] . " " . $tgl_lahir_pengajuan[1] . " " . $tgl_lahir_pengajuan[2]; ?></td>

                                    <td>
                                        <?php
                                        if($baris->pengirim_id==null){
                                            ?>
                                            <label for="label" class="label" style="background-color: red">Belum Ada</label>
                                            <?php
                                        } else if($baris->pengirim_id!=null){
                                            $nama_pengirim = $this->db->get_where("tbl_agen",array("id_agen"=>$baris->pengirim_id))->row()->nama_agen;
                                            ?>
                                            <label for="label" class="label" style="background-color: green"><?= $nama_pengirim?></label>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($baris->penerima_id==null){
                                            ?>
                                            <label for="label" class="label" style="background-color: red">Belum Ada</label>
                                            <?php
                                        } else if($baris->penerima_id!=null){
                                            $nama_penerima = $this->db->get_where("tbl_agen",array("id_agen"=>$baris->penerima_id))->row()->nama_agen;
                                            ?>
                                            <label for="label" class="label" style="background-color: green"><?= $nama_penerima?></label>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $baris->norek_penerima; ?></td>
                                    <td>
                                        <?php
                                            $explode = explode('_',$baris->status);

                                            if($baris->status=="pengajuan_pencairan" or $baris->status=="pencairan_ditolak"){
                                                ?>
                                                <label for="label" class="label" style="background-color: red">
                                                    <?= $explode[0]." ".$explode[1]; ?>
                                                </label>
                                                <?php
                                            } else if($baris->status=="pencairan_disetujui"){
                                                ?>
                                                <label for="label" class="label" style="background-color: green">
                                                    <?= $explode[0]." ".$explode[1]; ?>
                                                </label>
                                                <?php
                                            } else if($baris->status=="sudah_transfer"){
                                                ?>
                                                <label for="label" class="label" style="background-color: purple">
                                                    <?= $explode[0]." ".$explode[1]; ?>
                                                </label>
                                                <?php
                                            }
                                            ?>


                                        <?php
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $nama_bank = $this->db->get_where("tbl_bank",array("id_bank"=>$baris->id_bank_penerima))->row()->nama_bank;
                                        ?>
                                        <label for="label" class="label" style="color: red"><?= $nama_bank?></label>
                                    </td>
                                    <td>Rp <?php echo number_format($baris->jumlah_nominal); ?> </td>

                                    <td align="center">
                                        <!--tidak usah dihiraukan if dan endif nya-->
                                        <?php if ($baris->nama_panjang != 'Superadmin') :
                                            ?>
                                            <a
                                                    href=""
                                                    class="btn btn-info btn-xs"
                                                    data-toggle="modal" title="Lihat Detail"
                                                    data-target="#detail_data_pencairan<?php echo hashids_encrypt($baris->id_pencairan); ?>">
                                                <i class="fa fa-info-circle"></i>
                                            </a>


                                        <?php
                                            if($this->session->userdata('nama_level')=="administrator"){
                                                ?>
                                                <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/e_pencairan/<?php echo hashids_encrypt($baris->id_pencairan); ?>"
                                                   class=" btn btn-success btn-xs"  title="Edit Pencairan?" >
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <?php
                                            } else {
                                                if($baris->status=="pengajuan_pencairan" or $baris->status=="pencairan_ditolak" ){
                                                    ?>
                                                    <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/e_pencairan/<?php echo hashids_encrypt($baris->id_pencairan); ?>"
                                                       class=" btn btn-success btn-xs"  title="Edit Pencairan?" >
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <?php
                                                }
                                            }
                                            ?>



                                        <?php
                                            if($this->session->userdata('nama_level')=="administrator"){
                                                if($baris->status=='pencairan_disetujui'){
                                                    ?>
                                                    <a  href=""
                                                        class="btn btn-warning btn-xs" style="background-color: purple"

                                                        data-toggle="modal" title="Validasi dan Transfer Pencairan Bonus?"
                                                        data-target="#confirm_password_transfer<?php echo hashids_encrypt($baris->id_pencairan); ?>"
                                                    >
                                                        <i class="fa fa-leaf" style="color: white"></i>

                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                                <a  href=""
                                                    class="<?php if($baris->status=='pencairan_disetujui'){ echo "disabled hidden"; } ?> btn btn-warning btn-xs"

                                                    data-toggle="modal" title="Ganti Status"
                                                    data-target="#approval_admin_pencairan<?php echo hashids_encrypt($baris->id_pencairan); ?>"
                                                >
                                                    <i class="fa fa-check-square" style="color: white"></i>

                                                </a>
                                                <?php
                                            }
                                            ?>



                                        <?php
                                            if($baris->status!="sudah_transfer" ){
                                                ?>
                                                <a  href=""
                                                    class="btn btn-xs" style="background-color: red"
                                                    data-toggle="modal" title="Hapus Data Pencairan?"
                                                    data-target="#confirm_password<?php echo hashids_encrypt($baris->id_pencairan); ?>">
                                                    <i class="fa fa-trash" style="color: white"></i>

                                                </a>
                                                <?php
                                            }
                                            ?>



                                            <!--invoice-->
                                            <a target="_blank"
                                               href="<?php echo $link1; ?>/<?php echo $link2; ?>/invoice/<?php echo hashids_encrypt($baris->id_jamaah); ?>"
                                               class="hidden btn btn-primary btn-xs"
                                               title="Cetak Invoice"
                                            ><i class="fa fa-print"></i
                                                >
                                            </a>

                                            <!--                                            <a href="--><?php //echo $link1; ?><!--/--><?php //echo $link2; ?><!--/h/--><?php //echo hashids_encrypt($baris->id_cabang); ?><!--"-->
                                            <!--                                               class="btn btn-danger btn-xs"-->
                                            <!--                                               title="Hapus" onclick="return confirm('Anda yakin?');">-->
                                            <!--                                                <i class="fa fa-trash-o"></i>-->
                                            <!--                                            </a>-->
                                        <?php endif; ?>
                                    </td>

                                </tr>


                                <?php
                                $nama_agen_penerima_bonus = $this->db->get_where("tbl_agen",array("id_agen"=>$baris->penerima_id))->row()->nama_agen;
                                ?>
                                <div class="modal fade" id="approval_admin_pencairan<?php echo hashids_encrypt($baris->id_pencairan); ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="bd p-15"><h5 class="m-0">Ubah Status Pencairan <span style="color: green"><?= $nama_agen_penerima_bonus ?>?</span></h5></div>
                                            <div class="modal-body">
                                                <form method="POST" action="bonus/v/status_app_update" enctype="multipart/form-data">
                                                    <input type="hidden" value="<?php echo hashids_encrypt($baris->id_pencairan); ?>"
                                                           name="id_pencairan" id="id_pencairan"/>




                                                    <div class="form-group">
                                                        <label class="fw-500" for="status">Pilih Status Approval Pencairan</label>
                                                        <select class="form-control border-grey" id="status_app" name="status_app" required autofocus
                                                                onfocus="this.value = this.value;" >
                                                            <option value="">- Pilih -</option>
                                                            <option <?php if ($baris->status=="pengajuan_pencairan") { echo "selected"; } ?> value="pengajuan_pencairan"> Pengajuan Pencairan </option>
                                                            <option <?php if ($baris->status=="pencairan_ditolak") { echo "selected"; } ?> value="pencairan_ditolak">Ditolak / Koreksi</option>
                                                            <option <?php if ($baris->status=="pencairan_disetujui") { echo "selected"; } ?> value="pencairan_disetujui">Setuju</option>
                                                            <option <?php if ($baris->status=="sudah_transfer") { echo "selected"; } ?> value="sudah_transfer">Sudah Transfer</option>

                                                        </select>
                                                    </div>





                                                    <div class="text-right">
                                                        <button
                                                                class="btn btn-secondary cur-p float-left"
                                                                data-dismiss="modal"
                                                                name=""
                                                        >
                                                            Kembali
                                                        </button>

                                                        <button
                                                                class="btn btn-success cur-p"
                                                                name=""
                                                        >
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="wd_admin<?php echo hashids_encrypt($baris->id_pencairan); ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="bd p-15"><h5 class="m-0">Transfer Bonus Ke Agen <span style="color: green"><?= $nama_agen_penerima_bonus ?>?</span></h5></div>
                                            <div class="modal-body">
                                                <form method="POST" action="bonus/v/bonus_confirm" enctype="multipart/form-data">
                                                    <input type="hidden" value="<?php echo hashids_encrypt($baris->id_pencairan); ?>"
                                                           name="id_pencairan" id="id_pencairan"/>
                                                    <div class="form-group">
                                                        <label class="fw-500" for="nama_pencair">Nama Admin</label>
                                                        <input value="<?= $this->session->userdata('id_user')?>" class="form-control border-grey" id="id_admin" name="id_admin"
                                                               required autofocus type="hidden"
                                                                onfocus="this.value = this.value;" />

                                                        <input readonly disabled="disabled" value="<?= $this->session->userdata('nama_lengkap')?>" class="form-control border-grey" id="nama_admin"
                                                               name="nama_admin"  required autofocus
                                                                onfocus="this.value = this.value;" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="fw-500" for="nama_pencair">No. Rekening Pengirim</label>


                                                        <input placeholder="No Rekening Pengirim" value=""
                                                               class="form-control border-grey"
                                                               id="norek_pengirim"
                                                               name="norek_pengirim"
                                                               required autofocus
                                                                onfocus="this.value = this.value;" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="fw-500" for="status">Nama Bank Pengirim</label>
                                                        <select class="form-control border-grey" id="id_bank_pengirim" name="id_bank_pengirim" required autofocus
                                                                onfocus="this.value = this.value;" >
                                                            <option value="">- Pilih -</option>
                                                            <?php
                                                            $get_banks = $this->db->get("tbl_bank")->result();
                                                            foreach ($get_banks as $bank){
                                                                ?>
                                                                <option value="<?= $bank->id_bank?>"><?= $bank->nama_bank?></option>
                                                                <?php
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="fw-500" for="status">Ubah status pencairan bonus?</label>
                                                        <select class="form-control border-grey" id="status" name="status" required autofocus
                                                                onfocus="this.value = this.value;" >
                                                            <option value="">- Pilih -</option>
                                                            <option <?php if ($baris->status=="pengajuan_pencairan") { echo "selected"; } ?> value="pengajuan_pencairan"> Pengajuan Pencairan </option>
                                                            <option <?php if ($baris->status=="pencairan_ditolak") { echo "selected"; } ?> value="pencairan_ditolak">Ditolak / Koreksi</option>
                                                            <option <?php if ($baris->status=="pencairan_disetujui") { echo "selected"; } ?> value="pencairan_disetujui">Setuju</option>

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="fw-500" for="status">Lampiran Bukti Transfer</label>
                                                        <div class="">
                                                            <input id="lamp_bukti_tf_jamaah"
                                                                   type="file"
                                                                   onchange="checkSelectedFile(id)"
                                                                   name="lamp_bukti_tf_jamaah" class="form-control" required>
                                                            <small class="lh-1" style="color: red"><i>.jpeg .jpg .png (*wajib)</i></small>
                                                        </div>
                                                    </div>



                                                    <div class="text-right">
                                                        <button
                                                                class="btn btn-secondary cur-p float-left"
                                                                data-dismiss="modal"
                                                                name=""
                                                        >
                                                            Kembali
                                                        </button>
                                                        <button
                                                                class="btn btn-success cur-p"
                                                                name=""
                                                        >
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="confirm_password_transfer<?php echo hashids_encrypt($baris->id_pencairan); ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="bd p-15"><h5 class="m-0">Validasi Password Pencairan <b><?= $baris->nama_jamaah?></b>?</h5></div>
                                            <div class="modal-body">
                                                <form method="POST" action="bonus/v/confirm_password_transfer" enctype="multipart/form-data">
                                                    <input type="hidden" value="<?php echo hashids_encrypt($baris->id_pencairan); ?>"
                                                           name="id_pencairan_transfer" id="id_pencairan_transfer"/>
                                                    <div class="form-group">
                                                        <label class="fw-500" for="status">Konfirmasi Password Untuk Validasi Pencairan </label>
                                                        <input class="form-control" type="password"
                                                               id="confirm_pass_transfer"
                                                               name="confirm_pass_transfer" value="" placeholder="Password"
                                                               required autofocus onfocus="this.value = this.value;">

                                                    </div>

                                                    <div class="text-right">
                                                        <button
                                                                class="btn btn-secondary cur-p float-left"
                                                                data-dismiss="modal"
                                                                name=""
                                                        >
                                                            Kembali
                                                        </button>
                                                        <button
                                                                class="btn btn-success cur-p"
                                                                name=""
                                                        >
                                                            Konfirmasi
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="confirm_password<?php echo hashids_encrypt($baris->id_pencairan); ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="bd p-15"><h5 class="m-0">Hapus Data Pencairan <b><?= $baris->nama_jamaah?></b>?</h5></div>
                                            <div class="modal-body">
                                                <form method="POST" action="bonus/v/set_app_pencairan" enctype="multipart/form-data">
                                                    <input type="hidden" value="<?php echo hashids_encrypt($baris->id_pencairan); ?>"
                                                           name="id_data_pencairan" id="id_data_pencairan"/>
                                                    <div class="form-group">
                                                        <label class="fw-500" for="status">Konfirmasi Password Untuk Hapus Data Pencairan</label>
                                                        <input class="form-control" type="password"
                                                               id="confirm_pass"
                                                               name="confirm_pass" value="" placeholder="Password"
                                                               required autofocus onfocus="this.value = this.value;">

                                                    </div>

                                                    <div class="text-right">
                                                        <button
                                                                class="btn btn-secondary cur-p float-left"
                                                                data-dismiss="modal"
                                                                name=""
                                                        >
                                                            Kembali
                                                        </button>
                                                        <button
                                                                class="btn btn-success cur-p"
                                                                name=""
                                                        >
                                                            Konfirmasi
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade"
                                     id="delete_confirm<?php echo hashids_encrypt($baris->id_jamaah); ?>">
                                    <div class="modal-dialog" role="document">
                                        <!--                                        --><? //= $zona_document;
                                        ?>
                                        <div class="modal-content">
                                            <div class="bd p-15"><h5 class="m-0">Hapus Data</h5></div>
                                            <div class="modal-body">
                                                <!--                                                <form method="POST" action="pemda/v/h">-->
                                                <!--kunci kesuksesan contoh cara kirim action menuju controller tertentu dengan form-->
                                                <form method="POST"
                                                      action="<?php echo $link1; ?>/<?php echo $link2; ?>/h_jamaah/<?php echo hashids_encrypt($baris->id_jamaah); ?>">
                                                    <input type="hidden" value="<?php echo $baris->id_jamaah; ?>"
                                                           name="id_jamaah"/>
                                                    <div>Apakah Anda yakin akan menghapus data jamaah ini?</div>
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


                                <div class="">
                                    <div class="modal fade "
                                         id="detail_data_pencairan<?php echo hashids_encrypt($baris->id_pencairan); ?>">


                                        <div class="modal-dialog" style="width: 1100px" role="document">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="background-color: #225fd5">
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                            <?php
                                                            $penerima_nama = $this->db->get_where("tbl_agen",array("id_agen"=>$baris->penerima_id))->row()->nama_agen;
                                                            ?>
                                                            <h4 class="modal-title" style="color: white">Detail Data
                                                                Pencairan <span
                                                                        style="color: yellow"><?php echo $penerima_nama ?></span>
                                                            </h4>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="modal-body">
                                                                <div class="form-horizontal">
                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Tgl Pengajuan Bonus</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?php echo  $tgl_lahir_pengajuan[0] . " " . $tgl_lahir_pengajuan[1] . " " . $tgl_lahir_pengajuan[2]; ?></span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->


                                                                    <span style="font-weight: bold; font-size: 15px">Nominal Pengajuan</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">Rp <?php echo number_format($baris->jumlah_nominal); ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>

                                                                    <!---->

                                                                    <span style="font-weight: bold; font-size: 15px">Pengirim</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                                        <?php
                                                                        if($baris->pengirim_id==null){
                                                                            ?>
                                                                            <label for="label" class="label" style="background-color: darkred">
                                                                                Belum Ada Pengirim
                                                                            </label>
                                                                            <?php
                                                                        } else if($baris->pengirim_id!=null){
                                                                            $pengirim_nama = $this->db->get_where("tbl_agen",array("id_agen"=>$baris->pengirim_id))->row()->nama_agen;
                                                                            ?>
                                                                            <label for="label" class="label" style="background-color: darkgreen">
                                                                                <?php echo $pengirim_nama; ?>
                                                                            </label>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Penerima</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                                        <?php
                                                                        if($baris->penerima_id==null){
                                                                            ?>
                                                                            <label for="label" class="label" style="background-color: darkred">
                                                                                Belum Ada Penerima
                                                                            </label>
                                                                            <?php
                                                                        } else if ($baris->penerima_id!=null){
                                                                            ?>
                                                                            <label for="label" class="label" style="background-color: darkgreen">
                                                                                <?= $penerima_nama; ?>
                                                                            </label>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->



                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Status Pencairan</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                                        <?php
                                                                        if($baris->status=="pengajuan_pencairan" || $baris->status=="pencairan_ditolak" ){
                                                                            $explode = explode('_',$baris->status);
                                                                            ?>
                                                                            <label for="label" class="label" style="background-color: darkred">
                                                                                <?php echo $explode[0]." ".$explode[1] ?>
                                                                            </label>
                                                                            <?php
                                                                        } else if ($baris->status=="pencairan_disetujui"){
                                                                            ?>
                                                                            <label for="label" class="label" style="background-color: darkgreen">
                                                                                <?php echo $explode[0]." ".$explode[1] ?>
                                                                            </label>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="modal-body">
                                                                <div class="form-horizontal">


                                                                    <!---->

                                                                    <span style="font-weight: bold; font-size: 15px">Bank Pengirim</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                                    <?php
                                                                    if($baris->id_bank_pengirim==null){
                                                                        ?>
                                                                        <label for="label" class="label" style="background-color: darkred">
                                                                            Belum Ada Bank Pengirim
                                                                        </label>
                                                                        <?php
                                                                    } else if($baris->id_bank_pengirim!=null){
                                                                        $nama_bank_pengirim = $this->db->get_where("tbl_bank",array("id_bank"=>$baris->id_bank_pengirim))->row()->nama_bank;
                                                                        ?>
                                                                        <label for="label" class="label" style="background-color: darkgreen">
                                                                            <?= $nama_bank_pengirim; ?>
                                                                        </label>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Bank Penerima</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                                        <?php
                                                                        if($baris->id_bank_penerima==null){
                                                                            ?>
                                                                            <label for="label" class="label" style="background-color: darkred">
                                                                                Belum Ada Bank Penerima
                                                                            </label>
                                                                            <?php
                                                                        } else if($baris->id_bank_penerima!=null){
                                                                            $nama_bank_penerima = $this->db->get_where("tbl_bank",array("id_bank"=>$baris->id_bank_penerima))->row()->nama_bank;
                                                                            ?>
                                                                            <label for="label" class="label" style="background-color: darkgreen">
                                                                                <?= $nama_bank_penerima; ?>
                                                                            </label>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">No Rekening Pengirim</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                                    <?php
                                                                    if($baris->norek_pengirim==null){
                                                                        ?>
                                                                        <label for="label" class="label" style="background-color: darkred">
                                                                            Belum Ada No. Rekening Pengirim
                                                                        </label>
                                                                        <?php
                                                                    } else if ($baris->norek_pengirim!=null){
                                                                      ?>
                                                                        <label for="label" class="label" style="background-color: darkgreen">
                                                                            <?php echo $baris->norek_pengirim ?>
                                                                        </label>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <?php
                                                                    $tgl_masa_berlaku_paspor = explode(' ', $this->Mcrud->tgl_id(date('d-m-Y H:i:s', strtotime($baris->masa_berlaku_paspor)), 'full'))
                                                                    ?>

                                                                    <span style="font-weight: bold; font-size: 15px">No Rekening Penerima</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                                    <?php
                                                                    if($baris->norek_penerima==null){
                                                                        ?>
                                                                        <label for="label" class="label" style="background-color: darkred">
                                                                            Belum Ada No. Rekening Penerima
                                                                        </label>
                                                                        <?php
                                                                    } else if($baris->norek_penerima!=null){
                                                                        ?>
                                                                        <label for="label" class="label" style="background-color: darkgreen">
                                                                            <?php echo $baris->norek_penerima; ?>
                                                                        </label>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <span style="font-weight: bold; font-size: 15px">Bukti Transfer</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>

                                                                    <div class="form-group col-lg-12" style="justify-items: end; background-color: ">
                                                                        <div class="row m-l-1" style=" overflow: hidden;  ">
                                                                            <?php
                                                                            if($baris->lamp_bukti_tf_bonus!=""){
                                                                                ?>
                                                                                <a style="text-decoration: none" href="<?php echo base_url($baris->lamp_bukti_tf_bonus);?>" target="_blank">
                                                                                    <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                                                                    <?= explode('/',$baris->lamp_bukti_tf_bonus)[2];?>

                                                                                </a>
                                                                                <?php
                                                                            } else if($baris->lamp_bukti_tf_bonus==""){
                                                                                ?>
                                                                                <label for="label" class="label" style="background-color: red">Belum Ada Bukti Transfer</label>
                                                                                <?php
                                                                            }
                                                                            ?>

                                                                        </div>

                                                                    </div>

                                                                    <br>

                                                                    <div style="height: 15px"></div>


                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-info"
                                                                    data-dismiss="modal">
                                                                Tutup
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

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
<script type="text/javascript">
    $( document ).ready(function() {
        console.log( "ready!" );

        // $('#lamp_surat_permohonan').prop('required', true);
        // $('#naskah_akademik_dll').prop('required', false);
        // $('#draft_harmonisasi').prop('required', true);


        //document.getElementById("confirm_pass_transfer").value = "";

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




</script>
<!-- end #content -->
