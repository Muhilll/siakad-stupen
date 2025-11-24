<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#"
                data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image"
                    src="{{ asset('img/avatar/avatar-1.png') }}"
                    class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">
                    @php
                        if(auth()->user()->role === 'admin'){
                            $nama = "Hi, Admin";
                        }elseif(auth()->user()->role === 'guru'){
                            $guru = App\Models\Guru::where('nip', auth()->user()->username)->first();
                            $nama = "Hi, ".$guru->nama_lengkap;
                        }else{
                            $siswa = App\Models\Siswa::where('nis', auth()->user()->username)->first();
                            $nama = "Hi, ".$siswa->nama;
                        }
                    @endphp
                    {{ $nama }}
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('profile') }}"
                    class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="dropdown-item has-icon text-danger">
                        Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
