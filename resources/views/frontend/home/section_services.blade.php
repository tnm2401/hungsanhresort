<section class="stretcher-wrapper">
    <div class="section-header">
        <div class="container">

            <div class="title-vector">
                <h2>{{ __('DỊCH VỤ') }}</h2>
            </div>
            {{-- @if (session('locale') == 'vi')
            <a  class="btn btn-sm btn-clean-dark" href="{{ route('frontend.slug', 'tat-ca-dich-vu') }}">
            @else
                <a  class="btn btn-sm btn-clean-dark" href="{{ route('frontend.slug', 'all-services') }}">
            @endif
               {{ __('Xem thêm') }}</a> --}}
        </div>
    </div>
    <ul class="stretcher aos-init" data-aos="fade-down">

        @foreach ($data['services'] as $s)
        <li class="stretcher-item"
            style="background-image:url({{ imageUrl('/storage/uploads/svcategory/'.$s->img,'400','300','100','1') }});">
            <!--logo-item-->
            <a href="{{ route('frontend.slug',$s->translations->slug) }}">
                <div class="stretcher-logo">
                    <div class="text">
                        <span class="text-intro h4"> {{ $s->translations->name }}</span>
                    </div>
                </div>
                <!--main text-->
                <figure class="">
                    <h4> {{ $s->translations->name }}</h4>
                    <figcaption>{{ $s->translations->descriptions }}</figcaption>
                </figure>
            </a>
            <!--anchor-->
            <a href="{{ '/' }}">AnchorLink</a>
        </li>
        @endforeach


        @if($data['services']->count() == 4)
        <li class="stretcher-item more">
            <div class="more-icon">
                <span data-title-show="Show more" data-title-hide="+">+</span>
                @if (session('locale') == 'vi')
                <a   href="{{ route('frontend.slug', 'tat-ca-dich-vu') }}">
                @else
                    <a   href="{{ route('frontend.slug', 'all-services') }}">
            @endif
                 {{ __('Xem thêm') }}   </a>
            </div>


        </li>
        @endif
    </ul>

</section>
