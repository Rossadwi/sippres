@extends('layouts.appsiswa')

@section('title', 'Page Title')
@section('aktifinfolomba', 'active')

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
                <h1>Info Lomba</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Info Lomba</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">

    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">

                @foreach($data as $row)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            {{$row->nama_lomba}}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>{{$row->penyelenggara}}</b></h2>
                                    <p class="text-muted text-sm">
                                        {{$row->deskripsi}}
                                    </p>
                                    <p class="text-muted text-sm">
                                        <b>Pelaksanaan: </b> {{$row->waktu}}
                                    </p>
                                    <!-- <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                                    </ul> -->
                                </div>
                                <div class="col-5 text-center">
                                    <img src="/poster/{{$row->foto}}" alt="user-avatar" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <!-- <a href="#" class="btn btn-sm bg-teal">
                                    <i class="fas fa-comments"></i>
                                </a> -->
                                <a href="#" class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> View Poster
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        <div class="card-footer">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <!-- {{json_encode($data)}} -->
                    @if ($data->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo; Previous</span>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="{{ $data->previousPageUrl() }}" class="page-link">&laquo; Previous</a>
                    </li>
                    @endif

                    @if ($data->nextPageUrl())
                    <li class="page-item">
                        <a href="{{ $data->nextPageUrl() }}" class="page-link">Next &raquo;</a>
                    </li>
                    @else
                    <li class="page-item disabled">
                        <span class="page-link">Next &raquo;</span>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>

    </div>

</section>
<div class="card-body"></div>
@endsection

@push('scripts')
<script src="/adminlte/dist/js/demo.js"></script>
@endpush