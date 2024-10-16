<!--start sidebar-->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="logo-icon">
            <img src="{{ url('assets/images/auth/logo-asmoro.png') }}" class="logo-img" alt="">
        </div>
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">ASPRAS</h5>
        </div>
        <div class="sidebar-close">
            <span class="material-icons-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav">
        <!--navigation-->
        <ul class="metismenu" id="sidenav">
            <li>
                <a href="{{ url('/') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">place</i></div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li class="menu-label">Data</li>
            <li>
                <a href="{{ url('damageReport') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">electrical_services</i></div>
                    <div class="menu-title">Laporan Kerusakan</div>
                </a>
            </li>
            
            @if (auth()->user()->hasRole('teknisi'))
            <li class="menu-label">Teknisi</li>
            <li>
                <a href="{{ url('damageReport') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">electrical_services</i></div>
                    <div class="menu-title">Laporan Kerusakan</div>
                </a>
            </li>
            <li>
                <a href="{{ url('repairActivity') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">construction</i></div>
                    <div class="menu-title">Perbaikan Peralatan</div>
                </a>
            </li> 
            @endif
            {{-- <li>
                <a href="{{ url('suhu') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">thermostat</i></div>
                    <div class="menu-title">Suhu dan Status</div>
                </a>
            </li>
            <li>
                <a href="{{ url('analisis') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">bar_chart</i></div>
                    <div class="menu-title">Grafik dan Analisa</div>
                </a>
            </li>
            <li>
                <a href="{{ url('umurtrafo') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">calendar_today</i></div>
                    <div class="menu-title">Umur Trafo</div>
                </a>
            </li>
            <li>
                <a href="{{ url('losses') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">trending_down</i></div>
                    <div class="menu-title">Losses</div>
                </a>
            </li> --}}
            {{-- <li class="menu-label">Data Informasi User</li> --}}
            {{-- <li>
                <a href="{{ url('usergangguantrafo') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">warning</i></div>
                    <div class="menu-title">Gangguan Trafo</div>
                </a>
            </li>
            <li>
                <a href="{{ url('userperalatan') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">construction</i></div>
                    <div class="menu-title">Peralatan Sistem</div>
                </a>
            </li>
            <li>
                <a href="{{ url('usermanual') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">book</i></div>
                    <div class="menu-title">Manual Book dan SOP</div>
                </a>
            </li> --}}
            {{-- <li class="menu-label">Log Data ESP</li>
            <li>
                <a href="{{ url('log') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">sensors</i></div>
                    <div class="menu-title">Log Data Sensor ESP</div>
                </a>
            </li> --}}
            @if (auth()->user()->hasRole('admin'))
                
                <li class="menu-label">Data Master</li>
                
                <li>
                    <a href="{{ url('facility') }}">
                        <div class="parent-icon"><i class="material-icons-outlined">layers</i></div>
                        <div class="menu-title">Fasilitas</div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('repairActivity') }}">
                        <div class="parent-icon"><i class="material-icons-outlined">construction</i></div>
                        <div class="menu-title">Perbaikan Peralatan</div>
                    </a>
                </li> 
                
               
                {{-- 
                <li>
                    <a href="{{ url('trafo') }}">
                        <div class="parent-icon"><i class="material-icons-outlined">transform</i></div>
                        <div class="menu-title">Trafo</div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('gangguantrafo') }}">
                        <div class="parent-icon"><i class="material-icons-outlined">build</i></div>
                        <div class="menu-title">Gangguan Trafo</div>
                    </a>
                </li>
                
                <li>
                    <a href="{{ url('manual') }}">
                        <div class="parent-icon"><i class="material-icons-outlined">book</i></div>
                        <div class="menu-title">Manual Book dan SOP</div>
                    </a>
                </li> --}}
                <li>
                    <a href="{{ url('users') }}">
                        <div class="parent-icon"><i class="material-icons-outlined">people</i></div>
                        <div class="menu-title">User</div>
                    </a>
                </li>
                {{-- <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="material-icons-outlined">settings</i></div>
                        <div class="menu-title">Setting</div>
                    </a>
                    <ul>
                        <li> <a href="{{ url('trigger') }}">
                                <i class="material-icons-outlined">notification_important</i>Notifikasi Trigger</a>
                        </li>
                        <li> <a href="{{ url('trigger-tolerance') }}">
                                <i class="material-icons-outlined">notification_important</i>Notifikasi Trigger Toleransi</a>
                        </li>
                        <li> <a href="{{ url('notifikasihwa') }}">
                                <i class="material-icons-outlined">notifications</i>Notifikasi WA</a>
                        </li>
                    </ul>
                </li> --}}
            @endif
            {{-- <li class="menu-label">Informasi</li>
            <li>
                <a href="{{ url('about') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">info</i></div>
                    <div class="menu-title">Informasi</div>
                </a>
            </li> --}}
        </ul>
        <!--end navigation-->
    </div>
</aside>
<!--end sidebar-->
