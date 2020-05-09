@extends('layouts.template')
@section('page','Penggajian Pegawai')
@section('content')
<div class="row kotak-atas">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class=" box-body">
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="well well-sm"><i class="fa fa-info-circle"></i> Laporan Transaksi diambil dari
                            transaksi penjualan tunai dan no tunai
                            yang sudah lunas.</div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-6">

                        <table class="table">
                            <tbody>
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
                                        <a href="#" class="btn btn-success" style="width:100%" id="filter-atas"><i
                                                class="fa fa-search"></i>
                                            Filter</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tahun</td>
                                    <td>
                                        <select name="tahun" class="form-control" id="tahun">
                                            <option disabled selected>Pilih Periode</option>
                                            @foreach ($years as $item)
                                            <option value="{{ $item->year }}">{{ $item->year }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning excel"><i class="fa fa-print"></i>
                                            Excel</button>
                                        <button class="btn btn-primary print"><i class="fa fa-print"></i> Print</button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <h3>Total Penggajian</h3>
                                    </td>
                                    <td>
                                        <h3 id="sttlpgj">0</h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-default btn-sm lanjut" data-filter="bulan"> Bulan Ini</a>
                        <a href="#" class="btn btn-default btn-sm lanjut" data-filter="tahun"> Tahun Ini</a>
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

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            @include('pages.report.penggajian.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
@push('style')
<link rel="stylesheet"
    href="{{ asset('adminlte') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet"
    href="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/print/print.css">
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/sweetalert2/dist/sweetalert2.css">
@endpush
@push('script')
<script src="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<script src="{{ asset('adminlte') }}/plugins/print/print.js"></script>
<script src="{{ asset('adminlte') }}/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function(){
        $('#sttlpgj').html($('#ttlpgj').html());
        $('#filter-atas').click(function(){
            loadTable($('#bulan').val(),$('#tahun').val());
        });
        $('.print').click(function(){
            bulan = $('#bulan').val();
            tahun = $('#tahun').val();
            let url = `{{ url('report/penggajian/print?bulan=${bulan}&tahun=${tahun}') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            window.open(parsedUrl,'_blank');
        });
        $('.excel').click(function(){
            bulan = $('#bulan').val();
            tahun = $('#tahun').val();
            let url = `{{ url('report/penggajian/excel?bulan=${bulan}&tahun=${tahun}') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            window.open(parsedUrl,'_blank');
        });
        function loadTable(bulan,tahun,lanjut="all"){
            let url = `{{ url('report/penggajian/loadTable?bulan=${bulan}&tahun=${tahun}&lanjut=${lanjut}') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.table-responsive').load(parsedUrl,function(){
                loadKotakAtas();
            });
        }
        function loadKotakAtas(){
            $('#sttlpgj').html($('#ttlpgj').html());
        }
        
        $(document).on('click','.lanjut',function(){
            loadTable("asdasd","asd",$(this).data('filter'));
        });
    });
</script>
@endpush