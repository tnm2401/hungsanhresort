@extends("frontend.layout.master-layout-detail")
@section("content")
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9 mb-4 main-content">
      <nav aria-label="breadcrumb" style="margin-top: 88px">
        <ol class="breadcrumb shadow-sm">
          <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title="{{ $setting->{ 'title_'.$lang } }}"><i class="ti-home"></i> {{ __('home') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $contacts->{ 'name_'.$lang } }}</li>
        </ol>
      </nav>
      <article class="card shadow post mb-5">
        <div class="post-content shadow" id="post_content">
          <div class="main-title">
            <h1 class="title text-center">{{ $contacts->{ 'name_'.$lang } }}</h1>
          </div>
          <h2 class="d-none">{{ $contacts->{ 'name_'.$lang } }}</h2>
          <h3 class="d-none">{{ $contacts->{ 'name_'.$lang } }}</h3>
          <hr>
          {!! $contacts->{ 'content_'.$lang } !!}
          <form action="{{ route('backend.contactform.store') }}" method="POST" accept-charset="utf-8">
            @csrf
            <div class="modal-body" style="padding: 0px;">
              @if ($errors->any())
              <div id="error_contact" class="alert alert-danger" style="display: none">
                <ul style="padding-left: 0px;">
                  @foreach ($errors->all() as $error)
                  <li style="line-height: 32px;">{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              <input type="hidden" id="type" name="type" value="contactform">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                  <input class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="{{ __('name') }}" type="text" />
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                  <input class="form-control" name="address" value="{{ old('address') }}" id="address" placeholder="{{ __('address') }}" type="text"  />
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                  <input class="form-control" name="phone" value="{{ old('phone') }}" id="phone" placeholder="{{ __('phone_number') }}" type="text"  {{-- autofocus --}} />
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                  <input class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="Email" type="email"  />
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                  <input class="form-control" name="subject" value="{{ old('subject') }}" id="subject" placeholder="{{ __('subject') }}" type="text"  />
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                  <textarea style="resize:vertical;" class="form-control" placeholder="{{ __('content') }}" rows="6" name="contactcontent" id="contactcontent">{{ old('contactcontent') }}</textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-12" style="padding-bottom: 10px;">
                  <input class="form-control" name="captcha" id="captcha" placeholder="Captcha" type="text"  />
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-6 refereshrecapcha" style="padding-bottom: 10px;">
                  {!! captcha_img('flat') !!}
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                  <a href="javascript:void(0)" onclick="refreshCaptcha()"><i class="ti ti-reload"></i></a>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                  <input type="hidden" class="form-control" name="stt" id="stt" value="1" placeholder="stt" />
                </div>
              </div>
              <div class="panel-footer mt-3 mb-3" style="margin-bottom:-14px;">
                <input type="submit" id="send_contact" class="btn btn-success btn-custom" value="{{ __('sent') }}"/>
                <!--<span class="glyphicon glyphicon-ok"></span>-->
                <input type="reset" class="btn btn-danger btn-custom" value="{{ __('delete') }}" />
                <!--<span class="glyphicon glyphicon-remove"></span>-->
              </div>
            </div>
          </form>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="office-1" data-toggle="tab" href="#office" title="{{ __('maps') }}" role="tab" aria-controls="office" aria-selected="true">{{ __('maps') }}</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="office" role="tabpanel" aria-labelledby="office-1">{!! $setting->maps !!}</div>
          </div>
        </div>
      </div>
    </div>
  </article>
</div>
@endsection
@push("style")
@endpush
@push("script")
<script>
    function refreshCaptcha() {
        $.ajax({
            url: "{{ route('refereshcapcha') }}",
            type: "get",
            dataType: "html",
            success: function (json) {
                $(".refereshrecapcha").html(json);
            },
            error: function (data) {
                alert("Try Again.");
            },
        });
    }
</script>
<script>
    var has_errors = {{ $errors->count() > 0 ? 'true' : 'false' }};
    if (has_errors) {
      Swal.fire({
        title: '{{ __('error') }}...!',
        icon: 'error',
        html: jQuery('#error_contact').html(),
        showCloseButton: true,
      });
    }
</script>
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
                    "url": "{{ url('/storage/uploads/'.$setting->logoindex) }}",
                    "width": {{ list($width) = getimagesize(url('/storage/uploads/'.$setting->logoindex))[0] }},
                    "height": {{ list($height) = getimagesize(url('/storage/uploads/'.$setting->logoindex))[1] }},
                    "caption": "{{ $setting->{ 'nameindex_'.$lang } }}"
                },
                "image": { "@id": "{{ url('/#logo') }}" },
                "legalName": "{{ $setting->{ 'nameindex_'.$lang } }}"
            },
            {
                "@type": "WebSite",
                "@id": "{{ url('/#website') }}",
                "url": "{{ url('/') }}/",
                "name": "{{ $setting->{ 'nameindex_'.$lang } }}",
                "description": "{{ $setting->{ 'description_'.$lang } }}",
                "publisher": { "@id": "{{ url('/#organization') }}" }
            },
            {
                "@type": "ImageObject",
                "@id": "{{ route('frontend.contact.index') }}/#primaryimage",
                "url": "{{ url('/storage/uploads/'.$master['img']) }}",
                "width": {{ list($width) = getimagesize(url('/storage/uploads/'.$master['img']))[0] }},
                "height": {{ list($height) = getimagesize(url('/storage/uploads/'.$master['img']))[1] }},
                "caption": "{{ $contacts->{ 'name_'.$lang } }}"
            },
            {
                "@type": ["WebPage", "ContactPage"],
                "@id": "{{ route('frontend.contact.index') }}/#webpage",
                "url": "{{ route('frontend.contact.index') }}",
                "inLanguage": "{{ $setting->{ 'locale_'.$lang } }}",
                "name": "{{ $contacts->{ 'name_'.$lang } }}",
                "isPartOf": { "@id": "{{ url('/#website') }}" },
                "primaryImageOfPage": { "@id": "{{ route('frontend.contact.index') }}/#primaryimage" },
                "datePublished": "{{ $contacts->published }}",
                "dateModified": "{{ $contacts->updated_at }}",
                "description": "{{ $contacts->{ 'description_'.$lang } }}",
                "breadcrumb": { "@id": "{{ route('frontend.contact.index') }}/#breadcrumb" }
            },
            {
                "@type": "BreadcrumbList",
                "@id": "{{ route('frontend.contact.index') }}/#breadcrumb",
                "itemListElement": [
                    { "@type": "ListItem", "position": 1, "item": { "@type": "WebPage", "@id": "{{ url('/') }}", "url": "{{ url('/') }}", "name": "{{ __('home') }}",
                    { "@type": "ListItem", "position": 2, "item": { "@type": "WebPage", "@id": "{{ route('frontend.contact.index') }}", "url": "{{ route('frontend.contact.index') }}", "name": "{{ $contacts->{ 'name_'.$lang } }}" } }
                ]
            }
        ]
    }
</script>
@endpush