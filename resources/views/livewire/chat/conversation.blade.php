
    <div class="chatapp-left">
    @php
    \Carbon\Carbon::setLocale('fr');
    use Carbon\Carbon;
    use Carbon\CarbonInterface;
    @endphp
        <header>
            <span class="">Conversations</span>
        </header>
        <div role="search" class="chat-search">
            <div class="flex rounded w-100 " x-on:click.away="open = false; @this.resetIndex();" x-on:keydown.escape="open = false; @this.resetIndex();">
                <div class="relative flex-grow focus-within:z-20">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" viewBox="0 0 20 20" stroke="currentColor" fill="none">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input wire:model="query" class="block w-full py-2 pl-10 text-sm border border-green-400 leading-1 rounded focus:ring focus:ring-blue-200 focus:ring-opacity-50 focus:outline-none" placeholder="{{__('Cherchez avec')}}" type="text" />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2" @click.prevent="open = true" wire:model="query"
                    wire:keydown.prevent.arrow-down="incrementIndex()"
                    wire:keydown.prevent.arrow-up="decrementIndex()"
                    wire:keydown.prevent.enter="selectIndex()"
                    wire:keydown.backspace="resetIndex()">
                        <button wire:click="nullSearch()" class="text-gray-300 hover:text-red-600 focus:outline-none">
                            <x-icons.x-circle  class="w-4 h-4 stroke-current" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        

        <div class="chatapp-users-list" wire:poll.1s>
            @if (strlen($query) >= 1)
            <div class="nicescroll-bar">
                @if (count($jobs) > 0)
                @foreach ($jobs as $index => $job)

                    @if($job['id'] == Auth::user()->id)

                    @else

                    <a href="#" wire:click="userConv({{$job['id']}})" class="media {{ ($index === $selectedIndex) ? 'text-green-400' : '' }}">
                        <div class="media-img-wrap">
                            <div class="avatar">
                                <img src="dist/img/avatar1.jpg" alt="user" class="avatar-img rounded-circle">
                            </div>
                            <span class="badge badge-warning badge-indicator"></span>
                        </div>
                        <div class="media-body">
                            @if(App\Models\Conversation::where('from', Auth::user()->id)->where('to', $job['id'])->exists() || App\Models\Conversation::where('from', $job['id'])->where('to', Auth::user()->id)->exists())
                                <div>
                                    <div class="user-name">{{ $job['name'] }}</div>
                                
                                    <div class="user-last-chat">{{ 
                                    App\Models\Message::where('conversation_id', App\Models\Conversation::where(function ($query) use ($job) {
                                        $query->where('from', Auth::user()->id)
                                            ->where('to', $job['id']);
                                    })->orWhere(function ($query) use ($job) {
                                        $query->where('from', $job['id'])
                                            ->where('to', Auth::user()->id);
                                    })->get()[0]->id)->orderBy('created_at','desc')->first()->content
                                                                
                                    }}</div>
                                    
                                </div>
                                <div>
                                    <div class="last-chat-time block">{{App\Models\Message::where('conversation_id', App\Models\Conversation::where(function ($query) use ($job) {
                                        $query->where('from', Auth::user()->id)
                                            ->where('to', $job['id']);
                                    })->orWhere(function ($query) use ($job) {
                                        $query->where('from', $job['id'])
                                            ->where('to', Auth::user()->id);
                                    })->get()[0]->id)->orderBy('created_at','desc')->first()->created_at->diffForHumans([
                                                
                                        'options' => Carbon::JUST_NOW | Carbon::ONE_DAY_WORDS | Carbon::TWO_DAY_WORDS,])}}</div>
                                    <div class="badge badge-success badge-pill">15</div>
                                </div>
                            @else
                                <div>
                                    <div class="user-name">{{ $job['name'] }}</div>
                                
                                    <div class="user-last-chat"></div>
                                </div>
                                <div>
                                    <div class="last-chat-time block"></div>
                                    <div class="badge badge-success badge-pill"></div>
                                </div>
                            @endif
                        </div>
                    </a>
                    <div class="chat-hr-wrap">
                        <hr>
                    </div>
                    @endif
                @endforeach 

                @else
                <span>0 résultat pour "{{ $query }}"</span>
                @endif
                
               
            </div>
            @endif

            
            @if (strlen($query) == 0)
           <div class="nicescroll-bar">
                
                @foreach ($conversation as $index => $job)

                @if (Auth::user()->id == $job['from'])
                    <a href="#" wire:click="userConv({{$job['to']}})" class="media {{ ($index === $selectedIndex) ? 'text-green-400' : '' }}">
                @else
                    <a href="#" wire:click="userConv({{$job['from']}})" class="media {{ ($index === $selectedIndex) ? 'text-green-400' : '' }}">
                @endif
                
                    <div class="media-img-wrap">
                        <div class="avatar">
                            <img src="dist/img/avatar1.jpg" alt="user" class="avatar-img rounded-circle">
                        </div>
                        <span class="badge badge-warning badge-indicator"></span>
                    </div>
                    <div class="media-body">
                        <div>
                            <div class="user-name">
                                @if (Auth::user()->id == $job['from'])
                                    {{App\Models\User::where('id', $job['to'])->get()[0]->name}}
                                @else
                                    {{App\Models\User::where('id', $job['from'])->get()[0]->name}}
                                @endif
                            </div>
                            <div class="user-last-chat">{{ App\Models\Message::where('conversation_id', $job['id'])->orderBy('created_at','desc')->first()->content}}</div>
                        </div>
                        <div>
                            <div class="last-chat-time block">{{ App\Models\Message::where('conversation_id', $job['id'])->orderBy('created_at','desc')->first()->created_at->diffForHumans([
                                                
                                'options' => Carbon::JUST_NOW | Carbon::ONE_DAY_WORDS | Carbon::TWO_DAY_WORDS,])}}</div>
                            <div class="badge badge-success badge-pill">15</div>
                        </div>
                    </div>
                </a>
                <div class="chat-hr-wrap">
                    <hr>
                </div>
                @endforeach
                
               
            </div>
            @endif 



            
        </div>



    </div>

