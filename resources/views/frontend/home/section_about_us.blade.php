<section class="section-home sRp">
    <div class="about-us">
        <div class="about__bg"><img src="{{ imageUrl('/storage/uploads/pages/'.$data['about-us']->img,'700','250','100','1') }}
            " alt=""
                loading="lazy"></div>
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-6 d-flex">
                    <div class="about__img"><img src="{{ imageUrl('/storage/uploads/pages/'.$data['about-us']->img,'585','376','100','1') }}"
                            alt="" loading="lazy"></div>
                </div>
                <div class="col-lg-6 d-flex">
                    <div class="about__detail text-center">
                        <h2 style="font-size: 35px">{{ __("Vài nét về") }}
                            <br>
                            {{ __('HÙNG SÁNH RESORT') }}
                        </h2>
                        <div class="about__text">{!! $data['about-us']->translations->descriptions !!}</div><a
                            class="btn about_btn btn-action" href="{{ route('frontend.slug',$data['about-us']->translations->slug) }}"><span>{{ __("Giới thiệu") }}</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
