@extends('layouts.template')
@section('page','Edit Barang')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <div class="ibox-title">@yield('page')</div>
            </div>
            <div class="box-body">
                <form action="{{ route('barang.update',$barang->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group @error('kode_barang') has-error @enderror">
                                <label for=" kode_barang">Kode Barang</label>
                                <input type="text" class="form-control 
                                    name=" kode_barang" id="kode_barang" placeholder="Kode Barang" readonly
                                    value="{{ $barang->id }}">
                                @error('kode_barang')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group @error('nama_barang') has-error @enderror">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control " name="nama_barang" id="nama_barang"
                                    placeholder="Harga Jual" value="{{ $barang->nama }}">
                                @error('nama_barang')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group @error('harga_beli') has-error @enderror">
                                <label for="harga_beli">Harga Beli</label>
                                <input type="text" class="form-control " name="harga_beli" id="harga_beli"
                                    placeholder="Harga Beli" value="{{ $barang->harga_beli }}">
                                @error('harga_beli')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group @error('ppn_pph') has-error @enderror">
                                <label for="ppn_pph">PPN, PPH dan Keuntungan (%)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control " name="ppn_pph" id="ppn_pph"
                                        placeholder="PPN, PPH dan Keuntungan"
                                        value="{{ $barang->persentase_pph_ppn_keuntungan }}" min="1" max="100">
                                    <span class="input-group-addon">%</span>
                                </div>

                                @error('ppn_pph')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group @error('harga_jual') has-error @enderror">
                                <label for="harga_jual">Harga Jual</label>
                                <input type="text" class="form-control " name="harga_jual" id="harga_jual"
                                    placeholder="Harga Jual" value="{{ $barang->harga_jual }}">
                                @error('harga_jual')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group @error('kategori') has-error @enderror">
                                <label for="kategori">Kategori Barang</label>
                                <select name="kategori" id="kategori" class="form-control ">
                                    <option disabled selected>Pilih Kategori Barang</option>
                                    @foreach ($kategori as $rowKategori)
                                    <option value="{{ $rowKategori->id }}"
                                        {{ $barang->kategori_id == $rowKategori->id ? 'selected':'' }}>
                                        {{ $rowKategori->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group @error('satuan') has-error @enderror">
                                <label for="satuan">Satuan Barang</label>
                                <select name="satuan" id="satuan" class="form-control ">
                                    <option disabled selected>Pilih Satuan Barang</option>
                                    @foreach ($satuan as $rowSatuan)
                                    <option value="{{ $rowSatuan->id }}"
                                        {{ $barang->satuan_id == $rowSatuan->id ? 'selected':'' }}>
                                        {{ $rowSatuan->nama }}</option>
                                    @endforeach
                                </select>
                                @error('satuan')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" style="cursor:pointer"><i class="fa fa-save"></i> Ubah</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-warning"><i class="fa fa-backward"></i>
                        Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function(){
        $('#harga_beli').keyup(function(){
            const harga_beli = $(this).val();
            if(harga_beli == ""){
                $('#harga_jual').val(0);
                return;
            }
            const ppn_pph = $('#ppn_pph').val();
            const result = (parseFloat(harga_beli) / 100) * parseFloat(ppn_pph);
            $('#harga_jual').val(parseFloat(result) + parseFloat(harga_beli));
        });
        $('#ppn_pph').keyup(function(){
            const harga_beli = $('#harga_beli').val();
            const ppn_pph = $(this).val();
            
            if(parseFloat(ppn_pph) > 100){
                alert('Presentase melebihi 100%');
                $(this).val(0);
            }
            if(ppn_pph == ""){
                $('#harga_jual').val(harga_beli);
                return;
            }
            const result = (parseFloat(harga_beli) / 100) * parseFloat(ppn_pph);
            $('#harga_jual').val(parseFloat(result) + parseFloat(harga_beli));
        });
    });
</script>
@endpush