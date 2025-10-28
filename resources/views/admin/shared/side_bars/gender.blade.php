@php
    $isGenderRoute = request()->routeIs('list.genders*') 
        || request()->routeIs('create.gender*') 
        || request()->routeIs('sort.genders*');
@endphp

<li class="nav-item {{ $isGenderRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-venus-double" aria-hidden="true"></i>
        <span class="title">Genders</span>
        <span class="arrow {{ $isGenderRoute ? 'open' : '' }}"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isGenderRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.genders*') ? 'active' : '' }}">
            <a href="{{ route('list.genders') }}" class="nav-link">
                <span class="title">List Genders</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.gender*') ? 'active' : '' }}">
            <a href="{{ route('create.gender') }}" class="nav-link">
                <span class="title">Add new Gender</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('sort.genders*') ? 'active' : '' }}">
            <a href="{{ route('sort.genders') }}" class="nav-link">
                <span class="title">Sort Genders</span>
            </a>
        </li>
    </ul>
</li>
