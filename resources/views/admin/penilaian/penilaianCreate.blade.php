@extends('index')
@section('PenilaianCreate')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Penilaian</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Buat Penilaian</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-penilaian text-center">Tambah Penilaian</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('penilaian.store') }}" method="POST" id="penilaianForm">
                            @csrf

                            <!-- Pilih Karyawan -->
                            <div class="mb-4">
                                <label for="user_id" class="form-label"><strong>Pilih Karyawan</strong></label>
                                <select name="user_id" id="user_id" class="form-select" required>
                                    <option value="">-- Pilih Karyawan --</option>
                                    @foreach ($karyawans as $karyawan)
                                        <option value="{{ $karyawan->id }}">{{ $karyawan->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kedisiplinan -->
                            <div class="mb-4">
                                <label class="form-label"><strong>Kedisiplinan</strong></label>
                                <div class="d-flex custom-gap">
                                    @foreach ([1 => 'Tidak Bagus', 2 => 'Cukup Bagus', 3 => 'Bagus', 4 => 'Sangat Bagus'] as $value => $label)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kedisiplinan" id="kedisiplinan{{ $value }}" value="{{ $value }}" required>
                                            <label class="form-check-label" for="kedisiplinan{{ $value }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Kinerja -->
                            <div class="mb-4">
                                <label class="form-label"><strong>Kinerja</strong></label>
                                <div class="d-flex custom-gap">
                                    @foreach ([1 => 'Tidak Bagus', 2 => 'Cukup Bagus', 3 => 'Bagus', 4 => 'Sangat Bagus'] as $value => $label)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kinerja" id="kinerja{{ $value }}" value="{{ $value }}" required>
                                            <label class="form-check-label" for="kinerja{{ $value }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Sikap Kerja -->
                            <div class="mb-4">
                                <label class="form-label"><strong>Sikap Kerja</strong></label>
                                <div class="d-flex custom-gap">
                                    @foreach ([1 => 'Tidak Bagus', 2 => 'Cukup Bagus', 3 => 'Bagus', 4 => 'Sangat Bagus'] as $value => $label)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sikap_kerja" id="sikap_kerja{{ $value }}" value="{{ $value }}" required>
                                            <label class="form-check-label" for="sikap_kerja{{ $value }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Keahlian -->
                            <div class="mb-4">
                                <label class="form-label"><strong>Keahlian</strong></label>
                                <div class="d-flex custom-gap">
                                    @foreach ([1 => 'Tidak Bagus', 2 => 'Cukup Bagus', 3 => 'Bagus', 4 => 'Sangat Bagus'] as $value => $label)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="keahlian" id="keahlian{{ $value }}" value="{{ $value }}" required>
                                            <label class="form-check-label" for="keahlian{{ $value }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
                                <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan disimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('penilaianForm').submit();
                }
            });
        });
    </script>


</main><!-- End #main -->

@endsection
