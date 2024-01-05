
<?php
ob_start();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .tb-border {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <style type="text/css">
        table.page_header {width: 1020px; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
        table.page_footer {width: 1020px; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}


    </style>
    <!-- Setting Margin header/ kop -->
    <!-- Setting CSS Tabel data yang akan ditampilkan -->
    <style type="text/css">
        .tabel2 {
            border-collapse: collapse;
            margin-left: 80px;
        }
        .tabel2 th, .tabel2 td {
            padding: 5px 5px;
            border: 1px solid #000;
        }
        .tabelatas{

            margin-left: 80px;
            margin-bottom: 25px;
        }
        p{

            margin-left: 80px;
        }

        div.kanan {
            width:300px;
            float:right;
            margin-left:150px;
            margin-top:-110px;
        }

        div.kiri {
            width:300px;
            float:left;
            margin-left:1px;
            display:inline;
        }
        div.tengah {
            width:300px;
            float:left;
            margin-left:455px;
            margin-top:-70px;
            display:inline;
        }
    </style>

</head>
<body>

<table >
    <tr>

        <th rowspan="3">
            <img src="img/tulus_icon.png" style="width:90px;height:100px;" />
        </th>

        <td  align="center" style="width: 550px; ">
            <font style="font-size: 18px">
                <b>INVOICE PEMBAYARAN</b>

                <br>
                <img src="img/sahabattulus_icon.png" style="width:270px;height:30px; margin-top: 10px; " />
                <br>
                <img src="img/hajidanumroh_icon.png" style="width:270px;height:30px; margin-top: 1px; margin-bottom: 10px" />
                <br>
            </font>
<!--            <br>-->
<!--            Jalan Garuda No. 131, Sumbawa Besar 84351 Telepon: (0370) 626642-->
<!--            <br>-->
<!--            Laman: kanimsumbawa.kemenkumham.go.id ; Surel: kanimsumbawa@kemenkumham.go.id-->
        </td>
        <!--            <th rowspan="3"><img src="../gambar/rsam_narmada.png" style="width:95px;height:95px" /></th>-->

    </tr>


</table>
<hr>
<div>
        <span style="margin-left: 210px;font-size: 18px; font-weight: bold">
            <u>DETAIL PEMBAYARAN TRANSAKSI</u>

        </span>
</div>
<br>
<br>
<div class="isi" style="margin: 0 auto;">

    <table class="tabelatas">
        <tr>

            <td style="text-align: left; width=100px;  "><b>Nama Jamaah </b></td>
            <td style="text-align: left; ">: <?= $nama_jamaah_invoice; ?></td>
        </tr>
        <tr>
            <td style="text-align: left; width=100px;  "><b>Pada Tanggal </b></td>
            <td style="text-align: left; ">: <?= $tgl_cetak; ?></td>
        </tr>
        <tr>
            <td style="text-align: left; width=100px;  "><b>No. Invoice</b></td>
            <td style="text-align: left; ">: <?= $no_invoice_unique; ?></td>
        </tr>
        <tr>
            <td style="text-align: left; width=100px;  "><b>Paket Pilihan </b></td>
            <td style="text-align: left; ">: <?= $paket_pilihan; ?></td>
        </tr>
        <tr>
            <td style="text-align: left; width=100px;  "><b>Jenis Paket </b></td>
            <td style="text-align: left; ">: <?= $jenis_paket_pilihan; ?></td>
        </tr>

    </table>
    <div style="height: 29px;">

    </div>
    <table class="tabel2">
        <thead>
        <tr style="background-color: #a2a5b4">
            <td style="text-align: center; width=100px;"><b>Keterangan</b></td>

            <td style="text-align: center; width=150px;"><b>Harga Paket</b></td>
            <?php
            if($data_jamaah->row()->status_pembayaran=="bayar_lunas_umroh" or $data_jamaah->row()->status_pembayaran=="bayar_lunas_haji"){
                ?>
                <!--kolom 3-->
                <td style="text-align: center; width=80px;"><b>Uang Pembayaran</b></td>
                <?php
                if($harga_paket > $data_jamaah->row()->uang_pembayaran){
                    ?>
                    <!--kolom 4-->
                    <td style="text-align: center; width=80px;"><b>Diskon Harga</b></td>
                    <?php
                } else if($harga_paket == $data_jamaah->row()->uang_pembayaran){
                    ?>
                    <!--kolom 4-->
                    <td style="text-align: center; width=80px;"><b>Sisa Pembayaran</b></td>
                    <?php
                }
                ?>
                <?php
            } else if($data_jamaah->row()->status_pembayaran=="bayar_dp_umroh" or $data_jamaah->row()->status_pembayaran=="bayar_dp_haji"){
                ?>
                <!--kolom 3-->
                <td style="text-align: center; width=80px;"><b>Uang Muka</b></td>
                <?php
                if($harga_paket > $data_jamaah->row()->uang_pembayaran){
                    ?>
                    <td style="text-align: center; width=80px;"><b>Sisa Belum Bayar</b></td>
                    <?php
                }
                ?>
                <?php
            }
            ?>


        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($data_jamaah->result() as $index=>$dt){
            ?>
            <tr>
                <td style="text-align: center; font-size: 12px;">
                    <?php
                    if($dt->status_pembayaran!=""){
                        $stt_bayar = explode("_",$dt->status_pembayaran);
                        echo $stt_bayar[0]." ".$stt_bayar[1]." ".$stt_bayar[2] ;
                    }
                    ?>
                </td>

                <td style="text-align: center; font-size: 12px;">
                    Rp <?php
                    echo number_format($harga_total_paket);
                    ?>
                </td>

                <td style="text-align: center; font-size: 12px;">
                    Rp <?php
                    echo number_format($dt->uang_pembayaran);
                    ?>
                </td>
                <td style="text-align: center; font-size: 12px;">
                    <?php
                    $sisa_belum_bayar = $harga_total_paket - $dt->uang_pembayaran;

                    echo "Rp ".number_format($sisa_belum_bayar);
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
        <br>
        <tr>
            <!--contoh yg diatasnya agar footer total sama rata dan sama panjang-->
            <td style="border-right-color: white; text-align: center; font-size: 12px; ">

            </td>
            <td style="border-right-color: white; text-align: left; font-size: 12px; align-items: center">
                <b style="margin-left: 50px">Kode Unik</b>
            </td>
            <td style="text-align: center; font-size: 12px;"></td>
            <td style="text-align: center; font-size: 12px;">Rp <?= number_format($biaya_admin)?></td>
        </tr>
        <tr>
            <!--contoh yg diatasnya agar footer total sama rata dan sama panjang-->
            <td style="border-right-color: white; text-align: center; font-size: 12px; ">

            </td>
            <td style="border-right-color: white; text-align: left; font-size: 12px; align-items: center">
                <b style="margin-left: 70px">Total </b>
            </td>
            <td style="text-align: center; font-size: 12px;"></td>
            <td style="text-align: center; font-size: 12px;">Rp <?php echo number_format(($harga_total_paket - $dt->uang_pembayaran)+($biaya_admin));?></td>
        </tr>



        <?php
        ?>
        </tbody>



    </table>

    <div style="height: 29px">

    </div>

    <table class="tabelatas">
        <tr>

            <td style="text-align: left; width=100px;  "><b>Pembayaran Oleh</b></td>
            <td style="text-align: left; ">: <?= $nama_jamaah_invoice; ?></td>
        </tr>
        <tr>
            <td style="text-align: left; width=100px;  "><b>No. Rekening </b></td>
            <td style="text-align: left; ">: <?= "0987654321" ?></td>
        </tr>
    </table>



    <div class="kiri">


        <p> </p>
        <p>
            <b>TERIMA KASIH ATAS PEMBAYARAN ANDA</b>
        </p>

        <br>
        <br>
        <br>
    </div>

    <div class="kanan">


        <p> </p>
        <p>
            <b>Ttd <?php echo ucfirst($nama_operator);?> </b>
        </p>

        <br>
        <br>
        <br>


    </div>

    <div class="tengah">


        <p> </p>
        <p>
            <img src="img/ttd2.png" style="width:90px;height:100px;" />
        </p>

        <br>
        <br>
        <br>


    </div>


</div>

















</body>
</html>




