@extends('index')
@section('Profile')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('hrd.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Profile Saya</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="{{asset('Admin/img/review-profile.png')}}" alt="Profile" class="rounded-circle">
                        <h2 class="montserrat-md">{{ $user->name }}</h2>
                        <h3 class="montserrat-md">{{ $user->role }}</h3>
                    </div>
                </div>

            </div>

          <div class="col-xl-8">

            <div class="card">
              <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                    </li>
                </ul>
                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                        <h5 class="card-title">Profile Details</h5>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label parkinsans-md">Full Name</div>
                            <div class="col-lg-9 col-md-8 t-capitalize montserrat-md">{{ $user->name }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label parkinsans-md">Position</div>
                            <div class="col-lg-9 col-md-8 t-capitalize montserrat-md">{{ $user->role }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label parkinsans-md">Address</div>
                            <div class="col-lg-9 col-md-8 t-capitalize montserrat-md">{{ $user->alamat }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label parkinsans-md">Phone</div>
                            <div class="col-lg-9 col-md-8 t-capitalize montserrat-md">{{ $user->no_telp }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label parkinsans-md">Email</div>
                            <div class="col-lg-9 col-md-8 t-capitalize montserrat-md">{{ $user->email }}</div>
                        </div>
                    </div>

                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                    <!-- Profile Edit Form -->
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('admin.profile.update') }}" method="POST" id="profileForm">
                            @csrf

                            <!-- Full Name -->
                            <div class="row mb-3">
                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="name" type="text" class="form-control" id="fullName" value="{{ old('fullName', $user->name) }}" required>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="row mb-3">
                                <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="alamat" type="text" class="form-control" id="Address" value="{{ old('address', $user->alamat) }}">
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="row mb-3">
                                <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="no_telp" type="text" class="form-control" id="Phone" value="{{ old('phone', $user->no_telp) }}">
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="row mb-3">
                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="email" type="email" class="form-control" id="Email" value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>

                            <!-- Save Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="submitBtn">Save Changes</button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade pt-3" id="profile-change-password">
                        <!-- Change Password Form -->
                        <form id="changePasswordForm" action="{{ route('admin.change-password') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="current_password" type="password" class="form-control" id="currentPassword" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="new_password" type="password" class="form-control" id="newPassword" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="new_password_confirmation" type="password" class="form-control" id="renewPassword" required>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="submitButton">Change Password</button>
                            </div>
                        </form>

                        <!-- Notifikasi -->
                        @if(session('success'))
                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                        @endif

                    </div>

                </div><!-- End Bordered Tabs -->

              </div>
            </div>

          </div>
        </div>
    </section>
</main><!-- End #main -->

    <script>
        document.getElementById('submitBtn').addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Perubahan yang Anda buat akan disimpan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi, submit form
                    document.getElementById('profileForm').submit();
                }
            });
        });

        document.getElementById('changePasswordForm').addEventListener('submit', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "Your password will be changed!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                } else {
                    Swal.fire('Your password was not changed.', '', 'info');
                }
            });
        });
    </script>


@endsection
