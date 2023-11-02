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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
	<script src="<?= base_url('sb-admin-2/') ?>/vendor/jquery/jquery.min.js"></script>
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
									<h6 class="m-0 font-weight-bold text-primary">Periode</h6>
								</div>
								<div class="card-body">
									<form method="POST" action="<?= base_url('rekap/tampil/') ?>">

										<div class="form-group">
											<label for="tujuan">Tanggal Awal</label>
											<input type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true" value="<?= date('d-m-Y', strtotime($tglstart)) ?>" name="tglstart" id="tglstart" required="required" autocomplete="off" class="form-control">
										</div>
										<div class="form-group">
											<label for="tujuan">Tanggal Akhir</label>
											<input type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true" value="<?= date('d-m-Y', strtotime($tglend)) ?>" name="tglend" id="tglend" required="required" autocomplete="off" class="form-control">
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-sm btn-info" name="tampil"><i class="fa fa-info"></i> Tampil</button>
											<a href="#" target="_blank" onclick="xls()" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Excel</a>

										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="col-sm-8">
							<div class="card shadow">
								<div class="card-header">
									<h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>

								</div>
								<div class="card-body">
									<?php if (checkSession('success')) : ?>
										<div class="alert alert-success alert-dismissible fade show" role="alert">
											<?= getSession('success', true) ?>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
									<?php elseif (checkSession('error')) : ?>
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											<?= getSession('error', true) ?>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
									<?php endif ?>
									<div class="table-responsive">
									<table class="table table-bordered"  cellspacing="0">
										<thead
											<tr>
												<th align="center">No</th>
												<th align="center">Tanggal</th>
												<th align="center">Uang Masuk</th>
												<th align="center">Uang Keluar</th>

											</tr>
										</thead>

										<tbody>
											<?php
											$tot = 0;
											//print_r($data_perjalanan->fetch_object());
											$data = [];
											while ($pesanan = $data_perjalanan->fetch_object()) :
												//$tot= $tot+$pesanan->rpuk;
												$date = $pesanan->tgl;
												$amount = $pesanan->nominal;
												$trans = $pesanan->trans;
												$key = array_search($date, array_column($data, 0));
												if ($key !== false) {
													// Jika tanggal sudah ada dalam $data, tambahkan jumlah ke dalam elemen yang sudah ada
													$data[$key][2] .= $amount . "|" . $trans;
												} else {
													// Jika tanggal belum ada dalam $data, tambahkan elemen baru
													$data[] = [$date, $amount . "|" . $trans, 0];
												}

											?>
											<?php endwhile; ?>
											<?php


											$data = array_values($data); // Perbarui indeks array jika ada elemen yang dihapus
											$totum = 0;
											$totuk = 0;
											// print_r($data);
											foreach ($data as $dt) {
												$d1 = explode('|', $dt[1]);
												$d2 = explode('|', $dt[2]);
											?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= date('d-m-Y', strtotime($dt[0])) ?></td>
													<?php
													if ($d1[1] == 'UK') {
														$totum = $totum + (int)$d2[0];
														$totuk = $totuk + (int)$d1[0];
													?>
														<td align="right"><?= number_format($d2[0], 0, ',', '.') ?></td>
														<td align="right"><?= number_format($d1[0], 0, ',', '.') ?></td>
													<?php
													} else {
														$totum = $totum + (int)$d1[0];
														$totuk = $totuk + 0;
													?>
														<td align="right"><?= number_format($d1[0], 0, ',', '.') ?></td>
														<td align="right"><?= number_format(0, 0, ',', '.') ?></td>
													<?php
													}
													?>

												</tr>
											<?php
											}
											?>

											<td align="center" colspan="2">TOTAL</td>
											<td align="right">
												<h3><?= number_format($totum, 0, ',', '.') ?></h3>
											</td>
											<td align="right">
												<h3><?= number_format($totuk, 0, ',', '.') ?></h3>
											</td>
										</tbody>
									</table>
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

	
	<script src="<?= base_url('sb-admin-2/') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url('sb-admin-2/') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="<?= base_url('sb-admin-2/') ?>/js/sb-admin-2.min.js"></script>

	<script src="<?= base_url('sb-admin-2/') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin-2/') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url('sb-admin-2/') ?>/js/demo/datatables-demo.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script>
		function xls() {
			var tglstart = $('#tglstart').val();
			var tglend = $('#tglend').val();
			var v_thn = $('#v_thn').val();
			window.open("<?= base_url('rekap/xls') ?>/"+tglstart+"/"+tglend);
			return false;
		}
	</script>
</body>

</html>