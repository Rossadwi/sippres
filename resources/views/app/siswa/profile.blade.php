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
                <h1>Contact us</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Contact us</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    @auth
    <div class="card card-solid">

        <div class="card-body row">
            <div class="col-5 text-center d-flex align-items-center justify-content-center">
                <div class="fotobukti">
                    <img id="vbukti" width="250px" height="250px" src="/images/{{auth()->user()->tampilnmuser(auth()->user()->username)->foto}}">
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
                    <!-- <input type="submit" class="btn btn-primary" value="Send message"> -->
                </div>
            </div>
        </div>

    </div>
    <div class="card-body"></div>
    @endauth
</section>


@endsection

@push('scripts')
<script src="/adminlte/dist/js/demo.js"></script>
@endpush