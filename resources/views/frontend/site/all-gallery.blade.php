@extends('frontend.layout.master')
@section('content')


    <div class="banner_share banner-galleries" id="guest">
        <img src="{{ asset('storage') }}/uploads/pages/{{ $page->img }}" alt="{{ $page->translations->name }}">
        <div class="container">
            <div class="title">
                <h2>{{ $page->translations->name }}</h2>

            </div>
        </div>
    </div>
    <main>
       <div class="container">
        <div class="galerries">
            @foreach ($data as $d)
            <div class="aos-init aos-animate"  data-aos="fade-in">
                <div class="text-center">
                    <h2> <a href="{{ route('frontend.slug',$d->translations->slug) }}">{{ $d->translations->name }}</a> </h2>
                </div>
                <div class="grid aos-init aos-animate" id="gallery-{{ $d->id }}" data-aos="fade-up">
                        <div class="item">
                            <a href="{{ imageUrl('/storage/uploads/gallery/'.$d->img,'780','415','100','1') }}" data-caption="1" data-fancybox="mygallery">
                                <img src="{{ imageUrl('/storage/uploads/gallery/'.$d->img,'780','415','100','1') }}">
                            </a>
                        </div>
                           @foreach ($d->images->take(5) as $i)
                            <div class="item">
                                <a href="{{ imageUrl('/storage/uploads/gallery/'.$i->imgs,'780','415','100','1') }}" data-fancybox="mygallery">
                                    <img src="{{ imageUrl('/storage/uploads/gallery/'.$i->imgs,'385','200','100','1') }}">
                                </a>
                            </div>
                            @endforeach

                </div>
            </div>
            @endforeach
        </div>
       </div>
    </main>
@endsection



