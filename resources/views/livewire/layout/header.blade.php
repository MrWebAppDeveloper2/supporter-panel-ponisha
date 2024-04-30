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

            <!-- Ticket -->
            <li @class(['menu-item', 'active' => (\Illuminate\Support\Str::startsWith(request()->getRequestUri(), '/ticket'))])>
                <a wire:navigate href="{{ route('ticket.index') }}" class="menu-link">
                    <i class='menu-icon bx bx-support'></i>
                    <div>تیکت ها</div>
                </a>
            </li>
        </ul>
    </div>
</aside>
