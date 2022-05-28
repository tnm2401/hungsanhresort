
    @extends('frontend.layout.master')
    @section('content')
    <main>
        @include('frontend.home.section_banner')
        @include('frontend.home.section_about_us')
        {{-- @include('frontend.home.section_picmap') --}}
        @include('frontend.home.section_type_room')
        @include('frontend.home.section_services')
        @include('frontend.home.section_post')
        @include('frontend.home.section_galery')
        {{-- @include('frontend.home.section_map') --}}
    </main>
@endsection
