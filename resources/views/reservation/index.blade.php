@extends('layout.layout')

@section('title')
    Đặt trước thiết bị
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="card w-50 col-4">
                <div class="card-header pb-2">
                    <h3>Quản lý thông tin đặt trước</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form id="frm-equipment">
                        <div class="form-group px-4">
                            <div class="col-9">
                                <label class="col-form-label">Tên Lớp Học</label>
                                <input type="text" class="form-control" placeholder="Nhập tên Lớp học" id="describe">
                            </div>
                        </div>
                        <div class="form-group px-4">
                            <div class="col-9">
                                <label class="col-form-label">Tên Phòng Học</label>
                                <input type="text" class="form-control" placeholder="Nhập Tên Phòng Học" id ="unit">
                            </div>
                        </div>
                        <div class="form-group px-4">
                            <div class="col-9">
                                <label class="col-form-label">Thông Tin Giáo Viên Mượn </label>
                                <input type="text" class="form-control" placeholder="Nhập Mã Giáo Viên" id="price">
                                <input type="text" class="form-control" placeholder="Nhập Tên Giáo Viên" id="price">
                            </div>
                        </div>
                        <div class="form-group px-4">
                            <div class="col-9">
                                <label class="col-form-label">Thời Gian Mượn </label>
                                <input type="text" class="form-control" placeholder="Nhập Thời Gian Mượn" id="price">
                            </div>
                        </div>
                        <div class="form-group px-4">
                            <div class="col-9">
                                <label class="col-form-label">Thời Gian Trả Dự Kiến </label>
                                <input type="text" class="form-control" placeholder="Nhập Thời Gian Dự Kiến" id="price">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center py-1 col-9">
                            <button type="submit" class="btn bg-gradient-info my-4 mb-2">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-6">
                <div class="row px-2 py-2">
                    <div class="card w-100 col-4">
                        <div class="card-header pb-2">
                            <h3>Thông tin thiết bị đặt trước</h3>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <form id="frm-equipment">
                                <div class="form-group px-4">
                                    <div class="col-9">
                                        <label class="col-form-label">Tên Thiết Bị</label>
                                        <input type="text" class="form-control" placeholder="Nhập Tên Thiết Bị" id="price">
                                    </div>
                                </div>
                                <div class="form-group px-4">
                                    <div class="col-9">
                                        <label class="col-form-label">Số Lượng Học Sinh</label>
                                        <input type="text" class="form-control" placeholder="Nhập Số Lượng Học Sinh" id="price">
                                    </div>
                                </div>
                                <div class="form-group px-4">
                                    <div class="col-9">
                                        <label class="col-form-label">Số Lượng Thiết Bị Mượn</label>
                                        <input type="text" class="form-control" placeholder="Nhập Số Lượngg Thiết Bị" id="price">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center py-1 col-9">
                                    <button type="submit" class="btn bg-gradient-info my-4 mb-2">Thêm</button>
                                </div>


                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h4>Danh sách thiết bị đặt trước </h4>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-20">Tên Thiết Bị </th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-20">Số lượng</th>

                                </tr>
                                </thead>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../assets/img/5.jpg" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Ống nghiệm</h6>
                                                <p class="text-xs text-secondary mb-0"></p>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-20 ps-2" style="text-align: end;">
                                        <button class="btn btn-link text-secondary mb-0">
                                            <i class="fa fa-ellipsis-v text-xs"> Xem chi tiết</i>
                                        </button>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>

                </div>
            @endsection

            @section('footer_scripts')
                <!--   Core JS Files   -->
                    <script src="{{ asset('assets/js/core/popper.min.js')}}"></script>
                    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
                    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
                    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
                    <script>
                        let win = navigator.platform.indexOf('Win') > -1;
                        if (win && document.querySelector('#sidenav-scrollbar')) {
                            let options = {
                                damping: '0.5'
                            }
                            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
                        }
                    </script>
                    <!-- Github buttons -->
                    <script async defer src="{{asset('https://buttons.github.io/buttons.js')}}"></script>
@endsection


