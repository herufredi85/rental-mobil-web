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
	<script src="<?= base_url('sb-admin-2/') ?>/vendor/jquery/jquery.min.js"></script>

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
								<div class="float-right">
								<a href="<?= BASE_URL.'pesanan/invoicekosong/'?>" target="_blank" class="btn btn-sm btn-secondary"><i class="fa fa-info"></i> Invoice Kosong</a>
									<a href="<?= BASE_URL . "pesanan/add/" . $tglstart . "/" . $tglend ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
								</div>
							</div>
							<hr>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">

						</div>
					</div>
					<div class="row">


						<div class="col-sm-12">
							<div class="card shadow">
								<div class="card-header">
									<h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan</h6>
									<form method="POST" action="<?= base_url('pesanan/tampil') ?>">
										<table style="width: 80%;">
											<tr>
												<td><input type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true" value="<?= $tglstart ?>" name="tglstart" id="tglstart" required="required" autocomplete="off" class="form-control"></td>
												<td>s/d</td>
												<td><input type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true" value="<?= $tglend ?>" name="tglend" id="tglend" required="required" autocomplete="off" class="form-control"></td>
												<td><button class="btn btn-secondary btn-sm " type="submit" name="tampil" value="tampil">
														Tampil
													</button>
													<!-- <button class="btn btn-success " type="submit" name="tampil" value="excel">
														excel
													</button> -->
													<a href="#" target="_blank" onclick="xls()" class="btn btn-sm btn-success"><i class="fa fa-times"></i> Excel</a>
												</td>
											</tr>
										</table>
									</form>
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
										<table class="table table-bordered" id="dataTable" width="" cellspacing="0" style="font-size: 12px;">
											<thead>
												<tr>
													<th>No</th>
													<th>No.Invoice</th>
													<th>Kode Booking</th>
													<th>Pemesan</th>
													<th>Deskripsi</th>
													<th>Jenis Layanan</th>
													<th>Tgl Pinjam<br>Tgl Kembali</th>
													<th>Harga</th>
													<th>Uang Muka</th>
													<th>Sisa <br>Pembayaran</th>
													<th>Status</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>No</th>
													<th>No.Invoice</th>
													<th>Kode Booking</th>
													<th>Pemesan</th>
													<th>Deskripsi</th>
													<th>Jenis Layanan</th>
													<th>Tgl Pinjam<br>Tgl Kembali</th>
													<th>Harga</th>
													<th>Uang Muka</th>
													<th>Sisa <br>Pembayaran</th>
													<th>Status</th>
													<th>Aksi</th>
												</tr>
											</tfoot>
											<tbody>
												<?php
												$tot = 0;
												//print_r($data_pesanan);
												while ($pesanan = $data_pesanan->fetch_object()) :
													$tot = $tot + $pesanan->harga;
												?>
													<tr>
														<td><?= $no++ ?></td>
														<td><?= $pesanan->no_invoice ?></td>
														<td><?= $pesanan->booking_code ?></td>
														<td><?= $pesanan->nama_pemesan ?></td>
														<td><a href="#"  onclick="openmodal(<?= $pesanan->id?>,'<?= $pesanan->booking_code ?>')">
																detail
															</a></td>
														<td><?= $pesanan->jenis_bayar ?></td>
														<td><?= date('d-m-Y', strtotime($pesanan->tgl_pinjam)) ?><br>
															<label <?php if ($pesanan->ddif < 0) {
																		echo 'style="color:red"';
																	} ?>><?= date('d-m-Y', strtotime($pesanan->tgl_kembali)) ?></label>
														</td>
														<td align="right"><b><?= number_format($pesanan->harga, 0, ',', '.') ?></b></td>
														<td align="right"><?= number_format($pesanan->uang_muka, 0, ',', '.') ?></td>
														<td align="right"><?= number_format($pesanan->harga-$pesanan->uang_muka, 0, ',', '.') ?></td>
														<td><?= $pesanan->sts ?></td>
														<td>
															<div class="dropdown">
																<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	Aksi
																</button>
																<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
																	<p><a href="<?= base_url('pesanan/ubah/' . $pesanan->id . '/' . $tglstart . '/' . $tglend) ?>" class="btn btn-sm btn-info mb-2"><i class="fa fa-pen"></i> Ubah</a></p>
																	<p><a href="<?= base_url('pesanan/detail/' . $pesanan->id . '/' . $tglstart . '/' . $tglend) ?>" class="btn btn-sm btn-warning mb-2"><i class="fa fa-eye"></i> Detail</a></p>
																	<p><a href="<?= base_url('pesanan/hapus/' . $pesanan->id . '/' . $tglstart . '/' . $tglend) ?>" class="btn btn-sm btn-danger mb-2" onclick="return confirm('apakah anda yakin?')"><i class="fa fa-trash"></i> Hapus</a></p>
																	<p><a href="<?= base_url('pesanan/invoice/' . $pesanan->id) ?>" target="_blank" class="btn btn-sm btn-primary mb-2"><i class="fa fa-info"></i> Invoice</a></p>
																	<p><a href="#" onclick="copytext(<?=$pesanan->id?>,'<?=$pesanan->booking_code?>')" class="btn btn-sm btn-success mb-2"><i class="fa fa-envelope"></i> Copy WA</a></p>
																	<p><a href="#" onclick="upload(<?=$pesanan->id?>,'<?=$pesanan->booking_code?>')" class="btn btn-sm btn-secondary mb-2"><i class="fa fa-file"></i> Upload File</a></p>
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
										<div style="text-align: right;">
											<h3>Total : Rp <?= number_format($tot, 0, ',', '.') ?> </h3>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- modal-->


			<div class="modal" tabindex="-1" id="modallg" role="dialog">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"><label id="title"></label></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">

							<div id="contentmodal"></div>
						</div>

					</div>
				</div>
			</div>
			<!-- MODAL-->

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
</body>

</html>
<script>
	function openmodal(id, title) {
		$('#modallg').modal('show');
		$('#title').html(title);
		$('#contentmodal').load('<?=BASE_URL.'pesanan/detailid/'?>'+id);
	}
	function copytext(id,title) {
		$('#modallg').modal('show');
		$('#title').html("Copy WA "+title);
		$('#contentmodal').load('<?=BASE_URL.'pesanan/copytext/'?>'+id);
	}
	function upload(id,title) {
		$('#modallg').modal('show');
		$('#title').html("Upload File "+title);
		$('#contentmodal').load('<?=BASE_URL.'pesanan/upload/'?>'+id);
	}
	function myFunction(id) {
  // Get the text field
  var copyText = document.getElementById("myInput"+id);

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);

  // Alert the copied text
  alert("Copied the text: ");

}
	function xls() {
			var tglstart = $('#tglstart').val();
			var tglend = $('#tglend').val();
			var v_thn = $('#v_thn').val();
			window.open("<?= base_url('pesanan/xls') ?>/"+tglstart+"/"+tglend);
			return false;
		}
</script>