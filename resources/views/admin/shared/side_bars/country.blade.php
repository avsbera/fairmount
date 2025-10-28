@php
    $isCountryRoute = request()->routeIs('list.countries*') 
        || request()->routeIs('create.country*');
@endphp

<li class="nav-item {{ $isCountryRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-globe" aria-hidden="true"></i>
        <span class="title">Countries</span>
        <span class="arrow"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isCountryRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.countries*') ? 'active' : '' }}">
            <a href="{{ route('list.countries') }}" class="nav-link">
                <span class="title">List Countries</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.country*') ? 'active' : '' }}">
            <a href="{{ route('create.country') }}" class="nav-link">
                <span class="title">Add new Country</span>
            </a>
        </li>
    </ul>
</li>
