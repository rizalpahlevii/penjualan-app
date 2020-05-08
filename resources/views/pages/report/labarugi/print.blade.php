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
                            <td style="font-size:16px" colspan="3"><b>LAPORAN LABA RUGI</b></td>
                        </tr>
                        <tr>
                            <td>PERIODE</td>
                            <td style="width:15px">:</td>
                            <td>{{ request()->get('tanggal_awal') }} s/d {{ request()->get('tanggal_akhir') }}</td>
                        </tr>
                        <tr>
                            <td>TOTAL PENJUALAN</td>
                            <td>:</td>
                            <td id="sttlpnj"></td>
                        </tr>
                        <tr>
                            <td>TOTAL HPP</td>
                            <td>:</td>
                            <td id="sttlhpp"></td>
                        </tr>
                        <tr>
                            <td>TOTAL RUGI</td>
                            <td>:</td>
                            <td id="sttlrugi"></td>
                        </tr>
                        <tr>
                            <td>TOTAL LABA</td>
                            <td>:</td>
                            <td id="sttllaba"></td>
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
                            <th>Jenis</th>
                            <th>Penjualan</th>
                            <th>HPP</th>
                            <th>Laba Rugi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $ttlPenjualan = 0;
                        $ttlHPP = 0;
                        $ttlLaba = 0;
                        @endphp
                        @foreach ($transaksi as $item)
                        @if ($item->status == "hutang")
                        @if ($item->piutang!=null)
                        @if ($item->piutang->sisa_piutang == 0)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tanggal_transaksi }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>Penjualan</td>
                            <td>
                                <?php 
                                                                $sub=0; 
                                                                foreach($item->detail_transaksi as $tt) {
                                                                    $sub += $tt->subtotal;
                                                                }
                                                                ?>
                                @rupiah($sub - $item->diskon)
                            </td>
                            <td>
                                <?php 
                                                                $hpp = 0;
                                                                foreach($item->detail_transaksi as $tt){
                                                                    $hpp += $tt->jumlah_beli * $tt->barang->harga_beli;
                                                                }
                                                                ?>
                                @rupiah($hpp)
                            </td>
                            <td>
                                @rupiah(($sub - $item->diskon) - $hpp)
                            </td>
                        </tr>
                        @endif
                        @endif
                        @else
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tanggal_transaksi }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>Penjualan</td>
                            <td>
                                <?php 
                                                                                                    $sub=0; 
                                                                                                    foreach($item->detail_transaksi as $tt) {
                                                                                                        $sub += $tt->subtotal;
                                                                                                    }
                                                                                                    ?>
                                @rupiah($sub - $item->diskon)
                            </td>
                            <td>
                                <?php 
                                                                                                    $hpp = 0;
                                                                                                    foreach($item->detail_transaksi as $tt){
                                                                                                        $hpp += $tt->jumlah_beli * $tt->barang->harga_beli;
                                                                                                    }
                                                                                                    ?>
                                @rupiah($hpp)
                            </td>
                            <td>
                                @rupiah(($sub - $item->diskon) - $hpp)
                            </td>
                        </tr>
                        @endif
                        @php
                        $ttlPenjualan +=$sub - $item->diskon;
                        $ttlHPP +=$hpp;
                        $ttlLaba +=(($sub - $item->diskon) - $hpp);
                        @endphp
                        @endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <td colspan="4">
                                <center>Total</center>
                            </td>
                            <td><b id="ttlpnj">@rupiah($ttlPenjualan)</b></td>
                            <td><b id="ttlhpp">@rupiah($ttlHPP)</b></td>
                            <td><b id="ttllaba">@rupiah($ttlLaba)</b></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <input type="hidden" name="penjualan" id="penjualan" value="{{ $ttlPenjualan }}">
    <input type="hidden" name="hpp" id="hpp" value="{{ $ttlHPP }}">
    <script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('adminlte') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            function loadKotakAtas(){
                $('#sttlpnj').html($('#ttlpnj').html());
                $('#sttlhpp').html($('#ttlhpp').html());
                const pnj = parseInt($('#penjualan').val());
                const hpp = parseInt($("#hpp").val());
                if(pnj - hpp < 0 ){
                    // rugi
                    $("#sttlrugi").html("Rp. " + (pnj-hpp));
                    $("#sttllaba").html("Rp. 0");
                }else{
                    // laba
                    $("#sttlrugi").html("Rp. 0")
                    $("#sttllaba").html("Rp. " + (pnj-hpp));
                }
                window.print();
            }
            loadKotakAtas();
        });
    </script>
</body>

</html>