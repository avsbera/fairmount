@php
    $isJobShiftRoute = request()->routeIs('list.job.shifts*') 
        || request()->routeIs('create.job.shift*') 
        || request()->routeIs('sort.job.shifts*');
@endphp

<li class="nav-item {{ $isJobShiftRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-black-tie" aria-hidden="true"></i>
        <span class="title">Job Shifts</span>
        <span class="arrow {{ $isJobShiftRoute ? 'open' : '' }}"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isJobShiftRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.job.shifts*') ? 'active' : '' }}">
            <a href="{{ route('list.job.shifts') }}" class="nav-link">
                <span class="title">List Job Shifts</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.job.shift*') ? 'active' : '' }}">
            <a href="{{ route('create.job.shift') }}" class="nav-link">
                <span class="title">Add new Job Shift</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('sort.job.shifts*') ? 'active' : '' }}">
            <a href="{{ route('sort.job.shifts') }}" class="nav-link">
                <span class="title">Sort Job Shifts</span>
            </a>
        </li>
    </ul>
</li>
