

<div>
   <!-- Top Navbar -->
    <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar">

        <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>

        <a class="navbar-brand font-weight-700" href="{{url('/')}}">

            <img src="img/logo/logoP.png" style="height: 40px;position: relative;" />
               
        </a>
        <ul class="navbar-nav hk-navbar-content">

            {{-- <li class="nav-item dropdown dropdown-notifications">
                <h4><span class="badge badge-danger">1 USD | {{ App\Models\Taux::firstWhere('active', true)->taux}} CDF</span></h4>
            </li>    --}}

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

            {{-- <li class="nav-item dropdown dropdown-notifications">
                <a class="nav-link nav-link-hover dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><span class="feather-icon"><i
                            data-feather="bell"></i></span><span class="badge-wrap" id="countnot"></span></a>
                <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                    <h6 class="dropdown-header">Notifications <a href="javascript:void(0);" class="">Voir tout</a></h6>
                    <div class="notifications-nicescroll-bar" id="outputnot">

                    </div>
                </div>
            </li> --}}

            {{-- <a class="nav-link" href="#" id="button-etBes" data-active="etBes" wire:click="$emit('ebUpdated')" data-open="bFile" data-section="etBes">Etat de besoin</a> --}}

            <livewire:notification-center />

            {{-- @livewire('notification-center') --}}
            {{-- <li class="nav-item dropdown dropdown-notifications">
                <a class="nav-link nav-link-hover dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="feather-icon"><i data-feather="bell"></i></span>
                    <span class="badge-wrap" id="countnot"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right p-0 shadow-lg" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" data-bs-auto-close="outside" style="width: 360px; border-radius: 10px; overflow: hidden;">

                    <!-- Header -->
                    <div class="px-3 py-2 border-bottom bg-light d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 font-weight-bold">Notifications</h6>
                        <a href="#" class="small text-primary">Voir tout</a>
                    </div>

                    <!-- Tabs -->
                    <ul class="nav nav-tabs notifTab-holder" id="notifTabs" role="tablist">
                        <li class="nav-item">
                            
                            <a class="nav-link tab_nav_active" data-target="tab_eb" role="tab">Etat de Besoin
                                <span class="badge badge-primary badge-circle p-sm ml-2"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            
                            <a class="nav-link" data-target="tab_da" role="tab">Demande d'Achat
                                <span class="badge badge-primary badge-circle badge-sm p-sm ml-2"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            
                            <a class="nav-link" data-target="tab_pv" role="tab">PV
                                <span class="badge badge-primary badge-circle badge-sm p-sm ml-2"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            
                            <a class="nav-link" data-target="tab_pv_attr" role="tab">PV Attribution
                                <span class="badge badge-primary badge-circle badge-sm p-sm ml-2"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            
                            <a class="nav-link" data-target="tab_bc" role="tab">Bon de Commande
                                <span class="badge badge-primary badge-circle badge-sm p-sm ml-2"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            
                            <a class="nav-link" data-target="tab_brec" role="tab">Bon de Reception
                                <span class="badge badge-primary badge-circle badge-sm p-sm ml-2"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            
                            <a class="nav-link" data-target="tab_di" role="tab">Demande Interne
                                <span class="badge badge-primary badge-circle badge-sm p-sm ml-2"></span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content notiftab-content">
                        <div class="tab-pane p-2 tab_active" id="tab_eb"><p class='notfound'>No notification found</p></div>
                        <div class="tab-pane p-2" id="tab_da"><p class='notfound'>No notification found</p></div>
                        <div class="tab-pane p-2" id="tab_pv"><p class='notfound'>No notification found</p></div>
                        <div class="tab-pane p-2" id="tab_pv_attr"><p class='notfound'>No notification found</p></div>
                        <div class="tab-pane p-2" id="tab_bc"><p class='notfound'>No notification found</p></div>
                        <div class="tab-pane p-2" id="tab_brec"><p class='notfound'>No notification found</p></div>
                        <div class="tab-pane p-2" id="tab_di"><p class='notfound'>No notification found</p></div>
                    </div>

                </div>

            </li> --}}



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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.dropdown-notifications .dropdown-menu')
            .forEach(function(menu){
                menu.addEventListener('click', function(event){
                    event.stopImmediatePropagation();
                });
            });
    });
