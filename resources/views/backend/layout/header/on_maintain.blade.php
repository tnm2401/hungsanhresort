        <!-- Modal bao tri-->
        <div class="modal fade" id="popup_maintain" tabindex="-1" role="dialog" aria-labelledby="popup_maintain"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5>Thao tác này sẽ đưa website vào trạng thái bảo trì, khách hàng sẽ không thể truy cập !!!
                        </h5>
                        <form id="down_web" method="post" action="{{ route('down_web') }}">
                            @csrf
                            <input style="margin-bottom: 5px" class="form-control " type="text"
                                placeholder="Mật khẩu để kích hoạt website " id="pass" name="pass" required>
                            <small>Sau khi đưa website vào trạng thái bảo trì , chia sẽ website cho người khác bằng url
                                : <a href="">{{ url('/') }}/<span id="linkactive"></span> </a></small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fa fa-ban"></i> Hủy</button>
                        <button type="submit" class="btn btn-danger"> <i class="fa fa-triangle-exclamation"></i> Bảo
                            trì</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
        {{-- end modal --}}
