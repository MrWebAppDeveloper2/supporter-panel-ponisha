<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner">
            <!-- Dashboards -->
            <li @class(['menu-item', 'active' => (request()->routeIs('dashboard'))])>
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div>داشبورد</div>
                </a>
            </li>
{{--            <li class="menu-item active">--}}
{{--                <a href="javascript:void(0)" class="menu-link menu-toggle">--}}
{{--                    <i class="menu-icon tf-icons bx bx-home-circle"></i>--}}
{{--                    <div>داشبورد</div>--}}
{{--                </a>--}}
{{--                <ul class="menu-sub">--}}
{{--                    <li class="menu-item active">--}}
{{--                        <a href="index.html" class="menu-link">--}}
{{--                            <i class="menu-icon tf-icons bx bx-pie-chart-alt-2"></i>--}}
{{--                            <div data-i18n="Analytics">تجزیه و تحلیل</div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
        </ul>
    </div>
</aside>
