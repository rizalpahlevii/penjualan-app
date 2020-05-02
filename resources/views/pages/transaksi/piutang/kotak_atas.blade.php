<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">

                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    Pelanggan
                                </td>
                                <td>
                                    <select id="pelanggan" class="form-control">
                                        <option value="all">-Semua Pelanggan-</option>
                                        @foreach ($pelanggan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-success" style="width:100%" id="filter-atas"><i
                                            class="fa fa-search"></i>
                                        Filter</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Awal</td>
                                <td>
                                    <input type="text" class="form-control" id="startdate" placeholder="Tanggal awal"
                                        autocomplete="off">
                                </td>
                                <td>
                                    <select style="display:none" id="status" class="form-control">
                                        <option value="">Semua Transaksi</option>
                                        <option value="tunai">Tunai</option>
                                        <option value="kredit">Non Tunai</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Akhir</td>
                                <td>
                                    <input type="text" class="form-control" id="enddate" placeholder="Tanggal akhir"
                                        autocomplete="off">
                                </td>
                                <td>

                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <div id="totalPiutang">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <h3>Total Piutang</h3>
                                    </td>
                                    <td>
                                        <h3>@rupiah($total_piutang)</h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>