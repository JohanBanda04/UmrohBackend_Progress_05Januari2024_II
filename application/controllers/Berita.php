<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

	public function index()
	{
		redirect("berita/v");
	}

	public function v($aksi='',$id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');

		if(!isset($ceks)) {
			redirect('web/login');
		}

			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($level=='pelaksana') {
				$this->db->where('id_user',$id_user);
			}
			if ($aksi=='proses' or $aksi=='konfirmasi' or $aksi=='selesai') {
				$this->db->where('status',$aksi);
			}
			$this->db->order_by('id_berita', 'DESC');
			$data['query'] = $this->db->get("tbl_berita");
			

			$cek_notif = $this->db->get_where("tbl_notif", array('penerima'=>"$id_user"));
			foreach ($cek_notif->result() as $key => $value) {
				$b_notif = $value->baca_notif;
				if(!preg_match("/$id_user/i", $b_notif)) {
					$data_notif = array('baca_notif'=>"$id_user, $b_notif");
					$this->db->update('tbl_notif', $data_notif, array('penerima'=>$id_user));
				}
			}

			if ($aksi == 't') {
				if ($level!='pelaksana') {
					redirect('404');
				}
				$p = "tambah";
				$data['judul_web'] 	  = "TAMBAH BAHAN BERITA";
			}elseif ($aksi == 'd') {
				$p = "detail";
				$data['judul_web'] 	  = "RINCIAN BAHAN BERITA";
				$data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => "$id"))->row();
				if ($data['query']->id_berita=='') {redirect('404');}

				$data['cek_notif'] = $this->db->get_where("tbl_notif", array('penerima'=>"$id_user", 'id_berita'=>"$id"))->row();

				$b_notif = $data['cek_notif']->baca_notif;
				if(!preg_match("/$id_user/i", $b_notif)) {
					$data_notif = array('baca_notif'=>"$id_user, $b_notif");
					$this->db->update('tbl_notif', $data_notif, array('penerima'=>$id_user, 'id_berita'=>"$id"));
				}
			}
			elseif ($aksi == 'e') {
				$p = "edit";
				$data['judul_web'] 	  = "EDIT BAHAN BERITA";
				$data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => "$id"))->row();
				if ($data['query']->id_berita=='') {redirect('404');}
			}
			elseif ($aksi == 'h') {
				$cek_data = $this->db->get_where("tbl_berita", array('id_berita' => "$id"));
				if ($cek_data->num_rows() != 0) {
					if ($cek_data->row()->status!='menunggu') {
							redirect('404');
						}
						if ($cek_data->row()->lampiran != '') {
							unlink($cek_data->row()->lampiran);
						}
						// $this->db->delete('tbl_notif', array('pengirim'=>$id_user,'id_berita'=>$id));
						$this->db->delete('tbl_berita', array('id_berita' => $id));
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses11!</strong> Berhasil dihapus.
							</div>
							<br>'
						);
						redirect("berita/v");
				}else {
					redirect('404_content');
				}
			}else{
				$p = "index";
				$data['judul_web'] 	  = "Bahan Berita";
			}

				$this->load->view('users/header', $data);
				$this->load->view("users/berita/$p", $data);
				$this->load->view('users/footer');

				date_default_timezone_set('Asia/Singapore');
				$tgl = date('Y-m-d H:i:s');

				$lokasi = 'file/bahan_berita';
				$this->upload->initialize(array(
					"upload_path"   => "./$lokasi",
					"allowed_types" => "*"
				));

				if (isset($_POST['btnsimpan'])) {
					
					
					$nama_kegiatan 	 = htmlentities(strip_tags($this->input->post('nama_kegiatan')));
					$tempat_kegiatan 	 = htmlentities(strip_tags($this->input->post('tempat_kegiatan')));
					$tgl_kegiatan 	 = htmlentities(strip_tags($this->input->post('tgl_kegiatan')));
					$poin_kegiatan 	 = htmlentities(strip_tags($this->input->post('poin_kegiatan')));
					$peserta 	 = htmlentities(strip_tags($this->input->post('peserta')));

					$simpan = '';

					if ( ! $this->upload->do_upload('lamp_surat_undangan'))
					{
						$lamp_surat_undangan = '';
					}
					else
					{
						$gbr = $this->upload->data();
						$filename = "$lokasi/".$gbr['file_name'];
						$lamp_surat_undangan = preg_replace('/ /', '_', $filename);
					}

					if ( ! $this->upload->do_upload('lamp_sambutan'))
					{
						$lamp_sambutan = '';
					}
					 else
					{
						$gbr = $this->upload->data();
						$filename = "$lokasi/".$gbr['file_name'];
						$lamp_sambutan = preg_replace('/ /', '_', $filename);
					}

					if ( ! $this->upload->do_upload('lamp_paparan'))
					{
						$lamp_paparan = "";
					}
					else
					{
						$gbr = $this->upload->data();
						$filename = "$lokasi/".$gbr['file_name'];
						$lamp_paparan = preg_replace('/ /', '_', $filename);
					}

					if ( ! $this->upload->do_upload('lamp_lain'))
					{
						$lamp_lain = '';
					}
					else
					{
						$gbr = $this->upload->data();
						$filename = "$lokasi/".$gbr['file_name'];
						$lamp_lain = preg_replace('/ /', '_', $filename);
					}

					if ( ! $this->upload->do_upload('lamp_foto1'))
					{
							$simpan = 'n';
							$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
					}
					else
					{
								$gbr = $this->upload->data();
								$filename = "$lokasi/".$gbr['file_name'];
								$lamp_foto1 = preg_replace('/ /', '_', $filename);
								$simpan = 'y';
					}

					if ( ! $this->upload->do_upload('lamp_foto2'))
					{
							$simpan = 'n';
							$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
					}
					 else
					{
								$gbr = $this->upload->data();
								$filename = "$lokasi/".$gbr['file_name'];
								$lamp_foto2 = preg_replace('/ /', '_', $filename);
								$simpan = 'y';
					}

					if ( ! $this->upload->do_upload('lamp_foto3'))
					{
						$lamp_foto3 = '';
					}
					 else
					{
						$gbr = $this->upload->data();
						$filename = "$lokasi/".$gbr['file_name'];
						$lamp_foto3 = preg_replace('/ /', '_', $filename);
					}

					if ( ! $this->upload->do_upload('lamp_foto4'))
					{
						$lamp_foto4 = '';
					}
					 else
					{
						$gbr = $this->upload->data();
						$filename = "$lokasi/".$gbr['file_name'];
						$lamp_foto4 = preg_replace('/ /', '_', $filename);
					}

					if ( ! $this->upload->do_upload('lamp_foto5'))
					{
						$lamp_foto5 = '';
					}
					 else
					{
						$gbr = $this->upload->data();
						$filename = "$lokasi/".$gbr['file_name'];
						$lamp_foto5 = preg_replace('/ /', '_', $filename);
					}

					if ( ! $this->upload->do_upload('lamp_foto6'))
					{
						$lamp_foto6 = '';
					}
					else
					{
						$gbr = $this->upload->data();
						$filename = "$lokasi/".$gbr['file_name'];
						$lamp_foto6 = preg_replace('/ /', '_', $filename);
					}

					if ($simpan=='y') {
						$data = array(
							'lamp_surat_undangan'	=> $lamp_surat_undangan,
							'lamp_sambutan'			=> $lamp_sambutan,
							'lamp_paparan'			=> $lamp_paparan,
							'lamp_lain'				=> $lamp_lain,
							'lamp_foto1'			=> $lamp_foto1,
							'lamp_foto2'			=> $lamp_foto2,
							'lamp_foto3'			=> $lamp_foto3,
							'lamp_foto4'			=> $lamp_foto4,
							'lamp_foto5'			=> $lamp_foto5,
							'lamp_foto6'			=> $lamp_foto6,
							'id_user'				=> $id_user,
							'nama_kegiatan'   		=> $nama_kegiatan,
							'tempat_kegiatan'		=> $tempat_kegiatan,
							'tgl_kegiatan'  		=> $tgl_kegiatan,
							'poin_kegiatan'   		=> $poin_kegiatan,
							'peserta'				=> $peserta,
							'status'				=> 'menunggu',
							'tgl_input'   			=> $tgl
						);
						$this->db->insert('tbl_berita',$data);

						$id_berita = $this->db->insert_id();
						$this->Mcrud->kirim_notif($id_user,'humas',$id_berita,'berita','pelaksana_kirim_berita');

						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses6!</strong> Berhasil disimpan.
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
							redirect("berita/v/$aksi/".hashids_decrypt($id));
					 }
					 redirect("berita/v");
				}

				if (isset($_POST['btnupdate'])) {
					$nama_kegiatan 	 = htmlentities(strip_tags($this->input->post('nama_kegiatan')));
					$tempat_kegiatan 	 = htmlentities(strip_tags($this->input->post('tempat_kegiatan')));
					$tgl_kegiatan 	 = htmlentities(strip_tags($this->input->post('tgl_kegiatan')));
					$poin_kegiatan 	 = htmlentities(strip_tags($this->input->post('poin_kegiatan')));
					$peserta 	 = htmlentities(strip_tags($this->input->post('peserta')));

					$cek_file = $this->db->get_where('tbl_berita',"id_berita='$id'");

					$cek_lamp_surat_undangan = $cek_file->row()->lamp_surat_undangan;
					$cek_lamp_sambutan = $cek_file->row()->lamp_sambutan;
					$cek_lamp_paparan = $cek_file->row()->lamp_paparan;
					$cek_lamp_lain = $cek_file->row()->lamp_lain;
					$cek_lamp_foto1 = $cek_file->row()->lamp_foto1;
					$cek_lamp_foto2 = $cek_file->row()->lamp_foto2;
					$cek_lamp_foto3 = $cek_file->row()->lamp_foto3;
					$cek_lamp_foto4 = $cek_file->row()->lamp_foto4;
					$cek_lamp_foto5 = $cek_file->row()->lamp_foto5;
					$cek_lamp_foto6 = $cek_file->row()->lamp_foto6;

					if ($_FILES['lamp_surat_undangan']['error'] <> 4) {
						if ( ! $this->upload->do_upload('lamp_surat_undangan'))
						{
							$simpan = 'n';
							$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
						}
						else
						{
							if ($cek_lamp_surat_undangan!='') {
								unlink($cek_lamp_surat_undangan);
							}
							$gbr = $this->upload->data();
							$filename = "$lokasi/".$gbr['file_name'];
							$lamp_surat_undangan = preg_replace('/ /', '_', $filename);
							$simpan = 'y';
						}	
					} else {
						$lamp_surat_undangan = $cek_lamp_surat_undangan;
						$simpan = 'y';
					}

					if ($_FILES['lamp_sambutan']['error'] <> 4) {
						if ( ! $this->upload->do_upload('lamp_sambutan'))
						{
							$simpan = 'n';
							$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
						}
						else
						{
							if ($cek_lamp_sambutan!='') {
								unlink($cek_lamp_sambutan);
							}
							$gbr = $this->upload->data();
							$filename = "$lokasi/".$gbr['file_name'];
							$lamp_sambutan = preg_replace('/ /', '_', $filename);
							$simpan = 'y';
						}	
					} else {
						$lamp_sambutan = $cek_lamp_sambutan;
						$simpan = 'y';
					}

					if ($_FILES['lamp_paparan']['error'] <> 4) {
						if ( ! $this->upload->do_upload('lamp_paparan'))
						{
							$simpan = 'n';
							$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
						}
						else
						{
							if ($cek_lamp_paparan!='') {
								unlink($cek_lamp_paparan);
							}
							$gbr = $this->upload->data();
							$filename = "$lokasi/".$gbr['file_name'];
							$lamp_paparan = preg_replace('/ /', '_', $filename);
							$simpan = 'y';
						}	
					} else {
						$lamp_paparan = $cek_lamp_paparan;
						$simpan = 'y';
					}

					if ($_FILES['lamp_lain']['error'] <> 4) {
						if ( ! $this->upload->do_upload('lamp_lain'))
						{
							$simpan = 'n';
							$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
						}
						else
						{
							if ($cek_lamp_lain!='') {
								unlink($cek_lamp_lain);
							}
							$gbr = $this->upload->data();
							$filename = "$lokasi/".$gbr['file_name'];
							$lamp_lain = preg_replace('/ /', '_', $filename);
							$simpan = 'y';
						}	
					} else {
						$lamp_lain = $cek_lamp_lain;
						$simpan = 'y';
					}

					if ($_FILES['lamp_foto1']['error'] <> 4) {
						if ( ! $this->upload->do_upload('lamp_foto1'))
						{
							$simpan = 'n';
							$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
						}
						else
						{
							if ($cek_lamp_foto1!='') {
								unlink($cek_lamp_foto1);
							}
							$gbr = $this->upload->data();
							$filename = "$lokasi/".$gbr['file_name'];
							$lamp_foto1 = preg_replace('/ /', '_', $filename);
							$simpan = 'y';
						}	
					} else {
						$lamp_foto1 = $cek_lamp_foto1;
						$simpan = 'y';
					}

					if ($_FILES['lamp_foto2']['error'] <> 4) {
						if ( ! $this->upload->do_upload('lamp_foto2'))
						{
							$simpan = 'n';
							$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
						}
						else
						{
							if ($cek_lamp_foto2!='') {
								unlink($cek_lamp_foto2);
							}
							$gbr = $this->upload->data();
							$filename = "$lokasi/".$gbr['file_name'];
							$lamp_foto2 = preg_replace('/ /', '_', $filename);
							$simpan = 'y';
						}	
					} else {
						$lamp_foto2 = $cek_lamp_foto2;
						$simpan = 'y';
					}

					if ($_FILES['lamp_foto3']['error'] <> 4) {
						if ( ! $this->upload->do_upload('lamp_foto3'))
						{
							$simpan = 'n';
							$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
						}
						else
						{
							if ($cek_lamp_foto3!='') {
								unlink($cek_lamp_foto3);
							}
							$gbr = $this->upload->data();
							$filename = "$lokasi/".$gbr['file_name'];
							$lamp_foto3 = preg_replace('/ /', '_', $filename);
							$simpan = 'y';
						}	
					} else {
						$lamp_foto3 = $cek_lamp_foto3;
						$simpan = 'y';
					}

					if ($_FILES['lamp_foto4']['error'] <> 4) {
						if ( ! $this->upload->do_upload('lamp_foto4'))
						{
							$simpan = 'n';
							$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
						}
						else
						{
							if ($cek_lamp_foto4!='') {
								unlink($cek_lamp_foto4);
							}
							$gbr = $this->upload->data();
							$filename = "$lokasi/".$gbr['file_name'];
							$lamp_foto4 = preg_replace('/ /', '_', $filename);
							$simpan = 'y';
						}	
					} else {
						$lamp_foto4 = $cek_lamp_foto4;
						$simpan = 'y';
					}

					if ($_FILES['lamp_foto5']['error'] <> 4) {
						if ( ! $this->upload->do_upload('lamp_foto5'))
						{
							$simpan = 'n';
							$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
						}
						else
						{
							if ($cek_lamp_foto5!='') {
								unlink($cek_lamp_foto5);
							}
							$gbr = $this->upload->data();
							$filename = "$lokasi/".$gbr['file_name'];
							$lamp_foto5 = preg_replace('/ /', '_', $filename);
							$simpan = 'y';
						}	
					} else {
						$lamp_foto5 = $cek_lamp_foto5;
						$simpan = 'y';
					}

					if ($_FILES['lamp_foto6']['error'] <> 4) {
						if ( ! $this->upload->do_upload('lamp_foto6'))
						{
							$simpan = 'n';
							$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
						}
						else
						{
							if ($cek_lamp_foto6!='') {
								unlink($cek_lamp_foto6);
							}
							$gbr = $this->upload->data();
							$filename = "$lokasi/".$gbr['file_name'];
							$lamp_foto6 = preg_replace('/ /', '_', $filename);
							$simpan = 'y';
						}	
					} else {
						$lamp_foto6 = $cek_lamp_foto6;
						$simpan = 'y';
					}

					if ($simpan=='y') {
						$data = array(
							'lamp_surat_undangan'	=> $lamp_surat_undangan,
							'lamp_sambutan'			=> $lamp_sambutan,
							'lamp_paparan'			=> $lamp_paparan,
							'lamp_lain'				=> $lamp_lain,
							'lamp_foto1'			=> $lamp_foto1,
							'lamp_foto2'			=> $lamp_foto2,
							'lamp_foto3'			=> $lamp_foto3,
							'lamp_foto4'			=> $lamp_foto4,
							'lamp_foto5'			=> $lamp_foto5,
							'lamp_foto6'			=> $lamp_foto6,
							'id_user'				=> $id_user,
							'nama_kegiatan'   		=> $nama_kegiatan,
							'tempat_kegiatan'		=> $tempat_kegiatan,
							'tgl_kegiatan'  		=> $tgl_kegiatan,
							'poin_kegiatan'   		=> $poin_kegiatan,
							'peserta'				=> $peserta,
							'status'				=> $cek_file->row()->status,
							'tgl_input'   			=> $tgl
						);
						$this->db->update('tbl_berita',$data, array('id_berita' => $id));

						$this->Mcrud->kirim_notif($id_user,'humas',$id,'berita','pelaksana_perbaikan_berita');

						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses8!</strong> Berhasil disimpan.
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
							redirect("berita/v/$aksi/".hashids_decrypt($id));
					 }
					 redirect("berita/v");
				}


				if (isset($_POST['btnkirim'])) {
					$id_berita = htmlentities(strip_tags($this->input->post('id_berita')));
					$data_lama = $this->db->get_where('tbl_berita',array('id_berita'=>$id_berita))->row();
					$simpan = 'y';
					$pesan = '';
					
						$pesan_humas = htmlentities(strip_tags($this->input->post('pesan_humas')));
						$status = htmlentities(strip_tags($this->input->post('status')));
						$pesan = 'Berhasil disimpan';

						$data = array(
							'pesan_humas' => $pesan_humas,
							'status'				=> $status
						);
						if ($status == 'perbaikan') {
							$pesan_notif = 'humas_perbaikan_berita';
						} if ($status == 'proses') {
							$pesan_notif = 'humas_proses_berita';
						} if ($status == 'konfirmasi') {
							$pesan_notif = 'humas_konfirmasi_berita';
						} if ($status == 'selesai') {
							$pesan_notif = 'humas_selesai_berita';
						}

						$this->Mcrud->kirim_notif('humas',$data_lama->pelaksana,$id_berita,'berita',$pesan_notif);
					

					if ($simpan=='y') {
						$this->db->update('tbl_berita',$data, array('id_berita'=>$id_berita));
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> '.$pesan.'.
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
					}
					redirect('berita/v');
				}

	}


	public function ajax()
	{
		if (isset($_POST['btnkirim'])) {
			$id = $this->input->post('id');
			$data = $this->db->get_where('tbl_berita',array('id_berita'=>$id))->row();
			$pesan_humas = $data->pesan_humas;
			$status = $data->status;
			echo json_encode(array('pesan_petugas'=>$pesan_humas,'status'=>$status));
		} else {
			redirect('404');
		}
	}

}
