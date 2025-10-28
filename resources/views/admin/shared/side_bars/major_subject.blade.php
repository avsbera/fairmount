@php
    $isMajorSubjectRoute = request()->routeIs('list.major.subjects*') 
        || request()->routeIs('create.major.subject*') 
        || request()->routeIs('sort.major.subjects*');
@endphp

<li class="nav-item {{ $isMajorSubjectRoute ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-book" aria-hidden="true"></i>
        <span class="title">Major Subjects</span>
        <span class="arrow {{ $isMajorSubjectRoute ? 'open' : '' }}"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isMajorSubjectRoute ? 'block' : 'none' }}">
        <li class="nav-item {{ request()->routeIs('list.major.subjects*') ? 'active' : '' }}">
            <a href="{{ route('list.major.subjects') }}" class="nav-link">
                <span class="title">List Major Subjects</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('create.major.subject*') ? 'active' : '' }}">
            <a href="{{ route('create.major.subject') }}" class="nav-link">
                <span class="title">Add new Major Subject</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('sort.major.subjects*') ? 'active' : '' }}">
            <a href="{{ route('sort.major.subjects') }}" class="nav-link">
                <span class="title">Sort Major Subjects</span>
            </a>
        </li>
    </ul>
</li>
