<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->mergeCells('A1:J1');
$sheet->setCellValue('A1', 'DAFTAR PESANAN '.$perusahaan->nama_perusahaan);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A2:J2');
$sheet->setCellValue('A2', $tglstart . " s/d " . $tglend);
$sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$sheet->setCellValue('A4', 'No');
$sheet->setCellValue('B4', 'KODE BOOKING');
$sheet->setCellValue('C4', 'PEMESAN');
$sheet->setCellValue('D4', 'JENIS LAYANAN');
$sheet->setCellValue('E4', 'TANGGAL PINJAM');
$sheet->setCellValue('F4', 'TANGGAL KEMBALI');
$sheet->setCellValue('G4', 'STATUS');
$sheet->setCellValue('H4', 'TOTAL HARGA');
$sheet->setCellValue('I4', 'UANG MUKA');
$sheet->setCellValue('J4', 'SISA PEMBAYARAN');
$tot=0;
$totum=0;
$totsel=0;
$no=1;
$lima=5;
 while($pesanan = $data_pesanan->fetch_object()) :
    $tot= $tot+$pesanan->harga;
    $totum= $totum+$pesanan->uang_muka;
    $totsel= $totsel+$pesanan->harga-$pesanan->uang_muka;
$sheet->setCellValue('A'.$lima, $no++);
$sheet->setCellValue('B'.$lima, $pesanan->booking_code );
$sheet->setCellValue('C'.$lima, $pesanan->nama_pemesan);
$sheet->setCellValue('D'.$lima, $pesanan->jenis_bayar);
$sheet->setCellValue('E'.$lima, date('d-m-Y',strtotime($pesanan->tgl_pinjam)));
$sheet->setCellValue('F'.$lima, date('d-m-Y',strtotime($pesanan->tgl_kembali)));
$sheet->setCellValue('G'.$lima, $pesanan->sts);
$sheet->setCellValue('H'.$lima, $pesanan->harga);
$sheet->setCellValue('I'.$lima, $pesanan->uang_muka);
$sheet->setCellValue('J'.$lima, $pesanan->harga-$pesanan->uang_muka);
$lima=$lima+1;
 endwhile;
 $sheet->setCellValue('A'.$lima, "");
$sheet->setCellValue('B'.$lima, 'TOTAL' );
$sheet->setCellValue('C'.$lima, '');
$sheet->setCellValue('D'.$lima, '');
$sheet->setCellValue('E'.$lima, '');
$sheet->setCellValue('F'.$lima, '');
$sheet->setCellValue('G'.$lima, '');
$sheet->setCellValue('H'.$lima, $tot);
$sheet->setCellValue('I'.$lima, $totum);
$sheet->setCellValue('J'.$lima, $totsel);

$writer = new Xlsx($spreadsheet);
$writer->save('xlsx/Pemesanan.xlsx');
echo "<script>window.location = '" . base_url() . "xlsx/Pemesanan.xlsx'</script>";
