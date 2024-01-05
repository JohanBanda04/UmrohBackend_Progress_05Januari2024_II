<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
	   // echo "wkwkwk" ; die;
        //echo $this->session->userdata('id_user'); die;
		$ceks = $this->session->userdata('username');
		//echo $ceks; die;
		$id_user = $this->session->userdata('id_user');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
		    //echo "wkwkwkekek"; die;
            //echo $this->session->userdata('id_user'); die;
            $tbl_zona = $this->db->get_where('tbl_zona',array('id_zona'=>$_SESSION['id_zona']));
            $tbl_user = $this->db->get_where('tbl_user',array('id_zona'=>$_SESSION['id_zona']));

            //echo $this->session->userdata('id_user'); die;
            if($this->session->userdata("nama_level")=="administrator"){
                $data['total_jamaah'] = $this->db->get("tbl_jamaah");
            } else if($this->session->userdata("nama_level")=="baitullah_mujahid"){
                $data['total_jamaah'] = $this->db->query("select * from tbl_jamaah where agen_id="
                    .$this->session->userdata('id_user')
                    ." or agen_pemilik_id="
                    .$this->session->userdata('id_user'));

            } else if($this->session->userdata('nama_level') == "manajer_mujahid"){
                $data['total_jamaah'] = $this->db->query("SELECT * FROM tbl_jamaah WHERE manajer_id="
                    .$this->session->userdata('id_user'));
            } else if($this->session->userdata('nama_level') == "direktur_mujahid"){
                $data['total_jamaah'] = $this->db->query("SELECT * FROM tbl_jamaah WHERE direktur_id="
                    .$this->session->userdata('id_user'));
            }else if($this->session->userdata('nama_level') == "presiden_direktur"){
                $data['total_jamaah'] = $this->db->query("SELECT * FROM tbl_jamaah WHERE presdir_id="
                    .$this->session->userdata('id_user'));
            }
            //$data['total_jamaah'] = $this->db->get_where("tbl_jamaah",array("agen_id"=>$this->session->userdata('id_user')));

            $get_tbl_agen = $this->db->get_where("tbl_agen",array("id_agen"=>$this->session->userdata('id_user')));

            $id_atasan = $get_tbl_agen->row()->sponsor_atasan;
            $data['bonus'] = $get_tbl_agen->row()->bonus_umroh_valid;
            $data['bonus_haji'] = $get_tbl_agen->row()->bonus_haji_valid;

