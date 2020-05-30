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
    <title>SLIP PENGGAJIAN-{{ $penggajian->faktur }}-{{ $penggajian->pegawai->nama }}</title>
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
                            <strong class="text-danger">CV. MULTISOLUSINDO</strong><br />
                            <p style="color: blue;">Solution For Ordinary People</p>
                        </address>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
               <address class="float-right" style="font-family: sans-serif;">
                    {{alamat()}}
                    <br>
                    Email :{{email()}} <br />
                    Website : {{website()}} <br />
                    Contact Person : {{no_hp()}}
                </address>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>SLIP GAJI</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <table style="font-family: Arial, Helvetica, sans-serif;">
                    <tr>
                        <td><b>Nama </b></td>
                        <td>:</td>
                        <td>{{ $penggajian->pegawai->nama }}</td>
                    </tr>
                    <tr>
                        <td><b>Jabatan </b></td>
                        <td>:</td>
                        <td>{{ $penggajian->pegawai->jabatan->nama }}</td>
                    </tr>
                    <tr>
                        <td><b>Address</b></td>
                        <td>:</td>
                        <td>{!! $penggajian->pegawai->alamat !!}</td>
                    </tr>
                    <tr>
                        <td><b>Contact</b></td>
                        <td>:</td>
                        <td>{{ $penggajian->pegawai->no_telp }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table style="width: 100%;" border="1" class="text-center">
                    <tr>
                        <th>No Referensi Gaji</th>
                        <th>Date</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                    </tr>
                    <tr>
                        <td>{{ $penggajian->faktur }}</td>
                        <td>{{ $penggajian->tanggal_gaji }}</td>
                        <td>
                            @php
                            $explodeb = explode('-',$penggajian->tanggal_gaji);
                            $explodeb = $explodeb[1];
                            @endphp
                            {{$explodeb }}
                        </td>
                        <td>
                            @php

                            $explodet = explode('-',$penggajian->tanggal_gaji);
                            $explodet = $explodet[0];
                            @endphp
                            {{$explodet }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <table style="width: 100%;" border="1" class="text-center">
                    <tr>
                        <th>Gaji Pokok</th>
                        <td>:</td>
                        <td>@rupiah($penggajian->pegawai->jabatan->gaji_pokok)</td>
                    </tr>
                    <tr>
                        <th>Potongan</th>
                        <td>:</td>
                        <td>@rupiah($penggajian->potongan)</td>
                    </tr>
                    <tr>
                        <th>Gaji Bersih</th>
                        <td>:</td>
                        <td>@rupiah($penggajian->gaji_bersih)</td>
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