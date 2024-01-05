<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcrud extends CI_Model {

	var $tbl_users				 = 'tbl_user';
	var $tbl_agen				 = 'tbl_agen';



 	public static function tgl_id($date, $bln='')
 	{
	 date_default_timezone_set('Asia/Jakarta');
		 $str = explode('-', $date);
		 $bulan = array(
			 '01' => 'Januari',
			 '02' => 'Februari',
			 '03' => 'Maret',
			 '04' => 'April',
			 '05' => 'Mei',
			 '06' => 'Juni',
			 '07' => 'Juli',
			 '08' => 'Agustus',
			 '09' => 'September',
			 '10' => 'Oktober',
			 '11' => 'November',
			 '12' => 'Desember',
		 );
		 if ($bln == '') {
			 $hasil = $str['0'] . "-" . substr($bulan[$str[1]],0,3) . "-" .$str[2];
		 }elseif ($bln == 'full') {
			 $hasil = $str['0'] . " " . $bulan[$str[1]] . " " .$str[2];
		 }else {
			 $hasil = $bulan[$str[1]];
		 }
		 return $hasil;
 	}

    public function tgl_sql($date){
        $exp = explode("-",$date);
        if(count($exp) == 3){
            $bln_sql = $this->getBulanSql($exp[1]);
            $tgl_sql = $this->getTglSql($exp[0]);
//            $date_tgl = $exp[2].'-'.$bln_sql.'-'.$exp[0];
            $date_tgl = $exp[2].'-'.$bln_sql.'-'.$tgl_sql;
        }
        return $date_tgl;
    }

    public function getBulanSql($bln){
        switch ($bln) {
            case "Jan":
                return "01";
                break;
            case "Feb":
                return "02";
                break;
            case "Mar":
                return "03";
                break;
            case "Apr":
                return "04";
                break;
            case "May":
                return "05";
                break;
            case "Jun":
                return "06";
                break;
            case "Jul":
                return "07";
                break;
            case "Aug":
                return "08";
                break;
            case "Sep":
                return "09";
                break;
            case "Oct":
                return "10";
                break;
            case "Nov":
                return "11";
                break;
            case "Dec":
                return "12";
                break;
        }
    }

    public function getTglSql($tgl){
        switch ($tgl) {
            case "1":
                return "01";
                break;
            case "2":
                return "02";
                break;
            case "3":
                return "03";
                break;
            case "4":
                return "04";
                break;
            case "5":
                return "05";
                break;
            case "6":
                return "06";
                break;
            case "7":
                return "07";
                break;
            case "8":
                return "08";
                break;
            case "9":
                return "09";
                break;
            case "10":
                return "10";
                break;
            case "11":
                return "11";
                break;
            case "12":
                return "12";
                break;
            case "13":
                return "13";
                break;
            case "14":
                return "14";
                break;
            case "15":
                return "15";
                break;
            case "16":
                return "16";
                break;
            case "17":
                return "17";
                break;
            case "18":
                return "18";
                break;
            case "19":
                return "19";
                break;

            case "20":
                return "20";
                break;
            case "21":
                return "21";
                break;
            case "22":
                return "22";
                break;
            case "23":
                return "23";
                break;
            case "24":
                return "24";
                break;
            case "25":
                return "25";
                break;
            case "26":
                return "26";
                break;
            case "27":
                return "27";
                break;
            case "28":
                return "28";
                break;
            case "29":
                return "29";
                break;

            case "30":
                return "30";
                break;
            case "31":
                return "31";
                break;

        }
    }

	public function hari_id($tanggal)
	{
		$day = date('D', strtotime($tanggal));
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => "Jum'at",
			'Sat' => 'Sabtu'
		);
		return $dayList[$day];
	}

	public function get_users()
	{
			return $this->db->get_where($this->tbl_users);
	}

	public function get_id_user($id)
	{
			return $this->db->get_where($this->tbl_users, array('id_user'=>$id));
	}

	public function get_level_users()
	{
			return $this->db->get_where($this->tbl_users);
	}

	/*LANJUTKANZ*/
	public function get_level_users_tbl_agen()
	{
			return $this->db->get_where($this->tbl_users);
	}

	public function get_users_by_un($id)
	{
		return $this->db->get_where($this->tbl_users, array('username'=>"$id"));
	}

	public function get_users_by_un_tbl_agen($id)
	{
		return $this->db->get_where($this->tbl_agen, array('username'=>"$id"));
	}
	public function get_users_by_un_and_role($id,$role)
	{
		return $this->db->get_where($this->tbl_users, array(
		    'username'=>"$id",
		    'level'=>"$role",
        ));
	}
	public function get_users_by_un_and_role_tbl_agen($id,$role)
	{
		return $this->db->get_where($this->tbl_agen, array(
		    'username'=>"$id",
		    'role_agen_id'=>"$role",
        ));
	}

	public function get_level_users_by_id($id)
	{
			$this->db->from($this->tbl_users);
			$this->db->where('tbl_user.level', 'obh');
			$this->db->where('tbl_user.id_user', $id);
			$query = $this->db->get();
			return $query->row();
	}

	public function save_user($data)
	{
		$this->db->insert($this->tbl_users, $data);
		return $this->db->insert_id();
	}

	public function update_user($where, $data)
	{
		$this->db->update($this->tbl_users, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_user_by_id($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete($this->tbl_users);
	}

	public function waktu($data, $aksi='')
	{
		if ($aksi=='full') {
			$tgl_n = date('d-m-Y H:i:s',strtotime($data));
		}else {
			$tgl_n = date('d-m-Y',strtotime($data));
		}
		$hari = $this->Mcrud->hari_id($tgl_n);
		$tgl  = $this->Mcrud->tgl_id($tgl_n,$aksi);
		return $hari.", ".$tgl;
	}

    public function url_data_dukung($array) {
        return json_decode($array);
    }

	function judul_web()
	{
//		$data = "AMERTA - Aplikasi Manajemen Berita";
		$data = "SITAROH - Sistem Data Haji Dan Umroh";
		return $data;
	}

	function footer()
	{
			return "Copyright &copy; 2019 | Developer by Kemenkumham NTB";
	}

	public function cek_filename($file='')
	{
		$data = "assets/favicon.png";
		if ($file != '') {
			if(file_exists("$file")){
				$data = $file;
			}
		}
		return $data;
	}

	//d_pelaksana
	function d_pelaksana($id='',$aksi='')
	{
		if ($aksi=='nama_pelaksana') {
			$data = $this->db->get_where('tbl_user', array('id_user'=>$id))->row()->nama_lengkap;
		}else {
			$data = '-';
		}
		return $data;
	}

	//cek status berita
	function cek_status_berita($data)
        /*'belum_diproses','perbaikan','draft_sedang_dibuat','menunggu_koreksi','selesai'*/
	{
		if ($data=='belum_diproses') {
			$v_data = '<label class="label label-danger">BELUM DIPROSES</label>';
		}elseif ($data=='perbaikan') {
			$v_data = '<label class="label label-danger">PERBAIKAN</label>';
		} else if($data=='sedang_diproses'){
            $v_data = '<label class="label label-inverse">SEDANG DIPROSES</label>';
        }
		elseif ($data=='draft_sedang_dibuat') {
			$v_data = '<label class="label label-warning">DRAFT SEDANG DIBUAT</label>';
		}elseif ($data=='menunggu_koreksi') {
			$v_data = '<label class="label label-primary">MENUNGGU KOREKSI</label>';
		}elseif ($data=='selesai') {
			$v_data = '<label class="label label-success">SELESAI</label>';
		}else {
			$v_data = '';
		}
		return $v_data;
	}

    public static function tgl_english($date, $bln){
        date_default_timezone_set('Asia/Singapore');
        $str = explode('-', $date);
        $bulan = array(
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'May',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Aug',
            '09' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec',
        );
        if ($bln == '') {
            $hasil = $str['2'] . "-" . substr($bulan[$str[1]],0,3) . "-" .$str[0];
        }elseif ($bln == 'full') {
            $hasil = substr($str['2'],0,2) . "-" . $bulan[$str[1]] . "-" .$str[0];
        }else {
            $hasil = $bulan[$str[1]];
        }
        return $hasil;
    }

	function kirim_notif($pengirim,$penerima,$id_berita,$notif_type,$pesan)
	{
		date_default_timezone_set('Asia/Jakarta');
		$tgl = date('Y-m-d H:i:s');
		if ($pengirim=='humas') { 
			$pengirim = '6';
		}
		if ($penerima=='humas') {
			for($i=0; $i<6; $i++) {
				$penerima_id[$i] = $i+1;
			}
		}

		if ($notif_type == 'berita') {
			if ($pesan=='pelaksana_kirim_berita') {
				$pesan = "Mengirim bahan berita baru.";
			}elseif ($pesan=='pelaksana_perbaikan_berita') {
				$pesan = "Mengirim perbaikan bahan berita.";
			}elseif ($pesan=='humas_perbaikan_berita') {
				$pesan = "Bahan berita perlu perbaikan";
			}elseif ($pesan=='humas_proses_berita') {
				$pesan = "Narasi berita sedang dipost";	
			}elseif ($pesan=='humas_konfirmasi_berita') {
				$pesan = "Bahan berita sedang dikoreksi";	
			}elseif ($pesan=='humas_selesai_berita') {
				$pesan = "Bahan berita sudah dipost";	
			}
			
			if ($id_berita=='' OR $id_berita==0) {
				$link = '';
			}else{
				$link = "berita/v/d/".hashids_encrypt($id_berita);
			}
			
		}

		if($penerima=="humas") {
			for ($i=0; $i < count($penerima_id); $i++) { 
				$data2 = array(
					'pengirim'  => $pengirim,
					'penerima'  => $penerima_id[$i],
					'pesan'  		=> $pesan,
					'link'			=> $link,
					'id_berita' => $id_berita,
					'tgl_notif' => $tgl
				);
				$this->db->insert('tbl_notif',$data2);
			}
		} else {
			$data2 = array(
					'pengirim'  => $pengirim,
					'penerima'  => $penerima,
					'pesan'  		=> $pesan,
					'link'			=> $link,
					'id_berita' => $id_berita,
					'tgl_notif' => $tgl
				);
				$this->db->insert('tbl_notif',$data2);
		}



		
		
	}

}
