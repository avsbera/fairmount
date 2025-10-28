@php
    $isCmsRoute = request()->routeIs('list.cms*') 
        || request()->routeIs('create.cms*') 
        || request()->routeIs('list.cmsContent*') 
        || request()->routeIs('create.cmsContent*');
@endphp

<li class="nav-item {{ $isCmsRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-file-text-o" aria-hidden="true"></i>
        <span class="title">C.M.S</span>
        <span class="arrow"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isCmsRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.cms*') ? 'active' : '' }}">
            <a href="{{ route('list.cms') }}" class="nav-link">
                <span class="title">List C.M.S Pages</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.cms*') ? 'active' : '' }}">
            <a href="{{ route('create.cms') }}" class="nav-link">
                <span class="title">Add new C.M.S Page</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('list.cmsContent*') ? 'active' : '' }}">
            <a href="{{ route('list.cmsContent') }}" class="nav-link">
                <span class="title">List Pages</span>
            </a>
        </li>

        {{-- 
        <li class="nav-item {{ request()->routeIs('create.cmsContent*') ? 'active' : '' }}">
            <a href="{{ route('create.cmsContent') }}" class="nav-link">
                <span class="title">Add new Translate Page</span>
            </a>
        </li> 
        --}}
    </ul>
</li>
