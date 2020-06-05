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
            <th>Pembayaran</th>
            <th>Pelanggan</th>
            <th>Nota</th>
            <th>Cashback</th>
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
            <td>{{ ucfirst($item->status) }}</td>
            <td>{{ $item->pelanggan->nama }}</td>
            <td>
                <a target="_blank" href="{{ route('transaksi.penjualan.nota',$item->kode) }}"
                    class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>
            </td>
            <th>
                @if ($item->status == "hutang")
                @if ($item->cashback == null)
                @if ($item->piutang->total_hutang == $item->piutang->piutang_terbayar)
                <a href="{{ route('transaksi.penjualan.cashback',$item->kode) }}" class="btn btn-success btn-sm"><i
                        class="fa fa-print"></i> Input Cashback</a>
                @else
                <span class="badge badge-danger">Piutang Belum Lunas</span>
                @endif
                @else
                <span class="badge badge-danger">Cashback Sudah Dibayar</span>
                @endif
                @else
                @if ($item->cashback == null)
                <a href="{{ route('transaksi.penjualan.cashback',$item->kode) }}" class="btn btn-success btn-sm"><i
                        class="fa fa-print"> </i> Input Cashback</a>
                @else
                <a target="_blank" href="{{ route('transaksi.penjualan.cashback_nota',$item->kode) }}"
                    class="btn btn-success btn-sm"><i class="fa fa-print"></i> Nota Cashback</a>
                @endif
                @endif
            </th>
        </tr>

        @php
        $total += $item->total - ($item->ppn + $item->pph);
        @endphp
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