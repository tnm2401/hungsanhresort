@extends('frontend.layout.master')
@section('title')
    {{ $post->translations->name }}
@endsection
@section('content')
    <main>


        <div class="banner_share list-tours banner-service" id="guest">

            <img src="{{ asset('storage') }}/uploads/newcatone/{{ $post->newcatone->img }}" alt="">
            <div class="container">
                <div class="title">
                    <h2>{{ $post->newcatone->translations->name }}</h2>
                </div>
            </div>
        </div>
        <div class="list_posts">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10">
                        <div class="post-left">
                            <div class="box__img">
                                <img src="{{ asset('storage') }}/uploads/post/{{ $post->img }}" alt="">
                            </div>
                            <div class="box__content">
                                <h2 class="title-post">
                                    {{ $post->translations->name }}
                                </h2>
                                <ul class="detail-user border-tb">
                                    <li>
                                        <i class="fa fa-user" aria-hidden="true"></i> Administrator
                                    </li>
                                    <li>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>       {{ \Carbon\Carbon::parse($post->created_at)->format('l jS \\of F Y ') }}

                                    </li>

                                </ul>
                                <div class="list-text">
                                    {!! $post->translations->content !!}
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <section>
            <div class="feeback">
                <div class="section-header">
                    <div class="container">
                        <h2 class="title">
                            <span>{{ __('Bài viết cùng chủ đề') }}</span>
                        </h2>
                        <p></p>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="owl-quotes owl-carousel owl-theme owl-loaded owl-drag" >
                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(-1800px, 0px, 0px); transition: all 0.25s ease 0s; width: 6080px; padding-left: 40px; padding-right: 40px;">
                                        @foreach ($relatedpost as $r)
                                        <div style="width: 290px; margin-right: 10px;"
                                        class="owl-item shot-thumbnail js-thumbnail shot-thumbnail-container ">
                                        <div class=" shot-thumbnail-base   ">
                                            <a
                                            href="{{ route('frontend.slug',$r->translations->slug ?? '404') }}"  title="{{ $r->translations->name ?? 'noname' }}">
                                            <img src="{{ asset('storage') }}/uploads/post/{{ $r->img ?? 'noimg'}}" alt="{{ $r->translations->name  ?? 'noname'}} ">
                                        </a>
                                            <div class="shot-thumbnail-overlay">
                                                <div style="text-align: center" class="shot-thumbnail-overlay-content">
                                                    <div class="shot-title">{{ $r->translations->name ?? 'noname' }}</div>
                                                </div>
                                            </div>
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
        </section>
    </main>
@endsection
