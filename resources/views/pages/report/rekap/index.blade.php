@extends('layouts.template')
@section('page','Rekap')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tanggal Awal</td>
                                    <td>
                                        <input title="tanggal transaksi" class="form-control datepicker-here"
                                            type="text" id="startdate" data-language="en" autocomplete="off"
                                            value="{{ date('Y-m-d') }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Akhir</td>

                                    <td>
                                        <input title="tanggal transaksi" class="form-control datepicker-here"
                                            type="text" id="enddate" data-language="en" autocomplete="off"
                                            value="{{ date('Y-m-d') }}">
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="btn btn-success" style="width:100%" id="filter1"><i
                                                class="fa fa-search"></i>
                                            Filter</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning excel"><i class="fa fa-print"></i>
                                            Excel</button>
                                        <button class="btn btn-primary print"><i class="fa fa-print"></i> Print</button>
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
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="#" class="btn btn-warning mb-3" id="refresh"><i class="fa fa-refresh"></i>
                            Refresh</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Total</th>
                                    </tr>
                                    <tr>
                                        <td>Penjualan Tunai</td>
                                        <td>@rupiah($penjualan['tunai'])</td>
                                    </tr>
                                    <tr>
                                        <td>Penjualan Non Tunai</td>
                                        <td>@rupiah($penjualan['non_tunai'])</td>
                                    </tr>
                                    <tr>
                                        <td>Penjualan Tunai & Non Tunai</td>
                                        <td>@rupiah($penjualan['tunai'] + $penjualan['non_tunai'])</td>
                                    </tr>
                                    <tr>
                                        <td>Return Penjualan</td>
                                        <td>@rupiah($return_penjualan)</td>
                                    </tr>
                                    <tr>
                                        <td>Total Piutang</td>
                                        <td>@rupiah($piutang['total_piutang'])</td>
                                    </tr>
                                    <tr>
                                        <td>Piutang Terbayar</td>
                                        <td>@rupiah($piutang['piutang_terbayar'])</td>
                                    </tr>
                                    <tr>
                                        <td>Piutang Sisa</td>
                                        <td>@rupiah($piutang['sisa_piutang'])</td>
                                    </tr>
                                    <tr>
                                        <td>Cashback Dibayar</td>
                                        <td>@rupiah($cashback)</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <center><b>Netto Penjualan</b></center>
                                        </td>
                                        <td>
                                            <b>@rupiah($laba_rugi_penjualan)</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pembelian Tunai</td>
                                        <td>@rupiah($pembelian['tunai'])</td>
                                    </tr>
                                    <tr>
                                        <td>Pembelian Non Tunai</td>
                                        <td>@rupiah($pembelian['non_tunai'])</td>
                                    </tr>
                                    <tr>
                                        <td>Pembelian Tunai & Non Tunai</td>
                                        <td>@rupiah($pembelian['tunai']+$pembelian['non_tunai'])</td>
                                    </tr>
                                    <tr>
                                        <td>Return Pembelian</td>
                                        <td>@rupiah($return_pembelian)</td>
                                    </tr>
                                    <tr>
                                        <td>Total Hutang</td>
                                        <td>@rupiah($hutang['total_hutang'])</td>
                                    </tr>
                                    <tr>
                                        <td>Hutang Terbayar</td>
                                        <td>@rupiah($hutang['hutang_terbayar'])</td>
                                    </tr>
                                    <tr>
                                        <td>Hutang Sisa</td>
                                        <td>@rupiah($hutang['sisa_hutang'])</td>
                                    </tr>

                                    <tr>
                                        <td>Penggajian</td>
                                        <td>@rupiah($penggajian)</td>
                                    </tr>
                                    <tr>
                                        <td>Pajak PPN & PPH</td>
                                        <td>@rupiah($ppn_pph['ppn']) / @rupiah($ppn_pph['pph'])</td>
                                    </tr>


                                    <tr>
                                        <td>Transport</td>
                                        <td>@rupiah($transport)</td>
                                    </tr>
                                    <tr>
                                        <td>Pemasukan Lain</td>
                                        <td>@rupiah($pemasukan_lain)</td>
                                    </tr>
                                    <tr>
                                        <td>Pengeluaran Lain</td>
                                        <td>@rupiah($pengeluaran_lain)</td>
                                    </tr>
                                    <tr>
                                        <td><b>
                                                <center>Saldo Netto</center>
                                            </b></td>
                                        <td><b>@rupiah(1919)</b></td>
                                    </tr>
                                </thead>
                            </table>
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
<link rel="stylesheet"
    href="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endpush
@push('script')
<script src="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js">
</script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<script>
    $(document).ready(function(){
        $('#example-table').dataTable();
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
        $('#filter1').click(function(){
            if($('#startdate').val() == "" || $('#enddate').val() == ""){
                alert('Form filter tidak boleh kosong');
                return;
            }
            loadTable("custom");
        });
        $('.print').click(function(){
           
            tanggal_awal = $('#startdate').val();
            tanggal_akhir = $('#enddate').val();
            
            
            let url = `{{ url('report/rekap/print?tanggal_awal=${tanggal_awal}&tanggal_akhir=${tanggal_akhir}') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            window.open(parsedUrl,'_blank');
        });
        $('.excel').click(function(){
            
            tanggal_awal = $('#startdate').val();
            tanggal_akhir = $('#enddate').val();
            
            
            let url = `{{ url('report/kas/excel?tanggal_awal=${tanggal_awal}&tanggal_akhir=${tanggal_akhir}') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            window.open(parsedUrl,'_blank');
        });
        function loadTable(filter){
            tanggal_awal = $('#startdate').val();
            tanggal_akhir = $('#enddate').val();
            
            if(filter=="all"){
                filter = filter;
            }else{
                filter="custom";
            }

            let url = `{{ url('/report/kas/loadTable?filter=`+filter+`&tanggal_awal=`+tanggal_awal+`&tanggal_akhir=`+tanggal_akhir+`') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('.table-responsive').load(parsedUrl);
            if(filter!="all"){
                loadKotakAtas("custom",tanggal_awal,tanggal_akhir);
            }
        }
        function loadKotakAtas(filter,tanggal_awal="all",tanggal_akhir="all"){
           let url = `{{ url('/report/kas/loadKotak?filter=`+filter+`&tanggal_awal=`+tanggal_awal+`&tanggal_akhir=`+tanggal_akhir+`') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            $('#kotak-total').load(parsedUrl);
        }
        $("#refresh").click(function(){
            loadTable("all");
            loadKotakAtas("all")
        });
    });
</script>
@endpush