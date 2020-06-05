@push('style')
<script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
@endpush
<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Faktur</th>
            <th>Pemasukan</th>

            <th>Pembayaran</th>
            <th>Pelanggan</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total = 0;
        @endphp
        @foreach ($transaksi as $key => $item)
        @if ($item->status == "hutang")
        @if ($item->piutang != null)
        @if ($item->piutang->sisa_piutang == 0)
        <tr>
            <td>{{$loop->iteration }}</td>
            <td>{{ $item->tanggal_transaksi }}</td>
            <td>{{ $item->kode }}</td>
            <td> @rupiah($item->total ) </td>

            <td>{{ ucfirst($item->status) }}</td>
            <td>{{ $item->pelanggan->nama }}</td>
        </tr>
        @endif
        @endif
        @else
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->tanggal_transaksi }}</td>
            <td>{{ $item->kode }}</td>
            <td> @rupiah($item->total ) </td>
            <td>{{ ucfirst($item->status) }}</td>
            <td>{{ $item->pelanggan->nama }}</td>
        </tr>
        @endif
        @php
        $total += $item->total - ($item->ppn + $item->pph);
        @endphp
        @endforeach
    </tbody>
    <thead>
        <tr>
            <td colspan="5">
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