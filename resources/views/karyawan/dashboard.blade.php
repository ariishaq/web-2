@extends('karyawan.index')
@section('userDashboard')

<section id="section" class="section">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
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
    </div>
</section>

<style>
    .row {
        min-height: 90vh;
    }
</style>

@endsection
