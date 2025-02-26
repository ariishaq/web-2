<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('hrd.index') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-database-fill"></i><span>Data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('hrd.karyawan.index')}}">
                        <i class="bi bi-circle"></i><span> | <i class="bi bi-person-vcard-fill icons-sidebar"></i>Daftar Karyawan</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('hrd.penilaian')}}">
                        <i class="bi bi-circle"></i><span> | <i class="bi bi-layout-text-window-reverse icons-sidebar"></i>Tabel Penilaian</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('hrd.bestEmployee')}}">
                        <i class="bi bi-circle"></i><span> | <i class="bi bi-award-fill icons-sidebar"></i>Karyawan Terbaik</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('hrd.admin.index')}}">
                        <i class="bi bi-circle"></i><span> | <i class="bi bi-person-fill-gear icons-sidebar"></i>Daftar Admin</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Charts Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{url('/hrd/add-admin')}}">
                <i class="bi bi-person-fill-add"></i>
                <span>Tambah Admin</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->
