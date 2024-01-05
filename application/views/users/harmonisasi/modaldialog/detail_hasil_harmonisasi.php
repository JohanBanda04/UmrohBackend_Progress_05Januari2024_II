<?php foreach ($query->result() as $baris){
?>

    <div class="modal fade" id="detail_hasil_harmonisasi<?php echo $baris->id_berita; ?>">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detail Hasil Harmonisasi</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <!---->
                        <span style="font-weight: bold; font-size: 15px">Judul :</span>
                        <br>
                        <div style="height: 15px"></div>
                        <span style="font-weight: normal; font-size: 15px"><?= $baris->nama_kegiatan; ?></span>

                        <br>
                        <div style="height: 15px"></div>
                        <!---->

                        <span style="font-weight: bold; font-size: 15px">Jenis :</span>
                        <br>
                        <div style="height: 15px"></div>
                        <span style="font-weight: normal; font-size: 15px"><?= $baris->jenis_dokumen; ?></span>

                        <br>
                        <div style="height: 15px"></div>


                        <!--dari sini-->
                        <span style="font-weight: bold; font-size: 15px">Status :</span>
                        <br>
                        <div style="height: 15px"></div>
                        <span style="font-weight: normal; font-size: 15px">
                            <?= ucfirst(explode("_",$baris->status)[0]??"")." ".ucfirst(explode("_",$baris->status)[1]??""); ?>
                        </span>

                        <br>
                        <div style="height: 15px"></div>
                        <!--sampai sini-->

                        <!--dari sini-->
                        <span style="font-weight: bold; font-size: 15px">Zona :</span>
                        <br>
                        <div style="height: 15px"></div>
                        <span style="font-weight: normal; font-size: 15px">
                            <?= ucfirst(explode("_",$baris->zona_dokumen)[0]??"")." ".ucfirst(explode("_",$baris->zona_dokumen)[1]??"")." ".ucfirst(explode("_",$baris->zona_dokumen)[2]??""); ?>
                        </span>

                        <br>
                        <div style="height: 15px"></div>
                        <!--sampai sini-->

                        <span style="font-weight: bold; font-size: 15px">Dokumen Hasil Harmonisasi :</span>
                        <br>
                        <div style="height: 15px"></div>

                        <div class="form-group col-lg-12" style="justify-items: end; background-color: ">
                            <div class="row m-l-1" style=" overflow: hidden;  ">
                                <a style="text-decoration: none" href="<?php echo base_url($baris->lamp_surat_undangan);?>" target="_blank">
                                    <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                    <?= explode('/',$baris->lamp_surat_undangan)[2];?>

                                </a>
                            </div>

                        </div>

                        <br>

                        <div style="height: 15px"></div>

                        <span style="font-weight: bold; font-size: 15px">Dokumen Berita Acara :</span>
                        <br>
                        <div style="height: 15px"></div>

                        <div class="form-group col-lg-12" style="justify-items: end; background-color: ">
                            <div class="row m-l-1" style=" overflow: hidden;  ">
                                <a style="text-decoration: none" href="<?php echo base_url($baris->lamp_berita_acara);?>" target="_blank">
                                    <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                    <?= explode('/',$baris->lamp_berita_acara)[2]??"Belum dilampirkan";?>

                                </a>
                            </div>

                        </div>

                        <br>

                        <!--dokumen surat hasil-->
                        <span style="font-weight: bold; font-size: 15px">Dokumen Surat Hasil :</span>
                        <br>
                        <div style="height: 15px"></div>

                        <div class="form-group col-lg-12" style="justify-items: end; background-color: ">
                            <div class="row m-l-1" style=" overflow: hidden;  ">
                                <a style="text-decoration: none" href="<?php echo base_url($baris->lamp_surat_hasil);?>" target="_blank">
                                    <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                    <?= explode('/',$baris->lamp_surat_hasil)[2]??"Belum dilampirkan";?>

                                </a>
                            </div>

                        </div>








                        <?php
                        $dt_tbl_berita = $this->db->get_where("tbl_berita", array('id_draft'=> $baris->id_draft_permohonan))->row();
                        $status = $dt_tbl_berita->status;

                        if($status=="selesai"){
                            ?>

                            <span style="font-weight: bold; font-size: 15px">Hasil Harmonisasi :</span>
                            <br>
                            <div style="height: 15px"></div>

                            <div class="form-group col-lg-12" style="justify-items: end">
                                <div class="row m-l-1" style=" overflow: hidden;  ">

                                    <a style="text-decoration: none" href="<?php echo base_url($dt_tbl_berita->lamp_surat_undangan);?>" target="_blank">
                                        <i class="fa fa-check-square" style=" "></i>
                                        <span>
                                                                        <?= explode('/',$dt_tbl_berita->lamp_surat_undangan)[2];?>
                                                                    </span>



                                    </a>
                                </div>

                            </div>

                            <?php
                        }
                        ?>




                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}?>
