<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Halaman Login Kiat Ananda Group</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('Admin/img/Logo-kiat.jpeg')}}" rel="icon">
    <link href="{{asset('Admin/img/Logo-kiat.jpeg')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="{{url('https://fonts.gstatic.com')}}" rel="preconnect">
    <link href="{{url('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i')}}" rel="stylesheet">
    <link rel="preconnect" href="{{url('https://fonts.googleapis.com')}}">
    <link rel="preconnect" href="{{url('https://fonts.gstatic.com')}}" crossorigin>
    <link href="{{url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Parkinsans:wght@300..800&display=swap')}}" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('Admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('Admin/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('Admin/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('Admin/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('Admin/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('Admin/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('Admin/vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css')}}">

    <!-- Template Main CSS File -->
    <link href="{{asset('Admin/css/style.css')}}" rel="stylesheet">
</head>
<body>


    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
            <div class="card-header text-center">
                <img src="{{asset('Admin/img/Logo-kiat.jpeg')}}" class="logo-login" alt="kiat-ananda" loading="lazy">
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            <small class="mt-3 footnote">* Website Khusus Pegawai Kiat Ananda Group</small>
            <small class="footnote">* Gunakan Akun yang telah diberikan oleh Staff/Hrd</small>
        </div>
    </div>

    <style>
        body {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('Admin/img/Logistic.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>

    <!-- Vendor JS Files -->
    <script src="{{url('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
    <script src="{{asset('Admin/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('Admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('Admin/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('Admin/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('Admin/vendor/quill/quill.min.js')}}"></script>
    <script src="{{asset('Admin/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{asset('Admin/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('Admin/vendor/php-email-form/validate.js')}}"></script>
        <!-- Template Main JS File -->
    <script src="{{asset('Admin/js/main.js')}}"></script>
</body>
</html>
