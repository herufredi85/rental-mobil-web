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
								<h6 class="m-0 font-weight-bold text-primary">Ubah Data</h6>
							</div>
							<div class="card-body">
                            <?php while($akun = $data_akun->fetch_object()) :
                                $logo=$akun->logo;
                                $nama_perusahaan=$akun->nama_perusahaan;
                                 ?>
								<form method="POST" action="<?= base_url('perusahaan/tambah') ?>" enctype="multipart/form-data">
								  	<div class="form-group">
								  		<label id="lblnama" for="nama">Nama Perusahaan</label>
								  		<input type="text" value="<?=$akun->nama_perusahaan?>" name="nama_perusahaan" id="nama_perusahaan" required="required" placeholder="ketik" autocomplete="off" class="form-control">
								  	</div>
								  	<div class="form-group">
								  		<label for="username">Alamat</label>
								  		<input type="text" value="<?=$akun->alamat?>" name="alamat" id="alamat" required="required" placeholder="ketik" autocomplete="off" class="form-control">
								  	</div>
								  	<div class="form-group">
								  		<label for="password">Telp</label>
								  		<input type="text" value="<?=$akun->telp?>" name="telp" id="telp" required="required" placeholder="ketik" autocomplete="off" class="form-control">
								  	</div>
								  	<div class="form-group">
								  		<label for="password2">Email</label>
								  		<input type="text" value="<?=$akun->email?>" name="email" id="email" required="required" placeholder="ketik" autocomplete="off" class="form-control">
								  	</div>
									  <div class="form-group">
								  		<label for="password2">Pemilik</label>
								  		<input type="text" value="<?=$akun->owner?>" name="owner" id="owner" required="required" placeholder="ketik" autocomplete="off" class="form-control">
								  	</div>
									  <div class="form-group">
								  		<label for="password2">Kota</label>
								  		<input type="text" value="<?=$akun->city?>" name="kota" id="kota" required="required" placeholder="ketik" autocomplete="off" class="form-control">
								  	</div>
									  <div class="form-group">
								  		<label for="password2">No. Rekening</label>
								  		<textarea class="form-control" id="account" name="account" rows="3" wrap="soft"><?=$akun->account?></textarea>
								  	</div>
								  	<div class="form-group">
								  		<label for="foto">Logo</label>
								  		<input type="file" name="foto" id="foto"  placeholder="ketik" autocomplete="off" class="form-control-file">
								  		ukuran foto wajib 200px X 200px
								  	</div>
								  	<div class="form-group">
										<button type="submit" class="btn btn-sm btn-success" name="tambah"><i class="fa fa-plus"></i> Tambah</button>
										<button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batal</button>
								  	</div>
								</form>
                                <?php endwhile; ?>
							</div>
						</div>
					</div>

					<div class="col-sm-8">
						<div class="card shadow">
							<div class="card-header">
								<h6 class="m-0 font-weight-bold text-primary">Logo</h6>
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
                                <img src="<?= base_url('uploads/perusahaan/' . $logo) ?>" alt="<?= $nama_perusahaan ?>" class="img-thumbnail mb-4">
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
</body>

</html>
