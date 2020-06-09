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
                            <td style="font-size:16px" colspan="3"><b>LAPORAN PEMBELIAN</b></td>
                        </tr>
                        <tr>
                            <td>PERIODE</td>
                            <td style="width:15px">:</td>
                            <td>{{ request()->get('start') }} s/d {{ request()->get('end') }}</td>
                        </tr>
                        <tr>
                            <td>TOTAL</td>
                            <td>:</td>
                            <td id="sttl"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr style="background:#eee;font-weight:bold">
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Faktur</th>
                            <th>Pemasukan</th>
                            <th>Pembayaran</th>
                            <th>Pelanggan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total = 0;
                        @endphp
                        @foreach ($transaksi as $key => $item)
                        @if ($item->status == "hutang")
                        @if ($item->piutang != null)
                        @if ($item->piutang->sisa_piutang == 0)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tanggal_transaksi }}</td>
                            <td>{{ $item->kode }}</td>
                            <td> @rupiah($item->total - ($item->ppn + $item->pph)) </td>
                            <td>{{ ucfirst($item->status) }}</td>
                            <td>{{ $item->pelanggan->nama }}</td>
                        </tr>
                        @endif
                        @endif
                        @else
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tanggal_transaksi }}</td>
                            <td>{{ $item->kode }}</td>
                            <td> @rupiah($item->total ) </td>
                            <td>{{ ucfirst($item->status) }}</td>
                            <td>{{ $item->pelanggan->nama }}</td>
                        </tr>
                        @endif
                        @php
                        $total += $item->total - ($item->ppn + $item->pph);
                        @endphp
                        @endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <td colspan="5">
                                <center><b>Total</b></center>
                            </td>
                            <td><b id="ttl">@rupiah($total)</b></td>
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
            $('#sttl').html($('#ttl').html());
            window.print();
        });
    </script>
</body>

</html>