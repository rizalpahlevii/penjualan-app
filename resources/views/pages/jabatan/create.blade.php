@extends('layouts.template')
@section('page','Tambah Jabatan Pegawai')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class=" box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('jabatan.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('nama') has-error @enderror">
                                <label for="nama">Nama Jabatan</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    placeholder="Nama Jabatan...." value="{{ old('nama') }}">
                                @error('nama')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('gaji_pokok') has-error @enderror">
                                <label for="gaji_pokok">Gaji Pokok</label>
                                <input type="number" class="form-control" name="gaji_pokok" id="gaji_pokok"
                                    placeholder="Gaji Pokok...." value="{{ old('gaji_pokok') }}">
                                @error('gaji_pokok')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('lain_lain') has-error @enderror">
                                <label for="lain_lain">Lain Lain</label>
                                <input type="number" class="form-control" name="lain_lain" id="lain_lain"
                                    placeholder="Lain Lain...." value="{{ old('lain_lain') }}">
                                @error('lain_lain')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('deskripsi') has-error @enderror">
                                <label for="deskripsi">Deskripsi Jabatan</label>
                                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control"
                                    placeholder="Deskripsi Pekerjaan">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" style="cursor:pointer"><i class="fa fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
@endpush
@push('script')
<script src="{{ asset('adminlte') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(document).ready(function(){
        $('#deskripsi').wysihtml5();
    });
</script>
@endpush