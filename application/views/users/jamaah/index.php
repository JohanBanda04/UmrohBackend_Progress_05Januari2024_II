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
                <div class="panel-body">
                    <?php
                    if($this->session->userdata('nama_level')!="presiden_direktur"){
                        ?>
                        <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/t.html" class="btn btn-primary"><i
                                    class="fa fa-plus-circle"></i> Tambah <?php echo $judul_web; ?></a>
                        <?php
                    }
                    ?>

                    <hr>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama Jamaah</th>
                                <th>Agen Pemilik Jamaah</th>
                                <th>Paket </th>
                                <th>Metode Pembayaran </th>
                                <th>TTL</th>
                                <th>Usia (Thn)</th>
                                <th>No.Paspor</th>
                                <th hidden>Pembayaran</th>
                                <th >Status Approval</th>


                                <th width="15%" style="text-align: center;">Opsi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            if($this->session->userdata('nama_level')=="baitullah_mujahid"){
                                $query = $query;
                            } else if($this->session->userdata('nama_level')=="manajer_mujahid"){
                                $query = $query;
                            } else if($this->session->userdata('nama_level')=="direktur_mujahid"){
                                $query = $query;
                            } else if($this->session->userdata('nama_level')=="administrator"){
                                $query = $query->result();
                            }
                            foreach ( $query as $baris):
                                ?>
                                <tr>
                                    <td><b><?php echo $no++; ?>.</b></td>
                                    <td><?php echo $baris->nama_jamaah; ?></td>
                                    <td>
                                        <?php
                                        $get_pemilik_agen_id = $this->db->get_where("tbl_agen",
                                            array(
                                                    "id_agen"=>$baris->agen_pemilik_id
                                            )
                                        )->row();

                                        $get_role_pemilik_jamaah = $this->db->get_where("tbl_role_agen",
                                            array(
                                                    "id_role_agen"=>$get_pemilik_agen_id->role_agen_id
                                            ))->row();


                                        ?>
                                        <?= $get_pemilik_agen_id->nama_agen ?><br>

                                        <?php
                                        if($get_role_pemilik_jamaah->nama_role_agen=="presiden_direktur"){?>
                                            <label for="label" class="label" style="background-color: #00AAFF"><?= $get_role_pemilik_jamaah->nama_role_agen_lengkap?></label>

                                        <?php } else if($get_role_pemilik_jamaah->nama_role_agen=="direktur_mujahid"){
                                            ?>
                                            <label for="label" class="label" style="background-color: #369c13"><?= $get_role_pemilik_jamaah->nama_role_agen_lengkap?></label>
                                            <?php
                                        }else if($get_role_pemilik_jamaah->nama_role_agen=="manajer_mujahid"){
                                            ?>
                                            <label for="label" class="label" style="background-color: #d7496f"><?= $get_role_pemilik_jamaah->nama_role_agen_lengkap?></label>
                                            <?php
                                        }else if($get_role_pemilik_jamaah->nama_role_agen=="baitullah_mujahid"){
                                            ?>
                                            <label for="label" class="label" style="background-color: #a89292"><?= $get_role_pemilik_jamaah->nama_role_agen_lengkap?></label>
                                            <?php
                                        }
                                        ?>


                                    </td>
                                    <td>
                                        <?php
                                        if($baris->paket_haji_id!="" and $baris->paket_umroh_id!=""){
                                            echo "Belum Memilih Paket";
                                        } else if($baris->paket_haji_id!="" and $baris->paket_umroh_id==""){
//                                                            echo "Paket Haji";
                                            $paket_haji_selected = $this->db->get_where("tbl_paket_haji", array(
                                                    'id_paket_haji' => "$baris->paket_haji_id")
                                            )->row();
                                            echo $paket_haji_selected->nama_paket_haji;
                                        } else if($baris->paket_haji_id=="" and $baris->paket_umroh_id!=""){
//                                                            echo "Paket Umroh";
                                            $paket_umroh_selected = $this->db->get_where("tbl_paket_umroh", array(
                                                    'id_paket_umroh' => "$baris->paket_umroh_id")
                                            )->row();
                                            echo $paket_umroh_selected->nama_paket_umroh;
                                        } else {
                                            echo "Belum Memilih Paket";
                                        }?>
                                    </td>
                                    <td>
                                        <?php
                                        $status_byr = explode("_",$baris->status_pembayaran);
                                        if($baris->status_pembayaran=="bayar_dp_umroh" or $baris->status_pembayaran=="bayar_dp_haji"){
                                            ?>
                                            <label for="label" class="label" style="background-color: red">
                                                <?php  echo $status_byr[0]." ".$status_byr[1]." ".$status_byr[2]; ?>
                                            </label>
                                            <?php
                                        } else if($baris->status_pembayaran=="bayar_lunas_umroh" or $baris->status_pembayaran=="bayar_lunas_haji"){
                                            ?>
                                            <label for="label" class="label" style="background-color: green">
                                                <?php  echo $status_byr[0]." ".$status_byr[1]." ".$status_byr[2]; ?>
                                            </label>
                                            <?php
                                        }



                                        ?>
                                    </td>
                                    <?php
                                    $tgl_lahir_jamaah = explode(' ', $this->Mcrud->tgl_id(date('d-m-Y H:i:s', strtotime($baris->tgl_lahir)),'full'));

                                    ?>
                                    <td><?php echo $baris->tempat_lahir ." / ".$tgl_lahir_jamaah[0]." ".$tgl_lahir_jamaah[1]." ".$tgl_lahir_jamaah[2] ; ?></td>
                                    <td><?php echo $baris->usia; ?> tahun</td>
                                    <td><?php echo $baris->no_paspor; ?></td>
                                    <td hidden>
                                        <?php
                                        if($baris->lamp_bukti_tf_jamaah==""){
                                            ?><label class="label label-danger">Belum Bayar</label><?php
                                        } else if($baris->lamp_bukti_tf_jamaah!=""){
                                            ?>
                                            <label class="label label-success">Sudah Bayar</label>
                                            <?php
                                        }

                                        ?>
                                    </td>
                                    <td>
                                        <?php if($baris->status_approval=="setuju"){
                                            ?>
                                            <label for="label" class="label" style="background-color: #3aa914">
                                                <?php echo ucfirst($baris->status_approval); ?>
                                            </label>
                                            <?php
                                        } else if($baris->status_approval=="tidak_setuju"){
                                            ?>
                                            <label for="label" class="label" style="background-color: #a91a27">
                                                <?php
                                                $dt_app = explode("_",$baris->status_approval);
                                                echo ucfirst($dt_app[0])." ".ucfirst($dt_app[1])." / Perlu Koreksi";
                                                ?>
                                            </label>
                                            <?php
                                        } else if($baris->status_approval=="pending"){
                                            ?>
                                            <label for="label" class="label" style="background-color: #a99095">
                                                <?php echo ucfirst($baris->status_approval); ?>
                                            </label>
                                            <?php
                                        }?>

                                    </td>

                                    <td align="center">
                                        <?php if ($baris->nama_panjang != 'Superadmin') : ?>
                                            <a
                                                    href=""
                                                    class="btn btn-info btn-xs"
                                                    data-toggle="modal" title="Lihat Detail"
                                                    data-target="#detail_data_jamaah<?php echo hashids_encrypt($baris->id_jamaah); ?>">
                                                <i class="fa fa-info-circle"></i>
                                            </a>
                                        <?php
                                            $get_role_id_pemilik = $this->db->get_where("tbl_agen",
                                                array(
                                                        "id_agen"=>$baris->agen_pemilik_id
                                                ))->row()->role_agen_id;

                                            $get_role_name_pemilik = $this->db->get_where("tbl_role_agen",
                                                array(
                                                        "id_role_agen"=>$get_role_id_pemilik
                                                ))->row();
                                            $nama_role_pemilik_jamaah = $get_role_name_pemilik->nama_role_agen;

                                            ?>
                                            <?php
                                            if (($this->session->userdata('nama_level')=="presiden_direktur" && $nama_role_pemilik_jamaah=="direktur_mujahid")
                                                or($this->session->userdata('nama_level')=="presiden_direktur" && $nama_role_pemilik_jamaah=="presiden_direktur")
                                                or($this->session->userdata('nama_level')=="direktur_mujahid" && $nama_role_pemilik_jamaah=="manajer_mujahid")
                                                or($this->session->userdata('nama_level')=="direktur_mujahid" && $nama_role_pemilik_jamaah=="direktur_mujahid")
                                                or($this->session->userdata('nama_level')=="manajer_mujahid" && $nama_role_pemilik_jamaah=="manajer_mujahid")
                                                or($this->session->userdata('nama_level')=="manajer_mujahid" && $nama_role_pemilik_jamaah=="baitullah_mujahid")
                                                or($this->session->userdata('nama_level')=="baitullah_mujahid" && $nama_role_pemilik_jamaah=="baitullah_mujahid")
                                                or($this->session->userdata('nama_level')=="baitullah_mujahid" && $nama_role_pemilik_jamaah=="manajer_mujahid")  ){
                                                ?>
                                                <!--dari sini-->
                                                <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/e_jamaah/<?php echo hashids_encrypt($baris->id_jamaah); ?>"
                                                   class=" btn btn-success btn-xs"
                                                   title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <!--sampai sini-->
                                                <?php
                                            }?>


                                                <!--taruh disini jika ingin memberi akses edit utk role presdir-->


                                        <?php if($this->session->userdata('nama_level')=="administrator"){
                                            ?>
                                                <a  href=""
                                                    class="hidden btn btn-danger btn-xs"

                                                    data-toggle="modal" title="Hapus Data Paket Haji"
                                                    data-target="#delete_confirm<?php echo hashids_encrypt($baris->id_jamaah); ?>"
                                                ><i class="fa fa-trash-o"></i
                                                    ></a>
                                                <?php
                                            }?>


                                        <!--invoice-->
                                        <?php if($baris->lamp_bukti_tf_jamaah!=""){
                                                ?>
                                                <?php
                                                if($baris->status_approval=="setuju"){

                                                }
                                                ?>
                                                <a  target="_blank" href="<?php echo $link1; ?>/<?php echo $link2; ?>/invoice/<?php echo hashids_encrypt($baris->id_jamaah); ?>"
                                                    class="btn btn-primary btn-xs"
                                                    title="Cetak Invoice"
                                                ><i class="fa fa-print"></i
                                                    >
                                                </a>

                                                <?php

                                            }?>

                                        <?php
                                            if($this->session->userdata('nama_level')=="administrator"){
                                                ?>

                                                <?php
                                                if($baris->status_pembayaran =="bayar_lunas_umroh" or $baris->status_pembayaran =="bayar_lunas_haji"){
                                                    ?>
                                                    <a  href=""
                                                        class="<?php if($baris->status_approval=='setuju'){ echo "disabled"; } ?> btn btn-warning btn-xs"

                                                        data-toggle="modal" title="Beri Approval Jamaah?"
                                                        data-target="#jamaah_confirm<?php echo hashids_encrypt($baris->id_jamaah); ?>"
                                                    >
                                                        <i class="fa fa-check-square" style="color: white"></i>

                                                    </a>
                                                    <?php
                                                }
                                                ?>


                                                <a  href=""
                                                    class="btn btn-xs" style="background-color: red"

                                                    data-toggle="modal" title="Hapus Data Jamaah?"
                                                    data-target="#confirm_password<?php echo hashids_encrypt($baris->id_jamaah); ?>">
                                                    <i class="fa fa-trash" style="color: white"></i>

                                                </a>

                                                <?php
                                                if($baris->status_pembayaran=="bayar_dp_umroh" or $baris->status_pembayaran=="bayar_dp_haji" ){
                                                    ?>
                                                    <a  href=""
                                                        class="btn btn-xs" style="background-color: purple"

                                                        data-toggle="modal" title="Pelunasan?"
                                                        data-target="#confirm_pelunasan<?php echo hashids_encrypt($baris->id_jamaah); ?>"
                                                    >
                                                        <i class="fa fa-leaf" style="color: white"></i>

                                                    </a>
                                                    <?php
                                                }
                                                ?>





                                                <?php
                                            }
                                            ?>

