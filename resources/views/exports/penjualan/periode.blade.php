<table>
    <thead>
        <tr>
            <th><b>#</b></th>
            <th><b>Tanggal</b> </th>
            <th><b>Faktur</b> </th>
            <th><b>Pemasukan</b> </th>
            <th><b>PPN</b> </th>
            <th><b>PPH</b> </th>
            <th><b>Pembayaran</b> </th>
            <th><b>Pelanggan</b> </th>
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
            <td>{{ $key++ }}</td>
            <td>{{ $item->tanggal_transaksi }}</td>
            <td>{{ $item->kode }}</td>
            <td> {{ $item->total - ($item->ppn + $item->pph) }} </td>
            <td> {{ $item->ppn }} </td>
            <td> {{ $item->pph }} </td>
            <td>{{ ucfirst($item->status) }}</td>
            <td>{{ $item->pelanggan->nama }}</td>
        </tr>
        @endif
        @endif
        @else
        <tr>
            <td>{{ $key++ }}</td>
            <td>{{ $item->tanggal_transaksi }}</td>
            <td>{{ $item->kode }}</td>
            <td> {{ $item->total - ($item->ppn + $item->pph) }} </td>
            <td> {{ $item->ppn }} </td>
            <td> {{ $item->pph }} </td>
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
            <td colspan="7">
                <center><b>Total</b></center>
            </td>
            <td><b id="ttl">{{ $total }}</b></td>
        </tr>
    </thead>
</table>