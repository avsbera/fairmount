@php
    $isCareerLevelRoute = request()->routeIs('list.career.levels*') 
        || request()->routeIs('create.career.level*') 
        || request()->routeIs('sort.career.levels*');
@endphp

<li class="nav-item {{ $isCareerLevelRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-bar-chart" aria-hidden="true"></i>
        <span class="title">Career Levels</span>
        <span class="arrow {{ $isCareerLevelRoute ? 'open' : '' }}"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isCareerLevelRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.career.levels*') ? 'active' : '' }}">
            <a href="{{ route('list.career.levels') }}" class="nav-link">
                <span class="title">List Career Levels</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.career.level*') ? 'active' : '' }}">
            <a href="{{ route('create.career.level') }}" class="nav-link">
                <span class="title">Add new Career Level</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('sort.career.levels*') ? 'active' : '' }}">
            <a href="{{ route('sort.career.levels') }}" class="nav-link">
                <span class="title">Sort Career Levels</span>
            </a>
        </li>
    </ul>
</li>
