@extends('layouts.template')
@section('page','Input Transaksi')
@section('content')
<input type="hidden" name="stok_hidden" id="stok_hidden">
<input type="hidden" name="pph_value" id="pph_value" value="0">
<input type="hidden" name="ppn_value" id="ppn_value" value="0">
<input type="hidden" name="diskon_value" id="diskon_value" value="0">
<input type="hidden" name="kode" id="kode" value="{{ $kode }}">
<div class="row">
    <div class="col-md-3">
        <div class="box box-primary>
            <div class=" box-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="tanggal">Tanggal Transaksi</label>
                        <input type="text" name="tangal" class="form-control" id="tangal" readonly
                            style="cursor:no-drop" value="{{ date('Y-m-d H:i:s') }}">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="kasir">Tanggal Transaksi</label>
                        <input type="text" name="kasir" class="form-control" id="kasir" readonly style="cursor:no-drop"
                            value="Testing">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="pelanggan">Pelanggan</label>
                        <select name="pelanggan" id="pelanggan" class="form-control select2" style="width: 100%;">
                            @foreach ($pelanggan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-5">
    <div class="box box-primary>
            <div class=" box-body">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="kode_barang">Kode Barang</label>
                    <input type="text" name="kode_barang" id="kode_barang" class="form-control" autofocus>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" name="harga" id="harga" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="satuan">Satuan Barang</label>
                    <input type="text" name="satuan" id="satuan" class="form-control" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="qty">Quantity</label>
                    <input type="text" name="qty" id="qty" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary btn-add mt-3">Tambah <i class="fa fa-shopping-cart"></i></button>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-md-4">
    <div class="box box-primary>
            <div class=" box-body">
        <div align="right">
            <h4>Invoice <b><span id="invoice">{{ $kode }}</span></b></h4>
            <h1><b><span id="grand_total2" style="font-size:50pt;">0</span></b></h1>
        </div>
    </div>
</div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary>
            <div class=" box-body">
            <div class="table-responsive">
                <table class="table table-bordered stripped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Barcode</th>
                            <th>Barang</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th width="15%">Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="cart_table">
                        @include('pages.transaksi.partials.table_cart')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="box box-primary>
            <div class=" box-body">
            <div class="row">
                <div class="col-md-12">
                    <label for="pembayaran">Metode Pembayaran</label>
                    <select name="pembayaran" id="pembayaran" class="form-control select2">
                        <option value="tunai">Tunai</option>
                        <option value="hutang">Hutang</option>
                    </select>
                </div>
                <div class="col-md-12 kotak-jatuh-tempo" style="display:none">
                    <label for="jatuh_tempo">Jatuh Tempo</label>
                    <input type="date" name="jatuh_tempo" id="jatuh_tempo" class="form-control"
                        min="{{ date('Y-m-d',strtotime("+1 day")) }}">
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="subtotal">Subtotal</label>
                        <input type="number" class="form-control" name="subtotal" id="subtotal" readonly
                            style="cursor:no-drop">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="diskon">Diskon</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="diskon" id="diskon" min="1" max="100">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="box box-primary>
            <div class=" box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ppn">PPN</label>
                    <div class="input-group">
                        <span class="input-group-addon"><input type="checkbox" id="cek-ppn" value="1"></span>
                        <input type="number" class="form-control" name="ppn" id="ppn" readonly value="10">
                        <span class="input-group-addon">%</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pph">PPH</label>
                    <div class="input-group">
                        <span class="input-group-addon"><input type="checkbox" id="cek-pph"></span>
                        <input type="number" class="form-control" name="pph" id="pph" readonly value="15">
                        <span class="input-group-addon">%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="grandtotal">Grandtotal</label>
                    <input type="number" class="form-control" name="grandtotal" id="grandtotal" readonly
                        style="cursor:no-drop">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="bayar">Dibayar</label>
                <input type="number" class="form-control" name="bayar" id="bayar">
            </div>
            <div class="col-md-6">
                <button class="btn btn-default btn-uang-pass">Uang Pas [F7]</button>
                <button class="btn btn-default mt-2 btn-kosongkan">Kosongkan [F8]</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="kembali">Kembali</label>
                <input type="text" class="form-control" name="kembali" id="kembali" readonly>
            </div>
        </div>

    </div>
</div>
</div>
<div class="col-md-4">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary>
                    <div class=" box-body">
                <div align="right">
                    <h1><b id="kembali2">0</b></h1>
                    <h4><b><span id="alert-kembali2"></span></b></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-warning btn-cancel"><i class="fa fa-refresh"></i> Cancel</button>
    </div>
    <div class="col-md-12 mt-2">
        <button class="btn btn-success btn-proses">
            <i class="fa fa-spinner fa-spin pull-left" style="display: none"></i>
            <i class="fa fa-location-arrow"></i>
            Proses
            Pembayaran</button>
    </div>
</div>
</div>
</div>
<div class="modal fade" id="modal-selesai">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Transaksi Selesai</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td id="showTanggal"></td>
                                <td>Pelanggan</td>
                                <td>:</td>
                                <td id="showPelanggan"></td>
                            </tr>
                            <tr>
                                <td>Invoice</td>
                                <td>:</td>
                                <td id="showInvoice"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="table-after-transaksi"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cetak Struk</button>
                <button type="button" class="btn btn-primary">Selesai</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet"
    href="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endpush
@push('script')
<script src="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<script src="{{ asset('adminlte') }}/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
    $(document).ready(function(){
        
        calculate();
        $('.select2').select2()
        $('#kode_barang').keyup(function(){
            if($(this).val() != ""){
                getBarangById($(this).val());
            }else{
                clearFormBarang();
            }
        });
        
        $('#kode_barang').keypress(function(e){           
            if (e.keyCode === 13) {
                getBarangById($(this).val(),"scanner");
            }
        });
        function getBarangById(kode,from="keyup"){
            let url = "{{ route('transaksi.getBarangById',':id') }}";
            url = url.replace(":id",kode);
            if(kode != ""){
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function (response) {
                        if(response != "no result"){
                            $('#nama_barang').val(response.nama);
                            $('#harga').val(response.harga_jual);
                            $('#satuan').val(response.satuan.nama);
                            $('#kategori').val(response.kategori.nama);
                            $('#stok_hidden').val(response.stok_akhir);
                            $('#harga_hidden').val(response.harga_jual);
                            if(from == "scanner"){
                                $('#kode_barang').val('');
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
            $('#kategori').val('');
            $('#stok_hidden').val('');
        }
        $('.btn-add').click(function(){
            qty = $('#qty').val();
            stok = parseInt($('#stok_hidden').val());
            if($('#kode_barang').val() == ""){
                alert('Barang belum dipilih');
            }else if($('#qty').val() == ""){
                alert('Quantity belum diinput')
            }else{
                if(qty > stok){
                    alert('stok tidak cukup');
                }else{
                    addCart();
                }
            }
        });
        function addCart(){
            let url = "{{ route('transaksi.add_to_cart') }}"
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    barcode : $('#kode_barang').val(),
                    harga : $('#harga').val(),
                    qty : $('#qty').val(),
                    kode:$('#kode').val()
                },
                dataType: "json",
                success: function (response) {
                    if(response == "berhasil"){
                        loadTable();
                    }
                   alert(response);
                   $('#kode_barang').val('');
                   clearFormBarang();
                }
            });
        }
        function loadTable(){
            $('#cart_table').load("{{ route('transaksi.load_table') }}",function(){
                calculate();
            });   
        }
        $('.btn-uang-pass').click(function(){
            $('#bayar').val($('#grandtotal').val());
            $('#kembali').val(0);
        });
        $('.btn-kosongkan').click(function(){
            $('#kembali').val(0);
            $('#bayar').val('');
        });
        function calculate(){
            var subtotal = 0;
            $('#cart_table tr').each(function(){
                subtotal += parseInt($(this).find('#total').text());
            });
            isNaN(subtotal) ? $('#subtotal').val(0) : $('#subtotal').val(subtotal);

            var diskon = $('#diskon').val();
            var grandtotal = subtotal - diskon;

            if(isNaN(grandtotal)){
                $('#grandtotal').val(0);
                $('#grand_total2').text(0);
            }else{
                $('#grandtotal').val(grandtotal);
                $('#grand_total2').text(grandtotal);
            }
        }
        $('#diskon').keyup(function(e){
            const diskon = $(this).val();
            if(diskon > 100){
                alert('melebihi 100');
            }else{
                const dsk = diskon / 100;
                const result = $('#subtotal').val() * dsk;
                $('#diskon_value').val(result);
                $('#grandtotal').val($('#subtotal').val() - result);
                $('#grand_total2').text($('#subtotal').val() - result);
            }
        });
        $('#cek-pph').click(function(){
            if($(this).prop("checked") == true){
                const val_pph = $('#pph').val();
                const percent = val_pph / 100;
                const pph = $('#subtotal').val() * percent;
                const gt = $('#grandtotal').val()
                const pph_value = $('#pph_value').val(pph);
                $('#grandtotal').val(parseInt(gt) + parseInt(pph));
                $('#grand_total2').text(parseInt(gt) + parseInt(pph));
            }else if($(this).prop("checked") == false){
                const val_pph = $('#pph').val();
                const percent = val_pph / 100;
                const pph = $('#subtotal').val() * percent;
                const gt = $('#grandtotal').val()
                const pph_value = $('#pph_value').val(0);
                $('#grandtotal').val(parseInt(gt) - parseInt(pph));
                $('#grand_total2').text(parseInt(gt) - parseInt(pph));
            }
        });
        $('#cek-ppn').click(function(){
            if($(this).prop("checked") == true){
                const val_ppn = $('#ppn').val();
                const percent = val_ppn / 100;
                const ppn = $('#subtotal').val() * percent;
                const gt = $('#grandtotal').val()
                const ppn_value = $('#ppn_value').val(ppn);
                $('#grandtotal').val(parseInt(gt) + parseInt(ppn));
                $('#grand_total2').text(parseInt(gt) + parseInt(ppn));
            }else if($(this).prop("checked") == false){
                const val_ppn = $('#ppn').val();
                const percent = val_ppn / 100;
                const ppn = $('#subtotal').val() * percent;
                const gt = $('#grandtotal').val()
                const ppn_value = $('#ppn_value').val(0);
                $('#grandtotal').val(parseInt(gt) - parseInt(ppn));
                $('#grand_total2').text(parseInt(gt) - parseInt(ppn));
            }
        });
        $('#pembayaran').change(function(){
            const type = $(this).val();
            if(type == "hutang"){
                $('#bayar').attr('readonly','readonly')
                $(".kotak-jatuh-tempo").css({display:"block"});
            }else{
                $('#bayar').removeAttr('readonly')
                $(".kotak-jatuh-tempo").css({display:"none"});
            }
        });
        $('#bayar').keyup(function(){
            const bayar = $(this).val();
            const grandtotal = $('#grandtotal').val();
            const result=bayar-grandtotal;
            if(result < -1){
                $('#kembali').val('Pembayaran Kurang');
                $('#kembali2').html(`<span style="font-size:50pt;" class="text-danger">${result}</span>`);
                $('#alert-kembali2').html('Pembayaran Kurang');
            }else{
                $('#kembali2').html(`<span style="font-size:50pt;" >${result}</span>`);
                $('#kembali').val(result);
                $('#alert-kembali2').html('Kembali: '+result);
            }
        });
        $('.btn-cancel').click(function(){
            $.ajax({
                type: "POST",
                url: "{{ route('transaksi.cancel') }}",
                dataType: "json",
                success: function (response) {
                    loadTable();
                }
            });
        })
        $('.btn-hapus').click(function(){
            konf = confirm('Yakin ingin menghapus barang ini dari keranjang ?');
            if(konf){
                $.ajax({
                    type: "POST",
                    url: "{{ route('transaksi.delete_cart') }}",
                    data: {
                        id : $(this).data('id')
                    },
                    dataType: "json",
                    success: function (response) {
                        alert(response)
                        loadTable();
                    }
                });
            }
        });
        $(document).on('click','.btn-change-qty',function(){
            const type = $(this).data('change');
            const id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "{{ route('transaksi.change_qty') }}",
                data: {
                    type: type,
                    id:id
                },
                dataType: "json",
                success: function (response) {
                    alert(response);
                    loadTable();
                }
            });
        });
        $(document).on('click','.btn-proses',function(){
            if($('#pembayaran').val() == "tunai"){
                if($('#bayar').val()==""||$('#kembali').val()=="Pembayaran Kurang"){
                    alert('Form Bayar harus diisi');
                }else if($('#subtotal').val() == 0){
                    alert('Belum ada barang di keranjang');
                }else{
                    postTransaksi();
                }
            }else{
                if($('#jatuh_tempo').val() == ""){
                    alert('Tanggal jatuh tempo harus diisi');
                }else{
                    postTransaksi();
                }
            }
        });
        function postTransaksi(){
            $.ajax({
                type: "POST",
                url: "{{ route('transaksi.store') }}",
                data: {
                    diskon : $('#diskon').val(),
                    kode : $('#kode').val(),
                    pembayaran: $('#pembayaran').val(),
                    tgl_jatuh_tempo : $('#jatuh_tempo').val(),
                    id_pelanggan:$('#pelanggan').val(),
                    cek_pph : $('#cek_pph').val(),
                    cek_ppn : $('#cek_ppn').val(),
                    ppn : $('#ppn').val(),
                    pph : $('#pph').val(),
                    pph_value : $('#pph_value').val(),
                    ppn_value : $('#ppn_value').val(),
                    grandtotal:$('#grandtotal').val(),
                    subtotal : $('#subtotal').val(),
                    diskon_value : $('#diskon_value').val()
                },
                beforeSend:function(){
                    $('.fa-location-arrow').css('display','none');
                    $('.fa-spin').css('display','block');
                    $('.btn-proses').css('cursor','no-drop');
                    $('.btn-proses').attr('disabled','disabled');
                },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if(response[0]=="berhasil"){
                        modalTransaksi(response[1]);
                    }
                }
            });

        }
        function modalTransaksi(data){
            $('#showTanggal').text(data.tanggal_transaksi);
            $('#showPelanggan').text(data.pelanggan.nama);
            $('#showInvoice').text(data.kode);

            var html = '';
            var subtotal = 0;
            data.detail_transaksi.forEach(function(item){
                html += `<tr><td>${item.barang.nama}</td><td>${item.harga}</td><td>${item.jumlah_beli}</td><td>${item.subtotal}</td></tr>`;
                subtotal += item.subtotal
            });
            html += `<tr><td colspan="3" align="center">Subtotal Barang</td><td>${subtotal}</td></tr>`
            html += `<tr><td colspan="3" align="center">Diskon</td><td>${data.diskon}</td></tr>`
            html += `<tr><td colspan="3" align="center">PPN</td><td>${data.ppn}</td></tr>`
            html += `<tr><td colspan="3" align="center">PPH</td><td>${data.pph}</td></tr>`
            html += `<tr><td colspan="3" align="center">Grandtotal</td><td>${data.total}</td></tr>`;
            $('#table-after-transaksi').html(html);
            $('#modal-selesai').modal('show');
        }
    });
</script>
@endpush