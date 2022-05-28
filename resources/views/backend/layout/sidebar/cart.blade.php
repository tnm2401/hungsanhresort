<ul {{ Hideshow::find(3)->hide_show == 1 ? '' : 'hidden' }} class="sidebar-menu">
    <li class="{{ Request::routeIs('backend.cart.*') ? 'menu-open active' : '' }}">
        <a href="{{ route('backend.cart.index') }}"><i class="fa-solid fa-cart-shopping-fast"></i>
            <span>&nbsp;{{ __('Hóa đơn') }}<span class="label label-cus label-danger label-success-cus">
                    @if (Order::count() > 0)
                    {{ Order::where('status', 1)->count() }} @else<span>0</span>
                    @endif
            </span></span>
        </a>
    </li>
</ul>
