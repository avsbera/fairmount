@php
    $isCityRoute = request()->routeIs('list.cities*') 
        || request()->routeIs('create.city*');
@endphp

<li class="nav-item {{ $isCityRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-globe" aria-hidden="true"></i>
        <span class="title">Cities</span>
        <span class="arrow"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isCityRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.cities*') ? 'active' : '' }}">
            <a href="{{ route('list.cities') }}" class="nav-link">
                <span class="title">List Cities</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.city*') ? 'active' : '' }}">
            <a href="{{ route('create.city') }}" class="nav-link">
                <span class="title">Add new City</span>
            </a>
        </li>
    </ul>
</li>
