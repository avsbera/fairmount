@php
    $isSalaryPeriodRoute = request()->routeIs('list.salary.periods*') 
        || request()->routeIs('create.salary.period*') 
        || request()->routeIs('sort.salary.periods*');
@endphp

<li class="nav-item {{ $isSalaryPeriodRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-money" aria-hidden="true"></i>
        <span class="title">Salary Periods</span>
        <span class="arrow {{ $isSalaryPeriodRoute ? 'open' : '' }}"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isSalaryPeriodRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.salary.periods*') ? 'active' : '' }}">
            <a href="{{ route('list.salary.periods') }}" class="nav-link">
                <span class="title">List Salary Periods</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.salary.period*') ? 'active' : '' }}">
            <a href="{{ route('create.salary.period') }}" class="nav-link">
                <span class="title">Add new Salary Period</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('sort.salary.periods*') ? 'active' : '' }}">
            <a href="{{ route('sort.salary.periods') }}" class="nav-link">
                <span class="title">Sort Salary Periods</span>
            </a>
        </li>
    </ul>
</li>
