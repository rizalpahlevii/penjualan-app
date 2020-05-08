@extends('layouts.template')
@section('page','Pegawai')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        @if (Session::has('status'))
                        <div class="alert alert-{{ Session::get('status') }}" role="alert">{{ Session::get('message') }}
                        </div>
                        @endif
                    </div>
                </div>
                <a href="{{ route('pegawai.create') }}" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Tambah
                    Data</a>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="example-table"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No HP</th>
                                        <th>Jabatan</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pegawai as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->nama }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->no_telp }}</td>
                                        <td>{{ $row->jabatan->nama }}</td>
                                        <td>{!! $row->alamat !!}</td>
                                        <td>
                                            <a href="{{ route("pegawai.edit",$row->id) }}"
                                                class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="{{ route("pegawai.destroy",$row->id) }}"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    $(document).ready(function() {
        $('#example-table').dataTable();
    });
</script>
@endpush