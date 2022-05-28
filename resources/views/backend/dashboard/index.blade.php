@extends("backend.layout.master")
@section('title', 'Bảng điều khiển')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ __('dashboard.name') }}
                <small>AIB CMS V2.0</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i>
                        {{ __('dashboard.name') }}</a>
                </li>
                {{-- <li class="active">Trang quản trị</li> --}}
            </ol>
        </section>

        <section class="content container-fluid">
            @include('backend.dashboard.4-col-count')
            <div class="container">
            <div class="row ">
            @include('backend.dashboard.room')
            @include('backend.dashboard.chart-count-customer')
            </div>
        </div>
        </section>

        {{-- <section>
            <div class="container">
                <div class="row">
                    @include('backend.dashboard.chart-count-money')
                </div>
            </div>
        </section> --}}
        <section class="content container-fluid">
            @if (hasRole('dashboard_all'))
                @include('backend.dashboard.chart-counter')
            @endif
            {{-- @include('backend.dashboard.analytics') --}}
            <div class="box box-success" style="margin-bottom:0">
                <div class="box-body">
                    {{ $today = date('l, d/m/Y') }} <span class="clock"></span> {{ $today = date('A') }}
                </div>
            </div>
        </section>

    </div>
@endsection