</script>

{{-- <script>
    function timeAgo(timestamp) {
        const date = new Date(timestamp);
        const now = new Date(Date.now());

        const seconds = Math.floor((now.getTime() - date.getTime()) / 1000);
        const days = Math.round(seconds / 86400);

        const intervals = [
            { key: "an", seconds: 365 * 24 * 60 * 60 },
            { key: "mois", seconds: 30 * 24 * 60 * 60 },
            { key: "semaine", seconds: 7 * 24 * 60 * 60 },
            { key: "jour", seconds: 24 * 60 * 60 },
            { key: "heure", seconds: 60 * 60 },
            { key: "minute", seconds: 60 },
            { key: "seconde", seconds: 1 },
        ];

        for (let obj of intervals) {
            let value = Math.floor(seconds / obj.seconds);
            if (obj.key === "jour") {
                value = Math.round(seconds / 86400);
            }
            if (value >= 1) {
                return "il y a " + value + " " + obj.key + (value > 1 && obj.key !== "mois" ? "s" : "");
            }
        }

        return "À l'instant";
    }


    // wire:click="$emit('ebUpdated')"


    function buildNotificationItem(notification_data) {
        let contents = ''

        if (!notification_data || notification_data.length === 0) {
            return `<li class="notif-item p-2 mb-1 "> <p class="text-center small text-muted mt-2">No notifications available.</p> </li>`;
        }

        for (let notif of notification_data) {
            if (!notif.is_read) {

                // <a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa(1191)" data-toggle="modal" data-target="#pDaModalForms">DA-2025-11-24-FP31524181449</a>

                const link = `<b>${notif.task}</b>`
                const msg = notif.message.split('-').join(link);
                contents += `<li class="notif-item p-2 mb-1 rounded hover-bg notif-" data-active="etBes" wire:click="$emit('ebUpdated')" data-open="bFile" data-section="etBes">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <div class="small text-muted">${msg}</div>
                            <div class="small text-right text-secondary mt-1">${timeAgo((notif.created_at).replace("Z", ""))}</div>
                        </div>
                    </div>
                </li>
                `;
                // contents += `<li class="notif-item p-2 mb-1 rounded hover-bg" >
                //     <div class="d-flex">
                //         <div class="mr-3">
                //             <span class="badge badge-primary rounded-circle p-2"><i data-feather="bell" class="text-white"></i></span>
                //         </div>

                //         <div class="flex-grow-1" data-active="etBes" wire:click="$emit('ebUpdated')">
                //             <div class="font-weight-bold">General Notification</div>
                //             <div class="small text-muted">${msg}</div>
                //             <div class="small text-right text-secondary mt-1">${timeAgo(notif.created_at)}</div>
                //         </div>
                //     </div>
                // </li>
                // `;
            }
        }
        return contents;
    }

    function getTabBadge(tabs, target) {
        return tabs.querySelector(`a[data-target="${target}"] span.badge`);
    }

    function updateTab(tabs, tabId, items) {
        const pane = document.getElementById(tabId);
        if (!pane) {
            console.warn(`Pane with ID "${tabId}" not found.`);
            return;
        }

        pane.innerHTML = buildNotificationItem(items);

        const badge = getTabBadge(tabs, tabId);
        if (badge) {
            badge.textContent = items.length > 0 ? items.length : '';
        } else {
            console.warn(`Badge not found for tab "${tabId}"`);
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        const container = document.querySelector(".notiftab-content");

        container.addEventListener("click", function (e) {
            const notif = e.target.closest(".notif-item");
            if (!notif) return;

            console.log("Notif clicked", notif);
            if (window.Livewire) {
                Livewire.emit('ebUpdated');
                console.log('emiting...');
                
            }

            // Trigger the link inside
            const link = notif.querySelector("a");
        });
    });



    document.addEventListener('DOMContentLoaded', function () {

        const tabsUl = document.querySelector(".notifTab-holder"); 
        const tabs = tabsUl ? tabsUl.querySelectorAll(".nav-link") : [];
        const panes = document.querySelector('.notiftab-content').querySelectorAll(".tab-pane");

        // Stop inner clicks from closing the dropdown
        document.querySelectorAll('.dropdown-notifications .dropdown-menu')
        .forEach(function(menu){
            menu.addEventListener('click', function(event){
                event.stopImmediatePropagation();
            });
        });

        fetch("{{ route('notification.fetch') }}")
            .then(response => response.json())
            .then(data => {
                
                const unread_notif = data.unread, all_notif = data.all, system_notif = data.system;
                const tab_eb=[],tab_da=[],tab_pv=[],tab_pv_attr=[],tab_bc=[],tab_brec=[],tab_di=[]
                
                console.log(unread_notif);
                for (let notif of unread_notif) {
                    if (notif.task.startsWith('EB-')) {
                        tab_eb.push(notif);
                    } else if (notif.task.startsWith('DA-')) {
                        tab_da.push(notif);
                    } else if (notif.task.startsWith('PV-')) {
                        tab_pv.push(notif);
                    } else if (notif.task.startsWith('PV-ATTR-')) {
                        tab_pv_attr.push(notif);
                    } else if (notif.task.startsWith('BC-')) {
                        tab_bc.push(notif);
                    } else if (notif.task.startsWith('BR-')) {
                        tab_brec.push(notif);
                    } else if (notif.task.startsWith('DI-')) {
                        tab_di.push(notif);
                    }
                }

                if (unread_notif.length > 0) {
                    document.getElementById('countnot').innerText = unread_notif.length;
                    document.getElementById('countnot').classList.add('badge', 'badge-danger');
                }
                if (tab_eb.length > 0) {updateTab(tabsUl,"tab_eb", tab_eb)};
                if (tab_da.length > 0) {updateTab(tabsUl,"tab_da", tab_da)};
                if (tab_pv.length > 0) {updateTab(tabsUl,"tab_pv", tab_pv)};
                if (tab_pv_attr.length > 0) {updateTab(tabsUl,"tab_pv_attr", tab_pv_attr)};
                if (tab_bc.length > 0) {updateTab(tabsUl,"tab_bc", tab_bc)};
                if (tab_brec.length > 0) {updateTab(tabsUl,"tab_brec", tab_brec)};
                if (tab_di.length > 0) {updateTab(tabsUl,"tab_di", tab_di)};
            })
            .catch(error => console.error(error));

        

    tabs.forEach(tab => {
        tab.addEventListener("click", function (e) {
            e.preventDefault();

            const targetId = this.getAttribute("data-target");

            // Remove active class from all tabs and panes
            tabs.forEach(t => t.classList.remove("tab_nav_active"));
            panes.forEach(p => p.classList.remove("tab_active"));

            // Activate clicked tab and corresponding pane
            this.classList.add("tab_nav_active");
            
            const targetPane = document.getElementById(targetId);
            if (targetPane) targetPane.classList.add("tab_active");
        });
    });


        

    });

     $(document).ready(function () {

        let notifMenu = $('.dropdown-notifications .dropdown-menu');
        let notifToggle = $('.dropdown-notifications .nav-link');

        // Prevent Bootstrap from closing dropdown when clicking inside
        notifMenu.on('click', function (e) {
            e.stopPropagation();
        });

        // Custom "click outside" close behavior
        $(document).on('click', function (e) {
            // If menu is open AND click is outside toggle + menu → close it
            if (
                notifMenu.is(':visible') &&
                !notifMenu.is(e.target) &&
                notifMenu.has(e.target).length === 0 &&
                !notifToggle.is(e.target) &&
                notifToggle.has(e.target).length === 0
            ) {
                notifToggle.dropdown('hide');
            }
        });

    });

    

//     {
//     "all": [
        // {
        //     "id": 13,
        //     "agent": 3679,
        //     "msg_id": 1,
        //     "is_read": 1,
        //     "is_delegated": 0,
        //     "delegated_by": null,
        //     "created_at": "2025-11-26T23:06:01.000000Z",
        //     "updated_at": "2025-11-26T23:06:01.000000Z",
        //     "type": "system",
        //     "title": "bonde commande",
        //     "message": "le bon de commande numero - a besoin de votre attention"
        // },
</script> --}}