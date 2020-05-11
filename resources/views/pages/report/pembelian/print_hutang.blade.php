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
                            <td style="font-size:16px" colspan="3"><b>LAPORAN PEMBELIAN KREDIT</b></td>
                        </tr>
                        <tr>
                            <td>PERIODE</td>
                            <td style="width:15px">:</td>
                            <td>{{ request()->get('start') }} s/d {{ request()->get('end') }}</td>
                        </tr>
                        <tr>
                            <td>TOTAL PEMBELIAN</td>
                            <td>:</td>
                            <td>@rupiah($pembelianHutang) </td>
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
                        <td>Pembelian</td>
                        <td>Pembayaran</td>
                        <td>Suplier</td>
                    </tr>
                    @foreach ($pembelian as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal_pembelian }}</td>
                        <td>{{ $item->faktur }}</td>
                        <td>@rupiah($item->total)</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->suplier->nama }}</td>
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