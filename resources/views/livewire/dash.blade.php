
@if($needsCardVerification || ($isNewUser || $hasPasswordExpired))
    <!-- Fullscreen Modal -->
    <!-- BLOCKING MODAL -->

    @if($needsCardVerification)
        <div class="modal fade" id="qrAuthModal" tabindex="-1"
            aria-hidden="true"
            data-bs-backdrop="static"
            data-bs-keyboard="false">

            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">

                    <!-- TITLE -->
                    <div class="text-center py-3 border-bottom">
                        <h4 class="fw-bold mb-0">
                            Vérification de la carte d’agent
                        </h4>
                        <small class="text-muted">
                            Authentification par QR code ou code sécurisé
                        </small>
                    </div>

                    <div class="row g-0">

                        <!-- LEFT IMAGE -->
                        <div class="col-md-6 d-none d-md-block">
                            <img src="{{ asset('img/mockups/cardmockup.png') }}"
                                class="img-fluid h-100 w-100"
                                style="object-fit: contain; padding:5px; "
                                alt="Vérification carte agent">
                        </div>

                        <!-- RIGHT CONTENT -->
                        <div class="col-md-6 p-4 d-flex flex-column">

                            <!-- MODE SWITCH -->
                            <div class="d-flex gap-2 mb-3">
                                <button id="scanBtn" class="btn btn-primary me-2 active">
                                    📷 Scanner QR
                                </button>
                                <button id="codeBtn" class="btn btn-outline-primary">
                                    🔢 Entrer un code
                                </button>
                            </div>
                            <div class="alert alert-danger alert-dismissible fade" role="alert" id="QrModalMessage"></div>

                            <!-- QR SCAN -->
                            <div id="scanSection" class="flex-grow-1 text-center">
                                <video id="qrVideo" class="border rounded w-100 mb-3" autoplay></video>
                                <div class="text-muted">
                                    Aligner le QR code devant la caméra
                                </div>
                            </div>

                            <!-- CODE INPUT -->
                            <div id="codeSection" class="flex-grow-1 d-none">
                                <label class="form-label fw-bold">
                                    Code de vérification
                                </label>
                                <input type="text"
                                    id="codeInput"
                                    class="form-control form-control-lg mb-3"
                                    placeholder="Entrer le code">

                                <button id="submitCode"
                                        class="btn btn-primary w-100 btn-lg">
                                    Vérifier
                                </button>
                            </div>

                            <!-- FOOTER MESSAGE -->
                            <div class="mt-4 text-center small text-muted">
                                Veuillez scanner le QR code avec votre caméra ou saisir le code fourni
                                afin de continuer l’accès au système.
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif

    <!-- Verify Authentificated user Password Update -->
    @if(($isNewUser || $hasPasswordExpired))
        <!-- Overlay (extra safety layer) -->
        <div id="hard-lock-overlay"></div>

        <!-- Password Update Modal -->
        <div class="modal fade" id="forcePasswordModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-lg border-0">
                
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">🔒 Mise à jour du mot de passe</h5>
                </div>
                {{-- <div class="modal-header bg-primary text-white d-flex align-items-center gap-2">
                    <img
                        src="{{ asset('img/icons/lock.png') }}"
                        alt="Sécurité"
                        width="32"
                        height="32"
                        class="flex-shrink-0"
                    >

                    <h5 class="modal-title mb-0">
                        Mise à jour du mot de passe
                    </h5>
                </div> --}}

                <div class="modal-body">
                    <p class="text-muted mb-3">
                        Afin de garantir la sécurité et la protection des données de <strong>la Fondation Panzi</strong>, 
                        la création d’un nouveau mot de passe est obligatoire pour tous les nouveaux utilisateurs, 
                        ainsi que tous les trimestres, avant de pouvoir accéder aux services.
                    </p>

                    <div class="alert alert-danger alert-dismissible fade" role="alert" id="ModalMessage"></div>

                    <form id="passwordForm">
                        <div class="mb-3">
                            <label class="form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-control" id="password" required minlength="8" placeholder="Entrez votre nouveau mot de passe">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="password_confirmation" required placeholder="Confirmez votre mot de passe">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Enregistrer et continuer
                            </button>
                        </div>
                    </form>
                </div>

                </div>
            </div>
        </div>
        <!-- /Password Update Modal -->
    @endif