//            echo $id_atasan; die;

            $nama_atasan= $this->db->get_where("tbl_agen",
                array(
                    "id_agen"=>$id_atasan
                )
            )->row()->nama_agen;

            //echo $nama_atasan; die;
            $data["nama_atasan"]=$nama_atasan;
           // echo "<pre>"; print_r($get_tbl_agen->row()); die;

            //echo $data['total_jamaah']->num_rows(); die;

            /*cara get semua record database pada tbl_zona*/
            $data_zonaAll = $this->db->get("tbl_zona")->result();

            //$pemda_id
            $data_harmonisasi = $this->db->get("tbl_berita")->result();

            //echo '<pre>'; print_r($tbl_user->result()[0]);die;
            //echo '<pre>'; print_r($data_harmonisasi);die;
           // echo '<pre>'; print_r($data_zonaAll);die;


            $array_daerah = array();
            $counter = 0;
            $total = 0;
            $total_dokumen = 0;
            foreach ($data_zonaAll as $key=>$val){
                if($val->nama_zona!="kasub_perancang" && $val->nama_zona!="superadmin" && $val->nama_zona!="perancang") {

                    $tbl_berita_by_zona = $this->db->get_where('tbl_berita',array(
                        'zona_dokumen'=>$val->nama_zona
                    ));

                    $tbl_berita_by_zona_selesai_only = $this->db->get_where('tbl_berita',array(
                        'zona_dokumen'=>$val->nama_zona,
                        'status'=>"selesai"
                    ));
                    $tbl_berita_by_zona_belum_selesai_only = $this->db->get_where('tbl_berita',array(
                        'zona_dokumen'=>$val->nama_zona,
                        'status !='=>"selesai"
                    ));
                   //echo $val->nama_zona." : ".$tbl_berita_by_zona->num_rows()."<br>";

                    $zona_id[$counter] = $tbl_berita_by_zona->num_rows();
                    $selesai_only[$counter] = $tbl_berita_by_zona_selesai_only->num_rows();
                    $belum_selesai_only[$counter] = $tbl_berita_by_zona_belum_selesai_only->num_rows();
                    //$zona_id_pemda[$val->id_zona] = $tbl_berita_by_zona->num_rows();
                    $pemda_id[$counter] = $val->id_zona;
                    $nama_zona[$counter] = $val->nama_panjang;


                    $total += $tbl_berita_by_zona->num_rows();
                    $total_dokumen += $tbl_berita_by_zona->num_rows();

                    $counter++;

                    array_push($array_daerah, (object)[
                        "id_zona" => $val->id_zona,
                        "nama_zona" => $val->nama_zona,
                        "nama_panjang" => $val->nama_panjang,
                        "status" => $val->status,
                        "jumlah_dokumen_harmonisasi" => $tbl_berita_by_zona->num_rows(),
                    ]);
                }
                //echo '<pre>'; print_r($data_zonaAll[$key]->nama_zona);
                //echo $val->nama_zona."<br>";

            }
            //echo $total_dokumen; die;

           // echo "<pre>"; print_r($tbl_berita_by_zona->result()); die;

           //echo "<pre>";  print_r($nama_zona); die;
            //echo "<pre>"; print_r($zona_id);

            //echo $total; die;
            //die;

            $data['realisasi_harmonisasi_total'] = $zona_id;
            $data['selesai_only'] = $selesai_only;
            $data['belum_selesai_only'] = $belum_selesai_only;
            //echo "<pre>"; print_r($zona_id); die;
            //echo "<pre>"; print_r($selesai_only); die;
            //echo "<pre>"; print_r($belum_selesai_only); die;
            $data['pemda_id'] = $pemda_id;
            $data['total'] = $total;
            //echo "<pre>"; print_r($zona_id); die;


            $data['user_bk']   	 = $this->Mcrud->get_users_by_un($ceks);
            $data['user']   	 = $this->Mcrud->get_users_by_un_tbl_agen($ceks);
            //echo "<pre>"; print_r($data['user']->row()); die;
			$data['users']  	 = $this->Mcrud->get_users();
			$data['nama_panjang_admin']  	 = $tbl_zona->row()->nama_panjang;
			$data['nama_lengkap']  	 = $tbl_user->row()->nama_lengkap;
			$data['zona_pemda']  	 = $tbl_zona->row()->nama_zona;

            $data['zona_daerah_list'] = $data_zonaAll;
            $data['zona_daerah_list_ii'] = $nama_zona;
            $data['array_daerah'] = $array_daerah;

            //echo "<pre>"; print_r($array_daerah); die;


            //echo "<pre>"; print_r($data_zonaAll); die;



