@extends('layouts.template')
@section('page','Input Transaksi')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-danger">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal Penggajian</label>
                                            <input type="text" name="tangal" class="form-control" id="tangal" readonly
                                                style="cursor:no-drop" value="{{ date('Y-m-d H:i:s') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="pengguna">Nama Pengguna</label>
                                            <input type="text" name="pengguna" class="form-control" id="pengguna"
                                                readonly style="cursor:no-drop" value="{{ Auth::user()->nama }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Faktur">Faktur</label>
                                            <input type="text" name="Faktur" class="form-control" id="Faktur" readonly
                                                style="cursor:no-drop" value="{{ $faktur }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="jabatan">Nama Pegawai</label>
                                            <div class="input-group">
                                                <input type="hidden" name="id_pegawai" id="id_pegawai"
                                                    class="form-control" readonly>
                                                <input type="text" name="nama_pegawai" id="nama_pegawai"
                                                    class="form-control" readonly>
                                                <span class="input-group-addon showModal" style="cursor: pointer;"><i
                                                        class="fa fa-user"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="no_telp">No Telp</label>
                                            <input type="text" name="no_telp" id="no_telp" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="jabatan">Jabatan</label>
                                            <input type="text" name="jabatan" id="jabatan" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="gaji_pokok">Gaji Pokok</label>
                                            <input type="text" name="gaji_pokok" id="gaji_pokok" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="potongan_gaji">Potongan Gaji</label>
                                            <input type="text" name="potongan_gaji" id="potongan_gaji"
                                                class="form-control" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="gaji_bersih">Gaji Bersih</label>
                                                <input type="text" name="gaji_bersih" id="gaji_bersih"
                                                    class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-danger">
            <div class=" box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="gaji_terakhir">Gaji Terakhir</label>
                            <input type="text" class="form-control" id="gaji_terakhir" name="gaji_terakhir" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" id="simpan"><i class="fa fa-save"></i> Simpan</button>
        <a href="{{ route('transaksi.penggajian.index') }}" class="btn btn-danger">Kembali</a>
    </div>
</div>



<div class="modal fade" id="modalPegawai">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Data Pegawai</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="example-table"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No HP</th>
                                        <th>Jabatan</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pegawai as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->nama }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->no_telp }}</td>
                                        <td>{{ $row->jabatan->nama }}</td>
                                        <td>{!! $row->alamat !!}</td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm btn-pilih"
                                                data-id="{{ $row->id }}" data-telp="{{ $row->no_telp }}"
                                                data-nama="{{ $row->nama }}" data-jabatan="{{ $row->jabatan->nama }}"
                                                data-gpokok="{{ $row->jabatan->gaji_pokok }}">
                                                Pilih</a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close"></i>
                    Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet"
    href="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/print/print.css">
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/sweetalert2/dist/sweetalert2.css">
<link rel="stylesheet"
    href="{{ asset('adminlte') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush
@push('script')
<script src="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<script src="{{ asset('adminlte') }}/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ asset('adminlte') }}/plugins/print/print.js"></script>
<script src="{{ asset('adminlte') }}/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<script>
    $(document).ready(function(){
        $('#example-table').dataTable();
        $('.showModal').click(function(){
            $('#modalPegawai').modal('show');
        });
        $(document).on('click','.btn-pilih',function(){
            $('#id_pegawai').val($(this).data('id'));
            $('#nama_pegawai').val($(this).data('nama'));
            $('#no_telp').val($(this).data('telp'));
            $('#jabatan').val($(this).data('jabatan'));
            $('#gaji_pokok').val($(this).data('gpokok'));
            $('#gaji_bersih').val($(this).data('gpokok'));
            getDetailPegawai($(this).data('id'));
            $('#modalPegawai').modal('hide');
        });
        function getDetailPegawai(id){
            let url = `{{ route('transaksi.penggajian.get_detail',':id') }}`;
            url = url.replace(':id',id);
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function (response) {
                    $('#gaji_terakhir').val(response);
                }
            });
        }
        $('#potongan_gaji').keyup(function(){
            const gaji_pokok = $('#gaji_pokok').val();
            if(gaji_pokok - $(this).val() <= 0){
                Swal.fire("error","Potongan terlalu banyak","error");
                $(this).val(0);
                return;
            }
            $('#gaji_bersih').val(gaji_pokok - $(this).val());
        });
        $('#simpan').click(function(){
            if($('#nama_pegawai').val() == ""){
                alert('Form masih kosong');
                return;
            }
            let url = `{{ route('transaksi.penggajian.store') }}`;
            $.ajax({
                type: "POST",
                url: url,
                data:{
                    id_pegawai : $('#id_pegawai').val(),
                    potongan_gaji : $('#potongan_gaji').val()
                },
                beforeSend:function(){
                    Swal.fire({
                        title: 'Loading .....',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        onOpen: () => {
                            Swal.showLoading()
                        }
                    })
                },
                dataType: "json",
                success: function (response) {
                    Swal.close();
                    if(response[0]=="success"){
                        Swal.fire("Success","Sukses menggaji pegawai","success").then(()=>{
                            let url = `{{ route('transaksi.penggajian.slip',':id') }}`;
                            url  = url.replace(':id',response[1].faktur);
                            window.open(url,'_blank');
                            location.href = `{{ route('transaksi.penggajian.index') }}`;
                        });
                    }else{
                        Swal.fire("Error",response[1],"error").then(()=>{
                            location.href = `{{ route('transaksi.penggajian.index') }}`;
                        });
                    }
                }
            });
        });
    })
</script>
@endpush