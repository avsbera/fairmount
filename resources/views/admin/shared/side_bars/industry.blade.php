@php
    $isIndustryRoute = request()->routeIs('list.industries*') 
        || request()->routeIs('create.industry*') 
        || request()->routeIs('sort.industries*');
@endphp

<li class="nav-item {{ $isIndustryRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-building-o" aria-hidden="true"></i>
        <span class="title">Industries</span>
        <span class="arrow {{ $isIndustryRoute ? 'open' : '' }}"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isIndustryRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.industries*') ? 'active' : '' }}">
            <a href="{{ route('list.industries') }}" class="nav-link">
                <span class="title">List Industries</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.industry*') ? 'active' : '' }}">
            <a href="{{ route('create.industry') }}" class="nav-link">
                <span class="title">Add new Industry</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('sort.industries*') ? 'active' : '' }}">
            <a href="{{ route('sort.industries') }}" class="nav-link">
                <span class="title">Sort Industries</span>
            </a>
        </li>
    </ul>
</li>
