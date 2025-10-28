{{-- <li class="nav-item  "> <a href="javascript:;" class="nav-link nav-toggle"> <i class="icon-wrench"></i> <span class="title">Site Settings</span> <span class="arrow"></span> </a>
    <ul class="sub-menu">
        <li class="nav-item  "> <a href="{{ route('edit.site.setting') }}" class="nav-link "> <span class="title">Manage Site Settings</span> </a> </li>


    </ul>
</li> --}}


@php
    use App\Models\WidgetPages;
    $w_pages = WidgetPages::where('status', 'active')->get();
    $isWidgetActive = false;

    if ($w_pages->count()) {
        foreach ($w_pages as $w_p) {
            if (request()->routeIs('admin.widgets_data') && request()->route('slug') == $w_p->slug) {
                $isWidgetActive = true;
                break;
            }
        }
    }
@endphp

<li class="nav-item {{ $isWidgetActive ? 'open' : '' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-wrench"></i>
        <span class="title">Static Content Widgets</span>
        <span class="arrow {{ $isWidgetActive ? 'open' : '' }}"></span>
    </a>

    <ul class="sub-menu" style="display: {{ $isWidgetActive ? 'block' : 'none' }}">
        @if($w_pages->count())
            @foreach($w_pages as $w_p)
                <li class="nav-item {{ (request()->routeIs('admin.widgets_data') && request()->route('slug') == $w_p->slug) ? 'active' : '' }}">
                    <a href="{{ route('admin.widgets_data', $w_p->slug) }}" class="nav-link">
                        <span class="title">{{ $w_p->title }}</span>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</li>
