@php
    $isJobTypeRoute = request()->routeIs('list.job.types*') 
        || request()->routeIs('create.job.type*') 
        || request()->routeIs('sort.job.types*');
@endphp

<li class="nav-item {{ $isJobTypeRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-briefcase" aria-hidden="true"></i>
        <span class="title">Job Types</span>
        <span class="arrow {{ $isJobTypeRoute ? 'open' : '' }}"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isJobTypeRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.job.types*') ? 'active' : '' }}">
            <a href="{{ route('list.job.types') }}" class="nav-link">
                <span class="title">List Job Types</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.job.type*') ? 'active' : '' }}">
            <a href="{{ route('create.job.type') }}" class="nav-link">
                <span class="title">Add new Job Type</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('sort.job.types*') ? 'active' : '' }}">
            <a href="{{ route('sort.job.types') }}" class="nav-link">
                <span class="title">Sort Job Types</span>
            </a>
        </li>
    </ul>
</li>
