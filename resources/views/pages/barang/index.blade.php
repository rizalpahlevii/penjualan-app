@extends('layouts.template')
@section('page','Barang')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        @error('penambahan_stok_masuk')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                        @if (Session::get('status'))
                        <div class="alert alert-{{ Session::get('status') }}">
                            {{Session::get('message')}}</div>
                        @endif
                    </div>
                </div>
                <a href=" {{ route('barang.create') }}" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Tambah
                    Data</a>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"
                                id="example-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Barcode</th>
                                        <th>Nama</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Stok Awal</th>
                                        <th>Stok Masuk</th>
                                        <th>Stok Akhir</th>
                                        <th>Stok Keluar</th>
                                        <th>Satuan</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $key => $row)
                                    <tr>
                                        <td>{{ $key+ $barang->firstItem() }}</td>
                                        <td style="cursor:pointer" data-nama="{{ $row->nama }}" data-id="{{ $row->id }}"
                                            class="showBarcode">
                                            <img src="data:image/png;base64,{{DNS1D::getBarcodePNG(
                                                       $row->id, 'C39')}}" height="40" width="130">
                                        </td>
                                        <td>{{ $row->nama }}</td>
                                        <td> @rupiah($row->harga_beli) </td>
                                        <td> @rupiah($row->harga_jual) </td>
                                        <td>{{ $row->stok_awal }}</td>
                                        <td>{{ $row->stok_masuk }}</td>
                                        <td>{{ $row->stok_akhir }}</td>
                                        <td>{{ $row->stok_keluar }}</td>
                                        <td>{{ $row->satuan->nama }}</td>
                                        <td>{{ $row->kategori->nama }}</td>
                                        <td>
                                            {{-- <a href="#" class="btn btn-info btn-sm tmb-stok" data-id="{{ $row->id }}">Tambah
                                            Stok</a> --}}
                                            <a href="{{ route('barang.edit',$row->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <a href="{{ route('barang.destroy',$row->id) }}"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pull-right">
                                {{ $barang->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalBarcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Barcode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-2 mt-2">
                    <div class="col-md-12" id="contentShowBarcode"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahStokMasuk">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#" method="POST" id="form-tambah-stok">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title-mtsm">Tambah Stok Masuk</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" name="nama_barang" id="nama_barang" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stok_awal">Stok Awal</label>
                                <input type="text" name="stok_awal" id="stok_awal" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stok_keluar">Stok Keluar</label>
                                <input type="text" name="stok_keluar" id="stok_keluar" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stok_masuk">Stok Masuk</label>
                                <input type="number" name="stok_masuk" id="stok_masuk" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stok_akhir">Stok Akhir Saat Ini</label>
                                <input type="text" name="stok_akhir" id="stok_akhir" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penambahan_stok_masuk">Penambahan Stok Masuk</label>
                                <input type="number" name="penambahan_stok_masuk" id="penambahan_stok_masuk"
                                    class="form-control" placeholder="Masukkan value penambahan stok" min="1"
                                    max="10000">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jumlah_stok_akhir">Jumlah Stok Akhir</label>
                                <input type="text" name="jumlah_stok_akhir" id="jumlah_stok_akhir" class="form-control"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
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
<!-- SlimScroll -->
<script type="text/javascript">
    $(function() {
        
        $(document).on('click','.showBarcode',function(){
            barcode = $(this).first().html();
            nama = $(this).data('nama');
            barcode = barcode.replace("40",100);
            barcode = barcode.replace("130",400);
            $('#contentShowBarcode').html(barcode);
            $('#exampleModalCenterTitle').html(`Barcode Barang : ${nama}`)
            $('#modalBarcode').modal('show')
        });
        $('#example-table').dataTable({
            paging:false
        });
    });
</script>
@endpush