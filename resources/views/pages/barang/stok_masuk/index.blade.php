@extends('layouts.template')
@section('page','Stok Masuk')
@section('content')
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
                <a href="{{ route('barang.masuk.create') }}" class="btn btn-primary mb-2"><i class="fa fa-plus"></i>
                    Tambah
                    Data</a>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"
                                id="example-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Barcode</th>
                                        <th>Nama Barang</th>
                                        <th>Stok Masuk</th>
                                        <th>Tanggal</th>
                                        <th>Suplier</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($histories as $key => $row)
                                    <tr>
                                        <td>{{ $key+ $histories->firstItem() }}</td>
                                        <td>{{ $row->barang->id }}</td>
                                        <td>{{ $row->barang->nama }}</td>
                                        <td>{{ $row->qty }}</td>
                                        <td>{{ $row->created_at->format('Y-m-d') }}</td>
                                        <th>{{ $row->suplier ? $row->suplier->nama : '' }}</th>
                                        <td>{{ $row->keterangan }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="pull-right">
                            {{ $histories->links() }}
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
@endpush
@push('script')
<script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<!-- SlimScroll -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#example-table').dataTable({paging:false});
    });
</script>
@endpush