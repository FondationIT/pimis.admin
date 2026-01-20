<li class="nav-item dropdown dropdown-notifications" wire:ignore.self>
    <a class="nav-link nav-link-hover dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <span class="feather-icon"><i data-feather="bell"></i></span>
        @if($unread && count($unread) > 0)
            <span class="badge badge-wrap badge-danger">
                {{ count($unread) }}
            </span>
        @endif
    </a>

    <div class="dropdown-menu dropdown-menu-right p-0 shadow-lg"
         data-dropdown-in="fadeIn" data-dropdown-out="fadeOut"
         style="width: 360px; border-radius: 10px; overflow: hidden;">

        <!-- Header with Tabs -->
        <div class="px-3 py-2 border-bottom bg-light">
            <ul class="nav nav-tabs notifTab-holder" id="notifTabs" role="tablist">
                @if ($tabs)
                    @foreach($tabs as $prefix => $list)
                        <li class="nav-tab-item">
                            
                            <a class="nav-tab-link {{ $loop->first ? 'active' : '' }}"
                               id="tab-{{ $prefix }}-tab"
                               data-bs-toggle="tab"
                               href="#tab_{{ $prefix }}"
                               role="tab"
                               aria-controls="tab_{{ $prefix }}"
                               aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                @if(count($list) > 0)
                                    <span class="badge badge-primary mr-2">{{ count($list) }}</span>
                                @endif
                                {{ $tabsFullTitle[$prefix] }}
                            </a>
                        </li>
                    @endforeach
                @else
                    <li class="nav-tab-item">

                            <a class="nav-tab-link active"
                               id="tab-GENERAL-tab"
                               data-bs-toggle="tab"
                               href="#tab_general">General
                            </a>
                        </li>
                @endif
            </ul>
            <div class="py-2 border-top bg-light d-flex justify-content-between align-items-center">
                <a href="#" class="small text-primary">Voir tout</a>
            </div>
        </div>


        <!-- Tab Content -->
        <div class="tab-content notiftab-content mh-70dvh overflow-auto">
            
            @if ($tabs)
                @foreach($tabs as $prefix => $list)
                    <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}"
                         id="tab_{{ $prefix }}"
                         role="tabpanel"
                         aria-labelledby="tab-{{ $prefix }}-tab">

                        @forelse($list as $k => $notif)
                            @php
                                $dOpen = 'bFile';
                                $OpenSection = $sectionToOpen[$prefix];
                                if(trim($u_role) == 'COMPTABILITE'){
                                    if($prefix == 'EB'){
                                        $OpenSection = 'bonReqF';
                                        $dOpen = 'bFinance';
                                    }
                                }
                                $task = is_array($notif) ? $notif['task'] : $notif->task;
                                $message = is_array($notif) ? $notif['message'] : $notif->message;
                                $created_at = is_array($notif) ? $notif['created_at'] : $notif->created_at;
                            @endphp

                            <div class="notif-item p-2 mb-1 rounded hover-bg" data-open="{{ $dOpen }}" data-active="{{ $OpenSection }}"
                                data-section="{{ $OpenSection }}"
                                wire:click="$emit('search{{ str_replace('-', '', $prefix) }}', '{{ $task }}')">
                                <div class="notif-main-msg">
                                    <div class="notif-initial-cont bg-primary"><span>{{ $prefix }}</span></div>
                                    <div class="small text-muted">
                                        {!! str_replace('-', "<b class='fw-bold text-primary' id='ref_num{$k}'>{$task}</b>", $message) !!}
                                    </div>
                                </div>

                                <div class="small text-right text-secondary mt-1">
                                    {{ $this->timeAgo($created_at) }}
                                </div>

                            </div>
                        @empty
                            <p class="text-center small text-muted" style="padding: 10px;">No notification found</p>
                        @endforelse

                    </div>
                @endforeach
            @endif
        </div>
    </div>
</li>
