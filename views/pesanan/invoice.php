<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Invoice</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .invoice {
      width: 80%;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .invoice-header {
      text-align: center;
      margin-bottom: 20px;
    }

    .invoice-header h1 {
      font-size: 18px;
      margin: 0;
    }

    .invoice-address {
      margin-bottom: 20px;
    }

    .invoice-address h2 {
      font-size: 16px;
    }

    .invoice-address p {
      margin: 5px 0;
    }

    .invoice-items {
      border-collapse: collapse;
      font-size: 12px;
      width: 100%;
    }

    .invoice-items th, .invoice-items td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
      height: 50%;
    }

    .invoice-items th {
      background-color: #f2f2f2;
    }

    .invoice-items tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    .invoice-total {
      margin-top: 20px;
      text-align: right;
    }

    .invoice-total h3 {
      font-size: 18px;
      margin: 0;
    }
  </style>
</head>
<body>
  <div class="invoice">
    <div class="invoice-header">
      <h1>Invoice Rental Mobil</h1>
    </div>

    <div class="invoice-address">
      <h2><?=$perusahaan->nama_perusahaan?></h2>
      <p>Alamat  : <?=$perusahaan->alamat?></p>
      <p>Telepon : <?=$perusahaan->telp?></p>
      <p>Email   : <?=$perusahaan->email?></p>
    </div>

    <table class="invoice-items" >
       
      <thead>
        <tr>
        <th>Kode Booking</th>
          <th>Nama Pemesan</th>
          <th>Jenis Pembayaran</th>
          <th>Jenis Mobil</th>
          <th>Tanggal Pinjam</th>
          <th>Tanggal Kembali</th>
          <th>Status</th>
          <th>Nominal</th>
        </tr>
      </thead>
      <tbody >
        <tr>
        <td ><?=$pesanan->booking_code?></td>
          <td ><?=$pesanan->id_pemesan?></td>
          <td><?=$pesanan->jenis_bayar?></td>
          <td><?=$pesanan->id_mobil?></td>
          <td><?=date('d-m-Y',strtotime($pesanan->tgl_pinjam))?></td>
          <td><?=date('d-m-Y',strtotime($pesanan->tgl_kembali))?></td>
          <td ><?=$pesanan->asal?></td>
          <td><?=number_format($pesanan->harga,0,',','.')?></td>
        </tr>
 
      </tbody>
    </table>
    <div class="invoice-total">
    <table>
        <tr>
            <td>
    <div style="text-align: center;">
      Pemesan
      <br><br>
      <br><br>
      ---------------------
    </div></td>
        </tr>
    </table>
    </div>
    <br>
    
    
  </div>
</body>
</html>
