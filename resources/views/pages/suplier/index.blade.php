@extends('layouts.template')
@section('page','Suplier')
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
                <a href=" {{ route('suplier.create') }}" class="btn btn-primary mb-2"><i class="fa fa-plus"></i>
                    Tambah
                    Data</a>

                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"
                            id="example-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Suplier</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th>No Hp</th>
                                    <th>Kota</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suplier as $key => $row)
                                <tr>
                                    <td>{{ $key+ $suplier->firstItem() }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->website }}</td>
                                    <td>{{ $row->no_hp }}</td>
                                    <td>{{ $row->kota }}</td>
                                    <td>{!! $row->alamat !!}</td>
                                    <td>
                                        <a href="{{ route('suplier.edit',$row->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <a href="{{ route('suplier.destroy',$row->id) }}" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right">
                            {{ $suplier->links() }}
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
    $(function() {
        $('#example-table').dataTable({
            paging:false
        });
    });
</script>
@endpush