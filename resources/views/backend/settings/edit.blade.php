@extends('backend.layout.master')
@push('script')
    @foreach ($language as $l)
        <script>
            $('document').ready(function() {
                $(document).on('keyup', 'input#name', function() {
                    var title = ($(this).val());
                    $('div#title').text(title);
                });
                $(document).on('keyup', 'textarea#description', function() {
                    var description = ($(this).val());
                    $('div#description-seo').text(description);
                });
            });
        </script>
    @endforeach


@endpush

@section('content')
    <style>


    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">

        <section class="content-header">
            <h4>
                Cấu hình website
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                <li class="active">Cấu hình website</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="stringLengthForm" method="POST" action="{{ route('backend.setting.update') }}"
                enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12 step-app " id="step">
                        <div class="text-center">
                            <ul class=" step-steps" id="progressbarx">
                                <li data-step-target="step1">SEO</li>
                                <li data-step-target="step2">Thông tin website</li>
                                <li data-step-target="step3">Mạng xã hội</li>
                                <li data-step-target="step4">Xác thực website</li>
                                <li data-step-target="step5">Geo Location Meta Tag</li>
                                <li data-step-target="step6">Tuỳ biến Code</li>
                                <li data-step-target="step7">Hình ảnh</li>
                            </ul>

                        </div>

                        <div class="step-content">
                            <div class="step-tab-panel" data-step="step1">
                                <div class="box-primary nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        @foreach ($language as $lang)
                                            <li class=" @if (session('locale') == $lang->locale) active @endif"><a
                                                    href="{{ route('change.locale', $lang->locale) }}">
                                                    <span class="{{ $lang->flag }}"></span> {{ $lang->name }}</a></li>
                                        @endforeach
                                        <li class="pull-right"><a href="#" class="text-muted"><i
                                                    class="fa fa-gear"></i></a></li>
                                    </ul>
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Cấu hình SEO Website</h3>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane active tab-content-en">
                                            <input type="hidden" id="type" name="type" value="website">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tên công ty ({{ session('locale') }})</label>
                                                        <input type="text" name="translation[name]" id="name"
                                                            value="@if (isset($setting->translations->name)) {{ old('nameindex_vi', $setting->translations->name) }}@else{{ old('nameindex_vi') }} @endif"
                                                            class="form-control" data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="Nhập tên công ty ({{ session('locale') }})">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Title ({{ session('locale') }})</label>
                                                        <input type="text" name="translation[title]" id="title_vi"
                                                            value="@if (isset($setting->translations->title)) {{ old('title_vi', $setting->translations->title) }}@else{{ old('title_vi') }} @endif"
                                                            class="form-control" data-toggle="tooltip"
                                                            data-placement="top" title="Nhập tiêu đề website (VI)">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Địa chỉ ({{ session('locale') }})</label>
                                                        <input type="text" name="translation[address]"
                                                            value="@if (isset($setting->translations->address)) {{ old('address_vi', $setting->translations->address) }}@else{{ old('address_vi') }} @endif"
                                                            class="form-control" data-toggle="tooltip"
                                                            data-placement="top" title="Nhập địa chỉ (VI)">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Copyright ({{ session('locale') }})</label>
                                                        <input type="text" name="translation[copyright]"
                                                            value="@if (isset($setting->translations->copyright)) {{ old('copyright_vi', $setting->translations->copyright) }}@else{{ old('copyright_vi') }} @endif"
                                                            class="form-control" data-toggle="tooltip"
                                                            data-placement="top" title="Nhập thông tin copyright (VI)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Keywords ({{ session('locale') }})</label>
                                                <textarea class="form-control" name="translation[keywords]" id="keywords_vi"
                                                    value="@if (isset($setting->translations->keywords)) {{ old('keywords_vi', $setting->translations->keywords) }}@else{{ old('keywords_vi') }} @endif"
                                                    rows="3" data-toggle="tooltip" data-placement="top"
                                                    title="Nhập từ khoá cho website (VI)">@if (isset($setting->translations->keywords)){{ old('keywords_vi', $setting->translations->keywords) }}@else{{ old('keywords_vi') }}@endif</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Description ({{ session('locale') }})</label>
                                                <textarea class="form-control" name="translation[description]" id="description"
                                                    value="@if (isset($setting->translations->description)) {{ old('description_vi', $setting->translations->description) }}@else{{ old('description_vi') }} @endif"
                                                    rows="3" data-toggle="tooltip" data-placement="top"
                                                    title="Nhập mô tả website (VI)">@if (isset($setting->translations->description)){{ old('description_vi', $setting->translations->description) }}@else{{ old('description_vi') }}@endif</textarea>
                                            </div>
                                            <div hidden class="form-group">
                                                <label>Locale ({{ session('locale') }})</label>
                                                <input type="text" name="translation[locale]"
                                                    value="{{ session('locale') }}" class="form-control"
                                                    data-toggle="tooltip" data-placement="top">
                                            </div>
                                            <div class="url-seo" id="slug">{{ $setting->web }}</div>
                                            <div class="title-seo" id="title">{{ $setting->translations->title ?? ''}}
                                            </div>
                                            <div class="description-seo" id="description-seo">
                                                {{ $setting->translations->description ?? '' }}
                                            </div>
                                        </div>
                                        <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                        <a href="{{ route('backend.dashboard.index') }}" class="btn btn-danger"><i
                                                class="fa fa-times-circle"></i> Thoát</a>
                                    </div>
                                </div>
                            </div>
                            <div class="step-tab-panel" data-step="step2">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Cấu hình thông tin website</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class=" row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email admin</label>
                                                    <input type="text" name="email"
                                                        value="@if (isset($setting->email)) {{ old('email', $setting->email) }}@else{{ old('email') }} @endif"
                                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                                        title="Nhập email admin nhận thông báo">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>URL Website</label>
                                                    <input type="text" name="website"
                                                        value="@if (isset($setting->website)) {{ old('website', $setting->website) }}@else{{ old('website') }} @endif"
                                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                                        title="Nhập URL website">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Website</label>
                                                    <input type="text" name="web"
                                                        value="@if (isset($setting->web)) {{ old('web', $setting->web) }}@else{{ old('web') }} @endif"
                                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                                        title="Nhập tên miền website">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Hotline</label>
                                                    <input type="text" name="hotline_1"
                                                        value="@if (isset($setting->hotline_1)) {{ old('hotline_1', $setting->hotline_1) }}@else{{ old('hotline_1') }} @endif"
                                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                                        title="Nhập số hotline">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>URL hotline</label>
                                                    <input type="text" name="href_1"
                                                        value="@if (isset($setting->href_1)) {{ old('href_1', $setting->href_1) }}@else{{ old('href_1') }} @endif"
                                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                                        title="Nhập URL hotline">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>HTML lang</label>
                                                    <input type="text" name="lang"
                                                        value="@if (isset($setting->lang)) {{ old('lang', $setting->lang) }}@else{{ old('lang') }} @endif"
                                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                                        title=" Nhập HTML lang">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Author</label>
                                                    <input type="text" name="author"
                                                        value="@if (isset($setting->author)) {{ old('author', $setting->author) }}@else{{ old('author') }} @endif"
                                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                                        title=" Nhập author">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Robots permission</label>
                                                    <input type="text" name="robots"
                                                        value="@if (isset($setting->robots)) {{ old('robots', $setting->robots) }}@else{{ old('robots') }} @endif"
                                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                                        title=" Nhập robots permission">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                        <a href="{{ route('backend.dashboard.index') }}" class="btn btn-danger"><i
                                                class="fa fa-times-circle"></i> Thoát</a>
                                    </div>
                                </div>
                            </div>
                            <div class="step-tab-panel" data-step="step3">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Cấu hình mạng xã hội</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>URL Facebook</label>
                                                    <input type="text" name="facebook"
                                                        value="@if (isset($setting->facebook)) {{ old('facebook', $setting->facebook) }}@else{{ old('facebook') }} @endif"
                                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                                        title="Nhập URL Facebook">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>URL Twitter</label>
                                                    <input type="text" name="twitter"
                                                        value="@if (isset($setting->twitter)) {{ old('twitter', $setting->twitter) }}@else{{ old('twitter') }} @endif"
                                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                                        title="Nhập URL Twitter">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>URL Youtube</label>
                                                    <input type="text" name="youtube"
                                                        value="@if (isset($setting->youtube)) {{ old('youtube', $setting->youtube) }}@else{{ old('youtube') }} @endif"
                                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                                        title="Nhập URL Youtube">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>URL WhatsApp</label>
                                                    <input type="text" name="whatsapp"
                                                        value="@if (isset($setting->whatsapp)) {{ old('whatsapp', $setting->whatsapp) }}@else{{ old('whatsapp') }} @endif"
                                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                                        title="Nhập URL WhatsApp">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>URL Viber</label>
                                                    <input type="text" name="viber"
                                                        value="@if (isset($setting->viber)) {{ old('viber', $setting->viber) }}@else{{ old('viber') }} @endif"
                                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                                        title="Nhập URL Viber">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>URL Instagram</label>
                                                    <input type="text" name="instagram"
                                                        value="@if (isset($setting->instagram)) {{ old('instagram', $setting->instagram) }}@else{{ old('instagram') }} @endif"
                                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                                        title="Nhập URL Instagram">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                        <a href="{{ route('backend.dashboard.index') }}" class="btn btn-danger"><i
                                                class="fa fa-times-circle"></i> Thoát</a>
                                    </div>
                                </div>
                            </div>
                            <div class="step-tab-panel" data-step="step4">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Xác thực website</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>ID Google Analytics</label>
                                            <input type="text" name="idanalytics"
                                                value="@if (isset($setting->idanalytics)) {{ old('idanalytics', $setting->idanalytics) }}@else{{ old('idanalytics') }} @endif"
                                                class="form-control" data-toggle="tooltip" data-placement="top"
                                                title="Thêm mã ID Google Analytics">
                                        </div>
                                        <div class="form-group">
                                            <label>Google Site Verification</label>
                                            <input type="text" name="googlesiteverification"
                                                value="@if (isset($setting->googlesiteverification)) {{ old('googlesiteverification', $setting->googlesiteverification) }}@else{{ old('googlesiteverification') }} @endif"
                                                class="form-control" data-toggle="tooltip" data-placement="top"
                                                title="Thêm mã Google Site Verification">
                                        </div>
                                        <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                        <a href="{{ route('backend.dashboard.index') }}" class="btn btn-danger"><i
                                                class="fa fa-times-circle"></i> Thoát</a>
                                    </div>
                                </div>
                            </div>
                            <div class="step-tab-panel" data-step="step5">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Geo Location Meta Tag</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Latitude</label>
                                            <input type="text" name="latitude"
                                                value="@if (isset($setting->latitude)){{ old('latitude', $setting->latitude) }}@else{{ old('latitude') }}@endif"
                                                class="form-control" data-toggle="tooltip" data-placement="top"
                                                title="Thêm Latitude">
                                        </div>
                                        <div class="form-group">
                                            <label>Longitude</label>
                                            <input type="text" name="longitude"
                                                value="@if (isset($setting->longitude)){{ old('longitude', $setting->longitude) }}@else{{ old('longitude') }}@endif"
                                                class="form-control" data-toggle="tooltip" data-placement="top"
                                                title="Thêm Longitude">
                                        </div>
                                        <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                        <a href="{{ route('backend.dashboard.index') }}" class="btn btn-danger"><i
                                                class="fa fa-times-circle"></i> Thoát</a>
                                    </div>
                                </div>
                            </div>
                            <div class="step-tab-panel" data-step="step6">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Tuỳ biến Code</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Code &lt;head&gt; ... &lt;/head&gt;</label>
                                            <textarea class="form-control" name="codehead" rows="3"data-toggle="tooltip" data-placement="top"
                                                title="Thêm code &lt;head&gt; ... &lt;/head&gt;">@if (isset($setting->codehead)){!! old('codehead', $setting->codehead)
                                          !!}@else{!! old('codehead') !!}@endif</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Code &lt;body&gt; ... &lt;/body&gt;</label>
                                            <textarea class="form-control" name="codebody" rows="3" data-toggle="tooltip" data-placement="top" title="Thêm code &lt;body&gt; ... &lt;/body&gt;">@if (isset($setting->codebody)){!! old('codebody', $setting->codebody) !!}@else{!! old('codebody') !!}@endif</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Google Maps</label>
                                            <textarea class="form-control" name="maps" rows="5" data-toggle="tooltip" data-placement="top"
                                                title="Thêm code Iframe Google Maps">@if(isset($setting->maps)){!! old('maps', $setting->maps) !!}@else{!! old('maps') !!}@endif</textarea>
                                        </div>
                                        <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                        <a href="{{ route('backend.dashboard.index') }}" class="btn btn-danger"><i
                                                class="fa fa-times-circle"></i> Thoát</a>
                                    </div>
                                </div>
                            </div>

                            <div class="step-tab-panel" data-step="step7">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Hình ảnh</h3>
                                    </div>
                                    <div style="padding:2%" class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="box-header with-border">
                                                    <label for="">Logo</label>
                                                </div>
                                                <img class="img-thumbnail mb-2"
                                                    style="max-width: 100px; margin-bottom:10px;"
                                                    src="{{ asset('storage') }}/uploads/setting/{{ $setting->logoindex }}"
                                                    alt="Favicon">
                                                <input type="file" name="logoindex" class="form-control"
                                                    value="{{ $setting->logoindex }}" data-toggle="tooltip"
                                                    data-placement="top" title="Dimensions min 116 x 60 (px)">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="box-header with-border">
                                                    <label>Favicon trang chủ</label>
                                                </div>
                                                <img class="img-thumbnail mb-2"
                                                    style="max-width: 100px; margin-bottom:10px;"
                                                    src="{{ asset('storage') }}/uploads/setting/{{ $setting->faviconindex }}"
                                                    alt="Favicon">
                                                <input type="file" name="faviconindex" class="form-control"
                                                    value="{{ $setting->faviconindex }}" data-toggle="tooltip"
                                                    data-placement="top" title="Dimensions min 60 x 60 (px)">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="box-header with-border">
                                                    <label>Favicon admin</label>
                                                </div>
                                                <img class="img-thumbnail mb-2"
                                                    style="max-width: 100px; margin-bottom:10px;"
                                                    src="{{ asset('storage') }}/uploads/setting/{{ $setting->faviconadmin }}"
                                                    alt="Favicon">
                                                <input type="file" name="faviconadmin" class="form-control"
                                                    value="{{ $setting->faviconadmin }}" data-toggle="tooltip"
                                                    data-placement="top" title="Dimensions min 60 x 60 (px)">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="box-header with-border">
                                                    <label>Hình ảnh Share Facebook</label>
                                                </div>
                                                <img class="img-thumbnail mb-2"
                                                    style="max-width: 100px; margin-bottom:10px;"
                                                    src="{{ asset('storage') }}/uploads/setting/{{ $setting->img }}"
                                                    alt="Favicon">
                                                <input type="file" name="img" class="form-control"
                                                    value="{{ $setting->img }}" data-toggle="tooltip"
                                                    data-placement="top" title="Dimensions min 370 x 250 (px)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-body">
                                        <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                        <a href="{{ route('backend.dashboard.index') }}" class="btn btn-danger"><i
                                                class="fa fa-times-circle"></i> Thoát</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- left column -->
                    <!-- right column -->

                    <!-- right column -->
                </div>
        </section>
    </div>
    </form>
    @push('style')
        <link rel="stylesheet" href="{{ asset('backend') }}/plugins/jquery-steps/jquery-steps.css">
    @endpush
    @push('script')
        <script src="{{ asset('backend') }}/plugins/jquery-steps/jquery-steps.js"></script>
        <script>
            $('#step').steps({
                onFinish: function() {
                    alert('Wizard Completed');
                }
            });
        </script>
    @endpush

@endsection