@endif



<div>
    <section id="home_dash-section" class="section js-section u-category-media is-shown p-2">
        {{-- <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ol>
        </nav> 
        <!-- /Breadcrumb -->
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- 
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Encours de </h3>
                  </div>

                  <div class="d-flex">
                  </div>
                </div>
           /Title -->

            <!-- Main Content -->
        
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 pa-0">
                        <div class="auth-form-wrap pt-xl-0 pt-70">
                            <div class="auth-form w-xl-25 w-lg-30 w-sm-50 w-100">
                                
                                <form>
                                    <div class="d-62 bg-white rounded-circle mb-10 d-flex align-items-center justify-content-center mx-auto">
                                        <i class="zmdi zmdi-settings font-28"></i>
                                    </div>
                                    <h1 class="display-4 mb-10 text-center">Désolé, cette page est en maintenance</h1>
                                    <p class="mb-30 text-center">Nous nous excusons pour la gêne occasionnée, nous faisons de notre mieux pour remettre les choses en ordre pour vous. N'hésitez pas à <a href="#"><u>contacter le service IT</u></a> pour toute question.</p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /Main Content --> --}}

            <!-- Main content -->

            
            <div class="row">
                <div class="col-xl-12">
                    <div class="hk-row">
                        <div class="col-lg-7">
                            
                            <div class="hk-row">							
                                <div class="col-sm-6">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                    <span class="d-block font-15 text-dark font-weight-500">Notification</span>
                                                </div>
                                                <div>
                                                    @if(isset($unreadCount) && $unreadCount > 0)
                                                        <span class="badge badge-primary  badge-sm">{{ $unreadCount}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div>
                                                <span class="d-block display-5 text-dark mb-5">Demande d'achat</span>
                                                <small class="d-block">Votre attention est plus requise pour les DA</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                    <span class="d-block font-15 text-dark font-weight-500">Taux de Change</span>
                                                </div>
                                                {{-- <div>
                                                    <span class="badge badge-danger   badge-sm">+10%</span>
                                                </div> --}}
                                            </div>
                                            <div>
                                                <span class="d-block display-5 text-dark mb-5">{{ App\Models\Taux::firstWhere('active', true)->taux}} FC</span>
                                                <small class="d-block">1 USD</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                    <span class="d-block font-15 text-dark font-weight-500">Projets</span>
                                                </div>
                                                <div>
                                                    {{-- <span class="badge badge-primary  badge-sm">-1.5%</span> --}}
                                                </div>
                                            </div>
                                            <div>
                                                <span class="d-block display-5 text-dark mb-5">{{ $myprojetsCount > 0 ? $myprojetsCount : 'Non Affecté' }}</span>
                                                @php
                                                    $projetTeeminated = 0;
                                                    foreach($myprojets as $objet){
                                                        if(!$objet['is_active']){
                                                            $projetTeeminated++;
                                                        }
                                                    }
                                                @endphp
                                                <small class="d-block">{{$projetTeeminated}} Terminé(s)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                    <span class="d-block font-15 text-dark font-weight-500">Travaux Journalier</span>
                                                </div>
                                                <div>
                                                    {{-- <span class="badge badge-warning  badge-sm">+60%</span> --}}
                                                </div>
                                            </div>
                                            <div>
                                                <span class="d-block display-5 text-dark mb-5">--</span>
                                                <small class="d-block">-- Targeted</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>	
                            </div>
                            
                            <div class="card card-refresh">
                                <div class="refresh-container">
                                    <div class="loader-pendulums"></div>
                                </div>
                                <div class="card-header card-header-action">
                                    @if($is_not_adminUser)
                                        <h6>Mes Projets</h6>
                                    @else
                                        <h6>Projets de la Fondation</h6>
                                    @endif
                                </div>
                                <div class="card-body">
                                    {{-- <div class="hk-legend-wrap mb-20">
                                        <div class="hk-legend">
                                            <span class="d-10 bg-purple rounded-circle d-inline-block"></span><span>Desktop</span>
                                        </div>
                                        <div class="hk-legend">
                                            <span class="d-10 bg-grey-light-2 rounded-circle d-inline-block"></span><span>Mobile</span>
                                        </div>
                                    </div> --}}
                                    <div style="max-height:300px; overflow-y:auto;">
                                        @if(!empty($myprojets))
                                            <ul class="list-group">
                                                @foreach($myprojets as $objet)
                                                    <li
                                                        class="list-group-item text-uppercase"
                                                        style="cursor:pointer"
                                                        wire:click="toggleProject('{{ $objet['project'] }}')"
                                                    >
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span  class="{{ $objet['is_active'] ? '' : 'text-decoration-line-through' }}">{{ $objet['project'] }}</span>

                                                            <span class="badge bg-primary rounded-pill text-white">
                                                                {{ count($objet['posts']) }}
                                                            </span>
                                                        </div>

                                                        {{-- COLLAPSIBLE POSTS --}}
                                                        @if($openProject === $objet['project'])
                                                            <div class="mt-2">
                                                                @forelse($objet['posts'] as $post)
                                                                    <div class="border rounded p-2 mb-1 bg-light text-dark text-capitalize">
                                                                        {{ $post['title'] }}
                                                                    </div>
                                                                @empty
                                                                    <div class="text-muted small">
                                                                        Aucun post pour ce projet.
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-center text-muted">Aucun projet affecté.</p>
                                        @endif
                                    </div>



                                </div>
                            </div>
                            {{-- <div class="card">
                                <div class="card-header card-header-action">
                                    <h6>Country Stats</h6>
                                    <div class="d-flex align-items-center card-action-wrap">
                                        <a href="#" class="inline-block refresh mr-15">
                                            <i class="ion ion-md-arrow-down"></i>
                                        </a>
                                        <a href="#" class="inline-block full-screen">
                                            <i class="ion ion-md-expand"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body pa-0">
                                    <div class="pa-20">
                                        <div id="world_map_marker_1" style="height: 360px"></div>
                                    </div>
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="w-25">Country</th>
                                                        <th>Sessions</th>
                                                        <th>Goals</th>
                                                        <th>Goals Rate</th>
                                                        <th>Bounce Rate</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Canada</td>
                                                        <td>55,555</td>
                                                        <td>210</td>
                                                        <td>2.46%</td>
                                                        <td>0.26%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>India</td>
                                                        <td>24,152</td>
                                                        <td>135</td>
                                                        <td>0.58%</td>
                                                        <td>0.43%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>UK</td>
                                                        <td>15,640</td>
                                                        <td>324</td>
                                                        <td>5.15%</td>
                                                        <td>2.47%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Botswana</td>
                                                        <td>12,148</td>
                                                        <td>854</td>
                                                        <td>4.19%</td>
                                                        <td>0.1%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>UAE</td>
                                                        <td>11,258</td>
                                                        <td>453</td>
                                                        <td>8.15%</td>
                                                        <td>0.14%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Australia</td>
                                                        <td>10,786</td>
                                                        <td>376</td>
                                                        <td>5.48%</td>
                                                        <td>0.45%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phillipines</td>
                                                        <td>9,485</td>
                                                        <td>63</td>
                                                        <td>3.51%</td>
                                                        <td>0.9%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Srilanka</td>
                                                        <td>1,485</td>
                                                        <td>63</td>
                                                        <td>3.51%</td>
                                                        <td>0.9%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Calendar</h6>
                                </div>

                                <div class="card-body">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="hk-legend-wrap mb-10">
                                        <div class="hk-legend">
                                            <span class="d-10 bg-purple rounded-circle d-inline-block"></span><span>Today</span>
                                        </div>
                                        <div class="hk-legend">
                                            <span class="d-10 bg-grey-light-1  rounded-circle d-inline-block"></span><span>Yesterday</span>
                                        </div>
                                    </div>
                                    <div id="e_chart_1" class="echart" style="height:200px;"></div>
                                    <div class="row mt-20">
                                        <div class="col-4">
                                            <span class="d-block text-capitalize mb-5">Previous</span>
                                            <span class="d-block font-weight-600 font-13">79.82</span>
                                        </div>
                                        <div class="col-4">
                                            <span class="d-block text-capitalize mb-5">% Change</span>
                                            <span class="d-block font-weight-600 font-13">+14.29</span>
                                        </div>
                                        <div class="col-4">
                                            <span class="d-block text-capitalize mb-5">Trend</span>
                                            <span class="block">
                                                <i class="zmdi zmdi-trending-down text-danger font-20"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="card">
                                <div class="card-header card-header-action">
                                    <h6>Recent Activity</h6>
                                    <div class="d-flex align-items-center card-action-wrap">
                                        <div class="inline-block dropdown">
                                            <a class="dropdown-toggle no-caret" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="ion ion-ios-more"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Separated link</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="card-body">
                                    <div class="user-activity user-activity-sm">
                                        <div class="media">
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-xs">
                                                    <img src="dist/img/avatar2.jpg" alt="user" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <span class="d-block mb-5"><span class="font-weight-500 text-dark text-capitalize">Laura Thompson</span><span class="pl-5">joined josh groben team.</span></span>
                                                    <span class="d-block font-13">3 hours ago</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-xs">
                                                    <img src="dist/img/avatar3.jpg" alt="user" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <span class="d-block mb-5"><span class="font-weight-500 text-dark text-capitalize">Meayme Fletcher</span><span class="pl-5">liked photos</span></span>
                                                    <span class="d-block font-13 mb-10">6 hours ago</span>
                                                </div>
                                                <div class="d-flex">
                                                    <a href="#" class="w-75p mr-10"><img class="card-img-top rounded" src="dist/img/gallery/mock7.jpg" alt="Card image cap"></a>
                                                    <a href="#" class="w-75p mr-10"><img class="card-img-top rounded" src="dist/img/gallery/mock11.jpg" alt="Card image cap"></a>
                                                    <a href="#" class="w-75p mr-10"><img class="card-img-top rounded" src="dist/img/gallery/mock12.jpg" alt="Card image cap"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-xs">
                                                    <span class="avatar-text avatar-text-info rounded-circle">
                                                            <span class="initial-wrap"><span>B</span></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <span class="d-block mb-5"><span class="font-weight-500 text-dark text-capitalize">Billy Flowers</span><span class="pl-5">Until recently, the prevailing view assumed lorem ipsum was born as a nonsense text.</span></span>
                                                    <span class="d-block font-13">3 days ago</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-xs">
                                                    <img src="dist/img/avatar4.jpg" alt="user" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <span class="d-block mb-5"><span class="font-weight-500 text-dark text-capitalize">Morgan Freeman</span><span class="pl-5">joined josh groben team.</span></span>
                                                    <span class="d-block font-13">3 hours ago</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-xs">
                                                    <span class="avatar-text avatar-text-success rounded-circle">
                                                            <span class="initial-wrap"><span>M</span></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <span class="d-block mb-5"><span class="font-weight-500 text-dark text-capitalize">Meayme Fletcher</span><span class="pl-5">liked photos</span></span>
                                                    <span class="d-block font-13 mb-10">6 hours ago</span>
                                                </div>
                                                <div class="d-flex">
                                                    <a href="#" class="w-75p mr-10"><img class="card-img-top rounded" src="dist/img/gallery/mock1.jpg" alt="Card image cap"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-xs">
                                                    <img src="dist/img/avatar6.jpg" alt="user" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <span class="d-block mb-5"><span class="font-weight-500 text-dark text-capitalize">Evie Ono</span><span class="pl-5">joined josh groben team.</span></span>
                                                    <span class="d-block font-13">3 hours ago</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
            

        {{-- </div> --}}
    </section>

</div>
