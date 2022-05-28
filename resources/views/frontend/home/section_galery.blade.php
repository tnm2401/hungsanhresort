<section class="section-home py-100 bg-gray">
    <div class="gallery-home">
        <div class="container">
            <div class="title-vector">
                <h2>{{ __('THƯ VIỆN ẢNH') }}</h2>
            </div>
        </div>
        <div class="container">
            <div class="gallery_filter text-center">
                <ul class="filter">
                    <li class="active" data-filter="*"><span class="common_btn">{{ __('Tất cả') }}</span></li>
                    @foreach ($data['gallery'] as $g)
                    <li data-filter=".{{ $g->id }}"><span class="common_btn">{{ $g->translations->name }}</span></li>
                    @endforeach

                </ul>
            </div>
            <div class="grid gallery_item1" style="position: relative; height: 1504px;">
                @foreach ($data['gallery'] as $item)
                    @foreach ($item->images as $i)

                <div class="grid-item width-1-4 {{ $i->product_id }}" style="position: absolute; left: 0%; top: 0px;">
                    <div class="item_wp"><a class="single_item" href="{{ imageUrl('/storage/uploads/gallery/'.$i->imgs,'850','400','100','1') }}"
                            data-fancybox="gallery"><img src="{{ imageUrl('/storage/uploads/gallery/'.$i->imgs,'282','178','100','1') }}
                            " alt=""
                                loading="lazy"></a></div>
                </div>
                @endforeach
                @endforeach

            </div>
        </div>
    </div>
</section>