//			foreach ($tbl_user->result() as $idx=>$val){
//			    if ($_SESSION['username']==$tbl_zona->row()->nama_zona){
//
//                }
//            }

			$data['judul_web'] = "Dashboard";

			//echo "wkwokwow"; die;
			$this->load->view('users/header', $data);
			$this->load->view('users/dashboard', $data);
			$this->load->view('users/footer');
		}
	}

	//lanjutkan utk beri parameter aksi dan id pada function profile ini, yg dipanggil melalui header (dlm folder user)
	public function profile($aksi='', $id='')
	{
	    //echo "wey"; die;
		$ceks = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
		    if ($aksi=="se"){
		        //echo "simpan edit";die;
                $input_old_password  = htmlentities(strip_tags($this->input->post('old_password')));
                $new_password_1 	 = htmlentities(strip_tags($this->input->post('new_password_1')));
                $new_password_2 	 = htmlentities(strip_tags($this->input->post('new_password_2')));

                //echo $new_password_1; die;

                //ini juga kunci kesuksesan get data dari database
                //$data_lama = $this->db->get_where("tbl_user", array('id_user'=>$_SESSION['id_user']))->row();
                $data_lama = $this->db->get_where("tbl_agen",
                    array(
                        'id_agen'=>$this->session->userdata('id_user')
                    )
                );


                $data_password_lama = $data_lama->result()[0]->password;

//                echo $data_password_lama."<br>";
//                echo crypt($input_old_password,'salt-coba')."<br>";
//                die;


                $id_user = $this->session->userdata("id_user");
                //echo $id_user; die;
                $nama_lengkap = $data_lama->result()[0]->nama_agen;
                $username = $data_lama->result()[0]->username;
                $password = $data_lama->result()[0]->password;
                $level = $data_lama->result()[0]->role_agen_id;
                $id_zona = $data_lama->result()[0]->id_zona;

                $pesan = "Data Belum Berhasil Disimpan!";

                //echo $data_password_lama."<br>".$input_old_password;die;

                if($data_password_lama==crypt($input_old_password,'salt-coba')){
                    //echo "inputan pass old oleh user SAMA DENGAN old pass di DB";die;
                    if($new_password_1=='' && $new_password_2==''){
                        //echo "pass 1 dan 2 tidak di isi"; die;
                        $simpan = "y";
                        //$password_to_save = $data_lama->result()[0]->password;
                        $password_to_save = $data_password_lama;
                    } else if(($new_password_1 !='' && $new_password_2 =='') or ($new_password_1 =='' && $new_password_2 !='')){
                        //echo "salah 1 inputan password baru belum di isi"; die;
                        $simpan = "n";
                    } else if($new_password_1 !='' && $new_password_2 !='') {
                        //echo "sampai sini  ygy"; die;
                        if($new_password_1 == $new_password_2){
                            //echo "password 1 dan 2 sama";die;
                            $simpan = "y";
                            $password_to_save = $new_password_1;
                        } else if ($new_password_1!=$new_password_2){
                            //echo "password 1 dan 2 tidak sama";die;
                            $simpan = "n";
                            $password_to_save = $data_lama->result()[0]->password;
                        }
//                        echo "pass to save : ".$password_to_save; die;
                    }

                    //echo "password to save : ".$password_to_save; die;

                    if($simpan=="y"){
                        $data = array(
                            'id_agen'=>$id_user,
                            'nama_agen'=>$nama_lengkap,
                            'username'=>$username,
                            'password'=>crypt($password_to_save, "salt-coba"),
                            'role_agen_id'=>$level,
                            'tgl_update'=>date('Y-m-d H:i:s'),
                        );
                        $this->db->update("tbl_agen",$data,array(
                            'id_agen'=>$id_user,
                        ));

                        $this->session->set_flashdata('msg',
                            '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses !</strong> Berhasil disimpan.
							</div>
						  <br>'
                        );

                    } else if($simpan=="n"){
                        $this->session->set_flashdata('msg',
                            '
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Gagal!</strong> '.$pesan.'.
											</div>
										 <br>'
                        );

                    }
                } else {
                    //echo "inputan pass old oleh user TIDAK SAMA DENGAN old pass di DB";die;
                    $this->session->set_flashdata('msg',
                        '
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Gagal!</strong> '.$pesan.'.
											</div>
										 <br>'
                    );

                }
                redirect("users/profile/e/".$id);
            }
            //echo "wkwkwkwkeke"; die;
			$data['user_bk']  			  = $this->Mcrud->get_users_by_un($ceks);
            $data['user']   	 = $this->Mcrud->get_users_by_un_tbl_agen($ceks);
            //echo "<pre>"; print_r($data['user']->row()); die;
			$data['user_bk']  			  = $this->Mcrud->get_users_by_un($ceks);
			$data['level_users']  = $this->Mcrud->get_level_users();
			$get_password = $this->db->get_where("tbl_user",array('id_user'=>$_SESSION['id_user']));
			//ini adalah kunci kesuksesan mendapat data dari database
            //echo $get_password->result()[0]->password; die;

            //$data['password_lama'] = $get_password->result()[0]->password;
			$data['judul_web'] 		= "Ganti Password Pengguna";

			$this->load->view('users/header', $data);
			$this->load->view('users/profile', $data);
			$this->load->view('users/footer');
		}
	}

    public function profile_atasan($aksi='', $id='')
    {
        //echo "profile atasan"; die;
        //echo hashids_decrypt($id);die;
        //echo $id;die;
        //echo $aksi."<br>";
        //echo $id; die;
        //echo $_SESSION['id_user'];die;
        $ceks = $this->session->userdata('username');

        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');
        if(!isset($ceks)) {
            redirect('web/login');
        }else{
            if ($aksi=="se"){
                //echo "simpan edit";die;
                $input_old_password  = htmlentities(strip_tags($this->input->post('old_password')));
                $new_password_1 	 = htmlentities(strip_tags($this->input->post('new_password_1')));
                $new_password_2 	 = htmlentities(strip_tags($this->input->post('new_password_2')));
                //ini juga kunci kesuksesan get data dari database
                //$data_lama = $this->db->get_where("tbl_user", array('id_user'=>$_SESSION['id_user']))->row();
                $data_lama = $this->db->get_where("tbl_user", array('id_user'=>$_SESSION['id_user']));
                $data_password_lama = $data_lama->result()[0]->password;

                //echo $old_password."<br>".$new_password_1."<br>".$new_password_2; die;

                $id_user = $_SESSION['id_user'];
                $nama_lengkap = $data_lama->result()[0]->nama_lengkap;
                $username = $data_lama->result()[0]->username;
                $password = $data_lama->result()[0]->password;
                $level = $data_lama->result()[0]->level;
                $id_zona = $data_lama->result()[0]->id_zona;

                $pesan = "Data Belum Berhasil Disimpan!";

                //echo $data_password_lama."<br>".$input_old_password;die;

                if($data_password_lama==crypt($input_old_password,'salt-coba')){
                    //echo "inputan pass old oleh user SAMA DENGAN old pass di DB";die;
                    if($new_password_1=='' && $new_password_2==''){
                        //echo "pass 1 dan 2 tidak di isi"; die;
                        $simpan = "y";
                        $password_to_save = $data_lama->result()[0]->password;
                    } else if($new_password_1 !='' || $new_password_2 !='') {

                        if($new_password_1 == $new_password_2){
                            //echo "password 1 dan 2 sama";die;
                            $simpan = "y";
                            $password_to_save = $new_password_1;
                        } else if ($new_password_1!=$new_password_2){
                            //echo "password 1 dan 2 tidak sama";die;
                            $simpan = "n";
                            $password_to_save = $data_lama->result()[0]->password;
                        }
                    }

                    if($simpan=="y"){
                        $data = array(
                            'id_user'=>$id_user,
                            'nama_lengkap'=>$nama_lengkap,
                            'username'=>$username,
                            'password'=>crypt($password_to_save, "salt-coba"),
                            'level'=>$level,
                            'id_zona'=>$id_zona,
                            'tgl_update'=>date('Y-m-d H:i:s'),
                        );
                        $this->db->update("tbl_user",$data,array(
                            'id_user'=>$id_user,
                        ));

                        $this->session->set_flashdata('msg',
                            '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses5 brohs!</strong> Berhasil disimpan.
							</div>
						  <br>'
                        );

                    } else if($simpan=="n"){
                        $this->session->set_flashdata('msg',
                            '
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Gagal!</strong> '.$pesan.'.
											</div>
										 <br>'
                        );

                    }
                } else {
                    //echo "inputan pass old oleh user TIDAK SAMA DENGAN old pass di DB";die;
                    $this->session->set_flashdata('msg',
                        '
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Gagal!</strong> '.$pesan.'.
											</div>
										 <br>'
                    );

                }
                redirect("users/profile/e/".$id);
            }
//            echo $id_user; die;
            $get_tbl_agen_for_atasan = $this->db->get_where("tbl_agen",array("id_agen"=>$id_user))->row();
            $id_atasan = $get_tbl_agen_for_atasan->sponsor_atasan;

            //echo $id_atasan; die;

            $get_dt_atasan = $this->db->get_where("tbl_agen",array("id_agen"=>$id_atasan))->row();
            $data["nama_atasan_lengkap"] = $get_dt_atasan->nama_agen;

            $get_data_role_agen = $this->db->get_where("tbl_role_agen",array("id_role_agen"=>$get_dt_atasan->role_agen_id))->row();
            $data["nama_role_atasan"] = $get_data_role_agen->nama_role_agen_lengkap;

            $get_jumlah_agen_atasan = $this->db->get_where("tbl_agen",array("sponsor_atasan"=>$id_atasan));
            $data["jumlah_agen_atasan"]=$get_jumlah_agen_atasan->num_rows();

            $data['user']  			  = $this->Mcrud->get_users_by_un_tbl_agen($ceks);
            $data['level_users']  = $this->Mcrud->get_level_users();
            $get_password = $this->db->get_where("tbl_user",array('id_user'=>$_SESSION['id_user']));
            //ini adalah kunci kesuksesan mendapat data dari database
            //echo $get_password->result()[0]->password; die;

            //$data['password_lama'] = $get_password->result()[0]->password;
            $data['judul_web'] 		= "Profile Atasan";

            $this->load->view('users/header', $data);
            $this->load->view('users/profile_atasan', $data);
            $this->load->view('users/footer');
        }
    }

    public function history_pencairan($aksi='', $id='')
    {

        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');
        if(!isset($ceks)) {
            redirect('web/login');
        }else{
            if ($aksi=="se"){
                //echo "simpan edit";die;
                $input_old_password  = htmlentities(strip_tags($this->input->post('old_password')));
                $new_password_1 	 = htmlentities(strip_tags($this->input->post('new_password_1')));
                $new_password_2 	 = htmlentities(strip_tags($this->input->post('new_password_2')));
                //ini juga kunci kesuksesan get data dari database
                //$data_lama = $this->db->get_where("tbl_user", array('id_user'=>$_SESSION['id_user']))->row();
                $data_lama = $this->db->get_where("tbl_user", array('id_user'=>$_SESSION['id_user']));
                $data_password_lama = $data_lama->result()[0]->password;

                //echo $old_password."<br>".$new_password_1."<br>".$new_password_2; die;

                $id_user = $_SESSION['id_user'];
                $nama_lengkap = $data_lama->result()[0]->nama_lengkap;
                $username = $data_lama->result()[0]->username;
                $password = $data_lama->result()[0]->password;
                $level = $data_lama->result()[0]->level;
                $id_zona = $data_lama->result()[0]->id_zona;

                $pesan = "Data Belum Berhasil Disimpan!";

                //echo $data_password_lama."<br>".$input_old_password;die;

                if($data_password_lama==crypt($input_old_password,'salt-coba')){
                    //echo "inputan pass old oleh user SAMA DENGAN old pass di DB";die;
                    if($new_password_1=='' && $new_password_2==''){
                        //echo "pass 1 dan 2 tidak di isi"; die;
                        $simpan = "y";
                        $password_to_save = $data_lama->result()[0]->password;
                    } else if($new_password_1 !='' || $new_password_2 !='') {

                        if($new_password_1 == $new_password_2){
                            //echo "password 1 dan 2 sama";die;
                            $simpan = "y";
                            $password_to_save = $new_password_1;
                        } else if ($new_password_1!=$new_password_2){
                            //echo "password 1 dan 2 tidak sama";die;
                            $simpan = "n";
                            $password_to_save = $data_lama->result()[0]->password;
                        }
                    }

                    if($simpan=="y"){
                        $data = array(
                            'id_user'=>$id_user,
                            'nama_lengkap'=>$nama_lengkap,
                            'username'=>$username,
                            'password'=>crypt($password_to_save, "salt-coba"),
                            'level'=>$level,
                            'id_zona'=>$id_zona,
                            'tgl_update'=>date('Y-m-d H:i:s'),
                        );
                        $this->db->update("tbl_user",$data,array(
                            'id_user'=>$id_user,
                        ));

                        $this->session->set_flashdata('msg',
                            '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses5 brohs!</strong> Berhasil disimpan.
							</div>
						  <br>'
                        );

                    } else if($simpan=="n"){
                        $this->session->set_flashdata('msg',
                            '
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Gagal!</strong> '.$pesan.'.
											</div>
										 <br>'
                        );

                    }
                } else {
                    //echo "inputan pass old oleh user TIDAK SAMA DENGAN old pass di DB";die;
                    $this->session->set_flashdata('msg',
                        '
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Gagal!</strong> '.$pesan.'.
											</div>
										 <br>'
                    );

                }
                redirect("users/profile/e/".$id);
            }
//            echo $id_user; die;
            $get_tbl_agen_for_atasan = $this->db->get_where("tbl_agen",array("id_agen"=>$id_user))->row();
            $id_atasan = $get_tbl_agen_for_atasan->sponsor_atasan;

            //echo $id_atasan; die;

            $get_dt_atasan = $this->db->get_where("tbl_agen",array("id_agen"=>$id_atasan))->row();
            $data["nama_atasan_lengkap"] = $get_dt_atasan->nama_agen;

            $get_data_role_agen = $this->db->get_where("tbl_role_agen",array("id_role_agen"=>$get_dt_atasan->role_agen_id))->row();
            $data["nama_role_atasan"] = $get_data_role_agen->nama_role_agen_lengkap;

            $get_jumlah_agen_atasan = $this->db->get_where("tbl_agen",array("sponsor_atasan"=>$id_atasan));
            $data["jumlah_agen_atasan"]=$get_jumlah_agen_atasan->num_rows();

            $data['user']  			  = $this->Mcrud->get_users_by_un_tbl_agen($ceks);
            $data['level_users']  = $this->Mcrud->get_level_users();
            $get_password = $this->db->get_where("tbl_user",array('id_user'=>$_SESSION['id_user']));
            //ini adalah kunci kesuksesan mendapat data dari database
            //echo $get_password->result()[0]->password; die;

            //$data['password_lama'] = $get_password->result()[0]->password;
            $data['judul_web'] 		= "Profile Atasan";

            $this->load->view('users/header', $data);
            $this->load->view('users/profile_atasan', $data);
            $this->load->view('users/footer');
        }
    }

    public function update_pass()
    {
        //echo "update pass route tes"; die;
        //echo $_SESSION['id_user'];die;
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');
        if(!isset($ceks)) {
            redirect('web/login');
        }else{
            $new_password_1 	 = htmlentities(strip_tags($this->input->post('new_password_1')));
            $new_password_2 	 = htmlentities(strip_tags($this->input->post('new_password_2')));
            //ini juga kunci kesuksesan get data dari database
            //$data_lama = $this->db->get_where("tbl_user", array('id_user'=>$_SESSION['id_user']))->row();
            $data_lama = $this->db->get_where("tbl_user", array('id_user'=>$_SESSION['id_user']));
            //echo $data_lama->password; die;
            //echo $new_password_1."<br>".$new_password_2; die;
            //echo $new_password_1."<br>".$new_password_2; die;

            //echo $data_lama->num_rows();die;
            //echo $data_lama->result()[0]->password;die;

            $id_user = $_SESSION['id_user'];
            $nama_lengkap = $data_lama->result()[0]->nama_lengkap;
            $username = $data_lama->result()[0]->username;
            $password = $data_lama->result()[0]->password;
            $level = $data_lama->result()[0]->level;
            $id_zona = $data_lama->result()[0]->id_zona;

            $pesan = "Data Belum Berhasil Disimpan!";
            if($new_password_1=='' && $new_password_2==''){
                //echo "pass 1 dan 2 tidak di isi"; die;
                $simpan = "y";
                $password = $data_lama->result()[0]->password;
            } else if($new_password_1 !='' || $new_password_2 !='') {
                //echo "salah 1 pass 1 dan 2 telah di isi"; die;
                if($new_password_1==$new_password_2){
                    //echo "password 1 dan 2 sama";die;
                    $simpan = "y";
                    $password = $new_password_1;
                } else if ($new_password_1!=$new_password_2){
                    //echo "password 1 dan 2 tidak sama";die;
                    $simpan = "n";
                    $password = $data_lama->result()[0]->password;
                }
            }

            if($simpan=="y"){
                $data = array(
                    'id_user'=>$id_user,
                    'nama_lengkap'=>$nama_lengkap,
                    'username'=>$username,
                    'password'=>$password,
                    'level'=>$level,
                    'id_zona'=>$id_zona,
                );
                $this->db->update("tbl_user",$data,array(
                    'id_user'=>$id_user,
                ));

                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses5 broh!</strong> Berhasil disimpan.
							</div>
						  <br>'
                );

            } else if($simpan=="n"){
                $this->session->set_flashdata('msg',
                    '
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Gagal!</strong> '.$pesan.'.
											</div>
										 <br>'
                );
            }

            $data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
            $data['level_users']  = $this->Mcrud->get_level_users();
            $get_password = $this->db->get_where("tbl_user",array(
                'id_user'=>$_SESSION['id_user'],
            ));
            //ini adalah kunci kesuksesan mendapat data dari database
            //echo $get_password->result()[0]->password; die;

            $data['password_lama'] = $get_password->result()[0]->password;
            $data['judul_web'] 	    = "Profile";

            $this->load->view('users/header', $data);
            $this->load->view('users/profile', $data);
            $this->load->view('users/footer');
        }
    }

}
