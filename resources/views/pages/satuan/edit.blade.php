@extends('layouts.template')
@section('page','Edit Satuan')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class=" box-header with-border">
            <i class="fa fa-bar-chart-o"></i>
            <h3 class="box-title">@yield('page')</h3>
        </div>
        <div class="box-body">
            <form action="{{ route('satuan.update',$satuan->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @error('nama') has-error @enderror">
                            <label for="nama">Nama Satuan</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Satuan...."
                                value="{{ $satuan->nama }}">
                            @error('nama')
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