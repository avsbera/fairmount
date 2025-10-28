@php
    $isCountryDetailsRoute = request()->routeIs('list.country.details*');
@endphp

<li class="nav-item {{ $isCountryDetailsRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-globe" aria-hidden="true"></i>
        <span class="title">Country Details</span>
        <span class="arrow"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isCountryDetailsRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.country.details*') ? 'active' : '' }}">
            <a href="{{ route('list.country.details') }}" class="nav-link">
                <span class="title">List Country Details</span>
            </a>
        </li>
    </ul>
</li>
