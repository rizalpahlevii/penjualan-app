@extends('layouts.template')
@section('page','Cetak Laporan')
@section('content')
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
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="modeCetak" class="form-control" style="width:180px;" id="mode">
                                            <option value="">Pilih Laporan</option>
                                            <option value="" disabled="" style="color:blue">Laporan Barang</option>
                                            <option value="cetakStok">- Stok barang</option>
                                            <option value="cetakStokLimit">- Stok limit</option>
                                            <option value="cetakStokExpired">- Barang expired</option>
                                            <option value="cetakKatalog">- Katalog Barang</option>
                                            <option value="" disabled="" style="color:blue">Laporan Penjualan</option>
                                            <option value="penjualan">- Penjualan</option>
                                            <option value="penjualantunai">- Penjualan tunai</option>
                                            <option value="penjualankredit">- Penjualan kredit</option>
                                            <option value="" disabled="" style="color:blue">Laporan Pembelian</option>
                                            <option value="pembelian">- Pembelian</option>
                                            <option value="pembeliantunai">- Pembelian Tunai</option>
                                            <option value="pembeliankredit">- Pembelian Kredit</option>
                                            <option value="hutang">Laporan Hutang</option>
                                            <option value="piutang">Laporan Piutang</option>
                                            <option value="kas">Kas</option>
                                            <option value="laba">Laba/Rugi</option>

                                        </select>
                                    </td>
                                    <td style="padding-left:5px;padding-right:5px;font-weight:bold">Tanggal</td>
                                    <td>
                                        <input title="tanggal transaksi" class="form-control datepicker-here"
                                            type="text" name="startDate" id="startdate" autocomplete="off"
                                            value="{{ date('Y-m-d') }}">
                                    </td>
                                    <td style="padding-left:5px;padding-right:5px;font-weight:bold">s/d</td>
                                    <td>
                                        <input title="tanggal transaksi" class="form-control datepicker-here"
                                            type="text" name="endDate" id="enddate" autocomplete="off"
                                            value="{{ date('Y-m-d') }}">
                                    </td>
                                    <td>
                                        <button style=" margin-left:5px" class="btn btn-primary" value="Cetak"
                                            id="cetak"><i class="fa fa-print"></i> Cetak </button>
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
@endsection
@push('style')
<link rel="stylesheet"
    href="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endpush
@push('script')
<script src="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<script>
    $(document).ready(function () { 
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
        $('#cetak').click(function(){
            mode = $('#mode').val();
            start = $('#startdate').val();
            end = $('#enddate').val();
            let url = `{{ url('/laporan/cetak/${mode}?start=${start}&end=${end}') }}`;
            const parseResult = new DOMParser().parseFromString(url, "text/html");
            const parsedUrl = parseResult.documentElement.textContent;
            window.open(parsedUrl,'_blank');
        });
    });
</script>
@endpush