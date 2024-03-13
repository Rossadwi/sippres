@extends('layouts.appsiswa')

@section('title', 'Page Title')
@section('aktifprofilsiswa', 'active')

@prepend('style')

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
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Biodata Siswa</h1>
            </div>
            <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Contact us</li>
                </ol>
            </div> -->
        </div>
    </div>
</section>

<section class="content">
    @auth
    <div class="card card-solid">

        <div class="card-body row">
            <div class="col-5 text-center d-flex align-items-center justify-content-center">
                <div class="fotobukti">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-editfoto">
                        <img id="vbukti" width="250px" height="250px" src="/images/{{auth()->user()->tampilnmuser(auth()->user()->username)->foto}}">
                    </a>
                </div>
            </div>
            <div class="col-7">
                <div class="form-group">
                    <label for="inputName">Nama</label>
                    <input type="text" id="inputName" class="form-control" value="{{auth()->user()->tampilnmuser(auth()->user()->username)->nama_siswa}}" />
                </div>
                <div class="form-group">
                    <label for="inputEmail">Nisn</label>
                    <input type="text" id="inputEmail" class="form-control" value="{{auth()->user()->tampilnmuser(auth()->user()->username)->NISN}}" />
                </div>
                <div class="form-group">
                    <label for="Jurusan">Jurusan</label>
                    <input type="text" id="Jurusan" class="form-control" value="{{auth()->user()->tampilnmuser(auth()->user()->username)->jurusan}}" />
                </div>
                <div class="form-group">
                    <label for="inputSubject">Angkatan</label>
                    <input type="text" id="inputSubject" class="form-control" value="{{auth()->user()->tampilnmuser(auth()->user()->username)->angkatan}}" />
                </div>
                <div class="form-group">
                    <label for="inputSubject">Alamat</label>
                    <input type="text" id="inputSubject" class="form-control" value="{{auth()->user()->tampilnmuser(auth()->user()->username)->alamat}}" />
                </div>
                <div class="form-group">
                    <label for="inputSubject">Telp</label>
                    <input type="text" id="inputSubject" class="form-control" value="{{auth()->user()->tampilnmuser(auth()->user()->username)->telp}}" />
                </div>

                <div class="form-group">
                    <!-- <input type="submit" class="btn btn-primary" value="Send message">
                 -->
                    <a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#modal-editpwd" style="color: white;"><i class="bi bi-pencil-square"></i>Edit Password</a>
                </div>
            </div>
        </div>
    </div>



    <!-- form edit password -->
    <div class="modal fade" id="modal-editpwd" tabindex="-1" aria-labelledby="titleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Password</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <form name="frm_edit" id="editform" class="form-horizontal" action="{{ route('updatepasssiswa') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Password</label>
                                    <div class="col-lg-12">
                                        <input type="password" name="password" placeholder="password" class="form-control" id="password">
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

    <!-- form edit gambar -->
    <div class="modal fade" id="modal-editfoto" tabindex="-1" aria-labelledby="titleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Foto</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <form name="frm_edit" id="editform" class="form-horizontal" action="{{ route('updatefotosiswa') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">foto</label>
                                    <div class="col-lg-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="foto">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        <input type="hidden" name="iddata" class="form-control" id="iddata" value="{{auth()->user()->tampilnmuser(auth()->user()->username)->id_siswa}}">
                                        <input type="hidden" name="fotoo" id="fotoo" value="{{auth()->user()->tampilnmuser(auth()->user()->username)->foto}}" />
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






    <div class="card-body"></div>
    @endauth
</section>


@endsection

@push('scripts')
<script>
    $(() => {
        $('.custom-file-input').on('change', function() {
            const fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    })
</script>

<!-- <script src="/adminlte/dist/js/demo.js"></script> -->
@endpush