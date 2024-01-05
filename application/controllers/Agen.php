<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agen extends CI_Controller
{

    public function index()
    {
        redirect('agen_bait_mujahid/v');
    }

    public function cari_pilihan_nama_kota($aksi = '', $id = '')
    {

        $id = hashids_decrypt($id);
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');

        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            $search = $this->input->post('nama');

            $get_data_kota = $this->db->query("SELECT * FROM tbl_kota WHERE nama_kota LIKE '%$search%'");

//        $get_data_kota = $this->db->get("tbl_kota");
            foreach ($get_data_kota->result() as $id => $kota) {
                $return_arr[] = $kota->nama_kota;
            }
            echo json_encode($return_arr);
        }

    }

    public function cari_pilihan_dp_edit($aksi = '', $id = '')
    {
        $pilihan_paket_edit = $this->input->post('pilihan_paket_edit');
        $jenis_paket_edit = $this->input->post('jenis_paket_edit');

        $id = hashids_decrypt($id);
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');

        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            if ($pilihan_paket_edit == "paket_haji") {
                $get_data_paket_haji = $this->db->get_where("tbl_paket_haji", array(
                    "id_paket_haji" => $jenis_paket_edit,
                ));
                $id_dp_haji = $get_data_paket_haji->row()->dp_id;
                $get_data_pilihan_dp = $this->db->get_where("tbl_dp", array(
                    "id_dp" => $id_dp_haji,
                ));
                if ($get_data_pilihan_dp->num_rows() > 0) {
                    ?>
                    <option value="" selected="selected">-Pilih Uang Muka-</option>
                    <?php
                    foreach ($get_data_pilihan_dp->result() as $id => $dp) {
                        echo $dp->harga_dp1 . "-";
                        echo $dp->harga_dp2; ?>
                        <option style="text-align: center" value="<?php echo $dp->harga_dp1 ?>">
                            Rp <?= number_format($dp->harga_dp1); ?></option>
                        <option style="text-align: center" value="<?php echo $dp->harga_dp2 ?>">
                            Rp <?= number_format($dp->harga_dp2); ?></option>
                        <?php

                    }
                } else {
                    ?>
                    <option style="text-align: center" value="">Tidak ada pilihan uang muka</option>
                    <?php
                }
            } else if ($pilihan_paket_edit == "paket_umroh") {
                $get_data_paket_umroh = $this->db->get_where("tbl_paket_umroh", array(
                    "id_paket_umroh" => $jenis_paket_edit,
                ));
                $id_dp_umroh = $get_data_paket_umroh->row()->dp_id;
                $get_data_pilihan_dp = $this->db->get_where("tbl_dp", array(
                    "id_dp" => $id_dp_umroh,
                ));
                if ($get_data_pilihan_dp->num_rows() > 0) {
                    ?>
                    <option value="" selected="selected">-Pilih Uang Muka-</option>
                    <?php
                    foreach ($get_data_pilihan_dp->result() as $id => $dp) {
                        echo $dp->harga_dp1 . "-";
                        echo $dp->harga_dp2; ?>
                        <option style="text-align: center" value="<?php echo $dp->harga_dp1 ?>">
                            Rp <?= number_format($dp->harga_dp1); ?></option>
                        <option style="text-align: center" value="<?php echo $dp->harga_dp2 ?>">
                            Rp <?= number_format($dp->harga_dp2); ?></option>
                        <?php

                    }
                } else {
                    ?>
                    <option style="text-align: center" value="">Tidak ada pilihan uang muka</option>
                    <?php
                }
            }
        }
    }

    public function cari_pilihan_dp($aksi = '', $id = '')
    {

        $pilihan_paket = $this->input->post('pilihan_paket');
        $jenis_paket = $this->input->post('jenis_paket');

        $id = hashids_decrypt($id);
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');

        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            if ($pilihan_paket == "paket_haji") {
                echo "get data tbl_paket_haji";
                $get_data_paket_haji = $this->db->get_where("tbl_paket_haji", array(
                    "id_paket_haji" => $jenis_paket,
                ));

                echo "<pre>";
                print_r($get_data_paket_haji->result());
                echo "dpid:" . $get_data_paket_haji->row()->dp_id;
                $id_dp_haji = $get_data_paket_haji->row()->dp_id;

                $get_data_pilihan_dp = $this->db->get_where("tbl_dp", array(
                    "id_dp" => $id_dp_haji,
                ));
                echo "<pre>";
                print_r($get_data_pilihan_dp->result());

                if ($get_data_pilihan_dp->num_rows() > 0) {
                    ?>
                    <option value="" selected="selected">-Pilih Uang Muka-</option>
                    <?php
                    foreach ($get_data_pilihan_dp->result() as $id => $dp) {
                        echo $dp->harga_dp1 . "-";
                        echo $dp->harga_dp2; ?>
                        <option style="text-align: center" value="<?php echo $dp->harga_dp1 ?>">
                            Rp <?= number_format($dp->harga_dp1); ?></option>
                        <option style="text-align: center" value="<?php echo $dp->harga_dp2 ?>">
                            Rp <?= number_format($dp->harga_dp2); ?></option>
                        <?php

                    }
                } else {
                    ?>
                    <option style="text-align: center" value="">Tidak ada pilihan uang muka</option>
                    <?php
                }

            } else if ($pilihan_paket == "paket_umroh") {
                echo "get data tbl_paket_umroh";
                $get_data_paket_umroh = $this->db->get_where("tbl_paket_umroh", array(
                    "id_paket_umroh" => $jenis_paket,
                ));
                echo "<pre>";
                print_r($get_data_paket_umroh->result());
                echo "dpid:" . $get_data_paket_umroh->row()->dp_id;
                $id_dp_umroh = $get_data_paket_umroh->row()->dp_id;
                $get_data_pilihan_dp = $this->db->get_where("tbl_dp", array(
                    "id_dp" => $id_dp_umroh,
                ));
                echo "<pre>";
                print_r($get_data_pilihan_dp->result());
                if ($get_data_pilihan_dp->num_rows() > 0) { ?>
                    <option value="" selected="selected">-Pilih Uang Muka-</option>
                    <?php
                    foreach ($get_data_pilihan_dp->result() as $id => $dp) {
                        echo $dp->harga_dp1 . "-";
                        echo $dp->harga_dp2; ?>
                        <option style="text-align: center" value="<?php echo $dp->harga_dp1 ?>">
                            Rp <?= number_format($dp->harga_dp1); ?></option>
                        <option style="text-align: center" value="<?php echo $dp->harga_dp2 ?>">
                            Rp <?= number_format($dp->harga_dp2); ?></option>
                        <?php
                    }
                } else { ?>
                    <option style="text-align: center" value="">Tidak ada pilihan uang muka</option>
                <?php }

            }
        }

    }


    public function cari_jenis_paket_edit($aksi = '', $id = '')
    {
        $pilihan_paket_edit = $this->input->post('pilihan_paket_edit');
        $id = hashids_decrypt($id);
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');

        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            $pilihan_paket_edit = $this->input->post('pilihan_paket_edit');
            if ($pilihan_paket_edit == "paket_haji") {
                $jenis_paket_haji = $this->db->get("tbl_paket_haji");
                if ($jenis_paket_haji->num_rows() > 0) {
                    ?>
                    <option value="" selected="selected">-Pilih Jenis Paket Haji-</option>
                    <?php
                    foreach ($jenis_paket_haji->result() as $index => $jph) {
                        ?>
                        <option style="text-align: center"
                                value="<?php echo $jph->id_paket_haji ?>"><?= $jph->nama_paket_haji; ?></option>
                        <?php
                    }
                } else {
                    ?>
                    <option style="text-align: center" value="">Tidak ada pilihan jenis paket haji</option>
                    <?php
                }
            } else if ($pilihan_paket_edit == "paket_umroh") {
                $jenis_paket_umroh = $this->db->get("tbl_paket_umroh");
                if ($jenis_paket_umroh->num_rows() > 0) {
                    ?>
                    <option value="" selected="selected">-Pilih Jenis Paket Umroh-</option>
                    <?php
                    foreach ($jenis_paket_umroh->result() as $index => $jpu) {
                        ?>
                        <option style="text-align: center"
                                value="<?php echo $jpu->id_paket_umroh ?>"><?= $jpu->nama_paket_umroh; ?></option>
                        <?php
                    }
                } else {
                    ?>
                    <option style="text-align: center" value="">Tidak ada pilihan jenis paket umroh</option>
                    <?php
                }
            }
        }

    }

    public function cari_atasan_langsung($aksi = '', $id = '')
    {

        $pilihan_jabatan = $this->input->post('pilihan_jabatan');
        $id = hashids_decrypt($id);
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');



        if (!isset($ceks)) {
            redirect('web/login');
        } else {

            if ($this->input->post('pilihan_jabatan') == "") {
                ?>
                <option value="">-Anda Belum Memilih Jabatan-</option>
                <?php
            } else if ($this->input->post('pilihan_jabatan') != "") {

                if($pilihan_jabatan=="90"){
                    $pilihan_jabatan_atasan = "1";

                    ?>
                    <option value="1">-Presdir Merupakan Jabatan Tertinggi-</option>
                    <?php
                } else if($pilihan_jabatan=="91"){
                    $pilihan_jabatan_atasan = "90";
                    $dt_atasan = $this->db->get_where("tbl_agen",array("role_agen_id"=>$pilihan_jabatan_atasan));
                    $dt_jabatan_atasan = $this->db->get_where("tbl_role_agen",
                        array(
                                "id_role_agen"=>$pilihan_jabatan_atasan
                        )
                    )->row();

                    /*rizky*/
                    if($this->session->userdata('nama_level')=="administrator"){
                        foreach ($dt_atasan->result() as $id=>$dta){
                              ?>
                                <option value="<?= $dta->id_agen;?>">
                                    <?= $dta->nama_agen." ";?>(<?= $dt_jabatan_atasan->nama_role_agen_lengkap?>)
                                </option>
                            <?php

                        }
                    } else if($this->session->userdata('nama_level')!="administrator"){
                        foreach ($dt_atasan->result() as $id=>$dta){
                            if($dta->id_agen==$this->session->userdata("id_user")){
                                ?>
                                <option value="<?= $dta->id_agen;?>">
                                    <?= $dta->nama_agen;?> (<?= $dt_jabatan_atasan->nama_role_agen_lengkap?>)
                                </option>
                                <?php
                            }
                        }
                    }


                }else if($pilihan_jabatan=="93"){
                    $pilihan_jabatan_atasan = "91";
                    $dt_atasan = $this->db->get_where("tbl_agen",array("role_agen_id"=>$pilihan_jabatan_atasan));
                    $dt_jabatan_atasan = $this->db->get_where("tbl_role_agen",
                        array(
                            "id_role_agen"=>$pilihan_jabatan_atasan
                        )
                    )->row();

                    /*rizky*/
                    if($this->session->userdata('nama_level')=="administrator"){
                        foreach ($dt_atasan->result() as $id=>$dta){
                            ?>
                            <option value="<?= $dta->id_agen;?>">
                                <?= $dta->nama_agen." ";?>(<?= $dt_jabatan_atasan->nama_role_agen_lengkap?>)
                            </option>
                            <?php

                        }
                    } else if($this->session->userdata('nama_level')!="administrator"){
                        foreach ($dt_atasan->result() as $id=>$dta){
                            if($dta->id_agen==$this->session->userdata("id_user")){
                                ?>
                                <option value="<?= $dta->id_agen;?>">
                                    <?= $dta->nama_agen;?> (<?= $dt_jabatan_atasan->nama_role_agen_lengkap?>)
                                </option>
                                <?php
                            }
                        }
                    }



                } else if($pilihan_jabatan=="95"){
                    $pilihan_jabatan_atasan = "93";
                    $dt_atasan = $this->db->get_where("tbl_agen",array("role_agen_id"=>$pilihan_jabatan_atasan));
                    $dt_jabatan_atasan = $this->db->get_where("tbl_role_agen",
                        array(
                            "id_role_agen"=>$pilihan_jabatan_atasan
                        )
                    )->row();
                    /*rizky*/
                    if($this->session->userdata('nama_level')=="administrator"){
                        foreach ($dt_atasan->result() as $id=>$dta){
                            ?>
                            <option value="<?= $dta->id_agen;?>">
                                <?= $dta->nama_agen." ";?>(<?= $dt_jabatan_atasan->nama_role_agen_lengkap?>)
                            </option>
                            <?php

                        }
                    } else if($this->session->userdata('nama_level')!="administrator"){
                        foreach ($dt_atasan->result() as $id=>$dta){
                            if($dta->id_agen==$this->session->userdata("id_user")){
                                ?>
                                <option value="<?= $dta->id_agen;?>">
                                    <?= $dta->nama_agen;?> (<?= $dt_jabatan_atasan->nama_role_agen_lengkap?>)
                                </option>
                                <?php
                            }
                        }
                    }
                }

            }


        }


    }

    public function v($role = "", $id = '', $aksi = '', $status = '', $pemda = '')
    {
        //echo $role; die;
//        echo $id;
//        echo $role."<br>"; die;
//        echo hashids_decrypt($id);
//        die;


        $id = hashids_decrypt($id);
//        echo $id;die;
//        echo $id."<br>";
//        echo $role; die;
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');


        if ($aksi != 't') {

            //$this->session->set_flashdata('msg','');

        }

        if (!isset($ceks)) {
            redirect('web/login');
        }

        /*tambahan dari sini*/
        $tbl_zona = $this->db->get_where('tbl_zona', array('id_zona' => $_SESSION['id_zona']));
        $data['user_bk'] = $this->Mcrud->get_users_by_un($ceks);
        $data['user']   	 = $this->Mcrud->get_users_by_un_tbl_agen($ceks);
        //echo "<pre>"; print_r($data['user']->result()); die;
        $data['users'] = $this->Mcrud->get_users();
        $data['nama_panjang_admin'] = $tbl_zona->row()->nama_panjang;
        $data['zona_pemda'] = $tbl_zona->row()->nama_zona;

        /*sampai sini */

        $data['user_bk2'] = $this->Mcrud->get_users_by_un($ceks);
        $data['user']   	 = $this->Mcrud->get_users_by_un_tbl_agen($ceks);

        //baris berikut menangkap seluruh data yang akan tampil di tabel tiap daerah pengajuan draft harmonisasi
//        echo $id; die;

        if($this->session->userdata('nama_level')=="administrator"){
            //echo $id; die;
            //echo "disini tampilkan seluruh data agen dgn berdasarkan kategori agen";
            $data['query'] = $this->db->get_where("tbl_agen",
                array(
                        "role_agen_id"=>$id
                )
            );
            //echo "<pre>";print_r($data['query']->result()); die;
        } else if($this->session->userdata('nama_level')!="administrator"){
            //echo "disini tampilkan seluruh data agen dgn berdasarkan kategori agen beserta user penginput";
            $data['query'] = $this->db->get_where("tbl_agen",
                array(
                    "role_agen_id"=>$id,
                    "sponsor_atasan"=>$this->session->userdata('id_user')
                )
            );

        }

        //die;



        //echo "<pre>"; print_r($data['query']->result()); die;

        $cek_nama_panjang_agen = $this->db->get_where("tbl_role_agen", array("id_role_agen" => $id));


//        echo "<pre>"; print_r($cek_nama_panjang_zona->result());die;

        $data['judul_web'] = "Data Agen " . ($cek_nama_panjang_agen->result()[0]->nama_role_agen_lengkap);
        $data['nama_role_agen'] = ($cek_nama_panjang_agen->result()[0]->nama_role_agen);
        //echo $data['nama_role_agen']; die;
        $data['id_role_agen'] = $id;
        //echo $data['id_role_agen']; die;
        $data['cek_nama_panjang_zona'] = $cek_nama_panjang_zona;


        if ($status == 'belum_diproses' or $status == 'perbaikan' or $status == 'draft_sedang_dibuat' or $status == 'sedang_diproses' or $status == 'menunggu_koreksi' or $status == 'selesai') {
            $this->db->where('status', $status);
            $this->db->where('zona_dokumen', $zona);
            $this->db->order_by('id_draft_permohonan', 'DESC');
            $data['query'] = $this->db->get("tbl_draft");
        } else if ($status == 'semua') {
            redirect("pemda/draft/" . $zona);
        }


        $cek_notif = $this->db->get_where("tbl_notif", array('penerima' => "$id_user"));
        foreach ($cek_notif->result() as $key => $value) {
            $b_notif = $value->baca_notif;
            if (!preg_match("/$id_user/i", $b_notif)) {
                $data_notif = array('baca_notif' => "$id_user, $b_notif");
                $this->db->update('tbl_notif', $data_notif, array('penerima' => $id_user));
            }
        }


        //awal dari seluruh if pd function ini
        if ($aksi == 't') {
//            echo "aksi T";die;
//			    echo $zona; die;
//			    echo "tes"; die;
//				if ($level!='pelaksana') {
//					redirect('404');
//				}

            $p = "tambah_draft";
            $data['judul_web'] = "TAMBAH DRAFT RAPERDA " . strtoupper($cek_nama_panjang_zona->result()[0]->nama_panjang);
        } else if ($aksi == 't_agen') {

            //echo "t_agen"; die;
            $p = "tambah";
            //echo $id; die;
            $exp_role = explode("%20", $role);

            $get_tbl_role_agen = $this->db->get_where("tbl_role_agen", array("id_role_agen" => $id))->row();
            $data['nama_role_agen'] = $get_tbl_role_agen->nama_role_agen;
            $data['nama_role_agen_lengkap'] = $get_tbl_role_agen->nama_role_agen_lengkap;
            $data['id_role_agen'] = $get_tbl_role_agen->id_role_agen;
            $data['session_level'] = $this->session->userdata('level');
            $data['judul_web'] = "Tambah Data " . $get_tbl_role_agen->nama_role_agen_lengkap;
//            echo $data['id_role_agen']; die;

//            echo  $data['nama_role_agen']."<br>";
//            echo  hashids_encrypt($data['id_role_agen']); die;

        } elseif ($aksi == 'd') {
            $p = "detail";
            $data['judul_web'] = "RINCIAN BAHAN BERITA";
            $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => "$id"))->row();
            if ($data['query']->id_berita == '') {
                redirect('404');
            }

            $data['cek_notif'] = $this->db->get_where("tbl_notif", array('penerima' => "$id_user", 'id_berita' => "$id"))->row();

            $b_notif = $data['cek_notif']->baca_notif;
            if (!preg_match("/$id_user/i", $b_notif)) {
                $data_notif = array('baca_notif' => "$id_user, $b_notif");
                $this->db->update('tbl_notif', $data_notif, array('penerima' => $id_user, 'id_berita' => "$id"));
            }
        }
        else if ($aksi == 'e_agen') {
            //echo $role;die;
           // echo "edit agen"; die;
//            $role,$id, $status
            //echo hashids_encrypt($id);die;
            //echo ($status);die;
//            echo $role."<br>";
//            echo $id."<br>";

//            echo hashids_encrypt($status)."<br>";
//            die;
//            die;
//            echo "edit agen";
//            die;
            //echo $id; die;

            $p = "edit_agen";
            $data['judul_web'] = "Edit Data Agen";
            $get_tb_role_agens = $this->db->get_where("tbl_role_agen",
                array(
                    "id_role_agen" => $status
                ))->row();
            $data["nama_role_agen_lengkap"] = $get_tb_role_agens->nama_role_agen_lengkap;
            $data["role"] = $role;
            //echo $role; die;



            //echo $role; die;
            if ($role == "baitullah_mujahid") {
                $get_id_atasan = $this->db->get_where("tbl_agen",
                    array(
                        "id_agen"=>$id
                    ))->row()->sponsor_atasan;
                $data_atasan = $this->db->get_where("tbl_agen",
                    array(
                        "id_agen" => $get_id_atasan
                    ));

                $get_role_id_atasan = $this->db->get_where("tbl_agen",
                    array(
                            "id_agen"=>$get_id_atasan
                    ))->row()->role_agen_id;

                $data["data_atasan"] = $this->db->get_where("tbl_agen",
                    array(
                            "role_agen_id"=>$get_role_id_atasan
                    ));

                //echo "<pre>" ; print_r($data["data_atasan"]->result());die;
            } else if ($role == "manajer_mujahid") {
                $get_id_atasan = $this->db->get_where("tbl_agen",
                    array(
                        "id_agen"=>$id
                    ))->row()->sponsor_atasan;
                $data_atasan = $this->db->get_where("tbl_agen",
                    array(
                        "id_agen" => $get_id_atasan
                    ));

                $get_role_id_atasan = $this->db->get_where("tbl_agen",
                    array(
                        "id_agen"=>$get_id_atasan
                    ))->row()->role_agen_id;

                $data["data_atasan"] = $this->db->get_where("tbl_agen",
                    array(
                        "role_agen_id"=>$get_role_id_atasan
                    ));
            } else if ($role == "direktur_mujahid") {
                $get_id_atasan = $this->db->get_where("tbl_agen",
                    array(
                        "id_agen"=>$id
                    ))->row()->sponsor_atasan;
                $data_atasan = $this->db->get_where("tbl_agen",
                    array(
                        "id_agen" => $get_id_atasan
                    ));

                $get_role_id_atasan = $this->db->get_where("tbl_agen",
                    array(
                        "id_agen"=>$get_id_atasan
                    ))->row()->role_agen_id;

                $data["data_atasan"] = $this->db->get_where("tbl_agen",
                    array(
                        "role_agen_id"=>$get_role_id_atasan
                    ));
            } else if ($role == "presiden_direktur") {
                $data["data_atasan"] = $this->db->get_where("tbl_user",
                    array(
                        "level" => "superadmin"
                    ));
            }
            $data['query'] = $this->db->get_where("tbl_agen",
                array(
                        'id_agen' => "$id"
                ))->row();
        } else if ($aksi == 'e') {
            if ($pemda == 'pemprov_ntb') {
//                    echo "edit dokumen pemprov ntb";
//                    echo "<br>id:".$id; die;
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMPROV NTB";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if ($pemda == 'pemkot_mataram') {
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKOT MATARAM";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if ($pemda == 'pemkot_bima') {
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKOT BIMA";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if ($pemda == 'pemkab_sumbawa_barat') {
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB SUMBAWA BARAT";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if ($pemda == 'pemkab_sumbawa') {
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB SUMBAWA";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if ($pemda == 'pemkab_lombok_utara') {
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK UTARA";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if ($pemda == 'pemkab_lombok_timur') {
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK TIMUR";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if ($pemda == 'pemkab_lombok_tengah') {
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK TENGAH";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if ($pemda == 'pemkab_lombok_barat') {
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK BARAT";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if ($pemda == 'pemkab_dompu') {
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB DOMPU";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if ($pemda == 'pemkab_bima') {
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB BIMA";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            }

        } else if ($aksi == 'se') {
            if (!isset($ceks)) {
                redirect('web/login');
            }

            $id_draft_permohonan_edit = htmlentities(strip_tags($this->input->post('id_draft_permohonan_edit')));
            $judul_draft_permohonan_edit = htmlentities(strip_tags($this->input->post('judul_draft_permohonan_edit')));
            $jenis_dokumen_edit = htmlentities(strip_tags($this->input->post('jenis_dokumen_edit')));

            $cek_data = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan_edit));

            $surat_permohonan_old = $cek_data->row()->lamp_surat_permohonan;
            $data_lama_url_data_dukung = $cek_data->row()->url_data_dukung;


            $max_size = 1024 * 5;
            $lokasi = 'file/bahan_draft_raperda';
            $this->upload->initialize(array(
                "upload_path" => "./$lokasi",
                "allowed_types" => "*",
                "max_size" => $max_size
            ));

            if (!is_dir($lokasi)) {
                # jika tidak maka folder harus dibuat terlebih dahulu
                mkdir($lokasi, 0777, $rekursif = true);
            }

            //MENANGKAP data dari inputan file 'lamp_surat_permohonan_edit'

            if (!$this->upload->do_upload('lamp_surat_permohonan_edit')) {
//                    echo "tidak upload data maka gunakan DATA LAMA";die;
                $lamp_surat_permohonan = $surat_permohonan_old;
                $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                $simpan = 'n';

            } else {
//                    echo "upload data maka gunakan DATA BARU";die;
                $gbr = $this->upload->data();
                $filename = "$lokasi/" . $gbr['file_name'];
                $lamp_surat_permohonan = preg_replace('/ /', '_', $filename);

                try {
                    unlink($surat_permohonan_old);
                } catch (Exception $e) {
                    echo json_encode($e);
                }

                $simpan = 'y';
            }
