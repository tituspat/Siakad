<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link" style="">
        <span class="brand-text font-weight-light">SIAKAD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <!-- admin section -->
                @if (Auth::user()->role == 'Admin')
                    <li class="nav-item has-treeview" id="liDashboard">
                        <a href="#" class="nav-link" id="Dashboard">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-4">
                            <li class="nav-item">
                                <a href="{{ url('/') }}" class="nav-link" id="Home">
                                    <i class="fas fa-home nav-icon"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.home') }}" class="nav-link" id="AdminHome">
                                    <i class="fas fa-home nav-icon"></i>
                                    <p>Dashboard Admin</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview" id="liMasterData">
                        <a href="#" class="nav-link" id="MasterData">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Master Data
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-4">
                            <li class="nav-item">
                                <a href="{{ route('jadwal.index') }}" class="nav-link" id="DataJadwal">
                                    <i class="fas fa-calendar-alt nav-icon"></i>
                                    <p>Data Jadwal</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('guru.index') }}" class="nav-link" id="DataGuru">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Data Guru</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('kelas.index') }}" class="nav-link" id="DataKelas">
                                    <i class="fas fa-home nav-icon"></i>
                                    <p>Data Kelas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('siswa.index') }}" class="nav-link" id="DataSiswa">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Data Siswa</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link" id="DataUser">
                                    <i class="fas fa-user-plus nav-icon"></i>
                                    <p>Data User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('data-spp.index') }}" class="nav-link" id="DataSpp">
                                    <i class="fas fa-dollar-sign nav-icon"></i>
                                    <p>Data Spp</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('siswa.absensi') }}" class="nav-link" id="SiswaGuru">
                            <i class="fas fa-calendar-check nav-icon"></i>
                            <p>Absensi Siswa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.spp.history') }}" class="nav-link" id="HistoryPembayaran">
                            <i class="fas fa-dollar-sign nav-icon"></i>
                            <p>Pembayaran SPP</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('materi.index') }}" class="nav-link" id="ELearning">
                            <i class="nav-icon fas fa-clipboard"></i>
                            <p>E - Learning</p>
                        </a>
                    </li>

                    <!-- Guru section  -->
                @elseif (Auth::user()->role == 'Guru' || Auth::user()->guru(Auth::user()->id_card))
                    <li class="nav-item has-treeview">
                        <a href="{{ url('/') }}" class="nav-link" id="Home">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('absen.harian') }}" class="nav-link" id="AbsenGuru">
                            <i class="fas fa-calendar-check nav-icon"></i>
                            <p>Absen Siswa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('jadwal.guru') }}" class="nav-link" id="JadwalGuru">
                            <i class="fas fa-calendar-alt nav-icon"></i>
                            <p>Jadwal Ajar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guru.nilai') }}" class="nav-link" id="NilaiGuru">
                            <i class="fas fa-calendar-alt nav-icon"></i>
                            <p>Nilai</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('materi.kelas.guru') }}" class="nav-link" id="MateriGuru">
                            <i class="fas fa-calendar-alt nav-icon"></i>
                            <p>Materi Kelas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guru.tugas.index') }}" class="nav-link" id="MateriGuru">
                            <i class="fas fa-calendar-alt nav-icon"></i>
                            <p>Tugas Kelas</p>
                        </a>
                    </li>

                    <!-- Siswa section -->
                @elseif (Auth::user()->role == 'Siswa' && Auth::user()->siswa(Auth::user()->no_induk))
                    <li class="nav-item has-treeview">
                        <a href="{{ url('/') }}" class="nav-link" id="Home">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('jadwal.siswa') }}" class="nav-link" id="JadwalSiswa">
                            <i class="fas fa-calendar-alt nav-icon"></i>
                            <p>Jadwal</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('spp.siswa') }}" class="nav-link" id="SppSiswa">
                            <i class="fas fa-dollar-sign nav-icon"></i>
                            <p>SPP</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('materi.siswa') }}" class="nav-link" id="Elearning">
                            <i class="fas fa-file-alt nav-icon"></i>
                            <p>Materi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.tugas.index') }}" class="nav-link" id="Elearning">
                            <i class="fas fa-file-alt nav-icon"></i>
                            <p>Tugas</p>
                        </a>
                    </li>


                    <!-- owner section -->
                @elseif (Auth::user()->role == 'Owner')
                    <li class="nav-item has-treeview" id="liDashboard">
                        <a href="#" class="nav-link" id="Dashboard">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-4">
                            <li class="nav-item">
                                <a href="{{ url('/') }}" class="nav-link" id="Home">
                                    <i class="fas fa-home nav-icon"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('owner.data-siswa') }}" class="nav-link" id="DataSiswa">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Data Siswa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('owner.spp.history') }}" class="nav-link" id="DataKeuangan">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Data Keuangan</p>
                        </a>
                    </li>
                @else
                    <li class="nav-item has-treeview">
                        <a href="{{ url('/') }}" class="nav-link" id="Home">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>