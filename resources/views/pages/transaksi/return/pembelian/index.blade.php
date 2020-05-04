@extends('layouts.template')
@section('page','Return Penjualan')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class=" box-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tanggal Awal</td>
                                    <td>
                                        <input title="tanggal transaksi" class="form-control datepicker-here"
                                            type="text" id="startdate" data-language="en" autocomplete="off">
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Akhir</td>

                                    <td>
                                        <input title="tanggal transaksi" class="form-control datepicker-here"
                                            type="text" id="enddate" data-language="en" autocomplete="off">
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
                        <div id="totalPiutang">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h3>Total Return Pembelian</h3>
                                        </td>
                                        <td>
                                            <h3>@rupiah($total)</h3>
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
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class=" box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <a href="{{ route('transaksi.return.pembelian.create') }}" class="btn btn-primary mb-2"><i
                        class="fa fa-shopping-basket"></i> Return Penjualan</a>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            @include('pages.transaksi.return.pembelian.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal-info" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Return Penjualan</h4>
            </div>
            <div class="modal-body bodyModal">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-print"><i class="fa fa-print"></i>
                    Print</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-window-close"></i>
                    Tutup</button>
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
        $('#example-table').dataTable();
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
            let url =
            `{{ url('transaksi/return/penjualan/loadTable?tanggal_awal=`+tanggal_awal+`&tanggal_akhir=`+tanggal_akhir+`') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.table-responsive').load(parsedUrl);
        });
        function loadTable(filter="default"){
            let url = `{{ url('transaksi/return/penjualan/loadTable') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.table-responsive').load(parsedUrl);
        }
        $(document).on('click','.info',function(){
            let url = `{{ route('transaksi.return.penjualan.load_modal',':id') }}`;
            url = url.replace(":id",$(this).data('id'));
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.bodyModal').load(parsedUrl);
            $('#modal-info').modal('show');
        });
        $('.btn-print').click(function(){
            print();
        });
        function print() {
            printJS({
                printable: 'printArea',
                type: 'html',
                targetStyles: ['*']
            })
        }
    });
</script>
@endpush