<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @if (auth()->user()->isRole('surveyor'))
                    <li> <a class="waves-effect waves-dark" href="{{url('tracking')}}" aria-expanded="false"><i class="mdi mdi-account-convert"></i><span class="hide-menu">Tracking</span></a></li>
                @endif
                @if(auth()->user()->isRole('admin'))
                    <li> <a class="waves-effect waves-dark" href="{{url('home')}}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Beranda</span></a></li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-check"></i><span class="hide-menu">Alumni</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{url('participant')}}">Alumni</a></li>
                            {{-- <li><a href="{{url('alumni-lawas')}}">Alumni 1980-2010</a></li> --}}
                            <li><a href="{{url('report')}}">Laporan Pekerjaan</a></li>
                        </ul>
                    </li>
                    
                    <li> <a class="waves-effect waves-dark" href="{{url('kuesioner')}}" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i><span class="hide-menu">Kuesioner</span></a></li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">Data Master</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{url('period')}}">Periode Pengisian</a></li>
                            <li><a href="{{url('schedule')}}">Jadwal Tracer Studi</a></li>
                        </ul>
                    </li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-city"></i><span class="hide-menu">User Survey</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{url('user-survey/company')}}">Perusahaan</a></li>
                            <li><a href="{{url('user-survey/kuesioner')}}">Kuesioner</a></li>
                            <li><a href="{{url('user-survey/periode')}}">Periode Survey</a></li>
                            <li><a href="{{url('user-survey/company-account')}}">Akun Perusahaan</a></li>
                            {{-- <li><a href="{{url('user-survey/report')}}">Laporan</a></li> --}}
                        </ul>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="{{url('user')}}" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">User</span></a></li>
                    <li> <a class="waves-effect waves-dark" href="{{url('/logout')}}" aria-expanded="false" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="mdi mdi-logout"></i><span class="hide-menu">Keluar</span></a></li>
                @endif
                @if(auth()->user()->isRole('user.survey'))
                    <li> <a class="waves-effect waves-dark" href="{{url('survey-stackholder')}}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Beranda</span></a></li>
                    <li> <a class="waves-effect waves-dark" href="{{url('survey-stackholder/company')}}" aria-expanded="false"><i class="mdi mdi-airballoon"></i><span class="hide-menu">Perusahaan</span></a></li>
                    <li> <a class="waves-effect waves-dark" href="{{url('survey-stackholder/kuesioner')}}" aria-expanded="false"><i class="mdi mdi-animation"></i><span class="hide-menu">Kuesioner</span></a></li>
                    <li> <a class="waves-effect waves-dark" href="{{url('survey-stackholder/company-account')}}" aria-expanded="false"><i class="mdi mdi-account-network"></i><span class="hide-menu">Akun Perusahaan</span></a></li>
                    <li> <a class="waves-effect waves-dark" href="{{url('/logout')}}" aria-expanded="false" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="mdi mdi-logout"></i><span class="hide-menu">Keluar</span></a></li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        <!-- item--><a href="#"></a>
        <!-- item--><a href="#"></a>
        <!-- item--><a href="{{url('/logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a> </div>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
    <!-- End Bottom points-->
</aside>