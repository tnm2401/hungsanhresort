<section class="new section__events">
    <div class="section-header">
        <div class="container">

        </div>
    </div>
    <div class="container-fluid">

        <div class="row aos-init" data-aos="fade-left">
            <div class="col-lg-3 col-lg-push-9">
                <div class="news__title">
                    <div>{{ __('Tin tức') }}</div>
                </div>
            </div>
            @foreach ($data['feature_posts'] as $k => $p)
            @if($k < 3)
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-lg-pull-3">
                <div class="events__item">
                    <div class="events-item__img">
                        <img src="{{ imageUrl('/storage/uploads/post/'.$p->img,'330','250','100','1') }}" class="img-responsive"
                            alt="​{{ $p->translations->name ?? '' }}">
                    </div>
                    <div class="events-item__body">
                        <div class="events-item__header">
                            <div class="events-item__date">
                                <p class="item_date__nbr"> {{ \Carbon\Carbon::parse($p->created_at)->format('d') }}</p>
                                <p class="item_date__mounth">Tháng {{ \Carbon\Carbon::parse($p->created_at)->format('m') }}</p>
                            </div>
                            <div class="events-item__content">
                                <div class="events-item__title">
                                    <h3>​{{ $p->translations->name ?? 'Noname' }}</h3>
                                </div>

                            </div>
                        </div>
                        <div class="events-item__text">
                            {{ $p->translations->descriptions ?? 'No descriptions' }}
                        </div>
                        <div class="events-item__link">
                            <a href="{{ route('frontend.slug',$p->translations->slug ?? '404') }}">{{ __('Xem thêm') }} ➔</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach

        </div>

        <div class="row aos-init" data-aos="fade-right">
            <div class="col-lg-3">
                <div class="events__title">
                    <div>{{ __('Sự kiện') }}</div>
                </div>
            </div>
            @foreach ($data['feature_posts'] as $k => $p)
            @if($k >= 3)
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="events__item">
                    <div class="events-item__img">
                        <img src="{{ imageUrl('/storage/uploads/post/'.$p->img,'330','250','100','1') }}" class="img-responsive"
                            alt="​{{ $p->translations->name ?? '' }}">
                    </div>
                    <div class="events-item__body">
                        <div class="events-item__header">
                            <div class="events-item__date">
                                <p class="item_date__nbr"> {{ \Carbon\Carbon::parse($p->created_at)->format('d') }}</p>
                                <p class="item_date__mounth">Tháng {{ \Carbon\Carbon::parse($p->created_at)->format('m') }}</p>
                            </div>
                            <div class="events-item__content">
                                <div class="events-item__title">
                                    <h3>​{{ $p->translations->name ?? 'Noname' }}</h3>
                                </div>

                            </div>
                        </div>
                        <div class="events-item__text">
                            {{ $p->translations->descriptions ?? 'No descriptions' }}
                        </div>
                        <div class="events-item__link">
                            <a href="{{ route('frontend.slug',$p->translations->slug ?? '404') }}">{{ __('Xem thêm') }} ➔</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>

    </div>
</section>
