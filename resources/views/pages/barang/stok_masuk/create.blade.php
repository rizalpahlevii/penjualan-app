@extends('layouts.template')
@section('page','Input Stok Masuk')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('barang.masuk.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('barcode') has-error @enderror">
                                <label for="barcode">Barcode</label>
                                <div class="input-group " style="cursor:pointer">
                                    <input type="text" class="form-control timepicker" name="barcode" id="barcode"
                                        placeholder="Barcode" value="{{ old('barcode') }}">
                                    <div class="input-group-addon showModal">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                @error('barcode')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('nama_barang') has-error @enderror">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang"
                                    placeholder="Nama Barang" value="{{ old('nama_barang') }}" readonly>
                                @error('nama_barang')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('stok_saat_ini') has-error @enderror">
                                <label for="stok_saat_ini">Stok Saat Ini</label>
                                <input type="text" class="form-control" name="stok_saat_ini" id="stok_saat_ini"
                                    placeholder="Stok Saat ini" value="{{ old('stok_saat_ini') }}" readonly>
                                @error('stok_saat_ini')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('satuan') has-error @enderror">
                                <label for="satuan">Satuan Barang</label>
                                <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan"
                                    Barang value="{{ old('satuan') }}" readonly>
                                @error('satuan')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('qty') has-error @enderror">
                                <label for="qty">Quantity</label>
                                <input type="number" class="form-control" name="qty" id="qty" placeholder="Quantity"
                                    value="{{ old('qty') }}" min="1" max="123123">
                                @error('qty')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group @error('kategori') has-error @enderror">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" id="keterangan"
                                    placeholder="keterangan" Barang value="{{ old('keterangan') }}">
                                @error('keterangan')
                                <span class=" help-block">{{ $message }}</span>
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


<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Data Barang</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered hover table-stripped" id="table-modal">
                                <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Nama Barang</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->satuan->nama }}</td>
                                        <td>{{ $item->harga_jual }}</td>
                                        <td>{{ $item->stok_akhir }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm btn-pilih"
                                                data-id="{{ $item->id }}">Pilih</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
@push('style')
<link rel="stylesheet"
    href="{{ asset('adminlte') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush
@push('script')
<script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>

<script>
    $(document).ready(function(){
        $('#table-modal').dataTable();
        $('.showModal').click(function(){
            $('#modal-default').modal('show');
        });
        $(document).on('click','.btn-pilih',function(){
            barcode = $(this).data('id');
            getBarangById(barcode,"modal");
        });
        $('#barcode').keypress(function(e){
            if (e.keyCode === 13) {
                getBarangById($(this).val(),"scanner");
            }
        });
        $('#barcode').keyup(function(){
            if($(this).val() != ""){
                getBarangById($(this).val());
            }else{
                clearFormBarang();
            }
        });
        function getBarangById(kode,from="keyup"){
            let url = "{{ route('kasir.getBarangById',':id') }}";
            url = url.replace(":id",kode);
            if(kode != ""){
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function (response) {
                        if(response != "no result"){
                            $('#barcode').val(response.id);
                            $('#nama_barang').val(response.nama);
                            $('#harga').val(response.harga_jual);
                            $('#satuan').val(response.satuan.nama);
                            $('#stok_saat_ini').val(response.stok_akhir);
                            if(from == "scanner"){
                                $('#kode_barang').val('');
                            }else if(from == "modal"){
                                $('#modal-default').modal('hide');
                            }
                        }else{
                            if(from == "scanner"){
                                alert('Data tidak ditemukan!');
                                $('#kode_barang').val('');
                            }
                            clearFormBarang()
                        }
                    }
                });
            }
        }
        function clearFormBarang(){
            $('#nama_barang').val('');
            $('#harga').val('');
            $('#satuan').val('');
            $('#stok_saat_ini').val('');
        }
    });
</script>
@endpush