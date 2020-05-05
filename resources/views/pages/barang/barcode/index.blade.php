@extends('layouts.template')
@section('page','Barcode')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class=" box-header with-border">
                <i class="fa fa-barcode"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width:250px">

                                        <div class="input-group">
                                            <input class="form-control" type="text" id="kodeBarang" readonly=""
                                                placeholder="Kode Barang">
                                            <span class="input-group-btn showModal">
                                                <button class="btn btn-default" type="button" id="showBarang"><i
                                                        class="fa fa-search" aria-hidden="true"></i>
                                                    Cari</button></span>
                                        </div>


                                        <input style="margin-top:5px" class="form-control" type="text" id="namaBarang"
                                            readonly placeholder="Nama Barang">


                                        <input style="margin-top:5px" class="form-control" type="text" id="hargaJual"
                                            readonly placeholder="Harga Jual">


                                        <div class="input-group" style="margin-top:5px">
                                            <span class="input-group-btn"><button class="btn btn-default"
                                                    type="button">Jumlah</button></span>
                                            <input class="form-control" type="number" id="qty" value="1"
                                                style="width:100px;text-align:center">
                                        </div>


                                        <a class="btn btn-warning" href="#" id="showBarcodes" style="margin-top:5px"><i
                                                class="fa fa-check" aria-hidden="true"></i>
                                            Tampilkan Barcode</a>
                                    </td>
                                    <td>
                                        <div class="row" id="createElement">

                                        </div>
                                        {{-- <div id="getBarcode"></div> --}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Data Barang</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover dataTable" id="tableBarang" width="100%"
                                cellspacing="0" role="grid" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Jual</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->harga_jual }}</td>
                                        <td>{{ $item->stok_akhir }}</td>
                                        <td><a href="#" class="btn btn-warning btn-sm" id="addBarang"
                                                data-kode="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                                data-harga="{{ $item->harga_jual }}"><i
                                                    class="fa fa-check-square-o"></i> pilih</a>
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
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close"></i>
                    Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
<link rel="stylesheet"
    href="{{ asset('adminlte') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/print/print.css">
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/sweetalert2/dist/sweetalert2.css">
@endpush
@push('script')
<script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<script src="{{ asset('adminlte') }}/plugins/print/print.js"></script>
<script src="{{ asset('adminlte') }}/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('adminlte') }}/plugins/barcode/barcode.min.js"></script>
<script>
    $(document).ready(function(){
        $('#tableBarang').dataTable();
        $('.showModal').click(function(){
            $('#myModal').modal('show');
        });
        $(document).on('click','#addBarang',function(){
            $('#kodeBarang').val($(this).data('kode'));
            $('#namaBarang').val($(this).data('nama'));
            $('#hargaJual').val($(this).data('harga'));
            $('#myModal').modal('hide');
        });
        $('#showBarcodes').click(function(){
            $('#createElement').html('');
            jumlah = $('#qty').val();
            kode = $('#kodeBarang').val();
            html = '';
            for (let i = 1; i <= jumlah; i++) {
                html += `<div class="col-md-4" id="div${i}"><svg id="barcode${i}"></svg></div>`;
            }
            $('#createElement').html(html)
            JsBarcode('#barcode1',kode,{
                text : $('#namaBarang').val(),
                textPosition : "top",
                width :2,

            });
            if(jumlah > 1){
                getElement = $('#div1').html();
                html2 = '';
                for (let i = 1; i <= jumlah; i++) {
                    html2+=getElement;
                }
                $('#createElement').html(html2);
            }
            print();
        });       
        function print() {
            printJS({
                printable: 'createElement',
                type: 'html',
                targetStyles: ['*']
            })
        }
    });
</script>
@endpush