@extends('layouts.template')
@section('page','Edit Pegawai')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class=" box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('pegawai.update',$pegawai->id) }}" method="POST">
                    @csrf
                    @method('PUt')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('nama') has-error @enderror">
                                <label for="nama">Nama Pegawai</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    placeholder="Nama Pegawai...." value="{{ $pegawai->nama }}">
                                @error('nama')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('email') has-error @enderror">
                                <label for="email">Email *optional</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email...."
                                    value="{{ $pegawai->email }}">
                                @error('email')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('no_telp') has-error @enderror">
                                <label for="no_telp">No Telp</label>
                                <input type="number" class="form-control" name="no_telp" id="no_telp"
                                    placeholder="No telp...." value="{{ $pegawai->no_telp}}">
                                @error('no_telp')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('jabatan_id') has-error @enderror">
                                <label for="jabatan_id"> Jabatan</label>
                                <select name="jabatan_id" id="jabatan_id" class="form-control">
                                    <option disabled selected>Pilih Jabatan</option>
                                    @foreach ($jabatan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $pegawai->jabatan_id == $item->id ? 'selected':'' }}>{{ $item->nama }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('jabatan_id')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('alamat') has-error @enderror">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"
                                    placeholder="alamat">{{ $pegawai->alamat }}</textarea>
                                @error('alamat')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" style="cursor:pointer"><i class="fa fa-save"></i>
                        Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
@endpush