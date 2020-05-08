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
                                    <input title="tanggal transaksi" class="form-control datepicker-here" type="text"
                                        id="startdate" data-language="en" autocomplete="off"
                                        value="{{ date('Y-m-d') }}">
                                </td>
                                <td>
                                    <select id="status" class="form-control">
                                        <option value="all">Semua Transaksi</option>
                                        <option value="tunai">Tunai</option>
                                        <option value="hutang">Non Tunai</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Akhir</td>

                                <td>
                                    <input title="tanggal transaksi" class="form-control datepicker-here" type="text"
                                        id="enddate" data-language="en" autocomplete="off" value="{{ date('Y-m-d') }}">
                                </td>

                                <td>
                                    <a href="#" class="btn btn-success" style="width:100%" id="filter1"><i
                                            class="fa fa-search"></i>
                                        Filter</a>
                                </td>
                            </tr>
                            <tr>
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
                                        <h3>Total Pembelian</h3>
                                    </td>
                                    <td>
                                        <h3>@rupiah($total)</h3>
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