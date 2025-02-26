@extends('index')
@section('Dashboard')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title text-center parkinsans-md">Jumlah Karyawan</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $totalKaryawan }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title text-center parkinsans-md">Jumlah Admin</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person-fill-gear"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $totalAdmin }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-0">
                                <h5 class="card-title parkinsans-md">Top 5 Best Employee</h5>
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center montserrat-md">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama Karyawan</th>
                                                <th scope="col">Kedisiplinan</th>
                                                <th scope="col">Kinerja</th>
                                                <th scope="col">Sikap Kerja</th>
                                                <th scope="col">Keahlian</th>
                                                <th scope="col">Total Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($penilaian->isNotEmpty())
                                                @foreach ($penilaian as $item)
                                                    <tr>
                                                        <td>{{ $item->user->name ?? 'Tidak Diketahui' }}</td>
                                                        <td>{{ $item->kedisiplinan }}</td>
                                                        <td>{{ $item->kinerja }}</td>
                                                        <td>{{ $item->sikap_kerja }}</td>
                                                        <td>{{ $item->keahlian }}</td>
                                                        <td>{{ $item->total_nilai }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5">Belum ada data penilaian.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Top Selling -->


                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header card-calender">
                        <h5 class="card-title text-center parkinsans-md">Calendar</h5>
                    </div>
                    <div class="card-body pb-0">
                        <div id="digital-calendar" class="text-center">
                            <div id="current-date" class="mb-2" style="font-size: 1.2em; font-weight: bold;"></div>
                            <div id="current-time" style="font-size: 1.5em; font-weight: bold; color: #007bff;"></div>
                        </div>
                    </div>
                </div>

            </div><!-- End Right side columns -->
        </div>
    </section>

    <style>
        .card-calender{
            background-color: #1A1A1D;
            color: #fff;
            max-height: 80px;
        }
        .card-calender h5{
            color: #fff;
            font-size: 24px;
        }
    </style>

    <script>
        function updateCalendar() {
            const now = new Date();

            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const currentDate = now.toLocaleDateString('id-ID', options);

            const currentTime = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

            document.getElementById('current-date').textContent = currentDate;
            document.getElementById('current-time').textContent = currentTime;
        }

        setInterval(updateCalendar, 1000);

        updateCalendar();
    </script>

</main><!-- End #main -->

@endsection
