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
                <table class="table table-striped table-bordered table-hover" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <td>Penjualan Tunai</td>
                            <td>@rupiah($penjualan['tunai'])</td>
                        </tr>
                        <tr>
                            <td>Penjualan Non Tunai</td>
                            <td>@rupiah($penjualan['non_tunai'])</td>
                        </tr>
                        <tr>
                            <td>Penjualan Tunai & Non Tunai</td>
                            <td>@rupiah($penjualan['tunai'] + $penjualan['non_tunai'])</td>
                        </tr>
                        <tr>
                            <td>Return Penjualan</td>
                            <td>@rupiah($return_penjualan)</td>
                        </tr>
                        <tr>
                            <td>Total Piutang</td>
                            <td>@rupiah($piutang['total_piutang'])</td>
                        </tr>
                        <tr>
                            <td>Piutang Terbayar</td>
                            <td>@rupiah($piutang['piutang_terbayar'])</td>
                        </tr>
                        <tr>
                            <td>Piutang Sisa</td>
                            <td>@rupiah($piutang['sisa_piutang'])</td>
                        </tr>
                        <tr>
                            <td>Cashback Dibayar</td>
                            <td>@rupiah($cashback)</td>
                        </tr>
                        <tr>
                            <td>
                                <center><b>Netto Penjualan</b></center>
                            </td>
                            <td>
                                <b>@rupiah($laba_rugi_penjualan)</b>
                            </td>
                        </tr>
                        <tr>
                            <td>Pembelian Tunai</td>
                            <td>@rupiah($pembelian['tunai'])</td>
                        </tr>
                        <tr>
                            <td>Pembelian Non Tunai</td>
                            <td>@rupiah($pembelian['non_tunai'])</td>
                        </tr>
                        <tr>
                            <td>Pembelian Tunai & Non Tunai</td>
                            <td>@rupiah($pembelian['tunai']+$pembelian['non_tunai'])</td>
                        </tr>
                        <tr>
                            <td>Return Pembelian</td>
                            <td>@rupiah($return_pembelian)</td>
                        </tr>
                        <tr>
                            <td>Total Hutang</td>
                            <td>@rupiah($hutang['total_hutang'])</td>
                        </tr>
                        <tr>
                            <td>Hutang Terbayar</td>
                            <td>@rupiah($hutang['hutang_terbayar'])</td>
                        </tr>
                        <tr>
                            <td>Hutang Sisa</td>
                            <td>@rupiah($hutang['sisa_hutang'])</td>
                        </tr>
                        <tr>
                            <td>
                                <center><b>Netto Pembelian / Pengeluaran</b></center>
                            </td>
                            <td>
                                <b>@rupiah($hutang['hutang_terbayar']+$pembelian['tunai'] -
                                    $return_pembelian )</b>
                            </td>
                        </tr>
                        <tr>
                            <td>Penggajian</td>
                            <td>@rupiah($penggajian)</td>
                        </tr>
                        <tr>
                            <td>Pajak PPN & PPH</td>
                            <td>@rupiah($ppn_pph['ppn']) / @rupiah($ppn_pph['pph'])</td>
                        </tr>


                        <tr>
                            <td>Transport</td>
                            <td>@rupiah($transport)</td>
                        </tr>
                        <tr>
                            <td>Pemasukan Lain</td>
                            <td>@rupiah($pemasukan_lain)</td>
                        </tr>
                        <tr>
                            <td>Pengeluaran Lain</td>
                            <td>@rupiah($pengeluaran_lain)</td>
                        </tr>
                        <tr>
                            <td><b>
                                    <center>Saldo Netto</center>
                                </b></td>
                            <td>
                                @php
                                $netto = $laba_rugi_penjualan -
                                ($hutang['hutang_terbayar']+$pembelian['tunai'] -
                                $return_pembelian );
                                $netto += $pemasukan_lain;
                                $netto -= ($ppn_pph['ppn']+$ppn_pph['pph']+$transport+$pengeluaran_lain)
                                @endphp
                                <b>@rupiah($netto)</b>
                            </td>
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
            window.print();
        });
    </script>
</body>

</html>