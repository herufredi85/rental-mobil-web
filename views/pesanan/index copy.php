<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?= APP_NAME ?> - <?= $judul ?></title>
	<link href="<?= base_url('sb-admin-2/') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href="<?= base_url('sb-admin-2/') ?>/css/sb-admin-2.min.css" rel="stylesheet">
	<link href="<?= base_url('sb-admin-2/') ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	<!-- Tambahkan Bootstrap Datepicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<!-- Tambahkan Bootstrap Datepicker JS -->

</head>

<body id="page-top">
	<div id="wrapper">
	<?php partial('navbar', $aktif) ?>
	<!-- Content Wrapper -->
	<div id="content-wrapper" class="d-flex flex-column">
		<div id="content">
		<?php partial('topbar') ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12">
						<div class="clearfix">
							<div class="float-left">
								<h1 class="h3 mb-4 text-gray-800"><?= $judul ?></h1>
							</div>
							<!-- <div class="float-right">
								<a href="" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
							</div> -->
						</div>
						<hr>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="card shadow">
							<div class="card-header">
								<h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
							</div>
							<div class="card-body">
								<form method="POST" action="<?= base_url('pesanan/tambah/'.$tglstart.'/'.$tglend) ?>" enctype="multipart/form-data">
								<div class="form-group">
								  		<label for="id_pemesan">Kode Booking</label>
										<input type="text"  name="kode_booking" id="kode_booking" class="form-control" value="<?=$cb?>">
								  
								  	</div>
								  	<div class="form-group">
								  		<label for="id_pemesan">Nama Pemesan</label>
										<!-- <input type="text"  name="id_pemesan" id="id_pemesan" class="form-control"> -->
								  		<select name="id_pemesan" id="id_pemesan" class="form-control">
										  <option value="">-PILIH-</option>
								  			<?php while($pemesan = $data_pemesan->fetch_object()) : ?>
												<option value="<?= $pemesan->id ?>|<?= $pemesan->nama ?>"><?= $pemesan->nama ?></option>
								  			<?php endwhile; ?>
								  		</select>
								  	</div>

								  	<div class="form-group">
								  		<label for="id_mobil">Mobil</label>
										  <input type="text"  name="id_mobil" id="id_mobil" class="form-control">
								  		<!-- <select name="id_mobil" id="id_mobil" class="form-control">
										  <option value="">-PILIH-</option>
								  			<?php while($mobil = $data_mobil->fetch_object()) : ?>
												<option value="<?= $mobil->id ?>"><?= $mobil->nama ?></option>
								  			<?php endwhile; ?>
								  		</select> -->
								  	</div>

									

								  	<div class="row">
										<!-- <input type="hidden" name="id_perjalanan" id="id_perjalanan" value='7'> -->
								  		<div class="col-md-6">
								  			<div class="form-group">
										  		<label for="id_jenis_bayar">Jenis Layanan</label>
										  		<select name="id_jenis_bayar" id="id_jenis_bayar" class="form-control">
												  <option value="">-PILIH-</option>
										  			<?php while($jenis_bayar = $data_jenis_bayar->fetch_object()) : ?>
														<option value="<?= $jenis_bayar->id ?>"><?= $jenis_bayar->jenis_bayar ?></option>
										  			<?php endwhile; ?>
										  		</select>
										  	</div>
								  		</div>
								  		<div class="col-md-6">
								  			<div class="form-group">
										  		<label for="harga">Harga</label>
										  		<input type="text" maxlength="15" onkeyup="FormatCurrency(this)" style="text-align: right;"  name="harga" id="harga" placeholder="ketik" required="required" autocomplete="off" class="form-control">
										  	</div>
								  		</div>
								  	</div>
									
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
										  		<label for="tgl_pinjam">Tanggal Pinjam</label>
										  		<input type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true" value="<?= date('d-m-Y')?>" name="tgl_pinjam" id="tgl_pinjam" required="required" autocomplete="off" class="form-control">
										  	</div>
									  	</div>
										<div class="col-md-6">
											<div class="form-group">
										  		<label for="tgl_kembali">Tanggal Kembali</label>
										  		<input type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true" value="<?= date('d-m-Y', strtotime(date('d-m-Y') . ' +1 day'))?>" name="tgl_kembali" id="tgl_kembali" required="required" autocomplete="off" class="form-control">
										  	</div>
									  	</div>
									</div>
									<div class="form-group">
								  		<label for="id_perjalanan">Status</label>
								  		<select name="id_perjalanan" id="id_perjalanan" class="form-control">
										  <option value="">-PILIH-</option>
								  			<?php while($perjalanan = $data_perjalanan->fetch_object()) : ?>
												<option value="<?= $perjalanan->id ?>"><?= $perjalanan->asal ?></option>
								  			<?php endwhile; ?>
								  		</select>
								  	</div>
								  	<div class="form-group">
										<button type="submit" class="btn btn-sm btn-success" name="tambah"><i class="fa fa-plus"></i> Tambah</button>
										<button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batal</button>
								  	</div>
								</form>
							</div>
						</div>
					</div>
						
					<div class="col-sm-8">
						<div class="card shadow">
							<div class="card-header">
								<h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan</h6>
								<form method="POST" action="<?= base_url('pesanan/tampil') ?>">
								<table style="width: 80%;">
									<tr>
										<td><input type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true" value="<?=$tglstart?>" name="tglstart" id="tglstart" required="required" autocomplete="off" class="form-control"></td>
										<td>s/d</td>
										<td><input type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true" value="<?=$tglend?>" name="tglend" id="tglend" required="required" autocomplete="off" class="form-control"></td>
										<td><button class="btn btn-secondary " type="submit" name="tampil" value="tampil" >
														Tampil
													</button>
													<button class="btn btn-success " type="submit" name="tampil" value="excel" >
														excel
													</button>
										</td>
									</tr>
								</table>
								</form>
							</div>
							<div class="card-body">
								<?php if(checkSession('success')): ?>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
							  			<?= getSession('success', true) ?>
							  			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    			<span aria-hidden="true">&times;</span>
							  			</button>
									</div>
								<?php elseif(checkSession('error')): ?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
							  			<?= getSession('error', true) ?>
							  			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    			<span aria-hidden="true">&times;</span>
							  			</button>
									</div>
								<?php endif ?>
								<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="" cellspacing="0" style="font-size: 12px;">
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
	                    					<th>Aksi</th>
	                    				</tr>
	                 				</thead>
	                  				<tfoot>
	                    				<tr>
	                    					<th>No</th>
											<th>Kode Booking</th>
	                    					<th>Pemesan</th>
	                    					<th>Mobil</th>
	                    					<th>Jenis Layanan</th>
											<th>Tgl Pinjam<br>Tgl Kembali</th>
											<th>Harga</th>
											<th>Status</th>
	                    					<th>Aksi</th>
	                    				</tr>
	                  				</tfoot>
	                 				<tbody>
										<?php 
										$tot=0;
										//print_r($data_pesanan);
										while($pesanan = $data_pesanan->fetch_object()) :
											$tot=$tot+$pesanan->harga;
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
												<td align="right"><?=number_format($pesanan->harga,0,',','.')?></td>
												<td><?= $pesanan->sts ?></td>
												<td>
												<div class="dropdown">
													<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														Aksi
													</button>
													<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a href="<?= base_url('pesanan/ubah/' . $pesanan->id.'/'.$tglstart.'/'.$tglend) ?>" class="btn btn-sm btn-info mb-2"><i class="fa fa-pen"></i> Ubah</a><br>
													<a href="<?= base_url('pesanan/detail/' . $pesanan->id.'/'.$tglstart.'/'.$tglend) ?>" class="btn btn-sm btn-warning mb-2"><i class="fa fa-eye"></i> Detail</a><br>
	                 								<a href="<?= base_url('pesanan/hapus/' . $pesanan->id.'/'.$tglstart.'/'.$tglend) ?>" class="btn btn-sm btn-danger mb-2" onclick="return confirm('apakah anda yakin?')"><i class="fa fa-trash"></i> Hapus</a><br>
													<a href="<?= base_url('pesanan/invoice/' . $pesanan->id) ?>" target="_blank" class="btn btn-sm btn-primary mb-2"><i class="fa fa-info"></i> Invoice</a>
													</div>
													</div>
													
												</td>
											</tr>
										<?php endwhile; ?>
									</tbody>
              					</table>
								</div>
								  <div>
									<hr>
									<div style="text-align: right;"><h3>Total : Rp <?=number_format($tot,0,',','.')?> </h3></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php partial('footer') ?>
	</div>
	</div>

	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<script src="<?= base_url('sb-admin-2/') ?>/vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url('sb-admin-2/') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url('sb-admin-2/') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="<?= base_url('sb-admin-2/') ?>/js/sb-admin-2.min.js"></script>

	<script src="<?= base_url('sb-admin-2/') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
  	<script src="<?= base_url('sb-admin-2/') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url('sb-admin-2/') ?>/js/demo/datatables-demo.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>

</html>

