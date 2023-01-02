<!-- Vertical Nav -->
<nav class="hk-nav hk-nav-dark">
    <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close">
        <span class="feather-icon"><i data-feather="x"></i></span></a>
    <div class="nicescroll-bar">
        <div class="navbar-nav-wrap">
            <ul class="navbar-nav flex-column">
                <li class="nav-item" id="dash">
                    <a class="nav-link" href="#" id="button-dash" data-active="dash" data-activ="" data-section="dash">
                        <span class="feather-icon"><i data-feather="activity"></i></span>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item" id="bEglise">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#dash_drp">
                        <span class="feather-icon"><i data-feather="home"></i></span>
                        <span class="nav-link-text">Pimis</span>
                    </a>
                    <ul id="dash_drp" class="nav flex-column collapse collapse-level-1" >
                        <li class="nav-item" >
                            <ul class="nav flex-column">
                                <li class="nav-item" id="pres">
                                    <a class="nav-link" href="#" id="button-pres" data-active="pres" data-open="bEglise" data-section="pres">Présentation</a>
                                </li>
                                <li class="nav-item" id="resp">
                                    <a class="nav-link" href="#" id="button-resp" data-active="resp" data-open="bEglise" data-section="resp">Responsables</a>
                                </li>
                                <li class="nav-item" id="agen" >
                                    <a class="nav-link" href="#" id="button-agen" data-active="agen" data-open="bEglise" data-section="agen">Agenda</a>
                                </li>
                                <li class="nav-item" id="serv">
                                    <a class="nav-link" href="#" id="button-serv" data-active="serv" data-open="bEglise" data-section="serv">Services</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="nav-item" id="bMedia">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#autht_drp">
                        <span class="feather-icon"><i data-feather="user"></i></span>
                        <span class="nav-link-text">Utilisateurs</span>
                    </a>
                    <ul id="autht_drp" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item" id="banner">
                                    <a class="nav-link" href="#" id="button-banner" data-active="banner" data-open="bMedia" data-section="banner">Utilisateurs</a>
                                </li>
                                <li class="nav-item" id="art">
                                    <a class="nav-link" href="#" id="button-art" data-active="art" data-open="bMedia" data-section="art">Agents</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="nav-item" id="bEvent">
                    <a class="nav-link" href="#" id="button-encour" data-active="encour" data-open="bEvent" data-section="encour">
                        <span class="feather-icon"><i data-feather="zap"></i></span>
                        <span class="nav-link-text">Evenement</span>
                    </a>
                </li>
            </ul>
            <hr class="nav-separator">
            <div class="nav-header">
                <span>tech</span>
            </div>
            <ul class="navbar-nav flex-column">

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="feather-icon"><i data-feather="headphones"></i></span>
                        <span class="nav-link-text">Support</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>


</nav>
<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>


<!-- /Vertical Nav -->


<div class="hk-settings-panel">
    <div class="nicescroll-bar position-relative">
        <div class="settings-panel-wrap">
            <div class="settings-panel-head">
                <a href="javascript:void(0);" id="settings_panel_close" class="settings-panel-close"><span
                        class="feather-icon"><i data-feather="x"></i></span></a>
            </div>
            <hr>
            <h6 class="mb-5">Navigation</h6>
            <p class="font-14">Menu comes in two modes: dark & light</p>
            <div class="button-list hk-nav-select mb-10">
                <button type="button" id="nav_light_select"
                    class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i
                            class="fa fa-sun-o"></i> </span><span class="btn-text">Light Mode</span></button>
                <button type="button" id="nav_dark_select"
                    class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i
                            class="fa fa-moon-o"></i> </span><span class="btn-text">Dark Mode</span></button>
            </div>
            <hr>
            <h6 class="mb-5">Top Nav</h6>
            <p class="font-14">Choose your liked color mode</p>
            <div class="button-list hk-navbar-select mb-10">
                <button type="button" id="navtop_light_select"
                    class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i
                            class="fa fa-sun-o"></i> </span><span class="btn-text">Light Mode</span></button>
                <button type="button" id="navtop_dark_select"
                    class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i
                            class="fa fa-moon-o"></i> </span><span class="btn-text">Dark Mode</span></button>
            </div>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <h6>Scrollable Header</h6>
                <div class="toggle toggle-sm toggle-simple toggle-light toggle-bg-primary scroll-nav-switch"></div>
            </div>
            <button id="reset_settings" class="btn btn-primary btn-block btn-reset mt-30">Reset</button>
        </div>
    </div>
</div>
<!-- /Setting Panel -->
