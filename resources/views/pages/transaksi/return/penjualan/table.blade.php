@push('style')
<script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
@endpush
<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Invoice Return</th>
            <th>Invoice Penjualan</th>
            <th>Pelanggan</th>
            <th>Return Dibayar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($return as $key => $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->tanggal_return_jual }}</td>
            <td>{{ $row->faktur }}</td>
            <td>{{ $row->transaksi->kode }}</td>
            <td>{{ $row->transaksi->pelanggan->nama }}</td>
            <td>{{ $row->total_bayar }}</td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<script>
    $(document).ready(function(){
        $('#example-table').dataTable();
    });
</script>