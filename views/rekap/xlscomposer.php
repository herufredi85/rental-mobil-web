<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->mergeCells('A1:D1');
$sheet->setCellValue('A1', 'REKAP TRANSAKSI '.$perusahaan->nama_perusahaan);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A2:D2');
$sheet->setCellValue('A2', $tglstart . " s/d " . $tglend);
$sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$sheet->setCellValue('A4', 'No');
$sheet->setCellValue('B4', 'TANGGAL');
$sheet->setCellValue('C4', 'UANG MASUK');
$sheet->setCellValue('D4', 'UANG KELUAR');
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
endwhile;
$data = array_values($data); // Perbarui indeks array jika ada elemen yang dihapus
$totum = 0;
$totuk = 0;
$lima=5;
// print_r($data);
foreach ($data as $dt) {
    $d1 = explode('|', $dt[1]);
    $d2 = explode('|', $dt[2]);
    $sheet->setCellValue('A'.$lima, $no++);
    $sheet->setCellValue('B'.$lima, date('d-m-Y', strtotime($dt[0])));
    if ($d1[1] == 'UK') {
        $totum = $totum + (int)$d2[0];
        $totuk = $totuk + (int)$d1[0];
        $sheet->setCellValue('C'.$lima, $d2[0]);
        $sheet->setCellValue('D'.$lima, $d1[0]);
    } else {
        $totum = $totum + (int)$d1[0];
        $totuk = $totuk + 0;
        $sheet->setCellValue('C'.$lima, $d1[0]);
        $sheet->setCellValue('D'.$lima, 0);
    }
    $lima=$lima+1;
}
$sheet->setCellValue('A'.$lima, '');
$sheet->setCellValue('B'.$lima, 'TOTAL');
$sheet->setCellValue('C'.$lima, $totum);
$sheet->setCellValue('D'.$lima, $totuk);
$writer = new Xlsx($spreadsheet);
$writer->save('xlsx/Rekap.xlsx');
echo "<script>window.location = '" . base_url() . "xlsx/Rekap.xlsx'</script>";
