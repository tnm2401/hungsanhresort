    <div class="col-md-6 ">
        <div class="row">
                  <h4>SƠ ĐỒ PHÒNG HÔM NAY </h4>
          <small style="color: #00a65a">(*Click vào phòng để xem chi tiết)</small>
        </div>
        <div class="text-center mb-2">
            <b>Chú thích :</b>
            <button class="btn bg-yes mr-1"> Đang thuê </button>
            <button class="btn bg-no"> Còn phòng </button>
        </div>

        <div class="row box-room">
            @foreach ($data['room_all'] as $r)
                <div class="col-md-3 col-sm-3 col-xs-3  mb-2">
                    @if ($r->order != null)
                        <a href="{{ route('backend.cart.edit', $r->order ?? '') }}">
                        @else
                            <a href="javascript:void(0)">
                    @endif
                    <div class="room {{ $r->hide_show == 0 ? 'bg-yes' : 'bg-no' }}">
                        <span>
                            PHÒNG {{ $r->code ?? '' }}
                        </span>
                    </div>
                    </a>

                </div>
            @endforeach
        </div>

    </div>
    @push('style')
        <style>
            .dot-line {
                width: auto;
                border: 3px solid #00a65a;
                border-left: none;
                border-right: none;
                border-top: none;
            }

            .box-room {
                border: 3px solid #00a65a;
                border-top: none;
            }

            .mb-2 {
                margin-bottom: 20px;
            }

            .room {
                width: 100%;
                border: 1px solid rgb(175, 175, 175);
                text-align: center;
                border-radius: 5px;
            }

            .room span {
                text-transform: uppercase;
                color: black;
                line-height: 50px;
            }

            .bg-yes {
                background-color: #00c0ef;
                color: white;

            }

            .bg-yes span {
                color: white;
            }

            .bg-no {
                background-color: #dcd7d7;
            }



            .box-yes {
                width: 20px;
                height: 20px;
                background: #00c0ef;
                margin-left: 5px;
                margin-right: 5px;
                color: white;
            }

            .box-no {
                width: 20px;
                height: 20px;
                background: #dcd7d7;
                margin-left: 5px;
                margin-right: 5px;
            }

            .mr-1 {
                margin-right: 10px;
            }

        </style>
    @endpush
