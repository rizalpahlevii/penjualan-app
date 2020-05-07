<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
    <link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/bootstrap/dist/css/bootstrap.css">

</head>


<body>
    <div class="containter">
        <div class="row">
            <div class="col-md-12">
                @include('pages.laporan.cetak.nama_toko')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="font-size:16px" colspan="3"><b>LAPORAN PENJUALAN</b></td>
                        </tr>
                        <tr>
                            <td>PERIODE</td>
                            <td style="width:15px">:</td>
                            <td>{{ request()->get('start') }} s/d {{ request()->get('end') }}</td>
                        </tr>
                        <tr>
                            <td>TOTAL PENJUALAN</td>
                            <td>:</td>
                            <td>@rupiah($transaksiTunai+$transaksiHutang) </td>
                        </tr>
                        <tr>
                            <td>TOTAL PENJUALAN TUNAI</td>
                            <td>:</td>
                            <td>@rupiah($transaksiTunai)</td>
                        </tr>
                        <tr>
                            <td>TOTAL PENJUALAN KREDIT</td>
                            <td>:</td>
                            <td>@rupiah($transaksiHutang) </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <tr style="background:#eee;font-weight:bold">
                        <td style="width:40px">No</td>
                        <td style="width:100px">Tanggal</td>
                        <td style="width:200px">Faktur</td>
                        <td>Penjualan</td>
                        <td>Pembayaran</td>
                        <td>Pelanggan</td>
                    </tr>
                    @foreach ($transaksi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal_transaksi }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>@rupiah($item->total)</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->pelanggan->nama }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('adminlte') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            window.print();
        });
    </script>
</body>

</html>