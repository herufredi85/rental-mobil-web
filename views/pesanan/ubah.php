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
									<h1 class="h3 mb-4 text-gray-800">Ubah Pesanan</h1>
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
						<div class="col-sm-12">
							<div class="card shadow">
								<div class="card-header">
									<h6 class="m-0 font-weight-bold text-primary">Ubah Data</h6>
								</div>
								<div class="card-body">
									<form method="POST" action="<?= base_url('pesanan/proses_ubah/' . $pesanan->id . '/' . $tglstart . '/' . $tglend) ?>" enctype="multipart/form-data">
									<div class="form-group">
											<label for="id_pemesan">No. Invoice</label>
											<input type="text"  class="form-control" name="no_invoice" value="<?= $pesanan->no_invoice ?>">
										</div>
										<div class="form-group">
											<label for="id_pemesan">Kode Booking</label>
											<input type="text"  class="form-control" name="booking_code" value="<?= $pesanan->booking_code ?>">
										</div>
										
										<div class="form-group">
											<label for="id_pemesan">Nama Pemesan</label>
											<!-- <input type="text"  name="id_pemesan" id="id_pemesan" class="form-control"> -->
											<select name="id_pemesan" id="id_pemesan" class="form-control">
												<option value="">-PILIH-</option>
												<?php while ($pemesan = $data_pemesan->fetch_object()) : ?>
													<option value="<?= $pemesan->id ?>|<?= $pemesan->nama ?>" <?php if ($pemesan->nama == $pesanan->id_pemesan) {
																													echo "selected";
																												} ?>><?= $pemesan->nama ?></option>
												<?php endwhile; ?>
											</select>
										</div>

										<!-- <div class="form-group">
								  		<label for="id_mobil">Mobil</label>
								  		<input type="text" disabled="disabled" class="form-control" value="<?= $pesanan->id_mobil ?>">
								  	</div> -->
										<div class="form-group">
											<label for="id_mobil">Deskripsi Pesanan</label>
											<div id="append">
												<!-- <input type="text"  name="id_mobil" id="id_mobil" class="form-control"> -->
												<?php
												$t=0;
												$no = 1;
												while ($pid = $detailid->fetch_object()) :
													$t=$t+$pid->price*$pid->qty;
												?>

													<br>
													<div class="row">
														<div class="col-md-4">
															<textarea class="form-control" placeholder="deskripsi" name="deskripsi[]"><?= $pid->deskripsi ?></textarea>
														</div>
														<div class="col-md-1">
															<input type="text" class="form-control qty" placeholder="qty" name="qty[]" value="<?= $pid->qty ?>">
														</div>
														<div class="col-md-2">
															<input type="text" class="form-control price" placeholder="harga" value="<?= $pid->price ?>" name="price1[]" oninput="calculateSubtotal(this)" style="text-align: right;">
														</div>
														<div class="col-md-2">
															<input type="text" value="<?= number_format($pid->price*$pid->qty , 0, ',', '.') ?>" class="form-control inputField" placeholder="harga" name="price[]" onkeyup="FormatCurrency(this)" style="text-align: right;">
														</div>
														<?php if ($no == 1) { ?>
															<div class="col-md-1">
																<button type="button" class="btn btn-primary add-field">+</button>
															</div>
														<?php } else {
														?>
															<div class="col-md-1">
																<button type="button" class="btn btn-secondary remove-field">-</button>
															</div>
														<?php
														}
														?>
													</div>

												<?php
													$no++;
												endwhile; ?>
											</div>
											<div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <input type="text" class="form-control totalharga" name="totalharga" value="<?= number_format($t , 0, ',', '.') ?>" placeholder="Total Harga" style="text-align: right;" readonly>
                    </div>
                    <div class="col-md-1"></div>
                </div>
										</div>

										<!-- <div class="form-group">
								  		<label for="id_perjalanan">Perjalanan</label>
								  		<input type="text" disabled="disabled" class="form-control" value="<?= $perjalanan->asal . ' - ' . $perjalanan->tujuan ?>">
								  	</div> -->

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="id_jenis_bayar">Jenis Layanan</label>
													<select name="id_jenis_bayar" id="id_jenis_bayar" class="form-control">
														<option value="">-PILIH-</option>
														<?php while ($jenis_bayar = $data_jenis_bayar->fetch_object()) : ?>
															<option value="<?= $jenis_bayar->id ?>" <?php if ($jenis_bayar->id == $pesanan->id_jenis_bayar) {
																										echo "selected";
																									} ?>><?= $jenis_bayar->jenis_bayar ?></option>
														<?php endwhile; ?>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="harga">Uang Muka</label>
													<input type="text" maxlength="15"  onkeyup="FormatCurrency(this)" style="text-align: right;" name="uang_muka" id="uang_muka" value="<?= number_format($pesanan->uang_muka, 0, ',', '.') ?>" placeholder="ketik" required="required" autocomplete="off" class="form-control">
													
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="tgl_pinjam">Tanggal Pinjam</label>
													<input type="text" value="<?= date('d-m-Y', strtotime($pesanan->tgl_pinjam)) ?>" disabled="disabled" name="tgl_pinjam" id="tgl_pinjam" required="required" autocomplete="off" class="form-control">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="tgl_kembali">Tanggal Kembali</label>
													<input type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true" name="tgl_kembali" value="<?= date('d-m-Y', strtotime($pesanan->tgl_kembali)) ?>" id="tgl_kembali" required="required" autocomplete="off" class="form-control">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="tgl_kembali">Status</label>
													<select name="id_perjalanan" id="id_perjalanan" class="form-control">

														<?php while ($perjalanan = $data_perjalanan->fetch_object()) : ?>
															<option value="<?= $perjalanan->id ?>" <?php if ($perjalanan->id == $id_perjalanan) {
																										echo "selected";
																									} ?>><?= $perjalanan->asal ?></option>
														<?php endwhile; ?>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-sm btn-success" name="ubah"><i class="fa fa-pen"></i> Ubah</button>
											<button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batal</button>
											<a href="<?= base_url('pesanan/indextgl/' . $tglstart . '/' . $tglend) ?>" class="btn btn-sm btn-secondary"><i class="fa fa-reply"></i> Kembali</a>
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


	<script src="<?= base_url('sb-admin-2/') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url('sb-admin-2/') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="<?= base_url('sb-admin-2/') ?>/js/sb-admin-2.min.js"></script>

	<script src="<?= base_url('sb-admin-2/') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin-2/') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url('sb-admin-2/') ?>/js/demo/datatables-demo.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script>
        $(document).ready(function() {
            $('.add-field').click(function() {
                var content="<br>";
                content=content+'<div class="row">';
                content=content+'<div class="col-md-4">';
                content=content+'<textarea class="form-control" placeholder="deskripsi" name="deskripsi[]"></textarea>';
                content=content+'</div>';
                content=content+'<div class="col-md-1">';
                content=content+'<input type="text" class="form-control qty" placeholder="qty" name="qty[]">';
                content=content+'</div>';
				content=content+'<div class="col-md-2">';
				content=content+'<input type="text" class="form-control price" placeholder="harga" name="price1[]" oninput="calculateSubtotal(this)" style="text-align: right;">';
				content=content+'</div>';
                content=content+'<div class="col-md-2">';
                content=content+'<input type="text" class="form-control inputField" placeholder="harga" name="price[]" oninput="calculateSubtotal(this)" style="text-align: right;"  > ';
                content=content+'</div>';
                content=content+'<div class="col-md-1">';
                content=content+'<button type="button" class="btn btn-secondary remove-field">-</button>';
                content=content+'</div>';
                content=content+'</div>';
                $('#append').append(content);
            });

            $('#append').on('click', '.remove-field', function() {
            $(this).closest('.row').remove();
			calculateTotalHarga();
        });

      
        });

        // $(document).on('input', '.inputField', function() {
        //     //alert('ss');
        //         calculateTotal();
        //     });
	
		document.addEventListener("input", function (e) {
            if (e.target.classList.contains("qty") || e.target.classList.contains("price")) {
                calculateSubtotal(e.target);
                calculateTotalHarga();
            }
        });

        function calculateSubtotal(input) {
            var row = input.closest('.row');
            var qty = parseFloat(row.querySelector('.qty').value) || 0;
            var price = parseFloat(row.querySelector('.price').value.replace(/[^0-9.]+/g, '')) || 0;
            var subtotal = qty * price;
            row.querySelector('[name="price[]"]').value = formatCurrency(subtotal);
        }

		function calculateTotalHarga() {
    var totalharga = 0;
    document.querySelectorAll('[name="price1[]"]').forEach(function (inputPrice, index) {
        var qty = parseFloat(document.querySelectorAll('[name="qty[]"]')[index].value) || 0;
        var price = parseFloat(inputPrice.value.replace(/[^0-9]+/g, '')) || 0;
        totalharga += qty * price;
    });
    document.querySelector('.totalharga').value = formatCurrency(totalharga);
}

        function formatCurrency(amount) {
           // return amount.toFixed(0).replace(/\d(?=(\d{3})+\.)/g, '$&,');
			return new Intl.NumberFormat('id-ID').format(amount);
        }
		
        function calculateTotal() {

			
            var total = 0;
                $('.inputField').each(function() {
                    var value = $(this).val().replace(/\./g, ''); // Menghapus titik
                    value = parseFloat(value) || 0; // Mengubah ke angka

                    total += value;
                });

                // Menampilkan total dalam format dengan ribuan
               // $('#total').text(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                $('#harga').val(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                $('#harga2').val(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                // Menyimpan nilai total dalam format numerik untuk perhitungan
                //$('#total').data('numericValue', total);
            }
    </script>
</body>

</html>