//                echo $lamp_surat_permohonan; die;

            //berikutnya MENANGKAP lampiran post 'url_files_edit'
//            echo $_FILES['url_files_edit']; die;
            if ($_FILES['url_files_edit']['name'][0] == null) {
                $count_edit = 0;
            } else {
                $count_edit = count($_FILES['url_files_edit']['name'][0]);
            }

//                echo $count_edit; die;


            if ($count_edit != 0) {

                for ($i = 0; $i < $count_edit; $i++) {
                    if (!empty($_FILES['url_files_edit']['name'][$i])) {
                        $_FILES['file']['name'] = $_FILES['url_files_edit']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['url_files_edit']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['url_files_edit']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['url_files_edit']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['url_files_edit']['size'][$i];

                        if (!$this->upload->do_upload('file')) {
                            $simpan = 'n';
                            $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                        } else if ($this->upload->do_upload('file')) {
                            $gbr = $this->upload->data();
                            $filename = "$lokasi/" . $gbr['file_name'];
                            $url_file[$i] = preg_replace('/ /', '_', $filename);
                            $simpan = 'y';
                        }
                    }
                }
                $file_lama = json_decode($data_lama_url_data_dukung == 'null' ? "[]" : $data_lama_url_data_dukung);
                $url_data_dukung = json_encode(array_merge($file_lama, $url_file));
            } else {
                $url_data_dukung = $data_lama_url_data_dukung;
                $simpan = 'y';
            }

//                echo $url_data_dukung; die;

            if ($simpan == 'y') {
//                    echo "tes simpanz"; die;
                $data = array(
                    'nama_draft_permohonan' => $judul_draft_permohonan_edit,
                    'jenis_dokumen' => $jenis_dokumen_edit,
                    'tgl_update' => date('Y-m-d H:i:s'),
                    'lamp_surat_permohonan' => $lamp_surat_permohonan,
                    'url_data_dukung' => $url_data_dukung
                );


                $this->db->update('tbl_draft', $data, array('id_draft_permohonan' => $id_draft_permohonan_edit));
                $this->session->set_flashdata('msg',
                    '
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Sukses!</strong> Berhasil disimpan.
					</div>
				<br>'
                );
            } else {
                $this->session->set_flashdata('msg',
                    '
					<div class="alert alert-warning alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
						 <strong>Gagal!</strong> ' . $pesan . '.
					</div>
				 <br>'
                );
            }

            redirect('pemda/v/' . $id);

        } else if ($aksi == 'ce') {
            //echo "edit draft by pemda"; die;
            $id_draft_permohonan = hashids_decrypt($status);
//            echo $id_draft_permohonan; die;
            $p = "edit_draft";
            $dt_tbl_berita = $this->db->get_where("tbl_berita", array('id_draft' => $id_draft_permohonan))->row();
            $status = $dt_tbl_berita->status;

            $data['edit_draft'] = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan));
            $data['id_draft_permohonan'] = $id_draft_permohonan;
            $data['status'] = $status;
            $data['dt_tbl_berita'] = $dt_tbl_berita;


            //edited 29-09-2023

            $data['pemda'] = $pemda;

            //$zona_doc = explode('_',$pemda);
            $zona_doc = explode('_', $zona);
            //echo sizeof($zona_doc); die;
            if (sizeof($zona_doc) == 2) {

                $zona_document = strtoupper($zona_doc[0]) . " " . strtoupper($zona_doc[1]);
            } else {
                $zona_document = strtoupper($zona_doc[0]) . " " . strtoupper($zona_doc[1]) . " " . strtoupper($zona_doc[2]);

            }
            //echo $zona_document; die;

            $data['judul_web'] = "EDIT DRAFT PERMOHONAN " . strtoupper($zona_document);
            //echo $zona_document; die;
            $cek_data = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan));


        } else if ($aksi == 'ce_kasub_perancang') {
            /*LANJUT DISINI BRO untuk part KASUB PERANCANG*/
            $id_draft_permohonan = hashids_decrypt($status);
//            echo $id_draft_permohonan;die;
            $p = "edit_proses_kasub_perancang";

            $dt_tbl_berita = $this->db->get_where("tbl_berita", array('id_draft' => $id_draft_permohonan))->row();
            $status = $dt_tbl_berita->status;

            $data['edit_draft'] = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan));
            $data['id_draft_permohonan'] = $id_draft_permohonan;
            $data['status'] = $status;
            $data['dt_tbl_berita'] = $dt_tbl_berita;

            $data['pemda'] = $pemda;


            $zona_doc = explode('_', $pemda);
            $zona_document = $zona_doc[1] . " " . $zona_doc[2];
            $data['judul_web'] = "PROSES DRAFT PERMOHONAN " . strtoupper($zona_document);
            $cek_data = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan));


        } else if ($aksi == 'ce_perancang') {
            $id_draft_permohonan = hashids_decrypt($status);
            $p = "edit_proses_perancang";
//            echo $id_draft_permohonan; die;

            $data['edit_draft'] = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan));
            $data['id_draft_permohonan'] = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan));
            $data['tbl_berita_by_draft_id'] = $this->db->get_where("tbl_berita", array('id_draft' => $id_draft_permohonan));

            $data['pemda'] = $pemda;


            $zona_doc = explode('_', $pemda);

            if ($zona_doc[3] != "") {
                $zona_document_strip = $zona_doc[1] . "_" . $zona_doc[2] . "_" . $zona_doc[3];
                $zona_document = $zona_doc[1] . " " . $zona_doc[2] . " " . $zona_doc[3];
            } else if ($zona_doc[3] == "") {
                $zona_document_strip = $zona_doc[1] . "_" . $zona_doc[2];
                $zona_document = $zona_doc[1] . " " . $zona_doc[2];
            }

//                $zona_document_strip =  $zona_doc[1]."_".$zona_doc[2];
//                $zona_document =  $zona_doc[1]." ".$zona_doc[2];


            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get_where("tbl_berita", array("zona_dokumen" => $zona_document));
            /*tabel ny di select belakangan*/