<!--                                            <a href="--><?php //echo $link1; ?><!--/--><?php //echo $link2; ?><!--/h/--><?php //echo hashids_encrypt($baris->id_cabang); ?><!--"-->
<!--                                               class="btn btn-danger btn-xs"-->
<!--                                               title="Hapus" onclick="return confirm('Anda yakin?');">-->
<!--                                                <i class="fa fa-trash-o"></i>-->
<!--                                            </a>-->
                                        <?php endif; ?>
                                    </td>

                                </tr>

                                <div class="modal fade" id="confirm_password<?php echo hashids_encrypt($baris->id_jamaah); ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="bd p-15"><h5 class="m-0">Hapus Data Jamaah <b><?= $baris->nama_jamaah?></b>?</h5></div>
                                            <div class="modal-body">
                                                <form method="POST" action="jamaah/v/h_jamaah" enctype="multipart/form-data">
                                                    <input type="hidden" value="<?php echo hashids_encrypt($baris->id_jamaah); ?>"
                                                           name="id_jamaah" id="id_jamaah"/>
                                                    <div class="form-group">
                                                        <label class="fw-500" for="status">Konfirmasi Password Untuk Hapus Data</label>
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
                                                            Hapus
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <!--yg masuk sini sudah pasti baru DP saja-->
                                <div class="modal fade" id="confirm_pelunasan<?php echo hashids_encrypt($baris->id_jamaah); ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="bd p-15"><h5 class="m-0">Lunasi Pembayaran Data Jamaah <b><?= $baris->nama_jamaah?></b>?</h5></div>
                                            <div class="modal-body">
                                                <form method="POST" action="jamaah/v/pelunasan_jamaah" enctype="multipart/form-data">
                                                    <input type="hidden" value="<?php echo hashids_encrypt($baris->id_jamaah); ?>"
                                                           name="id_jamaah" id="id_jamaah"/>
                                                    <?php
                                                    $get_uang_pembayaran = $this->db->get_where("tbl_jamaah",array("id_jamaah"=>$baris->id_jamaah))->row()->uang_pembayaran;

                                                    if($baris->paket_haji_id!=""){
                                                        $haji_paket_id = $this->db->get_where("tbl_jamaah",array("id_jamaah"=>$baris->id_jamaah))->row()->paket_haji_id;
                                                        $harga_paket = $this->db->get_where("tbl_paket_haji",array("id_paket_haji"=>$haji_paket_id))->row()->harga_paket_haji;
                                                    } else if($baris->paket_umroh_id!=""){
                                                        $umroh_paket_id = $this->db->get_where("tbl_jamaah",array("id_jamaah"=>$baris->id_jamaah))->row()->paket_umroh_id;
                                                        $harga_paket = $this->db->get_where("tbl_paket_umroh",array("id_paket_umroh"=>$umroh_paket_id))->row()->harga_paket_umroh;
                                                    }
                                                    ?>
                                                    <div class="form-group">
                                                        <label class="fw-500" for="status">Jumlah DP</label>
                                                        <input readonly class="form-control" type="text"
                                                               id="jml_dp"
                                                               name="jml_dp" value="<?php echo "Rp ".number_format($get_uang_pembayaran)." (Harga Paket : Rp ".number_format($harga_paket).")"; ?>" placeholder="Jumlah DP"
                                                               required autofocus onfocus="this.value = this.value;">

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="fw-500" for="status">Jumlah Pelunasan</label>
                                                        <input class="form-control" type="number"
                                                               id="jml_pelunasan"
                                                               name="jml_pelunasan" value="" placeholder="Jumlah Pelunasan"
                                                               required autofocus onfocus="this.value = this.value;">

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="fw-500" for="status">Lampiran Bukti Transfer</label>
                                                        <input id="lamp_bukti_tf_lunas_jamaah"
                                                               type="file"
                                                               onchange="checkSelectedFile(id)"
                                                               name="lamp_bukti_tf_lunas_jamaah" class="form-control" required>
                                                        <small class="lh-1" style="color: red"><i>.jpeg .jpg .png (*wajib)</i></small>

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="fw-500" for="status">Ubah status pembayaran</label>
                                                        <select class="form-control border-grey" id="status_pembayaran_baru" name="status_pembayaran_baru" required autofocus
                                                                onfocus="this.value = this.value;" >
                                                            <option value="" selected>- Pilih -</option>

                                                            <?php if($baris->paket_haji_id!=""){
                                                                ?>
                                                                <option <?php if($baris->status_pembayaran=="bayar_lunas_haji") { ?>
                                                                    selected
                                                                <?php } ?> value="bayar_lunas_haji">Bayar Lunas Haji</option>
                                                                <?php
                                                            } else if($baris->paket_umroh_id!=""){
                                                                ?>
                                                                <option <?php if($baris->status_pembayaran=="bayar_lunas_umroh") { ?>
                                                                    selected
                                                                <?php } ?> value="bayar_lunas_umroh">Bayar Lunas Umroh</option>
                                                                <?php
                                                            }?>



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

                                <div class="modal fade" id="jamaah_confirm<?php echo hashids_encrypt($baris->id_jamaah); ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="bd p-15"><h5 class="m-0">Ubah Status Approval Jamaah atas nama <b><?= $baris->nama_jamaah?></b>?</h5></div>
                                            <div class="modal-body">
                                                <form method="POST" action="jamaah/v/jamaah_confirm" enctype="multipart/form-data">
                                                    <input type="hidden" value="<?php echo hashids_encrypt($baris->id_jamaah); ?>"
                                                           name="id_jamaah" id="id_jamaah"/>
                                                    <div class="form-group">
                                                        <label class="fw-500" for="status">Ubah status approval</label>
                                                        <select class="form-control border-grey" id="status" name="status" required autofocus
                                                                onfocus="this.value = this.value;" >
                                                            <option value="">- Pilih -</option>
                                                            <option <?php if($baris->status_approval=="setuju"){ ?>
                                                                selected
                                                            <?php } ?> value="setuju">Setuju</option>
                                                            <option <?php if($baris->status_approval=="tidak_setuju") { ?>
                                                                selected
                                                            <?php } ?> value="tidak_setuju">Tolak / Perlu Koreksi</option>
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




                                <div class="modal fade" id="delete_confirm<?php echo hashids_encrypt($baris->id_jamaah); ?>">
                                    <div class="modal-dialog" role="document">
                                        <!--                                        --><?//= $zona_document; ?>
                                        <div class="modal-content">
                                            <div class="bd p-15"><h5 class="m-0">Hapus Data</h5></div>
                                            <div class="modal-body">
                                                <!--                                                <form method="POST" action="pemda/v/h">-->
                                                <!--kunci kesuksesan contoh cara kirim action menuju controller tertentu dengan form-->
                                                <form method="POST" action="<?php echo $link1; ?>/<?php echo $link2; ?>/h_jamaah/<?php echo hashids_encrypt($baris->id_jamaah); ?>">
                                                    <input type="hidden" value="<?php echo $baris->id_jamaah; ?>" name="id_jamaah" />
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
                                         id="detail_data_jamaah<?php echo hashids_encrypt($baris->id_jamaah); ?>">


                                        <div class="modal-dialog" style="width: 1100px" role="document">
                                            <div class="row" >
                                                <div class="col-md-12">
                                                    <div class="modal-content" >
                                                        <div class="modal-header" style="background-color: #225fd5">
                                                            <button type="button" class="close" data-dismiss="modal">&times;
                                                            </button>
                                                            <h4 class="modal-title" style="color: white">Detail Data Jamaah <span
                                                                        style="color: yellow"><?php echo $baris->nama_jamaah ?></span>
                                                            </h4>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="modal-body">
                                                                <div class="form-horizontal">
                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Nama Jamaah :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->nama_jamaah; ?></span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->


                                                                    <span style="font-weight: bold; font-size: 15px">Tempat dan Tgl Lahir :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?php echo $baris->tempat_lahir ." / ".$tgl_lahir_jamaah[0]." ".$tgl_lahir_jamaah[1]." ".$tgl_lahir_jamaah[2] ; ?></span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Usia : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->usia; ?> tahun</span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">No. Paspor</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->no_paspor; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <?php
                                                                    $tgl_paspor_publish = explode(' ', $this->Mcrud->tgl_id(date('d-m-Y H:i:s', strtotime($baris->tgl_paspor_publish)),'full'));
                                                                    ?>

                                                                    <span style="font-weight: bold; font-size: 15px">Tgl Paspor Diterbitkan : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $tgl_paspor_publish[0]." ".$tgl_paspor_publish[1]." ".$tgl_paspor_publish[2]; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <?php
                                                                    $tgl_masa_berlaku_paspor = explode(' ', $this->Mcrud->tgl_id(date('d-m-Y H:i:s', strtotime($baris->masa_berlaku_paspor)),'full'))
                                                                    ?>

                                                                    <span style="font-weight: bold; font-size: 15px">Masa Berlaku Paspor (sampai dengan) :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $tgl_masa_berlaku_paspor[0]." ".$tgl_masa_berlaku_paspor[1]." ".$tgl_masa_berlaku_paspor[2]; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->


                                                                    <!---->

                                                                    <span style="font-weight: bold; font-size: 15px">Tempat Paspor Diterbitkan :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->tempat_paspor_publish; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Alamat Lengkap :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->alamat_lengkap; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Jenis Kelamin : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                                        <?php if($baris->jenis_kelamin=="L"){ ?>
                                                                            Laki-laki
                                                                        <?php } else { ?>
                                                                            Perempuan
                                                                        <?php } ?>
                                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">No. Telpon / Whatssap :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->no_telp_wa; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Pekerjaan : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                                        <?= $baris->pekerjaan; ?>
                                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Status Approval : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">

                                                                            <?php
                                                                            if ($baris->status_approval == "setuju") {
                                                                                ?>
                                                                                <label for="label" class="label" style="background-color: green"><?= $baris->status_approval?></label>
                                                                                <?php

                                                                            } else if ($baris->status_approval == "tidak_setuju") {
                                                                                ?>
                                                                                <label for="label" class="label" style="background-color: red"><?= $baris->status_approval?></label>
                                                                                <?php

                                                                            } else if ($baris->status_approval == "pending") { ?>
                                                                                <label for="label" class="label" style="background-color: grey"><?= $baris->status_approval?></label>
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
                                                                    <!--agens-->
                                                                    <?php
                                                                    $get_pemilik_agen_id = $this->db->get_where("tbl_agen",
                                                                        array(
                                                                            "id_agen"=>$baris->agen_pemilik_id
                                                                        )
                                                                    )->row();
                                                                    $get_role_pemilik = $this->db->get_where("tbl_role_agen",
                                                                        array
                                                                        (
                                                                                "id_role_agen"=>$get_pemilik_agen_id->role_agen_id
                                                                        )
                                                                    )->row();
                                                                    ?>
                                                                    <span style="font-weight: bold; font-size: 15px">Agen Pemilik Jamaah : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                                        <?= $get_pemilik_agen_id->nama_agen." "; ?>(<?= $get_role_pemilik->nama_role_agen_lengkap; ?>)
                                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Nama Mahram : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->nama_mahram; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Hubungan Mahram : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->hub_mahram; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <?php
                                                                    $rencana_umroh_or_haji = explode(' ', $this->Mcrud->tgl_id(date('d-m-Y H:i:s', strtotime($baris->rencana_umroh_or_haji)),'full'));
                                                                    ?>

                                                                    <span style="font-weight: bold; font-size: 15px">Rencana Umroh / Haji :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                                        <?= $rencana_umroh_or_haji[0]." ".$rencana_umroh_or_haji[1]." ".$rencana_umroh_or_haji[2] ; ?>
                                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <?php
                                                                    $pernah = explode(' ', $this->Mcrud->tgl_id(date('d-m-Y H:i:s', strtotime($baris->pernah_umroh_or_haji_thn)),'full'));
                                                                    ?>

                                                                    <span style="font-weight: bold; font-size: 15px">Pernah Umroh / Haji (pada tahun) :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                                        <?php
                                                                        if($baris->pernah_umroh_or_haji_thn!="0000-00-00 00:00:00"){
                                                                            echo $pernah[0]." ".$pernah[1]." ".$pernah[2];
                                                                        } else {
                                                                            echo "Belum Pernah ";
                                                                        }
                                                                        ;
                                                                        ?>
                                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->

                                                                    <span style="font-weight: bold; font-size: 15px">Menggunakan Kursi Roda : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                                        <?php if($baris->kursi_roda=="T"){
                                                                            echo "Tidak";
                                                                        } else {
                                                                            echo "Ya";
                                                                        }?>
                                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <?php
                                                                    $get_tbl_embarkasi = $this->db->get_where("tbl_embarkasi",
                                                                        array(
                                                                                "id_embarkasi"=>$baris->embarkasi
                                                                        ))->row();
                                                                    ?>
                                                                    <span style="font-weight: bold; font-size: 15px">Embarkasi : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                        <?php echo $get_tbl_embarkasi->nama_embarkasi; ?>
                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->


                                                                    <!---->

                                                                    <span style="font-weight: bold; font-size: 15px">Pilihan Paket : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                        <?php
                                                        if($baris->paket_haji_id!="" and $baris->paket_umroh_id!=""){
                                                            echo "Belum Memilih Paket";
                                                        } else if($baris->paket_haji_id!="" and $baris->paket_umroh_id==""){
//                                                            echo "Paket Haji";
                                                            $paket_haji_selected = $this->db->get_where("tbl_paket_haji", array(
                                                                    'id_paket_haji' => "$baris->paket_haji_id")
                                                            )->row();
                                                            echo $paket_haji_selected->nama_paket_haji;
                                                        } else if($baris->paket_haji_id=="" and $baris->paket_umroh_id!=""){
//                                                            echo "Paket Umroh";
                                                            $paket_umroh_selected = $this->db->get_where("tbl_paket_umroh", array(
                                                                    'id_paket_umroh' => "$baris->paket_umroh_id")
                                                            )->row();
                                                            echo $paket_umroh_selected->nama_paket_umroh;
                                                        } else {
                                                            echo "Belum Memilih Paket";
                                                        }?>
                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->

                                                                    <span style="font-weight: bold; font-size: 15px">Jenis Pembayaran : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                        <?php
                                                        $status_bayar = explode("_",$baris->status_pembayaran);
                                                        echo ($status_bayar[0]." ".$status_bayar[1]." ".$status_bayar[2]);
                                                        ?>
                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->

                                                                    <span style="font-weight: bold; font-size: 15px">Uang Pembayaran : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                        Rp <?php echo number_format($baris->uang_pembayaran);?>
                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <?php
                                                                    $tgl_berangkat_jamaah = explode(' ', $this->Mcrud->tgl_id(date('d-m-Y H:i:s', strtotime($baris->tgl_berangkat)),'full'));
                                                                    ?>
                                                                    <span style="font-weight: bold; font-size: 15px">Tgl Berangkat :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                        <?php echo $tgl_berangkat_jamaah[0]." ".$tgl_berangkat_jamaah[1]." ".$tgl_berangkat_jamaah[2];?>
                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Bukti Transfer Jamaah</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>


                                                                    <?php if($baris->lamp_bukti_tf_jamaah!=""){?>
                                                                        <a style="text-decoration: none; overflow: hidden" href="<?php echo base_url($baris->lamp_bukti_tf_jamaah);?>" target="_blank">
                                                                            <!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                                                            <?= explode('/',$baris->lamp_bukti_tf_jamaah)[2];?>

                                                                        </a>
                                                                        <?php

                                                                    } else { ?>
                                                                        Belum Ada Bukti Transfer
                                                                    <?php } ?>


                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->








                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-info" data-dismiss="modal">
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
        <script type="text/javascript">
            $( document ).ready(function() {
                console.log( "ready!" );

                $('#lamp_surat_permohonan').prop('required', true);
                $('#naskah_akademik_dll').prop('required', false);
                $('#draft_harmonisasi').prop('required', true);

            });
            // $('.clockpicker').clockpicker();



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
        <!-- end col-12 -->
    </div>
    <!-- end row -->
</div>
<!-- end #content -->


