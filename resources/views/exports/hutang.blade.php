<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example-table">
    <thead>
        <tr>
            <th><b>#</b></th>
            <th><b>Tanggal</b></th>
            <th><b>Hutang</b></th>
            <th><b>Hutang Dibayar</b></th>
            <th><b>Hutang Sisa</b></th>
            <th><b>Tempo</b></th>
            <th><b>Suplier</b></th>
        </tr>
    </thead>
    <tbody>
        @php
        $total_hutang = 0;
        $total_hutang_terbayar = 0;
        $total_hutang_sisa = 0;
        @endphp
        @foreach ($hutang as $key=>$item)
        <tr>
            <td>{{ $key++ }}</td>
            <td>{{ $item->tanggal_hutang }}</td>
            <td> @rupiah($item->total_hutang) </td>
            <td> @rupiah($item->pembayaran_hutang) </td>
            <td> @rupiah($item->sisa_hutang) </td>
            <td>{{ $item->tanggal_tempo }}</td>
            <td>{{ $item->pembelian->suplier->nama }}</td>

        </tr>
        @php
        $total_hutang += $item->total_hutang;
        $total_hutang_terbayar += $item->pembayaran_hutang;
        $total_hutang_sisa += $item->sisa_hutang;
        @endphp
        @endforeach
    </tbody>
    <thead>
        <tr>
            <td colspan="6">
                <center><b>Total Sisa Hutang</b></center>
            </td>
            <td><b>@rupiah($total_hutang_sisa)</b></td>
        </tr>
        <tr>
            <td colspan="6">
                <center><b>Total Hutang Terbayar</b></center>
            </td>
            <td><b>@rupiah($total_hutang_terbayar)</b></td>
        </tr>
        <tr>
            <td colspan="6">
                <center><b>Total Hutang</b></center>
            </td>
            <td><b>@rupiah($total_hutang)</b></td>
        </tr>
    </thead>
</table>