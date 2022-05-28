@extends('frontend.layout.master')
@section('content')
    <main>

        <div class="banner_share">
            <img width="100%" height="500px" src="{{ asset('storage') }}/uploads/pages/{{ $page->img }}" alt="">
            <div class="container">
                <div class="title">
                    <h2>{{ $page->translations->name }}</h2>

                </div>
            </div>
        </div>

        <section>
            <div class="list_posts mb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col col-12 col-md-10">
                            <div class="post-left">
                                <div class="box__img">
                                    <img width="100%" height="500px" src="{{ asset('storage') }}/uploads/pages/{{ $page->img }}" alt="">
                                </div>
                                <div class="box__content">
                                    {!! $page->translations->content !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- <div class="feeback">
                <div class="section-header">
                    <div class="container">
                        <i> {{ __('Chia sẽ khoảnh khắc với chúng tôi') }} </i>
                        <h2 class="title">
                            #THANHHOTEL
                            <a href="#" class="btn btn-sm btn-clean-dark">{{ __('Xem thêm') }}</a>
                        </h2>

                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="owl-quotes owl-carousel owl-theme owl-loaded owl-drag" id="gallery">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(-1800px, 0px, 0px); transition: all 0.25s ease 0s; width: 6080px; padding-left: 40px; padding-right: 40px;">
                                        @foreach ($gallery as $k => $g)
                                            <div class="owl-item " style="width: 290px; margin-right: 10px;"><a
                                                    href="{{ imageUrl('/storage/uploads/gallery/' . $g->imgs, '500', '450', '100', '1') }}"
                                                    data-caption="{{ $k + 1 }}" data-fancybox="mygallery" title="5">
                                                    <img src="{{ imageUrl('/storage/uploads/gallery/' . $g->imgs, '265', '250', '100', '1') }}"
                                                        alt="{{ $k + 1 }}">
                                                </a></div>
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
            </div> --}}
        </section>
    </main>
@endsection
