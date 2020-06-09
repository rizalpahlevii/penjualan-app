@push('style')
<script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
@endpush
<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Invoice</th>
            <th>Piutang</th>
            <th>Piutang Dibayar</th>
            <th>Piutang Sisa</th>
            <th>Tempo</th>
            <th>Pelanggan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total_piutang = 0;
        $total_piutang_terbayar = 0;
        $total_piutang_sisa = 0;
        @endphp
        @foreach ($piutang as $key=>$item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->transaksi->tanggal_transaksi }}</td>
            <td>{{ $item->transaksi->kode }}</td>
            <td> @rupiah($item->total_hutang) </td>
            <td> @rupiah($item->piutang_terbayar) </td>
            <td> @rupiah($item->sisa_piutang) </td>
            <td>{{ $item->tanggal_tempo }}</td>
            <td>{{ $item->pelanggan->nama }}</td>
            <td>
                @if ( $item->status_piutang != "lunas")
                <button class="btn btn-sm btn-success aksi" data-id="{{ $item->id }}"><i
                        class="fa fa-gear"></i></button>
                @endif
            </td>
        </tr>
        @php
        $total_piutang += $item->total_hutang;
        $total_piutang_terbayar += $item->piutang_terbayar;
        $total_piutang_sisa += $item->sisa_piutang;
        @endphp
        @endforeach
    </tbody>
    <thead>
        <tr>
            <td colspan="8">
                <center><b>Total Sisa Piutang</b></center>
            </td>
            <td><b>@rupiah($total_piutang_sisa)</b></td>
        </tr>
        <tr>
            <td colspan="8">
                <center><b>Total Piutang Terbayar</b></center>
            </td>
            <td><b>@rupiah($total_piutang_terbayar)</b></td>
        </tr>
        <tr>
            <td colspan="8">
                <center><b>Total Piutang</b></center>
            </td>
            <td><b>@rupiah($total_piutang)</b></td>
        </tr>
    </thead>
</table>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<script>
    $(document).ready(function(){
        $('#example-table').dataTable();
    });
</script>