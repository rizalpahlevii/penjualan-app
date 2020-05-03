@extends('layouts.template')
@section('page','Hutang')
@section('content')
<div class="row kotak-atas">
    @include('pages.transaksi.hutang.kotak_atas')
</div>


<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class=" box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-warning btn-filter" data-filter="refresh"><i class="fa fa-refresh"></i>
                            Refresh</button>
                        <button class="btn btn-success btn-filter" data-filter="lunas"><i
                                class="fa fa-check-square"></i>
                            Lunas</button>
                        <button class="btn btn-warning btn-filter" data-filter="belum_lunas"><i
                                class="fa fa-window-close"></i> Belum
                            Lunas</button>
                        <button class="btn btn-danger btn-filter" data-filter="belum_dibayar"><i
                                class="fa fa-remove"></i>
                            Belum Dibayar</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            @include('pages.transaksi.hutang.table_hutang')
                        </div>
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
                <h4 class="modal-title">Bukti Pembayaran Hutang</h4>
            </div>
            <div class="modal-body bodyModal">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-bayar-hutang"><i class="fa fa-check-square"></i>
                    Bayar Hutang</button>
                <button type="button" class="btn btn-primary btn-print"><i class="fa fa-print"></i>
                    Print</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-window-close"></i>
                    Tutup</button>
            </div>
        </div>
    </div>
</div>

<div id="myModal2" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pembayaran Piutang</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="invoice_bayar">Invoice</label>
                            <input type="text" readonly class="form-control" name="invoice_bayar" id="invoice_bayar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="suplier_bayar">Suplier</label>
                            <input type="text" readonly class="form-control" name="suplier_bayar" id="suplier_bayar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="total_hutang_bayar">Total Hutang</label>
                            <input type="text" readonly class="form-control" name="total_hutang_bayar"
                                id="total_hutang_bayar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sisa_hutang_bayar">Sisa Piutang</label>
                            <input type="text" readonly class="form-control" name="sisa_hutang_bayar"
                                id="sisa_hutang_bayar">
                            <input type="hidden" readonly class="form-control" name="sisa_hutang_bayar_hidden"
                                id="sisa_hutang_bayar_hidden">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="pembayaran_bayar">Pembayaran</label>
                            <input type="number" class="form-control" name="pembayaran_bayar" id="pembayaran_bayar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-default uang-pas">Uang Pas</button>
                        <button class="btn btn-default kosongkan">Kosongkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-proses-hutang"><i class="fa fa-check-square"></i>
                    Bayar</button>
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
<link rel="stylesheet"
    href="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/print/print.css">
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/sweetalert2/dist/sweetalert2.css">
@endpush
@push('script')
<script src="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<script src="{{ asset('adminlte') }}/plugins/print/print.js"></script>
<script src="{{ asset('adminlte') }}/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function(){
        $('#filter-atas').click(function(){
            const pelanggan = $('#pelanggan').val();
            if($('#startdate').val()!=""){
                 tanggal_awal = $('#startdate').val();
            }else{
                 tanggal_awal ="all";
            }
            if($('#enddate').val()!=""){
                 tanggal_akhir = $('#enddate').val();
            }else{
                 tanggal_akhir ="all";
            }
            let url = `{{ url('transaksi/hutang/loadTable?tanggal_awal=`+tanggal_awal+`&tanggal_akhir=`+tanggal_akhir+`') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.table-responsive').load(parsedUrl);
        });
        $(document).on('click','.btn-filter',function(){
            const filter = $(this).data('filter');
            loadTable(filter);
        });
        function loadTable(filter="default"){
            let url = `{{ url('transaksi/hutang/loadTable?filter=`+filter+`') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.table-responsive').load(parsedUrl);
            loadKotakAtas()
        }
        function loadKotakAtas(filter="default"){
            let url = `{{ route('transaksi.hutang.load_kotak_atas') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.kotak-atas').load(parsedUrl);
        }
        $("#startdate").datepicker({
            todayBtn: 1,
            format : 'yyyy-mm-dd',
            autoclose: true,
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#enddate').datepicker('setStartDate', minDate);
        });
        $("#enddate").datepicker({format : 'yyyy-mm-dd'}).on('changeDate', function (selected) {
            var maxDate = new Date(selected.date.valueOf());
            $('#startdate').datepicker('setEndDate', maxDate);
        });
        
        function rupiah(value,prefix = "Rp. "){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
      
        $('.btn-print').click(function(){
            print();
        });
        function print() {
            printJS({
                printable: 'printArea',
                type: 'html',
                targetStyles: ['*']
            })
        } 
        $('.btn-bayar-hutang').click(function(){
            const id = $('#hutang_id').val();
            let url = "{{ route('transaksi.hutang.get_hutang_by_id',':id') }}";
            url = url.replace(":id",id);
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function (response) {
                    $('#invoice_bayar').val(response.pembelian.faktur);
                    $('#suplier_bayar').val(response.suplier.nama);
                    $('#total_hutang_bayar').val(response.total_hutang);
                    $('#sisa_hutang_bayar').val(response.sisa_hutang);
                    $('#sisa_hutang_bayar_hidden').val(response.sisa_hutang);
                    $('#myModal2').modal('show');
                }
            });
        });
        $(document).on('click','.aksi',function(){
            id = $(this).data('id');
            let url = "{{ route('transaksi.hutang.load_modal',':id') }}";
            url = url.replace(":id",id);
            $('.bodyModal').load(url,function(){
                $('#myModal').modal('show');
            });
        });
        $('#pembayaran_bayar').keyup(function(){
            const sisa_awal = $('#sisa_hutang_bayar_hidden').val();
            const sl = sisa_awal.length;
            const bayar = $(this).val();
            const result = sisa_awal - bayar;
            if(result <= 0){
                $('#sisa_hutang_bayar').val("Hutang Lunas");
            }else{
                $('#sisa_hutang_bayar').val(result);
            }
        });
        $('.uang-pas').click(function(){
            const sisa_awal = $('#sisa_hutang_bayar_hidden').val();
            $('#sisa_hutang_bayar').val(0);
            $('#pembayaran_bayar').val(sisa_awal);
        });
        $('.btn-proses-hutang').click(function(){
            const bayar = $('#pembayaran_bayar').val();
            $.ajax({
                type: "POST",
                url: "{{ route('transaksi.hutang.proses_bayar_hutang') }}",
                data: {
                    hutang_id : $('#hutang_id').val(),
                    bayar : bayar
                },
                dataType: "json",
                success: function (response) {
                    if(response == "berhasil"){
                        Swal.fire("Berhasil","Proses Hutang berhasil diproses","success")
                        .then(function(){
                            $('#myModal2').modal('hide');
                            $('#myModal').modal('hide');
                            loadTable();
                        });
                    }else{
                        Swal.fire("Gagal","Proses Hutang gagal diproses","error")
                        .then(function(){
                            $('#myModal2').modal('hide');
                            $('#myModal').modal('hide');
                            loadTable();
                        });
                    }
                }
            });
        });
        $('.kosongkan').click(function(){
            const sisa_awal = $('#sisa_hutang_bayar_hidden').val();
            $('#sisa_hutang_bayar').val(sisa_awal);
            $('#pembayaran_bayar').val(0);
        });
    });
</script>
@endpush