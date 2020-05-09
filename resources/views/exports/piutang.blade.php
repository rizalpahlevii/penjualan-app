<table>
    <thead>
        <tr>
            <th><b>#</b></th>
            <th><b>Tanggal</b></th>
            <th><b>Invoice</b></th>
            <th><b>Piutang</b></th>
            <th><b>Piutang Dibayar</b></th>
            <th><b>Piutang Sisa</b></th>
            <th><b>Tempo</b></th>
            <th><b>Pelanggan</b></th>
        </tr>
    </thead>
    <tbody>
        @php
        $total_piutang = 0;
        $total_piutang_terbayar = 0;
        $total_piutang_sisa = 0;
        @endphp
        @foreach ($piutang as $key=>$item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->transaksi->tanggal_transaksi }}</td>
            <td>{{ $item->transaksi->kode }}</td>
            <td> {{ $item->total_hutang }} </td>
            <td> {{  $item->piutang_terbayar}}</td>
            <td> {{ $item->sisa_piutang }}</td>
            <td>{{ $item->tanggal_tempo }}</td>
            <td>{{ $item->pelanggan->nama }}</td>

        </tr>
        @php
        $total_piutang += $item->total_hutang;
        $total_piutang_terbayar += $item->piutang_terbayar;
        $total_piutang_sisa += $item->sisa_piutang;
        @endphp
        @endforeach
    </tbody>
    <thead>
        <tr>
            <td colspan="7">
                <center><b>Total Sisa Piutang</b></center>
            </td>
            <td><b>{{$total_piutang_sisa  }}</b></td>
        </tr>
        <tr>
            <td colspan="7">
                <center><b>Total Piutang Terbayar</b></center>
            </td>
            <td><b>{{ $total_piutang_terbayar }}</b></td>
        </tr>
        <tr>
            <td colspan="7">
                <center><b>Total Piutang</b></center>
            </td>
            <td><b>{{ $total_piutang }}</b></td>
        </tr>
    </thead>
</table>