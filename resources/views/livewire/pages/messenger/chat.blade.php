@assets
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}">
<script src="{{ asset('assets/js/app-chat.js') }}"></script>
@endassets

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-chat card overflow-hidden">
        <div class="row g-0">
            <!-- Sidebar Left -->
            <div class="col app-chat-sidebar-left app-sidebar overflow-hidden" id="app-chat-sidebar-left">
                <div
                    class="chat-sidebar-left-user sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap px-4 pt-5">
                    <div class="avatar avatar-xl avatar-online">
                        <img src="../../assets/img/avatars/1.png" alt="آواتار" class="rounded-circle">
                    </div>
                    <h5 class="mt-2 mb-0">جان اسنو</h5>
                    <small>مدیر</small>
                    <i class="bx bx-x bx-sm cursor-pointer close-sidebar" data-bs-toggle="sidebar" data-overlay=""
                       data-target="#app-chat-sidebar-left"></i>
                </div>
                <div class="sidebar-body px-4 pb-4 ps ps__rtl ps--active-y">
                    <div class="my-4">
                        <p class="text-muted text-uppercase">درباره</p>
                        <textarea id="chat-sidebar-left-user-about"
                                  class="form-control chat-sidebar-left-user-about mt-3" rows="4" maxlength="120">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه</textarea>
                    </div>
                    <div class="my-4">
                        <p class="text-muted text-uppercase">وضعیت</p>
                        <div class="d-grid gap-1">
                            <div class="form-check form-check-success">
                                <input name="chat-user-status" class="form-check-input" type="radio" value="active"
                                       id="user-active" checked="">
                                <label class="form-check-label" for="user-active">فعال</label>
                            </div>
                            <div class="form-check form-check-danger">
                                <input name="chat-user-status" class="form-check-input" type="radio" value="busy"
                                       id="user-busy">
                                <label class="form-check-label" for="user-busy">مشغول</label>
                            </div>
                            <div class="form-check form-check-warning">
                                <input name="chat-user-status" class="form-check-input" type="radio" value="away"
                                       id="user-away">
                                <label class="form-check-label" for="user-away">دور</label>
                            </div>
                            <div class="form-check form-check-secondary">
                                <input name="chat-user-status" class="form-check-input" type="radio" value="offline"
                                       id="user-offline">
                                <label class="form-check-label" for="user-offline">آفلاین</label>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <p class="text-muted text-uppercase">تنظیمات</p>
                        <ul class="list-unstyled d-grid gap-3 me-3">
                            <li class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bx bx-message-square-detail me-1"></i>
                                    <span class="align-middle">اعتبارسنجی دو مرحله‌ای</span>
                                </div>
                                <label class="switch switch-primary me-4">
                                    <input type="checkbox" class="switch-input" checked="">
                                    <span class="switch-toggle-slider">
                                <span class="switch-on"></span>
                                <span class="switch-off"></span>
                              </span>
                                </label>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bx bx-bell me-1"></i>
                                    <span class="align-middle">اعلان</span>
                                </div>
                                <label class="switch switch-primary me-4">
                                    <input type="checkbox" class="switch-input">
                                    <span class="switch-toggle-slider">
                                <span class="switch-on"></span>
                                <span class="switch-off"></span>
                              </span>
                                </label>
                            </li>
                            <li>
                                <i class="bx bx-user me-1"></i>
                                <span class="align-middle">دعوت دوستان</span>
                            </li>
                            <li>
                                <i class="bx bx-trash me-1"></i>
                                <span class="align-middle">حذف حساب</span>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex mt-4">
                        <button class="btn btn-primary" data-bs-toggle="sidebar" data-overlay=""
                                data-target="#app-chat-sidebar-left">
                            خروج
                        </button>
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; height: 558px; right: 323px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 433px;"></div>
                    </div>
                </div>
            </div>
            <!-- /Sidebar Left-->

            <!-- Chat & Contacts -->
            <!-- /Chat contacts -->
            <livewire:messenger.chat-list/>
            <!-- Chat History -->
           @if(isset($chat))
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
                                @foreach($this->getGroupByMessages() as $key => $group)
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
                <!-- /Chat History -->

                <!-- Sidebar Right -->
                <div class="col app-chat-sidebar-right app-sidebar overflow-hidden" id="app-chat-sidebar-right">
                    <div
                        class="sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap px-4 pt-5">
                        <div class="avatar avatar-xl avatar-online">
                            <img src="../../assets/img/avatars/2.png" alt="آواتار" class="rounded-circle">
                        </div>
                        <h6 class="mt-2 mb-0">دیوید بکهام</h6>
                        <span>توسعه دهنده NextJS</span>
                        <i class="bx bx-x bx-sm cursor-pointer close-sidebar d-block" data-bs-toggle="sidebar"
                           data-overlay="" data-target="#app-chat-sidebar-right"></i>
                    </div>
                    <div class="sidebar-body px-4 pb-4 ps ps__rtl ps--active-y">
                        <div class="my-4">
                            <p class="text-muted text-uppercase">درباره</p>
                            <p class="mb-0 mt-3">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                                چاپگرها و متون بلکه روزنامه و
                            </p>
                        </div>
                        <div class="my-4">
                            <p class="text-muted text-uppercase">اطلاعات شخصی</p>
                            <ul class="list-unstyled d-grid gap-2 mt-3">
                                <li class="d-flex align-items-center">
                                    <i class="bx bx-envelope"></i>
                                    <span class="align-middle ms-2">لورم ایپسوم متن ساختگی</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="bx bx-phone-call"></i>
                                    <span class="align-middle ms-2">+1(123) 456 - 7890</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="bx bx-time-five"></i>
                                    <span class="align-middle ms-2">شنبه الی پنجشنبه - 10صبح الی 8 شب</span>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-4">
                            <p class="text-muted text-uppercase">گزینه‌ها</p>
                            <ul class="list-unstyled d-grid gap-2 mt-3">
                                <li class="cursor-pointer d-flex align-items-center">
                                    <i class="bx bx-tag"></i>
                                    <span class="align-middle ms-2">افزودن برچسب</span>
                                </li>
                                <li class="cursor-pointer d-flex align-items-center">
                                    <i class="bx bx-star"></i>
                                    <span class="align-middle ms-2">درون‌ریزی مخاطب</span>
                                </li>
                                <li class="cursor-pointer d-flex align-items-center">
                                    <i class="bx bx-image"></i>
                                    <span class="align-middle ms-2">به اشتراک گذاری رسانه</span>
                                </li>
                                <li class="cursor-pointer d-flex align-items-center">
                                    <i class="bx bx-trash"></i>
                                    <span class="align-middle ms-2">حذف مخاطب</span>
                                </li>
                                <li class="cursor-pointer d-flex align-items-center">
                                    <i class="bx bx-block"></i>
                                    <span class="align-middle ms-2">مسدود کردن مخاطب</span>
                                </li>
                            </ul>
                        </div>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; height: 562px; right: 323px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 560px;"></div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col app-chat-history bg-body d-flex align-items-center justify-content-center">
                    <p>گفتگویی انتخاب کنید</p>
                </div>
           @endif
            <!-- /Sidebar Right -->

            <div class="app-overlay"></div>
        </div>
    </div>
</div>
@script
    <script>
        $wire.on('NewMessageSent', ($event) => {
            let lastMessage = document.querySelector('.chat-message:last-child')

            let chatHistoryBody = document.querySelector('.chat-history-body')

            chatHistoryBody.scrollTo(0, chatHistoryBody.scrollHeight + lastMessage.scrollHeight);
        })
    </script>
@endscript
