<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Downpayment extends CI_Controller
{

    public function index()
    {
        redirect('downpayment/v');
    }

    public function cari_harga_pembayaran($aksi = '', $id = '')
    {
        $pilihan_paket = $this->input->post('pilihan_paket');
        $jenis_paket = $this->input->post('jenis_paket');
        $jenis_pembayaran = $this->input->post('jenis_pembayaran');

        $id = hashids_decrypt($id);
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');

        if (!isset($ceks)) {
            redirect('web/login');
        } else {

            if ($pilihan_paket == "paket_haji") {
                ?>
                <option value="">-Uang Pembayaran Haji-</option>
                <?php
                $tbl_paket_haji = $this->db->get_where("tbl_paket_haji",
                    array(
                        "id_paket_haji" => $jenis_paket
                    )
                );

                $id_dp_haji = $tbl_paket_haji->row()->dp_id;

                if ($jenis_pembayaran == "bayar_dp_haji") {
                    $get_data_pilihan_dp = $this->db->get_where("tbl_dp", array(
                        "id_dp" => $id_dp_haji,
                    ));
                    if ($get_data_pilihan_dp->num_rows() > 0) {
                        ?>

                        <?php

                        foreach ($get_data_pilihan_dp->result() as $id => $dp) {
                            ?>
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
                } else if ($jenis_pembayaran == "bayar_lunas_haji") {
                    $harga_total_paket_haji = $tbl_paket_haji->row()->harga_total_paket_haji;
                    if ($harga_total_paket_haji != "") {
                        ?>

                        <option style="text-align: center" value="<?php echo $harga_total_paket_haji ?>">
                            Rp <?= number_format($harga_total_paket_haji); ?></option>
                        <?php

                    } else {
                        ?>
                        <option style="text-align: center" value="">Tidak ada pilihan nominal pelunasan</option>
                        <?php
                    }

                }

            } else if ($pilihan_paket == "paket_umroh") {
                /*ceklek*/
                ?>
                <option value="">-Uang Pembayaran Umroh-</option>
                <?php
                $tbl_paket_umroh = $this->db->get_where("tbl_paket_umroh",
                    array(
                        "id_paket_umroh" => $jenis_paket
                    )
                );
                $id_dp_umroh = $tbl_paket_umroh->row()->dp_id;

                if ($jenis_pembayaran == "bayar_dp_umroh") {
                    $get_data_pilihan_dp = $this->db->get_where("tbl_dp", array(
                        "id_dp" => $id_dp_umroh,
                    ));
                    if ($get_data_pilihan_dp->num_rows() > 0) {
                        ?>
                        <!--                        <option value="">-Pilih Uang Muka-</option>-->
                        <?php
                        foreach ($get_data_pilihan_dp->result() as $id => $dp) {
                            ?>
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
                } else if ($jenis_pembayaran == "bayar_lunas_umroh") {
                    $harga_total_paket_umroh = $tbl_paket_umroh->row()->harga_total_paket_umroh;
                    if ($harga_total_paket_umroh != "") {
                        ?>
                        <option value="" selected="selected">-Pilih Nominal Pelunasan-</option>
                        <option style="text-align: center" value="<?php echo $harga_total_paket_umroh ?>">
                            Rp <?= number_format($harga_total_paket_umroh); ?></option>
                        <?php
                    } else {
                        ?>
                        <option style="text-align: center" value="">Tidak ada pilihan nominal pelunasan</option>
                        <?php
                    }
                }
            } else {
                ?>
                <option value="">-Cari pembayaran-</option>
                <?php
            }
        }
    }

    public function cari_jenis_pembayaran($aksi = '', $id = '')
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

                ?>
                <option value="Metode Pembayaran Haji" selected>-Pilih Jenis Pembayaran-</option>
                <option value="bayar_dp_haji">Pembayaran DP Haji</option>
                <option value="bayar_lunas_haji">Pelunasan Langsung Haji</option>
                <?php

            } else if ($pilihan_paket == "paket_umroh") {
                ?>
                <option value="Metode Pembayaran Umroh" selected>-Pilih Jenis Pembayaran-</option>
                <option value="bayar_dp_umroh">Pembayaran DP Umroh</option>
                <option value="bayar_lunas_umroh">Pelunasan Langsung Umroh</option>
                <?php

            }
        }
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
        /*agen id adalah user id yg menginput data downpayment*/
        //echo "data jamaah"; die;
        //echo hashids_decrypt($agen_id); die;
        $id = hashids_decrypt($id);
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');
        $nama_level = $this->session->userdata('nama_level');

        $data['nama_agen_all'] = [];
        $data['nama_agen'] = [];
        $data['nama_agen_atasan'] = [];
        $data['nama_agen_bawahan'] = [];

        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            $data['user_bk'] = $this->Mcrud->get_users_by_un($ceks);
            $data['user'] = $this->Mcrud->get_users_by_un_tbl_agen($ceks);

            if ($this->session->userdata('nama_level') == "baitullah_mujahid") {
                //echo "ini baitullah mujahid";
//                echo $this->session->userdata('id_user');
                $data_user = $this->db->get_where("tbl_agen",
                    array
                    (
                        "id_agen" => $this->session->userdata('id_user'),
                    )
                )->row();

                $data_atasan_user = $this->db->get_where("tbl_agen",
                    array
                    (
                        "id_agen" => $data_user->sponsor_atasan
                    )
                )->row();


                array_push($data['nama_agen'], (object)[
                    'id_agen' => $data_user->id_agen,
                    'nama_agen' => $data_user->nama_agen,
                    'nama_role_agen' => $this->session->userdata('nama_level'),
                    'nama_role_agen_lengkap' => $this->session->userdata('nama_level_lengkap')
                ]);


                $level_atasan = $this->db->get_where("tbl_role_agen",
                    array(
                        "id_role_agen" => $data_atasan_user->role_agen_id
                    )
                )->row();


                array_push($data['nama_agen_atasan'], (object)[
                    'id_agen' => $data_atasan_user->id_agen,
                    'nama_agen' => $data_atasan_user->nama_agen,
                    'nama_role_agen' => $level_atasan->nama_role_agen,
                    'nama_role_agen_lengkap' => $level_atasan->nama_role_agen_lengkap
                ]);

                //echo "<pre>"; print_r($data_atasan_user); die;

                $result = array_merge($data['nama_agen'], $data['nama_agen_atasan']);
                $data['nama_agen_all'] = $result;
                //echo sizeof($result); die;


            } else if ($this->session->userdata('nama_level') == "manajer_mujahid") {
                $data_user = $this->db->get_where("tbl_agen",
                    array
                    (
                        "id_agen" => $this->session->userdata('id_user'),
                    )
                )->row();

                $data_user_bawahan = $this->db->get_where("tbl_agen",
                    array(
                        "sponsor_atasan" => $this->session->userdata('id_user')
                    )
                );

                //echo "<pre>"; print_r($data_user_bawahan->result()); die;


                array_push($data['nama_agen'], (object)[
                    'id_agen' => $data_user->id_agen,
                    'nama_agen' => $data_user->nama_agen,
                    'nama_role_agen' => $this->session->userdata('nama_level'),
                    'nama_role_agen_lengkap' => $this->session->userdata('nama_level_lengkap')
                ]);


                foreach ($data_user_bawahan->result() as $index => $value) {
                    $get_role_bawahan = $this->db
                        ->get_where("tbl_role_agen",
                        array(
                            "id_role_agen" => $value->role_agen_id
                        )
                    )->row();
                    array_push($data['nama_agen_bawahan'], (object)[
                        'id_agen' => $value->id_agen,
                        'nama_agen' => $value->nama_agen,
                        'nama_role_agen' => $get_role_bawahan->nama_role_agen,
                        'nama_role_agen_lengkap' => $get_role_bawahan->nama_role_agen_lengkap
                    ]);
                }


                //echo "<pre>"; print_r($data_atasan_user); die;

                $result = array_merge($data['nama_agen'], $data['nama_agen_bawahan']);
                $data['nama_agen_all'] = $result;
                //echo sizeof($result); die;
            } else if ($this->session->userdata('nama_level') == "direktur_mujahid") {
                $data_user = $this->db->get_where("tbl_agen",
                    array(
                        "id_agen" => $this->session->userdata('id_user')
                    )
                )->row();

                /*get all manajer*/
                $data_user_bawahan = $this->db
                    ->get_where("tbl_agen",
                        array(
                                "sponsor_atasan"=>$this->session->userdata('id_user')
                        ));

                array_push($data['nama_agen'], (object)[
                    'id_agen' => $data_user->id_agen,
                    'nama_agen' => $data_user->nama_agen,
                    'nama_role_agen' => $this->session->userdata('nama_level'),
                    'nama_role_agen_lengkap' => $this->session->userdata('nama_level_lengkap'),
                ]);

                /*looping data all manajer*/
                foreach ($data_user_bawahan->result() as $idx=>$val){
                    $get_role_bawahan = $this->db
                        ->get_where("tbl_role_agen",
                            array(
                                    "id_role_agen"=>$val->role_agen_id
                            ))->row();
                    array_push($data['nama_agen_bawahan'],(object)[
                        'id_agen' => $val->id_agen,
                        'nama_agen' => $val->nama_agen,
                        'nama_role_agen' => $get_role_bawahan->nama_role_agen,
                        'nama_role_agen_lengkap' => $get_role_bawahan->nama_role_agen_lengkap
                    ]);

                    $get_all_baitullah = $this->db
                        ->get_where("tbl_agen",
                            array(
                                    "sponsor_atasan"=>$val->id_agen
                            ));

                    /*looping semua data baitullah*/
//                    foreach ($get_all_baitullah->result() as $idx=>$valx){
//                        $get_agen_baitul_mujahid = $this->db
//                            ->get_where("tbl_agen",
//                                array(
//                                        "id_agen"=>$valx->id_agen
//                                ));
//
//                        $get_role_baitul_mujahid = $this->db
//                            ->get_where("tbl_role_agen",
//                                array(
//                                        "id_role_agen"=>$valx->role_agen_id
//                                ))->row();
//
//                        array_push($data['nama_agen_bawahan'],(object)[
//                            'id_agen' => $valx->id_agen,
//                            'nama_agen' => $valx->nama_agen,
//                            'nama_role_agen' => $get_role_baitul_mujahid->nama_role_agen,
//                            'nama_role_agen_lengkap' => $get_role_baitul_mujahid->nama_role_agen_lengkap
//                        ]);
//                    }

                }

                $result = array_merge($data['nama_agen'],$data['nama_agen_bawahan']);

                $data['nama_agen_all'] = $result;
//                foreach ($result as $id=>$dt) {
//                    echo $dt->nama_agen."<br>";
//                }
//                die;
            } else if($this->session->userdata('nama_level') == "presiden_direktur"){
                $data_user = $this->db
                    ->get_where("tbl_agen",
                        array(
                                "id_agen"=>$this->session->userdata("id_user")
                        )
                    )->row();

                array_push($data['nama_agen'],(object)[
                    'id_agen' => $data_user->id_agen,
                    'nama_agen' => $data_user->nama_agen,
                    'nama_role_agen' => $this->session->userdata('nama_level'),
                    'nama_role_agen_lengkap' => $this->session->userdata('nama_level_lengkap'),
                ]);

                $data_agen_direktur = $this->db->get_where("tbl_agen",
                    array(
                            "sponsor_atasan"=>$this->session->userdata("id_user")
                    ));

                foreach ($data_agen_direktur->result() as $idx=>$val){
                    $data_agen_manajer = $this->db->get_where("tbl_agen",
                        array(
                                "sponsor_atasan"=>$val->id_agen
                        ));

                    $get_role_bawahan = $this->db
                        ->get_where("tbl_role_agen",
                            array(
                                "id_role_agen"=>$val->role_agen_id
                            ))->row();
                    array_push($data['nama_agen_bawahan'],(object)[
                        'id_agen' => $val->id_agen,
                        'nama_agen' => $val->nama_agen,
                        'nama_role_agen' => $get_role_bawahan->nama_role_agen,
                        'nama_role_agen_lengkap' => $get_role_bawahan->nama_role_agen_lengkap
                    ]);

                    foreach ($data_agen_manajer->result() as $i=>$it){
                        $get_agen_baitullah = $this->db
                            ->get_where("tbl_agen",
                                array(
                                    "sponsor_atasan"=>$it->id_agen
                                ));
                        $get_role_bawahans = $this->db
                            ->get_where("tbl_role_agen",
                                array(
                                    "id_role_agen"=>$it->role_agen_id
                                ))->row();
                        array_push($data['nama_agen_bawahan'],(object)[
                            'id_agen' => $it->id_agen,
                            'nama_agen' => $it->nama_agen,
                            'nama_role_agen' => $get_role_bawahans->nama_role_agen,
                            'nama_role_agen_lengkap' => $get_role_bawahans->nama_role_agen_lengkap
                        ]);



                        foreach ($get_agen_baitullah->result() as $ind=>$valu){
                            $dt_role = $this->db
                                ->get_where("tbl_role_agen",
                                    array(
                                            "id_role_agen"=>$valu->role_agen_id
                                    ))->row();
                            array_push($data['nama_agen_bawahan'],(object)[
                                "id_agen"=>$valu->id_agen,
                                "nama_agen"=>$valu->nama_agen,
                                "nama_role_agen"=>$dt_role->nama_role_agen,
                                "nama_role_agen_lengkap"=>$dt_role->nama_role_agen_lengkap,
                            ]);
                        }
                    }
                }

                //echo "<pre>";print_r($data['nama_agen'][0]); die;

                $result = array_merge($data['nama_agen'],$data['nama_agen_bawahan']);

                $data['nama_agen_all'] = $result;


            } else if ($this->session->userdata('nama_level') == "administrator") {
                //echo "ini admin"; die;
                $data_user = $this->db->get("tbl_agen");

                foreach ($data_user->result() as $idx => $val) {
                    $get_role_agen = $this->db->get_where("tbl_role_agen",
                        array(
                            "id_role_agen" => $val->role_agen_id
                        ))->row();
                    array_push($data['nama_agen'], (object)[
                        "id_agen" => $val->id_agen,
                        "nama_agen" => $val->nama_agen,
                        "nama_role_agen" => $get_role_agen->nama_role_agen,
                        "nama_role_agen_lengkap" => $get_role_agen->nama_role_agen_lengkap,
                    ]);
                }
                $data['nama_agen_all'] = $data['nama_agen'];
            }





            $data['jamaah_direktur'] = array();
            $data['jamaah_manajer'] = array();
            $data['jamaah_baitullah'] = array();
            $data['ids'] = array();
            //echo $agen_id;die;
            if ($agen_id != "") {
                if ($this->session->userdata('nama_level') == "administrator" ) {
                    //echo "disini area jamaah admin"; die;
                    $data['query'] = $this->db->get("tbl_dp");
                } else if ($this->session->userdata('nama_level') == "baitullah_mujahid") {

                    //echo "ini area jamaah baitullah mujahid".$this->session->userdata('nama_lengkap'); die;

                    $qu = $this->db->get_where("tbl_agen",
                        array(
                                "id_agen"=>$this->session->userdata('id_user')
                        )
                    )->row();
                    $id_manajerku = $qu->sponsor_atasan;
                    //echo $id_manajerku;die;
                    $q = $this->db->query("select * from tbl_jamaah where agen_id="
                        .$this->session->userdata('id_user')
                        ." or agen_pemilik_id="
                        .$this->session->userdata('id_user'));

                    $data['query']= $q->result();



                }  else if($this->session->userdata('nama_level') == "manajer_mujahid"){
                    //echo $this->session->userdata('id_user'); die;
                    //echo "ini area jamaah manajer mujahid";

                    $qw = $this->db->get_where("tbl_agen", array(
                            "sponsor_atasan"=>$this->session->userdata("id_user")
                    ))->result();


                    $q = $this->db->query("SELECT * FROM tbl_jamaah WHERE manajer_id="
                        .$this->session->userdata('id_user'));

                    $data['query']= $q->result();
                } else if($this->session->userdata('nama_level') == "direktur_mujahid"){
                    //echo "ini area jamaah direktur mujahid"; die;

                    $q = $this->db->query("SELECT * FROM tbl_jamaah WHERE direktur_id="
                        .$this->session->userdata('id_user'));

                    $data['query']= $q->result();

                } else if($this->session->userdata('nama_level')=="presiden_direktur"){
                    $q = $this->db->query("SELECT * FROM tbl_jamaah WHERE presdir_id="
                        .$this->session->userdata('id_user'));

                    $data['query']= $q->result();
                } else if($this->session->userdata('nama_level')=="administrator"){
                    $q = $this->db->get("tbl_jamaah");

                    $data["query"] = $q->result();
                }
                //die;





                $data['user'] = $this->Mcrud->get_users_by_un_tbl_agen($ceks);

                $p = "index";
                $data['judul_web'] = "Data Jamaah ";
            }

            /*SAMPAI SINI*/

            if ($aksi == 't') {
                //echo "tambah data jamaah"; die;
                $p = "tambah";
                $data['judul_web'] = "Tambah Data Jamaah";
            } elseif ($aksi == 'e_jamaah') {
                //echo $id;die;
//               kuyuk
                // echo $id; die;
//				    echo "edit jamaah cuy";
//				    echo "<br>";
//				    die;
                $p = "edit_jamaah";
                //echo $id; die;
                //echo "edit woy";die;
                $data['judul_web'] = "Edit Data Jamaah";
                //$this->db->where_not_in('nama_panjang', 'Superadmin');
                $data['query'] = $this->db->get_where("tbl_jamaah", array('id_jamaah' => "$id"))->row();
                //echo "<pre>"; print_r($data['query']); die;
                // echo "<pre>"; print_r($data['query']); die;
                if ($data['query']->id_jamaah == '') {
                    redirect('404');
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
            } else if($aksi == 'submit_approval'){
                //echo "testy"; die;
                $id_jamaah = hashids_decrypt(htmlentities(strip_tags($this->input->post('id_jamaah'))));
                $status_approval = htmlentities(strip_tags($this->input->post('status')));
//               echo $id_jamaah."<br>";
//               echo $status_approval."<br>";
//               die;

                $data['data_jamaah'] = $this->db->get_where("tbl_jamaah", array("id_jamaah" => $id_jamaah));
                if($data['data_jamaah']->num_rows()!=0){

                    $data_approval_to_update = array(
                        "status_approval"=>$status_approval
                    );

                    $update_approval = $this->db->update(
                            'tbl_jamaah',$data_approval_to_update,
                        array(
                            "id_jamaah"=>$id_jamaah
                        ));

                    $this->session->set_flashdata('msg',
                        '
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Sukses!</strong> Berhasil Menyimpan Perubahan.
								</div>
								<br>'
                    );

                    $link3 = ($this->uri->segment(3));

                    redirect("jamaah/v/aksi/id/".$link3);


                } else {
                    redirect('404');
                }
                //echo "<pre>"; print_r($data['data_jamaah']->result()); die;
            }else if ($aksi == 'invoice') {
                //echo "cetak invoice"; die;
                //echo $id;die;
                $data['data_jamaah'] = $this->db->get_where("tbl_jamaah", array("id_jamaah" => $id));
                //echo "<pre>"; print_r($data['data_jamaah']->result());die;

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
                $data['judul_web'] = "Down Payment ";
            }

            $this->load->view('users/header', $data);
            $this->load->view("users/downpayment/$p", $data);
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
                //echo "ASLI BTN SIMPAN JAMAAH";die;
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
                $metode_pembayaran = htmlentities(strip_tags($this->input->post('jenis_pembayaran')));
                $uang_pembayaran = htmlentities(strip_tags($this->input->post('uang_pembayaran')));
                $tgl_berangkat = htmlentities(strip_tags($this->input->post('tgl_berangkat')));
                $user_id = $this->session->userdata('id_user');
                $agen_id = $this->session->userdata('id_user');
                $tgl_input = date('Y-m-d H:i:s');
                $tgl_update = date('Y-m-d H:i:s');
                $agen_pemilik_id = htmlentities(strip_tags($this->input->post('agen_pemilik_id')));
                $status_approval = "pending";

                $id_baitullah="";
                $id_manajer="";
                $id_direktur = "";

                if($this->session->userdata('nama_level')=="baitullah_mujahid"){
                    //echo "ini baitullah mujahid";
                    $q_1 = $this->db->get_where("tbl_agen",
                        array(
                                "id_agen"=>$this->session->userdata('id_user')
                        )
                    )->row();


                    $id_baitullah = $this->session->userdata('id_user');
                    $id_manajer = $q_1->sponsor_atasan;

                    $q_2 = $this->db->get_where("tbl_agen",array(
                            "id_agen"=>$id_manajer
                    ))->row();

                    $id_direktur = $q_2->sponsor_atasan;

                    $id_presdir = $this->db
                        ->get_where("tbl_agen",
                            array(
                                    "id_agen"=>$id_direktur
                            )
                        )->row()->sponsor_atasan;

                    //echo $id_presdir; die;

                    if($agen_pemilik_id==$this->session->userdata('id_user')){
                        $id_baitullah = $this->session->userdata('id_user');
                        $id_manajer = $q_1->sponsor_atasan;
                        $id_direktur = $q_2->sponsor_atasan;
                        $id_presiden_direktur = $id_presdir;
                    } else if($agen_pemilik_id!=$this->session->userdata('id_user')){
                        $id_baitullah = null;
                        $id_manajer = $q_1->sponsor_atasan;
                        $id_direktur = $q_2->sponsor_atasan;
                        $id_presiden_direktur = $id_presdir;
                        /*cari id presdir*/
                    }

                    //echo "id baitullah : ".$id_baitullah."<br>";
                    //echo "id manajer : ".$id_manajer."<br>";
                    //echo "id direktur : ".$id_direktur."<br>";

                    //die;



                } else if($this->session->userdata('nama_level')=="manajer_mujahid"){
                    //echo "ini manajer mujahid"."<br>";
                    //die;
                    $q_1 = $this->db->get_where("tbl_agen",
                        array(
                                "id_agen"=>$this->session->userdata('id_user')
                        )
                    )->row();


                    $id_baitullah = "";
                    $id_manajer = $this->session->userdata("id_user");
                    $id_direktur = $q_1->sponsor_atasan;

                    $id_presdir = $this->db
                        ->get_where("tbl_agen",
                            array(
                                    "id_agen"=>$id_direktur
                            ))->row()->sponsor_atasan;

                    if($agen_pemilik_id==$this->session->userdata('id_user')){
                        $id_baitullah = null;
                        $id_manajer = $this->session->userdata("id_user");
                        $id_direktur = $q_1->sponsor_atasan;
                        $id_presiden_direktur = $id_presdir;
                    } else if($agen_pemilik_id!=$this->session->userdata('id_user')){
                        $id_baitullah = $agen_pemilik_id;
                        $id_manajer = $this->session->userdata("id_user");
                        $id_direktur = $q_1->sponsor_atasan;
                        $id_presiden_direktur = $id_presdir;
                    }

                    //echo "id manajer : ".$id_manajer."<br>";
                    //echo "id direktur : ".$id_direktur."<br>";
                    //die;

                } else if($this->session->userdata('nama_level')=="direktur_mujahid"){
                   //echo "ini area jamaah direktur mujahid";die;

                    //echo $this->session->userdata('id_user'); die;

                    $q_3 = $this->db->get_where("tbl_agen",
                        array(
                                "id_agen"=>$this->session->userdata('id_user')
                        )
                    )->row();

                    $id_baitullah = "";
                    $id_manajer = "";
                    //$id_direktur = $q_3->sponsor_atasan;
                    $id_direktur = $this->session->userdata('id_user');

                    //echo $id_direktur;die;

                    $id_presdir = $this->db
                        ->get_where("tbl_agen",
                            array(
                                    "id_agen"=>$this->session->userdata('id_user')
                            ))->row()->sponsor_atasan;


                    //echo $id_presdir; die;
                    if($agen_pemilik_id==$this->session->userdata('id_user')){
                        $id_baitullah = null;
                        $id_manajer = null;
                        $id_direktur = $this->session->userdata('id_user');
                        $id_presiden_direktur = $id_presdir;
                    } else if ($agen_pemilik_id!=$this->session->userdata('id_user')){
                        $id_baitullah = null;
                        $id_manajer = $agen_pemilik_id;
                        $id_direktur = $this->session->userdata('id_user');
                        $id_presiden_direktur = $id_presdir;
                    }

                } else if($this->session->userdata('nama_level')=="presiden_direktur"){
                    $q_4 = $this->db
                        ->get_where("tbl_agen",
                            array(
                                    "id_agen"=>$this->session->userdata('id_user')
                            )
                        );

                    $id_baitullah = "";
                    $id_manajer = "";
                    $id_direktur = "";
                    $id_presdir = "";

                    if($agen_pemilik_id==$this->session->userdata("id_user")){
                        $id_baitullah = null;
                        $id_manajer = null;
                        $id_direktur = null;
                        $id_presiden_direktur = $this->session->userdata("id_user");
                    } else if($agen_pemilik_id!=$this->session->userdata("id_user")){
                        $id_baitullah = null;
                        $id_manajer = null;
                        $id_direktur = $agen_pemilik_id;
                        $id_presiden_direktur = $this->session->userdata("id_user");
                    }
                }
                //die;


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

                if ($metode_pembayaran != "") {
                    array_push($array_cek_lengkap, 'metode_pembayaran');
                }

                if ($uang_pembayaran != "") {
                    array_push($array_cek_lengkap, 'uang_pembayaran');
                }

                if ($tgl_berangkat != "") {
                    array_push($array_cek_lengkap, 'tgl_berangkat');
                }
                if ($user_id != "") {
                    array_push($array_cek_lengkap, 'user_id');
                }

                if ($agen_id != "") {
                    array_push($array_cek_lengkap, 'agen_id');
                }
                if ($tgl_input != "") {
                    array_push($array_cek_lengkap, 'tgl_input');
                }
                if ($tgl_update != "") {
                    array_push($array_cek_lengkap, 'tgl_update');
                }

                if ($lamp_bukti_tf_jamaah != "") {
                    array_push($array_cek_lengkap, 'lamp_bukti_tf_jamaah');
                }

                if ($agen_pemilik_id != "") {
                    array_push($array_cek_lengkap, 'agen_pemilik_id');
                }

                //echo sizeof($array_cek_lengkap);die;
//

                //$cek_data = $this->db->get_where('tbl_jamaah', array('nama_cabang'=>$nama_cabang));
                $pesan = '';
                $status = '';
                $simpan = 'y';

                /*harusnya 32 karena sudah ditambah 3 id*/
                if (sizeof($array_cek_lengkap) == 29) {
//                            echo "dokumen lengkap";
                    $simpan = 'y';
                    $status = 'dokumen_lengkap';
                } else if (sizeof($array_cek_lengkap) < 29) {
//                            echo "dokumen belum lengkap";
                    //$simpan = 'n';
                    $simpan = 'y';
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
//                        echo "metode pembayaran: " . $metode_pembayaran . "<br>";
//                        echo "uang_muka : " . $uang_muka . "<br>";
//                        echo "tgl_berangkat : " . $tgl_berangkat . "<br>";
//                        echo "user_id : " . $user_id . "<br>";
//                        echo "gk perlu cek tgl_input : " . $tgl_input . "<br>";
//                        echo "gk perlu cek tgl_update : " . $tgl_update . "<br>";
//                        echo "gk perlu cek status : " . $status . "<br>";
//
//                        die;


//                echo $status."<br>";
//                echo sizeof($array_cek_lengkap);
//                die;

                $agen_pemilik_id_data = $this->db->get_where("tbl_agen",
                    array(
                        "id_agen" => $agen_pemilik_id,
                    )
                );

                $id_atasan_pemilik_jamaah = $agen_pemilik_id_data->row()->sponsor_atasan;

                //echo $id_atasan_pemilik_jamaah;die;

                $agen_penginput_id_data = $this->db->get_where("tbl_agen",
                    array(
                        "id_agen" => $this->session->userdata("id_user"),
                    )
                );


                //echo "<pre>"; print_r($agen_pemilik_id_data->result()); die;
                //echo "<pre>"; print_r($agen_penginput_id_data->result()); die;
                if ($agen_pemilik_id_data->num_rows() > 0 && $agen_penginput_id_data->num_rows() > 0) {
                    $simpan = "y";

                    $get_role_pemilik = $this->db->get_where("tbl_role_agen",
                        array(
                            "id_role_agen" => $agen_pemilik_id_data->row()->role_agen_id
                        )
                    );
                    $get_role_penginput = $this->db->get_where("tbl_role_agen",
                        array(
                            "id_role_agen" => $agen_penginput_id_data->row()->role_agen_id
                        )
                    );

//                    echo $get_role_pemilik->row()->nama_role_agen;
//                    die;

                    //echo $get_role_pemilik->row()->nama_role_agen."<br>";
                    //echo $get_role_penginput->row()->nama_role_agen;
                    //die;
                } else if ($agen_pemilik_id_data->num_rows() == 0 && $agen_penginput_id_data->num_rows() == 0) {
                    $simpan = "n";
                }
                //die;
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
                            'status_pembayaran' => $metode_pembayaran,
                            'uang_pembayaran' => $uang_pembayaran,
                            'tgl_berangkat' => $tgl_berangkat,
                            'user_id' => $user_id,
                            'agen_id' => $agen_id,
                            'tgl_input' => $tgl_input,
                            'tgl_update' => $tgl_update,
                            'status' => $status,
                            "lamp_bukti_tf_jamaah" => $lamp_bukti_tf_jamaah,
                            "agen_pemilik_id" => $agen_pemilik_id,
                            "baitullah_id" => $id_baitullah,
                            "manajer_id" => $id_manajer,
                            "direktur_id" => $id_direktur,
                            "presdir_id" => $id_presiden_direktur,
                            "status_approval" => "pending",

                        );

                        /*utk paket haji PROSES SEBAR KOMISI AGEN DARI SINI utk paket haji*/
                        $que = $this->db->get_where("tbl_agen",
                            array(
                                "id_agen"=>$agen_pemilik_id
                            ))->row();

                        $id_role = $que->role_agen_id;

                        $get_role_pemilik_jamaah = $this->db
                            ->get_where("tbl_role_agen",
                                array(
                                    "id_role_agen"=>$id_role
                                ))
                            ->row();

                        //echo $get_role_jamaah_owner->nama_role_agen; die;



                        if($get_role_pemilik_jamaah->nama_role_agen=="baitullah_mujahid"){


                            $get_manajer = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$agen_pemilik_id
                                    ))->row();

                            $get_direktur = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_manajer->sponsor_atasan
                                    ))->row();

                            $get_presdir = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_direktur->sponsor_atasan
                                    ))->row();

                            $get_id_manajer = $get_manajer->sponsor_atasan;
                            $get_id_direktur = $get_direktur->sponsor_atasan;
                            $get_id_presdir = $get_presdir->sponsor_atasan;

                            //echo $get_id_presdir; die;

                            $get_bonus_old_baitullah = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$agen_pemilik_id
                                    ))->row()->bonus_haji;
                            $get_bonus_old_manajer = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_manajer
                                    ))->row()->bonus_haji;

                            $get_bonus_old_direktur = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_direktur
                                    ))->row()->bonus_haji;

                            $get_bonus_old_presdir = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_presdir
                                    ))->row()->bonus_haji;

                            $bonus_baitullah_to_save = $get_bonus_old_baitullah+25000000;
                            $bonus_manajer_to_save = $get_bonus_old_manajer+5000000;
                            $bonus_direktur_to_save = $get_bonus_old_direktur+5000000;
                            $bonus_presdir_to_save = $get_bonus_old_presdir+250000;


                            $dt_bonus_baitullah = array(
                                "bonus_haji"=>$bonus_baitullah_to_save
                            );
                            $dt_bonus_manajer = array(
                                "bonus_haji"=>$bonus_manajer_to_save
                            );
                            $dt_bonus_direktur= array(
                                "bonus_haji"=>$bonus_direktur_to_save
                            );

                            $dt_bonus_presdir = array(
                                "bonus_haji"=>$bonus_presdir_to_save
                            );
                            $update_bonus_baitullah = $this->db->update('tbl_agen',
                                $dt_bonus_baitullah,
                                array(
                                    "id_agen"=>$agen_pemilik_id
                                ));
                            $update_bonus_manajer = $this->db->update('tbl_agen',$dt_bonus_manajer,
                                array(
                                    "id_agen"=>$get_id_manajer
                                ));
                            $update_bonus_direktur = $this->db->update('tbl_agen',$dt_bonus_direktur,
                                array(
                                    "id_agen"=>$get_id_direktur
                                ));

                            $update_bonus_presdir = $this->db->update('tbl_agen',$dt_bonus_presdir,
                                array(
                                    "id_agen"=>$get_id_presdir
                                ));

