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
                            <td style="font-size:16px" colspan="3"><b>LAPORAN KAS PEMASUKAN DAN PENGELUARAN</b></td>
                        </tr>
                        <tr>
                            <td>PERIODE</td>
                            <td style="width:15px">:</td>
                            <td>{{ request()->get('tanggal_awal') }} s/d {{ request()->get('tanggal_akhir') }}</td>
                        </tr>
                        <tr>
                            <td>PENDAPATAN</td>
                            <td>:</td>
                            <td id="spdpt"></td>
                        </tr>
                        <tr>
                            <td>PENGELUARAN</td>
                            <td>:</td>
                            <td id="spgl"></td>
                        </tr>
                        <tr>
                            <td>SALDO</td>
                            <td>:</td>
                            <td id="ssld"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Faktur</th>
                            <th>Jenis</th>
                            <th>Pendapatan</th>
                            <th>Pengeluaran</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $pemasukan =0 ;
                        $pengeluaran =0;
                        @endphp
                        @foreach ($kas as $key => $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->tanggal }}</td>
                            <td>{{ $row->faktur }}</td>
                            <td>{{ $row->jenis }}</td>
                            <td>@rupiah($row->pemasukan)</td>
                            <td>@rupiah($row->pengeluaran)</td>
                            <td>{{ $row->keterangan }}</td>
                        </tr>
                        @php
                        $pemasukan +=$row->pemasukan;
                        $pengeluaran +=$row->pengeluaran;
                        @endphp
                        @endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <td colspan="6">
                                <center><b>Total Pemasukan</b></center>
                            </td>
                            <td><b id="pdpt">@rupiah($pemasukan)</b></td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <center><b>Total Pengeluaran</b></center>
                            </td>
                            <td><b id="pgl">@rupiah($pengeluaran)</b></td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <center><b>Total Saldo</b></center>
                            </td>
                            <td><b id="sld">@rupiah($pemasukan - $pengeluaran)</b></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('adminlte') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#spdpt').html($('#pdpt').html());
            $('#spgl').html($('#pgl').html());
            $('#ssld').html($('#sld').html());
            window.print();
        });
    </script>
</body>

</html>