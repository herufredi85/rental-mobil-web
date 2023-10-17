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
								<form method="POST" action="<?= base_url('uangkeluar/proses_ubah/'.$duk->id.'/'.$tglstart.'/'.$tglend) ?>">
								  	<div class="form-group">
										<label for="asal">Jenis Uang Keluar</label>
										<select name="typeuk" id="typeuk" class="form-control" required="required">
                                            <option value="">-PILIH-</option>
								  			<?php while($pemesan = $data_ttuk->fetch_object()) : ?>
												<option value="<?= $pemesan->idtuk ?>" <?php if($pemesan->idtuk==$duk->typeuk){ echo "selected";} ?> ><?= $pemesan->nametuk ?></option>
								  			<?php endwhile; ?>
								  		</select>
								  	</div>
								  	<div class="form-group">
										<label for="tujuan">Deskripsi</label>
										<input type="text" class="form-control" value="<?=$duk->ketuk?>" name="ketuk" id="ketuk" autocomplete="off" required="required" placeholder="ketik">
								  	</div>
								  	<div class="form-group">
										<label for="jarak">Nominal Pengeluaran</label>
										<input type="text" class="form-control" value="<?=number_format($duk->rpuk,0,',','.')?>" name="rpuk" id="rpuk" maxlength="15" onkeyup="FormatCurrency(this)" style="text-align: right;"  autocomplete="off" required="required" placeholder="0">
								  	</div>
                                      <div class="form-group">
										<label for="tujuan">Tanggal Uang Keluar</label>
										<input type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true" value="<?= date('d-m-Y',strtotime($duk->tgluk))?>" name="tgluk" id="tgluk" required="required" autocomplete="off" class="form-control">
								  	</div>
								  	<div class="form-group">
										<button type="submit" class="btn btn-sm btn-success" name="ubah"><i class="fa fa-plus"></i> Ubah</button>
										<button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batal</button>
								  	</div>
								</form>
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
