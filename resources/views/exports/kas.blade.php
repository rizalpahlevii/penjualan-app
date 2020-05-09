<table>
    <thead>
        <tr>
            <th><b>#</b></th>
            <th><b>Tanggal</b></th>
            <th><b>Faktur</b></th>
            <th><b>Jenis</b></th>
            <th><b>Pendapatan</b></th>
            <th><b>Pengeluaran</b></th>
            <th><b>Keterangan</b></th>
        </tr>
    </thead>
    <tbody>
        @php
        $pemasukan =0 ;
        $pengeluaran =0;
        @endphp
        @foreach ($kas as $key => $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->tanggal }}</td>
            <td>{{ $row->faktur }}</td>
            <td>{{ $row->jenis }}</td>
            <td>@rupiah($row->pemasukan)</td>
            <td>@rupiah($row->pengeluaran)</td>
            <td>{{ $row->keterangan }}</td>
        </tr>
        @php
        $pemasukan +=$row->pemasukan;
        $pengeluaran +=$row->pengeluaran;
        @endphp
        @endforeach
    </tbody>
    <thead>
        <tr>
            <td colspan="6">
                <center><b>Total Pemasukan</b></center>
            </td>
            <td><b id="pdpt">@rupiah($pemasukan)</b></td>
        </tr>
        <tr>
            <td colspan="6">
                <center><b>Total Pengeluaran</b></center>
            </td>
            <td><b id="pgl">@rupiah($pengeluaran)</b></td>
        </tr>
        <tr>
            <td colspan="6">
                <center><b>Total Saldo</b></center>
            </td>
            <td><b id="sld">@rupiah($pemasukan - $pengeluaran)</b></td>
        </tr>
    </thead>
</table>