<div id="showTablePenjualan">
    <input id="getFaktur" style="display:none" value="{{$hutang->pembelian->faktur }}">
    <input id="hutang_id" style="display:none" value="{{$hutang->id }}">
    <div style="overflow-y: auto; height:430px; ">
        <div id="printArea">
            <span style="font-size:20px">
                <center>BUKTI PEMBAYARAN HUTANG</center>
            </span>
            <table class="table">
                <tbody>
                    <tr>
                        <td style="width:200px">Tanggal Hutang</td>
                        <td style="width:30px">:</td>
                        <td>{{$hutang->tanggal_hutang }}</td>
                        <td style="width:200px">Suplier</td>
                        <td style="width:30px">:</td>
                        <td>{{$hutang->pembelian->suplier->nama }}</td>
                    </tr>
                    <tr>
                        <td>Faktur Pembelian</td>
                        <td>:</td>
                        <td>{{$hutang->pembelian->faktur }}</td>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            <?php if($hutang->pembayaran_piutang == 0): ?>
                            <input id="lunas" type="button" class="btn btn-danger btn-xs" value="Belum Dibayar">
                            <?php elseif($hutang->sisa_piutang == 0):?>
                            <input id="lunas" type="button" class="btn btn-success btn-xs" value="Lunas">
                            <?php else: ?>
                            <input id="lunas" type="button" class="btn btn-warning btn-xs" value="Belum Lunas">
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td>Jatuh Tempo</td>
                        <td>:</td>
                        <td>{{$hutang->tanggal_tempo }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
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
                        <th style="width:200px">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hutang->pembelian->detail_pembelian as $key => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->barang->id }}</td>
                        <td>{{ $item->barang->nama }}</td>
                        <td>@rupiah($item->barang->harga_beli)</td>
                        <td>{{ $item->jumlah_beli }}</td>
                        <td> @rupiah($item->subtotal)</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2"><b>Total Hutang</b></td>
                        <td> <input class="form-control" value="@rupiah($hutang->total_hutang)" readonly=""></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2"><b>Hutang Terbayar</b></td>
                        <td> <input class="form-control"
                                value="{{$hutang->pembayaran_hutang ? $hutang->pembayaran_hutang : 0 }}" readonly="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2"><b>Sisa Hutang</b></td>
                        <td><input class="form-control" value="@rupiah($hutang->sisa_hutang )" readonly=""></td>
                    </tr>

                </tbody>
            </table>
            <div style="text-align:right;margin-bottom:50px">
            </div>
            <style>
                .isi {
                    border-top: 0px;
                    border-left: 0px;
                    border-right: 0px;
                    border-bottom: 1px solid #000;
                    text-align: center;
                }

                .isi2 {
                    width: 90px;
                    border-top: 0px;
                    border-left: 0px;
                    border-right: 0px;
                    border-bottom: 1px solid #000;

                }

                .tertanda>tr,
                td {
                    border: none
                }
            </style>
        </div>
    </div>
</div>