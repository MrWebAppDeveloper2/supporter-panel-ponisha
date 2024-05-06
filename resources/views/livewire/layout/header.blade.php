<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner">
            <!-- Dashboard -->
            <li @class(['menu-item', 'active' => (request()->routeIs('dashboard'))])>
                <a wire:navigate href="{{ route('dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div>داشبورد</div>
                </a>
            </li>
            <!-- Role -->
            @can('viewAny', \App\Models\Role::class)
                <li @class(['menu-item', 'active' => (\Illuminate\Support\Str::startsWith(request()->getRequestUri(), '/role'))])>
                    <a wire:navigate href="{{ route('role.index') }}" class="menu-link">
                        <i class='menu-icon bx bx-universal-access'></i>
                        <div>نقش ها</div>
                    </a>
                </li>
            @endcan

        <!-- Workgroup -->
            @can('viewAny', \App\Models\Workgroup::class)
                <li @class(['menu-item', 'active' => (\Illuminate\Support\Str::startsWith(request()->getRequestUri(), '/workgroup'))])>
                    <a wire:navigate href="{{ route('workgroup.index') }}" class="menu-link">
                        <i class='menu-icon bx bx-group'></i>
                        <div>گروه کاری ها</div>
                    </a>
                </li>
            @endcan

        <!-- User -->
            @can('viewAny', \App\Models\User::class)
                <li @class(['menu-item', 'active' => (\Illuminate\Support\Str::startsWith(request()->getRequestUri(), '/user'))])>
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div>کاربران</div>
                    </a>
                    <ul class="menu-sub">
                        <li @class(['menu-item', 'active' => (\Illuminate\Support\Str::startsWith(request()->getRequestUri(), '/user/operator'))])>
                            <a wire:navigate href="{{ route('operator.index') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-headphone"></i>
                                <div>اوپراتورها</div>
                            </a>
                        </li>
                        <li @class(['menu-item', 'active' => (\Illuminate\Support\Str::startsWith(request()->getRequestUri(), '/user/customer'))])>
                            <a wire:navigate href="{{ route('customer.index') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bxs-user-account"></i>
                                <div>مشتری ها</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

        <!-- Purchase -->
            @can('viewAny', \App\Models\Purchase::class)
                <li @class(['menu-item', 'active' => (\Illuminate\Support\Str::startsWith(request()->getRequestUri(), '/purchase'))])>
                    <a wire:navigate
                       href="{{ route('purchase.index') }}"
                       class="menu-link">
                        <i class='menu-icon bx bx-money'></i>
                        <div>فروش</div>
                    </a>
                </li>
            @endcan

        <!-- Meeting -->
            @can('viewAny', \App\Models\Meeting::class)
                <li @class(['menu-item', 'active' => (\Illuminate\Support\Str::startsWith(request()->getRequestUri(), '/meeting'))])>
                    <a wire:navigate
                       href="{{ route('meeting.index') }}"
                       class="menu-link">
                        <i class='menu-icon bx bxs-user-voice'></i>
                        <div>صورت جلسات</div>
                    </a>
                </li>
            @endcan

        <!-- Bug -->
            @can('viewAny', \App\Models\Bug::class)
                <li @class(['menu-item', 'active' => (\Illuminate\Support\Str::startsWith(request()->getRequestUri(), '/bug'))])>
                    <a wire:navigate
                       href="{{ route('bug.index') }}"
                       class="menu-link">
                        <i class='menu-icon bx bxs-bug'></i>
                        <div>باگ ها</div>
                    </a>
                </li>
            @endcan

        <!-- Ticket -->
            @can('viewAny', \App\Models\Ticket::class)
                <li @class(['menu-item', 'active' => (\Illuminate\Support\Str::startsWith(request()->getRequestUri(), '/ticket'))])>
                    @if(auth()->user()->type == \App\Enums\User\UserType::CUSTOMER)
                        <a wire:navigate
                           href="{{ route('ticket.index', ['status' => (\App\Enums\Ticket\TicketStatus::PENDING->value)]) }}"
                           class="menu-link">
                            <i class='menu-icon bx bx-support'></i>
                            <div>تیکت ها</div>
                        </a>
                    @else
                        <a wire:navigate
                           href="{{ route('ticket.index', ['status' => (\App\Enums\Ticket\TicketStatus::WAITING->value)]) }}"
                           class="menu-link">
                            <i class='menu-icon bx bx-support'></i>
                            <div>تیکت ها</div>
                        </a>
                    @endif
                </li>
            @endcan

        <!-- Task -->
            @can('viewAny', \App\Models\Task::class)
                <li @class(['menu-item', 'active' => (\Illuminate\Support\Str::startsWith(request()->getRequestUri(), '/task'))])>
                    <a wire:navigate
                       href="{{ route('task.index', ['type' => \App\Enums\Task\TaskType::SUBMIT->value]) }}"
                       class="menu-link">
                        <i class='menu-icon bx bx-task'></i>
                        <div>وظایف</div>
                    </a>
                </li>
            @endcan

        <!-- Cartable -->
            @if(\Illuminate\Support\Facades\Gate::allows('cartable'))
                <li @class(['menu-item', 'active' => (\Illuminate\Support\Str::startsWith(request()->getRequestUri(), '/cartable'))])>
                    <a wire:navigate
                       href="{{ route('cartable.index') }}"
                       class="menu-link">
                        <i class='menu-icon bx bx-briefcase'></i>
                        <div>کارتابل</div>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</aside>
