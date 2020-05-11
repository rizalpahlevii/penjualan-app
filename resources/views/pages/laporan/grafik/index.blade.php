@extends('layouts.template')
@section('page','Grafik')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-body">
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="well well-sm"><i class="fa fa-info-circle"></i> Laba Rugi merupakan hasil selisih
                            <b>Harga Jual - Harga
                                Modal (HPP)</b>. Laporan Laba Rugi diambil dari transaksi penjualan tunai dan no tunai
                            yang sudah lunas.</div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tipe</td>
                                    <td>
                                        <select name="mode" class="form-control" id="mode">
                                            <option>penjualan</option>
                                            <option>laba</option>
                                            <option value="terjual">terjual</option>
                                        </select>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Bulan</td>
                                    <td>
                                        <select name="bulan" class="form-control" id="bulan">
                                            <option disabled selected>Pilih Bulan</option>
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">Nopember</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Tahun</td>

                                    <td>
                                        <select name="tahun" class="form-control" id="tahun">
                                            <option disabled selected>Pilih Periode</option>
                                            @foreach ($year as $item)
                                            <option value="{{ $item->year }}">{{ $item->year }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><a href="#" class="btn btn-success" style="width:100%" id="viewChart"><i
                                                class="fa fa-search"></i>
                                            Filter</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class=" box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <div class="row mb-5" id="show-none">
                    <h4 class="text-center">Grafik belum diload</h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="chart" style="display: none">
                            <canvas id="chartPenjualan" height="400"></canvas>
                            <canvas id="chartTerjual" height="400" style="display: none"></canvas>
                            <canvas id="chartLaba" height="400" style="display: none"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/sweetalert2/dist/sweetalert2.css">
@endpush
@push('script')
<script src="{{ asset('adminlte') }}/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('adminlte') }}/plugins/chartjs/chart.js"></script>
<script>
    $(document).ready(function(){
        function chartPenjualan(){
            const month = $('#bulan').val();
            const year = $("#tahun").val();
            let url = `{{ url('/laporan/grafik/getChartPenjualan?month=${month}&year=${year}') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $.ajax({
                type: "GET",
                url: parsedUrl,
                dataType: "json",
                beforeSend:function(){
                    Swal.fire({
                        title: 'Loading .....',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        onOpen: () => {
                            Swal.showLoading()
                        }
                    })
                },
                success: function (response) {
                    $('#show-none').hide();
                    $('.chart').css({display:"block"});
                    $('#chartPenjualan').css({display:"block"});
                    $('#chartLaba').css({display:"none"});
                    $('#chartTerjual').css({display:"none"});
                    const ctx = document.getElementById('chartPenjualan').getContext('2d');
                    labels = response[0];
                    data = response[1]
                    const myChart = new Chart(ctx,{
                        type : 'bar',
                        data : {
                            labels : labels,
                            datasets : [
                                {
                                    label : 'Grafik Penjualan',
                                    data : data,
                                    backgroundColor :'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth : 1
                                }
                            ]
                        },
                        options : {
                           
                        }
                    });
                    Swal.close();
                }
            });
        }
        function chartLaba(){
            const month = $('#bulan').val();
            const year = $("#tahun").val();
            let url = `{{ url('/laporan/grafik/getChartLaba?month=${month}&year=${year}') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $.ajax({
                type: "GET",
                url: parsedUrl,
                dataType: "json",
                beforeSend:function(){
                    Swal.fire({
                        title: 'Loading .....',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        onOpen: () => {
                            Swal.showLoading()
                        }
                    })
                },
                success: function (response) {
                    $('#show-none').hide();
                    $('.chart').css({display:"block"});
                    $('#chartLaba').css({display:"block"});
                    $('#chartPenjualan').css({display:"none"});
                    $('#chartTerjual').css({display:"none"});
                    const ctx = document.getElementById('chartLaba').getContext('2d');
                    labels = response[0];
                    data = response[1]
                    const myChart = new Chart(ctx,{
                        type : 'bar',
                        data : {
                            labels : labels,
                            datasets : [
                                {
                                    label : 'Grafik Laba Rugi',
                                    data : data,
                                    backgroundColor :'rgba(54, 162, 235, 0.2)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth : 1
                                }
                            ]
                        },
                        options : {
                            tooltips : {
                                mode: 'index'
                            }
                        }
                    });
                    Swal.close();
                }
            });
        }
        function chartTerjual(){
            const month = $('#bulan').val();
            const year = $("#tahun").val();
            let url = `{{ url('/laporan/grafik/getChartTerjual?month=${month}&year=${year}') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $.ajax({
                type: "GET",
                url: parsedUrl,
                dataType: "json",
                beforeSend:function(){
                    Swal.fire({
                        title: 'Loading .....',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        onOpen: () => {
                            Swal.showLoading()
                        }
                    })
                },
                success: function (response) {
                    $('#show-none').hide();
                    $('.chart').css({display:"block"});
                    $('#chartTerjual').css({display:"block"});
                    $('#chartLaba').css({display:"none"});
                    $('#chartPenjualan').css({display:"none"});
                    const ctx = document.getElementById('chartTerjual').getContext('2d');
                    labels = response[0];
                    data = response[1]
                    const myChart = new Chart(ctx,{
                        type : 'bar',
                        data : {
                            labels : labels,
                            datasets : [
                                {
                                    label : 'Grafik Barang Terjual',
                                    data : data,
                                    backgroundColor :'rgba(255, 159, 64, 0.2)',
                                    borderColor: 'rgba(255, 159, 64, 1)',
                                    borderWidth : 1
                                }
                            ]
                        },
                        options : {
                           
                        }
                    });
                    Swal.close();
                }
            });
        }
        $("#viewChart").click(function(){
            mode = $('#mode').val();
            if(mode == "penjualan"){
                chartPenjualan();
            }else if(mode == "laba"){
                chartLaba();
            }else{
                chartTerjual();
            }
        });
    });
    
</script>
@endpush