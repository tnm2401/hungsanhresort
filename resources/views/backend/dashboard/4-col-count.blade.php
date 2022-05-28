<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <a href="{{ route('backend.procatone.index') }}" title="Quản lý dịch vụ" style="color: #FFFFFF">
                    <h3>{{ Procatone::count() }}</h3>
                    <p>{{ __('LOẠI PHÒNG') }}</p>
            </div>
            <div class="icon">
                <i class="fa-duotone fa-cubes"></i>
            </div>
            <a href="{{ route('backend.servi.index') }}" class="small-box-footer">{{ __('dashboard.detail') }} <i
                    class="fa fa-arrow-circle-right"></i></a></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <a href="{{ route('backend.product.index') }}" title="Quản lý sản phẩm" style="color: #FFFFFF">
                    <h3>{{ Product::count() }}</h3>
                    <p>{{ __('PHÒNG') }}</p>
            </div>
            <div class="icon">
                <i class="fa-duotone fa-box"></i>
            </div>
            <a href="" class="small-box-footer">{{ __('dashboard.detail') }} <i
                    class="fa fa-arrow-circle-right"></i></a></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <a href="{{ route('backend.post.index') }}" title="Quản lý tin tức" style="color: #FFFFFF">
                    <h3>{{ Post::count() }}</h3>
                    <p>{{ __('BÀI VIẾT') }}</p>
            </div>
            <div class="icon">
                <i class="fa-duotone fa-newspaper"></i>
            </div>
            <a href="{{ route('backend.post.index') }}" class="small-box-footer">{{ __('dashboard.detail') }} <i
                    class="fa fa-arrow-circle-right"></i></a></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <a href="{{ route('backend.cart.index') }}" title="Quản lý hóa đơn"
                    style="color: #FFFFFF">
                    <h3>{{ Order::count() }}<sup style="font-size: 20px"></sup></h3>
                    <p>{{ __('HÓA ĐƠN') }}</p>
            </div>
            <div class="icon">
                <i class="fa-duotone fa-file-invoice"></i>
            </div>
            <a href="{{ route('backend.cart.index') }}" class="small-box-footer">{{ __('dashboard.detail') }} <i
                    class="fa fa-arrow-circle-right"></i></a></a>
        </div>
    </div>
</div>
