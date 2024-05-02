<div class="col app-chat-history bg-body">
    <div class="chat-history-wrapper">
        <div class="chat-history-header border-bottom px-1 py-2">
            <div class="d-flex justify-content-between align-items-center py-1">
                <div class="d-flex overflow-hidden align-items-center">
                    <i class="bx bx-menu bx-sm cursor-pointer d-lg-none d-block me-2"
                       data-bs-toggle="sidebar" data-overlay="" data-target="#app-chat-contacts"></i>
                    <div class="chat-contact-info flex-grow-1 ms-3">
                        <h6 class="m-0">{{ $chat->name }}</h6>
                        <small @class(["user-status", "text-muted" => !$chat->isAnyoneOnline, "text-primary" => $chat->isAnyoneOnline])>
                            @if($chat->isAnyoneOnline)
                                مخاطب آنلاین است
                            @else
                                مخاطب آفلاین است
                            @endif
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-history-body bg-body" style="overflow: auto">
            <ul class="list-unstyled chat-history mb-0">
                @foreach($this->groupByMessages($this->getChatMessages($chat)) as $key => $group)
                    <li @class(["chat-message", "chat-message-right" => ($group[0]->user_id == auth()->id())])>
                        <div class="d-flex overflow-hidden">
                            <div class="chat-message-wrapper flex-grow-1">
                                @foreach($group as $message)
                                    <div class="chat-message-text my-2">
                                        <p class="mb-0">{!! $message->body !!}</p>
                                    </div>
                                @endforeach
                                <div @class(["text-end" => ($group[0]->user_id == auth()->id()), "text-muted", "mt-1"])>
                                    <i @class(["bx", "bx-check-double" => ($group[0]->user_id == auth()->id()), "text-success" => ($group[0]->status == \App\Enums\Message\MessageStatus::SEEN->value)])></i>
                                    <small>{{ \Illuminate\Support\Str::of($key)->match('(\d{2}:\d{2})') }}</small>
                                </div>
                            </div>
                            <div class="user-avatar flex-shrink-0 ms-3">

                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="ps__rail-x" style="left: 0px; bottom: -787px;">
                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 787px; height: 567px; right: 1031px;">
                <div class="ps__thumb-y" tabindex="0" style="top: 330px; height: 237px;"></div>
            </div>
        </div>
        <!-- Chat message form -->
        <livewire:messenger.sender :$chat/>
    </div>
</div>
