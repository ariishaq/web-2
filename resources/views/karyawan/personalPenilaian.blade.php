@extends('karyawan.index')
@section('PersonalPenilaian')

    <section id="section" class="penilaiansection">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center montserrat-md f28">Penilaian Saya</h1>
                    </div>
                    <div class="card-body">
                        @if ($penilaians->isEmpty())
                            <p>Belum ada penilaian untuk Anda.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover montserrat-md text-center">
                                    <thead>
                                        <tr>
                                            <th>Kedisiplinan</th>
                                            <th>Kinerja</th>
                                            <th>Sikap Kerja</th>
                                            <th>Keahlian</th>
                                            <th>Total Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($penilaians as $penilaian)
                                            <tr>
                                                <td>{{ $penilaian->kedisiplinan_label }}</td>
                                                <td>{{ $penilaian->kinerja_label }}</td>
                                                <td>{{ $penilaian->sikap_kerja_label }}</td>
                                                <td>{{ $penilaian->keahlian_label }}</td>
                                                <td>{{ $penilaian->total_nilai }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
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