//                $p = "pemprov_ntb";
//                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMPROV NTB";
//                $data['edit_berita'] = $this->db->get_where("tbl_berita", array('zona_dokumen' => $zona_document_strip));

            $data['judul_web'] = "PROSES DRAFT PERMOHONAN " . strtoupper($zona_document);
            $cek_data = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan));


        } else if ($aksi == 'h_agen') {
            //echo hashids_encrypt($status);die;
            //echo $role; die;
            //echo "hapus agen"; die;
            //echo $id; die;
            $cek_data = $this->db->get_where("tbl_agen",
                array(
                    "id_agen" => $id,
                ));
            if ($cek_data->num_rows() != 0) {
                if ($cek_data->row()->lamp_ttd_agen != "") {
                    $data_lamp_ttd = $cek_data->row()->lamp_ttd_agen;
                    echo $data_lamp_ttd;
                    //die;
                    try {
                        unlink($data_lamp_ttd);
                    } catch (Exception $e) {
                        echo json_encode($e);
                    }
                }
                //die;
                $this->db->delete("tbl_agen",
                    array(
                        'id_agen' => $id
                    ));
                $this->session->set_flashdata('msg',
                    '
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Sukses!</strong> Data Agen Berhasil dihapus.
								</div>
								<br>'
                );
                redirect("agen/v/" . $role . "/" . hashids_encrypt($status));
            } else {
                redirect('404');
            }
        } else if ($aksi == 'h') {
            //echo "cek hapus"; die;
            if (!isset($ceks)) {
                redirect('web/login');
            }
            //echo "hapus"; die;

            $id_draft_permohonan = $this->input->post('id_draft_permohonan');
            //echo $id_draft_permohonan; die;
            /*lets check*/
            $cek_data = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan));
            $cek_data_tbl_berita = $this->db->get_where("tbl_berita", array('id_draft' => $id_draft_permohonan));

            //echo sizeof($cek_data)."<br>";
            //echo sizeof($cek_data_tbl_berita); die;

            $lamp_surat_permohonan_old = $cek_data->row()->lamp_surat_permohonan;
            $lamp_draft_harmonisasi_old = $cek_data->row()->draft_harmonisasi;
            $lamp_naskah_akademik_dll_old = $cek_data->row()->naskah_akademik_dll;
            $url_data_dukung = $cek_data->row()->url_data_dukung;
            $files = json_decode($url_data_dukung, true);

//                echo $lamp_surat_permohonan_old; die;
//                foreach ($files as $key=>$file){
//                    echo $file; die;
//                }
//                var_dump($files);die;


            //delete record yang di tbl_berita
            if ($cek_data_tbl_berita->num_rows() != 0) {
                $this->db->delete('tbl_berita', array('id_draft' => $id_draft_permohonan));
            }

            //delete record yang di tbl_draft
            if ($cek_data->num_rows() != 0) {

                try {
                    unlink($lamp_surat_permohonan_old);
                } catch (Exception $e) {
                    echo json_encode($e);
                }

                try {
                    unlink($lamp_draft_harmonisasi_old);
                } catch (Exception $e) {
                    echo json_encode($e);
                }

                if ($cek_data->row()->naskah_akademik_dll != null || $cek_data->row()->naskah_akademik_dll != "null" || $cek_data->row()->naskah_akademik_dll != "") {
                    try {
                        unlink($lamp_naskah_akademik_dll_old);
                    } catch (Exception $e) {
                        echo json_encode($e);
                    }
                }


                if ($cek_data->row()->url_data_dukung != null || $cek_data->row()->url_data_dukung != "null" || $cek_data->row()->url_data_dukung != "") {
                    foreach ($files as $key => $file) {
                        try {
                            unlink($file);
                        } catch (Exception $e) {
                            echo json_encode($e);
                        }
                    }
                }


                $this->db->delete('tbl_draft', array('id_draft_permohonan' => $id_draft_permohonan));


                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses1!</strong> Berhasil dihapus.
							</div>
							<br>'
                );

                redirect("pemda/draft/" . $zona);

            } else {

                redirect('404_content');
            }


        } else if ($aksi == 'df') {
            $id_draft_permohonan_update = $this->input->post('id');
            $cek_data = $this->db->get_where('tbl_draft', array('id_draft_permohonan' => $id_draft_permohonan_update));
            if (!isset($ceks)) {
                redirect('web/login');
            }

            try {
                $path = $this->input->post('path');

                if (unlink($path)) {
                    $file = json_decode($cek_data->row()->url_data_dukung);
//                    var_dump($file); die;
//                    unset($file[$this->input->post('file_id')]);
                    unset($file[$this->input->post('file_id')]);

                    $data = array(
//                            'nama' => $cek_data['nama'],
//                            'tempat' => $cek_data['tempat'],
//                            'tanggal' => $cek_data['tanggal'],
//                            'peserta' => $cek_data['peserta'],
//                            'why' => $cek_data['why'],
//                            'deskripsi' => $cek_data['deskripsi'],
//                            'url_data_dukung' => json_encode(count($file)>0?$file:null),

                        'nama_draft_permohonan' => $cek_data->row()->nama_draft_permohonan,
                        'tgl_input' => $cek_data->row()->tgl_input,
                        'status' => $cek_data->row()->status,
                        'lamp_surat_permohonan' => $cek_data->row()->lamp_surat_permohonan,
                        'url_data_dukung' => json_encode(count($file) > 0 ? $file : null),
                        'id_user' => $this->session->userdata('id_user'),
                        'jenis_dokumen' => $cek_data->row()->jenis_dokumen,
                        'zona_dokumen' => $cek_data->row()->zona_dokumen,
                        'tgl_update' => date('Y-m-d H:i:s')
                    );

//                        $this->Guzzle_model->updateAgenda($id_draft_permohonan_update, $data);
                    $this->db->update('tbl_draft', $data, array('id_draft_permohonan' => $id_draft_permohonan_update));
                    $this->session->set_flashdata('msg',
                        '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil update.
							</div>
							<br>'
                    );
                } else {
                    $this->session->set_flashdata('msg',
                        '
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> ' . " upload data!" . '.
	 							</div>
	 						 <br>'
                    );
                }
//                    echo "success : " . json_encode($file);
                redirect("pemda/v/ce/" . $id_draft_permohonan_update . "/draft_pemprov_ntb");

            } catch (Exception $e) {
                echo json_encode($e);
            }

        } else {
            $p = "index";
//            $data['judul_web'] 	  = "Bahan Berita";
        }

        /*disini ending function v*/
        $this->load->view('users/header', $data);
        $this->load->view("users/agen/$p", $data);
        $this->load->view('users/footer');

        date_default_timezone_set('Asia/Singapore');
        $tgl = date('Y-m-d H:i:s');


        $max_size = 1024 * 10;
        $lokasi = 'file/data_ttd_agen';
        $this->upload->initialize(array(
            "upload_path" => "./$lokasi",
            "allowed_types" => "*",
            "max_size" => $max_size
        ));

        if (isset($_POST['btnupdate_agen'])) {
            /*ASLII*/
            //echo $role."<br>";die;
//            echo $id."<br>";
//            echo ($status)."<br>";die;
//            die;
            //echo $id; die;
            // echo "btnupdate_agen";die;
            //cuki
            $id_agen = htmlentities(strip_tags($this->input->post('id_agen_edit')));
            $nama_agen_edit = htmlentities(strip_tags($this->input->post('nama_agen_edit')));
            $tempat_lahir_edit = htmlentities(strip_tags($this->input->post('tempat_lahir_edit')));
            $tgl_lahir_edit = htmlentities(strip_tags($this->input->post('tgl_lahir_edit')));
            $jenis_kelamin_edit = htmlentities(strip_tags($this->input->post('jenis_kelamin_edit')));
            $no_ktp_edit = htmlentities(strip_tags($this->input->post('no_ktp_edit')));
            $alamat_lengkap_edit = htmlentities(strip_tags($this->input->post('alamat_lengkap_edit')));
            $kota_edit = htmlentities(strip_tags($this->input->post('kota_edit')));
            $kecamatan_edit = htmlentities(strip_tags($this->input->post('kecamatan_edit')));
            $kelurahan_edit = htmlentities(strip_tags($this->input->post('kelurahan_edit')));
            $provinsi_edit = htmlentities(strip_tags($this->input->post('provinsi_edit')));
            $kode_pos_edit = htmlentities(strip_tags($this->input->post('kode_pos_edit')));
            $email_edit = htmlentities(strip_tags($this->input->post('email_edit')));
            $no_hp_edit = htmlentities(strip_tags($this->input->post('no_hp_edit')));
            $nama_bank_edit = htmlentities(strip_tags($this->input->post('nama_bank_edit')));
            $cabang_bank_edit = htmlentities(strip_tags($this->input->post('cabang_bank_edit')));
            $no_rekening_edit = htmlentities(strip_tags($this->input->post('no_rekening_edit')));
            $pemilik_rekening_edit = htmlentities(strip_tags($this->input->post('pemilik_rekening_edit')));
            $jabatan_edit = htmlentities(strip_tags($this->input->post('jabatan_edit')));
            $sponsor_edit = htmlentities(strip_tags($this->input->post('sponsor_edit')));
            $nama_ahli_waris_edit = htmlentities(strip_tags($this->input->post('nama_ahli_waris_edit')));
            $hub_dgn_ahli_waris_edit = htmlentities(strip_tags($this->input->post('hub_dgn_ahli_waris_edit')));
            $no_hp_ahli_waris_edit = htmlentities(strip_tags($this->input->post('no_hp_ahli_waris_edit')));
            $user_id = $this->session->userdata('id_user');
            $tgl_update = date('Y-m-d H:i:s');
            $username_agen = htmlentities(strip_tags($this->input->post('username_agen')));
            $password_agen = htmlentities(strip_tags($this->input->post('password_agen')));
            $cabang_id = htmlentities(strip_tags($this->input->post('cabang_id')));

            $cek_data = $this->db->get_where("tbl_agen",
                array(
                        'id_agen' => $id_agen
                ))->row();

            $dt_lama_pass_agen = $cek_data->password;
            $dt_lama_username_agen = $cek_data->username;
            //echo $dt_lama_pass_agen; die;

            if($dt_lama_pass_agen==$password_agen){
                echo "password yg diinput sama dgn di DB";
                $password_to_save = $dt_lama_pass_agen;
            } else if($dt_lama_pass_agen!=$password_agen){
                $password_to_save = crypt($password_agen,"salt-coba");
            }
            //die;



            $data_lama_lampiran_ttd = $cek_data->lamp_ttd_agen;
            /*untuk update data lamp_ttd_pict dari sini*/
            if (!$this->upload->do_upload('lamp_ttd_pict')) {
//                    echo "tidak upload data maka gunakan DATA LAMA";die;
                $lamp_ttd_agen_to_save = $data_lama_lampiran_ttd;
                $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                $simpan = 'n';

            } else {
//                    echo "upload data maka gunakan DATA BARU";die;
                $gbr = $this->upload->data();
                $filename = "$lokasi/" . $gbr['file_name'];
                $lamp_ttd_agen_to_save = preg_replace('/ /', '_', $filename);
                $simpan = 'y';

                try {
                    unlink($data_lama_lampiran_ttd);
                } catch (Exception $e) {
                    echo json_encode($e);
                }

                $simpan = 'y';
            }




//            echo $id_agen . "<br>";
//
//            echo $nama_agen_edit . "<br>";
//            echo $tempat_lahir_edit . "<br>";
//            echo $tgl_lahir_edit . "<br>";
//            echo $jenis_kelamin_edit . "<br>";
//            echo $no_ktp_edit . "<br>";
//            echo $alamat_lengkap_edit . "<br>";
//            echo $kota_edit . "<br>";
//            echo $kecamatan_edit . "<br>";
//            echo $kelurahan_edit . "<br>";
//            echo $provinsi_edit . "<br>";
//            echo $kode_pos_edit . "<br>";
//            echo $email_edit . "<br>";
//            echo $no_hp_edit . "<br>";
//            echo $nama_bank_edit . "<br>";
//            echo $cabang_bank_edit . "<br>";
//            echo $no_rekening_edit . "<br>";
//            echo $pemilik_rekening_edit . "<br>";
//            echo $jabatan_edit . "<br>";
//            echo $sponsor_edit . "<br>";
//            echo $nama_ahli_waris_edit . "<br>";
//            echo $hub_dgn_ahli_waris_edit . "<br>";
//            echo $no_hp_ahli_waris_edit . "<br>";
//            echo $user_id . "<br>";
//            echo $tgl_update . "<br>";
//            echo $lamp_ttd_agen_to_save . "<br>";
//            echo $cabang_id . "<br>";
//
//            echo strtolower($this->uri->segment(6));
//
//            die;


            //echo "size array cek lengkap edit : ".sizeof($array_cek_lengkap_edit)."<br>";


            //die;

            $pesan = '';
            $status_respon = '';
            $simpan = 'y';


            if($dt_lama_username_agen== $username_agen){
                $username_to_save = $dt_lama_username_agen;
            } else if($dt_lama_username_agen!= $username_agen){
                $cek_data_by_username = $this->db->get_where("tbl_agen",array("username"=>$username_agen));

                if($cek_data_by_username->num_rows() >= 1){
                    $simpan = 'n';
                    $pesan= "username <b>$username_agen</b> sudah digunakan";
                    //echo $cek_data_by_username->num_rows();
                } else if($cek_data_by_username->num_rows() < 1) {
                    $simpan = 'y';
                    //echo $cek_data_by_username->num_rows();
                }
            }


            //echo $simpan ;
            //die;


            //echo "simpan : ". $simpan; die;

            if ($simpan == 'y') {
                //echo $pilihan_paket; die;

                $data_agen_to_update = array(

                    'nama_agen' => $nama_agen_edit,
                    'username' => $username_agen,
                    'password' => $password_to_save,
                    'tempat_lahir' => $tempat_lahir_edit,
                    'tgl_lahir' => $tgl_lahir_edit,
                    'jenis_kelamin' => $jenis_kelamin_edit,
                    'no_ktp' => $no_ktp_edit,
                    'alamat_lengkap' => $alamat_lengkap_edit,
                    'kota' => $kota_edit,
                    'kecamatan' => $kecamatan_edit,
                    'kelurahan' => $kelurahan_edit,
                    'provinsi' => $provinsi_edit,
                    'kode_pos' => $kode_pos_edit,
                    'email' => $email_edit,
                    'no_hp' => $no_hp_edit,
                    'nama_bank' => $nama_bank_edit,
                    'cabang_bank' => $cabang_bank_edit,
                    'no_rekening' => $no_rekening_edit,
                    'pemilik_rekening' => $pemilik_rekening_edit,
                    'jabatan' => $jabatan_edit,
                    'sponsor_atasan' => $sponsor_edit,
                    'nama_ahli_waris' => $nama_ahli_waris_edit,
                    'hub_dgn_ahli_waris' => $hub_dgn_ahli_waris_edit,
                    'no_hp_ahli_waris' => $no_hp_ahli_waris_edit,
                    'user_id' => $user_id,
                    'tgl_update' => $tgl_update,
                    'lamp_ttd_agen' => $lamp_ttd_agen_to_save,

                    'role_agen_id' => $jabatan_edit,
                    'cabang_id' => $cabang_id,
                );




                $this->db->update('tbl_agen', $data_agen_to_update,
                    array(
                            'id_agen' => $id_agen
                    ));

                $this->session->set_flashdata('msg',
                    '
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Sukses!</strong> Data Agen Berhasil Diubah.
								</div>
							  <br>'
                );

            } else {
                $this->session->set_flashdata('msg',
                    '
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Gagal!</strong> ' . $pesan . '.
											</div>
										 <br>'
                );
                /*cekrok*/
//                redirect("agen/v/".$role."/" );
                redirect("agen/v/".$role."/".hashids_encrypt($id)."/e_agen/".$status );
            }

            redirect("agen/v/".$role."/".$status);

        }

        if (isset($_POST['btnsimpan_update'])) {
            //echo $zona;die;
//            echo $id_draft_permohonan;die;
            //echo "btnsimpan_update pemda"; die;
            //output dari yg diatas 'pemprov_ntb'
            $zona_doc = explode('_', $zona);


            //lets edit


            $zona_doc = explode('_', $zona);
            //echo $zona; die;
            //echo sizeof($zona_doc); die;
            if (sizeof($zona_doc) == 2) {

                $zona_document = $zona_doc[0] . " " . $zona_doc[1];
            } else {
                $zona_document = $zona_doc[0] . " " . $zona_doc[1] . " " . $zona_doc[2];

            }

//            echo $zona_document_strip; die;

            if (!isset($ceks)) {
                redirect('web/login');
            }

            if (!is_dir($lokasi)) {
                # jika tidak maka folder harus dibuat terlebih dahulu
                mkdir($lokasi, 0777, $rekursif = true);
            }

            //DARI SINI
//                    echo $_FILES['url_files']['name'];die;
            if ($_FILES['url_files']['name'][0] == null) {

                $count_edit = 0;
            } else {
                $count_edit = count($_FILES['url_files']['name']);
            }

            $nama_draft = htmlentities(strip_tags($this->input->post('nama_draft')));
            $jenis_dokumen = htmlentities(strip_tags($this->input->post('jenis_dokumen')));
            $simpan = '';


            $cek_data = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan))->row();
            $data_lama_url_data_dukung = $cek_data->url_data_dukung;
            $data_lama_lamp_surat_permohonan = $cek_data->lamp_surat_permohonan;
            $data_lama_draft_harmonisasi = $cek_data->draft_harmonisasi;
            $data_lama_naskah_akademik = $cek_data->naskah_akademik_dll;
            $data_id_user = $cek_data->id_user;
            $status = $cek_data->status;
