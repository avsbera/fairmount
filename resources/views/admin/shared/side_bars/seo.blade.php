@php
    $isSeoRoute = request()->routeIs('list.seo*');
@endphp

<li class="nav-item {{ $isSeoRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-line-chart" aria-hidden="true"></i>
        <span class="title">S.E.O</span>
        <span class="arrow"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isSeoRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.seo*') ? 'active' : '' }}">
            <a href="{{ route('list.seo') }}" class="nav-link">
                <span class="title">List Pages</span>
            </a>
        </li>
    </ul>
</li>
