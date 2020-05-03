<div id="showModalReturn">
    <div style="overflow-y: auto; height:430px; ">
        <div id="printArea">
            {{-- <div class="title" style="margin-bottom:10px;text-align:left">
                <b>FDH Application</b>
                <br>
                <small>Komp Putraco Griya Jagabaya Blok C3 no 1 Telp/HP 082117444686</small>
            </div> --}}
            <table class="table">
                <tbody>
                    <tr>
                        <td style="width:150px">Tanggal</td>
                        <td style="width:30px">:</td>
                        <td>2020-05-02</td>
                        <td>Pelanggan</td>
                        <td style="width:30px">:</td>
                        <td>{{ $return->transaksi->pelanggan->nama }}</td>
                    </tr>
                    <tr>
                        <td style="width:150px">No Return Penjualan</td>
                        <td>:</td>
                        <td>{{ $return->faktur }}</td>
                        <td>Alamat</td>
                        <td style="width:30px">:</td>
                        <td>{!! $return->transaksi->pelanggan->alamat !!} </td>
                    </tr>
                </tbody>
            </table>

            <table class="table " id="dataPenjualan" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width:50px">No</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total=0
                    @endphp
                    @foreach ($return->detail_return_jual as $item)
                    @php
                    $detail_tr =
                    \App\Detail_transaksi::where("barang_id",$item->barang_id)->where('transaksi_id',$return->transaksi_id)->first();
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->barang->id }}</td>
                        <td>{{ $item->barang->nama }}</td>
                        <td>{{ $detail_tr->harga }}</td>
                        <td>{{ $item->jumlah_beli }}</td>
                        <td>{{ $item->jumlah_beli *$detail_tr->harga}}</td>
                    </tr>
                    @php
                    $total+=$item->jumlah_beli*$detail_tr->harga;
                    @endphp
                    @endforeach
                    <tr>
                        <td colspan="5">
                            <center><b>Total</b></center>
                        </td>
                        <td>@rupiah($total)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>