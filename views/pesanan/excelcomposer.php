<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->mergeCells('A1:H1');
$sheet->setCellValue('A1', 'DAFTAR PESANAN '.$perusahaan->nama_perusahaan);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A2:H2');
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
$tot=0;
$no=1;
$lima=5;
 while($pesanan = $data_pesanan->fetch_object()) :
    $tot= $tot+$pesanan->harga;
$sheet->setCellValue('A'.$lima, $no++);
$sheet->setCellValue('B'.$lima, $pesanan->booking_code );
$sheet->setCellValue('C'.$lima, $pesanan->nama_pemesan);
$sheet->setCellValue('D'.$lima, $pesanan->jenis_bayar);
$sheet->setCellValue('E'.$lima, date('d-m-Y',strtotime($pesanan->tgl_pinjam)));
$sheet->setCellValue('F'.$lima, date('d-m-Y',strtotime($pesanan->tgl_kembali)));
$sheet->setCellValue('G'.$lima, $pesanan->sts);
$sheet->setCellValue('H'.$lima, $pesanan->harga);
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

$writer = new Xlsx($spreadsheet);
$writer->save('xlsx/Pemesanan.xlsx');
echo "<script>window.location = '" . base_url() . "xlsx/Pemesanan.xlsx'</script>";
