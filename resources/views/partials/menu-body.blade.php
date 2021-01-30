            <ul class="nav nav-aside">
                <li class="nav-item {{ (Request::is('') or Request::is('beranda')) ? 'active' : '' }}">
                    <a href="{{ route('beranda') }}" class="nav-link">
                        <i data-feather="home"></i>
                        <span>Beranda</span>
                    </a>
                </li>
                <li class="nav-label mg-t-10">Data Master</li>
                <li class="nav-item {{ Request::is('unitkerja*') ? 'active' : '' }}">
                    <a href="{{ route('unitkerja.index') }}" class="nav-link">
                        <i data-feather="package"></i>
                        <span>Unit Kerja</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('eksternal-uker*') ? 'active' : '' }}">
                    <a href="{{ route('eksternal.index') }}" class="nav-link">
                        <i data-feather="package"></i>
                        <span>Unit Kerja Eksternal</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('posisi*') ? 'active' : '' }}">
                    <a href="{{ route('posisi.index') }}" class="nav-link">
                        <i data-feather="layers"></i>
                        <span>Posisi</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('pegawai*') ? 'active' : '' }}">
                    <a href="{{ route('pegawai.index') }}" class="nav-link">
                        <i data-feather="users"></i>
                        <span>Pegawai</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('pelatihan*') ? 'active' : '' }}">
                    <a href="{{ route('pelatihan.index') }}" class="nav-link">
                        <i data-feather="feather"></i>
                        <span>Pelatihan</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('riwayat*') ? 'active' : '' }}">
                    <a href="{{ route('riwayat.index') }}" class="nav-link">
                        <i data-feather="activity"></i>
                        <span>Riwayat Jabatan</span>
                    </a>
                </li>
                <li class="nav-label mg-t-10">Kelola Data</li>
                <li class="nav-item {{ Request::is('karir*') ? 'active' : '' }}">
                    <a href="{{ route('karir.index') }}" class="nav-link">
                        <i data-feather="briefcase"></i>
                        <span>Karir</span>
                    </a>
                </li>
            </ul>