@extends('frontend.layout.master')
@section('content')

    <div class="banner_share list-tours banner-service" id="guest">
        <img src="{{ asset('storage') }}/uploads/pages/{{ $page->img }}" alt="{{ $page->translations->name }}">
        <div class="container">
            <div class="title">
                <h2>{{ $page->translations->name }}</h2>
            </div>
        </div>
    </div>
    <main>
        <div class="list_posts">
            <div class="container">
                <div class="row">
                    <div class="col col-12 col-md-12">
                        <div class="row">
                            @forelse ($service as $p)
                            <div class="col col-xs-6 col-6 col-md-4 col-lg-4">
                                <a href="{{ route('frontend.slug',$p->translations->slug ?? '404') }}">
                                    <div class="postCard">
                                        <div class="postCard__img">
                                            <img src="{{ imageUrl('/storage/uploads/svcategory/'.$p->img,'370','250','100','1') }}"
                                                alt="{{ $p->translations->name ?? '404' }}">
                                        </div>
                                        <div class="postCard__body">

                                            <h4>{{ $p->translations->name ?? '404' }} </h4>

                                        </div>
                                    </div>
                                </a>
                            </div>
                            @empty
                            <p style="color: white"><i>Không có bài viết nào</i></p>
                            @endforelse

                        </div>
                    </div>
                    <div class="col col-12 col-md-3">
                        {!! $service->links("pagination::bootstrap-4") !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
