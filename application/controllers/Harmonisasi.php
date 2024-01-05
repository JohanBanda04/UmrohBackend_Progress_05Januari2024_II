<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harmonisasi extends CI_Controller {

	public function index()
	{
		redirect("berita/v");
	}

    public function v2($aksi='' , $id='', $status='' )
    {
        $id = hashids_decrypt($id);
        $ceks 	 = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level 	 = $this->session->userdata('level');

//		echo $this->uri->segment(1);
//		echo $this->uri->segment(2);
//		echo $this->uri->segment(3); die;

        if($aksi!='t'){
            $this->session->set_flashdata('msg','');

        }

        if(!isset($ceks)) {
            redirect('web/login');
        }

        $data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

        if ($level=='pelaksana') {
            $this->db->where('id_user',$id_user);
        }
        //dicomment
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
//			    echo "tes"; die;
//				if ($level!='pelaksana') {
//					redirect('404');
//				}
            $p = "tambah";
            $data['judul_web'] 	  = "TAMBAH DOKUMEN HARMONISASI";
        } else if ($aksi=='pemprov_ntb'){

            /*'belum_diproses','perbaikan','draft_sedang_dibuat','menunggu_koreksi','selesai'*/
            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemprov_ntb");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemprov_ntb");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemprov_ntb";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMPROV NTB";

        } else if($aksi=='pemkot_mataram'){
            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkot_mataram");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkot_mataram");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkot_mataram";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKOT MATARAM";


