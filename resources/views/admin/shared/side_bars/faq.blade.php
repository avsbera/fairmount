@php
    $isFaqRoute = request()->routeIs('list.faqs*') 
        || request()->routeIs('create.faq*') 
        || request()->routeIs('sort.faqs*');
@endphp

<li class="nav-item {{ $isFaqRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-question-circle" aria-hidden="true"></i>
        <span class="title">FAQs</span>
        <span class="arrow"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isFaqRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.faqs*') ? 'active' : '' }}">
            <a href="{{ route('list.faqs') }}" class="nav-link">
                <span class="title">List FAQs</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.faq*') ? 'active' : '' }}">
            <a href="{{ route('create.faq') }}" class="nav-link">
                <span class="title">Add new FAQ</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('sort.faqs*') ? 'active' : '' }}">
            <a href="{{ route('sort.faqs') }}" class="nav-link">
                <span class="title">Sort FAQs</span>
            </a>
        </li>
    </ul>
</li>
