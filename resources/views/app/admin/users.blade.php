@extends('layouts.app')

@section('title', 'Page Title')
@section('aktifusers', 'active')

@prepend('style')
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

@endprepend

@section('content')

@if($message = Session::get('success'))

<div class="alert alert-success" id="alertMessage">
    {{ $message }}
</div>

@endif

@if($errors->any())
<div class="alert alert-danger" id="alertMessage">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Data Users</h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>role</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(json_decode($datauser) as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->role}}</td>
                                    <td>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('deleteusers') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                            <a data-id="{{ $row->id }}" data-all="{{json_encode($row)}}" class="btn btn-sm btn-warning edit" data-toggle="modal" data-target="#modal-edit" style="color: white;"><i class="bi bi-pencil-square"></i>EDIT</a>
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- modal add data-->
<div class="modal" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frm_add" id="frm_add" class="form-horizontal" action="{{ route('insertusers') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Name</label>
                        <div class="col-lg-12">
                            <input type="text" name="name" placeholder="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-12">
                            <input type="email" name="email" placeholder="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-12">
                            <input type="password" name="password" placeholder="Password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Role</label>
                        <div class="col-lg-12">
                            <select class="form-control" name="role" id="Role">
                                <option value="0">Admin</option>
                                <option value="1">Siswa</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="titleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <form name="frm_edit" id="editform" class="form-horizontal" action="{{ route('updateusers') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Name</label>
                        <div class="col-lg-12">
                            <input type="hidden" name="iddata" class="form-control" id="iddata">
                            <input type="text" name="name" placeholder="name" class="form-control" id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-12">
                            <input type="email" name="email" placeholder="email" class="form-control" id="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-12">
                            <input type="password" name="password" placeholder="Password" class="form-control" id="password">
                            <input type="hidden" name="passwordd" placeholder="Password" class="form-control" id="passwordd">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Role</label>
                        <div class="col-lg-12">
                            <select class="form-control" name="role" id="role">
                                <option value="0">Admin</option>
                                <option value="1">Siswa</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection

@push('scripts')
<script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/adminlte/plugins/jszip/jszip.min.js"></script>
<script src="/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            // "dom": 'Bfrtip',
            "buttonsVisible": true,
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            "buttons": [
                // "copy",
                // {
                //     extend: "csv",
                //     exportOptions: {
                //         columns: [0, 1, 2, 3] // Kolom id, name, email,role
                //     }

                // }, {
                //     extend: "excel",
                //     exportOptions: {
                //         columns: [0, 1, 2, 3] // Kolom id, name, email,role
                //     }

                // }, {
                //     extend: "pdf",
                //     exportOptions: {
                //         columns: [0, 1, 2, 3] // Kolom id, name, email,role
                //     }
                // }, {
                //     extend: "print",
                //     exportOptions: {
                //         columns: [0, 1, 2, 3] // Kolom id, name, email,role
                //     }
                // }, "colvis",
                {
                    text: 'tambah ',
                    action: function(e, dt, node, config) {
                        $('#modalTambah').modal('show');
                    }
                }
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


        $('#example1').on('click', '.edit', function() {
            let id = $(this).data('id');
            const dataall = $(this).data('all');
            $('#iddata').val(id);
            $('#name').val(dataall.name);
            $('#email').val(dataall.email);
            $('#passwordd').val(dataall.password);
            $('#role').val(dataall.role);
            // console.log(dataall.id);
        });
    });
    setTimeout(function() {
        const alertMessage = document.getElementById('alertMessage');
        if (alertMessage) {
            alertMessage.style.display = 'none';
        }
    }, 3000); //meset hilang selama 3 detik
</script>
@endpush