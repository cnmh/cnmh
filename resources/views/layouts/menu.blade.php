@can('index-DossierPatientsController')
<li class="nav-item">
    <a href="{{ route('dossier-patients.index') }}"
        class="nav-link {{ Route::is('dossier-patients.index' . '*') ? 'active' : '' }}">
        <i class="fa-solid fa-hospital-user"></i>
        <p>Dossier beneficiers</p>
    </a>
</li>
@endcan

@can('index-UserController')
<li class="nav-item">
    <a href="{{ route('users.index') }}"
        class="nav-link {{ Route::is('users.index' . '*') ? 'active' : '' }}">
        <i class="fa-solid fa-gears"></i>        
        <p>Attribuer Roles</p>
    </a>
</li>
@endcan

@can('index-PermissionController')
<li class="nav-item">
    <a href="{{ route('permissions.index') }}"
        class="nav-link {{ Route::is('permissions.index' . '*') ? 'active' : '' }}">
        <i class="fa-solid fa-gears"></i>        
        <p>Permissions</p>
    </a>
</li>
@endcan

@can('index-EtatCivilController')
<li class="nav-item">
    <a href="{{ route('etatCivils.index') }}"
        class="nav-link {{ Route::is('etatCivils.index' . '*') ? 'active' : '' }}">
        <i class="fa-solid fa-gears"></i>        
        <p>Etat Civil</p>
    </a>
</li>
@endcan


{{-- 
@foreach (app_menu() as $group => $items)
    @if (strlen($group) < 1)

        @foreach ($items as $item)
            <li class="nav-item">
                <a href="{{ Route::has($item->url) ? route($item->url) : $item->url }}"
class="nav-link {{ Route::is($item->url . '*') ? 'active' : '' }}">
{!! $item->icon !!}
<p> {{ $item->nom }} </p>
</a>
</li>
@endforeach
@else
@php
$isActive = $items->filter(fn($item, $key) => Route::is($item->url . '*'))->isNotEmpty();
@endphp
<li class="nav-item {{ $isActive ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ $isActive ? 'active' : '' }}">
        {!! $items->first()->menu_group?->icon !!}
        <p class="pl-2">
            {{ $group }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="">
        @foreach ($items as $item)
        <li class="nav-item">
            <a href="{{ Route::has($item->url) ? route($item->url) : $item->url }}"
                class="nav-link {{ Route::is($item->url . '*') ? 'active' : '' }}">
                <p> {{ $item->nom }} </p>
            </a>
        </li>
        @endforeach
    </ul>
</li>
@endif
@endforeach
--}}