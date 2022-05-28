        <!-- Modal tat bao tri-->
        <div class="modal fade" id="popup_offmaintain" tabindex="-1" role="dialog" aria-labelledby="popup_offmaintain"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5>Thao tác này sẽ đưa website hoạt động , khách hàng sẽ có thể truy cập bình thường.
                        </h5>
                        <form id="up_web" method="post" action="{{ route('up_web') }}">
                            @csrf
                            <input style="margin-bottom: 5px" class="form-control " type="text"
                                placeholder="Mật khẩu để kích hoạt lại website " id="pass" name="pass" required>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fa fa-ban"></i> Hủy</button>
                        <button type="submit" class="btn btn-success"> <i class="fa-solid fa-bolt-lightning"></i> Kích hoạt</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
        {{-- end modal --}}
