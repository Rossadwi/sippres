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
            <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Info Lomba</li>
                </ol>
            </div> -->
        </div>
    </div>
</section>

<section class="content">

    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">

                @foreach($data as $row)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column infolomba">
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
                                <a href="#" class="btn btn-sm btn-primary view" data-all="{{json_encode($row)}}" data-toggle="modal" data-target="#modal-view">
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
                            <label class="col-lg-12 control-label">Nama Lomba</label>
                            <div class="col-lg-12">
                                <input type="text" name="namalomba" placeholder="Nama Lomba" class="form-control" id="vnamalomba" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Penyelenggara</label>
                            <div class="col-lg-12">
                                <input type="text" name="penyelenggara" placeholder="penyelenggara" class="form-control" id="vpenyelenggara" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Deskripsi</label>
                            <div class="col-lg-12">
                                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control" style="width: 100%;" disabled></textarea>
                                <!-- <input type="text" name="tingkat" placeholder="tingkat" class="form-control" id="vtingkat" disabled> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-12 control-label">Waktu Pelaksanaan</label>
                            <div class="col-lg-12">
                                <input type="date" name="waktupelaksanaan" placeholder="Waktu Pelaksanaan" class="form-control" id="vwaktupelaksanaan" disabled>
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

</section>
<div class="card-body"></div>
@endsection

@push('scripts')
<script src="/adminlte/dist/js/demo.js"></script>
<script>
    $(function() {
        $('.infolomba').on('click', '.view', function() {
            let id = $(this).data('id');
            const dataall = $(this).data('all');
            console.log(dataall);
            $('#vnamalomba').val(dataall.nama_lomba);
            $('#vpenyelenggara').val(dataall.penyelenggara);
            $('#deskripsi').val(dataall.deskripsi);
            $('#vwaktupelaksanaan').val(dataall.waktu);
            document.getElementById('vbuktifoto').src = "/poster/" + dataall.foto;
            // console.log(dataall.id);
        });
    })
</script>
@endpush