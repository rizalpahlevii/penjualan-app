@extends('layouts.template')
@section('page','Piutang')
@section('content')
<div class="row kotak-atas">
    @include('pages.report.piutang.kotak')
</div>


<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class=" box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-warning btn-filter" data-filter="refresh"><i class="fa fa-refresh"></i>
                            Refresh</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            @include('pages.report.piutang.table')
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
        $('.print').click(function(){
        
            tanggal_awal = $('#startdate').val();
            tanggal_akhir = $('#enddate').val();
            
            
            let url = `{{ url('report/piutang/print?tanggal_awal=${tanggal_awal}&tanggal_akhir=${tanggal_akhir}') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            window.open(parsedUrl,'_blank');
        });
        $('.excel').click(function(){
        
            tanggal_awal = $('#startdate').val();
            tanggal_akhir = $('#enddate').val();
            
            
            let url = `{{ url('report/piutang/excel?tanggal_awal=${tanggal_awal}&tanggal_akhir=${tanggal_akhir}') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            window.open(parsedUrl,'_blank');
        });
        $('#filter-atas').click(function(){
            if($('#startdate').val()!=""){
                 tanggal_awal = $('#startdate').val();
            }else{
                 tanggal_awal ="all";
            }
            if($('#enddate').val()!=""){
                 tanggal_akhir = $('#enddate').val();
            }else{
                 tanggal_akhir ="all";
            }
            let url = `{{ url('report/piutang/loadTable?tanggal_awal=`+tanggal_awal+`&tanggal_akhir=`+tanggal_akhir+`') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.table-responsive').load(parsedUrl);
        });
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
        
        function loadTable(filter="default"){
            let url = `{{ url('report/piutang/loadTable?filter=`+ filter +`') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.table-responsive').load(parsedUrl);
            loadKotakAtas();
        }
        function loadKotakAtas(filter="default"){
            let url = `{{ route('report.piutang.load_kotak') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.kotak-atas').load(parsedUrl);
        }
        
    });
</script>
@endpush