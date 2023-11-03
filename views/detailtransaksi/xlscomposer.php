<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->mergeCells('A1:F1');
$sheet->setCellValue('A1', 'DETAIL TRANSAKSI '.$perusahaan->nama_perusahaan);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A2:F2');
$sheet->setCellValue('A2', $tglstart . " s/d " . $tglend);
$sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$sheet->setCellValue('A4', 'No');
$sheet->setCellValue('B4', 'KODE BOOKING');
$sheet->setCellValue('C4', 'TANGGAL PINJAM');
$sheet->setCellValue('D4', 'UANG MASUK');
$sheet->setCellValue('E4', 'UANG KELUAR');
$sheet->setCellValue('F4', 'SELISIH');
$tot=0;
$no=1;
$lima=5;
 while($pesanan = $data_perjalanan->fetch_object()) :
    $selisih=$pesanan->harga-$pesanan->uangkeluar;
$sheet->setCellValue('A'.$lima, $no++);
$sheet->setCellValue('B'.$lima, $pesanan->booking_code );
$sheet->setCellValue('C'.$lima,  date('d-m-Y',strtotime($pesanan->tgl_pinjam)));
$sheet->setCellValue('D'.$lima, $pesanan->harga);
$sheet->setCellValue('E'.$lima, $pesanan->uangkeluar);
$sheet->setCellValue('F'.$lima, $selisih);
$lima=$lima+1;
 endwhile;
//  $sheet->setCellValue('A'.$lima, "");
// $sheet->setCellValue('B'.$lima, 'TOTAL' );
// $sheet->setCellValue('C'.$lima, '');
// $sheet->setCellValue('D'.$lima, '');
// $sheet->setCellValue('E'.$lima, '');
// $sheet->setCellValue('F'.$lima, $tot);

$writer = new Xlsx($spreadsheet);
$writer->save('xlsx/DetailTransaksi.xlsx');
echo "<script>window.location = '" . base_url() . "xlsx/DetailTransaksi.xlsx'</script>";
