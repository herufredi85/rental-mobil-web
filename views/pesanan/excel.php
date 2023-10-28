<?php
	header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	header("Content-Disposition: attachment; filename=datapesanan".$tglstart."_".$tglend.".xls");  //File name extension was wrong
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
        <td align="center" colspan="8"><b>Daftar Pesanan <?=$perusahaan->nama_perusahaan?></b></td>
       
        
    </tr>
     <tr>
        <td align="center" colspan="8">Periode : <?=$tglstart?> s/d <?=$tglend?></td>

    </tr>
</table>

</div>
<br />
</div>
<table class="grid" width="100%">
	                  				<thead>
									  <tr>
	                    					<th>No</th>
											<th>Kode Booking</th>
	                    					<th>Pemesan</th>
	                    					<th>Mobil</th>
	                    					<th>Jenis Layanan</th>
											<th>Tgl Pinjam<br>Tgl Kembali</th>
											<th>Harga</th>
											<th>Status</th>
	                    					
	                    				</tr>
	                 				</thead>
	                  		
	                 				<tbody>
                                     <?php 
									 $tot=0;
                                    $no=1;
									 while($pesanan = $data_pesanan->fetch_object()) :
										$tot= $tot+$pesanan->harga;
										?>
										<tr>
											<td><?= $no++ ?></td>
												<td><?= $pesanan->booking_code ?></td>
												<td><?= $pesanan->nama_pemesan ?></td>
												<td><?= $pesanan->nama_mobil ?></td>
												<td><?= $pesanan->jenis_bayar ?></td>
												<td><?=date('d-m-Y',strtotime($pesanan->tgl_pinjam))?><br>
												   <label <?php if($pesanan->ddif<0){echo 'style="color:red"';} ?> ><?=date('d-m-Y',strtotime($pesanan->tgl_kembali))?></label>
												</td>
												<td align="right"><?=$pesanan->harga?></td>
												<td><?= $pesanan->sts ?></td>
										</tr>
										<?php endwhile; ?>
                                      
										<tr>
										<td align="center" colspan="7">TOTAL</td>
                                   		 <td align="right"><h3><?=$tot?></h3></td>
										</tr>	
									
                                    
	                 				</tbody>
              					</table>
</body>