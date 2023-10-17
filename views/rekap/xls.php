<?php
	header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	header("Content-Disposition: attachment; filename=rekap_".$tglstart."_".$tglend.".xls");  //File name extension was wrong
	header("Expires: 0");
?>
<style type="text/css">
*{
font-family: Arial;
margin:0px;
padding:0px;
}
@page {
 margin-left:3cm 2cm 2cm 2cm;
}
table.grid{

font-size: 12px;
border-collapse:collapse;
}
table.grid th{
	padding:5px;
	margin:5px;
	padding:5px;
}
table.grid tr th{
background: #F0F0F0;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
text-align:center;
border:1px solid #000;
margin:5px;
padding:5px;
}
table.grid tr td{
	padding:3px;
	border-bottom:0.2mm solid #000;
	border:1px solid #000;
	margin:5px;
	padding:5px;
}
h1{
font-size: 18px;
}
h2{
font-size: 14px;
}
h3{
font-size: 12px;
}
p {
font-size: 10px;
}
center {
	padding:8px;
}
.atas{
display: block;

margin:5px;
padding:5px;
}
.kanan tr td{
	font-size:12px;
}
.attr{
font-size:9pt;
width: 100%;
padding-top:2pt;
padding-bottom:2pt;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
}
.pagebreak {
width:20.99cm ;
page-break-after: always;
margin-bottom:10px;
}
.akhir {
width:20.99cm ;
font-size:13px;
}
.page {
width:20.99cm ;
font-size:12px;
padding:10px;
}
table.footer{
width:20.99cm ;
font-size: 12px;
border-collapse:collapse;
}
</style>
<?
//print_r($dstok);
?>
<script>
function pr(){
	window.print();
	window.close();
}
</script>
<body style="padding:10px; margin:10px">
<div class="atas">
<div style="font-size: 10px;">

<table  style="border:1px solid #FFF !important; font-size: 16px;" width='100%'>

     <tr>
        <td align="center" colspan="4"><b>Rekap Transaksi <?=$perusahaan->nama_perusahaan?></b></td>
       
        
    </tr>
     <tr>
        <td align="center" colspan="4">Periode : <?=$tglstart?> s/d <?=$tglend?></td>

    </tr>
</table>

</div>
<br />
</div>
<table class="grid" width="100%">
	                  				<thead>
	                    				<tr>
	                    					<th align="center">No</th>
	                    					<th align="center">Tanggal</th>
	                    					<th align="center">Uang Masuk</th>
	                    					<th align="center">Uang Keluar</th>
                                       
	                    				</tr>
	                 				</thead>
	                  		
	                 				<tbody>
                                     <?php 
									 $tot=0;
                                     //print_r($data_perjalanan->fetch_object());
                                     $data = [];
									 while($pesanan = $data_perjalanan->fetch_object()) :
										//$tot= $tot+$pesanan->rpuk;
                                        $date = $pesanan->tgl;
                                        $amount = $pesanan->nominal;
                                        $trans=$pesanan->trans;
                                        $key = array_search($date, array_column($data, 0));
                                        if ($key !== false) {
                                            // Jika tanggal sudah ada dalam $data, tambahkan jumlah ke dalam elemen yang sudah ada
                                            $data[$key][2] .= $amount."|".$trans;
                                        } else {
                                            // Jika tanggal belum ada dalam $data, tambahkan elemen baru
                                            $data[] = [$date, $amount."|".$trans, 0];
                                        }

										?>
                                        <?php endwhile; ?>
                                        <?php
                                 
                                        
                                        $data = array_values($data); // Perbarui indeks array jika ada elemen yang dihapus
                                        $totum=0;
                                        $totuk=0;
                                       // print_r($data);
                                        foreach($data as $dt){
                                            $d1=explode('|',$dt[1]);
                                            $d2=explode('|',$dt[2]);
                                       ?>
                                        <tr>
												<td><?= $no++ ?></td>
												<td><?=date('d-m-Y',strtotime($dt[0]))?></td>
                                                <?php 
                                                if($d1[1]=='UK'){
                                                    $totum=$totum+(int)$d2[0];
                                                    $totuk=$totuk+(int)$d1[0];
                                                ?>
												<td align="right"><?=$d2[0]?></td>
                                                <td align="right"><?=$d1[0]?></td>
                                                <?php
                                                }else{
                                                    $totum=$totum+(int)$d1[0];
                                                    $totuk=$totuk+0;
                                                    ?>
                                                    <td align="right"><?=$d1[0]?></td>
                                                    <td align="right"><?=0?></td>
                                                    <?php
                                                }
                                                ?>
                                               
											</tr>
                                       <?php     
                                        }
                                        ?>
											
									<td align="center" colspan="2">TOTAL</td>
                                    <td align="right"><h3><?=$totum?></h3></td>
                                    <td align="right"><h3><?=$totuk?></h3></td>
	                 				</tbody>
              					</table>
</body>