//            echo $status;die;
//            echo $data_id_user;die;


            if ($count_edit != 0) {

                for ($i = 0; $i < $count_edit; $i++) {
                    if (!empty($_FILES['url_files']['name'][$i])) {
                        $_FILES['file']['name'] = $_FILES['url_files']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['url_files']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['url_files']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['url_files']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['url_files']['size'][$i];

                        if (!$this->upload->do_upload('file')) {
                            $simpan = 'n';
                            $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                        } else {
                            $gbr = $this->upload->data();
                            $filename = "$lokasi/" . $gbr['file_name'];
                            $url_file[$i] = preg_replace('/ /', '_', $filename);
                            $simpan = 'y';
                        }
                    }
                }
//                echo $url_file;die;
                $file_lama = json_decode($data_lama_url_data_dukung == 'null' ? "[]" : $data_lama_url_data_dukung);
                $url_data_dukung = json_encode(array_merge($file_lama, $url_file));
            } else {
                $url_data_dukung = $data_lama_url_data_dukung;
                $simpan = 'y';
            }


            if (!$this->upload->do_upload('lamp_surat_permohonan_edit')) {
//                    echo "tidak upload data maka gunakan DATA LAMA";die;
                $lamp_surat_permohonan = $data_lama_lamp_surat_permohonan;
                $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
//                $simpan = 'n';

            } else {
//                    echo "upload data maka gunakan DATA BARU";die;
                $gbr = $this->upload->data();
                $filename = "$lokasi/" . $gbr['file_name'];
                $lamp_surat_permohonan = preg_replace('/ /', '_', $filename);

                try {
                    unlink($data_lama_lamp_surat_permohonan);
                } catch (Exception $e) {
                    echo json_encode($e);
                }

                $simpan = 'y';
            }

            /*untuk update data draft_harmonisasi_edit dari sini*/
            if (!$this->upload->do_upload('draft_harmonisasi_edit')) {
//                    echo "tidak upload data maka gunakan DATA LAMA";die;
                $lamp_draft_harmonisasi = $data_lama_draft_harmonisasi;
                $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
//                $simpan = 'n';

            } else {
//                    echo "upload data maka gunakan DATA BARU";die;
                $gbr = $this->upload->data();
                $filename = "$lokasi/" . $gbr['file_name'];
                $lamp_draft_harmonisasi = preg_replace('/ /', '_', $filename);

                try {
                    unlink($data_lama_draft_harmonisasi);
                } catch (Exception $e) {
                    echo json_encode($e);
                }

                $simpan = 'y';
            }
            /*sampai sini*/

            /*untuk update data naskah_akademik_edit dari sini*/
            if (!$this->upload->do_upload('naskah_akademik_edit')) {
//                    echo "tidak upload data maka gunakan DATA LAMA";die;
                $lamp_naskah_akademik_harmonisasi = $data_lama_naskah_akademik;
                $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
//                $simpan = 'n';

            } else {
//                    echo "upload data maka gunakan DATA BARU";die;
                $gbr = $this->upload->data();
                $filename = "$lokasi/" . $gbr['file_name'];
                $lamp_naskah_akademik_harmonisasi = preg_replace('/ /', '_', $filename);

                try {
                    unlink($data_lama_naskah_akademik);
                } catch (Exception $e) {
                    echo json_encode($e);
                }

                $simpan = 'y';
            }
            /*sampai sini*/


            /*disini lets edit*/
            $cek_data_tbl_berita = $this->db->get_where("tbl_berita", array('id_draft' => $id_draft_permohonan));
            //echo $cek_data_tbl_berita->lamp_surat_undangan;die;
            $lamp_surat_harmonisasi = $cek_data_tbl_berita->row()->lamp_surat_undangan;
            //echo "zona document : ".$zona; die;

            //echo "zona doc : ". $zona; die;
            if ($simpan == 'y') {
                $data = array(
                    'nama_draft_permohonan' => $nama_draft,
                    'jenis_dokumen' => $jenis_dokumen,
                    'tgl_update' => date('Y-m-d H:i:s'),
                    'lamp_surat_permohonan' => $lamp_surat_permohonan,
                    'draft_harmonisasi' => $lamp_draft_harmonisasi,
                    'url_data_dukung' => $url_data_dukung,
                    'naskah_akademik_dll' => $lamp_naskah_akademik_harmonisasi
                );

                //cukx

                if ($cek_data_tbl_berita->num_rows() <= 0) {
                    // data di insert
                    $data_tbl_berita = array(
                        'id_user' => $data_id_user,
                        'nama_kegiatan' => $nama_draft,
                        'tgl_kegiatan' => date('Y-m-d H:i:s'),
                        'tgl_update' => date('Y-m-d H:i:s'),
                        'tgl_input' => date('Y-m-d H:i:s'),
                        'status' => $status,
                        'jenis_dokumen' => $jenis_dokumen,
                        'zona_dokumen' => $zona,
                        'id_draft' => $id_draft_permohonan,
                    );
                    $this->db->insert('tbl_berita', $data_tbl_berita);
                } else {
                    //data di update
                    $data_tbl_berita = array(
                        'tgl_update' => date('Y-m-d H:i:s'),
                        'nama_kegiatan' => $nama_draft,
                        'status' => $status,
                        'zona_dokumen' => $zona,
                        'lamp_surat_undangan' => $lamp_surat_harmonisasi,
                    );
                    $this->db->update('tbl_berita', $data_tbl_berita, array('id_draft' => $id_draft_permohonan));
                }

//                echo $id; die;
                $this->db->update('tbl_draft', $data, array('id_draft_permohonan' => $id_draft_permohonan));
                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil update.
							</div>
							<br>'
                );
            } else {

                $this->session->set_flashdata('msg',
                    '
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> ' . $pesan . '.
	 							</div>
	 						 <br>'
                );
//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
            }
            redirect("pemda/draft/" . $zona);
        }

        if (isset($_POST['btnsimpan_update_perancang'])) {
            //LANJUTKAN DISINI UTK MELAKUKAN UPDATE PADA FILE CONTROLLER PEMDA DAN VIEW EDIT DARI PEMDA,KASUB,PERANCANG
            //PADA PROJECT DI SERVER PUSDATIN
//            echo $id;die;
//            echo $id_draft_permohonan;die;
            echo "btnsimpan_update_perancang";
            die;
            //$cek_nama_judul = htmlentities(strip_tags($this->input->post('nama_draft')));
            //echo $cek_nama_judul; die;
            $zona_doc = explode('_', $zona);
            if ($zona_doc[2] != "") {
                $zona_document_strip = $zona_doc[0] . "_" . $zona_doc[1] . "_" . $zona_doc[2];
                $zona_document = $zona_doc[0] . " " . $zona_doc[1] . " " . $zona_doc[2];
            } else if ($zona_doc[2] == "") {
                $zona_document_strip = $zona_doc[0] . "_" . $zona_doc[1];
                $zona_document = $zona_doc[0] . " " . $zona_doc[1];
            }

            if (!isset($ceks)) {
                redirect('web/login');
            }

            if (!is_dir($lokasi)) {
                # jika tidak maka folder harus dibuat terlebih dahulu
                mkdir($lokasi, 0777, $rekursif = true);
            }

            //DARI SINI
//                    echo $_FILES['url_files']['name'];die;
            if ($_FILES['url_files']['name'][0] == null) {

                $count_edit = 0;
            } else {
                $count_edit = count($_FILES['url_files']['name']);
            }

            $nama_draft = htmlentities(strip_tags($this->input->post('nama_draft')));
            $jenis_dokumen = htmlentities(strip_tags($this->input->post('jenis_dokumen')));
            $status = htmlentities(strip_tags($this->input->post('status_dokumen')));

            //echo $status; die;
//            echo $id; die;
            $simpan = '';

            $cek_data = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan))->row();
            $data_lama_url_data_dukung = $cek_data->url_data_dukung;
            $data_lama_lamp_surat_permohonan = $cek_data->lamp_surat_permohonan;
            $nama_perancang = $cek_data->nama_perancang;
            $data_id_user = $cek_data->id_user;

            //echo $nama_perancang; die;

            $cek_data_harmonisasi = $this->db->get_where("tbl_berita", array('id_draft' => $id_draft_permohonan))->row();
            $data_lama_lamp_harmonisasi = $cek_data_harmonisasi->lamp_surat_undangan;

            if ($count_edit != 0) {

                for ($i = 0; $i < $count_edit; $i++) {
                    if (!empty($_FILES['url_files']['name'][$i])) {
                        $_FILES['file']['name'] = $_FILES['url_files']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['url_files']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['url_files']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['url_files']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['url_files']['size'][$i];

                        if (!$this->upload->do_upload('file')) {
                            $simpan = 'n';
                            $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                        } else {
                            $gbr = $this->upload->data();
                            $filename = "$lokasi/" . $gbr['file_name'];
                            $url_file[$i] = preg_replace('/ /', '_', $filename);
                            $simpan = 'y';
                        }
                    }
                }
//                echo $url_file;die;
                $file_lama = json_decode($data_lama_url_data_dukung == 'null' ? "[]" : $data_lama_url_data_dukung);
                $url_data_dukung = json_encode(array_merge($file_lama, $url_file));
            } else {
                $url_data_dukung = $data_lama_url_data_dukung;
                $simpan = 'y';
            }

            //echo $url_data_dukung; die;

            /*menangkap data file untuk lamp_surat_permohonan_edit*/
            if (!$this->upload->do_upload('lamp_surat_permohonan_edit')) {
//                    echo "tidak upload data maka gunakan DATA LAMA";die;
                $lamp_surat_permohonan = $data_lama_lamp_surat_permohonan;
                $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
//                $simpan = 'n';

            } else {
//                    echo "upload data maka gunakan DATA BARU";die;
                $gbr = $this->upload->data();
                $filename = "$lokasi/" . $gbr['file_name'];
                $lamp_surat_permohonan = preg_replace('/ /', '_', $filename);

                try {
                    unlink($data_lama_lamp_surat_permohonan);
                } catch (Exception $e) {
                    echo json_encode($e);
                }

                $simpan = 'y';
            }

            //echo $lamp_surat_permohonan;die;

            /*menangkap data file untuk hasil lamp_harmonisasi*/
            //lamp_harmonisasi cukx
            if (!$this->upload->do_upload('lamp_harmonisasi')) {
                $lamp_surat_harmonisasi = $data_lama_lamp_harmonisasi;
                $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));

            } else {
                $gbr = $this->upload->data();
                $filename = "$lokasi/" . $gbr['file_name'];
                $lamp_surat_harmonisasi = preg_replace('/ /', '_', $filename);
//                $lamp_surat_permohonan = preg_replace('/ /', '_', $filename);

                try {
                    unlink($data_lama_lamp_harmonisasi);
                } catch (Exception $e) {
                    echo json_encode($e);
                }

                $simpan = 'y';
            }

            //sampai sini bisa
            //echo $lamp_surat_harmonisasi; die;
            $cek_data_tbl_berita = $this->db->get_where("tbl_berita", array('id_draft' => $id_draft_permohonan));

            if ($simpan == 'y') {
                $data = array(
                    //'nama_draft_permohonan' => $nama_draft,
                    //'jenis_dokumen' => $jenis_dokumen,
                    //'tgl_update' => date('Y-m-d H:i:s'),
                    //'lamp_surat_permohonan' => $lamp_surat_permohonan,
                    //'url_data_dukung' => $url_data_dukung

                    'nama_draft_permohonan' => $nama_draft,
                    'jenis_dokumen' => $jenis_dokumen,
                    'status' => $status,
                    'nama_perancang' => $nama_perancang,
                    'tgl_update' => date('Y-m-d H:i:s'),
                    'lamp_surat_permohonan' => $lamp_surat_permohonan,
                    'url_data_dukung' => $url_data_dukung
                );

                if ($cek_data_tbl_berita->num_rows() <= 0) {
                    $data_tbl_berita = array(
                        'id_user' => $data_id_user,
                        'nama_kegiatan' => $nama_draft,
                        'tgl_kegiatan' => date('Y-m-d H:i:s'),
                        'tgl_input' => date('Y-m-d H:i:s'),
                        'status' => $status,
                        'jenis_dokumen' => $jenis_dokumen,
                        'zona_dokumen' => $zona_document,
                        'id_draft' => $id_draft_permohonan,
                    );

                    $this->db->insert('tbl_berita', $data_tbl_berita);
                } else {
                    $data_tbl_berita = array(
                        'tgl_update' => date('Y-m-d H:i:s'),
                        'status' => $status,
                        'nama_kegiatan' => $nama_draft,
                        'lamp_surat_undangan' => $lamp_surat_harmonisasi,
                    );
                    $this->db->update('tbl_berita', $data_tbl_berita, array('id_draft' => $id_draft_permohonan));
                }

//                echo $id; die;
                $this->db->update('tbl_draft', $data, array('id_draft_permohonan' => $id_draft_permohonan));
                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil update.
							</div>
							<br>'
                );
            } else {

                $this->session->set_flashdata('msg',
                    '
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> ' . $pesan . '.
	 							</div>
	 						 <br>'
                );
//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
            }
            redirect("pemda/draft/" . $zona);
        }

        if (isset($_POST['btnsimpan_update_kasub_perancang'])) {
            //echo "update kasub perancang"; die;
//            echo $zona; die;
//            echo $id; die;
            //echo "wkwkk btnsimpan_update_kasub_perancang"; die;
            $zona_doc = explode('_', $zona);
            if ($zona_doc[2] != "") {
                $zona_document_strip = $zona_doc[0] . "_" . $zona_doc[1] . "_" . $zona_doc[2];
                $zona_document = $zona_doc[0] . " " . $zona_doc[1] . " " . $zona_doc[2];
            } else if ($zona_doc[2] == "") {
                $zona_document_strip = $zona_doc[0] . "_" . $zona_doc[1];
                $zona_document = $zona_doc[0] . " " . $zona_doc[1];
            }


            if (!isset($ceks)) {
                redirect('web/login');
            }

            if (!is_dir($lokasi)) {
                # jika tidak maka folder harus dibuat terlebih dahulu
                mkdir($lokasi, 0777, $rekursif = true);
            }

//                    echo $_FILES['url_files']['name'];die;
            if ($_FILES['url_files']['name'][0] == null) {

                $count_edit = 0;
            } else {
                $count_edit = count($_FILES['url_files']['name']);
            }

            $id_draft_permohonan = htmlentities(strip_tags($this->input->post('id_draft_permohonan')));
//            echo $id_draft_permohonan; die;
            $nama_draft = htmlentities(strip_tags($this->input->post('nama_draft')));
            $jenis_dokumen = htmlentities(strip_tags($this->input->post('jenis_dokumen')));
            $status = htmlentities(strip_tags($this->input->post('status_dokumen')));
            $nama_perancang = htmlentities(strip_tags($this->input->post('nama_perancang')));

            $simpan = '';

            $cek_data = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan))->row();
            $data_lama_url_data_dukung = $cek_data->url_data_dukung;
            $data_lama_lamp_surat_permohonan = $cek_data->lamp_surat_permohonan;
            $data_id_user = $cek_data->id_user;


            if ($count_edit != 0) {

                for ($i = 0; $i < $count_edit; $i++) {
                    if (!empty($_FILES['url_files']['name'][$i])) {
                        $_FILES['file']['name'] = $_FILES['url_files']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['url_files']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['url_files']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['url_files']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['url_files']['size'][$i];

                        if (!$this->upload->do_upload('file')) {
                            $simpan = 'n';
                            $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                        } else {
                            $gbr = $this->upload->data();
                            $filename = "$lokasi/" . $gbr['file_name'];
                            $url_file[$i] = preg_replace('/ /', '_', $filename);
                            $simpan = 'y';
                        }
                    }
                }
//                echo $url_file;die;
                $file_lama = json_decode($data_lama_url_data_dukung == 'null' ? "[]" : $data_lama_url_data_dukung);
                $url_data_dukung = json_encode(array_merge($file_lama, $url_file));
            } else {
                $url_data_dukung = $data_lama_url_data_dukung;
                $simpan = 'y';
            }

