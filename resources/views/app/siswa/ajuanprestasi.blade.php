@extends('layouts.appsiswa')

@section('title', 'Page Title')
@section('ismenu', 'menu-open')
@section('isajuan', 'active')
@section('isajuanprestasi', 'active')

@prepend('style')
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<style>
    @media print {

        html,
        body {
            height: auto;
        }

        .dt-print-table,
        .dt-print-table thead,
        .dt-print-table th,
        .dt-print-table tr {
            border: 0 none !important;
        }
    }
</style>

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
                        <table id="example1" class="table table-bordered table-striped display" style="width:100%">
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
                                        @elseif($row->isverif != 2)
                                        <a data-id="{{ $row->id_prestasi }}" data-all="{{json_encode($row)}}" class="btn btn-sm btn-info view" data-toggle="modal" data-target="#modal-view" style="color: white;"><i class="bi bi-pencil-square"></i>Lihat</a>

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
                            <!-- <input type="file" name="bukti" placeholder="bukti" class="form-control"> -->
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="bukti">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>

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

<!-- modal edit data-->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="titleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <form name="frm_edit" id="editform" class="form-horizontal" action="{{ route('updateajuanprestasi') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5 text-center d-flex align-items-center justify-content-center">
                            <div class="fotobukti">
                                <img id="buktifoto" width="250px" height="250px">
                            </div>
                        </div>
                        <div class="col-7">
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
                                    <!-- <input type="file" name="bukti" placeholder="bukti" class="form-control">-->
                                    <input type="hidden" name="buktii" class="form-control" id="buktii">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="bukti">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
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

<!-- modal view data-->
<div class="modal fade" id="modal-view" tabindex="-1" aria-labelledby="titleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Data</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-5 text-center d-flex align-items-center justify-content-center">
                        <div class="fotobukti">
                            <img id="vbuktifoto" width="250px" height="250px">
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Judul</label>
                            <div class="col-lg-12">
                                <input type="text" name="judul" placeholder="judul" class="form-control" id="vjudul" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Penyelenggara</label>
                            <div class="col-lg-12">
                                <input type="text" name="penyelenggara" placeholder="penyelenggara" class="form-control" id="vpenyelenggara" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tingkat</label>
                            <div class="col-lg-12">
                                <input type="text" name="tingkat" placeholder="tingkat" class="form-control" id="vtingkat" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tanggal</label>
                            <div class="col-lg-12">
                                <input type="date" name="tanggal" placeholder="tanggal" class="form-control" id="vtanggal" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
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

                // }, 

                {
                    extend: "pdf",
                    title: '',
                    // customize: function(win) {
                    //     // Menghapus elemen h1 (judul) dari dokumen
                    //     // $(win.document.body).find('h1').remove();

                    //     // Mengakses dokumen yang akan dicetak
                    //     let doc = win.document;

                    //     // Membuat elemen div dengan kelas 'row'
                    //     let rowDiv = doc.createElement("div");
                    //     rowDiv.className = "row";
                    //     rowDiv.style.textAlign = "center";
                    //     // rowDiv.style.border = "1px solid black";

                    //     // Kolom pertama (col-1) untuk gambar logo
                    //     let logoCol = doc.createElement("div");
                    //     logoCol.className = "col-sm-2";
                    //     // logoCol.style.border = "1px solid black";

                    //     // Menambahkan logo
                    //     let img = new Image();
                    //     img.src = '/adminlte/dist/img/sippreslogo.png';
                    //     img.width = 100; // Atur lebar gambar menjadi 200 piksel
                    //     img.height = 100; // Atur tinggi gambar menjadi 100 piksel
                    //     logoCol.appendChild(img);


                    //     // Kolom kedua (col-2) untuk nama perusahaan
                    //     let companyNameCol = doc.createElement("div");
                    //     companyNameCol.className = "col";

                    //     // Menambahkan nama perusahaan
                    //     let companyName = doc.createElement("h1");
                    //     companyName.textContent = "SMAN BANDAR KEDUNG MULYO";
                    //     companyNameCol.appendChild(companyName);

                    //     let dataPrestasiText = doc.createElement("h2");
                    //     dataPrestasiText.textContent = "Daftar prestasi siswa sman Bandar Kedung mulyo";
                    //     companyNameCol.appendChild(dataPrestasiText);


                    //     // Menambahkan kolom ke dalam baris
                    //     rowDiv.appendChild(logoCol);
                    //     rowDiv.appendChild(companyNameCol);
                    //     // // Menambahkan elemen hr
                    //     // let lineBreak = doc.createElement("hr");
                    //     // lineBreak.style.marginBottom = "100px";
                    //     // lineBreak.style.border = "1px solid black";
                    //     // rowDiv.appendChild(lineBreak);

                    //     // Menambahkan elemen div 'row' ke dalam body dokumen
                    //     doc.body.insertBefore(rowDiv, doc.body.firstChild);


                    // },
                    exportOptions: {
                        columns: [0, 1, 3, 4, 5], // Kolom id, name, email,role
                        customizeData: function(data) {
                            // console.log(data.header[4]);
                            let statusColumnIndex = data.header[4];
                            let filteredData = data.body.filter(function(row) {
                                // console.log(row[4] == "Diterima");
                                return row[4] == "Diterima";
                                // console.log(row.data[statusColumnIndex] == "Diterima");
                            });
                            // console.log(filteredData);
                            // Mengganti body data dengan data yang telah difilter
                            data.body = filteredData;

                            return data;
                        },
                    }
                },

                {
                    extend: "print",
                    title: '',
                    customize: function(win) {
                        // Menghapus elemen h1 (judul) dari dokumen
                        // $(win.document.body).find('h1').remove();

                        // Mengakses dokumen yang akan dicetak
                        let doc = win.document;

                        // Membuat elemen div dengan kelas 'row'
                        let rowDiv = doc.createElement("div");
                        rowDiv.className = "row";
                        rowDiv.style.textAlign = "center";
                        // rowDiv.style.border = "1px solid black";

                        // Kolom pertama (col-1) untuk gambar logo
                        let logoCol = doc.createElement("div");
                        logoCol.className = "col-sm-2";
                        // logoCol.style.border = "1px solid black";

                        // Menambahkan logo
                        let img = new Image();
                        img.src = '/adminlte/dist/img/sippreslogo.png';
                        img.width = 100; // Atur lebar gambar menjadi 200 piksel
                        img.height = 100; // Atur tinggi gambar menjadi 100 piksel
                        logoCol.appendChild(img);


                        // Kolom kedua (col-2) untuk nama perusahaan
                        let companyNameCol = doc.createElement("div");
                        companyNameCol.className = "col";

                        // Menambahkan nama perusahaan
                        let companyName = doc.createElement("h1");
                        companyName.textContent = "SMA NEGERI BANDARKEDUNGMULYO";
                        companyNameCol.appendChild(companyName);

                        let dataPrestasiText = doc.createElement("h2");
                        dataPrestasiText.textContent = "Capaian prestasi siswa SMA Negeri Bandarkedungmulyo";
                        companyNameCol.appendChild(dataPrestasiText);


                        // Menambahkan kolom ke dalam baris
                        rowDiv.appendChild(logoCol);
                        rowDiv.appendChild(companyNameCol);
                        // // Menambahkan elemen hr
                        // let lineBreak = doc.createElement("hr");
                        // lineBreak.style.marginBottom = "100px";
                        // lineBreak.style.border = "1px solid black";
                        // rowDiv.appendChild(lineBreak);

                        // Menambahkan elemen div 'row' ke dalam body dokumen
                        doc.body.insertBefore(rowDiv, doc.body.firstChild);


                    },
                    // repeatingHead: {
                    //     logo: 'https://www.google.co.in/logos/doodles/2018/world-cup-2018-day-22-5384495837478912-s.png',
                    //     logoPosition: 'right',
                    //     logoStyle: '',
                    //     title: '<h3>Sample Heading</h3>'
                    // },
                    exportOptions: {
                        columns: [0, 1, 3, 4, 5], // Kolom id, name, email,role
                        customizeData: function(data) {
                            // console.log(data.header[4]);
                            let filteredData = data.body.filter(function(row) {
                                // console.log(row[4] == "Diterima");
                                return row[4] == "Diterima";
                                // console.log(row.data[statusColumnIndex] == "Diterima");
                            });
                            // console.log(filteredData);
                            // Mengganti body data dengan data yang telah difilter
                            data.body = filteredData;

                            return data;
                        }, // Kolom id, name, email,role
                    }
                },
                //"colvis",
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
            document.getElementById('buktifoto').src = "/prestasi/" + dataall.bukti;
            // console.log(dataall.id);
        });

        $('#example1').on('click', '.view', function() {
            let id = $(this).data('id');
            const dataall = $(this).data('all');
            // console.log(dataall);
            $('#vjudul').val(dataall.judul);
            $('#vpenyelenggara').val(dataall.penyelenggara);
            $('#vtingkat').val(dataall.tingkat);
            $('#vtanggal').val(dataall.tanggal);
            document.getElementById('vbuktifoto').src = "/prestasi/" + dataall.bukti;
            // console.log(dataall.id);
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