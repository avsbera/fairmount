@php
    $isJobSkillRoute = request()->routeIs('list.job.skills*') 
        || request()->routeIs('create.job.skill*') 
        || request()->routeIs('sort.job.skills*');
@endphp

<li class="nav-item {{ $isJobSkillRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-area-chart" aria-hidden="true"></i>
        <span class="title">Job Skills</span>
        <span class="arrow {{ $isJobSkillRoute ? 'open' : '' }}"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isJobSkillRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.job.skills*') ? 'active' : '' }}">
            <a href="{{ route('list.job.skills') }}" class="nav-link">
                <span class="title">List Job Skills</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.job.skill*') ? 'active' : '' }}">
            <a href="{{ route('create.job.skill') }}" class="nav-link">
                <span class="title">Add new Job Skill</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('sort.job.skills*') ? 'active' : '' }}">
            <a href="{{ route('sort.job.skills') }}" class="nav-link">
                <span class="title">Sort Job Skills</span>
            </a>
        </li>
    </ul>
</li>
