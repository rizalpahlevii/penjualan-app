@push('style')
<script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
@endpush
<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Faktur</th>
            <th>Jenis</th>
            <th>Pendapatan</th>
            <th>Pengeluaran</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kas as $key => $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->tanggal }}</td>
            <td>{{ $row->faktur }}</td>
            <td>{{ $row->jenis }}</td>
            <td>{{ $row->pemasukan }}</td>
            <td>{{ $row->pengeluaran }}</td>
            <td>{{ $row->keterangan }}</td>
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