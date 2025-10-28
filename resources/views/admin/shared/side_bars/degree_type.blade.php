@php
    $isDegreeTypeRoute = request()->routeIs('list.degree.types*') 
        || request()->routeIs('create.degree.type*');
@endphp

<li class="nav-item {{ $isDegreeTypeRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-file-text-o" aria-hidden="true"></i>
        <span class="title">Degree Types</span>
        <span class="arrow {{ $isDegreeTypeRoute ? 'open' : '' }}"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isDegreeTypeRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.degree.types*') ? 'active' : '' }}">
            <a href="{{ route('list.degree.types') }}" class="nav-link">
                <span class="title">List Degree Types</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.degree.type*') ? 'active' : '' }}">
            <a href="{{ route('create.degree.type') }}" class="nav-link">
                <span class="title">Add new Degree Type</span>
            </a>
        </li>
    </ul>
</li>
