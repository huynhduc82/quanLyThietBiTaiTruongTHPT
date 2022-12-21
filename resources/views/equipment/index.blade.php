@extends('layout.layout')

@section('title')
    Thiết bị
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <form role="form text-left" class="w-70" >
                <p>QUẢN LÝ THIẾT BỊ</p>
                <div class="mb-3">
                    <p>Mã Thiết bị</p>
                    <input type="text" class="form-control" placeholder="Mã Thiết bị" aria-label="Mã Thiết bị" >
                </div>

                <div class="mb-3">
                    <p>Tên thiết bị</p>
                    <input type="text" class="form-control" placeholder="Tên thiết bị" aria-label="Tên thiết bị" >
                </div>
                <div class="mb-3">
                    <p>Nhà sản xuất</p>
                    <input type="text" class="form-control" placeholder="Nhà sản xuất" aria-label="Nhà sản xuất" >
                </div>
                <div class="mb-3">
                    <p>Ngày nhập</p>
                    <input type="date" class="form-control" placeholder="Ngày nhập" aria-label="Ngày nhập" >
                </div>
                <div class="mb-3">
                    <p>Hạn sử dụng</p>
                    <input type="date" class="form-control" placeholder="Hạn sử dụng" aria-label="Hạn sử dụng" >
                </div>
                <div class="mb-3">
                    <p>Mã loại</p>
                    <input type="text" class="form-control" placeholder="Mã loại" aria-label="Mã loại" >
                </div>
                <div class="mb-3">
                    <p>Số lượng thiết bị</p>
                    <input type="number" class="form-control" placeholder="Số lượng thiết bị" aria-label="Số lượng thiết bị" >
                </div>
                <div class="mb-3">
                    <p>Hình</p>
                    <input type="image" class="form-control" placeholder="Số lượng thiết bị" aria-label="Số lượng thiết bị" >
                </div>
                <div class="text-center">
                    <button type="button" class="btn bg-gradient-info w-10 my-4 mb-2">Thêm</button>
                    <button type="button" class="btn bg-gradient-info w-10 my-4 mb-2">Sửa</button>
                    <button type="button" class="btn bg-gradient-info w-10 my-4 mb-2">Xóa</button>
                </div>
            </form>
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Thiết bị</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-20">Tên và hình ảnh</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-20 ps-2">Khối</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-20 ps-2">Môn học</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-20 ps-2">NXS</th>

                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tình trạng</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hạn sử dụng</th>
                                <th class="text-secondary opacity-7"></th>
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
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6> Mức độ sử dụng</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-20">Thiết bị</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-20 ps-2">Số lần mượn</th>
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
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">20</p>
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
        </div>
    </div>
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Thiết bị</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên và hình ảnh</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Số lượng</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Số lượng có thể mượn</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Đơn vị tính</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Giá</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mô tả</th>
                                </tr>
                                </thead>
                                @foreach($data as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{$item->imagesInfo->url}}" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$item->name}}</h6>
                                                <p class="text-xs text-secondary mb-0"></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$item->quantity}}</h6>
                                                <p class="text-xs text-secondary mb-0"></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$item->quantity_can_rent}}</h6>
                                                <p class="text-xs text-secondary mb-0"></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$item->unit}}</h6>
                                                <p class="text-xs text-secondary mb-0"></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$item->price}}</h6>
                                                <p class="text-xs text-secondary mb-0"></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$item->describe}}</h6>
                                                <p class="text-xs text-secondary mb-0"></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <div class="card mb-4">--}}
{{--                <div class="card-header pb-0">--}}
{{--                    <h6> Mức độ sử dụng</h6>--}}
{{--                </div>--}}
{{--                <div class="card-body px-0 pt-0 pb-2">--}}
{{--                    <div class="table-responsive p-0">--}}
{{--                        <table class="table align-items-center justify-content-center mb-0">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thiết bị</th>--}}
{{--                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Số lần mượn</th>--}}
{{--                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Số phần trăm</th>--}}
{{--                                <th></th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    <div class="d-flex px-2 py-1">--}}
{{--                                        <div>--}}
{{--                                            <img src="{{asset('assets/img/5.jpg')}}" class="avatar avatar-sm me-3" alt="user1">--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex flex-column justify-content-center">--}}
{{--                                            <h6 class="mb-0 text-sm">Ống nghiệm</h6>--}}
{{--                                            <p class="text-xs text-secondary mb-0"></p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <p class="text-sm font-weight-bold mb-0">20</p>--}}
{{--                                </td>--}}
{{--                                <td class="align-middle text-center">--}}
{{--                                    <div class="d-flex align-items-center justify-content-center">--}}
{{--                                        <span class="me-2 text-xs font-weight-bold">10%</span>--}}
{{--                                        <div>--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 10%;"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td class="align-middle">--}}
{{--                                    <button class="btn btn-link text-secondary mb-0">--}}
{{--                                        <i class="fa fa-ellipsis-v text-xs"></i>--}}
{{--                                    </button>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <footer class="footer pt-3  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Giới thiệu</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.facebook.com/huynhphat9286" class="nav-link pe-0 text-muted" target="_blank">Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    @endsection

@section('footer_scripts')

<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="{{asset('https://buttons.github.io/buttons.js')}}"></script>
@endsection
