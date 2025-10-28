<li class="nav-item {{ request()->routeIs('list.jobs*') || request()->routeIs('create.job*') || request()->routeIs('list.jobsB*') ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-briefcase"></i>
        <span class="title">Jobs</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu" style="display: {{ request()->routeIs('list.jobs*') || request()->routeIs('create.job*') || request()->routeIs('list.jobsB*') ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.jobsB*') ? 'active' : '' }}">
            <a href="{{ route('list.jobsB') }}" class="nav-link">
                <span class="title">Import Jobs</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('list.jobs*') ? 'active' : '' }}">
            <a href="{{ route('list.jobs') }}" class="nav-link">
                <span class="title">List Jobs</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('create.job*') ? 'active' : '' }}">
            <a href="{{ route('create.job') }}" class="nav-link">
                <span class="title">Add new Job</span>
            </a>
        </li>
    </ul>
</li>
