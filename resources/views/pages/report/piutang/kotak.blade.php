<div class="col-md-12">
    <div class="box box-danger">
        <div class=" box-body">
            <div class="row">
                <div class="col-md-6">

                    <table class="table">
                        <tbody>

                            <tr>
                                <td>Tanggal Awal</td>
                                <td>
                                    <input type="text" class="form-control" id="startdate" placeholder="Tanggal awal"
                                        autocomplete="off" value="{{ date('Y-m-d') }}">
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
                                        autocomplete="off" value="{{ date('Y-m-d') }}">
                                </td>
                            </tr>
                            <tr>

                                <td>
                                    <a href="#" class="btn btn-success" style="width:100%" id="filter-atas"><i
                                            class="fa fa-search"></i>
                                        Filter</a>
                                </td>
                                <td>
                                    <button class="btn btn-warning excel"><i class="fa fa-print"></i>
                                        Excel</button>
                                    <button class="btn btn-primary print"><i class="fa fa-print"></i> Print</button>
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
                                <tr>
                                    <td>
                                        <h3>Total Sisa Piutang</h3>
                                    </td>
                                    <td>
                                        <h3>@rupiah($total_sisa_piutang)</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>Total Piutang Terbayar</h3>
                                    </td>
                                    <td>
                                        <h3>@rupiah($total_piutang_terbayar)</h3>
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