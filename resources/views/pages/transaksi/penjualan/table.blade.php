@push('style')
<script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
@endpush
<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Faktur</th>
            <th>Total</th>
            <th>PPN</th>
            <th>PPH</th>
            <th>Pembayaran</th>
            <th>Pelanggan</th>
            <th>Nota</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total = 0;
        @endphp
        @foreach ($transaksi as $key => $item)

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->tanggal_transaksi }}</td>
            <td>{{ $item->kode }}</td>
            <td> @rupiah($item->total - ($item->ppn + $item->pph)) </td>
            <td> @rupiah($item->ppn) </td>
            <td> @rupiah($item->pph) </td>
            <td>{{ ucfirst($item->status) }}</td>
            <td>{{ $item->pelanggan->nama }}</td>
            <td>
                <a href="{{ route('transaksi.penjualan.nota',$item->kode) }}" class="btn btn-primary btn-sm"><i
                        class="fa fa-print"></i></a>
            </td>
        </tr>

        @php
        $total += $item->total - ($item->ppn + $item->pph);
        @endphp
        @endforeach
    </tbody>
    <thead>
        <tr>
            <td colspan="8">
                <center><b>Total</b></center>
            </td>
            <td><b id="ttlpnj">@rupiah($total)</b></td>
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