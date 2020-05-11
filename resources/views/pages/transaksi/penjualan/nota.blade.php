<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="{{ asset('adminlte') }}/bootstrap4/css/bootstrap.min.css" />
    <title>NOTA PENJUALAN - {{ $transaksi->kode }}</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4">
                KEPADA YTH : <br />
                {{$transaksi->pelanggan->nama}} <br />
                {!!$transaksi->pelanggan->alamat!!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-5">
                <table class="float-right">
                    <tr>
                        <td>FAKTUR</td>
                        <td>:</td>
                        <td>{{ $transaksi->kode }}</td>
                    </tr>
                    <tr>
                        <td>TANGGAL</td>
                        <td>:</td>
                        <td>{{ Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('Y M d') }}</td>
                    </tr>
                    <tr>
                        <td>JATUH TEMPO</td>
                        <td>:</td>
                        <td>
                            @if ($transaksi->status == "hutang")
                            {{ $transaksi->piutang->jatuh_tempo }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-1"></div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12 text-center">
                <table style="width: 100%;">
                    <tr>
                        <th style="width: 50%;">Nama Barang</th>
                        <th>QTY</th>
                        <th>Harga</th>
                        <th>
                            <center>Jumlah</center>
                        </th>
                    </tr>
                    @php
                    $jumlah=0;
                    @endphp
                    @foreach ($transaksi->detail_transaksi as $item)

                    <tr>
                        <td>{{ $item->barang->nama }}</td>
                        <td>{{ $item->jumlah_beli }}</td>
                        <td>{{ $item->harga }}</td>
                        <td>{{ $item->subtotal }}</td>
                    </tr>
                    @php
                    $jumlah+=$item->subtotal;
                    @endphp
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="mt-3">
                    *BARANG YANG SUDAH DIBELI TIDAK DAPAT DIKEMBALIKAN
                </div>
            </div>
            <div class="col-md-4">
                <table class="float-right">
                    <tr>
                        <td>JUMLAH</td>
                        <td>:</td>
                        <td>{{ $jumlah }}</td>
                    </tr>
                    <tr>
                        <td>DISC</td>
                        <td>:</td>
                        <td>{{ $transaksi->diskon }}</td>
                    </tr>
                    <tr>
                        <td>PPN</td>
                        <td>:</td>
                        <td>{{ $transaksi->ppn }}</td>
                    </tr>
                    <tr>
                        <td>PPH</td>
                        <td>:</td>
                        <td>{{ $transaksi->pph }}</td>
                    </tr>
                    <tr>
                        <td>NETTO</td>
                        <td>:</td>
                        <td>{{ $transaksi->total }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-2"></div>
            <div class="col-md-7">
                DITERIMA OLEH
                <br /><br /><br /><br />
                (.......................................)
            </div>
            <div class="col-md-3">
                DIKIRIM OLEH
                <br /><br /><br /><br />
                (.......................................)
            </div>
        </div>
    </div>

    <script src="{{ asset('adminlte') }}/bootstrap4/js/jquery.js">
    </script>

    <script src="{{ asset('adminlte') }}/bootstrap4/js/bootstrap.min.js">
    </script>
    <script>
        $(document).ready(function(){
            window.print();
        });
    </script>
</body>

</html>