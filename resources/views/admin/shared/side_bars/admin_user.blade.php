@if(APAuthHelp::check(['SUP_ADM']))
<li class="heading">
    <h3 class="uppercase">Admin Users</h3>
</li>

@php
    $isAdminRoute = request()->routeIs('list.admin.users*') || request()->routeIs('create.admin.user*');
@endphp

<li class="nav-item {{ $isAdminRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-user"></i>
        <span class="title">Admin Users</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu" style="display: {{ $isAdminRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.admin.users*') ? 'active' : '' }}">
            <a href="{{ route('list.admin.users') }}" class="nav-link">
                <i class="icon-user"></i>
                <span class="title">List All Admin Users</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('create.admin.user*') ? 'active' : '' }}">
            <a href="{{ route('create.admin.user') }}" class="nav-link">
                <i class="icon-users"></i>
                <span class="title">Add Admin User</span>
            </a>
        </li>
    </ul>
</li>
@endif
