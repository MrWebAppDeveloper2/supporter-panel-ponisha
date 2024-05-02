<div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end"
     id="app-chat-contacts">
    <div class="sidebar-header px-4 border-bottom" style="padding: 17px 10px;">
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                            <span class="input-group-text" id="basic-addon-search31"><i
                                    class="bx bx-search fs-4"></i></span>
                <input wire:model.live="search" type="text" class="form-control chat-search-input" placeholder="جستجو ..."
                       aria-label="Search..." aria-describedby="basic-addon-search31">
            </div>
        </div>
        <i class="bx bx-x cursor-pointer position-absolute top-0 end-0 mt-2 me-1 fs-4 d-lg-none d-block"
           data-overlay="" data-bs-toggle="sidebar" data-target="#app-chat-contacts"></i>
    </div>
    <div class="sidebar-body ps ps__rtl ps--active-y">
        <!-- Chats -->
        <ul class="list-unstyled chat-contact-list" id="chat-list">
            <li @class(['chat-contact-list-item', 'chat-list-item-0', 'd-none' => $chats->isNotEmpty()])>
                <h6 class="text-muted mb-0">گفتگویی پیدا نشد</h6>
            </li>
            @foreach($chats as $item)
                <li class="chat-contact-list-item">
                    <a class="d-flex align-items-center" wire:click="$parent.open({{ $item }})">
                        <div @class(["flex-shrink-0", "avatar", "avatar-busy" => $item->isAnyoneOnline])>
                            <span class="avatar-initial rounded-circle bg-label-success">{{ \Illuminate\Support\Str::take(\Illuminate\Support\Str::reverse($item->name), 2) }}</span>
                        </div>
                        <div class="chat-contact-info flex-grow-1 ms-3">
                            <h6 class="chat-contact-name text-truncate m-0">{{ \Illuminate\Support\Str::words($item->name, 4) }}</h6>
                            <p class="chat-contact-status text-truncate mb-0 text-muted">
                                {{ $item->messages()->latest()->first()->body }}
                            </p>
                        </div>
                        <small class="text-muted mb-auto">
                            {{
                                ($agoDay = \Illuminate\Support\Carbon::parse($item->created_at)->diffInDays()) < 1 ?
                                'امروز' :
                                "{$agoDay} روز پیش"
                            }}
                        </small>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="ps__rail-x" style="left: 0px; bottom: -518px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 518px; height: 651px; right: 322px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 289px; height: 362px;"></div>
        </div>
    </div>
</div>
