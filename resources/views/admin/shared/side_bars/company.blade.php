@php
    $isCompanyRoute = request()->routeIs('list.companies*') 
        || request()->routeIs('create.company*') 
        || request()->routeIs('list.payment.hostory*');
@endphp

<li class="nav-item {{ $isCompanyRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-building"></i>
        <span class="title">Companies</span>
        <span class="arrow"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isCompanyRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.companies*') ? 'active' : '' }}">
            <a href="{{ route('list.companies') }}" class="nav-link">
                <span class="title">List Companies</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.company*') ? 'active' : '' }}">
            <a href="{{ route('create.company') }}" class="nav-link">
                <span class="title">Add new Company</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('list.payment.hostory*') ? 'active' : '' }}">
            <a href="{{ route('list.payment.hostory') }}" class="nav-link">
                <span class="title">List Companies Payment History</span>
            </a>
        </li>
    </ul>
</li>
