@extends('frontend.layout.master')
@section('content')

    <div class="banner_share list-tours banner-service" id="guest">
        <img src="{{ asset('storage') }}/uploads/newcatone/{{ $cate->img }}" alt="{{ $cate->translations->name }}">
        <div class="container">
            <div class="title">
                <h2>{{ $cate->translations->name }}</h2>
            </div>
        </div>
    </div>
    <main>

        <div class="list_posts">
            <div class="container">
                <div class="row">
                    <div class="col col-12 col-md-12">
                        <div class="row">
                            @forelse ($post as $p)
                            <div class=" col-sm-6 col-md-6 col-lg-4">
                                <a href="{{ route('frontend.slug',$p->translations->slug ?? '404') }}">
                                    <div class="postCard">
                                        <div class="postCard__img">
                                            <img src="{{ imageUrl('/storage/uploads/post/'.$p->img,'370','280','100','1') }}"alt="{{ $p->translations->name ?? '404' }}">

                                        </div>
                                        <div class="postCard__body">
                                            <div class="date-time">
                                                <span>      {{ \Carbon\Carbon::parse($p->created_at)->toFormattedDateString() }}
                                                </span>
                                            </div>
                                            <h4>{{ $p->translations->name ?? '404' }} </h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @empty
                            <p style="color: white"><i>{{ __('Không có bài viết nào') }}</i></p>
                            @endforelse

                        </div>
                    </div>
                    <div class="col col-12 col-md-3">
                        {!! $post->links("pagination::bootstrap-4") !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
