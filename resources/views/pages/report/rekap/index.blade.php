@extends('layouts.template')
@section('page','Rekap')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tanggal Awal</td>
                                    <td>
                                        <input title="tanggal transaksi" class="form-control datepicker-here"
                                            type="text" id="startdate" data-language="en" autocomplete="off"
                                            value="{{ date('Y-m-d') }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Akhir</td>

                                    <td>
                                        <input title="tanggal transaksi" class="form-control datepicker-here"
                                            type="text" id="enddate" data-language="en" autocomplete="off"
                                            value="{{ date('Y-m-d') }}">
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="btn btn-success" style="width:100%" id="filter1"><i
                                                class="fa fa-search"></i>
                                            Filter</a>
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

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="#" class="btn btn-warning mb-3" id="refresh"><i class="fa fa-refresh"></i>
                            Refresh</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            @include('pages.report.rekap.table')
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
@endpush
@push('script')
<script src="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js">
</script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<script>
    $(document).ready(function(){
        $("#startdate").datepicker({
            todayBtn: 1,
            format : 'yyyy-mm-dd',
            autoclose: true,
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#enddate').datepicker('setStartDate', minDate);
        });
        $("#enddate").datepicker({format : 'yyyy-mm-dd'}).on('changeDate', function (selected) {
            var maxDate = new Date(selected.date.valueOf());
            $('#startdate').datepicker('setEndDate', maxDate);
        });
        $('#filter1').click(function(){
            if($('#startdate').val() == "" || $('#enddate').val() == ""){
                alert('Form filter tidak boleh kosong');
                return;
            }
            loadTable("custom");
        });
        $('.print').click(function(){
           
            tanggal_awal = $('#startdate').val();
            tanggal_akhir = $('#enddate').val();
            
            
            let url = `{{ url('report/rekap/print?tanggal_awal=${tanggal_awal}&tanggal_akhir=${tanggal_akhir}') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            window.open(parsedUrl,'_blank');
        });
        $('.excel').click(function(){
            
            tanggal_awal = $('#startdate').val();
            tanggal_akhir = $('#enddate').val();
            
            
            let url = `{{ url('report/rekap/excel?tanggal_awal=${tanggal_awal}&tanggal_akhir=${tanggal_akhir}') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            window.open(parsedUrl,'_blank');
        });
        function loadTable(filter){
            tanggal_awal = $('#startdate').val();
            tanggal_akhir = $('#enddate').val();
            
            if(filter=="all"){
                filter = filter;
            }else{
                filter="custom";
            }

            let url = `{{ url('/report/rekap/loadTable?filter=`+filter+`&tanggal_awal=`+tanggal_awal+`&tanggal_akhir=`+tanggal_akhir+`') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.table-responsive').load(parsedUrl);
           
        }
       
        $("#refresh").click(function(){
            loadTable("all");
        });
    });
</script>
@endpush