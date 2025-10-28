@php
    $isOwnershipTypeRoute = request()->routeIs('list.ownership.types*') 
        || request()->routeIs('create.ownership.type*') 
        || request()->routeIs('sort.ownership.types*');
@endphp

<li class="nav-item {{ $isOwnershipTypeRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-user" aria-hidden="true"></i>
        <span class="title">Ownership Types</span>
        <span class="arrow {{ $isOwnershipTypeRoute ? 'open' : '' }}"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isOwnershipTypeRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.ownership.types*') ? 'active' : '' }}">
            <a href="{{ route('list.ownership.types') }}" class="nav-link">
                <span class="title">List Ownership Types</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.ownership.type*') ? 'active' : '' }}">
            <a href="{{ route('create.ownership.type') }}" class="nav-link">
                <span class="title">Add new Ownership Type</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('sort.ownership.types*') ? 'active' : '' }}">
            <a href="{{ route('sort.ownership.types') }}" class="nav-link">
                <span class="title">Sort Ownership Types</span>
            </a>
        </li>
    </ul>
</li>
