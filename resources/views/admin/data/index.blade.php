@extends('admin.inc.app')

@section('title')
    Semua Data
@endsection

    @section('css')
    <link rel="stylesheet" href="{{ asset('administrator/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('administrator/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('administrator/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('administrator/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}"> 
@endsection

@section('breadcrumb')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Semua Data</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Propolisku Data</a></li>
                        <li class="breadcrumb-item">Module Data</li>
                        <li class="breadcrumb-item active">Semua Data</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-10">
                        <a type="button" href="#" class="btn btn-primary btn-sm">
                            Export
                        </a>
                        <a type="button" href="#" class="btn btn-primary btn-sm ml-2">
                            Import
                        </a>
                    </div>
                    <div class="col-2 text-center">
                        <a type="button" href="#" class="btn btn-success btn-sm" data-toggle='modal' data-target='#modal_add_data'>
                            Add
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="table_alldata" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>No.Telp</th>
                            <th>Position</th>
                            <th>Superior</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>No.Telp</th>
                            <th>Position</th>
                            <th>Superior</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


{{-- Modal Tambah Data --}}
    <div class="modal fade" id="modal_add_data">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('addDataPost') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Baru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="NamaEdit">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukan Data Nama">
                        </div>
                        <div class="form-group">
                            <label for="TelpEdit">No. Telp</label>
                            <input type="text" class="form-control" name="telp" placeholder="Masukan Data Nomor Telp">
                        </div>
                        <div class="form-group">
                            <label for="PositionEdit">Position</label>
                            <select class="form-control" name="position">
                                <option value="Distributor">Distributor</option>
                                <option value="Agent">Agent</option>
                                <option value="Reseller">Reseller</option>
                                <option value="CT">CT</option>
                                <option value="Other">Other</option>
                              </select>
                        </div>
                        <div class="form-group">
                            <label for="SuperiorEdit">Superior</label><br>
                            <input type="checkbox" id="rem_sup" name="non_superior" value="1">
                            <label for="rem_sup"> Non-Superior (Tanpa Atasan)</label><br>
                            <select class="cari form-control" name="superior"></select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


{{-- Modal Edit Data --}}
    <div class="modal fade" id="modal_edit_data">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('editDataPost') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_edit_title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="NamaEdit">Nama</label>
                            <input type="text" class="form-control" name="nama" id="NamaEdit" placeholder="Masukan Data Nama">
                        </div>
                        <div class="form-group">
                            <label for="TelpEdit">No. Telp</label>
                            <input type="text" class="form-control" name="telp" id="TelpEdit" placeholder="Masukan Data Nomor Telp">
                        </div>
                        <div class="form-group">
                            <label for="PositionEdit">Position</label>
                            <select class="form-control" name="position" id="PositionEdit">
                                <option value="Distributor">Distributor</option>
                                <option value="Agent">Agent</option>
                                <option value="Reseller">Reseller</option>
                                <option value="CT">CT</option>
                                <option value="Other">Other</option>
                              </select>
                        </div>
                        <div class="form-group">
                            <label for="SuperiorEdit">Superior</label><br>
                            <input type="checkbox" id="rem_sup" name="rem_superior" value="1">
                            <label for="rem_sup"> Remove Superior</label><br>
                            <select class="cari form-control" name="superior" id="SuperiorEdit"></select>
                        </div>
                    </div>
                    <input type="hidden" id="id_edit" name="id">
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Edit Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{-- Modal Delete Data --}}
    <div class="modal fade" id="modal_delete_data">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('deleteDataPost') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_delete_title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus data <b><span id="nama_delete"></span></b> ?
                    </div>
                    <input type="hidden" id="id_delete" name="id">
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('administrator/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        document.getElementById("sidebar_parent_data").classList.add("menu-open");
        document.getElementById("sidebar_child_alldata").classList.add("active");

    $(function () {
        $('#table_alldata').DataTable({
            "paging": true,
            "lengthChange": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('getAllDataJson') }}",
            columns: [
            { data: 'id' },
            { data: 'nama' },
            { data: 'no_telp' },
            { data: 'position' },
            { data: 'superior' },
            { data: 'action' },
         ]
        });
    });

    // Modal Edit Kandidat
        $('#modal_edit_data').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id');
            var nama = button.data('nama');
            var no_telp = button.data('no_telp');
            var position = button.data('position');
            var superior = button.data('superior');
            var modal = $(this);
            document.getElementById("id_edit").value = id;
            document.getElementById("NamaEdit").value = nama;
            document.getElementById("TelpEdit").value = no_telp;
            document.getElementById("PositionEdit").value = position;
            $('#modal_edit_title').text('Edit Data - ' + nama);
        });

    // Modal Delete Kandidat
        $('#modal_delete_data').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id');
            var nama = button.data('nama');
            var modal = $(this);
            document.getElementById("id_delete").value = id;
            document.getElementById("nama_delete").innerHTML = nama;
            $('#modal_delete_title').text('Delete Data - ' + nama);
        });

    // Select2 Edit Kandidat
        $('.cari').select2({
            placeholder: 'Cari...',
            ajax: {
            url: "{{ route('getNameDataJson') }}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                return {
                    text: item.nama,
                    id: item.id
                }
                })
            };
            },
            cache: true
            }
        });
    </script>
@endsection