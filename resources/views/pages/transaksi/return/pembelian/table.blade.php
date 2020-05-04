@push('style')
<script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
@endpush
<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Faktur Return</th>
            <th>Faktur Pembelian</th>
            <th>Suplier</th>
            <th>Return Dibayar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total=0
        @endphp
        @foreach ($return as $key => $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->tanggal_return_pembelian }}</td>
            <td>{{ $row->faktur }}</td>
            <td>{{ $row->pembelian->faktur }}</td>
            <td>{{ $row->pembelian->suplier->nama }}</td>
            <td>@rupiah($row->total_bayar)</td>
            <td><button class="btn btn-success btn-xs info" data-id="{{ $row->id }}"><i class="fa fa-gear"></i></button>
            </td>
        </tr>
        @php
        $total+=$row->total_bayar
        @endphp
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <td colspan="6">
                <center><b>Total</b></center>
            </td>
            <td><b>@rupiah($total)</b></td>
        </tr>
    </tfoot>
</table>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<script>
    $(document).ready(function(){
        $('#example-table').dataTable();
    });
</script>