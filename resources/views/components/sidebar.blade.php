<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">SIAKAD</a>
        </div>
        <ul class="sidebar-menu">
            {{-- <li class="menu-header">Guru</li> --}}
            @if (auth()->user()->role === 'guru')
                <li class="{{ Request::is('guru') ? 'active' : '' }} {{ $type_menu === 'guru.dashboard' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('guru.dashboard') }}"><i class="fas fa-fire"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('guru/kelas*') ? 'active' : '' }} {{ $type_menu === 'guru.kelas' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('guru.kelas') }}"><i class="fa-solid fa-people-roof"></i>
                        <span>Kelas</span>
                    </a>
                </li>
                {{-- <li class="{{ Request::is('guru/materi') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('guru.materi') }}"><i class="fa-solid fa-book"></i>
                        <span>Materi</span>
                    </a>
                </li>
                <li class="{{ Request::is('guru/tugas') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('guru.tugas') }}"><i class="fa-solid fa-list-check"></i>
                        <span>Tugas</span>
                    </a>
                </li> --}}
                {{-- <li class="{{ Request::is('guru/absensi') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('guru.absensi') }}"><i class="fa fa-users"></i>
                        <span>Absensi</span>
                    </a>
                </li> --}}
                <li class="{{ Request::is('profile') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('profile') }}"><i class="fa-regular fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
            @endif

            {{-- <li class="menu-header">Siswa</li> --}}
            @if (auth()->user()->role === 'siswa')                
                <li class="{{ Request::is('siswa') ? 'active' : '' }} {{ $type_menu === 'siswa.dashboard' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('siswa.dashboard') }}"><i class="fas fa-fire"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('siswa/mapel*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('siswa.mapel') }}"><i class="fa-solid fa-book"></i>
                        <span>Mata Pelajaran</span>
                    </a>
                </li>
                {{-- <li class="{{ Request::is('siswa/tugas') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('siswa.tugas') }}"><i class="fa-solid fa-list-check"></i>
                        <span>Tugas Saya</span>
                    </a>
                </li> --}}
                <li class="{{ Request::is('profile') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('profile') }}"><i class="fa-regular fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
            @endif

            {{-- <li class="menu-header">Admin</li> --}}
            @if (auth()->user()->role === 'admin')      
                <li class="{{ Request::is('admin') ? 'active' : '' }} {{ $type_menu === 'admin.dashboard' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i>
                        <span>Dashboard</span>
                    </a>
                </li>   
                <li class="nav-item dropdown {{ $type_menu === 'data-pengguna' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fa fa-users"></i><span>Data Pengguna</span></a>
                    <ul class="dropdown-menu">
                        <li class='{{ Request::is('admin/guru') ? 'active' : '' }}'>
                            <a class="nav-link" href="{{ route('admin.guru.index') }}">
                                Guru
                            </a>
                        </li>
                        <li class='{{ Request::is('admin/siswa') ? 'active' : '' }}'>
                            <a class="nav-link" href="{{ route('admin.siswa.index') }}">
                                Siswa
                            </a>
                        </li>
                        <li class='{{ Request::is('admin/admins') ? 'active' : '' }}'>
                            <a class="nav-link" href="{{ route('admin.admins.index') }}">
                                Admin
                            </a>
                        </li>   
                    </ul>
                </li>
                <li class="{{ Request::is('admin/mapel*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.mapel.index') }}"><i class="fa-solid fa-book"></i>
                        <span>Mata Pelajaran</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/kelas*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.kelas.index') }}"><i class="fa-solid fa-people-roof"></i>
                        <span>Kelas</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/absensi*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.absensi.index')}}"><i class="fa fa-calendar"></i>
                        <span>Rekap Absensi</span>
                    </a>
                </li>
                <li class="{{ Request::is('profile') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('profile') }}"><i class="fa-regular fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li> 
            @endif
        </ul> 
    </aside>
</div>
