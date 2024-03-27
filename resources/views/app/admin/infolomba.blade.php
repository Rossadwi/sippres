@extends('layouts.app')

@section('title', 'Page Title')
@section('aktifinfolomba', 'active')

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
                        <h3 class="card-title">Data Info Lomba</h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nama Lomba</th>
                                    <th>Penyelenggara</th>
                                    <th>Deskripsi</th>
                                    <th>Foto</th>
                                    <th>Pelaksanaan</th>
                                    <th>Panduan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(json_decode($data) as $row)
                                <tr>
                                    <td>{{$row->id_infolomba}}</td>
                                    <td>{{$row->nama_lomba}}</td>
                                    <td>{{$row->penyelenggara}}</td>
                                    <td>{{$row->deskripsi}}</td>
                                    <td><img src="/poster/{{$row->foto}}" width="75" alt="$row->foto"></td>
                                    <td>{{$row->waktu_daftar}} sampai {{$row->waktu_tutup}}</td>
                                    <td><a href="{{$row->panduan}}"target="_blank">Link Panduan</a></td>
                                    <td>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('deletinfolomba') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $row->id_infolomba }}">
                                            <a data-id="{{ $row->id_infolomba }}" data-all="{{json_encode($row)}}" class="btn btn-sm btn-warning edit" data-toggle="modal" data-target="#modal-edit" style="color: white;"><i class="bi bi-pencil-square"></i>EDIT</a>
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
            <form name="frm_add" id="frm_add" class="form-horizontal" action="{{ route('insertinfolomba') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Nama lomba</label>
                        <div class="col-lg-12">
                            <input type="text" name="nama_lomba" placeholder="nama lomba" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Penyelenggara</label>
                        <div class="col-lg-12">
                            <input type="text" name="penyelenggara" placeholder="penyelenggara" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Deskripsi</label>
                        <div class="col-lg-12">
                            <input type="text" name="deskripsi" placeholder="deskripsi" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-5 control-label">Waktu Pendaftaran</label>
                        <div class="col-lg-12">
                            <input type="Date" name="waktu_daftar" placeholder="waktu" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-5 control-label">Waktu Penutupan</label>
                        <div class="col-lg-12">
                            <input type="Date" name="waktu_tutup" placeholder="waktu" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Foto</label>
                        <div class="col-lg-12">
                            <!-- <label for="file-upload" class="btn btn-success">
                                <i class="fas fa-upload"></i> Choose File
                            </label>
                            <input id="file-upload" type="file" name="foto" style="display: none;" /> -->
                            <!-- <input type="file" name="foto" /> -->
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="foto">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Panduan</label>
                        <div class="col-lg-12">
                            <input type="text" name="panduan" placeholder="panduan" class="form-control">
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

<!-- modal edit data-->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="titleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <form name="frm_edit" id="editform" class="form-horizontal" action="{{ route('updateinfolomba') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5 text-center d-flex align-items-center justify-content-center">
                            <img id="foto" width="250px" height="250px">
                        </div>
                        <div class="col-7">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Nama lomba</label>
                                <div class="col-lg-12">
                                    <input type="hidden" name="iddata" class="form-control" id="iddata">
                                    <input type="text" name="nama_lomba" placeholder="nama lomba" class="form-control" id="namalomba">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Penyelenggara</label>
                                <div class="col-lg-12">
                                    <input type="text" name="penyelenggara" placeholder="penyelenggara" class="form-control" id="penyelenggara">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Deskripsi</label>
                                <div class="col-lg-12">
                                    <input type="text" name="deskripsi" placeholder="deskripsi" class="form-control" id="deskripsi">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-5 control-label">Waktu Pendaftaran</label>
                                <div class="col-lg-12">
                                    <input type="Date" name="waktu_daftar" placeholder="waktu" class="form-control" id="waktu_daftar">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-5 control-label">Waktu Penutupan</label>
                                <div class="col-lg-12">
                                    <input type="Date" name="waktu_tutup" placeholder="waktu" class="form-control" id="waktu_tutup">
                                </div>
                             </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Foto</label>
                                <div class="col-lg-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="foto">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <!-- <input type="file" name="foto" /> -->
                                    <input type="hidden" name="fotoo" class="form-control" id="fotoo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Panduan</label>
                                <div class="col-lg-12">
                                    <input type="text" id="panduan" name="panduan" placeholder="Masukkan link panduan" class="form-control">
                                </div>
                            </div>
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
            $('#fotoo').val(dataall.foto);
            $('#namalomba').val(dataall.nama_lomba);
            $('#penyelenggara').val(dataall.penyelenggara);
            $('#deskripsi').val(dataall.deskripsi);
            $('#waktu_daftar').val(dataall.waktu_daftar);
            $('#waktu_tutup').val(dataall.waktu_tutup);
            $('#panduan').val(dataall.panduan);
            document.getElementById('foto').src = "/poster/" + dataall.foto;
        });

        $('.custom-file-input').on('change', function() {
            const fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
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