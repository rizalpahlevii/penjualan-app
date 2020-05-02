@extends('layouts.template')
@section('page','Piutang')
@section('content')
<div class="row kotak-atas">
    @include('pages.transaksi.piutang.kotak_atas')
</div>


<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        @if (Session::get('status'))
                        <div class="alert alert-{{ Session::get('status') }}">
                            {{Session::get('message')}}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-warning btn-filter" data-filter="refresh"><i class="fa fa-refresh"></i>
                            Refresh</button>
                        <button class="btn btn-success btn-filter" data-filter="lunas"><i
                                class="fa fa-check-square"></i> Lunas</button>
                        <button class="btn btn-warning btn-filter" data-filter="belum_lunas"><i
                                class="fa fa-window-close"></i> Belum
                            Lunas</button>
                        <button class="btn btn-danger btn-filter" data-filter="belum_dibayar"><i
                                class="fa fa-remove"></i> Belum Dibayar</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            @include('pages.transaksi.piutang.table_piutang')
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
                <h4 class="modal-title">Bukti Pembayaran Piutang</h4>
            </div>
            <div class="modal-body bodyModal">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-bayar-piutang"><i class="fa fa-check-square"></i>
                    Bayar Piutang</button>
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
                            <label for="pelanggan_bayar">Pelanggan</label>
                            <input type="text" readonly class="form-control" name="pelanggan_bayar"
                                id="pelanggan_bayar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="total_piutang_bayar">Total Piutang</label>
                            <input type="text" readonly class="form-control" name="total_piutang_bayar"
                                id="total_piutang_bayar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sisa_piutang_bayar">Sisa Piutang</label>
                            <input type="text" readonly class="form-control" name="sisa_piutang_bayar"
                                id="sisa_piutang_bayar">
                            <input type="hidden" readonly class="form-control" name="sisa_piutang_bayar_hidden"
                                id="sisa_piutang_bayar_hidden">
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
                <button type="button" class="btn btn-primary btn-proses-piutang"><i class="fa fa-check-square"></i>
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
            let url = `{{ url('transaksi/piutang/loadTable?pelanggan=`+pelanggan+`&tanggal_awal=`+tanggal_awal+`&tanggal_akhir=`+tanggal_akhir+`') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.table-responsive').load(parsedUrl);
        });
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
        
        function loadTable(filter="default"){
            let url = `{{ url('transaksi/piutang/loadTable?filter=`+ filter +`') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.table-responsive').load(parsedUrl);
            loadKotakAtas();
        }
        function loadKotakAtas(filter="default"){
            let url = `{{ route('transaksi.piutang.load_kotak_atas') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.kotak-atas').load(parsedUrl);
        }
        $(document).on('click','.btn-filter',function(){
            const filter = $(this).data('filter');
            loadTable(filter);
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
        $(document).on('click','.aksi',function(){
            id = $(this).data('id');
            let url = "{{ route('transaksi.piutang.load_modal',':id') }}";
            url = url.replace(":id",id);
            $('.bodyModal').load(url,function(){
                $('#myModal').modal('show');
            });
        });
        $('.btn-print').click(function(){
            print();
        });
        $('.btn-bayar-piutang').click(function(){
            const id = $('#piutang_id').val();
            let url = "{{ route('transaksi.piutang.get_piutang_by_id',':id') }}";
            url = url.replace(":id",id);
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function (response) {
                    $('#invoice_bayar').val(response.transaksi.kode);
                    $('#pelanggan_bayar').val(response.pelanggan.nama);
                    $('#total_piutang_bayar').val(response.total_hutang);
                    $('#sisa_piutang_bayar').val(response.sisa_piutang);
                    $('#sisa_piutang_bayar_hidden').val(response.sisa_piutang);
                    $('#myModal2').modal('show');
                }
            });
        });
        $('#pembayaran_bayar').keyup(function(){
            const sisa_awal = $('#sisa_piutang_bayar_hidden').val();
            const sl = sisa_awal.length;
            const bayar = $(this).val();
            const result = sisa_awal - bayar;
            if(result <= 0){
                $('#sisa_piutang_bayar').val("Piutang Lunas");
            }else{
                $('#sisa_piutang_bayar').val(result);
            }
        });
        $('.uang-pas').click(function(){
            const sisa_awal = $('#sisa_piutang_bayar_hidden').val();
            $('#sisa_piutang_bayar').val(0);
            $('#pembayaran_bayar').val(sisa_awal);
        });
        $('.kosongkan').click(function(){
            const sisa_awal = $('#sisa_piutang_bayar_hidden').val();
            $('#sisa_piutang_bayar').val(sisa_awal);
            $('#pembayaran_bayar').val(0);
        });
        $('.btn-proses-piutang').click(function(){
            const bayar = $('#pembayaran_bayar').val();
            $.ajax({
                type: "POST",
                url: "{{ route('transaksi.piutang.proses_bayar_piutang') }}",
                data: {
                    piutang_id : $('#piutang_id').val(),
                    bayar : bayar
                },
                dataType: "json",
                success: function (response) {
                    if(response == "berhasil"){
                        Swal.fire("Berhasil","Proses Piutang berhasil diproses","success")
                        .then(function(){
                            $('#myModal2').modal('hide');
                            $('#myModal').modal('hide');
                            loadTable();
                        });
                    }else{
                        Swal.fire("Gagal","Proses Piutang gagal diproses","error")
                        .then(function(){
                            $('#myModal2').modal('hide');
                            $('#myModal').modal('hide');
                            loadTable();
                        });
                    }
                }
            });
        });
        
        function print() {
            printJS({
                printable: 'printArea',
                type: 'html',
                targetStyles: ['*']
            })
        } 
    });
</script>
@endpush