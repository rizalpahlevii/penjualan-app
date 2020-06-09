@extends('layouts.template')
@section('page','Dashboard')
@section('content')
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $totalBarang }}</h3>

                <p>Barang</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('barang.index') }}" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $totalPelanggan }}</h3>

                <p>Pelanggan</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('pelanggan.index') }}" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ number_format($omsetBulanIni, 0, ".", ".") }}</h3>

                <p>Omset Penjualan Bulan Ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('suplier.index') }}" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ number_format($labaRugi, 0, ".", ".") }}</h3>

                <p>Laba Penjualan Bulan Ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Laba Rugi</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="labaRugi" style="height:230px"></canvas>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Pengingat Stok</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div style="overflow-y: auto; height:300px;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Barang</th>
                                        <th>Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengingat as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->stok_akhir }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Barang Terlaris</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div style="overflow-y: auto; height:300px;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Barang</th>
                                        <th>Terjual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($terlaris as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->stok_keluar }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<link rel="stylesheet"
    href="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap wysihtml5 - text editor -->
@endpush
@push('script')
<script src="{{ asset('adminlte') }}/bower_components/moment/min/moment.min.js"></script>

<script src="{{ asset('adminlte') }}/plugins/chartjs/chart.js"></script>
<script src="{{ asset('adminlte') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script>
    $(document).ready(function(){
        grafikLabaRugi();
        function grafikLabaRugi(){
            $.ajax({
                type: "GET",
                url: `{{ route('dashboard.grafik_laba') }}`,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    const ctx = document.getElementById('labaRugi').getContext('2d');
                    labels = response.bulan;
                    laba = response.laba;
                    rugi = response.rugi;
                    const myChart = new Chart(ctx,{
                        type : 'bar',
                        data : {
                            labels : labels,
                            datasets : [
                                {
                                    label : 'Laba',
                                    data : laba,
                                    backgroundColor :'rgba(54, 162, 235, 0.2)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth : 1
                                },
                                {
                                    label : 'Rugi',
                                    data : rugi,
                                    backgroundColor :'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth : 1
                                }
                            ]
                        },
                        options : {
                            tooltips : {
                                mode: 'index'
                            }
                        }
                    })
                }
            });
        }
    }); 
</script>
@endpush