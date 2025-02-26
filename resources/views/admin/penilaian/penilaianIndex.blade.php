@extends('index')
@section('PenilaianIndex')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Penilaian</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Tabel Penilaian</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-penilaian text-center">Tabel Penilaian</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped text-center">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">UID</th>
                                    <th scope="col">Nama Karyawan</th>
                                    <th scope="col">Kedisiplinan</th>
                                    <th scope="col">Kinerja</th>
                                    <th scope="col">Sikap Kerja</th>
                                    <th scope="col">Keahlian</th>
                                    <th scope="col">Total Nilai</th>
                                    <th scope="col">Nilai Rata-Rata</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($penilaian as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $item->user_id }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->kedisiplinan }}</td>
                                        <td>{{ $item->kinerja }}</td>
                                        <td>{{ $item->sikap_kerja }}</td>
                                        <td>{{ $item->keahlian }}</td>
                                        <td>{{ $item->total_nilai }}</td>
                                        <td>{{ round(($item->kedisiplinan + $item->kinerja + $item->sikap_kerja + $item->keahlian) / 4, 2) }}</td>
                                        <td>
                                            <a href="{{ route('penilaian.edit', $item->id) }}" class="btn btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('penilaian.destroy', $item->id) }}" method="POST" style="display: inline-block;" id="deleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" id="deleteBtn">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada data penilaian tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <p class="mention">
                                <b>#</b> Total Nilai Merupakan Hasil dari <b>Input x Bobot Nilai</b> <br>
                                <b>#</b> Bobot Nilai : <b>Kedisiplinan 40%, Kinerja 30%, Sikap Kerja 15%, Keahlian 15%</b> <br>
                                <b>#</b> Nilai Rata-Rata : <b>Input Nilai : 4 Aspek </b>(Tanpa Bobot)
                            </p>
                        </table>
                    </div>
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

    <script>
        document.getElementById('deleteBtn').addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus dan tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm').submit();
                }
            });
        });
    </script>
</main><!-- End #main -->

@endsection
