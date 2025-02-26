<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('admin.index') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-table"></i><span>Penilaian Karyawan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('penilaian.create')}}">
                        <i class="bi bi-circle"></i><span> | <i class="bi bi-plus-lg icons-sidebar"></i>Buat Penilaian</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('penilaian.index')}}">
                        <i class="bi bi-circle"></i><span> | <i class="bi bi-layout-text-window-reverse icons-sidebar"></i>Tabel Penilaian</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('karyawan.terbaik')}}">
                        <i class="bi bi-circle"></i><span> | <i class="bi bi-layout-text-window-reverse icons-sidebar"></i>Karyawan Terbaik</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Charts Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('admin.karyawanIndex')}}">
                <i class="bi bi-person-vcard-fill"></i>
                <span>Daftar Karyawan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('admin.addKaryawanForm')}}">
                <i class="bi bi-person-fill-add"></i>
                <span>Tambah Karyawan</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->
