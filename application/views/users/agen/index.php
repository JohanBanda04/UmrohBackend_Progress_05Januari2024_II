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
        <small><?php echo $bread; ?></small>
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
                    <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/<?php echo $nama_role_agen; ?>/<?= hashids_encrypt($id_role_agen)?>/t_agen.html" class="btn btn-primary"><i
                                class="fa fa-plus-circle"></i> Tambah <?php echo $judul_web; ?></a>
                    <hr>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>ID Agen</th>
                                <th>Cabang Agen</th>
                                <th>Nama Lengkap</th>
                                <th>TTL</th>
                                <th>Jenis Kelamin</th>
                                <th>No. KTP</th>
                                <th>Alamat</th>

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
                                    <td><?php echo $baris->id_agen; ?></td>
                                    <td>
                                        <?php
                                        $get_nama_cabang = $this->db->get_where("tbl_cabang",
                                            array(
                                                    "id_cabang"=>$baris->cabang_id
                                            ))->row()->nama_cabang;

                                        ?>
                                        <label for="label" style="color: #3a87ad"><?= $get_nama_cabang;?></label>
                                        <?php
                                        ?>
                                    </td>
                                    <td><?php echo $baris->nama_agen; ?></td>
                                    <?php
                                    $tgl_lahir_agen = explode(' ', $this->Mcrud->tgl_id(date('d-m-Y H:i:s', strtotime($baris->tgl_lahir)), 'full'));
                                   // echo $this->Mcrud->tgl_id(date('d-m-Y H:i:s', strtotime($baris->tgl_lahir)), 'full');
                                    ?>
                                    <td><?php echo $baris->tempat_lahir . " / " . $tgl_lahir_agen[0] . " " . $tgl_lahir_agen[1] . " " . $tgl_lahir_agen[2]; ?></td>
                                    <td><?php
                                        if ($baris->jenis_kelamin == "L") {
                                            echo "Laki-laki";
                                        } else {
                                            echo "Perempuan";
                                        } ?> </td>
                                    <td><?php echo $baris->no_ktp; ?> </td>
                                    <td><?php echo $baris->alamat_lengkap; ?> </td>

                                    <td align="center">
                                        <?php if ($baris->nama_panjang != 'Superadmin') : ?>
                                            <?php
                                            $role_agen_name = $this->db->get_where("tbl_role_agen",
                                                array(
                                                        "id_role_agen"=>$baris->role_agen_id
                                                ))->row();
                                            $name_role_agen =  $role_agen_name->nama_role_agen;
                                            $id_role_agen =  $role_agen_name->id_role_agen;
                                            //echo $name_role_agen;

                                            ?>
                                            <a
                                                    href=""
                                                    class="btn btn-info btn-xs"
                                                    data-toggle="modal" title="Lihat Detail"
                                                    data-target="#detail_data_agen<?php echo hashids_encrypt($baris->id_agen); ?>">
                                                <i class="fa fa-info-circle"></i>
                                            </a>

                                            <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/<?php echo $nama_role_agen;?>/<?php echo hashids_encrypt($baris->id_agen); ?>/e_agen/<?php echo hashids_encrypt($id_role_agen);?>"
                                               class="btn btn-success btn-xs"
                                               title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <?php

                                            if($name_role_agen=="presiden_direktur"){
                                                $q = $this->db->query("SELECT * FROM tbl_jamaah WHERE presdir_id="
                                                    .$baris->id_agen);

                                                //echo $q->num_rows();
                                            } else if($name_role_agen=="direktur_mujahid"){
                                                $q = $this->db->query("SELECT * FROM tbl_jamaah WHERE direktur_id="
                                                    .$baris->id_agen);

                                                //echo $q->num_rows();
                                            } else if($name_role_agen=="manajer_mujahid"){
                                                $q = $this->db->query("SELECT * FROM tbl_jamaah WHERE manajer_id="
                                                    .$baris->id_agen);

                                                //echo $q->num_rows();
                                            } else if($name_role_agen=="baitullah_mujahid"){
                                                $q = $this->db->query("select * from tbl_jamaah where agen_id="
                                                    .$baris->id_agen
                                                    ." or agen_pemilik_id="
                                                    .$baris->id_agen);

                                                //echo $q->num_rows();
                                            }

                                            if($q->num_rows()<=0){ ?>
                                                <a href=""
                                                   class="btn btn-danger btn-xs"

                                                   data-toggle="modal" title="Hapus Data Agen"
                                                   data-target="#delete_confirm<?php echo hashids_encrypt($baris->id_agen); ?>"
                                                ><i class="fa fa-trash-o"></i
                                                    ></a>
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


                                <div class="modal fade"
                                     id="delete_confirm<?php echo hashids_encrypt($baris->id_agen); ?>">
                                    <div class="modal-dialog" role="document">
                                        <!--                                        --><? //= $zona_document;
                                        ?>
                                        <div class="modal-content">
                                            <div class="bd p-15"><h5 class="m-0">Hapus Data</h5></div>
                                            <div class="modal-body">
                                                <!--                                                <form method="POST" action="pemda/v/h">-->
                                                <!--kunci kesuksesan contoh cara kirim action menuju controller tertentu dengan form-->
                                                <form method="POST"
                                                      action="<?php echo $link1; ?>/<?php echo $link2; ?>/<?php echo $nama_role_agen;?>/<?php echo hashids_encrypt($baris->id_agen); ?>/h_agen/<?php echo $id_role_agen;?>">
                                                    <input type="hidden" value="<?php echo $baris->id_jamaah; ?>"
                                                           name="id_jamaah"/>
                                                    <div>Apakah Anda yakin akan menghapus data Agen <b><?php echo $baris->nama_agen; ?></b>?</div>
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
                                         id="detail_data_agen<?php echo hashids_encrypt($baris->id_agen); ?>">


                                        <div class="modal-dialog" style="width: 1100px" role="document">
                                            <div class="row" >
                                                <div class="col-md-12">
                                                    <div class="modal-content" >
                                                        <div class="modal-header" style="background-color: #225fd5">
                                                            <button type="button" class="close" data-dismiss="modal">&times;
                                                            </button>
                                                            <h4 class="modal-title" style="color: white">Detail Data Agen <span
                                                                        style="color: yellow"><?php echo $baris->nama_agen ?></span>
                                                            </h4>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="modal-body">
                                                                <div class="form-horizontal">
                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Nama Agen :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->nama_agen; ?></span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Username</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->username; ?></span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Password</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span hidden style="font-weight: normal; font-size: 15px"><?= $baris->password; ?></span>
                                                                    <input style="border: none" type="password"  autocomplete="off"
                                                                           disabled readonly class="form-control"
                                                                           value="<?= $baris->password; ?>"
                                                                           required autofocus onfocus="this.value = this.value;">

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Cabang Agen : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                                        <?php

                                                                        $get_nama_cabang = $this->db->get_where("tbl_cabang",
                                                                            array(
                                                                                    "id_cabang"=>$baris->cabang_id
                                                                            ))->row()->nama_cabang;
                                                                        echo $get_nama_cabang;
                                                                        ?>
                                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->


                                                                    <span style="font-weight: bold; font-size: 15px">Tempat dan Tgl Lahir :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?php echo $baris->tempat_lahir . " / " . $tgl_lahir_agen[0] . " " . $tgl_lahir_agen[1] . " " . $tgl_lahir_agen[2]; ?></span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Jenis Kelamin :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?php if ($baris->jenis_kelamin == "L") {
                                                                            echo "Laki-laki";
                                                                        } else {
                                                                            echo "Perempuan";
                                                                        } ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">No KTP :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->no_ktp; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->

                                                                    <span style="font-weight: bold; font-size: 15px">Alamat Lengkap: </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?php echo $baris->alamat_lengkap ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->

                                                                    <span style="font-weight: bold; font-size: 15px">Kota :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?php echo $baris->kota; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->


                                                                    <!---->

                                                                    <span style="font-weight: bold; font-size: 15px">Kecamatan : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->kecamatan; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Kelurahan :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->kelurahan; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Provinsi : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?php echo $baris->provinsi; ?> </span>

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
                                                                    <span style="font-weight: bold; font-size: 15px">Kode Pos : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->kode_pos; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->
                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Email : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->email; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">No. HP : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->no_hp; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Nama Bank : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->nama_bank; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->

                                                                    <span style="font-weight: bold; font-size: 15px">Cabang Bank</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?php echo $baris->cabang_bank; ?> </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->

                                                                    <span style="font-weight: bold; font-size: 15px">No. Rekening :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px"><?php echo $baris->no_rekening; ?></span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Pemilik Rekening : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                        <?php echo $baris->pemilik_rekening; ?>
                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->


                                                                    <!---->
                                                                    <?php
                                                                    $get_nama_role_agen = $this->db->get_where("tbl_role_agen",
                                                                        array("id_role_agen" => $baris->jabatan))->row();
                                                                    ?>
                                                                    <span style="font-weight: bold; font-size: 15px">Jabatan : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                        <?php echo $get_nama_role_agen->nama_role_agen_lengkap; ?>
                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <?php
                                                                    $get_nama_sponsor_atasan = $this->db->get_where("tbl_agen",
                                                                        array(
                                                                            "id_agen" => $baris->sponsor_atasan
                                                                        ))->row();
                                                                    ?>
                                                                    <span style="font-weight: bold; font-size: 15px">Sponsor : </span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                        <?php
                                                        if ($baris->sponsor_atasan != "") {
                                                            if($get_nama_sponsor_atasan->nama_agen=="Administrator"){
                                                                ?><span style="color: red">
                                                                    Presdir Adalah Jabatan Tertinggi
                                                                </span><?php
                                                            } else {
                                                                echo $get_nama_sponsor_atasan->nama_agen;

                                                            }

                                                        } else {
                                                            echo "-";
                                                        }
                                                        ?>
                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">Nama Ahli Waris :</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                        <?php echo $baris->nama_ahli_waris; ?>
                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->

                                                                    <span style="font-weight: bold; font-size: 15px">Hubungan dgn Ahli Waris</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                        <?php echo $baris->hub_dgn_ahli_waris; ?>
                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span style="font-weight: bold; font-size: 15px">No. Hp Ahli Waris</span>
                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <span style="font-weight: normal; font-size: 15px">
                                                        <?php echo $baris->no_hp_ahli_waris; ?>
                                                    </span>

                                                                    <br>
                                                                    <div style="height: 15px"></div>
                                                                    <!---->

                                                                    <!---->
                                                                    <span hidden style="font-weight: bold; font-size: 15px">Spesimen TTD</span>
                                                                    <br>
                                                                    <div hidden style="height: 15px"></div>


                                                                    <?php if($baris->lamp_ttd_agen!=""){?>
                                                                        <a hidden style="text-decoration: none; overflow: hidden" href="<?php echo base_url($baris->lamp_ttd_agen);?>" target="_blank">
                                                                            <!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                                                            <?= explode('/',$baris->lamp_ttd_agen)[2];?>

                                                                        </a>
                                                                        <?php

                                                                    } else { ?>
                                                                        <a href="">
                                                                            Belum Ada Spesimen TTD
                                                                        </a>

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
        <!-- end col-12 -->
    </div>
    <!-- end row -->
</div>
<!-- end #content -->
