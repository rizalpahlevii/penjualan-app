<table>
    <thead>
        <tr>
            <th><b>#</b></th>
            <th><b>Kode Barang</b></th>
            <th><b>Nama Barang</b></th>
            <th><b>Tanggal</b></th>
            <th><b>Faktur</b></th>
            <th><b>Harga</b></th>
            <th><b>QTY</b> </th>
            <th><b>Jumlah</b></th>
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
            <td>{{ $no }}</td>
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
            <td>{{ $no }}</td>
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
            <td><b id="ttl">{{ $total }}</b></td>
        </tr>
    </thead>
</table>