@extends('layouts.template')
@section('page','Tambah Barang')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <div class="ibox-title">@yield('page')</div>
            </div>
            <div class="box-body">
                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group @error('kode_barang') has-error @enderror">
                                <label for="kode_barang">Kode Barang</label>
                                <input type="text" class="form-control" name="kode_barang" id="kode_barang"
                                    placeholder="Kode Barang" readonly value="{{ $kodeBarang }}">
                                @error('kode_barang')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group @error('nama_barang') has-error @enderror">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang"
                                    placeholder="Nama Barang" value="{{ old('nama_barang') }}">
                                @error('nama_barang')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group @error('harga_jual') has-error @enderror">
                                <label for="harga_jual">Harga Jual</label>
                                <input type="text" class="form-control " name="harga_jual" id="harga_jual"
                                    placeholder="Harga Jual" value="{{ old('harga_jual') }}">
                                @error('harga_jual')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group @error('harga_beli') has-error @enderror">
                                <label for="harga_beli">Harga Beli</label>
                                <input type="text" class="form-control " name="harga_beli" id="harga_beli"
                                    placeholder="Harga Beli" value="{{ old('harga_beli') }}">
                                @error('harga_beli')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group @error('stok_awal') has-error @enderror">
                                <label for="stok_awal">Stok Awal</label>
                                <input type="text" class="form-control " name="stok_awal" id="stok_awal"
                                    placeholder="Harga Beli" value="{{ old('stok_awal') }}">
                                @error('stok_awal')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group @error('satuan') has-error @enderror">
                                <label for="satuan">Satuan Barang</label>
                                <select name="satuan" id="satuan"
                                    class="form-control @error('satuan') is-invalid @enderror">
                                    @foreach ($satuan as $rowSatuan)
                                    <option disabled selected>Pilih Satuan Barang</option>
                                    <option value="{{ $rowSatuan->id }}">{{ $rowSatuan->nama }}</option>
                                    @endforeach
                                </select>
                                @error('satuan')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group @error('kategori') has-error @enderror">
                                <label for="kategori">Kategori Barang</label>
                                <select name="kategori" id="kategori"
                                    class="form-control @error('kategori') is-invalid @enderror">
                                    @foreach ($kategori as $rowKategori)
                                    <option disabled selected>Pilih Kategori Barang</option>
                                    <option value="{{ $rowKategori->id }}">{{ $rowKategori->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                <label class="help-block error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" style="cursor:pointer"><i class="fa fa-save"></i> Simpan</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-warning"><i class="fa fa-backward"></i>
                        Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection