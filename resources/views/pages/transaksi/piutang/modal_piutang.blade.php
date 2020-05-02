<div id="showTablePenjualan">
    <input id="getFaktur" style="display:none" value="{{ $piutang->transaksi->kode }}">
    <input id="piutang_id" style="display:none" value="{{ $piutang->id }}">
    <div style="overflow-y: auto; height:430px; ">
        <div id="printArea">
            <span style="font-size:20px">
                <center>BUKTI PEMBAYARAN PIUTANG</center>
            </span>
            <table class="table">
                <tbody>
                    <tr>
                        <td style="width:200px">Tanggal</td>
                        <td style="width:30px">:</td>
                        <td>{{ $piutang->tanggal_piutang }}</td>
                        <td style="width:200px">Pelanggan</td>
                        <td style="width:30px">:</td>
                        <td>{{ $piutang->pelanggan->nama }}</td>
                    </tr>
                    <tr>
                        <td>Faktur Piutang</td>
                        <td>:</td>
                        <td>{{ $piutang->transaksi->kode }}</td>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            <?php if($piutang->piutang_terbayar == 0): ?>
                            <input id="lunas" type="button" class="btn btn-danger btn-xs" value="Belum Dibayar">
                            <?php elseif($piutang->sisa_piutang == 0):?>
                            <input id="lunas" type="button" class="btn btn-success btn-xs" value="Lunas">
                            <?php else: ?>
                            <input id="lunas" type="button" class="btn btn-warning btn-xs" value="Belum Lunas">
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td>Jatuh Tempo</td>
                        <td>:</td>
                        <td>{{ $piutang->tanggal_tempo }}</td>
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
                    @foreach ($piutang->transaksi->detail_transaksi as $key => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->barang->id }}</td>
                        <td>{{ $item->barang->nama }}</td>
                        <td>{{ $item->harga }} </td>
                        <td>{{ $item->jumlah_beli }}</td>
                        <td>{{ $item->subtotal }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2"><b>PPN</b></td>
                        <td> <input class="form-control" value="{{ $piutang->transaksi->ppn}}" readonly=""></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2"><b>PPH</b></td>
                        <td> <input class="form-control" value="{{ $piutang->transaksi->pph}}" readonly=""></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2"><b>Diskon</b></td>
                        <td> <input class="form-control" value="{{ $piutang->transaksi->diskon}}" readonly=""></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2"><b>Total Piutang</b></td>
                        <td> <input class="form-control" value="{{ $piutang->total_hutang}}" readonly=""></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2"><b>Piutang Terbayar</b></td>
                        <td> <input class="form-control" value="{{ $piutang->terbayar?$piutang->terbayar:0 }}"
                                readonly=""></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2"><b>Sisa Piutang</b></td>
                        <td><input class="form-control" value="{{ $piutang->sisa_piutang }}" readonly=""></td>
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

            <input id="faktur" value="{{ $piutang->transaksi->kode }}" hidden="">
        </div>
    </div>
</div>