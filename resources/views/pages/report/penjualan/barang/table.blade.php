@push('style')
<script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
@endpush
<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Tanggal</th>
            <th>Faktur</th>
            <th>Harga</th>
            <th>QTY</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no=1;
        $total=0;
        @endphp
        @foreach ($transaksi as $row)
        @if ($row->status == "hutang")
        @if ($row->piutang != null)
        @if ($row->sisa_piutang == 0)
        @foreach ($row->detail_transaksi as $detail)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $detail->barang->nama }}</td>
            <td>{{ $detail->barang->id }}</td>
            <td>{{ $row->tanggal_transaksi }}</td>
            <td>{{ $row->kode }}</td>
            <td>{{ $detail->harga }}</td>
            <td>{{ $detail->jumlah_beli }}</td>
            <td>{{ $detail->subtotal }}</td>
        </tr>
        @php
        $no++;
        $total += $detail->subtotal;
        @endphp
        @endforeach
        @endif
        @endif
        @else

        @foreach ($row->detail_transaksi as $detail)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $detail->barang->nama }}</td>
            <td>{{ $detail->barang->id }}</td>
            <td>{{ $row->tanggal_transaksi }}</td>
            <td>{{ $row->kode }}</td>
            <td>{{ $detail->harga }}</td>
            <td>{{ $detail->jumlah_beli }}</td>
            <td>{{ $detail->subtotal }}</td>
        </tr>
        @php
        $no++;
        $total+=$detail->subtotal;
        @endphp
        @endforeach
        @endif

        @endforeach
    </tbody>
    <thead>
        <tr>
            <td colspan="7">
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