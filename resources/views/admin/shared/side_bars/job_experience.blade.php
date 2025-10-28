@php
    $isJobExperienceRoute = request()->routeIs('list.job.experiences*') 
        || request()->routeIs('create.job.experience*') 
        || request()->routeIs('sort.job.experiences*');
@endphp

<li class="nav-item {{ $isJobExperienceRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-pie-chart" aria-hidden="true"></i>
        <span class="title">Job Experiences</span>
        <span class="arrow {{ $isJobExperienceRoute ? 'open' : '' }}"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isJobExperienceRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.job.experiences*') ? 'active' : '' }}">
            <a href="{{ route('list.job.experiences') }}" class="nav-link">
                <span class="title">List Job Experiences</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.job.experience*') ? 'active' : '' }}">
            <a href="{{ route('create.job.experience') }}" class="nav-link">
                <span class="title">Add new Job Experience</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('sort.job.experiences*') ? 'active' : '' }}">
            <a href="{{ route('sort.job.experiences') }}" class="nav-link">
                <span class="title">Sort Job Experiences</span>
            </a>
        </li>
    </ul>
</li>
