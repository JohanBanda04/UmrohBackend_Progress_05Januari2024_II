<?php foreach ($query->result as $baris):?>
<div class="modal fade" id="delete_confirm<?php echo $baris->id_draft_permohonan; ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="bd p-15"><h5 class="m-0">Hapus Data</h5></div>
            <div class="modal-body">
                <!--                                                <form method="POST" action="pemda/v/h">-->
                <form method="POST" action="<?php echo $link1; ?>/<?php echo $link2; ?>/h/<?php echo $zona_document ?>">
                    <input type="hidden" value="<?php echo $baris->id_draft_permohonan; ?>" name="id_draft_permohonan" />
                    <div>Apakah Anda yakin akan menghapus data draft raperda ini?</div>
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
<?php endforeach; ?>