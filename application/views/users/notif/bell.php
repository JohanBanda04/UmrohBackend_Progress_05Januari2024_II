<li class="dropdown-header">Notifikasi (<?php echo number_format($jml_notif,0,",","."); ?>)</li>

<?php
$no = '1';
$foto  = "img/user/user-default.jpg";
$id_user = $this->session->userdata('id_user');

foreach ($query->result() as $key => $value):
  $cek_penerima = $this->db->get_where('tbl_user', array('id_user'=>$value->penerima));
  if ($cek_penerima->num_rows()!=0) {
    $cek_pengirim = $this->db->get_where('tbl_user', array('id_user'=>$value->pengirim));
    if ($cek_pengirim->num_rows()==0) {
      if ($value->nama_client=='') {
        $nama  = ""; $pesan = ""; $waktu = "";
      } else {
        $nama  = $value->nama_client;
        $pesan = $value->pesan;
        $waktu = $this->Mcrud->waktu($value->tgl_notif,'full');
      }
    }else {
      $baris = $cek_pengirim->row();
      $nama  = $baris->nama_lengkap;
      $pesan = $value->pesan;
      $waktu = $this->Mcrud->waktu($value->tgl_notif,'full');
    }

    if ($no <= '5') {
      $link = "javascript:;";
      if ($value->link!='') {
        $link = $value->link;
      }
      if(!preg_match("/$id_user/i", $value->hapus_notif)) {
  ?>
  <li class="media <?php if(!preg_match("/$id_user/i", $value->baca_notif)) { echo "unread";} ?>">
      <a href="<?php echo $link; ?>" id="notif_click">
          <div class="media-left"><img src="<?php echo $foto; ?>" class="media-object" alt=""></div>
          <div class="media-body">
              <h6 class="media-heading"><?php echo $nama; ?></h6>
              <p><?php echo $pesan; ?></p>
              <div class="text-muted f-s-11"><?php echo $waktu; ?></div>
          </div>
      </a>
  </li>
<?php
      }
    }
    $no++;
  }
endforeach; ?>


  <li class="text-center">
    <?php if ($query->num_rows()==0){ ?>
      Tidak ada notifikasi
      <br><br>
    <?php }else{ ?>
      <a href="web/notif.html" style="padding:10px;">Tampilkan Semua</a>
    <?php } ?>
  </li>

<script>
</script>
