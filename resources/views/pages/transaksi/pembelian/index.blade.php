@extends('layouts.template')
@section('page','Pembelian')
@section('content')
<div class="row kotak-atas">
    @include('pages.transaksi.pembelian.kotak_atas')
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
                        @if (Session::get('status'))
                        <div class="alert alert-{{ Session::get('status') }}">
                            {{Session::get('message')}}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ route('transaksi.pembelian.create') }}" class="btn btn-primary"><i
                                class="fa fa-shopping-basket"></i> Pembelian Barang</a>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            @include('pages.transaksi.pembelian.table')
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
                <h4 class="modal-title">Data Pembelian</h4>
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
        $('#filter1').click(function(){
            const pelanggan = $('#pelanggan').val();
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
            const status = $('#status').val();
            let url = `{{ url('transaksi/piutang/loadTable?status=`+status+`&tanggal_awal=`+tanggal_awal+`&tanggal_akhir=`+tanggal_akhir+`') }}`;
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
        $(document).on('click','.aksi',function(){
            const id = $(this).data('id');
            let url = `{{ route('transaksi.pembelian.load_modal',':id') }}`;
            url = url.replace(":id",id);
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.bodyModal').load(parsedUrl);
            $('#modal-info').modal('show');
        })
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