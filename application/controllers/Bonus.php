<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bonus extends CI_Controller
{

    public function index()
    {
        redirect('jamaah/v');
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

    public function cari_jenis_paket($aksi = '', $id = '')
    {

        $pilihan_paket = $this->input->post('pilihan_paket');
        $id = hashids_decrypt($id);
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');

        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            $pilihan_paket = $this->input->post('pilihan_paket');
            if ($pilihan_paket == 'paket_haji') {
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
            } else if ($pilihan_paket == 'paket_umroh') {
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

    public function v($aksi = '', $id = '', $agen_id = '')
    {

        //echo "data jamaah"; die;
        //echo hashids_decrypt($agen_id); die;
        $id = hashids_decrypt($id);
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');
        $nama_level = $this->session->userdata('nama_level');

        //echo $nama_level; die;
        //echo hashids_decrypt($agen_id); die;

        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            $data['user_bk'] = $this->Mcrud->get_users_by_un($ceks);

            $data['user'] = $this->Mcrud->get_users_by_un_tbl_agen($ceks);


//            if ($level != 'superadmin') {
//                redirect('404_content');
//            }
//            if ($nama_level != 'administrator') {
//                redirect('404_content');
//            }

//			$this->db->where_not_in('nama_panjang', 'Superadmin');
            /*ngambil semua data user pada tabel user*/
//			$data['query'] = $this->db->get("tbl_user");
            $data['query'] = $this->db->get("tbl_pencairan");

            //echo "<pre>"; print_r($data['query']->result()); die;

            $tgl_satu_bulan_lalu = date("Y-m-d", strtotime("-1 month"));
            $hari_ini = date("Y-m-d");

            $data["date_one_month_ago"] = $this->Mcrud->tgl_english($tgl_satu_bulan_lalu, 'full');
            $data["date_now"] = $this->Mcrud->tgl_english($hari_ini, 'full');

            if ($this->session->has_userdata("tgl_awal_choose")) {
                $this->session->unset_userdata("tgl_awal_choose");
            }

            if ($this->session->has_userdata("tgl_akhir_choose")) {
                $this->session->unset_userdata("tgl_akhir_choose");
            }

            if ($agen_id != "") {
                //echo $this->session->userdata('nama_level'); die;
                if ($this->session->userdata('nama_level') == "administrator") {

                    $data["query"] = $this->db->get("tbl_pencairan");
                } else if ($this->session->userdata('nama_level') == "baitullah_mujahid"
                    || $this->session->userdata('nama_level') == "manajer_mujahid"
                    || $this->session->userdata('nama_level') == "direktur_mujahid"
                    || $this->session->userdata('nama_level') == "presiden_direktur") {
                    $data["query"] = $this->db->get_where("tbl_pencairan", array("penerima_id" => $this->session->userdata('id_user')));

                }

                $data['user'] = $this->Mcrud->get_users_by_un_tbl_agen($ceks);

                $p = "index";
                $data['judul_web'] = "Data Jamaah ";
            }

            if ($aksi == 't') {
                $id_agen = $id;
                //echo $id_agen; die;
                //echo "tambah data jamaah"; die;
                $p = "tambah";
                $data['judul_web'] = "Tambah Data Pencairan Bonus";

                $data["bonus_umroh_valid"] = $this->db->get_where("tbl_agen", array("id_agen" => $this->session->userdata("id_user")))->row()->bonus_umroh_valid;
                //echo "<pre>"; print_r($data["jumlah_saldo"]); die;
            } else if ($aksi == "periode") {
                //echo hashids_decrypt($agen_id); die;
                //echo "periode"; die;


                $agen_id_decrypted = hashids_decrypt($agen_id);
                $tgl_awal = htmlentities($this->input->post('tgl_awal'));
                $tgl_akhir = htmlentities($this->input->post('tgl_akhir'));

                $tgl_awal_sql = $this->Mcrud->tgl_sql($tgl_awal);
                $tgl_akhir_sql = $this->Mcrud->tgl_sql($tgl_akhir);

                $this->session->set_userdata("tgl_awal_choose", $tgl_awal);
                $this->session->set_userdata("tgl_akhir_choose", $tgl_akhir);

                //echo $this->session->userdata("tgl_awal_choose"); die;
//                echo $tgl_awal."<br>";
//                echo $tgl_akhir."<br>";
//                die;


                $data['query'] = $this->db->query("SELECT * FROM tbl_pencairan WHERE date(tgl_input) between '$tgl_awal_sql' and '$tgl_akhir_sql'");
                //echo "<pre>"; print_r($data['query']->result());
                //die;
            } else if ($aksi == 'e_pencairan') {

                //echo "edit pencairan"; die;
                $p = "edit_pencairan";
                $data['judul_web'] = "Edit Data Pencairan";
                $data['query'] = $this->db->get_where("tbl_pencairan", array('id_pencairan' => $id))->result()[0];


                $data_user = $this->db->get_where("tbl_agen", array("id_agen" => $data['query']->penerima_id))->row();
                $get_username = $data_user->username;
                $role_agen_id = $data_user->role_agen_id;

                $data_role = $this->db->get_where("tbl_role_agen", array("id_role_agen" => $role_agen_id))->row();

                //echo "<pre>"; print_r($data_role); die;


                // echo $ceks; die;
                //echo $data['query']->penerima_id; die;

                if ($this->session->userdata('nama_level') != 'administrator') {
                    $data["bonus_umroh_valid"] = $this->db->get_where("tbl_agen", array("id_agen" => $this->session->userdata("id_user")))->row()->bonus_umroh_valid;
                    $data['user_for_epencairan'] = $this->Mcrud->get_users_by_un_tbl_agen($get_username);

                } else {
                    //echo "ini edit dari sisi admin"; die;
                    //echo $id; die;
                    $data['user'] = $this->Mcrud->get_users_by_un_tbl_agen($ceks);

                    $data_penerima = $this->db->get_where("tbl_pencairan", array("id_pencairan" => $id))->row();
                    $penerima_id = $data_penerima->penerima_id;
                    $data['penerima_id_for_admin'] = $data['query']->penerima_id;
                    //echo $data['penerima_id_for_admin']; die;
                    $data['role_agen_id'] = $role_agen_id;
                    $data['nama_level_lengkap'] = $data_role->nama_role_agen_lengkap;
                    $data["bonus_umroh_valid"] = $this->db->get_where("tbl_agen", array("id_agen" => $penerima_id))->row()->bonus_umroh_valid;


                    $bonus_umroh_valid = $this->db->get_where("tbl_agen", array("id_agen" => $penerima_id))->row()->bonus_umroh_valid;
                    $pengajuan_pencairan = 'pengajuan_pencairan';
                    $nominal_pengajuan_pencairan = $this->db->query("SELECT SUM(jumlah_nominal) as jumlah_nominal FROM 
                                tbl_pencairan where status='$pengajuan_pencairan' 
                                and penerima_id='$penerima_id'")->row()->jumlah_nominal;
                    $data['bonus_umroh_valid_agen'] = $bonus_umroh_valid - $nominal_pengajuan_pencairan;

                }
                //echo "<pre>"; print_r($data['query']);
                //die;
                //echo $data['query']->jumlah_nominal; die;
                if ($data['query']->id_pencairan == '') {
                    redirect('404');
                }
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
            } else if ($aksi == "withdrawal") {
                $id_admin = htmlentities(strip_tags($this->input->post('id_admin')));
                $norek_admin_pengirim = htmlentities(strip_tags($this->input->post('norek_admin_pengirim')));
                $id_bank_pengirim = htmlentities(strip_tags($this->input->post('id_bank_pengirim')));
                $norek_tujuan_penerima = htmlentities(strip_tags($this->input->post('norek_tujuan_penerima')));
                $id_bank_penerima = htmlentities(strip_tags($this->input->post('id_bank_penerima')));

                $id_pencairan = hashids_decrypt(htmlentities(strip_tags($this->input->post('id_pencairan'))));
                $get_pencairan = $this->db->get_where("tbl_pencairan", array("id_pencairan" => $id_pencairan))->row();
                $get_old_lamp_bukti_tf_bonus_wd = $get_pencairan->lamp_bukti_tf_bonus;
                $penerima_id = $get_pencairan->penerima_id;
                $jumlah_nominal = $get_pencairan->jumlah_nominal;

                //echo $penerima_id; die;

                $max_size = 1024 * 5;
                $lokasi = 'file/bukti_wd';
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

                if (!$this->upload->do_upload('lamp_bukti_tf_wd')) {
//                    echo "tidak upload data maka gunakan DATA LAMA";die;
                    $lamp_bukti_tf_wd = $get_old_lamp_bukti_tf_bonus_wd;
                    $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                    //$simpan = 'n';

                } else {
//                    echo "upload data maka gunakan DATA BARU";die;
                    $gbr = $this->upload->data();
                    $filename = "$lokasi/" . $gbr['file_name'];
                    $lamp_bukti_tf_wd = preg_replace('/ /', '_', $filename);

                    try {
                        unlink($get_old_lamp_bukti_tf_bonus_wd);
                    } catch (Exception $e) {
                        echo json_encode($e);
                    }

                    $simpan = 'y';
                }

                if ($simpan == 'y') {
                    $data_to_update = array(
                        'pengirim_id' => $id_admin,
                        'id_bank_pengirim' => $id_bank_pengirim,
                        'norek_pengirim' => $norek_admin_pengirim,
                        'lamp_bukti_tf_bonus' => $lamp_bukti_tf_wd,
                        'status' => 'sudah_transfer',
                        'tgl_update' => date("Y-m-d H:i:s"),

                    );

                    $get_bonus_on_valid = $this->db->get_where("tbl_agen", array("id_agen" => $penerima_id))->row()->bonus_umroh_valid;
                    $bonus_update_on_tb_agen = $get_bonus_on_valid - $jumlah_nominal;
                    $data_bonus_agen_to_update = array(
                        'bonus_umroh_valid' => $bonus_update_on_tb_agen,
                        'tgl_update' => date('Y-m-d H:i:s'),

                    );
                    $this->db->update('tbl_agen', $data_bonus_agen_to_update, array('id_agen' => $penerima_id));

                    $this->db->update('tbl_pencairan', $data_to_update, array('id_pencairan' => $id_pencairan));
                    $this->session->set_flashdata('msg',
                        '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil Update Data.
							</div>
							<br>'
                    );
                }

                redirect("bonus/v/aksi/id/" . hashids_encrypt($this->session->userdata('id_user')));


            } else if ($aksi == "set_app_pencairan") {
//                echo "set_app_pencairan"; die;
                $id_data_pencairan = hashids_decrypt(htmlentities(strip_tags($this->input->post('id_data_pencairan'))));
                $get_agen_data = $this->db->get_where("tbl_pencairan", array("id_pencairan" => $id_data_pencairan))->row();
                $id_agen_pemohon_bonus = $get_agen_data->penerima_id;
                $confirm_pass = htmlentities(strip_tags($this->input->post('confirm_pass')));
                /*mazda*/

                $get_pass_old = $this->db->get_where("tbl_agen", array("id_agen" => $id_agen_pemohon_bonus))->row()->password;
                //echo $get_pass_old; die;

                if ($get_pass_old == crypt($confirm_pass, "salt-coba")) {
                    echo "password cocok";
                    //$data['judul_web'] = "Validasi Pencairan Bonus";

                    $cek_data_pencairan = $this->db->get_where("tbl_pencairan", array("id_pencairan" => $id_data_pencairan));
                    if ($cek_data_pencairan->num_rows() != 0) {
                        $this->db->delete("tbl_pencairan", array("id_pencairan" => $id_data_pencairan));
                        $this->session->set_flashdata('msg',
                            '
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Sukses!</strong> Data Pencairan Berhasil dihapus.
								</div>
								<br>'
                        );

                        redirect("bonus/v/aksi/id/" . hashids_encrypt($this->session->userdata('id_user')));
                    } else {
                        redirect('404');
                    }


                } else if ($get_pass_old != crypt($confirm_pass, "salt-coba")) {
                    echo "password tidak cocok";
                    $pesan = "Menghapus Data Pencairan";
                    $this->session->set_flashdata('msg',
                        '
								<div class="alert alert-danger alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Gagal!</strong> ' . $pesan . '.
								</div>
							 <br>'
                    );
                    redirect("bonus/v/aksi/id/" . hashids_encrypt($this->session->userdata('id_user')));
                }
            } else if ($aksi == "confirm_password_transfer") {
                $confirm_pass_transfer = htmlentities(strip_tags($this->input->post('confirm_pass_transfer')));
                $id_pencairan_transfer = hashids_decrypt(htmlentities(strip_tags($this->input->post('id_pencairan_transfer'))));

//                echo "pass:".$confirm_pass_transfer."<br>";
//                echo "id pencairan:".$id_pencairan_transfer."<br>";
//                die;


                $data['data_bonus'] = $this->db->get_where("tbl_pencairan", array("id_pencairan" => $id_pencairan_transfer))->row();
                $get_status_pencairan = $this->db->get_where("tbl_pencairan", array("id_pencairan" => $id_pencairan_transfer))->row()->status;
                $get_pass_old = $this->db->get_where("tbl_agen", array("id_agen" => $this->session->userdata('id_user')))->row()->password;

                if ($get_pass_old == crypt($confirm_pass_transfer, "salt-coba")) {
                    $p = "validasi_transfer";
                    $data['judul_web'] = "Validasi Pencairan Bonus";


                } else if ($get_pass_old != crypt($confirm_pass_transfer, "salt-coba")) {
                    $pesan = "Password Salah!";
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
                    redirect("bonus/v/aksi/id/" . hashids_encrypt($this->session->userdata('id_user')));
                }

            } else if ($aksi == "status_app_update") {
                $status_app = htmlentities(strip_tags($this->input->post('status_app')));
                $id_pencairan = htmlentities(strip_tags($this->input->post('id_pencairan')));
                //echo hashids_decrypt($id_pencairan); die;

                $cek_pencairan = $this->db->get_where("tbl_pencairan", array('id_pencairan' => hashids_decrypt($id_pencairan)));
                //echo $status_app; die;

                if ($cek_pencairan->num_rows() != 0) {
                    $data_pencairan_to_update = array(
                        "status" => $status_app,
                    );

                    $this->db->update('tbl_pencairan', $data_pencairan_to_update, array("id_pencairan" => hashids_decrypt($id_pencairan)));

                    $pesan = "Mengubah Data Pencairan";
                    $this->session->set_flashdata('msg',
                        '
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Sukses!</strong> ' . $pesan . '.
								</div>
							 <br>'
                    );
                    redirect("bonus/v/aksi/id/" . hashids_encrypt($this->session->userdata('id_user')));
                } else {
                    $pesan = "Mengubah Data Pencairan";
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
                    redirect("bonus/v/aksi/id/" . hashids_encrypt($this->session->userdata('id_user')));
                }


            } else if ($aksi == "h_pencairan") {
                $confirm_pass = htmlentities(strip_tags($this->input->post('confirm_pass')));
                $id_pencairan = hashids_decrypt(htmlentities(strip_tags($this->input->post('id_pencairan'))));

                $get_status_pencairan = $this->db->get_where("tbl_pencairan", array("id_pencairan" => $id_pencairan))->row()->status;
                //echo $get_status_pencairan; die;
                $get_pass_old = $this->db->get_where("tbl_agen", array("id_agen" => $this->session->userdata('id_user')))->row()->password;
                if ($get_pass_old == crypt($confirm_pass, "salt-coba")) {
                    $cek_data_pencairan = $this->db->get_where("tbl_pencairan", array("id_pencairan" => $id_pencairan));
                    if ($cek_data_pencairan->num_rows() != 0) {
                        $this->db->delete("tbl_pencairan", array("id_pencairan" => $id_pencairan));
                        $this->session->set_flashdata('msg',
                            '
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Sukses!</strong> Data Pencairan Berhasil dihapus.
								</div>
								<br>'
                        );
                        redirect("bonus/v/aksi/id/" . hashids_encrypt($this->session->userdata('id_user')));
                    } else {
                        redirect('404');
                    }
                } else if ($get_pass_old != crypt($confirm_pass, "salt-coba")) {
                    $pesan = "Menghapus Data Pencairan";
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
                    redirect("bonus/v/aksi/id/" . hashids_encrypt($this->session->userdata('id_user')));
                }

            } else if ($aksi == 'h_jamaah') {
                //echo "hapus data jamaah cuy";
                //echo "<br>";
                //echo $id;
                //die;
                $cek_data = $this->db->get_where("tbl_jamaah",
                    array(
                        'id_jamaah' => "$id"
                    ));
                if ($cek_data->num_rows() != 0) {
                    if ($cek_data->row()->lamp_bukti_tf_jamaah != "") {
                        $data_lamp_tf_jamaah_to_destroy = $cek_data->row()->lamp_bukti_tf_jamaah;
                        echo $data_lamp_tf_jamaah_to_destroy;
                        //die;
                        try {
                            unlink($data_lamp_tf_jamaah_to_destroy);
                        } catch (Exception $e) {
                            echo json_encode($e);
                        }
                    }
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
                    //redirect("jamaah/v/");
                    redirect("jamaah/v/aksi/id/" . hashids_encrypt($this->session->userdata('id_user')));
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
                $data['judul_web'] = "Pencairan Bonus";
            }

            $this->load->view('users/header', $data);
            $this->load->view("users/pencairan/$p", $data);
            $this->load->view('users/footer');

            date_default_timezone_set('Asia/Jakarta');
            $tgl = date('Y-m-d H:i:s');

            $max_size = 1024 * 10;
            $lokasi = 'file/data_tf_jamaah';
            $this->upload->initialize(array(
                "upload_path" => "./$lokasi",
                "allowed_types" => "*",
                "max_size" => $max_size
            ));


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
                $agen_id = $this->session->userdata('id_user');
                $tgl_input = date('Y-m-d H:i:s');
                $tgl_update = date('Y-m-d H:i:s');

                if (!is_dir($lokasi)) {
                    mkdir($lokasi, 0777, $rekursif = true);
                }

                if (!$this->upload->do_upload('lamp_bukti_tf_jamaah')) {
                    $simpan = 'n';
                    $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                } else {
                    $gbr = $this->upload->data();
                    $filename = "$lokasi/" . $gbr['file_name'];
                    $lamp_bukti_tf_jamaah = preg_replace('/ /', '_', $filename);
                    $simpan = 'y';
                }

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
                            'agen_id' => $agen_id,
                            'tgl_input' => $tgl_input,
                            'tgl_update' => $tgl_update,
                            'status' => $status,
                            "lamp_bukti_tf_jamaah" => $lamp_bukti_tf_jamaah,

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
                            'agen_id' => $agen_id,
                            'tgl_input' => $tgl_input,
                            'tgl_update' => $tgl_update,
                            'status' => $status,
                            "lamp_bukti_tf_jamaah" => $lamp_bukti_tf_jamaah,
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
                    //redirect("jamaah/v/t");
                }
                // redirect("jamaah/v");
                redirect("jamaah/v/aksi/id/" . hashids_encrypt($this->session->userdata('id_user')));


            }


            if (isset($_POST['btnupdate_pencairan'])) {
                //echo "update data"; die;
                $id_pencairan = $id;
                $jumlah_saldo_sementara = htmlentities(strip_tags($this->input->post('jumlah_saldo_valid')));
                $id_agen = htmlentities(strip_tags($this->input->post('id_agen')));
                $id_jabatan = htmlentities(strip_tags($this->input->post('id_jabatan')));
                $jml_pencairan = htmlentities(strip_tags($this->input->post('jml_pencairan')));
                $norek_tujuan = htmlentities(strip_tags($this->input->post('norek_tujuan')));
                $id_bank_penerima = htmlentities(strip_tags($this->input->post('id_bank_penerima')));
                $keterangan = htmlentities(strip_tags($this->input->post('keterangan')));

//                echo $jumlah_saldo_sementara."<br>";
//                echo $id_agen."<br>";
//                echo $id_jabatan."<br>";
//                echo $jml_pencairan."<br>";
//                echo $norek_tujuan."<br>";
//                echo $id_bank_penerima."<br>";
//                echo $keterangan."<br>";
//                die;

                $penerima_id = $this->session->userdata('id_user');
                $pengajuan_pencairan = 'pengajuan_pencairan';

                $nominal_pengajuan_pencairan = $this->db->query("SELECT SUM(jumlah_nominal) as jumlah_nominal FROM 
                                tbl_pencairan where status='$pengajuan_pencairan' 
                                and penerima_id='$penerima_id'")->row()->jumlah_nominal;

                //echo $jumlah_saldo_valid; die;

                if ($jumlah_saldo_sementara >= $jml_pencairan) {
                    // echo "bisa dicairkan";
                    $data_pencairan_to_update = array(
                        "penerima_id" => $penerima_id,
                        "jumlah_nominal" => $jml_pencairan,
                        "tgl_update" => date("Y-m-d H:i:s"),
                        "keterangan" => $keterangan,
                        "norek_penerima" => $norek_tujuan,
                        "id_bank_penerima" => $id_bank_penerima,
                    );

                    $this->db->update('tbl_pencairan', $data_pencairan_to_update, array("id_pencairan" => $id_pencairan));

                    $this->session->set_flashdata('msg',
                        '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil Mengubah Data Pencairan.
							</div>
							<br>'
                    );

                    redirect("bonus/v/aksi/id/" . hashids_encrypt($this->session->userdata('id_user')));

                } else if ($jumlah_saldo_sementara < $jml_pencairan) {
                    // echo "tdk bisa dicairkan";
                    $pesan = "Permintaan Pencairan Melebihi Saldo Yang Tersedia";
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

                    redirect("bonus/v/e_pencairan/" . hashids_encrypt($id_pencairan));
                }
                //die;


            }
            if (isset($_POST['btn_admin_pencairan'])) {
                echo "tess";
                die;
            }
            if (isset($_POST['btnsimpan_pencairan'])) {

                //echo $this->session->userdata('id_user'); die;

                $jumlah_saldo_valid = htmlentities(strip_tags($this->input->post('jumlah_saldo_valid')));
                //echo $jumlah_saldo_valid; die;
                $id_agen = htmlentities(strip_tags($this->input->post('id_agen')));
                $id_jabatan = htmlentities(strip_tags($this->input->post('id_jabatan')));
                $jml_pencairan = htmlentities(strip_tags($this->input->post('jml_pencairan')));
                $norek_tujuan = htmlentities(strip_tags($this->input->post('norek_tujuan')));
                $id_bank_penerima = htmlentities(strip_tags($this->input->post('id_bank_penerima')));
                $keterangan = htmlentities(strip_tags($this->input->post('keterangan')));

                $jml_saldo_valid = $this->db->get_where("tbl_agen", array("id_agen" => $id_agen))->row()->bonus_umroh_valid;

                if ($jml_saldo_valid < $jml_pencairan) {
                    $pesan = "Permintaan Pencairan Melebihi Saldo Yang Tersedia";
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

                    redirect("bonus/v/t/" . hashids_encrypt($this->session->userdata('id_user')));
                } else if ($jml_saldo_valid >= $jml_pencairan) {
                    //echo " bisa dicairkan";
                    $data_tbl_pencairan = array(
                        'pengirim_id' => null,
                        'penerima_id' => $id_agen,
                        'jumlah_nominal' => $jml_pencairan,
                        'tgl_input' => date('Y-m-d H:i:s'),
                        'tgl_update' => date('Y-m-d H:i:s'),
                        'keterangan' => $keterangan,
                        'norek_penerima' => $norek_tujuan,
                        'id_bank_penerima' => $id_bank_penerima,
                        'id_bank_pengirim' => null,
                        'status' => 'pengajuan_pencairan',

                    );
                    $this->db->insert('tbl_pencairan', $data_tbl_pencairan);

                    $this->session->set_flashdata('msg',
                        '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil Mengirim Pengajuan.
							</div>
							<br>'
                    );

                    redirect("bonus/v/aksi/id/" . hashids_encrypt($this->session->userdata('id_user')));
                }
//                die;
//                echo "id_agen : ".$id_agen."<br>";
//                echo "id_jabatan : ".$id_jabatan."<br>";
//                echo "jml_pencairan : ".$jml_pencairan."<br>";
//                echo "jml_saldo : ".$jml_saldo_valid."<br>";
//                echo "norek_tujuan : ".$norek_tujuan."<br>";
//                echo "id_bank : ".$id_bank."<br>";
//                echo "keterangan : ".$keterangan."<br>";
//                die;
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


            if (isset($_POST['btnupdate_jamaah'])) {
                //echo $id; die;
                //echo "btnupdate_jamaah";die;
                //cuki
                $id_jamaah = htmlentities(strip_tags($this->input->post('id_jamaah_edit')));
                //echo $id_jamaah; die;
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

                $cek_data = $this->db->get_where("tbl_jamaah",
                    array(
                        'id_jamaah' => $id_jamaah
                    ))->row();

                $data_lama_lampiran_bukti_tf_jamaah = $cek_data->lamp_bukti_tf_jamaah;

                if (!$this->upload->do_upload('lamp_bukti_tf_jamaah_edit')) {
//                    echo "tidak upload data maka gunakan DATA LAMA";die;
                    $lamp_bukti_tf_jamaah_to_save = $data_lama_lampiran_bukti_tf_jamaah;
                    $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                    $simpan = 'n';

                } else {
//                    echo "upload data maka gunakan DATA BARU";die;
                    $gbr = $this->upload->data();
                    $filename = "$lokasi/" . $gbr['file_name'];
                    $lamp_bukti_tf_jamaah_to_save = preg_replace('/ /', '_', $filename);
                    $simpan = 'y';

                    try {
                        unlink($data_lama_lampiran_bukti_tf_jamaah);
                    } catch (Exception $e) {
                        echo json_encode($e);
                    }

                    $simpan = 'y';
                }

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
                            'agen_id' => $this->session->userdata('id_user'),
                            'tgl_input' => $tgl_input,
                            'tgl_update' => $tgl_update,
                            'status' => $status,
                            'lamp_bukti_tf_jamaah' => $lamp_bukti_tf_jamaah_to_save,

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
                            'agen_id' => $this->session->userdata('id_user'),
                            'tgl_input' => $tgl_input,
                            'tgl_update' => $tgl_update,
                            'status' => $status,
                            'lamp_bukti_tf_jamaah' => $lamp_bukti_tf_jamaah_to_save,
                        );
                    }

                    //echo "id jamaah : ".$id; die;
                    //echo "<pre>"; print_r($data_jamaah_to_update); die;


                    //echo "id jamaah:".$id;die;
//                    echo "id jamaah:".$id_jamaah;die;
                    //echo "<pre>"; print_r($data_jamaah_to_update);die;
                    $this->db->update('tbl_jamaah', $data_jamaah_to_update,
                        array(
                            'id_jamaah' => $id
                        ));

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
//                redirect("jamaah/v");
                redirect("jamaah/v/aksi/id/" . hashids_encrypt($this->session->userdata('id_user')));

            }
        }
    }

}
