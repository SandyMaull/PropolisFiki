@extends('admin.inc.app')

@section('title')
    Data Detail
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
                    <h1 class="m-0 text-dark">Data Detail {{ $self->nama }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Propolisku Data</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/home/data') }}">Module Data</a></li>
                        <li class="breadcrumb-item active">Data Detail</li>
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
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                    <label for="atasan">Superior (Atasan)</label>
                    <input id="atasan" type="text" class="form-control" value="{{ $atasan->nama }}" disabled>
                </div>
                <div class="form-group">
                    <label for="table_detail_data">Subordinate (Bawahan)</label>
                    <table id="table_detail_data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>No.Telp</th>
                                <th>Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bawahan as $baw)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $baw->nama }}</td>
                                    <td>{{ $baw->no_telp }}</td>
                                    <td>{{ $baw->position }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>No.Telp</th>
                                <th>Position</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
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
        $('#table_detail_data').DataTable({
            "paging": true,
            "lengthChange": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    </script>
@endsection