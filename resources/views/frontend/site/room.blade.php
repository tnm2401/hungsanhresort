@extends('frontend.layout.master')
@section('content')
    <style>
        .form-control {
            font-size: 2rem !important;
        }

    </style>
    <main>

        <div class="banner_share">
            <img src="{{ asset('frontend') }}/assets/img/Classic (1).jpg" alt="">
            <div class="container">
                <div class="title">
                    <h2>{{ $room->procatone->translations->name }} - {{ $room->code }}</h2>

                </div>
            </div>
        </div>
        <div class="banner-detail-rooms">
            <div class="container">
                <div class="banner">
                    <div class="owl-carousel owl-theme owl-loaded owl-drag" id="sliderBanner">
                        <div class="owl-stage-outer">
                            <div class="owl-stage"
                                style="transform: translate3d(-7620px, 0px, 0px); transition: all 0.25s ease 0s; width: 15240px;">
                                @foreach ($room->images as $item)
                                    <div class="owl-item " style="width: 1270px;">
                                        <div class="item">
                                            <div class="banner__item">
                                                <div class="banner__img">
                                                    <img src="{{ asset('storage') }}/uploads/{{ $room->code }}/{{ $item->imgs }}"
                                                        alt="{{ $room->translations->name }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span
                                    aria-label="Previous">‹</span></button><button type="button" role="presentation"
                                class="owl-next"><span aria-label="Next">›</span></button></div>
                    </div>
                </div>
            </div>
        </div>
        <section class="cards-about details-rooms">

            <div class="container">
                <div class="row ">
                    <div class="col-md-4 mb-5">
                        <div class="content ">
                            <div class="title ">
                                <h2>{{ __('Đặt phòng') }}</h2>
                            </div>
                            <form action="{{ route('frontend.booking.index') }}" method="post">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-12">
                                        @if(session()->has('checked'))
                                        <div class="form-group">
                                            <label for="">{{ __('Tên khách hàng') }} : </label>
                                            <input type="text" class="form-control" name="name" id="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">{{ __('Số điện thoại') }} : </label>
                                            <input type="text" class="form-control" name="phone" id="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">{{ __('Email') }} : </label>
                                            <input type="text" class="form-control" name="email" id="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">{{ __('Ghi chú') }} : </label>
                                            <textarea name="note" class="form-control" cols="10" rows="3"></textarea>
                                        </div>
                                        @endif
                                        <input hidden type="text" name="room" value="{{ $room->id }}" id="">
                                        @if(session()->has('checked'))
                                        <button style="border: 0" type="submit" class="book-room-now2">
                                            {{ __('Đặt ngay') }}
                                        </button>
                                        @else
                                        <small>
                                            <i>
                                            {{__('Bạn chưa kiểm tra phòng, chọn ngày đến và đi để xem trạng thái thái phòng.')}}
                                            </i>
                                        </small>
                                        <br>
                                        <button class="book-room-now text-center mt-3">
                                            <a href="{{ route('frontend.home.index') }}">{{ __('Kiểm tra phòng') }}</a>
                                        </button>

                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8 mb-5">
                        <div class="content">
                            <div class="title text-center">
                                <h2>{{ __('Thông tin phòng  ') }} {{ $room->code }}</h2>
                            </div>
                            <div style="overflow : auto; height:400px">
                                {!! $room->translations->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- <section>
            <div class="feeback">
                <div class="section-header">
                    <div class="container">
                        <h2 class="title">
                            <span>{{ __('PHÒNG CÙNG LOẠI') }}</span>
                        </h2>
                        <p></p>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="owl-quotes owl-carousel owl-theme owl-loaded owl-drag">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(-1800px, 0px, 0px); transition: all 0.25s ease 0s; width: 6080px; padding-left: 40px; padding-right: 40px;">
                                        @foreach ($relatedroom as $i)
                                            <div class="owl-item col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="wrap-room-pages-contents">
                                                    <div class="room-pages-image">
                                                        <img src="{{ asset('storage') }}/uploads/{{ $i->code }}/{{ $i->img }}"
                                                            alt="Danh mục DEMO 1" loading="lazy"
                                                            style="background-image: none;">
                                                        <div class="room-pages-home__link"
                                                            style="text-align: center;margin-top:10px">
                                                            <button class="book-room-now">
                                                                <a
                                                                    href="{{ route('frontend.slug', $i->translations->slug) }}">Đặt
                                                                    ngay</a>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!--  -->
                                                    <div class="room-pages-contents" style="text-align: center">
                                                        <div class="room-pages-contents__desc">
                                                            <span>{{ $i->procatone->translations->name }} -
                                                                {{ $i->code }}</span>
                                                        </div>
                                                        <div class="room-pages-contents__title">
                                                            <h3>
                                                                @if ($i->procatone->discount >= 0)
                                                                    <span>{{ number_format($i->procatone->selling_price) }}
                                                                        đ / Đêm</span>
                                                                @else
                                                                    <span>{{ number_format($i->price) }} đ / Đêm</span>
                                                                @endif
                                                            </h3>
                                                        </div>
                                                        <div class="room-pages-contents__desc">
                                                            <p>{!! $i->translations->descriptions !!}</p>

                                                        </div>
                                                        <!-- star-rating -->
                                                        <div class="room__rate ">
                                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                                class="fas fa-star"></i><i class="fas fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <!--  -->
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                                <div class="owl-nav"><button type="button" role="presentation"
                                        class="owl-prev">❬</button><button type="button" role="presentation"
                                        class="owl-next">❭</button></div>
                                <div class="owl-dots disabled"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section> --}}
    </main>
@endsection
