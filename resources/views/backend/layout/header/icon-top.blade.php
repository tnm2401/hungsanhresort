@if ($setting->maintain == 0)
@if (hasRole('maintain_down'))
<li class="dropdown user user-menu">
    <a title="Click để bảo trì website" href="#" data-toggle="modal"
        data-target="#popup_maintain">
        <i style="color:rgb(82, 231, 36)" class="fa-duotone fa-signal-bars"></i>
        <span style="color:rgb(82, 231, 36)" class="hidden-xs">Đang hoạt
            động</span></a>
</li>
@endif
@else
@if (hasRole('maintain_up'))
<li class="dropdown user user-menu">

    <a  data-toggle="modal"
    data-target="#popup_offmaintain"  class="active-confirm" href="#" data-toggle="modal"
    data-target="#popup_offmaintain">
        <i style="color:rgb(231, 36, 36)" class="fa-duotone fa-signal-bars-slash"></i>
        <span style="color:rgb(231, 36, 36)" class="hidden-xs">Đang bảo trì</span></a>
</li>
@endif
@endif
<li class="dropdown user user-menu">
    <a data-toggle="tooltip"
    data-placement="left" title="Tối ưu cache"  href="{{ route('clear-cache') }}">
        <i  style="color: rgb(240, 240, 59)" class="fa-duotone fa-server"></i>
    </a>
</li>

<li class="dropdown user user-menu">
    <a data-toggle="tooltip"
    data-placement="left" title="Xem website"  href="{{ route('frontend.home.index') }}" target="_blank">
        <i style="color:#3c8dbc" class="fa-duotone fa-globe"></i>

    </a>
</li>
<li class="dropdown user user-menu">
    <a data-toggle="tooltip"
    data-placement="left" title="Xem sitemap.xml"  href="{{ route('frontend.sitemap.index') }}" target="_blank">
        <i style="color :#ff7900" class="fa-duotone fa-sitemap"></i>

    </a>
</li>
<li class="dropdown user user-menu">
    <a data-toggle="tooltip"
    data-placement="left" title="Đăng xuất"  href="{{ route('logout') }}">
        <i style="color:rgb(231, 36, 36)" class="fa-duotone fa-power-off"></i>
    </a>
</li>


<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="{{ asset('storage') }}/uploads/{{ auth()->user()->img }}" class="user-image"
            alt="User Image">
        <span class="hidden-xs">{{ auth()->user()->name }}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="user-header">
            <img src="{{ asset('storage') }}/uploads/{{ auth()->user()->img }}"
                class="img-circle" alt="User Image">
            <p>
                {{ auth()->user()->name }}
                <small>Thành viên từ {{ date('d/m/Y', strtotime(auth()->user()->created_at)) }}</small>
            </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="/administrator/users/{{ auth()->user()->id }}/editinfo"
                    class="btn btn-default btn-flat">Sửa thông tin</a>
            </div>
            <div class="pull-right">
                <a href="/administrator/users/{{ auth()->user()->id }}/editpassword"
                    class="btn btn-default btn-flat">Đổi mật khẩu</a>
            </div>
        </li>
    </ul>
</li>
{{-- <li class="dropdown">
    <a href="javascript:;" class="dropdown-toggle dropdown-header-name off"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <span><i style="margin-right:2px"
                class="{{ Language::where('locale', session('locale'))->first()->flag }}"></i>
        </span>
        <i class="fa fa-angle-down"></i>
    </a>
    <ul id="chooselang" class="dropdown-menu dropdown-menu-right icons-right off "
        data-bs-popper="none">
        @foreach ($language as $l)
            <li class="{{ $l->locale == session('locale') ? 'active' : '' }}"><a
                    style="color:black" href="{{ route('frontend.locale', $l->locale) }}">
                    <i class="{{ $l->flag }}"></i> {{ $l->name }}</a></li>
        @endforeach
    </ul>
</li> --}}
