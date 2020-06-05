<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="{{ asset('adminlte') }}/bootstrap4/css/bootstrap.min.css" />
    <title>CASHBACK PENJUALAN - {{ $transaksi->kode }}</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6">
                <div style="padding-bottom:5px;margin-bottom:5px">
                    <img src="{{ asset('asset_toko') }}/{{logo()}}" alt="Logo" width="32px;">
                    <b style="font-size:16px; margin-bottom:10px;">{{namaToko()}}</b>
                    <br>
                    {{alamat()}}
                    <br>
                    Email :{{email()}}
                    <br>
                    Contact : {{no_hp()}}
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                KEPADA YTH : <br />
                {{$transaksi->pelanggan->nama}} <br />
                {!!$transaksi->pelanggan->alamat!!}
            </div>
            <div class="col-md-5">
                <table class="float-right">
                    <tr>
                        <td>FAKTUR</td>
                        <td>:</td>
                        <td>{{ $transaksi->kode }}</td>
                    </tr>
                    <tr>
                        <td>TANGGAL TRANSAKSI</td>
                        <td>:</td>
                        <td>{{ Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td>TANGGAL CASHBACK</td>
                        <td>:</td>
                        <td>
                            {{ Carbon\Carbon::parse($transaksi->cashback->tanggal)->format('d M Y') }}
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
                        <th>#</th>
                        <th>Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Cashback Per Item</th>
                        <th>Subtotal Cashback</th>
                    </tr>

                    @foreach ($transaksi->cashback->detail_cashback as $key => $item)
                    <input type="hidden" name="detail_transaksi_id{{ $key+1 }}" value="{{ $item->id }}">
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->detail_transaksi->barang->nama }}</td>
                        <td>
                            {{ $item->qty }}
                        </td>
                        <td>
                            @rupiah($item->detail_transaksi->harga)
                        </td>
                        <td>@rupiah($item->cashback_per_item)</td>
                        <td>@rupiah($item->subtotal)</td>
                    </tr>

                    @endforeach
                    <tr style="border-top: black;">
                        <td colspan="5">
                            <center><b>Total Cashback</b></center>
                        </td>
                        <td>
                            @rupiah($transaksi->cashback->total)
                        </td>
                    </tr>
                </table>

            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-2"></div>
            <div class="col-md-7">
                KEUANGAN
                <br /><br /><br /><br />
                (.......................................)
            </div>
            <div class="col-md-3">
                DIREKTUR
                <br /><br /><br /><br />
                (.......................................)
            </div>
        </div>
        <div class="row mt-5" style="border: 1px solid black;">
            <div class="col-m-3 pt-2 pl-3 pr-3 pb-3">
                <h4 class="text-bold">CASHBACK</h4>

            </div>
            <div class="col-md-9 my-auto text-center">
                <h1>@rupiah($transaksi->cashback->total)</h1>
            </div>
            <hr>
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