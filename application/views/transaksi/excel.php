<?php
    function rupiah($angka){
            
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }

    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div class="d-flex justify-content-begin mt-3">
                    <h1 class="h3 mb-0 text-gray-800 mr-3">Laporan Keuangan</h1>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table text-dark" style="font-size: 12px" border=1>
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>No Kuitansi</th>
                            <th>Nama Lengkap</th>
                            <th>Pengajar</th>
                            <th>Nominal</th>
                            <th>Terbilang</th>
                            <th>Keterangan</th>
                            <th>Piutang</th>
                            <th>TL</th>
                            <th>BA</th>
                            <th>PK</th>
                            <th>PL</th>
                            <th>Buku</th>
                            <th>PT3</th>
                            <th>T1</th>
                            <th>T2</th>
                            <th>T3</th>
                            <th>T4</th>
                            <th>Deposit</th>
                            <th>Daftar Reg</th>
                            <th>Daftar PK</th>
                            <th>Daftar PL</th>
                            <th>TA</th>
                            <th>TD</th>
                            <th>Lain2</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $no = 0;
                            $total = ["piutang" => 0, "tl" => 0, "ba" => 0, "pk" => 0, "pl" => 0, "buku" => 0, "pt3" => 0, "t1" => 0, "t2" => 0, "t3" => 0, "t4" => 0, "deposit" => 0, "daftar_reg" => 0, "daftar_pk" => 0, "daftar_pl" => 0, "ta" => 0, "td" => 0, "lain" => 0, "total" => 0];
                        ?>
                        <?php foreach ($data as $i => $data) :?>
                            <?php 

                                $subtotal = ["piutang" => 0, "tl" => 0, "ba" => 0, "pk" => 0, "pl" => 0, "buku" => 0, "pt3" => 0, "t1" => 0, "t2" => 0, "t3" => 0, "t4" => 0, "deposit" => 0, "daftar_reg" => 0, "daftar_pk" => 0, "daftar_pl" => 0, "ta" => 0, "td" => 0, "lain" => 0];
                            
                                foreach ($data['transaksi'] as $tgl) :?>
                                <tr>
                                    <td><center><?= ++$no?></center></td>
                                    <td><?= date("d-m-Y", strtotime($tgl['tgl_pembayaran']))?></td>
                                    <?php
                                        if($tgl['id_pembayaran'] > 0 && $tgl['id_pembayaran'] < 10){
                                            $tgl['id_pembayaran'] = '00000'.$tgl['id_pembayaran'];
                                        } else if($tgl['id_pembayaran'] >= 10 && $tgl['id_pembayaran'] < 100){
                                            $tgl['id_pembayaran'] = '0000'.$tgl['id_pembayaran'];
                                        } else if($tgl['id_pembayaran'] >= 100 && $tgl['id_pembayaran'] < 1000){
                                            $tgl['id_pembayaran'] = '000'.$tgl['id_pembayaran'];
                                        } else if($tgl['id_pembayaran'] >= 1000 && $tgl['id_pembayaran'] < 10000){
                                            $tgl['id_pembayaran'] = '00'.$tgl['id_pembayaran'];
                                        } else if($tgl['id_pembayaran'] >= 10000 && $tgl['id_pembayaran'] < 100000){
                                            $tgl['id_pembayaran'] = '0'.$tgl['id_pembayaran'];
                                        } else {
                                            $tgl['id_pembayaran'] = $tgl['id_pembayaran'];
                                        };

                                        $bulan = date("m", strtotime($tgl['tgl_pembayaran']));
                                        $tahun = date("y", strtotime($tgl['tgl_pembayaran']));

                                        $id = $tahun.$bulan.$tgl['id_pembayaran'];
                                    ?>
                                    <td><?= $id?></td>
                                    <td><?= $tgl['nama_pembayaran']?></td>
                                    <td><?= $tgl['pengajar']?></td>
                                    <td><?= $tgl['nominal']?></td>
                                    <td><?= terbilang($tgl['nominal']) . " rupiah"?></td>
                                    <td><?= $tgl['uraian']?></td>
                                    <?php if ($tgl['keterangan'] == "Piutang") :?>
                                        <?php $subtotal['piutang'] += $tgl['nominal']?>
                                        <td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "MMQ 1 TL") :?>
                                        <?php $subtotal['tl'] += $tgl['nominal']?>
                                        <td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "MMQ 3 BA") :?>
                                        <?php $subtotal['ba'] += $tgl['nominal']?>
                                        <td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "Bulanan PK") :?>
                                        <?php $subtotal['pk'] += $tgl['nominal']?>
                                        <td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "Bulanan PL") :?>
                                        <?php $subtotal['pl'] += $tgl['nominal']?>
                                        <td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "Buku") :?>
                                        <?php $subtotal['buku'] += $tgl['nominal']?>
                                        <td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "MMQ 1 PT3") :?>
                                        <?php $subtotal['pt3'] += $tgl['nominal']?>
                                        <td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "MMQ 1 T1") :?>
                                        <?php $subtotal['t1'] += $tgl['nominal']?>
                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "MMQ 1 T2") :?>
                                        <?php $subtotal['t2'] += $tgl['nominal']?>
                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "MMQ 1 T3") :?>
                                        <?php $subtotal['t3'] += $tgl['nominal']?>
                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "MMQ 1 T4") :?>
                                        <?php $subtotal['t4'] += $tgl['nominal']?>
                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "Deposit") :?>
                                        <?php $subtotal['deposit'] += $tgl['nominal']?>
                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "Pendaftaran Reguler") :?>
                                        <?php $subtotal['daftar_reg'] += $tgl['nominal']?>
                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "Pendaftaran PK") :?>
                                        <?php $subtotal['daftar_pk'] += $tgl['nominal']?>
                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "Pendaftaran PL") :?>
                                        <?php $subtotal['daftar_pl'] += $tgl['nominal']?>
                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "MMQ 2 TA") :?>
                                        <?php $subtotal['ta'] += $tgl['nominal']?>
                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "MMQ 2 TD") :?>
                                        <?php $subtotal['td'] += $tgl['nominal']?>
                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td>
                                    <?php elseif ($tgl['keterangan'] == "Lainnya") :?>
                                        <?php $subtotal['lain'] += $tgl['nominal']?>
                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td>
                                    <?php endif;?>  
                                </tr>
                            <?php endforeach;?>
                            <tr style="background-color: yellow">
                                <td colspan=8><center>Subtotal</center></td>
                                <td>
                                    <?php 
                                        $total['piutang'] += $subtotal['piutang'];
                                        echo $subtotal['piutang'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['tl'] += $subtotal['tl'];
                                        echo $subtotal['tl'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['ba'] += $subtotal['ba'];
                                        echo $subtotal['ba'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['pk'] += $subtotal['pk'];
                                        echo $subtotal['pk'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['pl'] += $subtotal['pl'];
                                        echo $subtotal['pl'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['buku'] += $subtotal['buku'];
                                        echo $subtotal['buku'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['pt3'] += $subtotal['pt3'];
                                        echo $subtotal['pt3'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['t1'] += $subtotal['t1'];
                                        echo $subtotal['t1'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['t2'] += $subtotal['t2'];
                                        echo $subtotal['t2'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['t3'] += $subtotal['t3'];
                                        echo $subtotal['t3'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['t4'] += $subtotal['t4'];
                                        echo $subtotal['t4'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['deposit'] += $subtotal['deposit'];
                                        echo $subtotal['deposit'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['daftar_reg'] += $subtotal['daftar_reg'];
                                        echo $subtotal['daftar_reg'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['daftar_pk'] += $subtotal['daftar_pk'];
                                        echo $subtotal['daftar_pk'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['daftar_pl'] += $subtotal['daftar_pl'];
                                        echo $subtotal['daftar_pl'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['ta'] += $subtotal['ta'];
                                        echo $subtotal['ta'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['td'] += $subtotal['td'];
                                        echo $subtotal['td'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $total['lain'] += $subtotal['lain'];
                                        echo $subtotal['lain'];
                                    ?>
                                </td>
                                <td><b><?php 
                                    $sub = $subtotal['piutang']+$subtotal['tl']+$subtotal['ba']+$subtotal['pk']+$subtotal['pl']+$subtotal['buku']+$subtotal['pt3']+$subtotal['t1']+$subtotal['t2']+$subtotal['t3']+$subtotal['t4']+$subtotal['deposit']+$subtotal['daftar_reg']+$subtotal['daftar_pk']+$subtotal['daftar_pl']+$subtotal['ta']+$subtotal['td']+$subtotal['lain'];

                                    $total['total'] += $sub;
                                    
                                    echo $sub;
                                    ?></b>
                                </td>
                            </tr>
                        <?php endforeach;?>
                            <tr style="background-color: red">
                                <td colspan=8><center>Total</center></td>
                                <td>
                                    <?=$total['piutang']?>
                                </td>
                                <td>
                                    <?=$total['tl']?>
                                </td>
                                <td>
                                    <?=$total['ba']?>
                                </td>
                                <td>
                                    <?=$total['pk']?>
                                </td>
                                <td>
                                    <?=$total['pl']?>
                                </td>
                                <td>
                                    <?=$total['buku']?>
                                </td>
                                <td>
                                    <?=$total['pt3']?>
                                </td>
                                <td>
                                    <?=$total['t1']?>
                                </td>
                                <td>
                                    <?=$total['t2']?>
                                </td>
                                <td>
                                    <?=$total['t3']?>
                                </td>
                                <td>
                                    <?=$total['t4']?>
                                </td>
                                <td>
                                    <?=$total['deposit']?>
                                </td>
                                <td>
                                    <?=$total['daftar_reg']?>
                                </td>
                                <td>
                                    <?=$total['daftar_pk']?>
                                </td>
                                <td>
                                    <?=$total['daftar_pl']?>
                                </td>
                                <td>
                                    <?=$total['ta']?>
                                </td>
                                <td>
                                    <?=$total['td']?>
                                </td>
                                <td>
                                    <?=$total['lain'];
                                    ?>
                                </td>
                                <td><b><?= $total['total']?></b>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>