//                        echo $bonus_baitullah_to_save."<br>";
//                        echo $bonus_manajer_to_save."<br>";
//                        echo $bonus_manajer_to_save."<br>";
//                        die;


                        } else if($get_role_pemilik_jamaah->nama_role_agen=="manajer_mujahid"){
//                        echo "disini tentukan bonus utk manajer"; die;
                            /*JIKA ID PEMILIK AGEN MERUPAKAN MANAJER*/
                            //echo "pemilik jamaah adalah seorang manajer"; die;
                            $get_direktur = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$agen_pemilik_id
                                    ))->row();

                            //echo $get_direktur_id; die;

                            $get_presdir = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_direktur->sponsor_atasan
                                    ))->row();

                            $get_id_manajer = $agen_pemilik_id;
                            $get_id_direktur = $get_direktur->sponsor_atasan;
                            $get_id_presdir = $get_presdir->sponsor_atasan;

                            //echo $get_id_presdir; die;




//                        echo "id manajer:".$get_id_manajer."<br>";
//                        echo "id direktur:".$get_id_direktur."<br>";
//                        die;

                            $get_bonus_old_manajer = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_manajer
                                    ))->row()->bonus_haji;

                            $get_bonus_old_direktur = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_direktur
                                    ))->row()->bonus_haji;

                            $get_bonus_old_presdir = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_presdir
                                    ))->row()->bonus_haji;