//            $this->db->order_by('id_berita', 'DESC');
//            $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkot_mataram"));
//            $p = "pemkot_mataram";
//            $data['judul_web'] 	= "DOKUMEN HARMONISASI PEMKOT MATARAM";
        } else if($aksi=='pemkot_bima'){

            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkot_bima");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkot_bima");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkot_bima";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKOT BIMA";

        } else if($aksi=='pemkab_sumbawa_barat'){
            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkab_sumbawa_barat");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkab_sumbawa_barat");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkab_sumbawa_barat";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB SUMBAWA BARAT";

        } else if($aksi=="pemkab_sumbawa"){
            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkab_sumbawa");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkab_sumbawa");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkab_sumbawa";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB SUMBAWA";


        } else if($aksi=="pemkab_lombok_utara"){
            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkab_lombok_utara");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkab_lombok_utara");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkab_lombok_utara";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK UTARA";


        } else if($aksi=="pemkab_lombok_timur"){
            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkab_lombok_timur");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkab_lombok_timur");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkab_lombok_timur";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK TIMUR";


        } else if($aksi=="pemkab_lombok_tengah"){
            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkab_lombok_tengah");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkab_lombok_tengah");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkab_lombok_tengah";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK TENGAH";


        } else if($aksi=="pemkab_lombok_barat"){
            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkab_lombok_barat");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkab_lombok_barat");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkab_lombok_barat";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK BARAT";



        } else if($aksi=="pemkab_dompu"){

            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkab_dompu");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkab_dompu");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkab_dompu";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB DOMPU";

        } else if($aksi=="pemkab_bima"){

            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkab_bima");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkab_bima");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkab_bima";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB BIMA";

        } elseif ($aksi == 'd') {
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
        else if ($aksi == 'e') {
            if($pemda=='pemprov_ntb'){
//                    echo "edit dokumen pemprov ntb";
//                    echo "<br>id:".$id; die;
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMPROV NTB";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkot_mataram'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKOT MATARAM";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkot_bima'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKOT BIMA";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkab_sumbawa_barat'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB SUMBAWA BARAT";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkab_sumbawa'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB SUMBAWA";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkab_lombok_utara'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK UTARA";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkab_lombok_timur'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK TIMUR";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            }else if($pemda=='pemkab_lombok_tengah'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK TENGAH";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            }else if($pemda=='pemkab_lombok_barat'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK BARAT";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            }else if($pemda=='pemkab_dompu'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB DOMPU";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            }else if($pemda=='pemkab_bima'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB BIMA";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            }



        } else if ($aksi == 'h') {

//			    echo "hapus data bro"; die;
            $cek_data = $this->db->get_where("tbl_berita", array('id_berita' => $id));
            $lamp_surat_lama = $cek_data->row()->lamp_surat_undangan;
//				echo $lamp_surat_lama; die;
//				echo $cek_data->result_array()[0]['lamp_surat_undangan'];die;
//				echo $cek_data->row()->lamp_surat_undangan;die;
//				echo $cek_data->num_rows();die;
//                $this->db->delete('tbl_berita', array('id_berita' => $id));die;
            if ($cek_data->num_rows() != 0) {
//					if ($cek_data->row()->status!='menunggu') {
//							redirect('404');
//						}
//						if ($cek_data->row()->lampiran != '') {
//							unlink($cek_data->row()->lampiran);
//						}
                // $this->db->delete('tbl_notif', array('pengirim'=>$id_user,'id_berita'=>$id));
                $this->db->delete('tbl_berita', array('id_berita' => $id));
                try {
                    unlink($lamp_surat_lama);
                } catch (Exception $e) {
                    echo json_encode($e);
                }

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


                if($pemda=='pemprov_ntb'){

                    redirect("harmonisasi/v/pemprov_ntb");
                } else if($pemda=='pemkot_mataram'){
                    redirect("harmonisasi/v/pemkot_mataram");
                } else if ($pemda=='pemkot_bima'){
                    redirect("harmonisasi/v/pemkot_bima");
                } else if($pemda=='pemkab_sumbawa_barat'){
                    redirect("harmonisasi/v/pemkab_sumbawa_barat");
                } else if($pemda=='pemkab_sumbawa'){
                    redirect("harmonisasi/v/pemkab_sumbawa");
                } else if($pemda=="pemkab_lombok_utara"){
                    redirect("harmonisasi/v/pemkab_lombok_utara");
                } else if($pemda=="pemkab_lombok_timur"){
                    redirect("harmonisasi/v/pemkab_lombok_timur");
                } else if ($pemda=="pemkab_lombok_tengah"){
                    redirect("harmonisasi/v/pemkab_lombok_tengah");
                } else if($pemda=="pemkab_lombok_barat") {
                    redirect("harmonisasi/v/pemkab_lombok_barat");
                } else if ($pemda=="pemkab_dompu"){
                    redirect("harmonisasi/v/pemkab_dompu");
                } else if($pemda=="pemkab_bima"){
                    redirect("harmonisasi/v/pemkab_bima");
                }

//						redirect("berita/v");
                redirect("harmonisasi/v/pemprov_ntb");
            }else {
                redirect('404_content');
            }
        } else if($aksi == 'df'){
            echo "delete lampiran";die;
        }else{
            $p = "index";
            $data['judul_web'] 	  = "Bahan Berita";
        }

        $this->load->view('users/header', $data);
        $this->load->view("users/harmonisasi/$p", $data);
        $this->load->view('users/footer');

        date_default_timezone_set('Asia/Singapore');
        $tgl = date('Y-m-d H:i:s');

//        $lokasi = 'file/bahan_berita';
        $lokasi = 'file/bahan_draft_raperda';

        $this->upload->initialize(array(
            "upload_path"   => "./$lokasi",
            "allowed_types" => "*"
        ));

        if (isset($_POST['btnsimpan'])) {


            $nama_kegiatan 	 = htmlentities(strip_tags($this->input->post('nama_kegiatan')));
            $jenis_dokumen 	 = htmlentities(strip_tags($this->input->post('jenis_dokumen')));
            $zona_dokumen 	 = htmlentities(strip_tags($this->input->post('zona_dokumen')));

            $simpan = '';



            if ( ! $this->upload->do_upload('lamp_surat_undangan'))
            {
                $simpan = 'n';
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
            } else {
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $lamp_surat_undangan = preg_replace('/ /', '_', $filename);
                $simpan = 'y';
            }
//            echo $lamp_surat_undangan; die;
            if ($simpan=='y') {
//					    echo "tes"; die;
                $data = array(
                    'lamp_surat_undangan'	=> $lamp_surat_undangan,

                    'id_user'				=> $id_user,
                    'nama_kegiatan'   		=> $nama_kegiatan,
                    'jenis_dokumen'   		=> $jenis_dokumen,
                    'zona_dokumen'   		=> $zona_dokumen,

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

//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
            }
//					 redirect("berita/v");

//					 redirect("harmonisasi/v/pemprov_ntb");
            redirect("harmonisasi/v/".$zona_dokumen);

        }

        if (isset($_POST['btnsimpan_edit'])) {
//            echo $pemda;die;

//            echo "btnsimpan_edit"; die;
            $nama_kegiatan 	 = htmlentities(strip_tags($this->input->post('nama_kegiatan')));
            $jenis_dokumen 	 = htmlentities(strip_tags($this->input->post('jenis_dokumen')));
            $zona_dokumen 	 = htmlentities(strip_tags($this->input->post('zona_dokumen')));

            $data_lama = $this->db->get_where('tbl_berita',array('id_berita'=>$id))->row();
            $lamp_surat_undangan_lama = $data_lama->lamp_surat_undangan;

//            echo $lamp_surat_undangan_lama; die;
            if ( ! $this->upload->do_upload('lamp_surat_undangan'))
            {
                $simpan = 'n';
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
            }
            else
            {
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $lamp_surat_undangan_baru = preg_replace('/ /', '_', $filename);
                $simpan = 'y';


            }


//            echo $lamp_surat_undangan_lama; die;
            $pesan = '';
            $simpan = 'y';

            if ($simpan=='y') {
//					    echo "tes"; die;

                if($lamp_surat_undangan_baru==""){
//                    echo "masih dgn data lama"; die;
                    $lamp_surat_undangan_update = $lamp_surat_undangan_lama;

                    /*ini dia cara hapus file di storage*/
                } else if($lamp_surat_undangan_baru!=""){
//                    echo "data baru tidak sama dengan data lama"; die;
                    $lamp_surat_undangan_update = $lamp_surat_undangan_baru;
                    try{
                        $path_lama_akan_dihapus = $lamp_surat_undangan_lama;
                        unlink($path_lama_akan_dihapus);

                    } catch (Exception $e){
                        echo json_encode($e);
                    }
                }
                $data = array(
                    'lamp_surat_undangan'	=> $lamp_surat_undangan_update,


                    'nama_kegiatan'   		=> $nama_kegiatan,
                    'jenis_dokumen'   		=> $jenis_dokumen,
                    'zona_dokumen'   		=> $zona_dokumen,

                );
                $this->db->update('tbl_berita',$data, array('id_berita'=>$id));


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
	 								 <strong>Gagal!</strong> '.$pesan.'.
	 							</div>
	 						 <br>'
                );

//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
            }
//					 redirect("berita/v");
            redirect("harmonisasi/v/".$zona_dokumen);

        }




    }

	public function v($aksi='' , $id='', $pemda='',$status='' )
	{
	    //echo "wkwkwk harmonisasi"; die;
	    //echo $_SESSION['nama_zona'];die;
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');

//		echo $this->uri->segment(1);
//		echo $this->uri->segment(2);
//		echo $this->uri->segment(3); die;

		if($aksi!='t'){
            //$this->session->set_flashdata('msg','');

        }

		if(!isset($ceks)) {
			redirect('web/login');
		}
		    /*tambahan dari sini*/
        $tbl_zona = $this->db->get_where('tbl_zona',array('id_zona'=>$_SESSION['id_zona']));

        $data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
        $data['users']  	 = $this->Mcrud->get_users();
        $data['nama_panjang_admin']  	 = $tbl_zona->row()->nama_panjang;
        $data['zona_pemda']  	 = $tbl_zona->row()->nama_zona;

            /*sampai sini */
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($level=='pelaksana') {
				$this->db->where('id_user',$id_user);
			}
			//dicomment
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
			    //echo "tes tambah"; die;
//				if ($level!='pelaksana') {
//					redirect('404');
//				}
                //echo "page tambah nih"; die;
				$p = "tambah";
				$data['judul_web'] 	  = "TAMBAH DOKUMEN HARMONISASI";
			} else if($aksi=='harmonisasi'){
			    //echo "harmonisasi";die;
                //redirect('dashboard');
                $p = "dashboard_harmonisasi";
                $data['judul_web'] 	  = "DASHBOARD HARMONISASI";

            } else if($aksi=='draft_pemda'){
                $p = "dashboard_draft_pemda";
                $data['judul_web'] 	  = "DASHBOARD DRAFT PEMDA";

            } else if ($aksi=='pemprov_ntb'){
			   //echo "pemprov ntb nich";die;

                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemprov_ntb"));
                /*tabel ny di select belakangan*/
                $p = "pemprov_ntb";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMPROV NTB";

            } else if($aksi=='pemkot_mataram'){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkot_mataram"));
                $p = "pemkot_mataram";
                $data['judul_web'] 	= "DOKUMEN HARMONISASI PEMKOT MATARAM";
            } else if($aksi=='pemkot_bima'){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkot_bima"));
                $p = "pemkot_bima";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKOT BIMA";
            } else if($aksi=='pemkab_sumbawa_barat'){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_sumbawa_barat"));
                $p = "pemkab_sumbawa_barat";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB SUMBAWA BARAT";
            } else if($aksi=="pemkab_sumbawa"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_sumbawa"));
                $p = "pemkab_sumbawa";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB SUMBAWA ";
            } else if($aksi=="pemkab_lombok_utara"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_lombok_utara"));
                $p = "pemkab_lombok_utara";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK UTARA ";
            } else if($aksi=="pemkab_lombok_timur"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_lombok_timur"));
                $p = "pemkab_lombok_timur";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK TIMUR ";
            } else if($aksi=="pemkab_lombok_tengah"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_lombok_tengah"));
                $p = "pemkab_lombok_tengah";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK TENGAH ";
            } else if($aksi=="pemkab_lombok_barat"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_lombok_barat"));
                $p = "pemkab_lombok_barat";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK BARAT ";
            } else if($aksi=="pemkab_dompu"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_dompu"));
                $p = "pemkab_dompu";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB DOMPU ";
            } else if($aksi=="pemkab_bima"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_bima"));
                $p = "pemkab_bima";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB BIMA ";
            } elseif ($aksi == 'd') {
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
			else if ($aksi == 'e') {
			    //echo "coba edit nich pemda";die;
			    if($pemda=='pemprov_ntb'){
                    //echo  "coba edit dokumen pemprov ntb"; die;
//                    echo "<br>id:".$id; die;
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMPROV NTB";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    //echo "<pre>"; print_r($data['query']); die;
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                } else if($pemda=='pemkot_mataram'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKOT MATARAM";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                } else if($pemda=='pemkot_bima'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKOT BIMA";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                } else if($pemda=='pemkab_sumbawa_barat'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB SUMBAWA BARAT";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                } else if($pemda=='pemkab_sumbawa'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB SUMBAWA";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                } else if($pemda=='pemkab_lombok_utara'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK UTARA";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                } else if($pemda=='pemkab_lombok_timur'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK TIMUR";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                }else if($pemda=='pemkab_lombok_tengah'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK TENGAH";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                }else if($pemda=='pemkab_lombok_barat'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK BARAT";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                }else if($pemda=='pemkab_dompu'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB DOMPU";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                }else if($pemda=='pemkab_bima'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB BIMA";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                }



			} else if ($aksi == 'h') {
			    //echo "coba hapus data bro"; die;
                //echo "nama pemda : ".$pemda; die;
                //echo "id data : ".$id; die;
				$cek_data = $this->db->get_where("tbl_berita", array('id_berita' => $id));
				$lamp_surat_lama = $cek_data->row()->lamp_surat_undangan;
				$lamp_berita_acara_lama = $cek_data->row()->lamp_berita_acara??"";
				$lamp_surat_hasil_lama = $cek_data->row()->lamp_surat_hasil??"";
                $id_draft = $cek_data->row()->id_draft;

                //echo "id draft : ".$id_draft; die;

//                if ($id_draft=="0"){
//                    echo "ini data hasil harmonisasi diinput TANPA pengajuan draft";
//                } else {
//                    echo "ini data hasil harmonisasi diinput DENGAN pengajuan draft";
//                }
//                die;

                $data = array(
                    'nama_perancang' => "",
                    'status' => "belum_diproses",
                    'tgl_update' => date('Y-m-d H:i:s'),
                );

                if ($cek_data->num_rows() != 0) {
                    if($id_draft=="0"){

                        $this->db->delete('tbl_berita', array('id_berita' => $id));

                        try {
                            unlink($lamp_surat_lama);
                        } catch (Exception $e) {
                            echo json_encode($e);
                        }

                        try {
                            unlink($lamp_berita_acara_lama);
                        } catch (Exception $e) {
                            echo json_encode($e);
                        }

                        try {
                            unlink($lamp_surat_hasil_lama);
                        } catch (Exception $e) {
                            echo json_encode($e);
                        }

                        $this->session->set_flashdata('msg',
                            '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Data Berhasil dihapus.
							</div>
							<br>'
                        );



                    } else if($id_draft!="0") {
                        $this->db->delete('tbl_berita', array('id_berita' => $id));
                        $this->db->update('tbl_draft',$data, array(
                            'id_draft_permohonan'=>$id_draft
                            )
                        );
                    }

                    if($pemda=='pemprov_ntb'){

                        redirect("harmonisasi/v/pemprov_ntb");
                    } else if($pemda=='pemkot_mataram'){
                        redirect("harmonisasi/v/pemkot_mataram");
                    } else if ($pemda=='pemkot_bima'){
                        redirect("harmonisasi/v/pemkot_bima");
                    } else if($pemda=='pemkab_sumbawa_barat'){
                        redirect("harmonisasi/v/pemkab_sumbawa_barat");
                    } else if($pemda=='pemkab_sumbawa'){
                        redirect("harmonisasi/v/pemkab_sumbawa");
                    } else if($pemda=="pemkab_lombok_utara"){
                        redirect("harmonisasi/v/pemkab_lombok_utara");
                    } else if($pemda=="pemkab_lombok_timur"){
                        redirect("harmonisasi/v/pemkab_lombok_timur");
                    } else if ($pemda=="pemkab_lombok_tengah"){
                        redirect("harmonisasi/v/pemkab_lombok_tengah");
                    } else if($pemda=="pemkab_lombok_barat") {
                        redirect("harmonisasi/v/pemkab_lombok_barat");
                    } else if ($pemda=="pemkab_dompu"){
                        redirect("harmonisasi/v/pemkab_dompu");
                    } else if($pemda=="pemkab_bima"){
                        redirect("harmonisasi/v/pemkab_bima");
                    }

//						redirect("berita/v");
                    redirect("harmonisasi/v/pemprov_ntb");

				} else {
					redirect('404_content');
				}
			} else if($aksi == 'df'){
			    echo "delete lampiran";die;
            }else{
				$p = "index";
				$data['judul_web'] 	  = "Bahan Berita";
			}

				$this->load->view('users/header', $data);
				$this->load->view("users/harmonisasi/$p", $data);
				$this->load->view('users/footer');

				date_default_timezone_set('Asia/Singapore');
				$tgl = date('Y-m-d H:i:s');

//				$lokasi = 'file/bahan_berita';
				$lokasi = 'file/bahan_draft_raperda';
				$this->upload->initialize(array(
					"upload_path"   => "./$lokasi",
					"allowed_types" => "*"
				));

				if (isset($_POST['btnsimpan'])) {

				    //echo "cb btnsimpan tambah hasil harmonisasi nich";die;
					$nama_kegiatan 	 = htmlentities(strip_tags($this->input->post('nama_kegiatan')));
					$jenis_dokumen 	 = htmlentities(strip_tags($this->input->post('jenis_dokumen')));
					$zona_dokumen 	 = htmlentities(strip_tags($this->input->post('zona_dokumen')));
					$status 	 = htmlentities(strip_tags($this->input->post('status')));

					$simpan = '';



					/*proses upload dokumen HARMONISASI*/
                    if ( ! $this->upload->do_upload('lamp_surat_undangan'))
                    {
                        $simpan = 'n';
                        $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                    }
                    else
                    {
                        $gbr = $this->upload->data();
                        $filename = "$lokasi/".$gbr['file_name'];
                        $lamp_surat_undangan = preg_replace('/ /', '_', $filename);
                        $simpan = 'y';
                    }


                    /*proses upload dokumen BERITA ACARA*/
                    if ( ! $this->upload->do_upload('berita_acara'))
                    {
                        //$simpan = 'n';
                        $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                    }
                    else
                    {
                        $gbr = $this->upload->data();
                        $filename = "$lokasi/".$gbr['file_name'];
                        $lamp_berita_acara = preg_replace('/ /', '_', $filename);
                        $simpan = 'y';
                    }

                    /*proses upload dokumen SURAT HASIL*/
                    if ( ! $this->upload->do_upload('surat_hasil'))
                    {
                        //$simpan = 'n';
                        $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                    }
                    else
                    {
                        $gbr = $this->upload->data();
                        $filename = "$lokasi/".$gbr['file_name'];
                        $lamp_surat_hasil = preg_replace('/ /', '_', $filename);
                        $simpan = 'y';
                    }


                    //echo "btn simpan baru"; die;


					if ($simpan=='y') {
//					    echo "tes"; die;
                        /*darimana id_user*/
						$data = array(
							'lamp_surat_undangan'	=> $lamp_surat_undangan,
							'lamp_berita_acara'	=> $lamp_berita_acara??"",
							'lamp_surat_hasil'	=> $lamp_surat_hasil??"",

							'id_user'				=> $id_user,
							'nama_kegiatan'   		=> $nama_kegiatan,
							'tgl_input'   		    => date('Y-m-d H:i:s'),
							'tgl_update'   		    => date('Y-m-d H:i:s'),
							'jenis_dokumen'   		=> $jenis_dokumen,
							'zona_dokumen'   		=> $zona_dokumen,

							'status'   		        => $status,

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

//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
					 }
//					 redirect("berita/v");

//					 redirect("harmonisasi/v/pemprov_ntb");
					 redirect("harmonisasi/v/".$zona_dokumen);

				}

				/*nah ini dia ketika di klik simpan saat selesai edit*/
        if (isset($_POST['btnsimpan_edit'])) {
           //echo "edit kasub perancang coba disimpan";die;
//            echo $pemda;die;



            $nama_kegiatan 	 = htmlentities(strip_tags($this->input->post('nama_kegiatan')));

            $jenis_dokumen 	 = htmlentities(strip_tags($this->input->post('jenis_dokumen')));
            $zona_dokumen 	 = htmlentities(strip_tags($this->input->post('zona_dokumen')));
            $status	 = htmlentities(strip_tags($this->input->post('status')));

            $data_lama = $this->db->get_where('tbl_berita',array('id_berita'=>$id))->row();
            $lamp_surat_undangan_lama = $data_lama->lamp_surat_undangan;
            $lamp_berita_acara_lama = $data_lama->lamp_berita_acara;
            $lamp_surat_hasil_lama = $data_lama->lamp_surat_hasil;

//            echo $lamp_surat_undangan_lama; die;
            /*lamp HASIL HARMONISASI*/
            if ( ! $this->upload->do_upload('lamp_surat_undangan'))
            {
                $simpan = 'n';
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                $lamp_surat_undangan_baru = "";
            }
            else
            {
                $gbr = $this->upload->data();
                /*keterangan : $lokasi = 'file/bahan_berita';*/
                $filename = "$lokasi/".$gbr['file_name'];
                $lamp_surat_undangan_baru = preg_replace('/ /', '_', $filename);
                $simpan = 'y';
            }

            /*lamp BERITA ACARA*/
            if ( ! $this->upload->do_upload('lamp_berita_acara'))
            {
                $simpan = 'n';
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                $lamp_berita_acara_baru = "";
            }
            else
            {
                $gbr = $this->upload->data();
                /*keterangan : $lokasi = 'file/bahan_berita';*/
                $filename = "$lokasi/".$gbr['file_name'];
                $lamp_berita_acara_baru = preg_replace('/ /', '_', $filename);
                $simpan = 'y';
            }


            /*lamp SURAT HASIL*/
            if ( ! $this->upload->do_upload('lamp_surat_hasil'))
            {
                $simpan = 'n';
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                $lamp_surat_hasil_baru = "";
            }
            else
            {
                $gbr = $this->upload->data();
                /*keterangan : $lokasi = 'file/bahan_berita';*/
                $filename = "$lokasi/".$gbr['file_name'];
                $lamp_surat_hasil_baru = preg_replace('/ /', '_', $filename);
                $simpan = 'y';
            }


            $pesan = '';
            $simpan = 'y';

            /*id berita cek disini kukkis*/
            $id_berita 	 = htmlentities(strip_tags($this->input->post('id_berita')));
            //echo "id berita : ".$id_berita; die;

            $data_tbl_berita = $this->db->get_where('tbl_berita',array('id_berita'=>$id_berita))->row();

            //echo "<pre>"; print_r($data_tbl_berita->id_draft); die;

            $id_draftnya = $data_tbl_berita->id_draft;
            if($id_draftnya != "0"){
                //echo "id draft tdk sama dgn nol";
                $data_tbl_draft = $this->db->get_where('tbl_draft',array('id_draft_permohonan'=>$id_draftnya))->row();
                //echo "<pre>"; print_r($data_tbl_draft);
                //echo "statusnya : ".$status; die;
                $data_draft_update = array(

                    'tgl_update'   		    => date('Y-m-d H:i:s'),
                    'status'   		        => $status,

                );
                $this->db->update('tbl_draft',$data_draft_update, array('id_draft_permohonan'=>$id_draftnya));
                //echo $this->db->trans_status(); die;


                if ($this->db->trans_status() === TRUE || $this->db->trans_status() === 1){
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
                } else if ($this->db->trans_status() === FALSE || $this->db->trans_status() === 0){
                    $this->session->set_flashdata('msg',
                        '
							<div class="alert alert-danger alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Gagal!</strong> Merubah Data.
							</div>
							<br>'
                    );
                }




            }
            //die;
            if ($simpan=='y') {
//					    echo "tes"; die;

                /*cek data HASIL HARMONISASI*/
                if($lamp_surat_undangan_baru==""){
                    $lamp_surat_undangan_update = $lamp_surat_undangan_lama;

                } else if($lamp_surat_undangan_baru!=""){

                    $lamp_surat_undangan_update = $lamp_surat_undangan_baru;
                    try{
                        $path_lama_akan_dihapus = $lamp_surat_undangan_lama;
                        unlink($path_lama_akan_dihapus);

                    } catch (Exception $e){
                        echo json_encode($e);
                    }
                }

                /*cek data BERITA ACARA*/
                if($lamp_berita_acara_baru==""){
                    $lamp_berita_acara_update = $lamp_berita_acara_lama;

                } else if($lamp_berita_acara_baru!=""){

                    $lamp_berita_acara_update = $lamp_berita_acara_baru;
                    try{
                        $path_berita_acara_lama_akan_dihapus = $lamp_berita_acara_lama;
                        unlink($path_berita_acara_lama_akan_dihapus);

                    } catch (Exception $e){
                        echo json_encode($e);
                    }
                }


                /*cek data SURAT HASIL*/
                if($lamp_surat_hasil_baru==""){
                    $lamp_surat_hasil_update = $lamp_surat_hasil_lama;

                } else if($lamp_surat_hasil_baru!=""){

                    $lamp_surat_hasil_update = $lamp_surat_hasil_baru;
                    try{
                        $path_surat_hasil_lama_akan_dihapus = $lamp_surat_hasil_lama;
                        unlink($path_surat_hasil_lama_akan_dihapus);

                    } catch (Exception $e){
                        echo json_encode($e);
                    }
                }


                $data = array(
                    'lamp_surat_undangan'	=> $lamp_surat_undangan_update,
                    'lamp_berita_acara'	=> $lamp_berita_acara_update,
                    'lamp_surat_hasil'	=> $lamp_surat_hasil_update,


                    'nama_kegiatan'   		=> $nama_kegiatan,
                    'jenis_dokumen'   		=> $jenis_dokumen,
                    'zona_dokumen'   		=> $zona_dokumen,
                    'tgl_update'   		    => date('Y-m-d H:i:s'),
                    'status'   		        => $status,

                );
                $this->db->update('tbl_berita',$data, array('id_berita'=>$id));


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
	 								 <strong>Gagal!</strong> '.$pesan.'.
	 							</div>
	 						 <br>'
                );

//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
            }
//					 redirect("berita/v");
            redirect("harmonisasi/v/".$zona_dokumen);

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
