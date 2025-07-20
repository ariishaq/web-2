@extends('manager.index')
@section('KaryawanIndex')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('hrd.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Daftar Karyawan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-penilaian text-center">Daftar Karyawan</h3>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        @foreach($karyawans as $karyawan)
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
                                                <h6 class="montserrat-md f14">{{ $karyawan->name }}</h6>
                                                <h6 class="montserrat-md f14 f-blue">Nip : 20251207{{ $karyawan->id }}</h6>
                                                <h6 class="montserrat-md f14">Karyawan</h6>
                                                <h6 class="montserrat-md f14">{{ $karyawan->alamat ?? 'Alamat tidak tersedia' }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="mailto:{{ $karyawan->email }}" class="btn btn-secondary" target="_blank">
                                            <i class="bi bi-envelope-fill"></i>
                                        </a>
                                        <a href="https://wa.me/{{ $karyawan->no_telp }}" class="btn btn-success" target="_blank">
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
