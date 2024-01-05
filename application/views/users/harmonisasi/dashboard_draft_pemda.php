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
    <?php
    $nama_user = explode('_',$_SESSION['username']);
    if(count($nama_user)==3){
        $nama_user_fix = $nama_user[0]." ".$nama_user[1]." ".$nama_user[2];
    } else if (count($nama_user)==2){
        $nama_user_fix = $nama_user[0]." ".$nama_user[1];
    } else if (count($nama_user)==1){
        $nama_user_fix = $nama_user[0];
    }
    ?>
	  <h1 class="page-header" style="font-size: 25px">Dashboardd  <small> <?php echo strtoupper($nama_user_fix);?></small></h1>
	  <h3 class="page-header"  style="font-size: 18px">Selamat Datang di SITAROH</h3>
	  <!-- end page-header -->
	  <!-- begin row -->



	<!-- DASHBOARD superADMIN -->

	<div class="row">
        <div class="panel panel-inverse">
            <div class="panel-body">
                <div style="margin-left: 3px" class="row hidden">
                    <h5>Unggah Dokumen Hasil Harmonisasi</h5>
                    <br>
                    <a href="harmonisasi/v/t.html" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Dokumen </a>

                </div>

<!--                <hr>-->
                <h5>Lihat Dokumen Draft Pemda</h5>
                <div class="row">

                    <?php
                    $dt_tbl_zona = $this->db->get("tbl_zona");
                    foreach ($dt_tbl_zona->result() as $id=>$val){
                        ?>
                        <div <?php if ($val->nama_zona=='superadmin'){ ?> class="col-md-3 hidden" <?php }
                        else if($val->nama_zona=='kasub_perancang') { ?> class="col-md-3 hidden" <?php } else { ?> class="col-md-3" <?php } ?> >
                            <a href="pemda/draft/<?= $val->nama_zona; ?>.html" style="text-decoration: none">
                                <div class="widget widget-stats <?= $val->warna_background; ?> text-inverse">
                                    <div class="stats-icon stats-icon-lg stats-icon-square">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    </div>
                                    <div class="stats-desc"><?= $val->nama_panjang;?></div>
                                    <div class="stats-number">
                                        <?php
                                        if($level=='pelaksana'){
                                            $this->db->where('id_user',$cek->id_user);
                                        }

                                        echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>$val->nama_zona))->num_rows(),0,",","."); ?>
                                    </div>
                                    <div class="stats-progress progress">
                                        <div class="progress-bar" style="width: 70.1%;"></div>
                                    </div>
                                    <div class="stats-desc">Total Dokumen Draft</div>
                                </div>
                            </a>

                        </div>
                        <?php
                    }
                    ?>
                    <div hidden <?php if($_SESSION['nama_zona']=='pemprov_ntb'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin' ){ ?> class="col-md-3"<?php } else if($_SESSION['nama_zona']=='kasub_perancang'){ ?> class="col-md-3 " <?php } else if($_SESSION['nama_zona']=='perancang') { ?> class="col-md-3" <?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemprov_ntb.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-purple text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemprov NTB</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }

                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemprov_ntb'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>
                        </a>

                    </div>

                    <div hidden <?php if($_SESSION['nama_zona']=='pemprov_ntb'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemprov_ntb.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-dark-blue-light text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemprov NTB</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemprov_ntb'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>

                    <div hidden <?php if($_SESSION['nama_zona']=='pemkot_mataram'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3"<?php } else if($_SESSION['nama_zona']=='kasub_perancang'){ ?> class="col-md-3 " <?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkot_mataram.html" style="text-decoration: none; ">
                            <div class="widget widget-stats bg-gradient-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkot Mataram</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkot_mataram'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>
                        </a>
                    </div>

                    <div hidden <?php if($_SESSION['nama_zona']=='pemkot_mataram'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkot_mataram.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-dark-blue-light text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkot Mataram</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkot_mataram'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>



                    <div hidden <?php if($_SESSION['nama_zona']=='pemkot_bima'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3"<?php } else if($_SESSION['nama_zona']=='kasub_perancang'){ ?> class="col-md-3 " <?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkot_bima.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-dark-blue-light text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkot Bima</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkot_bima'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>
                        </a>
                    </div>

                    <div hidden <?php if($_SESSION['nama_zona']=='pemkot_bima'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkot_bima.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkot Bima</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkot_bima'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>

                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_sumbawa_barat'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3"<?php } else if($_SESSION['nama_zona']=='kasub_perancang'){?> class="col-md-3 " <?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkab_sumbawa_barat.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Sumbawa Barat</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkab_sumbawa_barat'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>
                        </a>

                    </div>

                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_sumbawa_barat'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkab_sumbawa_barat.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Sumbawa Barat</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkab_sumbawa_barat'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>
                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_sumbawa'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3"<?php } else if($_SESSION['nama_zona']=='kasub_perancang'){?> class="col-md-3 " <?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkab_sumbawa.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-green text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Sumbawa</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkab_sumbawa'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>

                        </a>
                    </div>

                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_sumbawa'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkab_sumbawa.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Sumbawa</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkab_sumbawa'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>
                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_lombok_utara'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3"<?php } else if($_SESSION['nama_zona']=='kasub_perancang'){?> class="col-md-3 " <?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkab_lombok_utara.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-blue-inverse text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Lombok Utara</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkab_lombok_utara'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>

                        </a>
                    </div>

                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_lombok_utara'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkab_lombok_utara.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Lombok Utara</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkab_lombok_utara'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>
                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_lombok_timur'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3"<?php } else if($_SESSION['nama_zona']=='kasub_perancang'){?> class="col-md-3 " <?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkab_lombok_timur.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-yellow text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Lombok Timur</div>
                                <div style="color: white" class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkab_lombok_timur'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>

                        </a>
                    </div>
                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_lombok_timur'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkab_lombok_timur.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Lombok Timur</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkab_lombok_timur'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>
                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_lombok_tengah'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3"<?php } else if($_SESSION['nama_zona']=='kasub_perancang'){?> class="col-md-3 " <?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkab_lombok_tengah.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-blue-dark text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Lombok Tengah</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkab_lombok_tengah'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>

                        </a>
                    </div>
                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_lombok_tengah'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkab_lombok_tengah.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Lombok Tengah</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkab_lombok_tengah'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>
                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_lombok_barat'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3"<?php } else if($_SESSION['nama_zona']=='kasub_perancang'){?> class="col-md-3 " <?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkab_lombok_barat.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-pink text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Lombok Barat</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkab_lombok_barat'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>

                        </a>
                    </div>
                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_lombok_barat'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkab_lombok_barat.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Lombok Barat</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkab_lombok_barat'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>
                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_dompu'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3"<?php } else if($_SESSION['nama_zona']=='kasub_perancang'){?> class="col-md-3 " <?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkab_dompu.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Dompu</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkab_dompu'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>

                        </a>
                    </div>
                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_dompu'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkab_dompu.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Dompu</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkab_dompu'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>
                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_bima'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3"<?php } else if($_SESSION['nama_zona']=='kasub_perancang'){?> class="col-md-3 " <?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkab_bima.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-purple-inverse text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Bima</div>
                                <div style="color: #f9fffb" class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkab_bima'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>

                        </a>
                    </div>
                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_bima'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkab_bima.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Bima</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkab_bima'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>
                </div>


            </div>

        </div>

	</div>






</div>
<!-- end #content -->
