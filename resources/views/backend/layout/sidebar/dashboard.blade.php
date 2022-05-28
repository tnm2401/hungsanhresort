<ul class="sidebar-menu" data-widget="tree">

    <li {{ Hideshow::find(1)->hide_show == 1 ? '' : 'hidden' }} class="{{ Request::routeIs('backend.dashboard.index') ? 'menu-open active' : '' }}"><a
            href="{{ route('backend.dashboard.index') }}"><i class="fa fa-tachometer"></i> <span>{{ __('Bảng điều khiển') }}</span></a></li>
</ul>
