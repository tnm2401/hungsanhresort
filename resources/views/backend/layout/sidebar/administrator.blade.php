
        <ul {{ Hideshow::find(29)->hide_show == 1 ? '' : 'hidden' }} class="sidebar-menu" data-widget="tree">

            <li
                class="treeview {{ $segment2 == 'config' ||Request::routeIs('backend.language.*') ||Request::routeIs('sources.*') ||Request::routeIs('backend.hideshow.*')? 'menu-open active': '' }}">
                <a href="#"><i class="fa fa-user-secret"></i> <span>{{ __('Admin hệ thống') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="{{ Request::routeIs('backend.role.*') ? 'display:block' : '' }}">
                    <li {{ Hideshow::find(30)->hide_show == 1 ? '' : 'hidden' }} {{ Request::routeIs('role.*') ? 'class=active' : '' }}><a
                            href="{{ route('role.index') }}"><i class="fa fa-angle-right"></i>{{ __('Nhóm & phân quyền') }}</a>
                    </li>
                    <li {{ Hideshow::find(31)->hide_show == 1 ? '' : 'hidden' }} {{ Request::routeIs('backend.user.*') ? 'class=active' : '' }}><a
                            href="{{ route('backend.user.index') }}"><i class="fa fa-angle-right"></i>{{ __('Quản lí thành viên') }}</a></li>
                    <li {{ Hideshow::find(32)->hide_show == 1 ? '' : 'hidden' }} {{ Request::routeIs('sources.index') ? 'class=active' : '' }}><a
                            href="{{ route('sources.index') }}"><i class="fa fa-angle-right"></i>{{ __('Sửa source web') }}</a>
                    </li>
                    <li {{ Hideshow::find(33)->hide_show == 1 ? '' : 'hidden' }} {{ Request::routeIs('backend.language.*') ? 'class=active' : '' }}><a
                            href="{{ route('backend.language.index') }}"><i class="fa fa-angle-right"></i>{{ __('Ngôn ngữ hệ thống') }}</a></li>
                    <li {{ Hideshow::find(34)->hide_show == 1 ? '' : 'hidden' }} {{ Request::routeIs('backend.hideshow.*') ? 'class=active' : '' }}><a
                            href="{{ route('backend.hideshow.index') }}"><i class="fa fa-angle-right"></i>{{ __('Ẩn hiện menu') }}</a></li>
                    <li {{ Hideshow::find(34)->hide_show == 1 ? '' : 'hidden' }} {{ Request::routeIs('backend.sizecrop.*') ? 'class=active' : '' }}><a
                        href="{{ route('backend.sizecrop.index') }}"><i class="fa fa-angle-right"></i>{{ __('Crop size hình') }}</a></li>
                </ul>
            </li>
        </ul>
