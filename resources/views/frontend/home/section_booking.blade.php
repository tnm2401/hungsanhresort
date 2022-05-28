<div class="banner__booking">
    <div class="container">
        <div class="booking-form">
            <form method="post" action="{{ route('frontend.checking.index') }}">
                @csrf
                <div class="row no-margin">
                    <div class="sTitleRp">Booking</div>
                    <div class="col-md-8">
                        <div class="row no-margin">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">{{ __('Ngày đến') }} <i
                                            class="fa-solid fa-plane-arrival"></i></span>
                                    <input id="from-date" name="from_date" class="form-control" type="text" value="{{  date("d-m-Y", strtotime(session('checking')['from_date'])) ??  now()->format('d-m-Y') }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">{{ __('Ngày đi') }} <i
                                            class="fa-solid fa-plane-departure"></i></span>
                                    <input id="to-date"  name="to_date" class="form-control" type="text" value="{{
                                   date("d-m-Y", strtotime(session('checking')['to_date'])) ?? now()->addDays(2)->format('d-m-Y') }}"
                                        required>
                                </div>
                            </div>
                            {{-- <div class="col-md-3 ">
                                <div class="form-group">
                                    <span class="form-label">{{ __('Đêm') }} </span>
                                    <select class="form-control" name="night">
                                        @for ($i = 1; $i < 10; $i++)
                                            <option {{ $i == 2 ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor

                                    </select>
                                    <span class="select-arrow"></span>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <span class="form-label">{{ __('Số phòng') }} </span>
                                    <select class="form-control" name="room">
                                            <option value="1">{{ __('Một phòng') }}</option>
                                            <option value="2">{{ __('Nhiều phòng') }}</option>
                                    </select>
                                    <span class="select-arrow"></span>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-btn">
                            <button type="submit" class="submit-btn">{{ __('Chọn phòng') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')

@endpush
