@php
    $isDegreeLevelRoute = request()->routeIs('list.degree.levels*') 
        || request()->routeIs('create.degree.level*');
@endphp

<li class="nav-item {{ $isDegreeLevelRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-level-up" aria-hidden="true"></i>
        <span class="title">Degree Levels</span>
        <span class="arrow {{ $isDegreeLevelRoute ? 'open' : '' }}"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isDegreeLevelRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.degree.levels*') ? 'active' : '' }}">
            <a href="{{ route('list.degree.levels') }}" class="nav-link">
                <span class="title">List Degree Levels</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.degree.level*') ? 'active' : '' }}">
            <a href="{{ route('create.degree.level') }}" class="nav-link">
                <span class="title">Add new Degree Level</span>
            </a>
        </li>
    </ul>
</li>
