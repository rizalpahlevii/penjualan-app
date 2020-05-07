@extends('layouts.template')
@section('page','Laba Rugi')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="well well-sm"><i class="fa fa-info-circle"></i> Laba Rugi merupakan hasil selisih
                            <b>Harga Jual - Harga
                                Modal (HPP)</b>. Laporan Laba Rugi diambil dari transaksi penjualan tunai dan no tunai
                            yang sudah lunas.</div>
                    </div>
                </div>
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
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Akhir</td>

                                    <td>
                                        <input title="tanggal transaksi" class="form-control datepicker-here"
                                            type="text" id="enddate" data-language="en" autocomplete="off"
                                            value="{{ date('Y-m-d') }}">
                                    </td>

                                    <td>
                                        <a href="#" class="btn btn-success" style="width:100%" id="filter1"><i
                                                class="fa fa-search"></i>
                                            Filter</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div id="totalLabaRugi">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Penjualan </td>
                                        <td> <span style="float:right" id="sttlpnj">6,095,567 </span></td>
                                    </tr>
                                    <tr>
                                        <td>HPP</td>
                                        <td> <span style="float:right" id="sttlhpp">4,998,527 </span></td>
                                    </tr>
                                    <tr>
                                        <td>Laba Rugi<br></td>
                                        <td> <span style="float:right" id="sttllaba"> 1,097,040 </span></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
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
                <div class="row">
                    <div class="col-md-6">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 ">
                        <div class="table-responsive">
                            @include('pages.laporan.labarugi.table')
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
<script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<script src="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<!-- SlimScroll -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#sttlpnj').html($('#ttlpnj').html());
        $('#sttlhpp').html($('#ttlhpp').html());
        $('#sttllaba').html($('#ttllaba').html());
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
        $('#example-table').dataTable();
        $("#filter1").click(function(){
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

           loadTable(tanggal_awal,tanggal_akhir);
        });
        function loadTable(tanggal_awal,tanggal_akhir){
            let url =
            `{{ url('laporan/labarugi/loadTable?tanggal_awal=`+tanggal_awal+`&tanggal_akhir=`+tanggal_akhir+`') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.table-responsive').load(parsedUrl,function () { 
                loadKotakAtas();
             });
        }
        function loadKotakAtas(){
            $('#sttlpnj').html($('#ttlpnj').html());
            $('#sttlhpp').html($('#ttlhpp').html());
            $('#sttllaba').html($('#ttllaba').html());
        }
    });
</script>
@endpush