//                        echo "bonus old manajer:".$get_bonus_old_manajer."<br>";
//                        echo "bonus old direktur:".$get_bonus_old_direktur."<br>";
//                        die;
                            $bonus_manajer_to_save = $get_bonus_old_manajer+30000000;
                            $bonus_direktur_to_save = $get_bonus_old_direktur+5000000;
                            $bonus_presdir_to_save = $get_bonus_old_presdir+250000;

                            $dt_bonus_manajer = array(
                                "bonus_haji"=>$bonus_manajer_to_save
                            );
                            $dt_bonus_direktur= array(
                                "bonus_haji"=>$bonus_direktur_to_save
                            );

                            $dt_bonus_presdir = array(
                                "bonus_haji"=>$bonus_presdir_to_save
                            );

                            $update_bonus_manajer = $this->db->update('tbl_agen',$dt_bonus_manajer,
                                array(
                                    "id_agen"=>$get_id_manajer
                                ));
                            $update_bonus_direktur = $this->db
                                ->update('tbl_agen',$dt_bonus_direktur,
                                    array(
                                        "id_agen"=>$get_id_direktur
                                    ));

                            $update_bonus_presdir = $this->db->update('tbl_agen',$dt_bonus_presdir,
                                array(
                                    "id_agen"=>$get_id_presdir
                                ));



                        } else if($get_role_pemilik_jamaah->nama_role_agen=="direktur_mujahid"){
//                        echo "disini tentukan bonus utk manajer"; die;
                            /*JIKA ID PEMILIK AGEN MERUPAKAN MANAJER*/
                            //echo "pemilik jamaah adalah seorang direktur"; die;
                            $get_id_direktur = $agen_pemilik_id;
                            $get_id_presdir = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_direktur
                                    ))->row()->sponsor_atasan;


                            //echo $get_id_presdir; die;
                            $get_bonus_old_direktur = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_direktur
                                    )
                                )->row()->bonus_haji;

