@extends('manager.index')
@section('AdminIndex')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('hrd.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Daftar Admin</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-penilaian text-center">Daftar Admin</h3>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        @foreach($admins as $admin)
                            <div class="col-md-4">
                                <div class="card shadow-sm mb-4">
                                    <div class="card-body">
                                        <div class="row align-items-center mt-2">
                                            <div class="col-md-4 mt-3 text-center">
                                                <img src="{{ asset('Admin/img/review-profile.png') }}"
                                                    class="img-fluid rounded-circle"
                                                    alt="Profile Picture">
                                            </div>
                                            <div class="col-md-8 mt-3">
                                                <h6 class="montserrat-md f14">{{ $admin->name }}</h6>
                                                <h6 class="montserrat-md f14">Admin</h6>
                                                <h6 class="montserrat-md f14">{{ $admin->alamat ?? 'Alamat tidak tersedia' }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="mailto:{{ $admin->email }}" class="btn btn-secondary" target="_blank">
                                            <i class="bi bi-envelope-fill"></i>
                                        </a>
                                        <a href="https://wa.me/{{ $admin->no_telp }}" class="btn btn-success" target="_blank">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


</main><!-- End #main -->

@endsection
