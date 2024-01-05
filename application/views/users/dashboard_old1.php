<?php
$cek    = $user->row();
$level  = $cek->level;

?>
<!-- begin #content -->
<div id="content" class="content">
	  <!-- begin breadcrumb -->
	  <ol class="breadcrumb pull-right">
		<li class="active">Dashboard</li>
	  </ol>
	  <!-- end breadcrumb -->
	  <!-- begin page-header -->
	  <h1 class="page-header">Dashboard <small> <?php echo ucwords($cek->level);?></small></h1>
	  <!-- end page-header -->
	  <!-- begin row -->


	<!-- DASHBOARD superADMIN -->
	<div class="row">
		<div class="col-md-3">
			<div class="widget widget-stats bg-blue text-inverse">
				<div class="stats-icon stats-icon-lg stats-icon-square">
				  <i class="fa fa-newspaper-o" aria-hidden="true"></i>
				</div>
				<div class="stats-desc">Total Berita</div>
				<div class="stats-number">
				  <?php 
				  	if($level=='pelaksana'){
						$this->db->where('id_user',$cek->id_user);
					}				  
					echo number_format($this->db->get('tbl_berita')->num_rows(),0,",","."); ?>
				</div>
				<div class="stats-progress progress">
					<div class="progress-bar" style="width: 70.1%;"></div>
				</div>
				<div class="stats-desc">Total Bahan Berita yang Masuk</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="widget widget-stats bg-red text-inverse">
				<div class="stats-icon stats-icon-lg stats-icon-square">
				  <i class="fa fa-file-text" aria-hidden="true"></i>
				</div>
				<div class="stats-desc">Berita Belum Diproses</div>
				<div class="stats-number">
				   <?php
					if($level=='pelaksana'){
						$this->db->where('id_user',$cek->id_user);
					}
					echo number_format($this->db->get_where('tbl_berita', array('status'=>'menunggu'))->num_rows(),0,",","."); ?>
				</div>
				<div class="stats-progress progress">
					<div class="progress-bar" style="width: 70.1%;"></div>
				</div>
				<div class="stats-desc">Total Berita yang Belum Diproses</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="widget widget-stats bg-orange text-inverse">
				<div class="stats-icon stats-icon-lg stats-icon-square">
				  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				</div>
				<div class="stats-desc">Berita Sedang Diproses</div>
				<div class="stats-number">
				   <?php
					if($level=='pelaksana'){
						$perbaikan = number_format($this->db->get_where('tbl_berita', array('id_user'=>$cek->id_user, 'status'=>'perbaikan'))->num_rows(),0,",",".");
						$proses = number_format($this->db->get_where('tbl_berita', array('id_user'=>$cek->id_user, 'status'=>'proses'))->num_rows(),0,",",".");
						$konfirmasi = number_format($this->db->get_where('tbl_berita', array('id_user'=>$cek->id_user, 'status'=>'konfirmasi'))->num_rows(),0,",",".");
					}

					$perbaikan = number_format($this->db->get_where('tbl_berita', array('status'=>'perbaikan'))->num_rows(),0,",",".");
					$proses = number_format($this->db->get_where('tbl_berita', array('status'=>'proses'))->num_rows(),0,",",".");
					$konfirmasi = number_format($this->db->get_where('tbl_berita', array('status'=>'konfirmasi'))->num_rows(),0,",",".");

					$berita_count = $perbaikan + $proses + $konfirmasi;
					echo $berita_count;
					?>
					
				</div>
				<div class="stats-progress progress">
					<div class="progress-bar" style="width: 70.1%;"></div>
				</div>
				<div class="stats-desc">Total Berita yang Sedang Diproses</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="widget widget-stats bg-info text-inverse">
				<div class="stats-icon stats-icon-lg stats-icon-square">
				  <i class="fa fa-paper-plane" aria-hidden="true"></i>
				</div>
				<div class="stats-desc">Berita Sudah Dipost</div>
				<div class="stats-number">
				   <?php
					if($level=='pelaksana'){
						$this->db->where('id_user',$cek->id_user);
					}
					echo number_format($this->db->get_where('tbl_berita', array('status'=>'selesai'))->num_rows(),0,",","."); ?>
				</div>
				<div class="stats-progress progress">
					<div class="progress-bar" style="width: 70.1%;"></div>
				</div>
				<div class="stats-desc">Total Berita yang Sudah Dipost</div>
			</div>
		</div>
	<div class="row"></div>
			




		  
</div>
<!-- end #content -->
