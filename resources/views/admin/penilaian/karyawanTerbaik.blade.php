@extends('index')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Penilaian</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Karyawan Terbaik</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="montserrat-md f24 text-center">Karyawan Terbaik dengan Nilai Tertinggi: <span class="badge text-bg-success">{{ number_format($highestScore, 2) }}</span></h3>
                </div>
                <div class="card-body mt-3">
                    @if ($bestEmployee)

                    <h6 class="montserrat-md f18">Nama: <span class="best-employee">{{ $bestEmployee->name }}</span></h6>
                    <h6 class="montserrat-md f18">Email: <span class="best-employee">{{ $bestEmployee->email }}</span></h6>
                    <h6 class="montserrat-md f18">Total Nilai: <span class="best-employee">{{ number_format($highestScore, 2) }}</span></h6>

                        <div class="alert alert-success mt-4">
                            <strong>Karyawan terbaik berdasarkan penilaian adalah yang memiliki nilai tertinggi: {{ number_format($highestScore, 2) }}!</strong>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            Tidak ada data karyawan terbaik.
                        </div>
                    @endif
                    <p class="mention">
                        <b>#</b> Total Nilai Merupakan Hasil dari <b>Input x Bobot Nilai</b> <br>
                        <b>#</b> Bobot Nilai : <b>Kedisiplinan 40%, Kinerja 30%, Sikap Kerja 15%, Keahlian 15%</b> <br>
                        <b>#</b> Nilai Rata-Rata : <b>Input Nilai : 4 Aspek </b>(Tanpa Bobot)
                    </p>
                </div>
            </div>
        </div>
    </section>

    <style>
        .mention{
            font-size: 14px;
            margin-top: 10px;
            font-style: italic;
        }
    </style>
</main><!-- End #main -->
@endsection
