@extends("frontend.layout.master-layout-detail")
@section("content")
<div class="row row_rs">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 main-content">
        <nav aria-label="breadcrumb" style="margin-top: 88px">
            <ol class="breadcrumb shadow-sm">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title="{{ __('home') }}"><i class="ti-home"></i> {{ __('home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.bimsvs.index') }}" title="{{ __('our_bim_services') }}">{{ __('our_bim_services') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ URL::current() }}" title="{{ $bimsv->{ 'name_'.$lang } }}">{{ $bimsv->{ 'name_'.$lang } }}</a></li>
            </ol>
        </nav>
        <article class="post mb-5">
            <div class="post-content" id="post_content">
                <h2 class="d-none">{{ $bimsv->{ 'name_'.$lang } }}</h2>
                <h3 class="d-none">{{ $bimsv->{ 'name_'.$lang } }}</h3>
                <section class="services">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="item_service item_detail">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="slick-bim" style="background-color: #fff; border-radius: 6px;">
                                            @foreach($images as $item)
                                            <a href="{{ $item->url }}" title="{{ $bimsv->title }}">
                                                <img style="outline: none;" width="100%" height="auto" src="/storage/bimsvs/{{ $item->imgs }}" alt="{{ $bimsv->name }}">
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info_service border-bottom pl-0">
                                            <h2 class="mb-0">
                                            <a href="/dich-vu-bim/{{ $bimsv->slug.'.html' }}" class="ml-0" title="{{ $bimsv->{ 'title_'.$lang } }}">{{ $bimsv->{ 'name_'.$lang } }}</a>
                                            </h2>
                                        </div>
                                        <div class="content_bim_services mt-3">
                                            {!! $bimsv->{ 'content_'.$lang } !!}
                                            <div class="btn btn-bim">
                                                <a href="{{ route('frontend.bimsvs.index') }}" title="{{ __('our_bim_services') }}">{{ __('our_bim_services') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </article>
    </div>
</div>
@endsection
@push("style")
@endpush
@push("script")
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "Organization",
                "@id": "{{ url('/#organization') }}",
                "name": "{{ $setting->{ 'nameindex_'.$lang } }}",
                "url": "{{ url('/') }}/",
                "sameAs": ["{{ $setting->facebook }}", "{{ $setting->twitter }}", "{{ $setting->youtube }}"],
                "logo": {
                    "@type": "ImageObject",
                    "@id": "{{ url('/#logo') }}",
                    "inLanguage": "{{ $setting->{ 'locale_'.$lang } }}",
                    "url": "{{ url('/storage/uploads/'.$setting->logoindex) }}",
                    "contentUrl": "{{ url('/storage/uploads/'.$setting->logoindex) }}",
                    "width": {{ list($width) = getimagesize(url('/storage/uploads/'.$setting->logoindex))[0] }},
                    "height": {{ list($height) = getimagesize(url('/storage/uploads/'.$setting->logoindex))[1] }},
                    "caption": "{{ $setting->{ 'nameindex_'.$lang } }}"
                },
                "image": { "@id": "{{ url('/#logo') }}" },
                "slogan": "{{ $setting->{ 'nameindex_'.$lang } }}",
                "description": "{{ $setting->{ 'description_'.$lang } }}",
                "legalName": "{{ $setting->{ 'nameindex_'.$lang } }}"
            },
            {
                "@type": "WebSite",
                "@id": "{{ url('/#website') }}",
                "url": "{{ url('/') }}/",
                "name": "{{ $setting->{ 'nameindex_'.$lang } }}",
                "description": "{{ $setting->{ 'description_'.$lang } }}",
                "publisher": { "@id": "{{ url('/#organization') }}" },
                "inLanguage": "{{ $setting->{ 'locale_'.$lang } }}",
                "copyrightHolder": { "@id": "{{ url('/#organization') }}" }
            },
            { "@type": "ImageObject", "@id": "{{ URL::current() }}/#primaryimage",
                "url": "{{ url('/storage/uploads/'.$bimsv->img ) }}",
                "width": {{ list($width) = getimagesize(url('/storage/uploads/'.$bimsv->img))[0] }},
                "height": {{ list($height) = getimagesize(url('/storage/uploads/'.$bimsv->img))[1] }},
                "caption": "{{ $bimsv->{ 'name_'.$lang } }}"
            },
            {
                "@type": ["WebPage"],
                "@id": "{{ URL::current() }}/#webpage",
                "url": "{{ URL::current() }}",
                "name": "{{ $bimsv->{ 'name_'.$lang } }}",
                "isPartOf": { "@id": "{{ url('/#website') }}" },
                "primaryImageOfPage": { "@id": "{{ URL::current() }}/#primaryimage" },
                "datePublished": "{{ $bimsv->created_at }}",
                "dateModified": "{{ $bimsv->updated_at }}",
                "breadcrumb": { "@id": "{{ URL::current() }}/#breadcrumb" },
                "inLanguage": "{{ $setting->{ 'locale_'.$lang } }}",
                "potentialAction": [{ "@type": "ReadAction", "target": ["{{ URL::current() }}"] }]
            },
            {
                "@type": "BreadcrumbList",
                "@id": "{{ URL::current() }}/#breadcrumb",
                "itemListElement": [
                    { "@type": "ListItem", "position": 1, "name": "{{ __('home') }}", "item": "{{ url('/') }}/" },
                    { "@type": "ListItem", "position": 2, "name": "{{ __('our_bim_services') }}", "item": "{{ route('frontend.bimsvs.index') }}" },
                    { "@type": "ListItem", "position": 3, "name": "{{ $bimsv->{ 'name_'.$lang } }}" }
                ]
            },
            {
                "@type": "Article",
                "@id": "{{ URL::current() }}/#article",
                "isPartOf": { "@id": "{{ URL::current() }}/#webpage" },
                "author": { "@id": "{{ route('frontend.author.index') }}", "name": "{{ $author->{ 'name_'.$lang } }}" },
                "headline": "{{ $bimsv->{ 'name_'.$lang } }}",
                "datePublished": "{{ $bimsv->created_at }}",
                "dateModified": "{{ $bimsv->updated_at }}",
                "mainEntityOfPage": { "@id": "{{ URL::current() }}/#webpage" },
                "publisher": { "@id": "{{ url('/#organization') }}" },
                "image": { "@id": "{{ URL::current() }}/#primaryimage" },
                "thumbnailUrl": "{{ url('/storage/uploads/'.$bimsv->img ) }}",
                "keywords": "{{ $bimsv->{ 'keywords_'.$lang } }}",
                "inLanguage": "{{ $setting->{ 'locale_'.$lang } }}",
                "copyrightYear": "{{ Carbon::createFromFormat('Y-m-d H:i:s', $bimsv->created_at)->year }}",
                "copyrightHolder": { "@id": "{{ url('/#organization') }}" }
            },
            {
                "@type": ["Person"],
                "@id": "{{ route('frontend.author.index') }}",
                "name": "{{ $author->{ 'name_'.$lang } }}",
                "image": { "@type": "ImageObject", "@id": "{{ url('/#authorlogo') }}", "url": "{{ url('/storage/uploads/'.$author->img) }}", "caption": "{{ $author->{ 'name_'.$lang } }}" },
                "description": "{{ $author->{ 'description_'.$lang } }}",
                "sameAs": ["{{ url('/') }}/,{{ route('frontend.author.index') }}"]
            }
        ]
    }
</script>
<script>
  $(document).ready(function() {
    $('.slick-bim').slick({
      autoplay: true,
      dots: true,
      infinite: false,
      speed: 500,
      arrows: true,
      fade: true,
      cssEase: 'linear',
      lazyLoad: 'ondemand',
      controls: true,
      pauseOnHover: false,
    });
  });
</script>
<script>
$(function(){
   $("a img").each(function(){
        $(this).attr("title", $(this).find("img").attr("alt"));
   });
});
</script>
@endpush