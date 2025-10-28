@php
    $isResultTypeRoute = request()->routeIs('list.result.types*') 
        || request()->routeIs('create.result.type*') 
        || request()->routeIs('sort.result.types*');
@endphp

<li class="nav-item {{ $isResultTypeRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
        <span class="title">Result Types</span>
        <span class="arrow {{ $isResultTypeRoute ? 'open' : '' }}"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isResultTypeRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.result.types*') ? 'active' : '' }}">
            <a href="{{ route('list.result.types') }}" class="nav-link">
                <span class="title">List Result Types</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.result.type*') ? 'active' : '' }}">
            <a href="{{ route('create.result.type') }}" class="nav-link">
                <span class="title">Add new Result Type</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('sort.result.types*') ? 'active' : '' }}">
            <a href="{{ route('sort.result.types') }}" class="nav-link">
                <span class="title">Sort Result Types</span>
            </a>
        </li>
    </ul>
</li>
