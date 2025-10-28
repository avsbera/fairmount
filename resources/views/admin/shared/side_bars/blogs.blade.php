@php
    $isBlogRoute = request()->routeIs('blog*') 
        || request()->routeIs('add-new-blog*') 
        || request()->is('admin/blog_category*');
@endphp

<li class="nav-item {{ $isBlogRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-level-up" aria-hidden="true"></i>
        <span class="title">Manage Blogs</span>
        <span class="arrow"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isBlogRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('blog*') ? 'active' : '' }}">
            <a href="{{ route('blog') }}" class="nav-link">
                <span class="title">List Blogs</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('add-new-blog*') ? 'active' : '' }}">
            <a href="{{ route('add-new-blog') }}" class="nav-link">
                <span class="title">Add Blog</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('admin/blog_category*') ? 'active' : '' }}">
            <a href="{{ url('/admin/blog_category') }}" class="nav-link">
                <span class="title">Categories</span>
            </a>
        </li>
    </ul>
</li>
