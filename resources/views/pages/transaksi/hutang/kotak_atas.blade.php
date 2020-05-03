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
                            <tr>
                                <td>
                                    <a href="#" class="btn btn-success" style="width:100%" id="filter-atas"><i
                                            class="fa fa-search"></i>
                                        Filter</a>
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
                                        <h3>Total Hutang</h3>
                                    </td>
                                    <td>
                                        <h3>@rupiah($total_hutang)</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>Total Hutang Terbayar</h3>
                                    </td>
                                    <td>
                                        <h3>@rupiah($total_hutang_terbayar)</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>Total Sisa Hutang</h3>
                                    </td>
                                    <td>
                                        <h3>@rupiah($total_sisa_hutang)</h3>
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