@extends('layouts.template')
@section('page','Jabatan Pegawai')
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
                <a href="{{ route('jabatan.create') }}" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Tambah
                    Data</a>
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Jabatan</th>
                                    <th>Gaji Pokok</th>
                                    <th>Lain - Lain</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jabatan as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>@rupiah($row->gaji_pokok)</td>
                                    <td>@rupiah($row->lain_lain)</td>
                                    <td>{!! $row->deskripsi !!}</td>
                                    <td>
                                        <a href="{{ route("jabatan.edit",$row->id) }}" class="btn btn-warning btn-sm"><i
                                                class="fa fa-edit"></i> Edit</a>
                                        <a href="{{ route("jabatan.destroy",$row->id) }}"
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
@endsection