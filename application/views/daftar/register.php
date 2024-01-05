    <!-- Content area -->

        <!-- Dashboard content -->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="panel panel-inverse">
                    <div class="panel-heading" style="margin-top: 55px;">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title"><?php echo $judul_web; ?></h4>
                    </div>
                    <div class="panel-body">
                        <?php
                        echo $this->session->flashdata('msg');
                        ?>
                        <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label col-lg-3">Nama Pengguna</label>
                                <div class="col-lg-9">
                                    <input type="text" name="nama_daftar" class="form-control" value="" placeholder="Nama" required autofocus onfocus="this.value = this.value;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Level</label>
                                <div class="col-lg-9">
                                    <select class="form-control default-select2"
                                            name="level_daftar" id="level_daftar" selected="<?php echo $query->level; ?>" required>
                                        <option style="text-align: center" value="Pilih Role" <?php if('semua'==$link5){ ?> selected <?php }?> >-Pilih Posisi-</option>
                                        <option style="text-align: center" value="direktur_m" <?php if('direktur_m'==$link5){echo "selected";} ?> >Direktur Mujahid</option>
                                        <option style="text-align: center" value="manajer_m" <?php if('manajer_m'==$link5){echo "selected";} ?> >Manajer Mujahid</option>
                                        <option style="text-align: center" value="mujahid_b" <?php if('mujahid_b'==$link5){echo "selected";} ?> >Mujahid Baitullah</option>

                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Cabang</label>
                                <div class="col-lg-9">
                                    <select class="form-control default-select2"
                                            name="zona_id" id="zona_id" selected="<?php echo $query->id_zona; ?>" required>
                                        <option value="">- Pilih Cabang -</option>
                                        <?php
                                        /*cara get semua records di database*/
                                        //                                $data_zonaAll = $this->db->get("tbl_zona");
                                        $data_cabangAll = $this->db->get("tbl_cabang");
                                        // echo "<pre>"; print_r($data_zonaAll);
                                        foreach ($data_cabangAll->result() as $index=>$cabang){
                                            if($cabang->nama_cabang!='Superadmin'){ ?>
                                                <option value="<?= $cabang->id_cabang?>"><?= $cabang->nama_panjang?></option>
                                            <?php } ?>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Username</label>
                                <div class="col-lg-9">
                                    <input type="text" name="username_daftar" class="form-control" value="" placeholder="Username" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Email</label>
                                <div class="col-lg-9">
                                    <input type="email" name="email_daftar" id="email_daftar" class="form-control" value="" placeholder="Email" required autocomplete="off">
                                </div>
                            </div>
<!--                            <input type="text" class="form-control @error('title') is-invalid @enderror"-->
<!--                                   id="title" name="title" required autofocus value="{{ old('title', $post->title)  }}">-->

                            <div class="form-group">
                                <label class="control-label col-lg-3">Password</label>
                                <div class="col-lg-9">
                                    <input type="password" name="password_daftar" id="password_daftar"
                                           class="form-control" value=""
                                           placeholder="Password" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Re-Password</label>
                                <div class="col-lg-9">
                                    <input type="password" name="password2_daftar" id="password2_daftar"
                                           class="form-control" value=""
                                           placeholder="Konfirmasi Password" required autocomplete="off">
                                </div>
                            </div>
                            <hr>
                            <a href="web/login" class="btn btn-default"><< Ke Halaman Login</a>
                            <button type="submit" name="btnsimpan_daftar" id="btnsimpan_daftar"
                                    class="btn btn-primary" style="float:right;">Simpan</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- /dashboard content -->