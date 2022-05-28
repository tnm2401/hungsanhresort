@extends('frontend.layout.master')
@section('content')
    <div class="banner_share list-tours banner-service" id="guest">
        <img src="{{ asset('storage') }}/uploads/pages/{{ $page->img }}" alt="{{ $page->translations->name }}">
        <div class="container">
            <div class="title">
                <h2>{{ $page->translations->name }}</h2>
            </div>
        </div>
    </div>
    <main>
        <div class="list_posts">
            <div class="container">
                <div class="row">
                    <div class="col col-12 col-md-12">
                        <div class="row">
                            @forelse ($room as $p)
                                <div class="col-xl-3 col-lg-3 col-md-2 col-sm-12 col-12 mb-5">
                                    <div class="wrap-room-pages-contents text-center">
                                        <div class="room-pages-image">
                                            @if ($p->img != 'placeholder.png')
                                            <img src="{{ imageUrl('/storage/uploads/'.$p->code.'/'.$p->img,'400','200','100','1') }}"
                                                alt="{{ $p->translations->name }}" loading="lazy" style="background-image: none;">
                                                @else
                                                <img src="{{ imageUrl('/storage/uploads/placeholder.png','400','200','100','1') }}"
                                                alt="{{ $p->translations->name }}" loading="lazy" style="background-image: none;">
                                            @endif
                                            <div class="room-pages-home__link mt-3">
                                                <button class="book-room-now" data-toggle="modal"
                                                data-target="#exampleModalCenter">
                                                    <a href="#" onclick="return false">{{ __('Đặt ngay') }}</a>
                                                </button>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="room-pages-contents">
                                            <h3  class="room-pages-contents__desc">
                                                <span>{{ $p->procatone->translations->name }} - {{ $p->code }}</span>
                                            </h3>
                                            @if($p->procatone->discount > 0)
                                            <s><i>{{ number_format($p->procatone->price) }} đ</i></s>
                                            @endif
                                            <div class="room-pages-contents__title">
                                                <div style="color: rgb(240, 82, 82)">
                                                    @if($p->procatone->discount <= 0)
                                            <span>{{ number_format($p->procatone->price) }} đ / {{ __('Đêm') }}</span>
                                            @else
                                            <span>{{ number_format($p->procatone->selling_price) }} đ / {{ __('Đêm') }}</span>
                                            @endif
                                                </div>
                                            </div>
                                            <div class="room-pages-contents__desc">
                                                <small>{{ $p->bed }} {{ __('Giường') }} - {{ $p->person }} {{ __('Người') }} - {{ $p->cover }} m<sup>2</sup></small>
                                            </div>
                                            <!-- star-rating -->
                                            <div class="room__rate ">
                                                <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                        <!--  -->
                                    </div>
                                </div>
                            @empty
                                <p style="color: white"><i>Không có bài viết nào</i></p>
                            @endforelse

                        </div>
                    </div>
                    {{-- <div class="col col-12 col-md-3">
                        {!! $room->links('pagination::bootstrap-4') !!}
                    </div> --}}
                </div>
            </div>
        </div>
          <!-- Modal -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">{{ __('KIỂM TRA TÌNH TRẠNG PHÒNG') }}</h5>

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="post" action="{{ route('frontend.checking.index') }}">
                          @csrf
                          <div class="row ">
                              <div class="col-md-12 ">
                                  <div class="form-group">
                                      <span class="form-label">{{ __('Ngày đến') }} <i
                                              class="fa-solid fa-plane-arrival"></i></span>
                                              @if(session('checking'))
                                      <input type="date"  name="from_date" class="form-control" type="text"
                                          value="{{ date('d-m-Y', strtotime(session('checking')['from_date'])) }}"
                                          required>
                                          @else
                                            <input type="date"  name="from_date" class="form-control" type="text"
                                            value="{{ now()->format('d-m-Y') }}"
                                            required>
                                          @endif
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <span class="form-label">{{ __('Ngày đi') }} <i
                                              class="fa-solid fa-plane-departure"></i></span>
                                              @if(session('checking'))
                                      <input type="date" name="to_date" class="form-control" type="text"
                                          value="{{ date('d-m-Y', strtotime(session('checking')['to_date'])) }}"
                                          required>
                                          @else
                                            <input type="date"  name="to_date" class="form-control" type="text"
                                            value="{{ now()->addDays(2)->format('d-m-Y') }}"
                                            required>
                                          @endif
                                  </div>
                              </div>
                              {{-- <div class="col-md-12">
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
                  <div class="modal-footer">
                      {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button> --}}
                      <button type="submit" style="border: none" class="book-room-now2">Kiểm tra</button>
                  </div>
              </form>

              </div>
          </div>
      </div>
    </main>
@endsection
