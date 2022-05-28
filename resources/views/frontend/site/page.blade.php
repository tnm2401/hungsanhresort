@extends('frontend.layout.master')
@section('content')
    <style>
        .map {
            width: 100%;
            min-height: 80vh;
            /* max-width: 80vw;
            max-height: 80vh; */
            /* background: url('img/z3321344054144_12b422c608303875ba1a978c136753a7.jpg'); */
            background: url("{{ asset('frontend/assets/img') }}/bg.jpg");
            background-size: 100% 100%;
            position: relative;
        }

        .map i {
            font-size: 15pt;
            animation: gelatine 1s infinite;
            cursor: pointer;
        }

        @keyframes gelatine {

            from,
            to {
                transform: scale(1, 1);
            }

            25% {
                transform: scale(0.9, 1.1);
            }

            50% {
                transform: scale(1.1, 0.9);
            }

            75% {
                transform: scale(0.95, 1.05);
            }
        }

        .type-a {
            position: absolute;
            width: 14%;
            height: 52%;
            right: 13%;
            top: 4%;
        }

        .type-a .room-a {
            background-color: #ffffffcf;
            position: relative;
            width: 100%;
            height: 100%;
        }

        .type-a .room-a1 {
            position: absolute;
            bottom: -0%;
            left: 30%;
        }

        .type-a .room-a2 {
            position: absolute;
            bottom: 23%;
            left: 30%;
        }

        .type-a .room-a3 {
            position: absolute;
            bottom: 46%;
            left: 30%;
        }

        .type-a .room-a4 {
            position: absolute;
            bottom: 69%;
            left: 30%;
        }

        .type-a .room-a5 {
            position: absolute;
            bottom: 92%;
            left: 30%;
        }

        .type-b {
            position: absolute;
            width: 14%;
            height: 52%;
            right: 30%;
            top: 12%;
        }

        .type-b .room-b {
            background-color: #ffffffcf;
            position: relative;
            width: 100%;
            height: 100%;
        }

        .type-b .room-b1 {
            position: absolute;
            bottom: 1%;
            left: 28%;
        }

        .type-b .room-b2 {
            position: absolute;
            bottom: 2%;
            left: 74%;
        }

        .type-b .room-b3 {
            position: absolute;
            bottom: 91%;
            left: 20%;
        }

        .type-b .room-b4 {
            position: absolute;
            bottom: 91%;
            left: 71%;
        }

        .type-b .room-b5 {
            position: absolute;
            bottom: 23%;
            left: 49%;
        }

        .type-c {
            position: absolute;
            width: 12%;
            height: 50%;
            left: 40%;
            top: 18%;
        }

        .type-c .room-c {
            background-color: #ffffffcf;
            position: relative;
            width: 100%;
            height: 100%;
        }

        .type-c .room-c1 {
            position: absolute;
            bottom: 0%;
            right: 8%;
        }

        .type-c .room-c2 {
            position: absolute;
            bottom: 0%;
            left: 7%;
        }

        .type-c .room-c3 {
            position: absolute;
            bottom: 29%;
            right: 8%;
        }

        .type-c .room-c4 {
            position: absolute;
            bottom: 29%;
            left: 7%;
        }

        .type-c .room-c5 {
            position: absolute;
            top: 29%;
            right: 8%;
        }

        .type-c .room-c6 {
            position: absolute;
            top: 29%;
            left: 7%;
        }

        .type-c .room-c7 {
            position: absolute;
            top: 0%;
            right: 8%;
        }

        .type-c .room-c8 {
            position: absolute;
            top: 0%;
            left: 7%;
        }

        .type-d {
            position: absolute;
            width: 24%;
            height: 6%;
            left: 2%;
            top: 41%;
        }

        .type-d .room-d {
            background-color: #ffffffcf;
            position: relative;
            width: 100%;
            height: 100%;
        }

        .type-d .room-d1 {
            position: absolute;
            bottom: 0%;
            right: 4%;
        }

        .type-d .room-d2 {
            position: absolute;
            bottom: 2%;
            left: 69%;
        }

        .type-d .room-d3 {
            position: absolute;
            bottom: 0%;
            left: 48%;
        }

        .type-d .room-d4 {
            position: absolute;
            bottom: 0;
            left: 26%;
        }

        .type-d .room-d5 {
            position: absolute;
            bottom: 0;
            left: 3%;
        }

    </style>
    <main>

        <div class="banner_share">
            <img src="{{ asset('frontend') }}/assets/img/Classic (1).jpg" alt="">
            <div class="container">
                <div class="title">
                    <h2>{{ $page->translations->name }}</h2>

                </div>
            </div>
        </div>
        <div class="box__img">
            <div class="container">
                <div class="map">
                    <div class="type-a">
                        <div class="room-a">
                            <div class="room-a1"><i class="fa-solid fa-house-heart"></i></div>
                            <div class="room-a2"><i class="fa-solid fa-house-heart"></i></div>
                            <div class="room-a3"><i class="fa-solid fa-house-heart"></i></div>
                            <div class="room-a4"><i class="fa-solid fa-family"></i></div>
                            <div class="room-a5"><i class="fa-solid fa-house-heart"></i></div>
                        </div>
                    </div>
                    <div class="type-b">
                        <div class="room-b">
                            <div class="room-b1">B1</div>
                            <div class="room-b2">B2</div>
                            <div class="room-b3">B3</div>
                            <div class="room-b4">B4</div>
                        </div>
                    </div>
                    <div class="type-c">
                        <div class="room-c">
                            <div class="room-c1">C1</div>
                            <div class="room-c2">C2</div>
                            <div class="room-c3">C3</div>
                            <div class="room-c4">C4</div>
                            <div class="room-c5">C5</div>
                            <div class="room-c6">C6</div>
                            <div class="room-c7">C7</div>
                            <div class="room-c8">C8</div>
                        </div>
                    </div>
                    <div class="type-d">
                        <div class="room-d">
                            <div class="room-d1">D1</div>
                            <div class="room-d2">D2</div>
                            <div class="room-d3">D3</div>
                            <div class="room-d4">D4</div>
                            <div class="room-d5">D5</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="cards-about details-rooms">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="content">
                           {!! $page->translations->content !!}
                        </div>
                    </div>
                    <div class="detail-text">
                        <div class="col-md-4">

                        </div>

                    </div>

                </div>


            </div>

        </section>


        <section>
            <div class="feeback">
                <div class="section-header">
                    <div class="container">
                        <i> Share your moment with us! </i>
                        <h2 class="title">
                            #EAGLEHOTEL
                            <a href="https://eaglehotel.webhotel.vn/dinning-experience"
                                class="btn btn-sm btn-clean-dark">Explore more</a>
                        </h2>
                        <p>
                            <i class="fab fa-instagram"></i>&nbsp; Discover Eagle Hotel through the eyes of our guests.
                            Share your experience
                            with #EAGLEHOTEL
                            <br> and mention @EAGLEHOTEL for chance to be featured.
                        </p>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="owl-quotes owl-carousel owl-theme owl-loaded owl-drag" id="gallery">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(-1800px, 0px, 0px); transition: all 0.25s ease 0s; width: 6080px; padding-left: 40px; padding-right: 40px;">
                                        <div class="owl-item cloned" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/IMG_1260.PNG" data-caption="5"
                                                data-fancybox="mygallery" title="5">
                                                <img src="{{ asset('frontend') }}/assets/img/IMG_1260.PNG" alt="5">
                                            </a></div>
                                        <div class="owl-item cloned" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/Diamond-Bar-Day-Light-2.jpg"
                                                data-caption="7" data-fancybox="mygallery" title="7">
                                                <img src="{{ asset('frontend') }}/assets/img/Diamond-Bar-Day-Light-2.jpg"
                                                    alt="7">
                                            </a></div>
                                        <div class="owl-item cloned" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/IMG_1246.PNG" data-caption="8"
                                                data-fancybox="mygallery" title="8">
                                                <img src="{{ asset('frontend') }}/assets/img/IMG_1246.PNG" alt="8">
                                            </a></div>
                                        <div class="owl-item cloned" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/IMG_0443.JPG" data-caption="9"
                                                data-fancybox="mygallery" title="9">
                                                <img src="{{ asset('frontend') }}/assets/img/IMG_0443.JPG" alt="9">
                                            </a></div>
                                        <div class="owl-item cloned" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/IMG_1253.PNG" data-caption="10"
                                                data-fancybox="mygallery" title="10">
                                                <img src="{{ asset('frontend') }}/assets/img/IMG_1253.PNG" alt="10">
                                            </a></div>
                                        <div class="owl-item" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/IMG_1254.PNG" data-caption="1"
                                                data-fancybox="mygallery" title="1">
                                                <img src="{{ asset('frontend') }}/assets/img/IMG_1254.PNG" alt="1">
                                            </a></div>
                                        <div class="owl-item active" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/IMG_1250.PNG" data-caption="2"
                                                data-fancybox="mygallery" title="2">
                                                <img src="{{ asset('frontend') }}/assets/img/IMG_1250.PNG" alt="2">
                                            </a></div>
                                        <div class="owl-item active" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/IMG_1261.PNG" data-caption="3"
                                                data-fancybox="mygallery" title="3">
                                                <img src="{{ asset('frontend') }}/assets/img/IMG_1261.PNG" alt="3">
                                            </a></div>
                                        <div class="owl-item active" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/IMG_1252.PNG" data-caption="6"
                                                data-fancybox="mygallery" title="6">
                                                <img src="{{ asset('frontend') }}/assets/img/IMG_1252.PNG" alt="6">
                                            </a></div>
                                        <div class="owl-item active" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/F44734F0-B62A-4CC8-8454-0F51672B0BC9.jpg"
                                                data-caption="4" data-fancybox="mygallery" title="4">
                                                <img src="{{ asset('frontend') }}/assets/img/F44734F0-B62A-4CC8-8454-0F51672B0BC9.jpg"
                                                    alt="4">
                                            </a></div>
                                        <div class="owl-item" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/IMG_1260.PNG" data-caption="5"
                                                data-fancybox="mygallery" title="5">
                                                <img src="{{ asset('frontend') }}/assets/img/IMG_1260.PNG" alt="5">
                                            </a></div>
                                        <div class="owl-item" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/Diamond-Bar-Day-Light-2.jpg"
                                                data-caption="7" data-fancybox="mygallery" title="7">
                                                <img src="{{ asset('frontend') }}/assets/img/Diamond-Bar-Day-Light-2.jpg"
                                                    alt="7">
                                            </a></div>
                                        <div class="owl-item" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/IMG_1246.PNG" data-caption="8"
                                                data-fancybox="mygallery" title="8">
                                                <img src="{{ asset('frontend') }}/assets/img/IMG_1246.PNG" alt="8">
                                            </a></div>
                                        <div class="owl-item" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/IMG_0443.JPG" data-caption="9"
                                                data-fancybox="mygallery" title="9">
                                                <img src="{{ asset('frontend') }}/assets/img/IMG_0443.JPG" alt="9">
                                            </a></div>
                                        <div class="owl-item" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/IMG_1253.PNG" data-caption="10"
                                                data-fancybox="mygallery" title="10">
                                                <img src="{{ asset('frontend') }}/assets/img/IMG_1253.PNG" alt="10">
                                            </a></div>
                                        <div class="owl-item cloned" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/IMG_1254.PNG" data-caption="1"
                                                data-fancybox="mygallery" title="1">
                                                <img src="{{ asset('frontend') }}/assets/img/IMG_1254.PNG" alt="1">
                                            </a></div>
                                        <div class="owl-item cloned" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/IMG_1250.PNG" data-caption="2"
                                                data-fancybox="mygallery" title="2">
                                                <img src="{{ asset('frontend') }}/assets/img/IMG_1250.PNG" alt="2">
                                            </a></div>
                                        <div class="owl-item cloned" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/IMG_1261.PNG" data-caption="3"
                                                data-fancybox="mygallery" title="3">
                                                <img src="{{ asset('frontend') }}/assets/img/IMG_1261.PNG" alt="3">
                                            </a></div>
                                        <div class="owl-item cloned" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/IMG_1252.PNG" data-caption="6"
                                                data-fancybox="mygallery" title="6">
                                                <img src="{{ asset('frontend') }}/assets/img/IMG_1252.PNG" alt="6">
                                            </a></div>
                                        <div class="owl-item cloned" style="width: 290px; margin-right: 10px;"><a
                                                href="{{ asset('frontend') }}/assets/img/F44734F0-B62A-4CC8-8454-0F51672B0BC9.jpg"
                                                data-caption="4" data-fancybox="mygallery" title="4">
                                                <img src="{{ asset('frontend') }}/assets/img/F44734F0-B62A-4CC8-8454-0F51672B0BC9.jpg"
                                                    alt="4">
                                            </a></div>
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
        </section>
    </main>
@endsection
