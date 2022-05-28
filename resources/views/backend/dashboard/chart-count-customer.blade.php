<div  class="col-md-6">
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card shadow-sm border">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">SỐ LƯỢNG PHÒNG CHECK-IN THÁNG NÀY </h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="d-flex flex-column">
                             <span>Tổng phòng {{ date('m') . '/' . date('Y') }} : </span>
                             <span class="text-bold text-lg">{{ $data['room_this_month'] }} phòng</span>

                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            <i class="fas fa-arrow-up"></i> {{ $data['percent'] }} %
                        </span>
                        <span class="text-muted">Tăng so với tháng trước</span>
                    </p>
                    </div>
                    <div class="position-relative mb-4">
                        <canvas this-year="{{ date('Y') }}"
                            this-month="{{ date('m') }}" id="visitors-chart" height="400"
                            width="100%" class="chartjs-render-monitor"
                            style="display: block; width: 249px; height: 400px;"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script src="{{ asset('backend/assets/js/chart-dashboard/chart.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/chart-dashboard/guestsChart.js') }}"></script>

@endpush
