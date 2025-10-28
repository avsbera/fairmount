@php
    $isUserProfileRoute = request()->routeIs('list.users*') || request()->routeIs('create.user*');
@endphp

<li class="nav-item {{ $isUserProfileRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-user"></i>
        <span class="title">User Profiles</span>
        <span class="arrow"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isUserProfileRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.users*') ? 'active' : '' }}">
            <a href="{{ route('list.users') }}" class="nav-link">
                <i class="icon-user"></i>
                <span class="title">List User Profiles</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.user*') ? 'active' : '' }}">
            <a href="{{ route('create.user') }}" class="nav-link">
                <i class="icon-user"></i>
                <span class="title">Add new User Profile</span>
            </a>
        </li>
    </ul>
</li>
