@push('style')
<script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
@endpush
<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Hutang</th>
            <th>Hutang Dibayar</th>
            <th>Hutang Sisa</th>
            <th>Tempo</th>
            <th>Suplier</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total_hutang = 0;
        $total_hutang_terbayar = 0;
        $total_hutang_sisa = 0;
        @endphp
        @foreach ($hutang as $key=>$item)
        <tr>
            <td>{{ $key++ }}</td>
            <td>{{ $item->tanggal_hutang }}</td>
            <td> @rupiah($item->total_hutang) </td>
            <td> @rupiah($item->pembayaran_hutang) </td>
            <td> @rupiah($item->sisa_hutang) </td>
            <td>{{ $item->tanggal_tempo }}</td>
            <td>{{ $item->pembelian->suplier->nama }}</td>

        </tr>
        @php
        $total_hutang += $item->total_hutang;
        $total_hutang_terbayar += $item->pembayaran_hutang;
        $total_hutang_sisa += $item->sisa_hutang;
        @endphp
        @endforeach
    </tbody>
    <thead>
        <tr>
            <td colspan="6">
                <center><b>Total Sisa Hutang</b></center>
            </td>
            <td><b>@rupiah($total_hutang_sisa)</b></td>
        </tr>
        <tr>
            <td colspan="6">
                <center><b>Total Hutang Terbayar</b></center>
            </td>
            <td><b>@rupiah($total_hutang_terbayar)</b></td>
        </tr>
        <tr>
            <td colspan="6">
                <center><b>Total Hutang</b></center>
            </td>
            <td><b>@rupiah($total_hutang)</b></td>
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