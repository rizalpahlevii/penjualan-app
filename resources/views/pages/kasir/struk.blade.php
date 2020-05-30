<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="{{ asset('adminlte') }}/bootstrap4/css/bootstrap.min.css" />

    <style>
        .kotak {
            border: 1px solid black;
            padding-top: 10px;
            padding-left: 15px;
        }
    </style>
    <title>Penjualan-{{ $transaksi->kode }}-{{ $transaksi->pelanggan->nama }}</title>
</head>

<body>
    <div class="container mt-2">

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-m-4">
                        <img src="{{ asset('favicon.png') }}" style="height: 45px;" />
                    </div>
                    <div class="col-md-8">
                        <address>
                            <strong class="text-danger">{{namaToko()}}</strong><br />
                            <p style="color: blue;">Solution For Ordinary People</p>
                        </address>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <address class="float-right" style="font-family: sans-serif;">
                    {{alamat()}}
                    Email :{{email()}} <br />
                    Website : {{website()}} <br />
                    Contact Person : {{no_hp()}}
                </address>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>INVOICE</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <table style="font-family: Arial, Helvetica, sans-serif;">
                    <tr>
                        <td><b>Client</b></td>
                        <td>:</td>
                        <td>{{ $transaksi->pelanggan->nama }}</td>
                    </tr>
                    <tr>
                        <td><b>Address</b></td>
                        <td>:</td>
                        <td>{!! $transaksi->pelanggan->alamat !!}</td>
                    </tr>
                    <tr>
                        <td><b>Contact</b></td>
                        <td>:</td>
                        <td>{{ $transaksi->pelanggan->no_hp }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table style="width: 100%;" border="1" class="text-center">
                    <tr>
                        <th>PO Number</th>
                        <th>Date</th>
                        <th>Term</th>
                        <th>Due Date</th>
                    </tr>
                    <tr>
                        <td>{{ $transaksi->kode }}</td>
                        <td>{{ $transaksi->tanggal_transaksi }}</td>
                        <td>{{ ucfirst($transaksi->status) }}</td>
                        <td>
                            @if ($transaksi->status == "hutang")
                            {{ $transaksi->piutang->tanggal_tempo }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <table style="width: 100%;" border="1" class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Set/Unit</th>
                        <th>Price</th>
                        <th>Term</th>
                    </tr>
                    @php
                    $subtotal=0;
                    @endphp
                    @foreach ($transaksi->detail_transaksi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->barang->nama }}</td>
                        <td>{{ $item->jumlah_beli }}</td>
                        <td>{{ $item->barang->satuan->nama }}</td>
                        <td>@rupiah($item->harga)</td>
                        <td>@rupiah($item->subtotal)</td>
                    </tr>
                    @php
                    $subtotal+=$item->subtotal;
                    @endphp
                    @endforeach
                    <tr>
                        <td colspan="5">
                            <center><b>Total</b></center>
                        </td>
                        <td><b>@rupiah($subtotal)</b></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <center><b>PPH</b></center>
                        </td>
                        <td><b>@rupiah($transaksi->pph)</b></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <center><b>PPN</b></center>
                        </td>
                        <td><b>@rupiah($transaksi->ppn)</b></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <center><b>DISKON</b></center>
                        </td>
                        <td><b>@rupiah($transaksi->diskon)</b></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <center><b>CASHBACK</b></center>
                        </td>
                        <td><b>@rupiah($transaksi->cashback)</b></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <center><b>NETTO</b></center>
                        </td>
                        <td><b>@rupiah($transaksi->total)</b></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-8">
                <div class="kotak">
                    <h6>NOTE :</h6>
                    <h6>BANK DETAILS</h6>
                    <table>
                        <tr>
                            <td>
                                <h6>ACCOUNT</h6>
                            </td>
                            <td>:</td>
                            <td>
                                <h6>{{nama_rekening()}}</h6>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>NO.REK</h6>
                            </td>
                            <td>:</td>
                            <td>
                                <h6>{{no_rekening()}}</h6>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>BANK</h6>
                            </td>
                            <td>:</td>
                            <td>
                                <h6>{{nama_bank()}}</h6>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h6>Best Regards</h6>
                <p class="mt-5" style="font-weight: bold;">
                   {{struk_salam_hormat()}}
                </p>
            </div>
        </div>
    </div>

    <script src="{{ asset('adminlte') }}/bootstrap4/js/jquery.js">
    </script>

    <script src="{{ asset('adminlte') }}/bootstrap4/js/bootstrap.min.js">
    </script>
    <script>
        $(document).ready(function(){
            window.print();
        });
    </script>
</body>

</html>