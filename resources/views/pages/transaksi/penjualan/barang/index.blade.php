@extends('layouts.template')
@section('page','Penjualan Per Barang')
@section('content')
<div class="row kotak-atas">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class=" box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="well well-sm"><i class="fa fa-info-circle"></i> Laporan Transaksi diambil dari
                            transaksi penjualan tunai dan no tunai
                            yang sudah lunas.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        Kode Barang
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type="text" id="kodeBarang" readonly="">
                                            <span class="input-group-btn showModal">
                                                <button class="btn btn-default" type="button" id="showBarang"><i
                                                        class="fa fa-search" aria-hidden="true"></i>
                                                    Cari</button></span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-success" style="width:100%" id="filter-atas"><i
                                                class="fa fa-search"></i>
                                            Filter</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Awal</td>
                                    <td>
                                        <input type="text" class="form-control" id="startdate"
                                            placeholder="Tanggal awal" autocomplete="off" value="{{ date('Y-m-d') }}">
                                    </td>

                                </tr>
                                <tr>
                                    <td>Tanggal Akhir</td>
                                    <td>
                                        <input type="text" class="form-control" id="enddate" placeholder="Tanggal akhir"
                                            autocomplete="off" value="{{ date('Y-m-d') }}">
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
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="table-responsive" id="loadTable">
                            @include('pages.transaksi.penjualan.barang.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Data Barang</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover dataTable" id="tableBarang" width="100%"
                                cellspacing="0" role="grid" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Jual</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->harga_jual }}</td>
                                        <td>{{ $item->stok_akhir }}</td>
                                        <td><a href="#" class="btn btn-warning btn-sm" id="addBarang"
                                                data-kode="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                                data-harga="{{ $item->harga_jual }}"><i
                                                    class="fa fa-check-square-o"></i> pilih</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close"></i>
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
        // $('#tableBarang').dataTable();
        $('.showModal').click(function(){
            $('#myModal').modal('show');
        });
        $(document).on('click','#addBarang',function(){
            $('#kodeBarang').val($(this).data('kode'));
            $('#myModal').modal('hide');
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
            loadTable($('#kodeBarang').val(), tanggal_awal,tanggal_akhir);
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
        
        function loadTable(barang="all",tanggal_awal,tanggal_akhir){
            let url = `{{ url('transaksi/penjualan/barang/loadTable?barang=${barang}&start=${tanggal_awal}&end=${tanggal_akhir}') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('#loadTable').load(parsedUrl);
        }
        
    });
</script>
@endpush