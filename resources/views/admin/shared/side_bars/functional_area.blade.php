@php
    $isFunctionalAreaRoute = request()->routeIs('list.functional.areas*') 
        || request()->routeIs('create.functional.area*');
@endphp

<li class="nav-item {{ $isFunctionalAreaRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-university" aria-hidden="true"></i>
        <span class="title">Functional Areas</span>
        <span class="arrow {{ $isFunctionalAreaRoute ? 'open' : '' }}"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isFunctionalAreaRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.functional.areas*') ? 'active' : '' }}">
            <a href="{{ route('list.functional.areas') }}" class="nav-link">
                <span class="title">List Functional Areas</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.functional.area*') ? 'active' : '' }}">
            <a href="{{ route('create.functional.area') }}" class="nav-link">
                <span class="title">Add new Functional Area</span>
            </a>
        </li>
    </ul>
</li>
