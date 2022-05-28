@extends('frontend.layout.master')
@section('title')
    {{ $service->translations->name }}
@endsection
@section('content')
    <main>


        <div class="banner_share list-tours banner-service" id="guest">

            <img src="{{ asset('storage') }}/uploads/svcategory/{{ $service->img }}" alt="{{ $service->translations->name }}">
            <div class="container">
                <div class="title">
                    <h2>{{ $service->translations->name }}</h2>
                </div>
            </div>
        </div>
        <div class="list_posts">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10">
                        <div class="post-left">
                            <div class="box__img">
                                <img src="{{ asset('storage') }}/uploads/svcategory/{{ $service->img }}" alt="{{ $service->translations->name }}">
                            </div>
                            <div class="box__content">
                                
                            
                                <div class="list-text">
                                    {!! $service->translations->content !!}
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
 
    </main>
@endsection
