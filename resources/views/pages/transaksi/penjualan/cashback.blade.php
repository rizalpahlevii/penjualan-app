@extends('layouts.template')
@section('page','Cashback Penjualan ' . $transaksi->kode . ' - ' . $transaksi->pelanggan->nama)
@section('content')

<form id="form-cashback" method="POST">
    <input type="hidden" name="kode" id="kode" value="{{ $transaksi->kode }}">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class=" box-header with-border">
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
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" cellspacing="0"
                                    width="100%" id="example-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Barang</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th>Cashback</th>
                                            <th>Subtotal Cashback</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $totcash = 0;
                                        @endphp
                                        @foreach ($transaksi->detail_transaksi as $key => $item)
                                        <input type="hidden" name="detail_transaksi_id{{ $key+1 }}"
                                            value="{{ $item->id }}">
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->barang->nama }}</td>
                                            <td>
                                                {{ $item->jumlah_beli }}
                                                <input type="hidden" name="qty_hidden{{ $key+1 }}"
                                                    id="qty_hidden{{ $key+1 }}" value="{{ $item->jumlah_beli }}">
                                            </td>
                                            <td>
                                                @rupiah($item->harga)
                                                <input type="hidden" name="harga_hidden{{ $key+1 }}"
                                                    id="harga_hidden{{ $key+1 }}" value="{{ $item->harga }}">
                                            </td>
                                            <td>@rupiah($item->subtotal)</td>
                                            <td>
                                                @php
                                                $persentase_cashback = 20;
                                                $result = ($item->harga / 100) * $persentase_cashback;
                                                @endphp

                                                <div class="input-group">
                                                    <input type="number" class="form-control"
                                                        name="cashback_value{{ $key+1 }}" id="cashback_value{{ $key+1}}"
                                                        value="{{ $result }}" readonly="readonly"
                                                        onkeyup="manualCashback({{ $key+1 }})">

                                                    <span class="input-group-addon"><input type="checkbox"
                                                            id="cek-cashback{{ $key+1 }}" value="1"
                                                            data-id="{{ $key+1 }}" checked
                                                            onclick="checkedCashback({{ $key+1 }})">
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="subtotal_cashback{{ $key+1 }}"
                                                    id="subtotal_cashback{{ $key+1 }}"
                                                    value="{{ $result * $item->jumlah_beli }}" readonly>
                                            </td>
                                        </tr>
                                        @php
                                        $totcash+=$result * $item->jumlah_beli;
                                        @endphp
                                        @endforeach
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="persentase_cashback"
                                                        id="persentase_cashback" min="1" max="100" value="20">
                                                    <span class="input-group-addon">%</span>
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <center><b>Total Cashback</b></center>
                                            </td>
                                            <td>

                                                <input type="number" class="form-control" name="total_cashback"
                                                    id="total_cashback" value="{{ $totcash }}" readonly>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                                <input type="hidden" id="total_row" name="total_row" value="{{ $key+1 }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary pull-right" style="submit"
                                onclick="return confirm('Yakin ingin melakukan cashback transaksi')">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>



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
    function checkedCashback(id){
        if($(`#cek-cashback${id}`).prop("checked") == true){
            $(`#cashback_value${id}`).attr('readonly','readonly');
        }else if($(`#cek-cashback${id}`).prop("checked") == false){
           $(`#cashback_value${id}`).removeAttr('readonly');
        }
    }
    function manualCashback(i){
        const row = $('#total_row').val();
        const harga = $(`#harga_hidden${i}`).val();
        const qty = $(`#qty_hidden${i}`).val();
        const cashback = $(`#cashback_value${i}`).val();
        const subtotal_cashback = cashback * qty;
        $(`#cashback_value${i}`).val(cashback);
        $(`#subtotal_cashback${i}`).val(subtotal_cashback);

        var total_cashback = 0;
        for (let i = 1; i <= row; i++) {
            subtotal = $(`#subtotal_cashback${i}`).val();
            total_cashback += parseInt(subtotal);
        }
        $('#total_cashback').val(total_cashback);
    }
    $(document).ready(function(){
        $('#form-cashback').on('submit', function(e){
            e.preventDefault();
            let url = `{{ route('transaksi.penjualan.cashback_post',':id') }}`;
            url = url.replace(':id',$('#kode').val());
            $.ajax({
                url : url,
                method : 'POST',
                data : $(this).serialize(),
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
                success:function(response){
                    Swal.close();
                    if(response.status == "success"){
                        Swal.fire("Sukses!","Pembayaran Cashback Berhasil!","success").then(()=>{
                            let url_nota = `{{ route('transaksi.penjualan.cashback_nota',':id') }}`;
                            url_nota = url_nota.replace(':id',response.data.kode);
                            window.open(url_nota);
                            location.href = `{{ route('transaksi.penjualan.all') }}`;
                        });
                    }else{
                        Swal.fire("Error!","Pembayaran Cashback gagal!","error").then(()=>{
                            location.href = `{{ route('transaksi.penjualan.all') }}`;
                        });
                    }
                }
            });
        });
        $('#persentase_cashback').keyup(function(){
            if($(this).val() >100){
                alert('Persentase Melebihi 100%');
                $(this).val(20);
            }
            const row = $('#total_row').val();
            const persen = $(this).val();
            var total_cashback = 0;
            for (let i = 1; i <= row; i++) {
                if($(`#cashback_value${i}`).is('[readonly="readonly"]')){
                    const harga = $(`#harga_hidden${i}`).val();
                    const qty = $(`#qty_hidden${i}`).val();
                    const cashback = (harga / 100) * persen;
                    const subtotal_cashback = cashback * qty;
                    $(`#cashback_value${i}`).val(cashback);
                    $(`#subtotal_cashback${i}`).val(subtotal_cashback);
                    total_cashback += parseInt(subtotal_cashback);
                }else{
                    sub = $(`#subtotal_cashback${i}`).val();
                    total_cashback += parseInt(sub);
                }
            }
            $('#total_cashback').val(total_cashback);
        });
    });
</script>
@endpush