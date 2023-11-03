<?php
$copy="";
while ($pesanan = $detailid->fetch_object()) :
    $id=$pesanan->id;
    $copy=$copy."Invoice           : ".$pesanan->no_invoice."\n"; 
    $copy=$copy."Tanggal Pesan     : ".date('d-m-Y')."\n"; 
    $copy=$copy."Tanggal Pemakaian : ".date('d-m-Y',strtotime($pesanan->tgl_pinjam))." s/d ".date('d-m-Y',strtotime($pesanan->tgl_kembali))."\n"; 
    $copy=$copy."Nama Pemesan      : ".$pesanan->id_pemesan."\n"; 
    $copy=$copy."Harga             : Rp.".number_format($pesanan->harga, 0, ',', '.')."\n"; 
    $copy=$copy."Deskripsi \n";
    while ($detid = $det->fetch_object()) :
    $copy=$copy.$detid->deskripsi." ".$detid->qty." Rp.".number_format($detid->price/$detid->qty, 0, ',', '.')." = Rp.".number_format($detid->price, 0, ',', '.')."\n"; 
    endwhile;
endwhile;
  ?>
<textarea class="form-control" id="myInput<?=$id?>" rows="10"><?=$copy?></textarea>
<br>
<button onclick="myFunction(<?=$id?>)" class="btn btn-success">Copy text</button>