//                        echo "bonus : ".$get_bonus_old_direktur; die;

                            $get_bonus_old_presdir = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_presdir
                                    ))->row()->bonus_haji;

                            // echo "bonus : ".$get_bonus_old_presdir; die;

                            $bonus_direktur_to_save = $get_bonus_old_direktur+35000000;
                            $bonus_presdir_to_save = $get_bonus_old_presdir+250000;

                            $dt_bonus_direktur = array(
                                "bonus_haji"=>$bonus_direktur_to_save
                            );
                            $dt_bonus_presdir = array(
                                "bonus_haji"=>$bonus_presdir_to_save
                            );

                            $update_bonus_direktur = $this->db
                                ->update("tbl_agen",$dt_bonus_direktur,
                                    array(
                                        "id_agen"=>$get_id_direktur
                                    ));

                            $update_bonus_presdir = $this->db->update('tbl_agen',$dt_bonus_presdir,
                                array(
                                    "id_agen"=>$get_id_presdir
                                ));
                        }

                        /*utk paket haji PROSES SEBAR KOMISI AGEN SAMPAI SINI utk paket haji*/
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
                            'status_pembayaran' => $metode_pembayaran,
                            'uang_pembayaran' => $uang_pembayaran,
                            'tgl_berangkat' => $tgl_berangkat,
                            'user_id' => $user_id,
                            'agen_id' => $agen_id,
                            'tgl_input' => $tgl_input,
                            'tgl_update' => $tgl_update,
                            'status' => $status,
                            "lamp_bukti_tf_jamaah" => $lamp_bukti_tf_jamaah,
                            "agen_pemilik_id" => $agen_pemilik_id,
                            "baitullah_id" => $id_baitullah,
                            "manajer_id" => $id_manajer,
                            "direktur_id" => $id_direktur,
                            "presdir_id" => $id_presiden_direktur,
                            "status_approval" => "pending",
                        );

                        /*utk paket umroh PROSES SEBAR KOMISI AGEN DARI SINI utk paket umroh*/
                        $que = $this->db->get_where("tbl_agen",
                            array(
                                "id_agen"=>$agen_pemilik_id
                            ))->row();
                        //brekele

                        $id_role = $que->role_agen_id;

                        $get_role_pemilik_jamaah = $this->db
                            ->get_where("tbl_role_agen",
                                array(
                                    "id_role_agen"=>$id_role
                                ))
                            ->row();

                        //echo $get_role_jamaah_owner->nama_role_agen; die;



                        if($get_role_pemilik_jamaah->nama_role_agen=="baitullah_mujahid"){


                            $get_manajer_umroh = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$agen_pemilik_id
                                    ))->row();

                            $get_direktur_umroh = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_manajer_umroh->sponsor_atasan
                                    ))->row();

                            $get_presdir_umroh = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_direktur_umroh->sponsor_atasan
                                    ))->row();

                            $get_id_manajer_umroh = $get_manajer_umroh->sponsor_atasan;
                            $get_id_direktur_umroh = $get_direktur_umroh->sponsor_atasan;
                            $get_id_presdir_umroh = $get_presdir_umroh->sponsor_atasan;

                            //echo $get_id_presdir; die;

                            $get_bonus_old_umroh_baitullah = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$agen_pemilik_id
                                    ))->row()->bonus;
                            $get_bonus_old_umroh_manajer = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_manajer_umroh
                                    ))->row()->bonus;

                            $get_bonus_old_umroh_direktur = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_direktur_umroh
                                    ))->row()->bonus;

                            $get_bonus_old_umroh_presdir = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_presdir_umroh
                                    ))->row()->bonus;

                            $bonus_baitullah_umroh_to_save = $get_bonus_old_umroh_baitullah+3000000;
                            $bonus_manajer_umroh_to_save = $get_bonus_old_umroh_manajer+500000;
                            $bonus_direktur_umroh_to_save = $get_bonus_old_umroh_direktur+500000;
                            $bonus_presdir_umroh_to_save = $get_bonus_old_umroh_presdir+250000;


                            $dt_bonus_umroh_baitullah = array(
                                "bonus"=>$bonus_baitullah_umroh_to_save
                            );
                            $dt_bonus_umroh_manajer = array(
                                "bonus"=>$bonus_manajer_umroh_to_save
                            );
                            $dt_bonus_umroh_direktur= array(
                                "bonus"=>$bonus_direktur_umroh_to_save
                            );

                            $dt_bonus_umroh_presdir = array(
                                "bonus"=>$bonus_presdir_umroh_to_save
                            );
                            $update_bonus_umroh_baitullah = $this->db->update('tbl_agen',$dt_bonus_umroh_baitullah,
                                array(
                                    "id_agen"=>$agen_pemilik_id
                                ));
                            $update_bonus_umroh_manajer = $this->db->update('tbl_agen',$dt_bonus_umroh_manajer,
                                array(
                                    "id_agen"=>$get_id_manajer_umroh
                                ));
                            $update_bonus_umroh_direktur = $this->db->update('tbl_agen',$dt_bonus_umroh_direktur,
                                array(
                                    "id_agen"=>$get_id_direktur_umroh
                                ));

                            $update_bonus_umroh_presdir = $this->db->update('tbl_agen',$dt_bonus_umroh_presdir,
                                array(
                                    "id_agen"=>$get_id_presdir_umroh
                                ));

