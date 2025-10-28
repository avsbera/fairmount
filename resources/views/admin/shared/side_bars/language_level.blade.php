@php
    $isLanguageLevelRoute = request()->routeIs('list.language.levels*') 
        || request()->routeIs('create.language.level*') 
        || request()->routeIs('sort.language.levels*');
@endphp

<li class="nav-item {{ $isLanguageLevelRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-bar-chart" aria-hidden="true"></i>
        <span class="title">Language Levels</span>
        <span class="arrow"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isLanguageLevelRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.language.levels*') ? 'active' : '' }}">
            <a href="{{ route('list.language.levels') }}" class="nav-link">
                <span class="title">List Language Levels</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.language.level*') ? 'active' : '' }}">
            <a href="{{ route('create.language.level') }}" class="nav-link">
                <span class="title">Add new Language Level</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('sort.language.levels*') ? 'active' : '' }}">
            <a href="{{ route('sort.language.levels') }}" class="nav-link">
                <span class="title">Sort Language Levels</span>
            </a>
        </li>
    </ul>
</li>
