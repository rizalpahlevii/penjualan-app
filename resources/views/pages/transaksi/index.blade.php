@extends('layouts.template')
@section('page','Transaksi')
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
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Input
                Transaksi</a>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"
                        id="example-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Diskon</th>
                                <th>Pph</th>
                                <th>Ppn</th>
                                <th>Status</th>
                                <th>Pelanggan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $key => $row)
                            <tr>
                                <td>{{ $key+ $transaksi->firstItem() }}</td>
                                <td>{{ $row->kode }}</td>
                                <td>{{ $row->tanggal_transaksi }}</td>
                                <td>{{ $row->total }}</td>
                                <td>{{ $row->diskon }}</td>
                                <td>{{ $row->pph }}</td>
                                <td>{{ $row->ppn }}</td>
                                <td>{{ $row->status }}</td>
                                <td>{{ $row->pelanggan->nama }}</td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right">
                        {{ $transaksi->links() }}
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
<script>
    $(document).ready(function(){
        $('#example-table').dataTable({
            paging:false
        });
    });
</script>
@endpush