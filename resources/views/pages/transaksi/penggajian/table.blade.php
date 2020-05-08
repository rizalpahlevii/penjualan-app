@push('style')
<script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
@endpush
<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Pegawai</th>
            <th>Gaji Bulan</th>
            <th>Tanggal</th>
            <th>Faktur</th>
            <th>Gaji Pokok</th>
            <th>Potongan Gaji</th>
            <th>Gaji Bersih</th>
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
            <td>@rupiah($item->pegawai->jabatan->gaji_pokok)</td>
            <td>@rupiah($item->potongan_gaji)</td>
            <td>@rupiah($item->gaji_bersih)</td>
        </tr>
        @php
        $total += $item->gaji_bersih;
        @endphp
        @endforeach
    </tbody>
    <thead>
        <td colspan="7">
            <center><b>Total Gaji</b></center>
        </td>
        <td id="ttlpgj">@rupiah($total)</td>
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