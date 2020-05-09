<table>
    <thead>
        <tr>
            <th><b>#</b></th>
            <th><b>Nama Pegawai</b></th>
            <th><b>Gaji Bulan</b></th>
            <th><b>Tanggal</b></th>
            <th><b>Faktur</b></th>
            <th><b>Gaji Pokok</b></th>
            <th><b>Potongan Gaji</b></th>
            <th><b>Gaji Bersih</b></th>
        </tr>
    </thead>
    <tbody>
        @php
        $total=0;
        @endphp
        @foreach ($penggajian as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->pegawai->nama }}</td>
            <td>{{ Carbon\Carbon::parse($item->tanggal_gaji)->format('M-Y') }}</td>
            <td>{{ $item->tanggal_gaji }}</td>
            <td>{{ $item->faktur }}</td>
            <td>{{ $item->pegawai->jabatan->gaji_pokok }}</td>
            <td>{{ $item->potongan }}</td>
            <td>{{ $item->gaji_bersih }}</td>
        </tr>
        @php
        $total += $item->gaji_bersih;
        @endphp
        @endforeach
    </tbody>
    <thead>
        <tr>

            <td colspan="7">
                <center><b>Total Gaji</b></center>
            </td>
            <td id="ttlpgj">{{ $total }}</td>
        </tr>
    </thead>

</table>