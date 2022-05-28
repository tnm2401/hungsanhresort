<div  class="col-md-12">
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card shadow-sm border">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">TỔNG QUAN DOANH THU THÁNG {{ date('m') }} </h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">

                        <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            <i class="fas fa-arrow-up"></i> {{ $data['percent'] }} %
                        </span>
                        <span class="text-muted">Tăng so với tháng trước</span>
                    </p>
                    </div>
                    <div class="card-body">
                        <div class="recent-report__chart">
                          <div id="thongkethunhap"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/dataviz.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/material.js"></script>
  <script src="https://cdn.amcharts.com/lib/4/plugins/wordCloud.js"></script>
  <script src="https://cdn.amcharts.com/lib/4/plugins/forceDirected.js"></script>
  <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
  <script src="https://cdn.amcharts.com/lib/4/themes/frozen.js"></script>
  <script src="{{ asset('backend/assets/js/chart-dashboard/bieudo.js') }}"></script>

@endpush

