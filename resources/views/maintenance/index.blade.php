@extends('layout.layout')

@section('title')
    Sữa chửa thiết bị
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h2>Sữa chữa thiết bị</h2>
                    </div>
                    <div class="row px-4 py-2">
                        <div class="col-5">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search z-index-0"
                                                                            aria-hidden="true"></i></span>
                                <input type="text" class="form-control" placeholder="Nhập tìm kiếm...">
                            </div>
                        </div>
                        <div class="col-5">
                            @role('SuperAdmin|admin|manage|teacher')
                                <a href="{{ route('maintenance.store') }}" type="button" class="btn bg-gradient-info">Báo hỏng thiết bị</a>
                            @endrole
                        </div>
                    </div>
                    <div class="px-4 py-0 w-60">
                        <form id="frm-filter" action="{{ route('reservation.filter') }}" method="GET">
                            <div class="border border-info rounded p-2 pb-3 row">
                                <div class="col-3">
                                    <label class="col-form-label" for="day_from">Từ ngày</label>
                                    <label for="day_from"></label><input type="date" class="form-control" name="day_from" id="day_from">
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label" for="day_to">Tới ngày</label>
                                    <input type="date" class="form-control" name="day_to" id="day_to">
                                </div>
                                <div class="col-3" style="margin: auto 0">
                                    <div class="form-switch">
                                        <input class="form-check-input" type="checkbox" id="chkNew" name="new">
                                        <label class="col-form-label p-0" for="flexSwitchCheckDefault">Mới</label>
                                    </div>
                                    <div class="form-switch">
                                        <input class="form-check-input" type="checkbox" id="chkCancel" name="cancel">
                                        <label class="col-form-label p-0" for="flexSwitchCheckDefault">Đã Huỷ</label>
                                    </div>
                                    <div class="form-switch">
                                        <input class="form-check-input" type="checkbox" id="chkApproved" name="approved">
                                        <label class="col-form-label p-0" for="flexSwitchCheckDefault">Đã duyệt</label>
                                    </div>
                                </div>
                                <div class="col-1" style="margin: auto 0">
                                    <button type="submit" class="btn bg-gradient-info mb-0">Lọc</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0 ">
                            <table class="table mb-0 w-100" id="equipment-table">
                                <thead>
                                @if(!empty($data))
                                    <tr class="d-block">
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-15 px-3 py-2 pt-3">
                                            Người báo hỏng
                                        </th>
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-10 p-2 pt-3">
                                            Thời gian báo hỏng
                                        </th>
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-15 p-2 pt-3">
                                            Người sửa chữa
                                        </th>
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-10 p-2 pt-3">
                                            Thời gian sửa chữa
                                        </th>
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-10 p-2 pt-3">
                                            Trạng thái
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-15 pt-3">
                                        </th>
                                    </tr>
                                @endif
                                </thead>
                                <tbody>
                                @if(!empty($data))
                                    @foreach($data as $item)
                                        <tr class="d-block">
                                            <td class="text-wrap accordion-toggle w-15" data-bs-toggle="collapse"
                                                data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                                <div class="d-block">
                                                    <div class="d-block flex-column justify-content-center text-center">
                                                        <h6 class="mb-0 text-sm">{{$item->user ? $item->user->name : ''}}</h6>
                                                        <p class="text-xs text-secondary mb-0"></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="accordion-toggle w-10" data-bs-toggle="collapse"
                                                data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                                <div class="d-block">
                                                    <div class="d-flex flex-column justify-content-center text-center">
                                                        <h6 class="mb-0 text-sm">{{$item->created_at}}</h6>
                                                        <p class="text-xs text-secondary mb-0"></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="accordion-toggle w-15" data-bs-toggle="collapse"
                                                data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                                <div class="d-block">
                                                    <div class="d-block flex-column justify-content-center text-center">
                                                        <h6 class="mb-0 text-sm">{{$item->maintenancer ? $item->maintenancer->name : 'Chưa sữa chửa'}}</h6>
                                                        <p class="text-xs text-secondary mb-0"></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="accordion-toggle w-10" data-bs-toggle="collapse"
                                                data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                                <div class="d-block">
                                                    <div class="d-flex justify-content-center text-center">
                                                        <h6 class="mb-0 text-sm">{{$item->maintenance_time ?? 'Chưa sữa chửa'}}</h6>
                                                        <p class="text-xs text-secondary mb-0"></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="accordion-toggle w-10" data-bs-toggle="collapse"
                                                data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                                <div class="d-block">
                                                    <div class="d-flex justify-content-center">
                                                        <h6 class="mb-0 text-sm"> @if($item->status == 1) Mới @else @if($item->status == 2) Đã Huỷ @else @if($item->status == 4) Đã sửa xong @else Đang sửa chữa @endif @endif @endif </h6>
                                                        <p class="text-xs text-secondary mb-0"></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-15">
                                                <div class="d-block">
                                                    <div class="d-flex justify-content-center">
                                                        @if($item->status == 1)
                                                            @role('SuperAdmin|admin|maintainer')
                                                            <button  class="btn bg-gradient-danger my-1 mb-1 ms-1" onclick="StartMaintenanceConfirm({{$item->id}})">
                                                                Sửa Chữa
                                                            </button>
                                                            @endrole
                                                            @role('SuperAdmin|admin|manage')
                                                            <button class="btn bg-gradient-danger my-1 mb-1 ms-1" onclick="CancelConfirm({{$item->id}})">
                                                                Huỷ
                                                            </button>
                                                            @endrole
                                                        @else
                                                            @if($item->status != 3 )
                                                                @role('SuperAdmin|admin|manage')
                                                                <button type="button" class="btn bg-gradient-danger my-1 mb-1 ms-1" onclick="DeleteConfirm({{$item->id}})">
                                                                    Xoá
                                                                </button>
                                                                @endrole
                                                            @else
                                                                @role('SuperAdmin|admin|maintainer')
                                                                <button type="button" class="btn bg-gradient-danger my-1 mb-1 ms-1" onclick="EndMaintenanceConfirm({{$item->id}})">
                                                                    Hoàn tất
                                                                </button>
                                                                @endrole
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" class="hiddenRow">
                                                <div class="accordion-body collapse" id="demo{{ $item->id }}"
                                                     style="height: 0" aria-expanded="false">
                                                    <table class="table mb-0">
                                                        @if(!empty($item->details[0]))
                                                            <thead>
                                                            <tr class="d-flex px-4">
                                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-20">
                                                                    Tên thiết bị
                                                                </th>
                                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-20">
                                                                    Chi tiết trình trạng
                                                                </th>
                                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-20">
                                                                    Phòng
                                                                </th>
                                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-20">
                                                                    Số lần sửa chữa
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                        @endif
                                                        <tbody>
                                                        @foreach($item->details as $details)
                                                            <tr class="d-flex px-3">
                                                                <td class="w-20 text-wrap">
                                                                    <div class="d-flex px-4 py-1">
                                                                        <div
                                                                            class="d-flex flex-column justify-content-center">
                                                                            <h6 class="mb-0 text-sm">{{$details->equipments->name}}</h6>
                                                                            <p class="text-xs text-secondary mb-0"></p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="w-20 text-wrap">
                                                                    <div class="d-flex px-4 py-1">
                                                                        <div
                                                                            class="d-flex flex-column justify-content-center">
                                                                            <h6 class="mb-0 text-sm">{{$details->equipments->status->condition_details}}</h6>
                                                                            <p class="text-xs text-secondary mb-0"></p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="w-20 text-wrap">
                                                                    <div class="d-flex px-3 py-1">
                                                                        <div
                                                                            class="d-flex flex-column justify-content-center">
                                                                            <h6 class="mb-0 text-sm">{{$details->equipments->room->name}}</h6>
                                                                            <p class="text-xs text-secondary mb-0"></p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="w-20 text-wrap">
                                                                    <div class="d-flex px-4 py-1">
                                                                        <div
                                                                            class="d-flex flex-column justify-content-center">
                                                                            <h6 class="mb-0 text-sm">{{$details->equipments->status->number_of_repairs}}</h6>
                                                                            <p class="text-xs text-secondary mb-0"></p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{--                    {!! $data->links('layout.paginate') !!}--}}
                </div>
            </div>
        </div>
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Giới
                                    thiệu</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.facebook.com/huynhphat9286" class="nav-link pe-0 text-muted"
                                   target="_blank">Liên hệ</a>
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
            <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                var win = navigator.platform.indexOf('Win') > -1;
                if (win && document.querySelector('#sidenav-scrollbar')) {
                    var options = {
                        damping: '0.5'
                    }
                    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
                }
            </script>
            <script>
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                let DeleteConfirm = (id) => {
                    let url = '/maintenance/delete/' + id
                    swalWithBootstrapButtons.fire({
                        title: 'Bạn có chắc không?',
                        text: "Bạn không thể khôi phục lại phiếu báo hỏng đã xoá!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Có, Hãy xoá đi!',
                        cancelButtonText: 'Không, Huỷ bỏ!',
                        reverseButtons: true,
                        backdrop: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                // dataType: 'json',
                                enctype: "multipart/form-data",
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function () {
                                    swalWithBootstrapButtons.fire({
                                        title: 'Đã xoá!',
                                        text: "Bạn đã xoá thành công phiếu báo hỏng",
                                        icon: 'success',
                                        backdrop: false,
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    })
                                },
                                error: function (error) {
                                },
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            })

                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire({
                                title: 'Đã huỷ',
                                text: 'Phiếu báo hỏng của bạn đã an toàn :)',
                                icon: 'error',
                                backdrop: false,
                            })
                        }
                    })
                };

                let CancelConfirm = (id) => {
                    let url = '/maintenance/cancel/' + id
                    swalWithBootstrapButtons.fire({
                        title: 'Bạn có chắc không?',
                        text: "Bạn chắc chắn muốn huỷ phiếu báo hỏng này?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Có, Hãy huỷ đi!',
                        cancelButtonText: 'Không, Huỷ bỏ!',
                        reverseButtons: true,
                        backdrop: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                // dataType: 'json',
                                enctype: "multipart/form-data",
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function () {
                                    swalWithBootstrapButtons.fire({
                                        title: 'Đã huỷ!',
                                        text: "Bạn đã huỷ thành công phiếu báo hỏng",
                                        icon: 'success',
                                        backdrop: false,
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    })
                                },
                                error: function (error) {
                                },
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            })

                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire({
                                title: 'Đã huỷ',
                                text: 'Phiếu báo hỏng của bạn đã an toàn :)',
                                icon: 'error',
                                backdrop: false,
                            })
                        }
                    })
                };

                let StartMaintenanceConfirm = (id) => {
                    let url = '/maintenance/start/' + id
                    swalWithBootstrapButtons.fire({
                        title: 'Bạn có chắc không?',
                        text: "Bạn có chắc là muốn sửa chữa phiếu báo hỏng này không?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Có, Tôi muốn sửa chữa!',
                        cancelButtonText: 'Không, Huỷ bỏ!',
                        reverseButtons: true,
                        backdrop: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                // dataType: 'json',
                                enctype: "multipart/form-data",
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function () {
                                    swalWithBootstrapButtons.fire({
                                        title: 'Đã đồng ý!',
                                        text: "Bạn đang sửa chữa phiếu báo hỏng này",
                                        icon: 'success',
                                        backdrop: false,
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    })
                                },
                                error: function (error) {
                                },
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            })

                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire({
                                title: 'Đã huỷ',
                                text: 'Bạn chưa sửa chữa phiếu báo hỏng này!',
                                icon: 'error',
                                backdrop: false,
                            })
                        }
                    })
                };

                var EndMaintenanceConfirm = (id) => {
                    let url = '/maintenance/end/' + id
                    swalWithBootstrapButtons.fire({
                        title: 'Bạn có chắc không?',
                        text: "Bạn chắc chắn là đã sửa chữa xong phiếu báo hỏng này không?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Có, Tôi đã hoàn thành!',
                        cancelButtonText: 'Không, Huỷ bỏ!',
                        reverseButtons: true,
                        backdrop: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                // dataType: 'json',
                                enctype: "multipart/form-data",
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function () {
                                    swalWithBootstrapButtons.fire({
                                        title: 'Đã hoàn thành!',
                                        text: "Bạn đã sữa chửa xong phiếu báo hỏng này",
                                        icon: 'success',
                                        backdrop: false,
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    })
                                },
                                error: function (error) {
                                },
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            })

                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire({
                                title: 'Đã huỷ',
                                text: 'Phiếu báo hỏng chưa được sửa chữa xong!',
                                icon: 'error',
                                backdrop: false,
                            })
                        }
                    })
                };
            </script>
            <script>
                $(document).ready(function () {
                    let urlToCheck = document.URL.toString();
                    let urlNew = urlToCheck.includes("new");
                    let cancel = urlToCheck.includes("cancel");
                    let approved = urlToCheck.includes("approved");
                    if (urlNew){
                        $('#chkNew').prop('checked', true);
                    }
                    if (cancel){
                        $('#chkCancel').prop('checked', true);
                    }
                    if (approved){
                        $('#chkApproved').prop('checked', true);
                    }
                })
            </script>
            <script>
                document.getElementById('title-first').innerText = 'Mượn trả'
                document.getElementById('title-second').innerText = 'Danh sách mượn trả'
            </script>
@endsection
