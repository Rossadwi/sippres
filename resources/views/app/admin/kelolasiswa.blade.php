@extends('layouts.app')

@section('title', 'Page Title')
@section('aktifkelolasiswa', 'active')

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
                        <h3 class="card-title">Data siswa</h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nisn</th>
                                    <th>Nama</th>
                                    <th>Jurusan</th>
                                    <th>Angkatan</th>
                                    <th>Alamat</th>
                                    <th>Telp</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(json_decode($data) as $row)
                                <tr>
                                    <td>{{$row->id_siswa}}</td>
                                    <td>{{$row->NISN}}</td>
                                    <td>{{$row->nama_siswa}}</td>
                                    <td>{{$row->jurusan}}</td>
                                    <td>{{$row->angkatan}}</td>
                                    <td>{{$row->alamat}}</td>
                                    <td>{{$row->telp}}</td>
                                    <td><img src="/images/{{$row->foto}}" width="75" alt="$row->foto"></td>
                                    <td>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('deletesiswa') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $row->id_siswa }}">
                                            <input type="hidden" name="dtal" value="{{ json_encode($row)}}">

                                            <a data-id="{{ $row->id_siswa }}" data-all="{{json_encode($row)}}" class="btn btn-sm btn-warning edit" data-toggle="modal" data-target="#modal-edit" style="color: white;"><i class="bi bi-pencil-square"></i>EDIT</a>
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
                        <label class="col-lg-2 control-label">Alamat</label>
                        <div class="col-lg-12">
                            <input type="text" name="alamat" placeholder="alamat" class="form-control">
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
                        <div class="col-lg-12">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="foto">
                                <label class="custom-file-label" for="customFile">Choose file</label>
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

<!-- modal edit data-->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="titleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <form name="frm_edit" id="editform" class="form-horizontal" action="{{ route('updatesiswa') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5 text-center d-flex align-items-center justify-content-center">
                            <img id="foto" width="250px" height="250px">
                        </div>
                        <div class="col-7">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nama</label>
                                <div class="col-lg-12">

                                    <input type="hidden" name="iddata" class="form-control" id="iddata">
                                    <input type="text" name="name" placeholder="nama" class="form-control" id="nama">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nisn</label>
                                <div class="col-lg-12">
                                    <input type="text" name="nisn" placeholder="nisn" class="form-control" id="nisn">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Jurusan</label>
                                <div class="col-lg-12">
                                    <select class="form-control" name="jurusan" id="jurusan">
                                        <option value="IPA">IPA</option>
                                        <option value="IPS">IPS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Angkatan</label>
                                <div class="col-lg-12">
                                    <input type="text" name="angkatan" placeholder="angkatan" class="form-control" id="angkatan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Alamat</label>
                                <div class="col-lg-12">
                                    <input type="text" name="alamat" placeholder="alamat" class="form-control" id="alamat">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Telp</label>
                                <div class="col-lg-12">
                                    <input type="text" name="telp" placeholder="telp" class="form-control" id="telp">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">foto</label>
                                <div class="col-lg-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="foto">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <input type="hidden" name="fotoo" id="fotoo" />
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
            $('#nama').val(dataall.nama_siswa);
            $('#nisn').val(dataall.NISN);
            $('#jurusan').val(dataall.jurusan);
            $('#angkatan').val(dataall.angkatan);
            $('#alamat').val(dataall.alamat);
            $('#telp').val(dataall.telp);
            $('#fotoo').val(dataall.foto);
            document.getElementById('foto').src = "/images/" + dataall.foto;
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