@extends('layouts.app')

@section('title', 'Page Title')
@section('ismenu', 'menu-open')
@section('isverif', 'active')
@section('isverifkeaktifan', 'active')



@prepend('style')
<link rel="stylesheet" href="/adminlte/plugins/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" href="/adminlte/plugins/toastr/toastr.min.css">
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
                <div class="card card-primary card-outline mt-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Verifikasi Keaktifan
                        </h3>
                    </div>
                    <div class="card-body">
                        <!-- <h4>Custom Content Below</h4> -->
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Belum Diverifikasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Sudah Diverifikasi</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                <div class="mt-4">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nama Siswa</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Penyelenggara</th>
                                                <th>Waktu</th>
                                                <th>Foto</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(json_decode($data) as $row)
                                            <tr>
                                                <td>{{$row->id_keaktifan}}</td>
                                                <td>{{$row->nama_siswa}}</td>
                                                <td>{{$row->nama_kegiatan}}</td>
                                                <td>{{$row->penyelenggara}}</td>
                                                <td>{{$row->waktu}}</td>
                                                <td><img src="/keaktifan/{{$row->foto}}" width="75" alt="$row->foto"></td>
                                                <td>
                                                    @if($row->isverif == 0)
                                                    <a data-id="{{ $row->id_keaktifan }}" data-all="{{json_encode($row)}}" class="btn btn-sm btn-warning edit" data-toggle="modal" data-target="#modal-edit" style="color: white;"><i class="bi bi-pencil-square"></i>EDIT</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                <div class="mt-4">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nama Siswa</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Penyelenggara</th>
                                                <th>Waktu</th>
                                                <th>Foto</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(json_decode($dataverif) as $row)
                                            <tr>
                                                <td>{{$row->id_keaktifan}}</td>
                                                <td>{{$row->nama_siswa}}</td>
                                                <td>{{$row->nama_kegiatan}}</td>
                                                <td>{{$row->penyelenggara}}</td>
                                                <td>{{$row->waktu}}</td>
                                                <td><img src="/keaktifan/{{$row->foto}}" width="75" alt="$row->foto"></td>
                                                <td>
                                                    @if($row->isverif == 0)
                                                    <a data-id="{{ $row->id_keaktifan }}" data-all="{{json_encode($row)}}" class="btn btn-sm btn-warning edit" data-toggle="modal" data-target="#modal-edit" style="color: white;"><i class="bi bi-pencil-square"></i>EDIT</a>
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
            <form name="frm_add" id="frm_add" class="form-horizontal" action="{{ route('insertsiswa') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama</label>
                        <div class="col-lg-12">
                            <input type="text" name="nama_siswa" placeholder="nama" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nisn</label>
                        <div class="col-lg-12">
                            <input type="text" name="nisn" placeholder="nisn" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Jurusan</label>
                        <div class="col-lg-12">
                            <select class="form-control" name="jurusan">
                                <option value="IPA">IPA</option>
                                <option value="IPS">IPS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Angkatan</label>
                        <div class="col-lg-12">
                            <input type="text" name="angkatan" placeholder="angkatan" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Telp</label>
                        <div class="col-lg-12">
                            <input type="text" name="telp" placeholder="telp" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">foto</label>
                        <div class="col-lg-10">
                            <input type="file" name="foto" />
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <form name="frm_edit" id="editform" class="form-horizontal" action="{{ route('updateverifkeaktifan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5 text-center d-flex align-items-center justify-content-center">
                            <div class="fotobukti">
                            </div>
                        </div>
                        <div class="col-7">
                            <!-- <div class="form-group">
                                <label class="col-lg-8 control-label">id prestasi</label>
                                <div class="col-lg-12">
                                    </div>
                                </div> -->
                            <div class="form-group">
                                <label class="col-lg-8 control-label">Nama Siswa</label>
                                <div class="col-lg-12">
                                    <input type="text" name="id_keaktifan" placeholder="id keaktifan" class="form-control" id="idkeaktifan">
                                    <input type="text" name="namasiswa" placeholder="namasiswa" class="form-control" id="namasiswa" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">nama kegiatan</label>
                                <div class="col-lg-12">
                                    <input type="text" name="namakegiatan" placeholder="nama kegiatan" class="form-control" id="namakegiatan" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Penyelenggara</label>
                                <div class="col-lg-12">
                                    <input type="text" name="penyelenggara" placeholder="penyelenggara" class="form-control" id="penyelenggara" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Waktu</label>
                                <div class="col-lg-12">
                                    <input type="date" name="waktu" placeholder="waktu" class="form-control" id="waktu" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Verifikasi</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="isverif" id="option-ya" value="1">
                                            <label class="form-check-label" for="option-ya">
                                                Terima
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="isverif" id="option-tidak" value="2">
                                            <label class="form-check-label" for="option-tidak">
                                                Tolak
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Catatan</label>
                                <div class="col-lg-12">
                                    <textarea name="note" placeholder="catatan" class="form-control" id="note"></textarea>
                                </div>
                            </div>
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
                // {
                //     text: 'tambah ',
                //     action: function(e, dt, node, config) {
                //         $('#modalTambah').modal('show');
                //     }
                // }
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $("#example2").DataTable({
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
                // {
                //     text: 'tambah ',
                //     action: function(e, dt, node, config) {
                //         $('#modalTambah').modal('show');
                //     }
                // }
            ]
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');


        $('#example1').on('click', '.edit', function() {
            let id = $(this).data('id');
            const dataall = $(this).data('all');
            const img = document.createElement('img');
            img.src = "/keaktifan/" + dataall.foto;
            // img.classList.add('img-fluid');
            img.style.width = '250px';
            img.style.height = '250px';
            document.querySelector('.fotobukti').appendChild(img);
            console.log(dataall);
            $('#idkeaktifan').val(dataall.id_keaktifan);
            $('#namasiswa').val(dataall.nama_siswa);
            $('#namakegiatan').val(dataall.nama_kegiatan);
            $('#penyelenggara').val(dataall.penyelenggara);
            $('#waktu').val(dataall.waktu);
            // $('#fotoo').val(dataall.foto);
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