//            lamp_surat_permohonan_edit
            if (!$this->upload->do_upload('lamp_surat_permohonan_edit')) {
//                    echo "tidak upload data maka gunakan DATA LAMA";die;
                $lamp_surat_permohonan = $data_lama_lamp_surat_permohonan;
                $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
//                $simpan = 'n';

            } else {
//                    echo "upload data maka gunakan DATA BARU";die;
                $gbr = $this->upload->data();
                $filename = "$lokasi/" . $gbr['file_name'];
                $lamp_surat_permohonan = preg_replace('/ /', '_', $filename);

                try {
                    unlink($data_lama_lamp_surat_permohonan);
                } catch (Exception $e) {
                    echo json_encode($e);
                }

                $simpan = 'y';
            }

            //echo $data_lama_lamp_surat_permohonan;die;
            //echo $url_data_dukung;die;

            $cek_data_tbl_berita = $this->db->get_where("tbl_berita", array('id_draft' => $id_draft_permohonan));
//            echo $cek_data_tbl_berita->num_rows(); die;


//            echo $id_draft_permohonan;die;
            if ($simpan == 'y') {
                $data = array(
                    'nama_draft_permohonan' => $nama_draft,
                    'jenis_dokumen' => $jenis_dokumen,
                    'status' => $status,
                    'nama_perancang' => $nama_perancang,
                    'tgl_update' => date('Y-m-d H:i:s'),
                    'lamp_surat_permohonan' => $lamp_surat_permohonan,
                    'url_data_dukung' => $url_data_dukung
                );

                if ($cek_data_tbl_berita->num_rows() <= 0) {
                    //maka insert
                    //echo $status; die;
                    /*belum masuk id_user*/
                    $data_tbl_berita = array(
                        'id_user' => $data_id_user,
                        'nama_kegiatan' => $nama_draft,
                        'tgl_kegiatan' => date('Y-m-d H:i:s'),
                        'tgl_input' => date('Y-m-d H:i:s'),
                        'status' => $status,
                        'jenis_dokumen' => $jenis_dokumen,
                        'zona_dokumen' => $zona,
                        'id_draft' => $id_draft_permohonan,
                    );

                    $this->db->insert('tbl_berita', $data_tbl_berita);

                } else {
                    //maka update
                    $data_tbl_berita = array(
                        'tgl_update' => date('Y-m-d H:i:s'),
                        'status' => $status,
                    );

                    $this->db->update('tbl_berita', $data_tbl_berita, array('id_draft' => $id_draft_permohonan));
                }

                $this->db->update('tbl_draft', $data, array('id_draft_permohonan' => $id_draft_permohonan));

                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil update.
							</div>
							<br>'
                );
            } else {

                $this->session->set_flashdata('msg',
                    '
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> ' . $pesan . '.
	 							</div>
	 						 <br>'
                );
//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
            }
            redirect("pemda/draft/" . $zona);
        }

        $max_size = 1024 * 10;
        $lokasi = 'file/data_ttd_agen';
        $this->upload->initialize(array(
            "upload_path" => "./$lokasi",
            "allowed_types" => "*",
            "max_size" => $max_size
        ));

        if (isset($_POST['btnsimpan_agen'])) {
            /*TAMBAH AGEN ASLII*/
            //echo "tambah agen asli"; die;

            //echo "agen ditambah"; die;
//            echo $role."<br>";
//            echo $id."<br>";
//            die;
            // echo "simpan data agen"; die;
            //echo $id; die;
            $nama_agen = htmlentities(strip_tags($this->input->post('nama_agen')));
            $tempat_lahir = htmlentities(strip_tags($this->input->post('tempat_lahir')));
            $tgl_lahir = htmlentities(strip_tags($this->input->post('tgl_lahir')));
            $jenis_kelamin = htmlentities(strip_tags($this->input->post('jenis_kelamin')));
            $no_ktp = htmlentities(strip_tags($this->input->post('no_ktp')));
            $alamat_lengkap = htmlentities(strip_tags($this->input->post('alamat_lengkap')));
            $kota = htmlentities(strip_tags($this->input->post('kota')));
            $kecamatan = htmlentities(strip_tags($this->input->post('kecamatan')));
            $kelurahan = htmlentities(strip_tags($this->input->post('kelurahan')));
            $provinsi = htmlentities(strip_tags($this->input->post('provinsi')));
            $kode_pos = htmlentities(strip_tags($this->input->post('kode_pos')));
            $email = htmlentities(strip_tags($this->input->post('email')));
            $no_hp = htmlentities(strip_tags($this->input->post('no_hp')));
            $nama_bank = htmlentities(strip_tags($this->input->post('nama_bank')));
            $cabang_bank = htmlentities(strip_tags($this->input->post('cabang_bank')));
            $no_rekening = htmlentities(strip_tags($this->input->post('no_rekening')));
            $pemilik_rekening = htmlentities(strip_tags($this->input->post('pemilik_rekening')));
            $jabatan = htmlentities(strip_tags($this->input->post('jabatan')));
            $sponsor = htmlentities(strip_tags($this->input->post('sponsor')));
            $nama_ahli_waris = htmlentities(strip_tags($this->input->post('nama_ahli_waris')));
            $hub_dgn_ahli_waris = htmlentities(strip_tags($this->input->post('hub_dgn_ahli_waris')));
            $no_hp_ahli_waris = htmlentities(strip_tags($this->input->post('no_hp_ahli_waris')));
            $username_agen = htmlentities(strip_tags($this->input->post('username_agen')));
            $password_agen = htmlentities(strip_tags($this->input->post('password_agen')));
            $cabang_id = htmlentities(strip_tags($this->input->post('cabang_id')));


            if (!is_dir($lokasi)) {
                mkdir($lokasi, 0777, $rekursif = true);
            }

            if (!$this->upload->do_upload('lamp_ttd_pict')) {
                $simpan = 'n';
                $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
            } else {
                $gbr = $this->upload->data();
                $filename = "$lokasi/" . $gbr['file_name'];
                $lamp_ttd_pict = preg_replace('/ /', '_', $filename);
                $simpan = 'y';
            }

            $user_id = $this->session->userdata('id_user');
            $tgl_input = date('Y-m-d H:i:s');
            $tgl_update = date('Y-m-d H:i:s');

//            echo $nama_agen."<br>";
//            echo $tgl_lahir."<br>";
//            echo $tempat_lahir."<br>";
//            echo $jenis_kelamin."<br>";
//            echo $no_ktp."<br>";
//            echo $alamat_lengkap."<br>";
//            echo $kota."<br>";
//            echo $kecamatan."<br>";
//            echo $kelurahan."<br>";
//            echo $provinsi."<br>";
//            echo $kode_pos."<br>";
//            echo $email."<br>";
//            echo $no_hp."<br>";
//            echo $nama_bank."<br>";
//            echo $cabang_bank."<br>";
//            echo $no_rekening."<br>";
//            echo $pemilik_rekening."<br>";
//            echo $jabatan."<br>";
            //echo "sponsor atasan: ".$sponsor."<br>";
//            echo $nama_ahli_waris."<br>";
//            echo $hub_dgn_ahli_waris."<br>";
//            echo $no_hp_ahli_waris."<br>";
//            echo $lamp_ttd_pict."<br>";
//            echo $user_id."<br>";
//            echo $tgl_input."<br>";
//            echo $tgl_update."<br>";
//
            //die;



            $get_jabatan_agen = $this->db->get_where('tbl_role_agen',
                array(
                    "id_role_agen" => $jabatan
                ))->row();

            $get_nama_lengkap_role = $get_jabatan_agen->nama_role_agen_lengkap;

            $data_nama_agen = $get_jabatan_agen->nama_role_agen;
            // echo $data_nama_agen; die;


            $pesan = '';
            $status = '';
            $simpan = 'y';

            $cek_data_username = $this->db->get_where("tbl_agen",array("username"=>$username_agen));
            if($cek_data_username->num_rows()>=1){
                $pesan="Username yang anda masukkan sudah digunakan";
                $simpan="n";
                //echo $cek_data_username->num_rows();
            } else if($cek_data_username->num_rows()<1){
                $simpan="y";
                //echo $cek_data_username->num_rows();
            }
//            echo "tes";die;
            //echo $simpan; die;
//            echo $username_agen."<br>";
//            echo crypt($password_agen,"salt-coba")."<br>";
//            echo $simpan."<br>";
//            die;

            if ($simpan == "y") {
                $data_agen_to_save = array(

                    "nama_agen" => $nama_agen,
                    "username" => $username_agen,
                    "password" => crypt($password_agen,"salt-coba"),
                    "tgl_lahir" => $tgl_lahir,
                    "tempat_lahir" => $tempat_lahir,
                    "jenis_kelamin" => $jenis_kelamin,
                    "no_ktp" => $no_ktp,
                    "alamat_lengkap" => $alamat_lengkap,
                    "kota" => $kota,
                    "kecamatan" => $kecamatan,
                    "kelurahan" => $kelurahan,
                    "provinsi" => $provinsi,
                    "kode_pos" => $kode_pos,
                    "email" => $email,
                    "no_hp" => $no_hp,
                    "nama_bank" => $nama_bank,
                    "cabang_bank" => $cabang_bank,
                    "no_rekening" => $no_rekening,
                    "pemilik_rekening" => $pemilik_rekening,
                    "jabatan" => $jabatan,
                    "role_agen_id" => $jabatan,
                    "sponsor_atasan" => $sponsor,
                    "nama_ahli_waris" => $nama_ahli_waris,
                    "hub_dgn_ahli_waris" => $hub_dgn_ahli_waris,
                    "no_hp_ahli_waris" => $no_hp_ahli_waris,
                    "lamp_ttd_agen" => $lamp_ttd_pict,
                    "user_id" => $user_id,
                    "tgl_input" => $tgl_input,
                    "tgl_update" => $tgl_update,
                    "cabang_id" => $cabang_id,
                );
                $this->db->insert('tbl_agen', $data_agen_to_save);
                $this->session->set_flashdata('msg',
                    '
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Sukses!</strong> Data Berhasil disimpan.
								</div>
							  <br>'
                );

                require('./assets/classes/class.phpmailer.php');
                require('./assets/classes/class.smtp.php');

                $mail = new PHPMailer;
                $mail->IsSMTP();
                $mail->SMTPSecure = "ssl";
                $mail->Host = "smtp.gmail.com"; //host email

                //jika '$mail->SMTPDebug = 2;' di uncomment maka akan muncul debug di browser
                //$mail->SMTPDebug = 2;
                $mail->Port = 465;
                $mail->SMTPAuth = true;
                $mail->Username = "senderforemail340@gmail.com"; //user email
                $mail->Password = "mtklbsimtazfowfi"; //password email
                $mail->SetFrom("senderforemail340@gmail.com", "Assalamualaikum, Halo Agen "
                    .$get_nama_lengkap_role); //set email pengirim
                $mail->Subject = "Anda berhasil terdaftar sebagai ".$get_nama_lengkap_role; //subyek email
                $mail->AddAddress($email);  // email tujuan
                $mail->MsgHTML("Halo, ".$nama_agen
                    ."! Anda Telah Didaftarkan sebagai agen Sahabat Tulus dengan Jabatan <b>$get_nama_lengkap_role</b>, Klik tautan berikut : <br> https://localhost/umroh_backend/web/login.html"
                    ."<br> Silakan Login Melalui Akun Anda menggunakan <i>credentials</i> <br> Username : ".$username_agen."<br> Password : ".$password_agen); //pesan

                $mail->Send();
            } else {
                $this->session->set_flashdata('msg',
                    '
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Gagal!</strong> ' . $pesan . '.
								</div>
							 <br>'
                );
                redirect("agen/v/" . $role . "/" . hashids_encrypt($id) . "/t_agen.html");
            }
            redirect("agen/v/" . $role . "/" . hashids_encrypt($id));

            if ($pilihan_paket == "paket_haji") {
                /*kuruk*/
            } else if ($pilihan_paket == "paket_umroh") {

            }

            $array_cek_lengkap = array();

            if ($nama_jamaah != "") {
                array_push($array_cek_lengkap, 'nama_jamaah');
            }

            if ($tempat_lahir != "") {
                array_push($array_cek_lengkap, 'tempat_lahir');
            }

            if ($tgl_lahir != "") {
                array_push($array_cek_lengkap, 'tgl_lahir');
            }
            if ($usia != "") {
                array_push($array_cek_lengkap, 'usia');
            }
            if ($no_paspor != "") {
                array_push($array_cek_lengkap, 'no_paspor');
            }

            if ($tgl_paspor_publish != "") {
                array_push($array_cek_lengkap, 'tgl_paspor_publish');
            }

            if ($tgl_paspor_expired != "") {
                array_push($array_cek_lengkap, 'tgl_paspor_expired');
            }

            if ($tempat_paspor_publish != "") {
                array_push($array_cek_lengkap, 'tempat_paspor_publish');
            }

            if ($alamat_lengkap != "") {
                array_push($array_cek_lengkap, 'alamat_lengkap');
            }

            if ($jenis_kelamin != "") {
                array_push($array_cek_lengkap, 'jenis_kelamin');
            }

            if ($no_telp != "") {
                array_push($array_cek_lengkap, 'no_telp');
            }

            if ($pekerjaan != "") {
                array_push($array_cek_lengkap, 'pekerjaan');
            }

            if ($nama_mahram != "") {
                array_push($array_cek_lengkap, 'nama_mahram');
            }

            if ($hub_mahram != "") {
                array_push($array_cek_lengkap, 'hub_mahram');
            }

            if ($tgl_rencana_umroh_or_haji != "") {
                array_push($array_cek_lengkap, 'tgl_rencana_umroh_or_haji');
            }

            if ($pernah_umroh_or_haji != "") {
                array_push($array_cek_lengkap, 'pernah_umroh_or_haji');
            }

            if ($kursi_roda != "") {
                array_push($array_cek_lengkap, 'kursi_roda');
            }

            if ($embarkasi != "") {
                array_push($array_cek_lengkap, 'embarkasi');
            }

            if ($pilihan_paket != "") {
                array_push($array_cek_lengkap, 'pilihan_paket');
            }
            if ($jenis_paket != "") {
                array_push($array_cek_lengkap, 'jenis_paket');
            }

            if ($uang_muka != "") {
                array_push($array_cek_lengkap, 'uang_muka');
            }

            if ($tgl_berangkat != "") {
                array_push($array_cek_lengkap, 'tgl_berangkat');
            }

            if ($user_id != "") {
                array_push($array_cek_lengkap, 'user_id');
            }

//                        echo sizeof($array_cek_lengkap);die;
//

            //$cek_data = $this->db->get_where('tbl_jamaah', array('nama_cabang'=>$nama_cabang));
            $pesan = '';
            $status = '';
            $simpan = 'y';

            if (sizeof($array_cek_lengkap) == 23) {
//                            echo "dokumen lengkap";
                $simpan = 'y';
                $status = 'dokumen_lengkap';
            } else if (sizeof($array_cek_lengkap) < 23) {
//                            echo "dokumen belum lengkap";
                $simpan = 'n';
                $status = 'dokumen_belum_lengkap';
            }
            //die;

//                        echo "nama jamaah: " . $nama_jamaah . "<br>";
//                        echo "tempat lahir :" . $tempat_lahir . "<br>";
//                        echo "tanggal lahir :" . $tgl_lahir . "<br>";
//                        echo "usia : " . $usia . "<br>";
//                        echo "no paspor : " . $no_paspor . "<br>";
//                        echo "tgl_paspor_publish : " . $tgl_paspor_publish . "<br>";
//                        echo "tgl_paspor_expired : " . $tgl_paspor_expired . "<br>";
//                        echo "tempat_paspor_publish : " . $tempat_paspor_publish . "<br>";
//                        echo "alamat_lengkap : " . $alamat_lengkap . "<br>";
//                        echo "jenis_kelamin : " . $jenis_kelamin . "<br>";
//                        echo "no_telp : " . $no_telp . "<br>";
//                        echo "pekerjaan : " . $pekerjaan . "<br>";
//                        echo "nama_mahram : " . $nama_mahram . "<br>";
//                        echo "hub_mahram : " . $hub_mahram . "<br>";
//                        echo "tgl_rencana_umroh_or_haji : " . $tgl_rencana_umroh_or_haji . "<br>";
//                        echo "pernah_umroh_or_haji : " . $pernah_umroh_or_haji . "<br>";
//                        echo "kursi_roda : " . $kursi_roda . "<br>";
//                        echo "embarkasi : " . $embarkasi . "<br>";
//                        echo "pilihan_paket : " . $pilihan_paket . "<br>";
//                        echo "jenis_paket : " . $jenis_paket . "<br>";
//                        echo "uang_muka : " . $uang_muka . "<br>";
//                        echo "tgl_berangkat : " . $tgl_berangkat . "<br>";
//                        echo "gk perlu cek tgl_input : " . $tgl_input . "<br>";
//                        echo "gk perlu cek tgl_update : " . $tgl_update . "<br>";
//                        echo "user_id : " . $user_id . "<br>";
//                        echo "gk perlu cek status : " . $status . "<br>";
//
//                        die;


            if ($simpan == 'y') {
                if ($pilihan_paket == "paket_haji") {
                    $data = array(

                        'nama_jamaah' => $nama_jamaah,
                        'tgl_lahir' => $tgl_lahir,
                        'tempat_lahir' => $tempat_lahir,
                        'usia' => $usia,
                        'no_paspor' => $no_paspor,
                        'tgl_paspor_publish' => $tgl_paspor_publish,
                        'masa_berlaku_paspor' => $tgl_paspor_expired,
                        'tempat_paspor_publish' => $tempat_paspor_publish,
                        'alamat_lengkap' => $alamat_lengkap,
                        'jenis_kelamin' => $jenis_kelamin,
                        'no_telp_wa' => $no_telp,
                        'pekerjaan' => $pekerjaan,
                        'nama_mahram' => $nama_mahram,
                        'hub_mahram' => $hub_mahram,
                        'rencana_umroh_or_haji' => $tgl_rencana_umroh_or_haji,
                        'pernah_umroh_or_haji_thn' => $pernah_umroh_or_haji,
                        'kursi_roda' => $kursi_roda,
                        'embarkasi' => $embarkasi,
                        'paket_haji_id' => $jenis_paket,
                        'uang_muka' => $uang_muka,
                        'tgl_berangkat' => $tgl_berangkat,
                        'user_id' => $user_id,
                        'tgl_input' => $tgl_input,
                        'tgl_update' => $tgl_update,
                        'status' => $status,

                    );
                } else if ($pilihan_paket == "paket_umroh") {
                    $data = array(

                        'nama_jamaah' => $nama_jamaah,
                        'tgl_lahir' => $tgl_lahir,
                        'tempat_lahir' => $tempat_lahir,
                        'usia' => $usia,
                        'no_paspor' => $no_paspor,
                        'tgl_paspor_publish' => $tgl_paspor_publish,
                        'masa_berlaku_paspor' => $tgl_paspor_expired,
                        'tempat_paspor_publish' => $tempat_paspor_publish,
                        'alamat_lengkap' => $alamat_lengkap,
                        'jenis_kelamin' => $jenis_kelamin,
                        'no_telp_wa' => $no_telp,
                        'pekerjaan' => $pekerjaan,
                        'nama_mahram' => $nama_mahram,
                        'hub_mahram' => $hub_mahram,
                        'rencana_umroh_or_haji' => $tgl_rencana_umroh_or_haji,
                        'pernah_umroh_or_haji_thn' => $pernah_umroh_or_haji,
                        'kursi_roda' => $kursi_roda,
                        'embarkasi' => $embarkasi,
                        'paket_umroh_id' => $jenis_paket,
                        'uang_muka' => $uang_muka,
                        'tgl_berangkat' => $tgl_berangkat,
                        'user_id' => $user_id,
                        'tgl_input' => $tgl_input,
                        'tgl_update' => $tgl_update,
                        'status' => $status,
                    );
                }

                //echo "<pre>"; print_r($data); die;

                $this->db->insert('tbl_jamaah', $data);
                $this->session->set_flashdata('msg',
                    '
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Sukses!</strong> Data Berhasil disimpan.
								</div>
							  <br>'
                );

            } else {
                $this->session->set_flashdata('msg',
                    '
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Gagal!</strong> ' . $pesan . '.
								</div>
							 <br>'
                );
                redirect("jamaah/v/t");
            }
            redirect("jamaah/v");


        }

        if (isset($_POST['btnsimpan'])) {
//            echo "simpan tambah data draft FIX"; die;

            //echo "tez";die;
//            echo $zona_pendek_fix;die;
            //echo "btnsimpan permohonan draft"; die;
            if (!isset($ceks)) {
                redirect('web/login');
            }

            if (!is_dir($lokasi)) {
                mkdir($lokasi, 0777, $rekursif = true);
            }

            if ($_FILES['url_files']['name'][0] == null) {

                $count = 0;
            } else {
                $count = count($_FILES['url_files']['name']);
            }

            /*LANJUTKAN DISINI*/
//                    echo '<pre>'; print_r($_FILES); exit;

            if ($count != 0) {
                for ($i = 0; $i < $count; $i++) {

                    if (!empty($_FILES['url_files']['name'][$i])) {

                        $_FILES['file']['name'] = $_FILES['url_files']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['url_files']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['url_files']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['url_files']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['url_files']['size'][$i];

                        if (!$this->upload->do_upload('file')) {
                            $simpan = 'n';
                            $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                        } else {
                            $gbr = $this->upload->data();
                            $filename = "$lokasi/" . $gbr['file_name'];
                            $url_file[$i] = preg_replace('/ /', '_', $filename);
                            $simpan = 'y';
//                            var_dump($filename); exit;
                        }
                    }
                }
            } else {
                $simpan = 'y';
            }


            $nama_draft = htmlentities(strip_tags($this->input->post('nama_draft')));
            $jenis_dokumen = htmlentities(strip_tags($this->input->post('jenis_dokumen')));

            /*sampai jenis_dokumen aman*/
//                    echo $jenis_dokumen; exit;
            $simpan = '';

            if (!$this->upload->do_upload('lamp_surat_permohonan')) {
                $simpan = 'n';
                $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
            } else {
//                        echo "upload data";die;
                $gbr = $this->upload->data();
                $filename = "$lokasi/" . $gbr['file_name'];
                $lamp_surat_permohonan = preg_replace('/ /', '_', $filename);
//                        echo $lamp_surat_permohonan; die;
//                        echo "tester"; die;
                $simpan = 'y';
            }

            if (!$this->upload->do_upload('naskah_akademik_dll')) {
                $simpan = 'n';
                $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
            } else {
//                        echo "upload data";die;
                $gbr = $this->upload->data();
                $filename = "$lokasi/" . $gbr['file_name'];
                $naskah_akademik_dll = preg_replace('/ /', '_', $filename);
//                        echo $lamp_surat_permohonan; die;
//                        echo "tester"; die;
                $simpan = 'y';
            }

            if (!$this->upload->do_upload('draft_harmonisasi')) {
                $simpan = 'n';
                $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
            } else {
//                        echo "upload data";die;
                $gbr = $this->upload->data();
                $filename = "$lokasi/" . $gbr['file_name'];
                $draft_harmonisasi = preg_replace('/ /', '_', $filename);
//                        echo $lamp_surat_permohonan; die;
//                        echo "tester"; die;
                $simpan = 'y';
            }
            //lanjutkan disini
            if ($simpan == 'y') {
                $data = array(


                    'lamp_surat_permohonan' => $lamp_surat_permohonan,
                    'naskah_akademik_dll' => $naskah_akademik_dll,
                    'draft_harmonisasi' => $draft_harmonisasi,

                    'nama_draft_permohonan' => $nama_draft,
                    'jenis_dokumen' => $jenis_dokumen,
                    'id_user' => $id_user,
                    'tgl_input' => date('Y-m-d H:i:s'),
                    'tgl_update' => date('Y-m-d H:i:s'),
                    'zona_dokumen' => $zona,
                    'url_data_dukung' => json_encode($url_file),
                    'status' => 'belum_diproses',


                );

                $this->db->insert('tbl_draft', $data);

//                $id_berita = $this->db->insert_id();
//                $this->Mcrud->kirim_notif($id_user,'humas',$id_berita,'berita','pelaksana_kirim_berita');

                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil disimpan.
							</div>
							<br>'
                );
            } else {

                $this->session->set_flashdata('msg',
                    '
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> ' . $pesan . '.
	 							</div>
	 						 <br>'
                );
//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
            }
            redirect("pemda/draft/" . $zona);
        }


        /*nah ini dia ketika di klik simpan saat selesai edit*/
        if (isset($_POST['btnsimpan_edit'])) {
//            echo $pemda;die;

//            echo "btnsimpan_edit"; die;
            $nama_kegiatan = htmlentities(strip_tags($this->input->post('nama_kegiatan')));
            $jenis_dokumen = htmlentities(strip_tags($this->input->post('jenis_dokumen')));
            $zona_dokumen = htmlentities(strip_tags($this->input->post('zona_dokumen')));
            $status = htmlentities(strip_tags($this->input->post('status')));

            $data_lama = $this->db->get_where('tbl_berita', array('id_berita' => $id))->row();
            $lamp_surat_undangan_lama = $data_lama->lamp_surat_undangan;

//            echo $lamp_surat_undangan_lama; die;
            if (!$this->upload->do_upload('lamp_surat_undangan')) {
                $simpan = 'n';
                $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                $lamp_surat_undangan_baru = "";
            } else {
                $gbr = $this->upload->data();
                /*keterangan : $lokasi = 'file/bahan_berita';*/
                $filename = "$lokasi/" . $gbr['file_name'];
                $lamp_surat_undangan_baru = preg_replace('/ /', '_', $filename);
                $simpan = 'y';


            }


//            echo $lamp_surat_undangan_lama; die;
            $pesan = '';
            $simpan = 'y';

            if ($simpan == 'y') {
//					    echo "tes"; die;

                if ($lamp_surat_undangan_baru == "") {
//                    echo "masih dgn data lama"; die;
                    $lamp_surat_undangan_update = $lamp_surat_undangan_lama;

                    /*ini dia cara hapus file di storage*/
                } else if ($lamp_surat_undangan_baru != "") {

//                    echo "data baru tidak sama dengan data lama"; die;
                    $lamp_surat_undangan_update = $lamp_surat_undangan_baru;
                    try {
                        $path_lama_akan_dihapus = $lamp_surat_undangan_lama;
                        unlink($path_lama_akan_dihapus);

                    } catch (Exception $e) {
                        echo json_encode($e);
                    }
                }
                $data = array(
                    'lamp_surat_undangan' => $lamp_surat_undangan_update,


                    'nama_kegiatan' => $nama_kegiatan,
                    'jenis_dokumen' => $jenis_dokumen,
                    'zona_dokumen' => $zona_dokumen,
                    'status' => $status,

                );
                $this->db->update('tbl_berita', $data, array('id_berita' => $id));


                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil disimpan.
							</div>
							<br>'
                );


            } else {

                $this->session->set_flashdata('msg',
                    '
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> ' . $pesan . '.
	 							</div>
	 						 <br>'
                );

//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
            }
