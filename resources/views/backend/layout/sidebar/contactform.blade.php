<ul {{ Hideshow::find(7)->hide_show == 1 ? '' : 'hidden' }} class="sidebar-menu">
    <li class="{{ Request::routeIs('backend.contactform.*') ? 'menu-open active' : '' }}">
        <a href="{{ route('backend.contactform.index') }}"><i class="fa fa-folder-open"></i> <span>{{ __('Thư liên hệ') }}<span class="label label-cus label-success label-success-cus">
                    {{ Contactform::where('read', 0)->count() }}</span>
        </a>
    </li>
</ul>
