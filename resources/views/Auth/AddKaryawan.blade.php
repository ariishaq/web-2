@extends('index')
@section('TambahKaryawan')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Karyawan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Tambah Karyawan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section id="section" class="section">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-section text-center">Tambah Karyawan</h3>
                </div>
                <div class="card-body mt-3">
                    <form id="addKaryawanForm" method="POST" action="/admin/add-karyawan">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nama:</label>
                                    <input type="text" id="name" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="no_telp" class="form-label">No Telepon:</label>
                                    <input type="text" id="no_telp" name="no_telp" class="form-control" required>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="alamat" class="form-label">Alamat:</label>
                                    <input type="text" id="alamat" name="alamat" class="form-control" required>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" id="submitButton" class="btn btn-primary">Tambah</button>
                                <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @if(session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <script>
        document.getElementById('submitButton').addEventListener('click', function () {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan ditambahkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tambahkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('addKaryawanForm').submit();
                }
            });
        });
    </script>
</main>

@endsection
