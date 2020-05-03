@push('style')
<script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
@endpush
<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Faktur</th>
            <th>Pembelian</th>
            <th>Pembayaran</th>
            <th>Suplier</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total=0;
        @endphp
        @foreach ($pembelian as $key=>$item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->tanggal_pembelian }}</td>
            <td>{{ $item->faktur }}</td>
            <td> @rupiah($item->total) </td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->suplier->nama }}</td>
            <td>
                <button class="btn btn-sm btn-success aksi" data-id="{{ $item->id }}"><i
                        class="fa fa-gear"></i></button>
            </td>
        </tr>
        @php
        $total+=$item->total;
        @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6">
                <center><b>Total</b></center>
            </td>
            <td>
                <b>@rupiah($total)</b>
            </td>
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