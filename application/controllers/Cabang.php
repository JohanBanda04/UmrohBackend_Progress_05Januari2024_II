<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cabang extends CI_Controller {

	public function index()
	{
		redirect('cabang/v');
	}

	public function v($aksi='', $id='')
	{
	    //echo "data cabang"; die;
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
        $nama_level	 = $this->session->userdata('nama_level');




		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

//			if ($level != 'superadmin') {
//					redirect('404_content');
//			}

			if ($nama_level != 'administrator') {
					redirect('404_content');
			}

			$this->db->where_not_in('nama_panjang', 'Superadmin');
			/*ngambil semua data user pada tabel user*/
//			$data['query'] = $this->db->get("tbl_user");
			$data['query'] = $this->db->get("tbl_cabang");

				if ($aksi == 't') {
					$p = "tambah";
					$data['judul_web'] 	  = "Tambah Data Cabang";
				} elseif ($aksi == 'e') {
					$p = "edit";
					$data['judul_web'] 	  = "Edit Data Cabang";
					$this->db->where_not_in('nama_panjang', 'Superadmin');
					$data['query'] = $this->db->get_where("tbl_cabang", array('id_cabang' => "$id"))->row();
					if ($data['query']->id_cabang=='') {redirect('404');}
				} elseif ($aksi == 'h') {
                    //echo $id; die;
					$this->db->where_not_in('nama_panjang', 'Superadmin');
//					$cek_data = $this->db->get_where("tbl_user", array('id_user' => "$id"));
					$cek_data = $this->db->get_where("tbl_cabang", array('id_cabang' => "$id"));

					if ($cek_data->num_rows () != 0) {
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
					}else {
						redirect('404');
					}
				}else{
					$p = "index";
					$data['judul_web'] 	  = "Cabang ";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/cabang/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('Y-m-d H:i:s');

					if (isset($_POST['btnsimpan'])) {

						$nama_cabang 	 = htmlentities(strip_tags($this->input->post('nama_cabang')));
                        $prov_id 	 = htmlentities(strip_tags($this->input->post('prov_id')));
                        $pimpinan_cab 	 = htmlentities(strip_tags($this->input->post('pimpinan_cab')));
                        $telpon 	 = htmlentities(strip_tags($this->input->post('telpon')));
						$email 	 = htmlentities(strip_tags($this->input->post('email')));
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

						$cek_data = $this->db->get_where('tbl_cabang', array('nama_cabang'=>$nama_cabang));
						$pesan  = '';
						$simpan = 'y';

						if ($cek_data->num_rows()!=0) {
							$simpan = 'n';
							$pesan  = "Nama Cabang '<b>$nama_cabang</b>' sudah ada";
						}
//						else {
//							if ($password!=$password2) {
//								$simpan = 'n';
//								$pesan  = "Password tidak cocok!";
//							}
//						}

						if ($simpan=='y') {
							$data = array(
							    'nama_cabang'=>$nama_cabang,
							    'nama_panjang'=>$nama_cabang,
							    'provinsi_id'=>$prov_id,
							    'user_id'=>$pimpinan_cab,
							    'no_telp'=>$telpon,
							    'email'=>$email,
							    'tgl_input'=>date('Y-m-d H:i:s'),


							);
							$this->db->insert('tbl_cabang',$data);
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
							
						}else {
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
							 redirect("cabang/v");
						}
						 redirect("cabang/v");
					}


					if (isset($_POST['btnupdate'])) {
					    //echo "btnupdate";die;
                        //cuki
						$nama_cabang_edit 	 = htmlentities(strip_tags($this->input->post('nama_cabang_edit')));
                        $prov_id_edit 	 = htmlentities(strip_tags($this->input->post('prov_id_edit')));
						$pimpinan_cab_edit 	 = htmlentities(strip_tags($this->input->post('pimpinan_cab_edit')));
						$telpon_edit 	 = htmlentities(strip_tags($this->input->post('telpon_edit')));
						$email_edit 	 = htmlentities(strip_tags($this->input->post('email_edit')));
//						$level  = htmlentities(strip_tags($this->input->post('level')));
//						$username = htmlentities(strip_tags($this->input->post('username')));
//						$email = htmlentities(strip_tags($this->input->post('email')));
//						$password  = htmlentities(strip_tags($this->input->post('password')));
//						$password2 = htmlentities(strip_tags($this->input->post('password2')));
						//echo $id;die;
						$data_lama = $this->db->get_where('tbl_cabang', array('id_cabang'=>$id))->row();

//						echo "<pre>"; print_r($data_lama); die;
						$old_password = $data_lama->password;
						//echo $old_password; die;
						/*multiple where condition*/
						$cek_data  = $this->db->get_where('tbl_cabang', array(
						    'nama_cabang'=>$nama_cabang_edit,
                            'nama_cabang!='=>$data_lama->nama_cabang)
                        );

//						echo '<pre>'; var_dump($cek_data) ; die;
						
						$pesan  = '';

						$simpan = 'y';

						if ($cek_data->num_rows()!=0) {
							$simpan = 'n';
							$pesan  = "Nama Cabang '<b>$nama_cabang_edit </b>' sudah ada";
						}else {
						    //cukt
                            $simpan = 'y';
                            $pesan  = "Nama Cabang berhasil diubah! ";
//							$pass_lama = $data_lama->password;
//
//                            //die;
//							if (($password=='') ) {
//								$password = $pass_lama;
//							}else if($password != "") {
//							    //echo $password;die;
//                                if($password==$password2){
//                                    echo "pass cocok<br>";
//                                    $simpan = "y";
//                                    if($password==$pass_lama){
//                                        $pass_to_save = $pass_lama;
//                                    } else if($password!=$pass_lama){
//                                        $pass_to_save = crypt($password,'salt-coba');
//                                    }
//                                } else if($password!=$password2){
//                                    echo "pass tdk cocok<br>";
//                                    $simpan = "n";
//                                    $pass_to_save = "no pass to save";
//                                }
//
//							}
						}
						//cukperancang
						//echo $id;die;
						if ($simpan=='y') {
						$data = array(

						    'nama_cabang'=> $nama_cabang_edit,
						    'nama_panjang'=> $nama_cabang_edit,
						    'no_telp'=> $telpon_edit,
						    'email'=> $email_edit,
						    'provinsi_id'=> $prov_id_edit,
						    'user_id'=> $pimpinan_cab_edit,
						    'tgl_update'=> date('Y-m-d H:i:s'),
//							'nama_lengkap' => $nama,
//							'username' 		 => $username,
//							'email' 		 => $email,
//							'password' 		 => $pass_to_save,
//							'level'			=> $level
						);
						$this->db->update('tbl_cabang',$data, array('id_cabang'=>$id));

						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil diubah.
							</div>
						  <br>'
						);
						
						 }else {
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
										 redirect("cabang/v/e/".hashids_encrypt($id));
					 	 }
						 redirect("cabang/v");
					}
		}
	}

}
