@php print '<?xml version="1.0" encoding="UTF-8" ?>'; @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
  <url>
    <loc>{{ route('frontend.home.index') }}</loc>
    <lastmod>{{ date("Y-m-d", strtotime($setting->updated_at)) }}</lastmod>
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->img }}</image:loc>
      <image:title>{{ $setting->{ 'title_'.$lang } }}</image:title>
      <image:caption>{{ $setting->{ 'title_'.$lang } }}</image:caption>
    </image:image>
  </url>
  <url>
    <loc>{{ route('frontend.expertise.index') }}</loc>
    <lastmod>{{ date("Y-m-d", strtotime($expertise->updated_at)) }}</lastmod>
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $expertise->img }}</image:loc>
        <image:title>{{ __('expertise') }}</image:title>
        <image:caption>{{ __('expertise') }}</image:caption>
    </image:image>
  </url>
  <url>
    <loc>{{ route('frontend.all_service.index') }}</loc>
    <lastmod>{{ date("Y-m-d", strtotime($setting->updated_at)) }}</lastmod>
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->img }}</image:loc>
        <image:title>{{ __('service') }}</image:title>
        <image:caption>{{ __('service') }}</image:caption>
    </image:image>
  </url>
  @foreach($svcategories as $item)
    <url>
      <loc>{{ route('frontend.home.index') }}/dich-vu/{{ $item->slug.'.html' }}</loc>
      <lastmod>{{ date("Y-m-d", strtotime($item->updated_at)) }}</lastmod>
      <image:image>
        <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $item->img }}</image:loc>
        <image:title>{{ $item->{ 'title_'.$lang } }}</image:title>
        <image:caption>{{ $item->{ 'title_'.$lang } }}</image:caption>
      </image:image>
    </url>
  @endforeach
  @foreach($servis as $item)
    <url>
      <loc>{{ route('frontend.home.index') }}/{{ $item->slug.'.html' }}</loc>
      <lastmod>{{ date("Y-m-d", strtotime($item->updated_at)) }}</lastmod>
      <image:image>
        <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $item->img }}</image:loc>
        <image:title>{{ $item->{ 'title_'.$lang } }}</image:title>
        <image:caption>{{ $item->{ 'title_'.$lang } }}</image:caption>
      </image:image>
    </url>
  @endforeach
  <url>
    <loc>{{ route('frontend.bimsvs.index') }}</loc>
    <lastmod>{{ date("Y-m-d", strtotime($setting->updated_at)) }}</lastmod>
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->img }}</image:loc>
        <image:title>{{ __('our_bim_services') }}</image:title>
        <image:caption>{{ __('our_bim_services') }}</image:caption>
    </image:image>
  </url>
  @foreach($our_bim_services as $item)
    <url>
      <loc>{{ route('frontend.home.index') }}/dich-vu-bim/{{ $item->slug.'.html' }}</loc>
      <lastmod>{{ date("Y-m-d", strtotime($item->updated_at)) }}</lastmod>
      <image:image>
        <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $item->img }}</image:loc>
        <image:title>{{ $item->{ 'title_'.$lang } }}</image:title>
        <image:caption>{{ $item->{ 'title_'.$lang } }}</image:caption>
      </image:image>
    </url>
  @endforeach
  <url>
    <loc>{{ route('frontend.network.index') }}</loc>
    <lastmod>{{ date("Y-m-d", strtotime($networks->updated_at)) }}</lastmod>
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $networks->img }}</image:loc>
      <image:title>{{ $networks->{ 'title_'.$lang } }}</image:title>
      <image:caption>{{ $networks->{ 'title_'.$lang } }}</image:caption>
    </image:image>
  </url>
  <url>
    <loc>{{ route('frontend.people.index') }}</loc>
    <lastmod>{{ date("Y-m-d", strtotime($setting->updated_at)) }}</lastmod>
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->img }}</image:loc>
      <image:title>{{ __('people') }}</image:title>
      <image:caption>{{ __('people') }}</image:caption>
    </image:image>
  </url>
  <url>
    <loc>{{ route('frontend.all_post.index') }}</loc>
    <lastmod>{{ date("Y-m-d", strtotime($setting->updated_at)) }}</lastmod>
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->img }}</image:loc>
      <image:title>{{ __('new') }}</image:title>
      <image:caption>{{ __('new') }}</image:caption>
    </image:image>
  </url>
  @foreach ($posts as $item)
    <url>
      <loc>{{ route('frontend.home.index') }}/tin-tuc/{{ $item->slug.'.html' }}</loc>
      <lastmod>{{ date("Y-m-d", strtotime($item->updated_at)) }}</lastmod>
      <image:image>
        <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $item->img }}</image:loc>
        <image:title>{{ $item->{ 'title_'.$lang } }}</image:title>
        <image:caption>{{ $item->{ 'title_'.$lang } }}</image:caption>
      </image:image>
    </url>
  @endforeach
  <url>
    <loc>{{ route('frontend.all_recruitment.index') }}</loc>
    <lastmod>{{ date("Y-m-d", strtotime($setting->updated_at)) }}</lastmod>
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->img }}</image:loc>
      <image:title>{{ __('recruitment') }}</image:title>
      <image:caption>{{ __('recruitment') }}</image:caption>
    </image:image>
  </url>
  @foreach ($recruitments as $item)
    <url>
      <loc>{{ route('frontend.home.index') }}/tuyen-dung/{{ $item->slug.'.html' }}</loc>
      <lastmod>{{ date("Y-m-d", strtotime($item->updated_at)) }}</lastmod>
      <image:image>
        <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $item->img }}</image:loc>
        <image:title>{{ $item->{ 'title_'.$lang } }}</image:title>
        <image:caption>{{ $item->{ 'title_'.$lang } }}</image:caption>
      </image:image>
    </url>
  @endforeach
  {{-- <url>
    <loc>{{ route('frontend.contact.index') }}</loc>
    <lastmod>{{ date("Y-m-d", strtotime($contacts->updated_at)) }}</lastmod>
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $contacts->img }}</image:loc>
      <image:title>{{ $contacts->{ 'title_'.$lang } }}</image:title>
      <image:caption>{{ $contacts->{ 'title_'.$lang } }}</image:caption>
    </image:image>
  </url> --}}
  <url>
    <loc>{{ route('frontend.author.index') }}</loc>
    <lastmod>{{ date("Y-m-d", strtotime($author->updated_at)) }}</lastmod>
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $author->img }}</image:loc>
      <image:title>{{ $author->{ 'title_'.$lang } }}</image:title>
      <image:caption>{{ $author->{ 'title_'.$lang } }}</image:caption>
    </image:image>
  </url>
  <url>
    <loc>{{ route('frontend.home.index') }}</loc>
    @foreach($galleries as $item)
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $item->img }}</image:loc>
      <image:caption>{{ $item->{ 'title_'.$lang } }}</image:caption>
      <image:title>{{ $item->{ 'title_'.$lang } }}</image:title>
    </image:image>
    @endforeach
    @foreach ($sliders as $item)
    @if($item->type == 'slider')
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $item->img }}</image:loc>
      <image:caption>{{ $item->{ 'title_'.$lang } }}</image:caption>
      <image:title>{{ $item->{ 'title_'.$lang } }}</image:title>
    </image:image>
    @endif
    @endforeach
    @foreach ($sliders as $item)
    @if($item->type == 'expertises')
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $item->img }}</image:loc>
      <image:caption>{{ $item->{ 'title_'.$lang } }}</image:caption>
      <image:title>{{ $item->{ 'title_'.$lang } }}</image:title>
    </image:image>
    @endif
    @endforeach
  </url>
</urlset>