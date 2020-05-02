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
        @foreach ($piutang as $key=>$item)
        <tr>
            <td>{{ $key++ }}</td>
            <td>{{ $item->transaksi->tanggal_transaksi }}</td>
            <td>{{ $item->transaksi->kode }}</td>
            <td>{{ $item->total_hutang }}</td>
            <td>{{ $item->piutang_terbayar }}</td>
            <td>{{ $item->sisa_piutang }}</td>
            <td>{{ $item->tanggal_tempo }}</td>
            <td>{{ $item->pelanggan->nama }}</td>
            <td>
                <button class="btn btn-sm btn-success aksi" data-id="{{ $item->id }}"><i
                        class="fa fa-gear"></i></button>
            </td>
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