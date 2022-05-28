@extends('frontend.layout.master')
@section('title')
    {{ __('Đặt phòng') }}
@endsection
@section('content')
    <main>
        <div class="banner_share">
            <img src="{{ asset('frontend') }}/assets/img/Classic (1).jpg" alt="">
            <div class="container">
                <div class="title">

                    <h2>DANH SÁCH PHÒNG TRỐNG</h2>
                    <h4>( Từ {{
                        date("d-m-Y", strtotime(session('checking')['from_date']))}} tới {{
                                   date("d-m-Y", strtotime(session('checking')['to_date']))}} )</h4>
                </div>
            </div>
        </div>
        <div class="banner-detail-rooms">
            <div class="container">
                <img src="{{ asset('frontend/assets/img/bg.jpg') }}" alt="">
            </div>

        </div>
        <div style="margin-top:30px" class="container">
            <div class="row">
                @forelse ($room ?? session('room')  as $r)
                    <div class=" col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class=" wrap-room-pages-contents">
                            <div class="room-pages-image">
                                <div class="square">
                                    <img src="{{ imageUrl('/storage/uploads/' . $r->code . '/' . $r->img, '540', '405', '100', '1') }}"
                                        alt="Hình phòng" loading="lazy" style="background-image: none;">
                                    <div class="cover">
                                        {{ __('Diện tích') }} : {{ $r->cover }} m<sup>2</sup>
                                    </div>
                                </div>

                                <div class="room-pages-home__link" style="text-align: center;margin-top:10px">
                                    {{-- <button class="book-room-now">
                                        <a href="#" onclick="return false;" data-toggle="modal" data-target="#exampleModal">
                                            {{ __('Đặt ngay') }}</a>
                                    </button> --}}
                                    <button class="book-room-now">
                                        <a href="{{ route('order.now', $r->id) }}">{{ __('Đặt phòng') }}</a>
                                    </button>


                                    {{-- @if (session('checking')['room'] == 2)
                                        <button class="book-room-now">
                                            <a href="{{ route('order.add', $r->id) }}">{{ __('Thêm giỏ hàng') }}</a>
                                        </button>
                                    @endif --}}

                                </div>
                            </div>
                            <div class="room-pages-contents" style="text-align: center">
                                <div class="room-pages-contents__desc">
                                    <span>{{ $r->procatone->translations->name }} -
                                        {{ $r->code }}</span>
                                    <div>
                                        @if ($r->procatone->discount >= 0)
                                            <i><s>{{ number_format($r->procatone->price) }} đ</s> </i>
                                        @endif
                                    </div>
                                </div>
                                <div class="room-pages-contents__title">
                                    <h3>
                                        @if ($r->procatone->discount >= 0)
                                            <span style="color: red">{{ number_format($r->procatone->selling_price) }}
                                                đ / Đêm</span>
                                        @else
                                            <span>{{ number_format($r->price) }} đ /
                                                Đêm</span>
                                        @endif
                                    </h3>
                                </div>
                                <div class="room-pages-contents__desc">
                                    <p>{{ $r->person }} {{ __('Người') }} - {{ $r->bed }}
                                        {{ __('Giường') }}</p>
                                </div>
                                <div class="room__rate ">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>

                        </div>
                    </div>

                @empty
                    <p>Không còn phòng trống
                    </p>
                @endforelse
            </div>

        </div>

    </main>
@endsection

@push('style')
    <style>
        .cover {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 50%;
            height: auto;
            text-align: center;
            padding: 10px;
            background-color: rgb(210, 198, 198);
        }

        .square {
            position: relative;
        }

        @media screen and (max-width: 768px) {
            .cover {
                position: absolute;
                bottom: 0;
                right: 0;
                width: 100%;
                height: auto;
                text-align: center;
                padding: 5%;
                background-color: rgb(210, 198, 198);
            }
        }


        ul {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .nav {
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }

        .nav>li {
            position: relative;
            display: block;
        }

        .nav>li>a {
            position: relative;
            display: block;
            padding: 10px 15px;
        }

        .nav>li>a:focus,
        .nav>li>a:hover {
            text-decoration: none;
            background-color: #eee;
        }

        .nav-pills>li {
            float: left;
        }

        .nav-pills>li>a {
            border-radius: 4px;
        }

        .nav-pills>li+li {
            margin-left: 2px;
        }

        .nav-pills>li.active>a,
        .nav-pills>li.active>a:focus,
        .nav-pills>li.active>a:hover {
            color: #fff;
            background-color: #337ab7;
        }

        .nav:after,
        .nav:before {
            display: table;
            content: " ";
        }

        .nav:after {
            clear: both;
        }



        .fade {
            opacity: 0;
            -webkit-transition: opacity .15s linear;
            -o-transition: opacity .15s linear;
            transition: opacity .15s linear;
        }

        .fade.in {
            opacity: 1;
        }

        .tab-content>.tab-pane {
            display: none;
        }

        .tab-content>.active {
            display: block;
        }

    </style>
@endpush
@push('script')
    <script>
        let postBody = event.target.parentNode.parentNode.childNodes[1].textContent;

    </script>
@endpush
