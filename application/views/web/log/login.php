<section dir="ltr" id="home">
<div class="limiter" >
<!--	<div class="container-login100" style="background-color: #a1d5ff">-->
	<div class="container-login100" >
		<div class="wrap-login100" style="padding:20px; height: 575px; background-color: #0d181a;
		border-radius: 10px; opacity: 85%">
<!--			<div class="login100-pic">-->
<!--				<a style="color: black" class="" href="http://www.freepik.com"></a>-->
<!--                <div style="height: 10px"></div>-->
<!--				<center><img style="height: 450px; margin-left: 0px; border-radius: 50px " src="img/peresean-rinjani.png" alt="IMG"></img></center>-->
<!---->
<!--			</div>-->
			<form class="login100-form validate-form" action="" method="post">
				<span class="login100-form-title">
<!--					<img style="height: 50px; width: 50px; border-radius: 0px; opacity: 100%" src="img/SITAROH_ICON.png" alt=""></img>-->
					<img style="height: 150px; width: 150px; border-radius: 0px; opacity: 100%" src="img/tulus_icon.png" alt="IMG"></img>
				</span>
				<span class="login100-form-title" style="color: #8c7e4e;font-size: 17px; padding: 10px 0px 10px 15px;">
					SISTEM DATA HAJI DAN UMROH (SITAROH)
				</span>
				<?php
					echo $this->session->flashdata('msg');
				?>
				<div class="wrap-input100 validate-input" data-validate = "Username is required">
					<input class="input100" type="text" placeholder="Username" name="username" autofocus>
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-user" aria-hidden="true"></i>
					</span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Password is required">
					<input class="input100" type="password" placeholder="Password" name="password">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-lock" aria-hidden="true"></i>
					</span>
				</div>

                <div class="col-lg-12" style="width: 100%; border-radius: 30px">

                    <select required style="width: 285px; margin-left: -12px; " class="form-control default-select2" id="stt" name="stt">
                        <option style="text-align: center" value="Pilih Role" <?php if('semua'==$link5){ ?> selected <?php }?> >-Pilih Posisi-</option>

                        <?php
                        foreach ($data_role_agen_all->result() as $index=>$data){
                            if($data->nama_role_agen!="administrator" and $data->nama_role_agen!="presiden_direktur"){
                            ?>
                                <option style="text-align: center" value="<?php echo $data->id_role_agen?>">
                                    <?= $data->nama_role_agen_lengkap; ?>
                                </option>
                                <?php
                            }
                        }
                        ?>

                    </select>
                </div>



                <div class="form-group m-t-10 " style="border-radius: 20px">
                    <div class="g-recaptcha" data-sitekey="6LdJ0pAmAAAAAI7vU7S3seu7_Wt9AnJCINpeceU_"
                         style="width: 40px">

                    </div>
                </div>

                <div class="container-login100-form-btn" style="margin-top:-20px ; margin-bottom: -5px">
                    <!--                    <button type="submit" id="btnlogin" name="btnlogin" class="login100-form-btn">-->
                    <!--                        Login-->
                    <!--                    </button>-->
                    <input type="submit" id="btnlogin" name="btnlogin" class="login100-form-btn" value="Login" />
                </div>

                <span class="login100-form-title" style="font-weight: bold;color: #ffffff;font-size: 17px; padding: 10px 0px 10px 15px;">
					<a hidden href="daftar.html" style="color: #f4ff0e; font-size: 13px;">Daftar disini</a>
				</span>

                <!--kukus-->
                <!--<div class="" style="margin-top: 5px ">

                    <input type="submit" id="btnlogin" name="btnlogin" class="login100-form-btn" value="Daftar Agen" />
                </div>-->
			</form>
		</div>
	</div>
</div>
    <script type="text/javascript">

        $(document).on('click', '#btnlogin', function() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                alert("Please verify you are not a robot.");
                return false;
            }
        });
    </script>
</section >

