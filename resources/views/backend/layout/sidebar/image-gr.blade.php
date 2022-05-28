<ul {{ Hideshow::find(22)->hide_show == 1 ? '' : 'hidden' }} class="sidebar-menu" data-widget="tree">
    <li
        class="treeview {{ $segment2 == 'slider' || $segment2 == 'gallerys' || $segment2 == 'other'? 'menu-open active': '' }}">
        <a href="#"><i class="fa fa-image"></i> <span>{{ __('Hình ảnh') }}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu"
            style="{{Request::routeIs('backend.gallery.*') || Request::routeIs('backend.slider.*') ? 'display:block' : '' }}">
            <li {{ Hideshow::find(23)->hide_show == 1 ? '' : 'hidden' }} {{ Request::routeIs('backend.slider.*') ? 'class=active' : '' }}><a
                    href="{{ route('backend.slider.index') }}"><i class="fa fa-angle-right"></i>{{ __('Slider') }}</a></li>
            <li {{ Request::routeIs('backend.gallery.*') ? 'class=active' : '' }}><a href="{{ route('backend.gallery.index') }}"><i
                        class="fa fa-angle-right"></i>{{ __('Thư viện') }}</a></li>
            {{-- <li {{ Request::routeIs('backend.gallery.*') ? 'class=active' : '' }}><a href="{{ route('backend.gallery.index') }}"><i
                class="fa fa-angle-right"></i>{{ __('Quản lí ảnh') }}</a></li> --}}
            {{-- <li {{ Hideshow::find(24)->hide_show == 1 ? '' : 'hidden' }} {{ $segment2 == 'social' ? 'class=active' : '' }}><a href=""><i
                        class="fa fa-angle-right"></i>{{ __('admin.image.other') }}</a></li> --}}
        </ul>
    </li>
</ul>
