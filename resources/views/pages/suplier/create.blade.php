@extends('layouts.template')
@section('page','Tambah Suplier')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class=" box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('suplier.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('nama') has-error @enderror">
                                <label for="nama">Nama Suplier</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    placeholder="Nama Suplier...." value="{{ old('nama') }}">
                                @error('nama')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('email') has-error @enderror">
                                <label for="email">Email *Optional</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Email Suplier...." value="{{ old('email') }}">
                                @error('email')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('no_hp') has-error @enderror">
                                <label for="no_hp">No HP</label>
                                <input type="text" class="form-control" name="no_hp" id="no_hp"
                                    placeholder="No Hp Suplier...." value="{{ old('no_hp') }}">
                                @error('no_hp')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('website') has-error @enderror">
                                <label for="website">Website *Optional</label>
                                <input type="text" class="form-control" name="website" id="website"
                                    placeholder="Website Suplier...." value="{{ old('website') }}">
                                @error('website')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('kota') has-error @enderror">
                                <label for="kota">Kota</label>
                                <input type="text" class="form-control" name="kota" id="kota"
                                    placeholder="Kota Suplier...." value="{{ old('kota') }}">
                                @error('kota')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('no_hp') has-error @enderror">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"
                                    placeholder="Alamat....">{{ old('alamat') }}</textarea>
                                @error('alamat')
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
        $('#alamat').wysihtml5();
    });
</script>
@endpush