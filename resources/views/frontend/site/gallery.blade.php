@extends('frontend.layout.master')
@section('title')
{{ $gallery->translations->name }}
@endsection
@section('content')


        <div class="banner_share banner-galleries" id="guest">
            <img src="{{ imageUrl('/storage/uploads/gallery/'.$gallery->img,'577','415','100','1') }}" alt="">
            <div class="container">
                <div class="title">
                    <h2>{{ $gallery->translations->name }}</h2>

                </div>
            </div>
        </div>
        <section class="section_page-gallery bg-white">
            <div class="container">
                <div class="gallery">

                    <div class="galerries">

                        <div class="aos-init"  data-aos="fade-in">
                            {{-- <div class="text-center">
                                <h2> LOBBY </h2>
                            </div> --}}
                            <div class="grid aos-init" id="gallery" data-aos="fade-up">
                                <div class="item">
                                    <a href="{{ imageUrl('/storage/uploads/gallery/'.$gallery->img,'787','415','100','1') }}" data-caption="1" data-fancybox="mygallery">
                                        <img src="{{ imageUrl('/storage/uploads/gallery/'.$gallery->img,'835','557','100','1') }}">
                                    </a>
                                </div>
                                @foreach ($gallery->images as $i)
                                <div class="item">
                                    <a href="{{ imageUrl('/storage/uploads/gallery/'.$i->imgs,'386','200','100','1') }}" data-fancybox="mygallery">
                                        <img src="{{ imageUrl('/storage/uploads/gallery/'.$i->imgs,'835','557','100','1') }}">
                                    </a>
                                </div>
                                @endforeach

                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </section>




@push('script')
<script>
    $(function() {
        $("#from-date").datepicker();
        $("#to-date").datepicker();
    });
    $('#gallery a').fancybox({
        loop: true,
        buttons: [
            "slideShow",
            "thumbs",
            "zoom",
            "fullScreen",
            "share",
            "close"
        ],

        protect: true,
        transitionEffect: "slide",
    });
    $(document).ready(function() {
        // add all to same gallery
        $("#gallery a").attr("data-fancybox", "mygallery");
        // assign captions and title from alt-attributes of images:
        $("#gallery a").each(function() {
            $(this).attr("data-caption", $(this).find("img").attr("alt"));
            $(this).attr("title", $(this).find("img").attr("alt"));
        });
        // start fancybox:
        $("#gallery a").fancybox();
    });
</script>
<script>
    AOS.init();
</script>


<script>
    $(".closetop").click(function() {
        $(".contacthotel").hide();
    });
    $(window).scroll(function() {
        if ($(window).scrollTop() > 36) {
            $("header").css('top', '0');
        } else {
            $("header").css('top', '36px');
        }
    })
</script>

@endpush

@endsection
