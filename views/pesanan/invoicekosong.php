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
      width: 90%;
      margin: 0 auto;
      padding: 5px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .invoice-header {
      text-align: center;
      margin-bottom: 10px;
    }

    .invoice-header h1 {
      font-size: 18px;
      margin: 0;
    }

    .invoice-address {
      margin-bottom: 10px;
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
      padding: 5px;
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
      <h1>Invoice </h1>
    </div>
<table width='100%'>
  <tr>
    <td width='70%'> 
      <table>
        <tr>
          <td><?=$perusahaan->nama_perusahaan?></td>
        </tr>
        <tr>

          <td><?=$perusahaan->alamat?></td>
        </tr>
        <tr>
          <td><?=$perusahaan->telp?></td>
        </tr>
      </table>
    </td>
    <td>
      <table>
        <tr>
          <td>No.Invoice</td>
          <td>:</td>
          <td><?=$cb?></td>
        </tr>
        <tr>
          <td>Date</td>
          <td>:</td>
          <td><?=date('d M Y')?></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="center">

    <table >
        <tr >
          <td>Customer</td>
          <td>:</td>
          <td><h3></h3></td>
        </tr>

      </table>

    </td>
  </tr>
</table>
   

    <table class="invoice-items" >
       
      <thead >
        <tr >

          <th style="background-color: #76b5c5; text-align: center">No</th>
          <!-- <th style="background-color: #76b5c5; text-align: center">Kode Booking</th> -->
          <th style="background-color: #76b5c5; text-align: center">Deskripsi</th>
          <th style="background-color: #76b5c5; text-align: center">Qty</th>
          <th style="background-color: #76b5c5; text-align: center">Unit Price</th>
          <th style="background-color: #76b5c5; text-align: center">Total</th>
        </tr>
      </thead>
      <tbody >
   
        <tr >
          <td style="vertical-align: top;"></td>
  
          <td width='50%' ><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
          <td style="vertical-align: top;"></td>
          <td style="text-align: right; vertical-align: top;"></td>
          <td style="text-align: right; vertical-align: top;"></td>
        </tr>
  
      <tr>
        <td colspan="4" style="text-align: center;"><B>TOTAL</b></td>
        <td style="text-align: right;"><b></b></td>
      </tr>
      </tbody>
    </table>
    <table>
      <tr>
        <td>Transfer :<br><?=$perusahaan->account?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Medan <?=date('d M Y')?><br>Hormat Kami,</td>
      </tr>
    </table>
    <div class="invoice-total">
    <table>
        <tr>
            <td>
    <div style="text-align: left;">
      <img src="<?=base_url()?>uploads/perusahaan/<?=$perusahaan->logo?>"><br>
      <?=$perusahaan->owner?>
    </div></td>
        </tr>
    </table>
    </div>
    <br>
    
    
  </div>
</body>
</html>
