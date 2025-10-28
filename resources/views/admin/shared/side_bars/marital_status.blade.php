@php
    $isMaritalStatusRoute = request()->routeIs('list.marital.statuses*') 
        || request()->routeIs('create.marital.status*') 
        || request()->routeIs('sort.marital.statuses*');
@endphp

<li class="nav-item {{ $isMaritalStatusRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-mars-double" aria-hidden="true"></i>
        <span class="title">Marital Statuses</span>
        <span class="arrow {{ $isMaritalStatusRoute ? 'open' : '' }}"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isMaritalStatusRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.marital.statuses*') ? 'active' : '' }}">
            <a href="{{ route('list.marital.statuses') }}" class="nav-link">
                <span class="title">List Marital Statuses</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.marital.status*') ? 'active' : '' }}">
            <a href="{{ route('create.marital.status') }}" class="nav-link">
                <span class="title">Add new Marital Status</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('sort.marital.statuses*') ? 'active' : '' }}">
            <a href="{{ route('sort.marital.statuses') }}" class="nav-link">
                <span class="title">Sort Marital Statuses</span>
            </a>
        </li>
    </ul>
</li>
