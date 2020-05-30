@extends('layouts.template')
@section('page','Setting Toko')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-danger">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            @if (Session::has('status'))
                            <div class="alert alert-{{ Session::get('status') }}" role="alert">
                                {{ Session::get('message') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-5 mt-5">
                        <div class="col-md-4">
                            <label for="logo">Logo</label>
                            <img src="{{ asset('asset_toko') }}/{{$data['logo']}}" alt="" style="width: 70px;">
                        </div>
                       <div class="col-md-6">
                            <div class="form-group @error('logo') has-error @enderror">
                                <label for="logo">Logo </label>
                                <input type="file" name="logo" id="logo" class="form-control" value="{{ $data['logo']  }}">
                                <p>Ektensi file (.png)</p>
                                @error('logo')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('nama_toko') has-error @enderror">
                                <label for="nama_toko">Nama Toko</label>
                                <input type="text" name="nama_toko" id="nama_toko" class="form-control" value="{{ $data['nama_toko']  }}">
                                @error('nama_toko')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('alamat') has-error @enderror">
                                <label for="alamat">Alamat Toko</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $data['alamat']  }}">
                                @error('alamat')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('email') has-error @enderror">
                                <label for="email">Email Toko</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ $data['email']  }}">
                                @error('email')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group @error('no_hp') has-error @enderror">
                                <label for="no_hp">No HP Toko</label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $data['no_hp']  }}">
                                @error('no_hp')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('nama_bank') has-error @enderror">
                                <label for="nama_bank">Nama Bank</label>
                                <input type="text" name="nama_bank" id="nama_bank" class="form-control" value="{{ $data['nama_bank']  }}">
                                @error('nama_bank')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('nama_rekening') has-error @enderror">
                                <label for="nama_rekening">Nama Rekening</label>
                                <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" value="{{ $data['nama_rekening']  }}">
                                @error('nama_rekening')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('no_rekening') has-error @enderror">
                                <label for="no_rekening">Nomor Rekening</label>
                                <input type="text" name="no_rekening" id="no_rekening" class="form-control" value="{{ $data['no_rekening']  }}">
                                @error('no_rekening')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('struk_salam_hormat') has-error @enderror">
                                <label for="struk_salam_hormat">Nama Salam Hormat di Struk</label>
                                <input type="text" name="struk_salam_hormat" id="struk_salam_hormat" class="form-control" value="{{ $data['struk_salam_hormat']  }}">
                                @error('struk_salam_hormat')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('website') has-error @enderror">
                                <label for="website">Website</label>
                                <input type="text" name="website" id="website" class="form-control" value="{{ $data['website']  }}">
                                @error('website')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection