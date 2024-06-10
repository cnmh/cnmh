@can('index-DossierPatient')
<li class="nav-item">
    @if(\App\Models\Consultation\Consultation::SocialType() === "Liste-d'attente")
        <a href="{{ route('dossier-patients.list') }}"
            class="nav-link {{ Route::is('dossier-patients.list' . '*') ? 'active' : '' }}">
            <i class="fa-solid fa-hospital-user"></i>
            <p>Dossier bénéficiaires</p>
        </a>
    @else
        <a href="{{ route('dossier-patients.' . \App\Models\Consultation\Consultation::OrientationType()) }}"
            class="nav-link {{ Route::is('dossier-patients.' . \App\Models\Consultation\Consultation::OrientationType() . '*') ? 'active' : '' }}">
            <i class="fa-solid fa-hospital-user"></i>
            <p>Dossier bénéficiaires</p>
        </a>
    @endif
</li>

@endcan

@can('index-RendezVous')

<li class="nav-item "> 
    <a href="#" class="nav-link ">
        <i class="fa-solid fa-gears"></i>
        <p class="pl-2">
            Service Social 
        </p>
    </a>
    <ul class="nav nav-treeview" style="">
        <li class="nav-item">
            <a href="/Pôle-medical/{{ \App\Models\Consultation\Consultation::SocialType() }}/Consultations" class="nav-link {{ Route::is('consultations.index' . '*') ? 'active' : '' }}">
                <p>Liste d'attente médecin</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('rendez-vous.index') }}" class="nav-link {{ Route::is('rendez-vous.index' . '*') ? 'active' : '' }}">
                <p>Rendez vous médecin </p>
            </a>
        </li>
    </ul>

</li>   

@endcan

@can('Ajouter_RendezVous-Consultation')

<li class="nav-item "> 
    <a href="#" class="nav-link ">
    <i class="fa-solid fa-hospital-user"></i>
        <p class="pl-2">
            {{ \App\Models\Consultation\Consultation::OrientationType() }}
        </p>
    </a>
    <ul class="nav nav-treeview" style="">
        <li class="nav-item">
            @if(\App\Models\Consultation\Consultation::OrientationType()==="Médecin-général")
                <a href="{{ route('consultations.list') }}" class="nav-link {{ Route::is('consultations.list' . '*') ? 'active' : '' }}">
                    <p>Consultation </p>
                </a>
            @else

            <a href="{{ route(\App\Models\Consultation\Consultation::OrientationType().'.list') }}" class="nav-link {{ Route::is('consultations.list' . '*') ? 'active' : '' }}">
                <p>Consultation </p>
            </a>
            @endif
        </li>
        <li class="nav-item">
            @if(\App\Models\Consultation\Consultation::OrientationType() !== "Médecin-général")
                <a href="{{ route(\App\Models\Consultation\Consultation::OrientationType().'.seance') }}" class="nav-link {{ Route::is(route(\App\Models\Consultation\Consultation::OrientationType().'.seance') . '*') ? 'active' : '' }}">
                    <p>Suiver seance </p>
                </a>
            @endif
        </li>
    </ul>
    

    </li>   

@endcan


@can('index-Permission')
<li class="nav-item ">
    <a href="#" class="nav-link ">
        <i class="fa-solid fa-gears"></i>
        <p class="pl-2">
            Gestion permissions
        </p>
    </a>
    <ul class="nav nav-treeview" style="">


    @can('index-User')
<li class="nav-item">
    <a href="{{ route('users.index') }}" class="nav-link {{ Route::is('users.index' . '*') ? 'active' : '' }}">
        <p>Attribuer Roles</p>
    </a>
</li>
@endcan

@can('index-Permission')
<li class="nav-item">
    <a href="{{ route('permissions.index') }}"
        class="nav-link {{ Route::is('permissions.index' . '*') ? 'active' : '' }}">
        <p>Permissions</p>
    </a>
</li>
@endcan

@can('index-Role')
<li class="nav-item">
    <a href="{{ route('roles.index') }}" class="nav-link {{ Route::is('roles.index' . '*') ? 'active' : '' }}">
        <p>Rôles</p>
    </a>
</li>
@endcan

    </ul>
</li>
@endcan
@can('index-TypeHandicap')
<li class="nav-item ">
    <a href="#" class="nav-link ">
        <i class="fa-solid fa-gears"></i>
        <p class="pl-2">
            Parametres
        </p>
    </a>
    <ul class="nav nav-treeview" style="">


@can('index-Service')
<li class="nav-item">
    <a href="{{ route('services.index') }}" class="nav-link {{ Route::is('services.index' . '*') ? 'active' : '' }}">
        <p>Prestations</p>
    </a>
</li>
@endcan
@can('index-NiveauScolaire')
<li class="nav-item">
    <a href="{{ route('niveauScolaires.index') }}"
        class="nav-link {{ Route::is('niveauScolaires.index' . '*') ? 'active' : '' }}">
        <p>Niveau Scolaires</p>
    </a>
</li>
@endcan
@can('index-CouvertureMedical')
<li class="nav-item">
    <a href="{{ route('couvertureMedicals.index') }}"
        class="nav-link {{ Route::is('couvertureMedicals.index' . '*') ? 'active' : '' }}">
        <p>Couverture Médicale</p>
    </a>
</li>
@endcan
@can('index-TypeHandicap')
<li class="nav-item">
    <a href="{{ route('typeHandicaps.index') }}"
        class="nav-link {{ Route::is('typeHandicaps.index' . '*') ? 'active' : '' }}">
        <p>Type d'handicaps</p>
    </a>
</li>
@endcan

@can('index-EtatCivil')
<li class="nav-item">
    <a href="{{ route('etatCivils.index') }}"
        class="nav-link {{ Route::is('etatCivils.index' . '*') ? 'active' : '' }}">
        <p>Etat Civil</p>
    </a>
</li>
@endcan
@can('index-Employe')
<li class="nav-item">
    <a href="{{ route('employes.index') }}" class="nav-link {{ Route::is('employes.index' . '*') ? 'active' : '' }}">
        <p>Employés</p>
    </a>
</li>
@endcan
    </ul>
</li>
@endcan


{{--
@foreach (app_menu() as $group => $items)
@if (strlen($group) < 1) @foreach ($items as $item) <li class="nav-item">
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