//					 redirect("berita/v");
            redirect("harmonisasi/v/" . $zona_dokumen);

        }


    }

    public function v_backup($aksi = '', $id = '')
    {
//        echo "Data Bait mujahid"; die;
        //echo "data cabang"; die;
        $id = hashids_decrypt($id);
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');


        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            $data['user'] = $this->Mcrud->get_users_by_un($ceks);

            if ($level != 'superadmin') {
                redirect('404_content');
            }

//			$this->db->where_not_in('nama_panjang', 'Superadmin');
            /*ngambil semua data user pada tabel user*/
//			$data['query'] = $this->db->get("tbl_user");
            $data['query'] = $this->db->get_where("tbl_agen", array("role_agen_id" => "90"));

            //echo $data['query']->num_rows(); die;

            if ($aksi == 't') {
                //echo "tambah data jamaah"; die;
                $p = "tambah";
                $data['judul_web'] = "Tambah Data Jamaah";
            } elseif ($aksi == 'e_jamaah') {
//               kuyuk
                // echo $id; die;
//				    echo "edit jamaah cuy";
//				    echo "<br>";
//				    die;
                $p = "edit_jamaah";
                $data['judul_web'] = "Edit Data Jamaah";
                //$this->db->where_not_in('nama_panjang', 'Superadmin');
                $data['query'] = $this->db->get_where("tbl_jamaah", array('id_jamaah' => "$id"))->row();
                if ($data['query']->id_jamaah == '') {
                    redirect('404');
                }
            } else if ($aksi == 'h_jamaah') {
                //echo "hapus data jamaah cuy";
                //echo "<br>";
                //echo $id;
                //die;
                $cek_data = $this->db->get_where("tbl_jamaah", array('id_jamaah' => "$id"));
                if ($cek_data->num_rows() != 0) {
                    $this->db->delete('tbl_jamaah', array('id_jamaah' => $id));
                    $this->session->set_flashdata('msg',
                        '
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Sukses!</strong> Berhasil dihapus.
								</div>
								<br>'
                    );
                    redirect("jamaah/v/");
                } else {
                    redirect('404');
                }
            } else if ($aksi == 'invoice') {
                //echo "cetak invoice"; die;
                //echo $id;die;
                $data['data_jamaah'] = $this->db->get_where("tbl_jamaah", array("id_jamaah" => $id));

                if ($data['data_jamaah']->row()->paket_haji_id) {
                    //echo "paket haji";
                    $get_tb_paket_haji = $this->db->get_where("tbl_paket_haji", array("id_paket_haji" => $data['data_jamaah']->row()->paket_haji_id))
                        ->row();
                    $harga_total = $get_tb_paket_haji->harga_total_paket_haji;
                    $paket_pilihan = "Paket Haji";
                    $jenis_paket_pilihan = $get_tb_paket_haji->nama_paket_haji;
                    $biaya_admin = $get_tb_paket_haji->biaya_admin;
                } else if ($data['data_jamaah']->row()->paket_umroh_id) {
                    //echo "paket umroh";
                    $get_tb_paket_umroh = $this->db->get_where("tbl_paket_umroh", array("id_paket_umroh" => $data['data_jamaah']->row()->paket_umroh_id))
                        ->row();
                    $harga_total = $get_tb_paket_umroh->harga_total_paket_umroh;
                    $paket_pilihan = "Paket Umroh";
                    $jenis_paket_pilihan = $get_tb_paket_umroh->nama_paket_umroh;
                    $biaya_admin = $get_tb_paket_umroh->biaya_admin;
                }

                $data['harga_total_paket'] = $harga_total;
                $data['paket_pilihan'] = $paket_pilihan;
                $data['jenis_paket_pilihan'] = $jenis_paket_pilihan;
                $data['biaya_admin'] = $biaya_admin;

                //die;

                $data['num_rows'] = $data['data_jamaah']->num_rows();
                $data['row'] = $data['data_jamaah']->row();
//                echo "<pre>"; print_r($data['data_jamaah']->row()); die;
                /*cara mbak citra mbk citra*/
                //echo "<pre>"; print_r($data['data_jamaah']->row()->id_jamaah); die;
                //$content = ob_get_clean();

                $data['nama_jamaah_invoice'] = $data['data_jamaah']->row()->nama_jamaah;
                $data['id_jamaah'] = $data['data_jamaah']->row()->id_jamaah;

                $tgl_cetak_invoice = explode(' ', $this->Mcrud->tgl_id(date('d-m-Y H:i:s', strtotime(date('Y-m-d H:i:s'))), 'full'));
                $data['tgl_cetak'] = $tgl_cetak_invoice[0] . " " . $tgl_cetak_invoice[1] . " " . $tgl_cetak_invoice[2];
                $data['no_invoice'] = date('Y-m-d');
                $data['nama_operator'] = $this->session->userdata("username");
                $exp = explode('-', $data['no_invoice']);
                $data['no_invoice_unique'] = $data['data_jamaah']->row()->id_jamaah . "/" . $exp[2] . "/" . $exp[1] . "/" . $exp[0];
                //echo $nama_jamaah_invoice; die;
                $nama_invoice = "CetakInvoice_" . $data['nama_jamaah_invoice'] . ".pdf";
//                $content = ob_get_contents();
//                ob_end_clean();
//                require('./assets/html2pdf_backup/html2pdf.class.php');
                $this->load->view('invoicejamaah/print_invoice_jamaah', $data);

                include './assets/html2pdf_backup/html2pdf.class.php';
                $contents = ob_get_clean();
//                $content = ob_get_contents();

                ob_end_clean();

                try {
                    $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(10, 10, 4, 10));
                    $html2pdf->pdf->SetDisplayMode('fullpage');
                    $html2pdf->writeHTML($contents);
                    $html2pdf->Output($nama_invoice, "I");


                } catch (HTML2PDF_exception $e) {
                    echo $e;
                    exit;
                }


            } elseif ($aksi == 'h') {
                //echo $id; die;
                $this->db->where_not_in('nama_panjang', 'Superadmin');
//					$cek_data = $this->db->get_where("tbl_user", array('id_user' => "$id"));
                $cek_data = $this->db->get_where("tbl_cabang", array('id_cabang' => "$id"));

                if ($cek_data->num_rows() != 0) {
                    $this->db->delete('tbl_cabang', array('id_cabang' => $id));
                    $this->session->set_flashdata('msg',
                        '
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Sukses!</strong> Berhasil dihapus.
								</div>
								<br>'
                    );
                    redirect("cabang/v");
                } else {
                    redirect('404');
                }
            } elseif ($aksi == 'cari_jenis_paket') {
                $pilihan_paket = $this->input->post('pilihan_paket');
                //echo $pilihan_paket; die;
                //echo "tes";
            } else {
                $p = "index";
                $data['judul_web'] = "Data Agen ";
                $data['bread'] = "Agen ";
            }

            $this->load->view('users/header', $data);
            $this->load->view("users/agen/$p", $data);
            $this->load->view('users/footer');

            date_default_timezone_set('Asia/Jakarta');
            $tgl = date('Y-m-d H:i:s');

            if (isset($_POST['btnsimpan_jamaah'])) {
                //echo "simpan data jamaah"; die;
                //echo $id; die;
                $nama_jamaah = htmlentities(strip_tags($this->input->post('nama_jamaah')));
                $tempat_lahir = htmlentities(strip_tags($this->input->post('tempat_lahir')));
                $tgl_lahir = htmlentities(strip_tags($this->input->post('tgl_lahir')));
                $usia = htmlentities(strip_tags($this->input->post('usia')));
                $no_paspor = htmlentities(strip_tags($this->input->post('no_paspor')));
                $tgl_paspor_publish = htmlentities(strip_tags($this->input->post('tgl_paspor_publish')));
                $tgl_paspor_expired = htmlentities(strip_tags($this->input->post('tgl_paspor_expired')));
                $tempat_paspor_publish = htmlentities(strip_tags($this->input->post('tempat_paspor_publish')));
                $alamat_lengkap = htmlentities(strip_tags($this->input->post('alamat_lengkap')));
                $jenis_kelamin = htmlentities(strip_tags($this->input->post('jenis_kelamin')));
                $no_telp = htmlentities(strip_tags($this->input->post('no_telp')));
                $pekerjaan = htmlentities(strip_tags($this->input->post('pekerjaan')));
                $nama_mahram = htmlentities(strip_tags($this->input->post('nama_mahram')));
                $hub_mahram = htmlentities(strip_tags($this->input->post('hub_mahram')));
                $tgl_rencana_umroh_or_haji = htmlentities(strip_tags($this->input->post('tgl_rencana_umroh_or_haji')));
                $pernah_umroh_or_haji = htmlentities(strip_tags($this->input->post('pernah_umroh_or_haji')));
                $kursi_roda = htmlentities(strip_tags($this->input->post('kursi_roda')));
                $embarkasi = htmlentities(strip_tags($this->input->post('embarkasi')));
                $pilihan_paket = htmlentities(strip_tags($this->input->post('pilihan_paket')));
                $jenis_paket = htmlentities(strip_tags($this->input->post('jenis_paket')));
                $uang_muka = htmlentities(strip_tags($this->input->post('uang_muka')));
                $tgl_berangkat = htmlentities(strip_tags($this->input->post('tgl_berangkat')));
                $user_id = $this->session->userdata('id_user');
                $tgl_input = date('Y-m-d H:i:s');
                $tgl_update = date('Y-m-d H:i:s');

                if ($pilihan_paket == "paket_haji") {
                    /*kuruk*/
                } else if ($pilihan_paket == "paket_umroh") {

                }

                $array_cek_lengkap = array();

                if ($nama_jamaah != "") {
                    array_push($array_cek_lengkap, 'nama_jamaah');
                }

                if ($tempat_lahir != "") {
                    array_push($array_cek_lengkap, 'tempat_lahir');
                }

                if ($tgl_lahir != "") {
                    array_push($array_cek_lengkap, 'tgl_lahir');
                }
                if ($usia != "") {
                    array_push($array_cek_lengkap, 'usia');
                }
                if ($no_paspor != "") {
                    array_push($array_cek_lengkap, 'no_paspor');
                }

                if ($tgl_paspor_publish != "") {
                    array_push($array_cek_lengkap, 'tgl_paspor_publish');
                }

                if ($tgl_paspor_expired != "") {
                    array_push($array_cek_lengkap, 'tgl_paspor_expired');
                }

                if ($tempat_paspor_publish != "") {
                    array_push($array_cek_lengkap, 'tempat_paspor_publish');
                }

                if ($alamat_lengkap != "") {
                    array_push($array_cek_lengkap, 'alamat_lengkap');
                }

                if ($jenis_kelamin != "") {
                    array_push($array_cek_lengkap, 'jenis_kelamin');
                }

                if ($no_telp != "") {
                    array_push($array_cek_lengkap, 'no_telp');
                }

                if ($pekerjaan != "") {
                    array_push($array_cek_lengkap, 'pekerjaan');
                }

                if ($nama_mahram != "") {
                    array_push($array_cek_lengkap, 'nama_mahram');
                }

                if ($hub_mahram != "") {
                    array_push($array_cek_lengkap, 'hub_mahram');
                }

                if ($tgl_rencana_umroh_or_haji != "") {
                    array_push($array_cek_lengkap, 'tgl_rencana_umroh_or_haji');
                }

                if ($pernah_umroh_or_haji != "") {
                    array_push($array_cek_lengkap, 'pernah_umroh_or_haji');
                }

                if ($kursi_roda != "") {
                    array_push($array_cek_lengkap, 'kursi_roda');
                }

                if ($embarkasi != "") {
                    array_push($array_cek_lengkap, 'embarkasi');
                }

                if ($pilihan_paket != "") {
                    array_push($array_cek_lengkap, 'pilihan_paket');
                }
                if ($jenis_paket != "") {
                    array_push($array_cek_lengkap, 'jenis_paket');
                }

                if ($uang_muka != "") {
                    array_push($array_cek_lengkap, 'uang_muka');
                }

                if ($tgl_berangkat != "") {
                    array_push($array_cek_lengkap, 'tgl_berangkat');
                }

                if ($user_id != "") {
                    array_push($array_cek_lengkap, 'user_id');
                }

//                        echo sizeof($array_cek_lengkap);die;
//

                //$cek_data = $this->db->get_where('tbl_jamaah', array('nama_cabang'=>$nama_cabang));
                $pesan = '';
                $status = '';
                $simpan = 'y';

                if (sizeof($array_cek_lengkap) == 23) {
//                            echo "dokumen lengkap";
                    $simpan = 'y';
                    $status = 'dokumen_lengkap';
                } else if (sizeof($array_cek_lengkap) < 23) {
//                            echo "dokumen belum lengkap";
                    $simpan = 'n';
                    $status = 'dokumen_belum_lengkap';
                }
                //die;

//                        echo "nama jamaah: " . $nama_jamaah . "<br>";
//                        echo "tempat lahir :" . $tempat_lahir . "<br>";
//                        echo "tanggal lahir :" . $tgl_lahir . "<br>";
//                        echo "usia : " . $usia . "<br>";
//                        echo "no paspor : " . $no_paspor . "<br>";
//                        echo "tgl_paspor_publish : " . $tgl_paspor_publish . "<br>";
//                        echo "tgl_paspor_expired : " . $tgl_paspor_expired . "<br>";
//                        echo "tempat_paspor_publish : " . $tempat_paspor_publish . "<br>";
//                        echo "alamat_lengkap : " . $alamat_lengkap . "<br>";
//                        echo "jenis_kelamin : " . $jenis_kelamin . "<br>";
//                        echo "no_telp : " . $no_telp . "<br>";
//                        echo "pekerjaan : " . $pekerjaan . "<br>";
//                        echo "nama_mahram : " . $nama_mahram . "<br>";
//                        echo "hub_mahram : " . $hub_mahram . "<br>";
//                        echo "tgl_rencana_umroh_or_haji : " . $tgl_rencana_umroh_or_haji . "<br>";
//                        echo "pernah_umroh_or_haji : " . $pernah_umroh_or_haji . "<br>";
//                        echo "kursi_roda : " . $kursi_roda . "<br>";
//                        echo "embarkasi : " . $embarkasi . "<br>";
//                        echo "pilihan_paket : " . $pilihan_paket . "<br>";
//                        echo "jenis_paket : " . $jenis_paket . "<br>";
//                        echo "uang_muka : " . $uang_muka . "<br>";
//                        echo "tgl_berangkat : " . $tgl_berangkat . "<br>";
//                        echo "gk perlu cek tgl_input : " . $tgl_input . "<br>";
//                        echo "gk perlu cek tgl_update : " . $tgl_update . "<br>";
//                        echo "user_id : " . $user_id . "<br>";
//                        echo "gk perlu cek status : " . $status . "<br>";
//
//                        die;


                if ($simpan == 'y') {
                    if ($pilihan_paket == "paket_haji") {
                        $data = array(

                            'nama_jamaah' => $nama_jamaah,
                            'tgl_lahir' => $tgl_lahir,
                            'tempat_lahir' => $tempat_lahir,
                            'usia' => $usia,
                            'no_paspor' => $no_paspor,
                            'tgl_paspor_publish' => $tgl_paspor_publish,
                            'masa_berlaku_paspor' => $tgl_paspor_expired,
                            'tempat_paspor_publish' => $tempat_paspor_publish,
                            'alamat_lengkap' => $alamat_lengkap,
                            'jenis_kelamin' => $jenis_kelamin,
                            'no_telp_wa' => $no_telp,
                            'pekerjaan' => $pekerjaan,
                            'nama_mahram' => $nama_mahram,
                            'hub_mahram' => $hub_mahram,
                            'rencana_umroh_or_haji' => $tgl_rencana_umroh_or_haji,
                            'pernah_umroh_or_haji_thn' => $pernah_umroh_or_haji,
                            'kursi_roda' => $kursi_roda,
                            'embarkasi' => $embarkasi,
                            'paket_haji_id' => $jenis_paket,
                            'uang_muka' => $uang_muka,
                            'tgl_berangkat' => $tgl_berangkat,
                            'user_id' => $user_id,
                            'tgl_input' => $tgl_input,
                            'tgl_update' => $tgl_update,
                            'status' => $status,

                        );
                    } else if ($pilihan_paket == "paket_umroh") {
                        $data = array(

                            'nama_jamaah' => $nama_jamaah,
                            'tgl_lahir' => $tgl_lahir,
                            'tempat_lahir' => $tempat_lahir,
                            'usia' => $usia,
                            'no_paspor' => $no_paspor,
                            'tgl_paspor_publish' => $tgl_paspor_publish,
                            'masa_berlaku_paspor' => $tgl_paspor_expired,
                            'tempat_paspor_publish' => $tempat_paspor_publish,
                            'alamat_lengkap' => $alamat_lengkap,
                            'jenis_kelamin' => $jenis_kelamin,
                            'no_telp_wa' => $no_telp,
                            'pekerjaan' => $pekerjaan,
                            'nama_mahram' => $nama_mahram,
                            'hub_mahram' => $hub_mahram,
                            'rencana_umroh_or_haji' => $tgl_rencana_umroh_or_haji,
                            'pernah_umroh_or_haji_thn' => $pernah_umroh_or_haji,
                            'kursi_roda' => $kursi_roda,
                            'embarkasi' => $embarkasi,
                            'paket_umroh_id' => $jenis_paket,
                            'uang_muka' => $uang_muka,
                            'tgl_berangkat' => $tgl_berangkat,
                            'user_id' => $user_id,
                            'tgl_input' => $tgl_input,
                            'tgl_update' => $tgl_update,
                            'status' => $status,
                        );
                    }

                    //echo "<pre>"; print_r($data); die;

                    $this->db->insert('tbl_jamaah', $data);
                    $this->session->set_flashdata('msg',
                        '
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Sukses!</strong> Data Berhasil disimpan.
								</div>
							  <br>'
                    );

                } else {
                    $this->session->set_flashdata('msg',
                        '
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Gagal!</strong> ' . $pesan . '.
								</div>
							 <br>'
                    );
                    redirect("jamaah/v/t");
                }
                redirect("jamaah/v");


            }

            if (isset($_POST['btnsimpan'])) {

                $nama_cabang = htmlentities(strip_tags($this->input->post('nama_cabang')));
                $prov_id = htmlentities(strip_tags($this->input->post('prov_id')));
                $pimpinan_cab = htmlentities(strip_tags($this->input->post('pimpinan_cab')));
                $telpon = htmlentities(strip_tags($this->input->post('telpon')));
                $email = htmlentities(strip_tags($this->input->post('email')));
//						//$level  = htmlentities(strip_tags($this->input->post('level')));
//                        $level_to_save  = htmlentities(strip_tags($this->input->post('level')));
//                        $zona_id  = htmlentities(strip_tags($this->input->post('zona_id')));
//
//						$username = htmlentities(strip_tags($this->input->post('username')));
//						$email = htmlentities(strip_tags($this->input->post('email')));
//						$password  = htmlentities(strip_tags($this->input->post('password')));
//						$password2 = htmlentities(strip_tags($this->input->post('password2')));

//						echo $nama."<br>";
//						echo $level_to_save."<br>";
//						echo $zona_id."<br>";
//						echo $username."<br>";
//						echo $email."<br>";
//						echo $password."<br>";
//						echo $password2."<br>"; die;

                $cek_data = $this->db->get_where('tbl_cabang', array('nama_cabang' => $nama_cabang));
                $pesan = '';
                $simpan = 'y';

                if ($cek_data->num_rows() != 0) {
                    $simpan = 'n';
                    $pesan = "Nama Cabang '<b>$nama_cabang</b>' sudah ada";
                }
//						else {
//							if ($password!=$password2) {
//								$simpan = 'n';
//								$pesan  = "Password tidak cocok!";
//							}
//						}

                if ($simpan == 'y') {
                    $data = array(
                        'nama_cabang' => $nama_cabang,
                        'nama_panjang' => $nama_cabang,
                        'provinsi_id' => $prov_id,
                        'user_id' => $pimpinan_cab,
                        'no_telp' => $telpon,
                        'email' => $email,
                        'tgl_input' => date('Y-m-d H:i:s'),


                    );
                    $this->db->insert('tbl_cabang', $data);
                    $this->session->set_flashdata('msg',
                        '
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Sukses!</strong> Berhasil disimpan.
								</div>
							  <br>'
                    );

                } else {
                    $this->session->set_flashdata('msg',
                        '
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Gagal!</strong> ' . $pesan . '.
								</div>
							 <br>'
                    );
                    redirect("cabang/v");
                }
                redirect("cabang/v");
            }


            if (isset($_POST['btnupdate_agen'])) {
                //echo $id; die;
                echo "btnupdate_agen";
                die;
                //cuki
                $id_agen = htmlentities(strip_tags($this->input->post('id_agen_edit')));
                echo $id_agen;
                die;
                $nama_jamaah_edit = htmlentities(strip_tags($this->input->post('nama_jamaah_edit')));
                $tempat_lahir_edit = htmlentities(strip_tags($this->input->post('tempat_lahir_edit')));
                $tgl_lahir_edit = htmlentities(strip_tags($this->input->post('tgl_lahir_edit')));
                $usia_edit = htmlentities(strip_tags($this->input->post('usia_edit')));
                $no_paspor_edit = htmlentities(strip_tags($this->input->post('no_paspor_edit')));
                $tgl_paspor_publish_edit = htmlentities(strip_tags($this->input->post('tgl_paspor_publish_edit')));
                $tgl_paspor_expired_edit = htmlentities(strip_tags($this->input->post('tgl_paspor_expired_edit')));
                $tempat_paspor_publish_edit = htmlentities(strip_tags($this->input->post('tempat_paspor_publish_edit')));
                $alamat_lengkap_edit = htmlentities(strip_tags($this->input->post('alamat_lengkap_edit')));
                $jenis_kelamin_edit = htmlentities(strip_tags($this->input->post('jenis_kelamin_edit')));
                $no_telp_edit = htmlentities(strip_tags($this->input->post('no_telp_edit')));


                $pekerjaan_edit = htmlentities(strip_tags($this->input->post('pekerjaan_edit')));
                $nama_mahram_edit = htmlentities(strip_tags($this->input->post('nama_mahram_edit')));
                $hub_mahram_edit = htmlentities(strip_tags($this->input->post('hub_mahram_edit')));
                $tgl_rencana_umroh_or_haji_edit = htmlentities(strip_tags($this->input->post('tgl_rencana_umroh_or_haji_edit')));
                $pernah_umroh_or_haji_edit = htmlentities(strip_tags($this->input->post('pernah_umroh_or_haji_edit')));
                $kursi_roda_edit = htmlentities(strip_tags($this->input->post('kursi_roda_edit')));
                $embarkasi_edit = htmlentities(strip_tags($this->input->post('embarkasi_edit')));
                $pilihan_paket_edit = htmlentities(strip_tags($this->input->post('pilihan_paket_edit')));
                $jenis_paket_edit = htmlentities(strip_tags($this->input->post('jenis_paket_edit')));
                $uang_muka_edit = htmlentities(strip_tags($this->input->post('uang_muka_edit')));
                $tgl_berangkat_edit = htmlentities(strip_tags($this->input->post('tgl_berangkat_edit')));
                $user_id = $this->session->userdata('id_user');
                $tgl_input = date('Y-m-d H:i:s');
                $tgl_update = date('Y-m-d H:i:s');

                //echo $pilihan_paket_edit; die;

//                echo $nama_jamaah_edit . "<br>";
//                echo $tempat_lahir_edit . "<br>";
//                echo $tgl_lahir_edit . "<br>";
//                echo $usia_edit . "<br>";
//                echo $no_paspor_edit . "<br>";
//                echo $tgl_paspor_publish_edit . "<br>";
//                echo $tgl_paspor_expired_edit . "<br>";
//                echo $tempat_paspor_publish_edit . "<br>";
//                echo $alamat_lengkap_edit . "<br>";
//                echo $jenis_kelamin_edit . "<br>";
//                echo $no_telp_edit . "<br>";
//                echo $pekerjaan_edit . "<br>";
//                echo $nama_mahram_edit . "<br>";
//                echo $hub_mahram_edit . "<br>";
//                echo $tgl_rencana_umroh_or_haji_edit . "<br>";
//                echo $pernah_umroh_or_haji_edit . "<br>";
//                echo $kursi_roda_edit . "<br>";
//                echo $embarkasi_edit . "<br>";
//                echo $pilihan_paket_edit . "<br>";
//                echo $jenis_paket_edit . "<br>";
//                echo $uang_muka_edit . "<br>";
//                echo $tgl_berangkat_edit . "<br>";
//                echo $user_id . "<br>";
//                echo $tgl_input . "<br>";
//                echo $tgl_update . "<br>";
//
//                die;

                $array_cek_lengkap_edit = array();

                if ($nama_jamaah_edit != "") {
                    array_push($array_cek_lengkap_edit, 'nama_jamaah');
                }

                if ($tempat_lahir_edit != "") {
                    array_push($array_cek_lengkap_edit, 'tempat_lahir');
                }

                if ($tgl_lahir_edit != "") {
                    array_push($array_cek_lengkap_edit, 'tgl_lahir');
                }
                if ($usia_edit != "") {
                    array_push($array_cek_lengkap_edit, 'usia');
                }
                if ($no_paspor_edit != "") {
                    array_push($array_cek_lengkap_edit, 'no_paspor');
                }

                if ($tgl_paspor_publish_edit != "") {
                    array_push($array_cek_lengkap_edit, 'tgl_paspor_publish');
                }

                if ($tgl_paspor_expired_edit != "") {
                    array_push($array_cek_lengkap_edit, 'tgl_paspor_expired');
                }

                if ($tempat_paspor_publish_edit != "") {
                    array_push($array_cek_lengkap_edit, 'tempat_paspor_publish');
                }

                if ($alamat_lengkap_edit != "") {
                    array_push($array_cek_lengkap_edit, 'alamat_lengkap');
                }

                if ($jenis_kelamin_edit != "") {
                    array_push($array_cek_lengkap_edit, 'jenis_kelamin');
                }

                if ($no_telp_edit != "") {
                    array_push($array_cek_lengkap_edit, 'jenis_kelamin');
                }

                if ($pekerjaan_edit != "") {
                    array_push($array_cek_lengkap_edit, 'pekerjaan_edit');
                }
                if ($nama_mahram_edit != "") {
                    array_push($array_cek_lengkap_edit, 'nama_mahram_edit');
                }
                if ($hub_mahram_edit != "") {
                    array_push($array_cek_lengkap_edit, 'hub_mahram_edit');
                }
                if ($tgl_rencana_umroh_or_haji_edit != "") {
                    array_push($array_cek_lengkap_edit, 'tgl_rencana_umroh_or_haji_edit');
                }

                if ($pernah_umroh_or_haji_edit != "") {
                    array_push($array_cek_lengkap_edit, 'pernah_umroh_or_haji_edit');
                }
                if ($kursi_roda_edit != "") {
                    array_push($array_cek_lengkap_edit, 'kursi_roda_edit');
                }
                if ($embarkasi_edit != "") {
                    array_push($array_cek_lengkap_edit, 'embarkasi_edit');
                }
                if ($pilihan_paket_edit != "") {
                    array_push($array_cek_lengkap_edit, 'pilihan_paket_edit');
                }
                if ($jenis_paket_edit != "") {
                    array_push($array_cek_lengkap_edit, 'jenis_paket_edit');
                }
                if ($uang_muka_edit != "") {
                    array_push($array_cek_lengkap_edit, 'uang_muka_edit');
                }
                if ($tgl_berangkat_edit != "") {
                    array_push($array_cek_lengkap_edit, 'tgl_berangkat_edit');
                }
                if ($user_id != "") {
                    array_push($array_cek_lengkap_edit, 'user_id');
                }

                //echo "size array cek lengkap edit : ".sizeof($array_cek_lengkap_edit)."<br>";


                //die;

                $pesan = '';
                $status = '';
                $simpan = 'y';

                if (sizeof($array_cek_lengkap_edit) == 23) {
//                            echo "dokumen lengkap";
                    $simpan = 'y';
                    $status = 'dokumen_lengkap';
                } else if (sizeof($array_cek_lengkap_edit) < 23) {
//                            echo "dokumen belum lengkap";
                    $simpan = 'n';
                    $status = 'dokumen_belum_lengkap';
                }

                //echo "simpan : ". $simpan; die;

                if ($simpan == 'y') {
                    //echo $pilihan_paket; die;
                    if ($pilihan_paket_edit == "paket_haji") {

                        $data_jamaah_to_update = array(

                            'nama_jamaah' => $nama_jamaah_edit,
                            'tgl_lahir' => $tgl_lahir_edit,
                            'tempat_lahir' => $tempat_lahir_edit,
                            'usia' => $usia_edit,
                            'no_paspor' => $no_paspor_edit,
                            'tgl_paspor_publish' => $tgl_paspor_publish_edit,
                            'masa_berlaku_paspor' => $tgl_paspor_expired_edit,
                            'tempat_paspor_publish' => $tempat_paspor_publish_edit,
                            'alamat_lengkap' => $alamat_lengkap_edit,
                            'jenis_kelamin' => $jenis_kelamin_edit,
                            'no_telp_wa' => $no_telp_edit,
                            'pekerjaan' => $pekerjaan_edit,
                            'nama_mahram' => $nama_mahram_edit,
                            'hub_mahram' => $hub_mahram_edit,
                            'rencana_umroh_or_haji' => $tgl_rencana_umroh_or_haji_edit,
                            'pernah_umroh_or_haji_thn' => $pernah_umroh_or_haji_edit,
                            'kursi_roda' => $kursi_roda_edit,
                            'embarkasi' => $embarkasi_edit,
                            'paket_haji_id' => $jenis_paket_edit,
                            'paket_umroh_id' => null,
                            'uang_muka' => $uang_muka_edit,
                            'tgl_berangkat' => $tgl_berangkat_edit,
                            'user_id' => $user_id,
                            'tgl_input' => $tgl_input,
                            'tgl_update' => $tgl_update,
                            'status' => $status,

                        );
                    } else if ($pilihan_paket_edit == "paket_umroh") {
                        $data_jamaah_to_update = array(

                            'nama_jamaah' => $nama_jamaah_edit,
                            'tgl_lahir' => $tgl_lahir_edit,
                            'tempat_lahir' => $tempat_lahir_edit,
                            'usia' => $usia_edit,
                            'no_paspor' => $no_paspor_edit,
                            'tgl_paspor_publish' => $tgl_paspor_publish_edit,
                            'masa_berlaku_paspor' => $tgl_paspor_expired_edit,
                            'tempat_paspor_publish' => $tempat_paspor_publish_edit,
                            'alamat_lengkap' => $alamat_lengkap_edit,
                            'jenis_kelamin' => $jenis_kelamin_edit,
                            'no_telp_wa' => $no_telp_edit,
                            'pekerjaan' => $pekerjaan_edit,
                            'nama_mahram' => $nama_mahram_edit,
                            'hub_mahram' => $hub_mahram_edit,
                            'rencana_umroh_or_haji' => $tgl_rencana_umroh_or_haji_edit,
                            'pernah_umroh_or_haji_thn' => $pernah_umroh_or_haji_edit,
                            'kursi_roda' => $kursi_roda_edit,
                            'embarkasi' => $embarkasi_edit,
                            'paket_haji_id' => null,
                            'paket_umroh_id' => $jenis_paket_edit,
                            'uang_muka' => $uang_muka_edit,
                            'tgl_berangkat' => $tgl_berangkat_edit,
                            'user_id' => $user_id,
                            'tgl_input' => $tgl_input,
                            'tgl_update' => $tgl_update,
                            'status' => $status,
                        );
                    }

                    //echo "id jamaah : ".$id; die;
                    //echo "<pre>"; print_r($data_jamaah_to_update); die;


                    //echo "id jamaah:".$id;die;
//                    echo "id jamaah:".$id_jamaah;die;
                    //echo "<pre>"; print_r($data_jamaah_to_update);die;
                    $this->db->update('tbl_jamaah', $data_jamaah_to_update, array('id_jamaah' => $id));

                    $this->session->set_flashdata('msg',
                        '
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Sukses!</strong> Data Jamaah Berhasil Diubah.
								</div>
							  <br>'
                    );

                } else {
                    $this->session->set_flashdata('msg',
                        '
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Gagal!</strong> ' . $pesan . '.
											</div>
										 <br>'
                    );
                    redirect("jamaah/v/e_jamaah/" . hashids_encrypt($id));
                }
                redirect("jamaah/v");

            }
        }
    }

}
