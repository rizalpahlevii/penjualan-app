<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Faktur</th>
            <th>Jenis</th>
            <th>Penjualan</th>
            <th>HPP</th>
            <th>Laba Rugi</th>
        </tr>
    </thead>
    <tbody>
        @php
        $ttlPenjualan = 0;
        $ttlHPP = 0;
        $ttlLaba = 0;
        @endphp
        @foreach ($transaksiTunai as $item)
        @if ($item->status == "hutang")
        @if ($item->piutang!=null)
        @if ($item->piutang->sisa_piutang == 0)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->tanggal_transaksi }}</td>
            <td>{{ $item->kode }}</td>
            <td>Penjualan</td>
            <td>
                <?php 
                                            $sub=0; 
                                            foreach($item->detail_transaksi as $tt) {
                                                $sub += $tt->subtotal;
                                            }
                                            ?>
                @rupiah($sub - $item->diskon)
            </td>
            <td>
                <?php 
                                            $hpp = 0;
                                            foreach($item->detail_transaksi as $tt){
                                                $hpp += $tt->jumlah_beli * $tt->barang->harga_beli;
                                            }
                                            ?>
                @rupiah($hpp)
            </td>
            <td>
                @rupiah(($sub - $item->diskon) - $hpp)
            </td>
        </tr>
        @endif
        @endif
        @else
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->tanggal_transaksi }}</td>
            <td>{{ $item->kode }}</td>
            <td>Penjualan</td>
            <td>
                <?php 
                                                                                $sub=0; 
                                                                                foreach($item->detail_transaksi as $tt) {
                                                                                    $sub += $tt->subtotal;
                                                                                }
                                                                                ?>
                @rupiah($sub - $item->diskon)
            </td>
            <td>
                <?php 
                                                                                $hpp = 0;
                                                                                foreach($item->detail_transaksi as $tt){
                                                                                    $hpp += $tt->jumlah_beli * $tt->barang->harga_beli;
                                                                                }
                                                                                ?>
                @rupiah($hpp)
            </td>
            <td>
                @rupiah(($sub - $item->diskon) - $hpp)
            </td>
        </tr>
        @endif
        @php
        $ttlPenjualan +=$sub - $item->diskon;
        $ttlHPP +=$hpp;
        $ttlLaba +=(($sub - $item->diskon) - $hpp);
        @endphp
        @endforeach
    </tbody>
    <thead>
        <tr>
            <td colspan="4">
                <center>Total</center>
            </td>
            <td><b id="ttlpnj">@rupiah($ttlPenjualan)</b></td>
            <td><b id="ttlhpp">@rupiah($ttlHPP)</b></td>
            <td><b id="ttllaba">@rupiah($ttlLaba)</b></td>
        </tr>
    </thead>
</table>