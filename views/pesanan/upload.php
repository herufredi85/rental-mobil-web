<?php
$tglstart="01".date('-m-Y');
$tglend=date('d-m-Y');
?>
<form  method="POST" name="formupload<?=$id?>" id="formupload<?=$id?>" action="<?= base_url('pesanan/uploadfile/'.$id."/".$tglstart.'/'.$tglend) ?>" enctype="multipart/form-data">
<div class="row">
    <div class="col-sm-6">
    <input type="file" placeholder="file gambar" accept="image/png, image/gif, image/jpeg" class="form-control" id="filelampiran<?=$id?>" name="filelampiran<?=$id?>">
	file gambar
    </div>
    <div class="col-sm-6">
    <input type="submit" class="btn btn-primary" value="Upload">
    </div>
</div>

</form>
<br>
<table class="table table-border" width="100%">
	                  				<thead>
									  <tr>
                                            <th>No.</th>
											<th>Nama File</th>
	                    					<th>Aksi</th>
	                    					
	                    				</tr>
	                 				</thead>
	                  		
	                 				<tbody>
                                     <?php 
									 $tot=0;
                                    $no=1;
									 while($pesanan = $listfile->fetch_object()) :
										//$tot= $tot+$pesanan->harga;
										?>
										<tr>
											<td><?= $no++ ?></td>
												<td><a href="<?=BASE_URL?>files/<?= $pesanan->namafile ?>" target="_blank"><?= $pesanan->namafile ?></a></td>
												<td style="text-align: end;"><a href="<?= base_url('pesanan/hapusfile/' . $pesanan->id . '/' . $tglstart . '/' . $tglend) ?>" onclick="return confirm('apakah anda yakin?')"> <i class="fa fa-trash"></i> hapus </a></td>
												
										</tr>
										<?php endwhile; ?>
                                      
										
                                    
	                 				</tbody>
              					</table>