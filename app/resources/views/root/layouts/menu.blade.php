<li class="nav-item">
    <a href="{{ route('menu-groups.index') }}" class="nav-link {{ Request::is('menuGroups*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>@lang('models/menuGroups.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('menu-items.index') }}" class="nav-link {{ Request::is('menuItems*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>@lang('models/menuItems.plural')</p>
    </a>
</li>