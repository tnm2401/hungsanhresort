<!DOCTYPE html>
<html lang="vi">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{$setting->translations->name}} || {{$master['title']}}</title>
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('storage') }}/uploads/{{ $master['img'] }}" />
    <link rel="icon" type="image/png" href="{{ asset('storage') }}/uploads/{{ $master['img'] }}" />
    <link rel="shortcut icon" href="{{ asset('storage') }}/uploads/setting/{{$setting->faviconindex}}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    @include('frontend.layout.seo')
    {!! $setting->codehead !!}
    @include('frontend.layout.style')
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $setting->idanalytics }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());
        gtag("config", "{{ $setting->idanalytics }}");
    </script>
        @stack('style')

</head>
<!-- <div id="fb-root"></div>
<script async defer crossorigin="anonymous"
    src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v13.0&appId=800406244111382&autoLogAppEvents=1"
    nonce="tzXKerrN"></script> -->
    <body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">