//                        echo $bonus_baitullah_to_save."<br>";
//                        echo $bonus_manajer_to_save."<br>";
//                        echo $bonus_manajer_to_save."<br>";
//                        die;


                        } else if($get_role_pemilik_jamaah->nama_role_agen=="manajer_mujahid"){
//                        echo "disini tentukan bonus utk manajer"; die;
                            /*JIKA ID PEMILIK AGEN MERUPAKAN MANAJER*/
                            //echo "pemilik jamaah adalah seorang manajer"; die;
                            $get_direktur_umroh = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$agen_pemilik_id
                                    ))->row();

                            //echo $get_direktur_id; die;

                            $get_presdir_umroh = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_direktur_umroh->sponsor_atasan
                                    ))->row();

                            $get_id_manajer_umroh = $agen_pemilik_id;
                            $get_id_direktur_umroh = $get_direktur_umroh->sponsor_atasan;
                            $get_id_presdir_umroh = $get_presdir_umroh->sponsor_atasan;

                            //echo $get_id_presdir; die;

//                        echo "id manajer:".$get_id_manajer."<br>";
//                        echo "id direktur:".$get_id_direktur."<br>";
//                        die;

                            $get_bonus_old_manajer_umroh = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_manajer_umroh
                                    ))->row()->bonus;

                            $get_bonus_old_direktur_umroh = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_direktur_umroh
                                    ))->row()->bonus;

                            $get_bonus_old_presdir_umroh = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_presdir_umroh
                                    ))->row()->bonus;

