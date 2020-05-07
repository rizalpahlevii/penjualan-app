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
                            <td style="font-size:16px" colspan="3"><b>LAPORAN KAS</b></td>
                        </tr>
                        <tr>
                            <td>PERIODE</td>
                            <td style="width:15px">:</td>
                            <td>{{ request()->get('start') }} s/d {{ request()->get('end') }}</td>
                        </tr>
                        <tr>
                            <td>PENDAPATAN</td>
                            <td>:</td>
                            <td>@rupiah($pendapatan) </td>
                        </tr>
                        <tr>
                            <td>PENGELUARAN</td>
                            <td>:</td>
                            <td>@rupiah($pengeluaran) </td>
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
                        <td>Tipe</td>
                        <td>Jenis</td>
                        <td>Pemasukan</td>
                        <td>Pengeluaran</td>
                        <td>Keterangan</td>
                    </tr>
                    @foreach ($kas as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->faktur }}</td>
                        <td>{{ ucfirst($item->tipe) }}</td>
                        <td>{{ ucfirst($item->jenis) }}</td>
                        <td>@rupiah($item->pemasukan)</td>
                        <td>@rupiah($item->pengeluaran)</td>
                        <td>{{ $item->keterangan }}</td>
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