@extends('layouts.appsiswa')

@section('title', 'Page Title')
@section('ismenu', 'menu-open')
@section('isajuan', 'active')
@section('isajuanprestasi', 'active')

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
                        <h3 class="card-title">Ajuan Prestasi</h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>judul</th>
                                    <th>penyelenggara</th>
                                    <th>bukti</th>
                                    <th>tingkat</th>
                                    <th>tanggal</th>
                                    <th>status</th>
                                    <th>note</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(json_decode($data) as $row)
                                <tr>
                                    <td>{{$row->judul}}</td>
                                    <td>{{$row->penyelenggara}}</td>
                                    <td><img src="/prestasi/{{$row->bukti}}" width="75" alt="$row->bukti"></td>
                                    <td>{{$row->tingkat}}</td>
                                    <td>{{$row->tanggal}}</td>
                                    <!-- <td>{{$row->isverif}}</td> -->
                                    <td>
                                        @if($row->isverif == 1)
                                        <span class="badge badge-success">Diterima</span>
                                        @elseif($row->isverif == 2)
                                        <span class="badge badge-danger">Ditolak (REVISI)</span>
                                        @elseif($row->isverif == 0)
                                        <span class="badge badge-warning">Belum diverifikasi</span>
                                        @endif
                                    </td>
                                    <td>{{$row->note}}</td>
                                    <td>
                                        @if($row->isverif == 2)
                                        <a data-id="{{ $row->id_prestasi }}" data-all="{{json_encode($row)}}" class="btn btn-sm btn-warning edit" data-toggle="modal" data-target="#modal-edit" style="color: white;"><i class="bi bi-pencil-square"></i>EDIT</a>
                                        @endif
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
            <form name="frm_add" id="frm_add" class="form-horizontal" action="{{ route('insertajuanprestasi') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Judul</label>
                        <div class="col-lg-12">
                            <input type="text" name="judul" placeholder="judul" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Penyelenggara</label>
                        <div class="col-lg-12">
                            <input type="text" name="penyelenggara" placeholder="penyelenggara" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Bukti</label>
                        <div class="col-lg-12">
                            <input type="file" name="bukti" placeholder="bukti" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Tingkat</label>
                        <div class="col-lg-12">
                            <input type="text" name="tingkat" placeholder="tingkat" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Tanggal</label>
                        <div class="col-lg-12">
                            <input type="date" name="tanggal" placeholder="tanggal" class="form-control">
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
            <form name="frm_edit" id="editform" class="form-horizontal" action="{{ route('updateajuanprestasi') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                <div class="form-group">
                        <label class="col-lg-2 control-label">Judul</label>
                        <div class="col-lg-12">
                            <input type="hidden" name="iddata" class="form-control" id="iddata">
                            <input type="text" name="judul" placeholder="judul" class="form-control" id="judul">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Penyelenggara</label>
                        <div class="col-lg-12">
                            <input type="text" name="penyelenggara" placeholder="penyelenggara" class="form-control" id="penyelenggara">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Bukti</label>
                        <div class="col-lg-12">
                            <input type="file" name="bukti" placeholder="bukti" class="form-control">
                            <input type="hidden" name="buktii" class="form-control" id="buktii">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Tingkat</label>
                        <div class="col-lg-12">
                            <input type="text" name="tingkat" placeholder="tingkat" class="form-control" id="tingkat">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Tanggal</label>
                        <div class="col-lg-12">
                            <input type="date" name="tanggal" placeholder="tanggal" class="form-control" id="tanggal">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
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
            // console.log(dataall);
            $('#iddata').val(id);
            $('#judul').val(dataall.judul);
            $('#penyelenggara').val(dataall.penyelenggara);
            $('#buktii').val(dataall.bukti);
            $('#tingkat').val(dataall.tingkat);
            $('#tanggal').val(dataall.tanggal);
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