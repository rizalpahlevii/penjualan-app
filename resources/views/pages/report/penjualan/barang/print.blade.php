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
                            <td style="font-size:16px" colspan="3"><b>LAPORAN PENJUALAN PER BARANG</b></td>
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
                        <tr>
                            <th>#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Tanggal</th>
                            <th>Faktur</th>
                            <th>Harga</th>
                            <th>QTY</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        $total=0;
                        @endphp
                        @foreach ($transaksi as $row)
                        @if ($row->status == "hutang")
                        @if ($row->piutang != null)
                        @if ($row->sisa_piutang == 0)
                        @foreach ($row->detail_transaksi as $detail)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $detail->barang->nama }}</td>
                            <td>{{ $detail->barang->id }}</td>
                            <td>{{ $row->tanggal_transaksi }}</td>
                            <td>{{ $row->kode }}</td>
                            <td>{{ $detail->harga }}</td>
                            <td>{{ $detail->jumlah_beli }}</td>
                            <td>{{ $detail->subtotal }}</td>
                        </tr>
                        @php
                        $no++;
                        $total += $detail->subtotal;
                        @endphp
                        @endforeach
                        @endif
                        @endif
                        @else

                        @foreach ($row->detail_transaksi as $detail)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $detail->barang->nama }}</td>
                            <td>{{ $detail->barang->id }}</td>
                            <td>{{ $row->tanggal_transaksi }}</td>
                            <td>{{ $row->kode }}</td>
                            <td>{{ $detail->harga }}</td>
                            <td>{{ $detail->jumlah_beli }}</td>
                            <td>{{ $detail->subtotal }}</td>
                        </tr>
                        @php
                        $no++;
                        $total+=$detail->subtotal;
                        @endphp
                        @endforeach
                        @endif

                        @endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <td colspan="7">
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