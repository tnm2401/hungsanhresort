<ul {{ Hideshow::find(8)->hide_show == 1 ? '' : 'hidden' }} class="sidebar-menu" data-widget="tree">
    <li
        class="treeview {{ Request::routeIs('backend.procatone.*') ||Request::routeIs('backend.procattwo.*') ||Request::routeIs('backend.procatthree.*') ||Request::routeIs('backend.product.*') ||Request::routeIs('backend.serviceroom.*')? 'menu-open active': '' }}">
        <a href="#"><i class="fa-brands fa-product-hunt"></i> <span>&nbsp; {{ __('Phòng') }}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu"
            style="{{ Request::routeIs('backend.product.*') ? 'display:block' : '' }}">
            <li {{ Hideshow::find(9)->hide_show == 1 ? '' : 'hidden' }} {{ Request::routeIs('backend.procatone.*') ? 'class=active' : '' }}><a
                    href="{{ route('backend.procatone.index') }}"><i class="fa fa-angle-right"></i>{{ __('Danh mục phòng') }}</a></li>
            {{-- <li {{ Hideshow::find(10)->hide_show == 1 ? '' : 'hidden' }} {{ Request::routeIs('backend.procattwo.*') ? 'class=active' : '' }}><a
                    href="{{ route('backend.procattwo.index') }}"><i class="fa fa-angle-right"></i>{{ __('admin.product.cate2') }}</a></li>
            <li {{ Hideshow::find(11)->hide_show == 1 ? '' : 'hidden' }} {{ Request::routeIs('backend.procatthree.*') ? 'class=active' : '' }}><a
                    href="{{ route('backend.procatthree.index') }}"><i class="fa fa-angle-right"></i>{{ __('admin.product.cate3') }}</a></li> --}}
            <li {{ Hideshow::find(12)->hide_show == 1 ? '' : 'hidden' }} {{ Request::routeIs('backend.product.*') ? 'class=active' : '' }}><a
                    href="{{ route('backend.product.index') }}"><i class="fa fa-angle-right"></i>{{ __('Quản lí phòng') }}</a></li>
            {{-- <li {{ Hideshow::find(12)->hide_show == 1 ? '' : 'hidden' }} {{ Request::routeIs('backend.serviceroom.*') ? 'class=active' : '' }}><a
                href="{{ route('backend.serviceroom.index') }}"><i class="fa fa-angle-right"></i>{{ __('Dịch vụ phòng') }}</a></li> --}}
        </ul>
    </li>
</ul>
