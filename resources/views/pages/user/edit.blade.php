@extends('layouts.template')
@section('page','Tambah User')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('user.update',$user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('nama') has-error @enderror">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama "
                                    value="{{ $user->nama }}">
                                @error('nama')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('username') has-error @enderror">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username"
                                    placeholder="Username " value="{{ $user->username }}">
                                @error('username')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('email') has-error @enderror">
                                <label for="email">Email *(optional)</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="email "
                                    value="{{ $user->email }}">
                                @error('email')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('password') has-error @enderror">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="password " value="{{ old('password') }}">
                                @error('password')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('level') has-error @enderror">
                                <label for="level">Level</label>
                                <select name="level" id="level" class="form-control">
                                    <option disabled selected>Pilih Level</option>
                                    <option value="Admin" {{ ($user->level == "Admin") ? "selected":"" }}>Admin</option>
                                    <option value="Petugas" {{ ($user->level == "Petugas") ? "selected":"" }}>Petugas
                                    </option>
                                    <option value="Manager" {{ ($user->level == "Manager") ? "selected":"" }}>Manager
                                    </option>
                                </select>
                                @error('password')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <p class="text-danger">Nb : Kosongkan field password jika tidak ingin mengganti password</p>

                    <button class="btn btn-primary" style="cursor:pointer"><i class="fa fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection