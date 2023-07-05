<div class="chatapp-right" style="height:100%" wire:ignore.self>

    @php
    \Carbon\Carbon::setLocale('fr');
    use Carbon\Carbon;
    use Carbon\CarbonInterface;
    @endphp
    <header>
        <a id="back_user_list" href="javascript:void(0)" class="back-user-list">
            <span class="feather-icon"><i data-feather="chevron-left"></i></span>
        </a>
        <div class="media">
            @if ($user)
            <div class="media-img-wrap">
                <div class="avatar">
                    <img src="dist/img/avatar2.jpg" alt="user" class="avatar-img rounded-circle">
                </div>
                <span class="badge badge-success badge-indicator"></span>
            </div>
            <div class="media-body">
                
                    <div class="user-name">{{$user[0]->name}}</div>
                    <div class="user-status">online</div>
            </div>
            @endif
        </div>
        <div class="chat-options-wrap">
            <a href="javascript:void(0)" class=""><span class="feather-icon"><i data-feather="video"></i></span></a>
            <a href="javascript:void(0)" class=""><span class="feather-icon"><i data-feather="phone"></i></span></a>
        </div>
    </header>

    
    <div class="chat-body" id="chat-body" style="overflow:auto" wire:ignore.self>
        <div class="nicescroll-bar" >
            
            <ul class="list-unstyled" wire:poll.1s>


                @if($content && !empty($content))
                    @foreach ($content as $content)

                        @if ($content->user_id == Auth::user()->id)

                            <li class="media sent">
                                <div class="media-body">
                                    <div class="msg-box">
                                        <div>
                                            <p>{{$content->content}}</p>
                                            <span class="chat-time">{{$content->created_at->diffForHumans([
                                                
                                                'options' => Carbon::JUST_NOW | Carbon::ONE_DAY_WORDS | Carbon::TWO_DAY_WORDS,])}}</span>
                                            <div class="arrow-triangle-wrap">
                                                <div class="arrow-triangle left"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            
                        @else

                            <li class="media received">
                                <div class="avatar">
                                    <img src="dist/img/avatar2.jpg" alt="user" class="avatar-img rounded-circle">
                                </div>
                                <div class="media-body">
                                    <div class="msg-box">
                                        <div>
                                            <p>{{$content->content}}</p>
                                           
                                            <span class="chat-time">{{$content->created_at->diffForHumans([
                                                
                                                'options' => Carbon::JUST_NOW | Carbon::ONE_DAY_WORDS | Carbon::TWO_DAY_WORDS,])}}</span>
                                            <div class="arrow-triangle-wrap">
                                                <div class="arrow-triangle left"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            
                        @endif

                    @endforeach 
                @endif


                
            </ul>
        </div>
    </div>

    
    
    <footer style="position:relative;margin-bottom:0%" wire:ignore>
        <div class="input-group">
            
            <input type="text" id="input_msg_send_chatapp" wire:keydown.enter.prevent="sendMessage" wire:model.defer="message" name="send-msg" class="input-msg-send form-control" placeholder="Type something">
            
        </div>
    </footer>

    
</div>


