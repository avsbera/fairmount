@php
    $isPackageRoute = request()->routeIs('list.packages*') 
        || request()->routeIs('create.package*');
@endphp

<li class="nav-item {{ $isPackageRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-money" aria-hidden="true"></i>
        <span class="title">Packages</span>
        <span class="arrow"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isPackageRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.packages*') ? 'active' : '' }}">
            <a href="{{ route('list.packages') }}" class="nav-link">
                <span class="title">List Packages</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.package*') ? 'active' : '' }}">
            <a href="{{ route('create.package') }}" class="nav-link">
                <span class="title">Add new Package</span>
            </a>
        </li>
    </ul>
</li>