//                        echo "bonus old manajer:".$get_bonus_old_manajer."<br>";
//                        echo "bonus old direktur:".$get_bonus_old_direktur."<br>";
//                        die;
                            $bonus_umroh_manajer_to_save = $get_bonus_old_manajer_umroh+3500000;
                            $bonus_umroh_direktur_to_save = $get_bonus_old_direktur_umroh+500000;
                            $bonus_umroh_presdir_to_save = $get_bonus_old_presdir_umroh+250000;

                            $dt_bonus_umroh_manajer = array(
                                "bonus"=>$bonus_umroh_manajer_to_save
                            );
                            $dt_bonus_umroh_direktur= array(
                                "bonus"=>$bonus_umroh_direktur_to_save
                            );

                            $dt_bonus_umroh_presdir = array(
                                "bonus"=>$bonus_umroh_presdir_to_save
                            );

                            $update_bonus_umroh_manajer = $this->db->update('tbl_agen',$dt_bonus_umroh_manajer,
                                array(
                                    "id_agen"=>$get_id_manajer_umroh
                                ));
                            $update_bonus_umroh_direktur = $this->db
                                ->update('tbl_agen',$dt_bonus_umroh_direktur,
                                    array(
                                        "id_agen"=>$get_id_direktur_umroh
                                    ));

                            $update_bonus_umroh_presdir = $this->db->update('tbl_agen',$dt_bonus_umroh_presdir,
                                array(
                                    "id_agen"=>$get_id_presdir_umroh
                                ));



                        } else if($get_role_pemilik_jamaah->nama_role_agen=="direktur_mujahid"){
//                        echo "disini tentukan bonus utk manajer"; die;
                            /*JIKA ID PEMILIK AGEN MERUPAKAN MANAJER*/
                            //echo "pemilik jamaah adalah seorang direktur"; die;
                            $get_id_direktur_umroh = $agen_pemilik_id;
                            $get_id_presdir_umroh = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_direktur_umroh
                                    ))->row()->sponsor_atasan;


                            //echo $get_id_presdir; die;
                            $get_bonus_umroh_old_direktur = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_direktur_umroh
                                    )
                                )->row()->bonus;

