@extends('manager.index')
@section('TambahAdmin')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Admin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('hrd.index')}}">Home</a></li>
                <li class="breadcrumb-item active">Tambah Admin</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section id="section" class="section">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-section text-center">Tambah Admin</h3>
                </div>
                <div class="card-body">
                    <form id="adminForm" method="POST" action="/hrd/add-admin" class="row g-3">
                        @csrf
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label">Role:</label>
                            <select id="role" name="role" class="form-select" required>
                                <option value="admin">Admin</option>
                                <option value="hrd">HRD</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="alamat" class="form-label">Alamat:</label>
                            <input type="text" id="alamat" name="alamat" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="no_telp" class="form-label">No Telepon:</label>
                            <input type="text" id="no_telp" name="no_telp" class="form-control">
                        </div>
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary" id="submitButton">Tambah</button>
                            <a href="{{route('hrd.index')}}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('submitButton').addEventListener('click', function (event) {
            event.preventDefault();

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Pastikan data sudah benar sebelum disimpan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Simpan!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('adminForm').submit();
                }
            });
        });
    </script>
</main>

@endsection
