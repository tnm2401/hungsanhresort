@extends("frontend.layout.master-layout-detail")
@section("content")
<section class="bg_services">
    <div class="row row_rs">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 main-content">
            <nav aria-label="breadcrumb" style="margin-top: 88px">
                <ol class="breadcrumb shadow-sm">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title="{{ $setting->title }}"><i class="ti-home"></i> {{ __('home') }}</a></li>
                    <li class="breadcrumb-item">{{ __('our_bim_services') }}</li>
                </ol>
            </nav>
            <div class="main-title">
                <h1 class="heading text-center" style="color:#222222">
                <a href="{{ URL::current() }}" title="{{ __('our_bim_services') }}">{{ __('our_bim_services') }}</a>
                </h1>
            </div>
            <section class="services">
                <div class="row mb-5">
                    @foreach($our_bim_services as $item)
                    <div class="col-md-3 mb-4">
                        <div class="item_service item_service_cus">
                            <a href="{{ !$item->url ? 'dich-vu-bim/'.$item->slug.'.html' : $item->url }}" class="img" title="{{ $item->{ 'name_'.$lang } }}">
                                <img src="{{ imageUrl('/storage/uploads/'.$item->img,'568','330','100','1') }}" alt="{{ $item->{ 'name_'.$lang } }}">
                            </a>
                            <div class="info_service">
                                <h3 class="ellipsis_two_row text-center">
                                <a href="{{ !$item->url ? 'dich-vu-bim/'.$item->slug.'.html' : $item->url }}" title="{{ $item->{ 'title_'.$lang } }}">{{ $item->{ 'name_'.$lang } }}</a>
                                </h3>
                                <div class="row">
                                    <div class="col-md-12 mb-3 text-justify ellipsis_three_row">
                                        {!! $item->{ 'descriptions_'.$lang } !!}
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="btn btn-sv">
                                            <a href="{{ !$item->url ? 'dich-vu-bim/'.$item->slug.'.html' : $item->url }}" title="{{ $item->{ 'name_'.$lang } }}">{{ __('view_more') }} <i class="ti-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</section>
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
                "inLanguage": "{{ $setting->{ 'locale_'.$lang } }}",
                "description": "{{ $setting->{ 'description_'.$lang } }}",
                "publisher": { "@id": "{{ url('/#organization') }}" }
                "copyrightHolder": { "@id": "{{ url('/#organization') }}" }
            },
            {
                "@type": "ImageObject",
                "@id": "{{ URL::current() }}/#primaryimage",
                "inLanguage": "{{ $setting->{ 'locale_'.$lang } }}",
                "url": "{{ url('/storage/uploads/'.$master['img']) }}",
                "contentUrl": "{{ url('/storage/uploads/'.$master['img']) }}",
                "width": {{ list($width) = getimagesize(url('/storage/uploads/'.$master['img']))[0] }},
                "height": {{ list($height) = getimagesize(url('/storage/uploads/'.$master['img']))[1] }},
                "caption": "{{ __('our_bim_services') }}"
            },
            {
                "@type": ["WebPage", "CollectionPage"],
                "@id": "{{ URL::current() }}/#webpage",
                "url": "{{ URL::current() }}",
                "name": "{{ __('our_bim_services') }}",
                "isPartOf": { "@id": "{{ url('/#website') }}" },
                "primaryImageOfPage": { "@id": "{{ URL::current() }}/#primaryimage" },
                "datePublished": "{{ $master['created_at'] }}",
                "dateModified": "{{ $master['updated_at'] }}",
                "description": "{{ __('our_bim_services') }}",
                "breadcrumb": { "@id": "{{ URL::current() }}/#breadcrumb" },
                "inLanguage": "{{ $setting->{ 'locale_'.$lang } }}",
                "potentialAction": [{ "@type": "ReadAction", "target": ["{{ URL::current() }}/"] }]
            },
            {
                "@type": "BreadcrumbList",
                "@id": "{{ URL::current() }}/#breadcrumb",
                "itemListElement": [
                    { "@type": "ListItem", "position": 1, "item": { "@type": "WebPage", "@id": "{{ url('/') }}/", "url": "{{ url('/') }}/", "name": "{{ __('home') }}" } },
                    { "@type": "ListItem", "position": 2, "item": { "@type": "WebPage", "@id": "{{ URL::current() }}", "url": "{{ URL::current() }}", "name": "{{ __('our_bim_services') }}" } }
                ]
            }
        ]
    }
</script>
<script>
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            autoplay: true,
            dots: true,
            loop: true,
            margin: 30,
            navigation: true,
            pagination: true,
            lazyLoad: true,
            singleItem: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                900: {
                    items: 2
                }
            }
        });
    });
</script>
@endpush