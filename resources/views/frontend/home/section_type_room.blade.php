<section class="section-home p-5">
    {{-- bg-cate-ss --}}
    <div class="container">
        <div class="title-vector">
            <h2>{{ __('DANH MỤC PHÒNG') }}</h2>
        </div>
        <div class="room-list">
            @foreach ( $data['type_room'] as $item)
            <div class="room__item">
                <div class="row no-gutters">
                    <div class="col-lg-6 d-flex">
                        <div class="room__img">
                            <div class="img-front"><img src="{{ imageUrl('/storage/uploads/cateroom/'.$item->img,'505','353','100','1') }}
                                " alt="{{ $item->translations->name }}" loading="lazy">
                            </div>

                            <div class="img-back">
                                @if($item->images->count() > 0)
                                <img src="{{ imageUrl('/storage/uploads/cateroom/'.  $item->images['1']->imgs,'505','353','100','1')}}
                                " alt="" loading="lazy">
                                @else
                                <img src="{{ imageUrl('/storage/uploads/cateroom/'.$item->img,'505','353','100','1') }}
                                " alt="{{ $item->translations->name }}" loading="lazy">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex">
                        <div class="room__detail text-center" style="background-image: {{ asset('frontend/assets/img/bgcate.png') }}">
                            <a href="{{ route('frontend.slug',$item->translations->slug) }}">
                                <h3 class="room__title title-vector">{{ $item->translations->name }}</h3>
                            </a>
                            <div class="room__text mb-1">
                                <div style="text-align:justify">{!! $item->translations->content !!}</div>
                            </div>
                            <div class="room__rate mb-1"><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i></div><a class="btn btn-action"
                                href="{{ route('frontend.slug',$item->translations->slug) }}"><span>{{ __('Xem thêm') }}</span></a>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
    </div>
</section>
