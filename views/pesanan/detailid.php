<table class="table table-border" width="100%">
	                  				<thead>
									  <tr>
	                    					<th>No</th>
											<th>Deskripsi</th>
	                    					<th>Qty</th>
	                    					<th>Harga</th>			
	                    				</tr>
	                 				</thead>
	                  		
	                 				<tbody>
                                     <?php 
									 $tot=0;
                                    $no=1;
									 while($pesanan = $detailid->fetch_object()) :
										//$tot= $tot+$pesanan->harga;
										?>
										<tr>
											<td><?= $no++ ?></td>
												<td><?= $pesanan->deskripsi ?></td>
												<td><?= $pesanan->qty ?></td>
												<td style="text-align: end;"><?=number_format($pesanan->price, 0, ',', '.') ?></td>
												
										</tr>
										<?php endwhile; ?>
                                      
										
                                    
	                 				</tbody>
              					</table>