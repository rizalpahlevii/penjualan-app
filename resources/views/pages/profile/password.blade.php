@extends('layouts.template')
@section('page','Ganti Password')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-danger">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('profile.update_password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            @if (Session::has('status'))
                            <div class="alert alert-{{ Session::get('status') }}" role="alert">
                                {{ Session::get('message') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('old_password') has-error @enderror">
                                <label for="old_password">Password Lama</label>
                                <input type="password" name="old_password" id="old_password" class="form-control">
                                @error('old_password')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('password') has-error @enderror">
                                <label for="password">Password Baru</label>
                                <input type="password" name="password" id="password" class="form-control">
                                @error('password')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('password_confirmation') has-error @enderror">
                                <label for="password_confirmation">Password Konfirmasi</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
                                @error('password_confirmation')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary" value="Ganti Password">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection