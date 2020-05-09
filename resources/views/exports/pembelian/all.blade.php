<table>
    <thead>
        <tr>
            <td><b>No</b></td>
            <td><b>Tanggal</b></td>
            <td><b>Faktur</b></td>
            <td><b>Pembelian</b></td>
            <td><b>Pembayaran</b></td>
            <td><b>Suplier</b></td>
        </tr>
    </thead>
    <tbody>
        @php
        $total=0;
        @endphp
        @foreach ($pembelian as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->tanggal_pembelian }}</td>
            <td>{{ $item->faktur }}</td>
            <td>@rupiah($item->total)</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->suplier->nama }}</td>
        </tr>
        @php
        $total+=$item->total;
        @endphp
        @endforeach
    </tbody>
    <thead>
        <tr>
            <td colspan="5"><b>Total</b></td>
            <td><b>{{ $total }}</b></td>
        </tr>
    </thead>
</table>