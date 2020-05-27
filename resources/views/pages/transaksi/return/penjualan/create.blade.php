@extends('layouts.template')
@section('page','Return Penjualan')
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="box box-danger">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="faktur">Faktur</label>
                            <input type="text" name="faktur" id="faktur" class="form-control" value="{{ $faktur }}"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ date('Y-m-d') }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-danger">
            <div class=" box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kode_transaksi">Kode Transaksi</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="kode_transaksi" id="kode_transaksi">

                                <div class="input-group-addon showModalTransaksi" style="cursor:pointer">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tanggal_transaksi">Tanggal Transaksi</label>
                            <input type="text" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="pelanggan">Pelanggan</label>
                            <input type="text" name="pelanggan" id="pelanggan" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="box box-danger"">
            <div class=" box-body">
            <div align="right">
                <h1><b><span id="grand_total2" style="font-size:50pt;">0</span></b></h1>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class=" box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="loadDataTransaksi">
                                    <tr>
                                        <td colspan="6" class="text-danger">
                                            <center>Tidak ada data</center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table style="background:#ccc;padding:5px;width:100%">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <input type="hidden" name="qty_akhir" id="qty_akhir">
                                            <input type="hidden" name="qty_detail" id="qty_detail">
                                            <span class="input-group-btn"><button class="btn " type="button">Kode Barang
                                                </button></span>
                                            <input class="form-control" type="text" id="kodeBarang" title="kode barang">

                                            <span class="input-group-btn"><button class="btn " type="button">Nama Barang
                                                </button></span>
                                            <input class="form-control" type="text" id="namaBarang" title="nama barang">


                                            <span class="input-group-btn"><button class="btn "
                                                    type="button">Qty</button></span>
                                            <input style="text-align:center" class="form-control" type="number" id="qty"
                                                title="jumlah barang">


                                            <span class="input-group-btn"><button class="btn btn-primary" type="button"
                                                    id="addCart"><i class="fa fa-check-square-o"></i>
                                                    Tambah</button></span>
                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h3>Data Return</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover tableReturn">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Jumlah Dikembalikan</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                                <tbody id="loadDataReturn"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary pull-right btn-submit">Submit</button>
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
                <h4 class="modal-title">Data Transaksi</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="table_transaksi">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Invoice</th>
                                        <th>Penjualan</th>
                                        <th>Pembayaran</th>
                                        <th>Pelanggan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi as $key=>$item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tanggal_transaksi }}</td>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->total }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->pelanggan->nama }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm btn-pilih"
                                                data-id="{{ $item->id }}"><i class="fa fa-check-square-o"></i>
                                                Pilih</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('style')
<link rel="stylesheet"
    href="{{ asset('adminlte') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/sweetalert2/dist/sweetalert2.css">
@endpush
@push('script')
<script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<script src="{{ asset('adminlte') }}/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function(){
        $('#table_transaksi').dataTable();
        $(".showModalTransaksi").click(function(){
            $('#myModal').modal('show');
        });
        $(document).on('click','.btn-pilih',function(){
            let url = "{{ route('transaksi.return.penjualan.get_transaksi_by_id',':id') }}";
            url = url.replace(":id",$(this).data('id'));
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function (response) {
                    $('#kode_transaksi').val(response[0].kode);
                    $('#tanggal_transaksi').val(response[0].tanggal_transaksi);
                    $('#pelanggan').val(response[0].pelanggan.nama);
                    $('#loadDataTransaksi').html(response[1]);
                    if(response[2] != []){
                        $('#loadDataReturn').html(response[2]);
                        loadTotal();
                    }
                    $('#myModal').modal('hide');
                }
            });
        });
        $(document).on('click','.btn-pilih-barang',function(){
            const kode_barang = $(this).data('kbarang');
            const nama_barang = $(this).data('nbarang');
            const qty_detail = $(this).data('qty');
            $('#qty_detail').val(qty_detail);
            $('#kodeBarang').val(kode_barang);
            $('#namaBarang').val(nama_barang);
            $('#qty').val(1);
        });
        $('#qty').keyup(function(){
            if(parseInt($(this).val()) >= parseInt($('#qty_detail').val())){
                $(this).val(0);
                Swal.fire("Error!","Quantity lebih besar dari quantity transaksi","error");
            }
        });
        $('#addCart').click(function(){
            kode_transaksi = $('#kode_transaksi').val();
            kode_barang=$('#kodeBarang').val();
            qty=$('#qty').val()
                $.ajax({
                    type: "POST",
                    url: "{{ route('transaksi.return.penjualan.add_cart') }}",
                    data: {
                        faktur:$('#faktur').val(),
                        kode_transaksi:kode_transaksi,
                        kode_barang:kode_barang,
                        qty:qty 
                    },
                    dataType: "json",
                    success: function (response) {
                       Swal.fire(response[0],response[1],response[0]);
                       if(response[0]=="success"){
                           loadDataReturn(response[2]);
                       }
                    }
                });
            
        });
        function loadDataReturn(param){
            let url = "{{ route('transaksi.return.penjualan.load_data_return',':id') }}";
            url = url.replace(":id",param);
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function (response) {
                    $('#loadDataReturn').html(response);
                    loadTotal();
                }
            });
        }
        function loadTotal(){
            subtotal=0;
            $('#loadDataReturn tr').each(function(){
                subtotal += parseInt($(this).find('#total_text').text());
                console.log(subtotal);
            });
            $('#grand_total2').text(parseInt(subtotal));
        }
        $(document).on('click','.btn-delete-return',function(){
            const id = $(this).data('id');
            let url = "{{ route('transaksi.return.penjualan.delete_return') }}";
            $.ajax({
                type: "POST",
                url: url,
                data: {id:id},
                dataType: "json",
                success: function (response) {
                    if(response[0]=="oke"){
                        Swal.fire("Success","Success Menghapus data","success");
                        loadDataReturn(response[1]);
                    }else{
                        Swal.fire("Error","Gagal Menghapus data","error");
                    }
                }
            });
        });
        $('.btn-submit').click(function(){
            tanggal = $('#tanggal').val();
            $.ajax({
                type: "POST",
                url: "{{ route('transaksi.return.penjualan.submit') }}",
                data: {tanggal:tanggal,kode_transaksi:$('#kode_transaksi').val()},
                dataType: "json",
                beforeSend:function(){
                    Swal.fire({
                        title: 'Loading .....',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        onOpen: () => {
                            Swal.showLoading()
                        }
                    })
                },
                success: function (response) {
                    Swal.close();
                    Swal.fire(response[0],response[1],response[0]).then(()=>{
                        location.href = "{{ route('transaksi.return.penjualan.index') }}";
                    });
                }
            });
        })
    });
</script>
@endpush