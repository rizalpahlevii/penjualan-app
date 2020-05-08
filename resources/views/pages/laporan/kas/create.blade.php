@extends('layouts.template')
@section('page','Tambah Kas')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('transaksi.kas.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="faktur">Faktur</label>
                                <input type="text" name="faktur" id="faktur" value="{{ $faktur }}" readonly
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal">tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipe">Tipe</label>
                                <select name="tipe" id="tipe" class="form-control">
                                    <option disabled selected>Pilih</option>
                                    <option value="pendapatan">Pemasukan</option>
                                    <option value="pengeluaran">Pengeluaran</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pemasukan">Pemasukan</label>
                                <input type="text" name="pemasukan" id="pemasukan" value="0" readonly
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pengeluaran">Pengeluaran</label>
                                <input type="text" name="pengeluaran" id="pengeluaran" value="0" readonly
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row kotak-jenis-pengeluaran" style="display: none">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_pengeluaran">Jenis Pengeluaran</label>
                                <select name="jenis_pengeluaran" id="jenis_pengeluaran" class="form-control">
                                    <option disabled selected>Pilih</option>
                                    <option value="kas akhir">Kas Akhir</option>
                                    <option value="pengeluaran lain">Pengeluaran Lain</option>
                                    <option value="biaya">Biaya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row kotak-jenis-pemasukan" style="display: none">>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_pemasukan">Jenis Pemasukan</label>
                                <select name="jenis_pemasukan" id="jenis_pemasukan" class="form-control">
                                    <option disabled selected>Pilih</option>
                                    <option value="kas awal">Kas Awal</option>
                                    <option value="pemasukan lain">Pemasukan Lain</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i>
                                Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    $(document).ready(function(){
        $('#tipe').change(function(){
            value = $(this).val();
            if(value == "pendapatan"){
                $('.kotak-jenis-pemasukan').css({display:"block"});
                $('.kotak-jenis-pengeluaran').css({display:"none"});
                $('#pengeluaran').attr('readonly','readonly');
                $('#pemasukan').removeAttr('readonly');
            }else{
                $('.kotak-jenis-pemasukan').css({display:"none"});
                $('.kotak-jenis-pengeluaran').css({display:"block"});
                $('#pemasukan').attr('readonly','readonly');
                $('#pengeluaran').removeAttr('readonly');
            }
        })
    });
</script>
@endpush