<table class="table table-border" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>No.Booking</th>
            <th>Tanggal Pinjam</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $tot = 0;
        $no = 1;
        $tglstart="01".date('-m-Y');
        $tglend=date('d-m-Y');
       // print_r($detailid);
        while ($pesanan = $detailid->fetch_object()) :
            //$tot= $tot+$pesanan->harga;
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><a href="<?= base_url('pesanan/detail/' . $pesanan->id . '/' . $tglstart . '/' . $tglend) ?>"><?= $pesanan->booking_code ?></a></td>
                <td><?= date('d-m-Y',strtotime($pesanan->tgl_pinjam)) ?></td>
                <td style="text-align: end;"><?= number_format($pesanan->harga, 0, ',', '.') ?></td>

            </tr>
        <?php endwhile; ?>
    </tbody>
</table>