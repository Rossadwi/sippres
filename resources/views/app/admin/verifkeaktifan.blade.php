@extends('layouts.app')

@section('title', 'Page Title')
@section('ismenu', 'menu-open')
@section('isverif', 'active')
@section('isverifkeaktifan', 'active')



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
                        <h3 class="card-title">verif keaktifan</h3>
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
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <form name="frm_edit" id="editform" class="form-horizontal" action="{{ route('updatesiswa') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
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
                        <div class="col-lg-10">
                            <input type="file" name="foto" />
                            <input type="hidden" name="fotoo" id="fotoo" />
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
            $('#nama').val(dataall.nama_siswa);
            $('#nisn').val(dataall.NISN);
            $('#jurusan').val(dataall.jurusan);
            $('#angkatan').val(dataall.angkatan);
            $('#alamat').val(dataall.alamat);
            $('#telp').val(dataall.telp);
            $('#fotoo').val(dataall.foto);
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