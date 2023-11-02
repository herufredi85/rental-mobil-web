<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->mergeCells('A1:F1');
$sheet->setCellValue('A1', 'DAFTAR UANG KELUAR '.$perusahaan->nama_perusahaan);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A2:F2');
$sheet->setCellValue('A2', $tglstart . " s/d " . $tglend);
$sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$sheet->setCellValue('A4', 'No');
$sheet->setCellValue('B4', 'KODE BOOKING');
$sheet->setCellValue('C4', 'JENIS UANG KELUAR');
$sheet->setCellValue('D4', 'DESKRIPSI');
$sheet->setCellValue('E4', 'TANGGAL');
$sheet->setCellValue('F4', 'NOMINAL');
$tot=0;
$no=1;
$lima=5;
 while($pesanan = $data_perjalanan->fetch_object()) :
    $tot= $tot+$pesanan->rpuk;
$sheet->setCellValue('A'.$lima, $no++);
$sheet->setCellValue('B'.$lima, $pesanan->booking_code );
$sheet->setCellValue('C'.$lima, $pesanan->nametuk);
$sheet->setCellValue('D'.$lima, $pesanan->ketuk);
$sheet->setCellValue('E'.$lima, date('d-m-Y',strtotime($pesanan->tgluk)));
$sheet->setCellValue('F'.$lima, $pesanan->rpuk);
$lima=$lima+1;
 endwhile;
 $sheet->setCellValue('A'.$lima, "");
$sheet->setCellValue('B'.$lima, 'TOTAL' );
$sheet->setCellValue('C'.$lima, '');
$sheet->setCellValue('D'.$lima, '');
$sheet->setCellValue('E'.$lima, '');
$sheet->setCellValue('F'.$lima, $tot);

$writer = new Xlsx($spreadsheet);
$writer->save('xlsx/UangKeluar.xlsx');
echo "<script>window.location = '" . base_url() . "xlsx/UangKeluar.xlsx'</script>";
