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
                        <td>{{ $pembelian->tanggal_pembelian }}</td>
                        <td>Suplier</td>
                        <td style="width:30px">:</td>
                        <td>{{ $pembelian->suplier->nama }}</td>
                    </tr>
                    <tr>
                        <td style="width:150px">No Faktur Pembelian</td>
                        <td>:</td>
                        <td>{{ $pembelian->faktur }}</td>
                        <td>Alamat</td>
                        <td style="width:30px">:</td>
                        <td>{!! $pembelian->suplier->alamat !!} </td>
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
                    @foreach ($pembelian->detail_pembelian as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->barang->id }}</td>
                        <td>{{ $item->barang->nama }}</td>
                        <td>@rupiah ($item->barang->harga_beli )</td>
                        <td>{{ $item->jumlah_beli }}</td>
                        <td>@rupiah($item->barang->harga_beli * $item->jumlah_beli)</td>
                    </tr>
                    @php
                    $total+=$item->barang->harga_beli * $item->jumlah_beli
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