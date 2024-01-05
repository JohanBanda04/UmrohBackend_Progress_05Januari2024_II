<div class="modal fade" id="detail_draft_berita<?php echo $baris->id_draft_permohonan; ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detail Draft Raperda</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <span style="font-weight: bold; font-size: 15px">Judul :</span>
                    <br>
                    <div style="height: 15px"></div>
                    <span style="font-weight: normal; font-size: 15px"><?= $baris->nama_draft_permohonan; ?></span>

                    <br>
                    <div style="height: 15px"></div>

                    <span style="font-weight: bold; font-size: 15px">Jenis :</span>
                    <br>
                    <div style="height: 15px"></div>
                    <span style="font-weight: normal; font-size: 15px"><?= $baris->jenis_dokumen; ?></span>

                    <br>
                    <div style="height: 15px"></div>

                    <span style="font-weight: bold; font-size: 15px">Permohonan Harmonisasi :</span>
                    <br>
                    <div style="height: 15px"></div>
                    <div>


                        <a href="<?php echo base_url($baris->lamp_surat_permohonan);?>" target="_blank">
                            <i class="fa fa-check-square" style="margin-right: 15px"></i><?= explode('/',$baris->lamp_surat_permohonan)[2];?>
                        </a>
                    </div>
                    <br>
                    <div style="height: 15px"></div>

                    <span style="font-weight: bold; font-size: 15px">Draft Harmonisasi :</span>
                    <br>
                    <div style="height: 20px"></div>

                    <?php foreach ($this->Mcrud->url_data_dukung($baris->url_data_dukung) as $key => $element){ ?>
                        <div class="">
                            <a href="<?= base_url($element); ?>" target="_blank">
                                <i class="fa fa-check-square" style="margin-right: 15px"></i><?php echo explode("/", $element)[2]; ?>
                            </a>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>