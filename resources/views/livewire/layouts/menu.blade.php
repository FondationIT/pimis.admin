<div>
   <!-- Top Navbar -->
    <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar">

        <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>

        <a class="navbar-brand font-weight-700" href="{{url('/')}}">

            <img src="img/logo/logoP.png" style="height: 40px;position: relative;" />
               
        </a>
        <ul class="navbar-nav hk-navbar-content">

            <li class="nav-item dropdown dropdown-notifications">
                <h4><span class="badge badge-danger">1 USD | {{ App\Models\Taux::firstWhere('active', true)->taux}} CDF</span></h4>
            </li>   

            <li class="nav-item dropdown dropdown-notifications">
                <a class="nav-link nav-link-hover dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><span class="feather-icon"><i
                            data-feather="mail"></i></span><span class="badge-wrap"id="countmess" ></span></a>
                <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                    <h6 class="dropdown-header">Messages <a class="" href="#" id="button-msg" data-active="msg" wire:click="$emit('msgUpdated')" data-section="msg">Voir tout</a></h6>
                    <div class="notifications-nicescroll-bar" id="outputmess" >

                    </div>
                </div>
            </li>

            <li class="nav-item dropdown dropdown-notifications">
                <a class="nav-link nav-link-hover dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><span class="feather-icon"><i
                            data-feather="bell"></i></span><span class="badge-wrap" id="countnot"></span></a>
                <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                    <h6 class="dropdown-header">Notifications <a href="javascript:void(0);" class="">Voir tout</a></h6>
                    <div class="notifications-nicescroll-bar" id="outputnot">

                    </div>
                </div>
            </li>


            <li class="nav-item dropdown dropdown-authentication">
                <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <div class="media">
                        <div class="media-img-wrap">
                            <div class="avatar">
                                <img src="{{asset('dist/img/avatar12.png')}}" alt=" user" class="avatar-img rounded-circle">
                            </div>
                            <span class="badge badge-success badge-indicator"></span>
                        </div>
                        <div class="media-body">
                            <span>{{ Auth::user()->name }}<i class="zmdi zmdi-chevron-down"></i></span>
                        </div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">

                    <a class="dropdown-item" href="#" id="button-profil" data-active="profil" wire:click="$emit('profilUpdated')" data-section="profil"><i class="dropdown-icon zmdi zmdi-account"></i>
                            Profile</a>

                    <div class="dropdown-divider"></div>
                    <div class="sub-dropdown-menu show-on-hover">
                        <a class="dropdown-toggle dropdown-item no-caret"><i class="zmdi zmdi-check text-success"></i>Online</a>
                    </div>

                    <div class="dropdown-divider"></div>
                    {{-- <a class="dropdown-item" href="setting"><i
                            class="dropdown-icon zmdi zmdi-settings"></i><span>Settings</span></a> --}}
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();"><i
                            class="dropdown-icon zmdi zmdi-power text-danger"></i><span>{{ __('Deconnexion') }}</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </li>


            <li class="nav-item">
                <a id="settings_toggle_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span
                        class="feather-icon"><i data-feather="settings"></i></span></a>
            </li>
        </ul>
    </nav>

</div>
