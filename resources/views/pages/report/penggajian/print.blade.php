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
                            <td style="font-size:16px" colspan="3"><b>LAPORAN PENGGAJIAN</b></td>
                        </tr>
                        <tr>
                            <td>PERIODE</td>
                            <td style="width:15px">:</td>
                            <td>{{ request()->get('bulan') }} -
                                {{ request()->get('tahun') }}</td>
                        </tr>
                        <tr>
                            <td>TOTAL PENGGAJIAN</td>
                            <td>:</td>
                            <td id="sttlpgj"></td>
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
                            <th>Nama Pegawai</th>
                            <th>Gaji Bulan</th>
                            <th>Tanggal</th>
                            <th>Faktur</th>
                            <th>Gaji Pokok</th>
                            <th>Potongan Gaji</th>
                            <th>Gaji Bersih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total=0;
                        @endphp
                        @foreach ($penggajian as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pegawai->nama }}</td>
                            <td>{{ Carbon\Carbon::parse($item->tanggal_gaji)->format('M-Y') }}</td>
                            <td>{{ $item->tanggal_gaji }}</td>
                            <td>{{ $item->faktur }}</td>
                            <td>@rupiah($item->pegawai->jabatan->gaji_pokok)</td>
                            <td>@rupiah($item->potongan)</td>
                            <td>@rupiah($item->gaji_bersih)</td>
                        </tr>
                        @php
                        $total += $item->gaji_bersih;
                        @endphp
                        @endforeach
                    </tbody>
                    <thead>
                        <td colspan="7">
                            <center><b>Total Gaji</b></center>
                        </td>
                        <td id="ttlpgj">@rupiah($total)</td>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('adminlte') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#sttlpgj').html($('#ttlpgj').html());
            window.print();
        });
    </script>
</body>

</html>