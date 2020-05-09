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
                @include('pages.report.nama_toko')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="font-size:16px" colspan="3"><b>LAPORAN PIUTANG</b></td>
                        </tr>
                        <tr>
                            <td>PERIODE</td>
                            <td style="width:15px">:</td>
                            <td>{{ request()->get('tanggal_awal') }} s/d {{ request()->get('tanggal_akhir') }}</td>
                        </tr>
                        <tr>
                            <td>TOTAL PIUTANG</td>
                            <td>:</td>
                            <td>@rupiah($totalPiutang) </td>
                        </tr>
                        <tr>
                            <td>TOTAL PIUTANG TERBAYAR</td>
                            <td>:</td>
                            <td>@rupiah($totalPiutangTerbayar) </td>
                        </tr>
                        <tr>
                            <td>TOTAL SISA PIUTANG</td>
                            <td>:</td>
                            <td>@rupiah($totalPiutangSisa) </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <tr style="background:#eee;font-weight:bold">
                        <td>No</td>
                        <td>Tanggal</td>
                        <td>Faktur</td>
                        <td>Faktur Penjualan</td>
                        <td>Total Piutang</td>
                        <td>Piutang Terbayar</td>
                        <td>Sisa Piutang</td>
                        <td>Suplier</td>
                    </tr>
                    @foreach ($piutang as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal_piutang }}</td>
                        <td>{{ $item->faktur }}</td>
                        <td>{{ $item->transaksi->kode }}</td>
                        <td>@rupiah($item->total_piutang)</td>
                        <td>@rupiah($item->piutang_terbayar)</td>
                        <td>@rupiah($item->sisa_piutang)</td>
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