//                        echo "bonus : ".$get_bonus_old_direktur; die;

                            $get_bonus_umroh_old_presdir = $this->db
                                ->get_where("tbl_agen",
                                    array(
                                        "id_agen"=>$get_id_presdir_umroh
                                    ))->row()->bonus;

                            // echo "bonus : ".$get_bonus_old_presdir; die;

                            $bonus_umroh_direktur_to_save = $get_bonus_umroh_old_direktur+4000000;
                            //echo "bonus umroh lama presdir: ".$get_bonus_umroh_old_presdir; die;
                            //echo "bonus umroh lama direktur: ".$get_bonus_umroh_old_direktur; die;
                            $bonus_umroh_presdir_to_save = $get_bonus_umroh_old_presdir+250000;

                            $dt_bonus_umroh_direktur = array(
                                "bonus"=>$bonus_umroh_direktur_to_save
                            );
                            $dt_bonus_umroh_presdir = array(
                                "bonus"=>$bonus_umroh_presdir_to_save
                            );

                            $update_bonus_umroh_direktur = $this->db
                                ->update("tbl_agen",$dt_bonus_umroh_direktur,
                                    array(
                                        "id_agen"=>$get_id_direktur_umroh
                                    ));

                            $update_bonus_umroh_presdir = $this->db->update('tbl_agen',$dt_bonus_umroh_presdir,
                                array(
                                    "id_agen"=>$get_id_presdir_umroh
                                ));
                        }



                        /*utk paket umroh PROSES SEBAR KOMISI AGEN SAMPAI SINI*/
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
                $pilihan_paket = htmlentities(strip_tags($this->input->post('pilihan_paket')));
                $jenis_paket = htmlentities(strip_tags($this->input->post('jenis_paket')));
                $metode_pembayaran = htmlentities(strip_tags($this->input->post('jenis_pembayaran')));
                $uang_pembayaran = htmlentities(strip_tags($this->input->post('uang_pembayaran')));
                $tgl_berangkat_edit = htmlentities(strip_tags($this->input->post('tgl_berangkat_edit')));
                $user_id = $this->session->userdata('id_user');
                $agen_id = $this->session->userdata('id_user');
                $tgl_update = date('Y-m-d H:i:s');
                $agen_pemilik_id = htmlentities(strip_tags($this->input->post('agen_pemilik_id')));
                //$tgl_input = date('Y-m-d H:i:s');



                //die;

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

                $array_cek_lengkap_edit = array();

                if ($nama_jamaah_edit != "") {
                    array_push($array_cek_lengkap_edit, 'nama_jamaah_edit');
                }

                if ($tempat_lahir_edit != "") {
                    array_push($array_cek_lengkap_edit, 'tempat_lahir_edit');
                }

                if ($tgl_lahir_edit != "") {
                    array_push($array_cek_lengkap_edit, 'tgl_lahir_edit');
                }

                if ($usia_edit != "") {
                    array_push($array_cek_lengkap_edit, 'usia_edit');
                }

                if ($no_paspor_edit != "") {
                    array_push($array_cek_lengkap_edit, 'no_paspor_edit');
                }

                if ($tgl_paspor_publish_edit != "") {
                    array_push($array_cek_lengkap_edit, 'tgl_paspor_publish_edit');
                }

                if ($tgl_paspor_expired_edit != "") {
                    array_push($array_cek_lengkap_edit, 'tgl_paspor_expired_edit');
                }
                if ($tempat_paspor_publish_edit != "") {
                    array_push($array_cek_lengkap_edit, 'tempat_paspor_publish_edit');
                }

                if ($alamat_lengkap_edit != "") {
                    array_push($array_cek_lengkap_edit, 'alamat_lengkap_edit');
                }

                if ($jenis_kelamin_edit != "") {
                    array_push($array_cek_lengkap_edit, 'jenis_kelamin_edit');
                }

                if ($no_telp_edit != "") {
                    array_push($array_cek_lengkap_edit, 'no_telp_edit');
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

                if ($pilihan_paket != "") {
                    array_push($array_cek_lengkap_edit, 'pilihan_paket');
                }

                if ($jenis_paket != "") {
                    array_push($array_cek_lengkap_edit, 'jenis_paket');
                }

                if ($metode_pembayaran != "") {
                    array_push($array_cek_lengkap_edit, 'metode_pembayaran');
                }

                if ($uang_pembayaran != "") {
                    array_push($array_cek_lengkap_edit, 'uang_pembayaran');
                }

                if ($tgl_berangkat_edit != "") {
                    array_push($array_cek_lengkap_edit, 'tgl_berangkat_edit');
                }

                if ($user_id != "") {
                    array_push($array_cek_lengkap_edit, 'user_id');
                }
                if ($agen_id != "") {
                    array_push($array_cek_lengkap_edit, 'agen_id');
                }

                if ($tgl_update != "") {
                    array_push($array_cek_lengkap_edit, 'tgl_update');
                }

                if ($lamp_bukti_tf_jamaah_to_save != "") {
                    array_push($array_cek_lengkap_edit, 'lamp_bukti_tf_jamaah_to_save');
                }

                if ($agen_pemilik_id != "") {
                    array_push($array_cek_lengkap_edit, 'agen_pemilik_id');
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


//                echo "size array cek lengkap edit : ".sizeof($array_cek_lengkap_edit)."<br>";
//
//                die;

                $pesan = '';
                $status = '';
                $simpan = 'y';

                if (sizeof($array_cek_lengkap_edit) == 28) {
//                            echo "dokumen lengkap";
                    $simpan = 'y';
                    $status = 'dokumen_lengkap';
                } else if (sizeof($array_cek_lengkap_edit) < 28) {
//                            echo "dokumen belum lengkap";
//                    $simpan = 'n';
                    $simpan = 'y';
                    $status = 'dokumen_belum_lengkap';
                }

                //echo "simpan : ". $simpan; die;

                if ($simpan == 'y') {
                    //echo $pilihan_paket; die;
                    if ($pilihan_paket == "paket_haji") {

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
                            'paket_haji_id' => $jenis_paket,
                            'paket_umroh_id' => null,
                            'status_pembayaran' => $metode_pembayaran,
                            'uang_pembayaran' => $uang_pembayaran,
                            'tgl_berangkat' => $tgl_berangkat_edit,
                            'user_id' => $user_id,
                            'agen_id' => $this->session->userdata('id_user'),
                            'tgl_update' => $tgl_update,
                            'status' => $status,
                            'lamp_bukti_tf_jamaah' => $lamp_bukti_tf_jamaah_to_save,
                            "agen_pemilik_id" => $agen_pemilik_id,

                        );

                        /*utk paket HAJI UPDATE DARI SINI*/
                        $bonus_to_save_pemilik_old = 0;
                        $bonus_to_save_pemilik_baru = 0;
                        $cek_datas = $this->db->get_where("tbl_jamaah",
                            array(
                                'id_jamaah' => $id_jamaah
                            ))->row();

                        $agen_pemilik_id_olds = $cek_datas->agen_pemilik_id;

                        $get_data_pemilik_olds = $this->db
                            ->get_where("tbl_agen",
                                array
                                (
                                    "id_agen"=>$agen_pemilik_id_olds
                                )
                            );

                        $get_role_id_pemilik_olds = $get_data_pemilik_olds->row()->role_agen_id;
                        $get_data_role_pemilik_olds = $this->db
                            ->get_where("tbl_role_agen",
                                array(
                                    "id_role_agen"=>$get_role_id_pemilik_olds
                                )
                            );
                        /*disini ambil data lain dari tbl role agen kalo mau*/
                        $nama_role_pemilik_olds = $get_data_role_pemilik_olds->row()->nama_role_agen;

                        if($nama_role_pemilik_olds=="baitullah_mujahid"){
                            //echo "pemilik jamaah lama adalah baitullah mujahid";
                            if($agen_pemilik_id_olds!=$agen_pemilik_id){
                                //echo "ada perubahan kepemilikan jamaah maka ubah data bonus";die;
                                $id_pemilik_baru = $agen_pemilik_id;

                                $get_data_pemilik_olds = $this->db
                                    ->get_where("tbl_agen",
                                        array
                                        (
                                            "id_agen"=>$agen_pemilik_id_olds
                                        )
                                    )->row();

                                //echo "<pre>"; print_r($get_data_pemilik_olds);die;

                                $get_data_pemilik_barus = $this->db
                                    ->get_where("tbl_agen",
                                        array
                                        (
                                            "id_agen"=>$agen_pemilik_id
                                        )
                                    )->row();

                                //echo "<pre>"; print_r($get_data_pemilik_barus);die;

                                $bonus_old_pemilik_olds = $get_data_pemilik_olds->bonus_haji;
                                $bonus_old_pemilik_barus = $get_data_pemilik_barus->bonus_haji;

                                $bonus_to_save_pemilik_olds = $bonus_old_pemilik_olds-25000000;
                                $bonus_to_save_pemilik_barus = $bonus_old_pemilik_barus+25000000;

                                $dt_bonus_pemilik_olds = array(
                                    "bonus_haji"=>$bonus_to_save_pemilik_olds
                                );

                                $dt_bonus_pemilik_barus = array(
                                    "bonus_haji"=>$bonus_to_save_pemilik_barus
                                );

                                $update_bonus_pemilik_olds = $this->db->update('tbl_agen',
                                    $dt_bonus_pemilik_olds,
                                    array(
                                        "id_agen"=>$agen_pemilik_id_olds
                                    ));

                                $update_bonus_pemilik_barus = $this->db->update('tbl_agen',$dt_bonus_pemilik_barus,
                                    array(
                                        "id_agen"=>$agen_pemilik_id
                                    ));


                            } else if($agen_pemilik_id_olds==$agen_pemilik_id){
                                //echo "TIDAK ADA perubahan kepemilikan jamaah maka tidak ubah data bonus";die;
                                $id_pemilik_baru = $agen_pemilik_id;
                            }
                            //echo "<br> id pemilik jamaah to save : ".$id_pemilik_baru;
                        } else if($nama_role_pemilik_olds=="manajer_mujahid"){
                            //echo "pemilik jamaah lama adalah manajer mujahid"; die;
                            if($agen_pemilik_id_olds!=$agen_pemilik_id){
                                //echo "<br>ada perubahan kepemilikan agen"; die;
                                $id_pemilik_barus = $agen_pemilik_id;

                                $get_data_pemilik_olds = $this->db
                                    ->get_where("tbl_agen",
                                        array(
                                            "id_agen"=>$agen_pemilik_id_olds
                                        )
                                    )->row();

                                $get_data_pemilik_barus = $this->db
                                    ->get_where("tbl_agen",
                                        array(
                                            "id_agen"=>$agen_pemilik_id
                                        )
                                    )->row();
                                $bonus_old_pemilik_olds = $get_data_pemilik_olds->bonus_haji;
                                $bonus_old_pemilik_barus = $get_data_pemilik_barus->bonus_haji;

                                $bonus_to_save_pemilik_olds = $bonus_old_pemilik_olds-25000000;
                                $bonus_to_save_pemilik_barus = $bonus_old_pemilik_barus+25000000;

                                $dt_bonus_pemilik_olds = array(
                                    "bonus_haji"=>$bonus_to_save_pemilik_olds
                                );

                                $dt_bonus_pemilik_barus = array(
                                    "bonus_haji"=>$bonus_to_save_pemilik_barus
                                );

                                $update_bonus_pemilik_olds = $this->db->update("tbl_agen",
                                    $dt_bonus_pemilik_olds,
                                    array(
                                        "id_agen"=>$agen_pemilik_id_olds
                                    )
                                );

                                $update_bonus_pemilik_barus = $this->db->update("tbl_agen",
                                    $dt_bonus_pemilik_barus,
                                    array(
                                        "id_agen"=>$agen_pemilik_id
                                    )
                                );
                            } else if($agen_pemilik_id_olds==$agen_pemilik_id){
                                //echo "TIDAK ADA perubahan kepemilikan jamaah maka tidak ubah data bonus";
                            }
                        } else if($nama_role_pemilik_olds=="direktur_mujahid"){
                            echo "pemilik jamaah lama adalah direktur mujahid";
                            if($agen_pemilik_id_olds!=$agen_pemilik_id){
                                /*kampret*/
                                //echo $agen_pemilik_id; die;
                                $get_data_pemilik_olds = $this->db
                                    ->get_where("tbl_agen",
                                        array(
                                            "id_agen"=>$agen_pemilik_id_olds
                                        )
                                    )->row();

                                $get_data_pemilik_barus = $this->db
                                    ->get_where("tbl_agen",
                                        array(
                                            "id_agen"=>$agen_pemilik_id
                                        )
                                    )->row();

                                $bonus_old_pemilik_olds = $get_data_pemilik_olds->bonus_haji;
                                $bonus_old_pemilik_barus = $get_data_pemilik_barus->bonus_haji;

                                $bonus_to_save_pemilik_olds = $bonus_old_pemilik_olds-30000000;
                                $bonus_to_save_pemilik_barus = $bonus_old_pemilik_barus+30000000;

                                $dt_bonus_pemilik_olds = array(
                                    "bonus_haji"=>$bonus_to_save_pemilik_olds
                                );

                                $dt_bonus_pemilik_barus = array(
                                    "bonus_haji"=>$bonus_to_save_pemilik_barus
                                );

                                $update_bonus_pemilik_olds = $this->db->update("tbl_agen",
                                    $dt_bonus_pemilik_olds,
                                    array(
                                        "id_agen"=>$agen_pemilik_id_olds
                                    )
                                );

                                $update_bonus_pemilik_barus = $this->db->update("tbl_agen",
                                    $dt_bonus_pemilik_barus,
                                    array(
                                        "id_agen"=>$agen_pemilik_id
                                    )
                                );
                            } else if($agen_pemilik_id_olds==$agen_pemilik_id){

                            }
                        } else if($nama_role_pemilik_olds=="presiden_direktur"){
                            echo "pemilik jamaah lama adalah presiden direktur";
                        }

                        /*utk paket HAJI UPDATE SAMPAI SINI*/
                    } else if ($pilihan_paket == "paket_umroh") {
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
                            'paket_umroh_id' => $jenis_paket,
                            'status_pembayaran' => $metode_pembayaran,
                            'uang_pembayaran' => $uang_pembayaran,
                            'tgl_berangkat' => $tgl_berangkat_edit,
                            'user_id' => $user_id,
                            'agen_id' => $this->session->userdata('id_user'),
                            'tgl_update' => $tgl_update,
                            'status' => $status,
                            'lamp_bukti_tf_jamaah' => $lamp_bukti_tf_jamaah_to_save,
                            "agen_pemilik_id" => $agen_pemilik_id,

                        );

                        /*utk paket UMROH UPDATE DARI SINI*/
                        $bonus_to_save_pemilik_old = 0;
                        $bonus_to_save_pemilik_baru = 0;
                        $cek_data = $this->db->get_where("tbl_jamaah",
                            array(
                                'id_jamaah' => $id_jamaah
                            ))->row();

                        $agen_pemilik_id_old = $cek_data->agen_pemilik_id;

                        $get_data_pemilik_old = $this->db
                            ->get_where("tbl_agen",
                                array
                                (
                                    "id_agen"=>$agen_pemilik_id_old
                                )
                            );

                        $get_role_id_pemilik_old = $get_data_pemilik_old->row()->role_agen_id;
                        $get_data_role_pemilik_old = $this->db
                            ->get_where("tbl_role_agen",
                                array(
                                    "id_role_agen"=>$get_role_id_pemilik_old
                                )
                            );
                        /*disini ambil data lain dari tbl role agen kalo mau*/
                        $nama_role_pemilik_old = $get_data_role_pemilik_old->row()->nama_role_agen;

                        if($nama_role_pemilik_old=="baitullah_mujahid"){
                            //echo "pemilik jamaah lama adalah baitullah mujahid";
                            if($agen_pemilik_id_old!=$agen_pemilik_id){
                                //echo "ada perubahan kepemilikan jamaah maka ubah data bonus";die;
                                $id_pemilik_baru = $agen_pemilik_id;

                                $get_data_pemilik_old = $this->db
                                    ->get_where("tbl_agen",
                                        array
                                        (
                                            "id_agen"=>$agen_pemilik_id_old
                                        )
                                    )->row();

                                $get_data_pemilik_baru = $this->db
                                    ->get_where("tbl_agen",
                                        array
                                        (
                                            "id_agen"=>$agen_pemilik_id
                                        )
                                    )->row();

                                $bonus_old_pemilik_old = $get_data_pemilik_old->bonus;
                                $bonus_old_pemilik_baru = $get_data_pemilik_baru->bonus;

                                $bonus_to_save_pemilik_old = $bonus_old_pemilik_old-25000000;
                                $bonus_to_save_pemilik_baru = $bonus_old_pemilik_baru+25000000;

                                $dt_bonus_pemilik_old = array(
                                    "bonus"=>$bonus_to_save_pemilik_old
                                );

                                $dt_bonus_pemilik_baru = array(
                                    "bonus"=>$bonus_to_save_pemilik_baru
                                );

                                $update_bonus_pemilik_old = $this->db->update('tbl_agen',
                                    $dt_bonus_pemilik_old,
                                    array(
                                        "id_agen"=>$agen_pemilik_id_old
                                    ));

                                $update_bonus_pemilik_baru = $this->db->update('tbl_agen',$dt_bonus_pemilik_baru,
                                    array(
                                        "id_agen"=>$agen_pemilik_id
                                    ));


                            } else if($agen_pemilik_id_old==$agen_pemilik_id){
                                //echo "TIDAK ADA perubahan kepemilikan jamaah maka tidak ubah data bonus";die;
                                $id_pemilik_baru = $agen_pemilik_id;
                            }
                            //echo "<br> id pemilik jamaah to save : ".$id_pemilik_baru;
                        } else if($nama_role_pemilik_old=="manajer_mujahid"){
                            echo "pemilik jamaah lama adalah manajer mujahid";
                            if($agen_pemilik_id_old!=$agen_pemilik_id){
                                //echo "<br>ada perubahan kepemilikan agen"; die;
                                $id_pemilik_baru = $agen_pemilik_id;

                                $get_data_pemilik_old = $this->db
                                    ->get_where("tbl_agen",
                                        array(
                                            "id_agen"=>$agen_pemilik_id_old
                                        )
                                    )->row();

                                $get_data_pemilik_baru = $this->db
                                    ->get_where("tbl_agen",
                                        array(
                                            "id_agen"=>$agen_pemilik_id
                                        )
                                    )->row();
                                $bonus_old_pemilik_old = $get_data_pemilik_old->bonus;
                                $bonus_old_pemilik_baru = $get_data_pemilik_baru->bonus;

                                $bonus_to_save_pemilik_old = $bonus_old_pemilik_old-25000000;
                                $bonus_to_save_pemilik_baru = $bonus_old_pemilik_baru+25000000;

                                $dt_bonus_pemilik_old = array(
                                    "bonus"=>$bonus_to_save_pemilik_old
                                );

                                $dt_bonus_pemilik_baru = array(
                                    "bonus"=>$bonus_to_save_pemilik_baru
                                );

                                $update_bonus_pemilik_old = $this->db->update("tbl_agen",
                                    $dt_bonus_pemilik_old,
                                    array(
                                        "id_agen"=>$agen_pemilik_id_old
                                    )
                                );

                                $update_bonus_pemilik_baru = $this->db->update("tbl_agen",
                                    $dt_bonus_pemilik_baru,
                                    array(
                                        "id_agen"=>$agen_pemilik_id
                                    )
                                );
                            } else if($agen_pemilik_id_old==$agen_pemilik_id){
                                //echo "TIDAK ADA perubahan kepemilikan jamaah maka tidak ubah data bonus";
                            }
                        } else if($nama_role_pemilik_old=="direktur_mujahid"){
                            echo "pemilik jamaah lama adalah direktur mujahid";
                            if($agen_pemilik_id_old!=$agen_pemilik_id){
                                /*kampret*/
                                //echo $agen_pemilik_id; die;
                                $get_data_pemilik_old = $this->db
                                    ->get_where("tbl_agen",
                                        array(
                                            "id_agen"=>$agen_pemilik_id_old
                                        )
                                    )->row();

                                $get_data_pemilik_baru = $this->db
                                    ->get_where("tbl_agen",
                                        array(
                                            "id_agen"=>$agen_pemilik_id
                                        )
                                    )->row();

                                $bonus_old_pemilik_old = $get_data_pemilik_old->bonus;
                                $bonus_old_pemilik_baru = $get_data_pemilik_baru->bonus;

                                $bonus_to_save_pemilik_old = $bonus_old_pemilik_old-30000000;
                                $bonus_to_save_pemilik_baru = $bonus_old_pemilik_baru+30000000;

                                $dt_bonus_pemilik_old = array(
                                    "bonus"=>$bonus_to_save_pemilik_old
                                );

                                $dt_bonus_pemilik_baru = array(
                                    "bonus"=>$bonus_to_save_pemilik_baru
                                );

                                $update_bonus_pemilik_old = $this->db->update("tbl_agen",
                                    $dt_bonus_pemilik_old,
                                    array(
                                        "id_agen"=>$agen_pemilik_id_old
                                    )
                                );

                                $update_bonus_pemilik_baru = $this->db->update("tbl_agen",
                                    $dt_bonus_pemilik_baru,
                                    array(
                                        "id_agen"=>$agen_pemilik_id
                                    )
                                );
                            } else if($agen_pemilik_id_old==$agen_pemilik_id){

                            }
                        } else if($nama_role_pemilik_old=="presiden_direktur"){
                            echo "pemilik jamaah lama adalah presiden direktur";
                        }

                        /*utk paket UMROH UPDATE SAMPAI SINI*/
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
