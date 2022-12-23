@extends('layout.layout')

@section('title')
    Thiết bị
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h2>Thiết bị</h2>
                    </div>
                    <div class="row px-4 py-2">
                        <div class="col-5">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search"
                                                                            aria-hidden="true"></i></span>
                                <input type="text" class="form-control" placeholder="Nhập tìm kiếm...">
                            </div>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('equipment.store') }}" type="button" class="btn bg-gradient-info">Thêm
                                mới</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr class="d-flex">
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-30">
                                        Tên và hình ảnh
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-6">
                                        Số lượng
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-9 text-wrap">
                                        Số lượng có thể mượn
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-6">
                                        Đơn vị tính
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-10">
                                        Giá
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-25">
                                        Mô tả
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-10 text-wrap"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr class="d-flex">
                                        <td class="text-wrap w-30 accordion-toggle" data-bs-toggle="collapse"
                                            data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{$item->imagesInfo ? $item->imagesInfo->url : null}}"
                                                         class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->name}}</h6>
                                                    <p class="text-xs text-secondary mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-6 accordion-toggle" data-bs-toggle="collapse"
                                            data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->quantity}}</h6>
                                                    <p class="text-xs text-secondary mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-9 accordion-toggle" data-bs-toggle="collapse"
                                            data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->quantity_can_rent}}</h6>
                                                    <p class="text-xs text-secondary mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-6 accordion-toggle" data-bs-toggle="collapse"
                                            data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->unit}}</h6>
                                                    <p class="text-xs text-secondary mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-10 accordion-toggle" data-bs-toggle="collapse"
                                            data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->price}}</h6>
                                                    <p class="text-xs text-secondary mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-25 text-wrap accordion-toggle" data-bs-toggle="collapse"
                                            data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->describe}}</h6>
                                                    <p class="text-xs text-secondary mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-10">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex justify-content-center">
                                                    <a type="button"
                                                       href="{{ route('equipment.edit', ['id' => $item->id]) }}"
                                                       class="btn bg-gradient-info my-1 mb-1 ms-1">Sửa</a>
                                                    <button type="button" class="btn bg-gradient-danger my-1 mb-1 ms-1"
                                                            onclick="DeleteConfirm('{{route('equipment.delete', ['id' => $item->id])}}')">
                                                        Xoá
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="12" class="hiddenRow">
                                            <div class="accordion-body collapse" id="demo{{ $item->id }}"
                                                 style="height: 0" aria-expanded="false">
                                                <table class="table align-items-center mb-0">
                                                    @if(!empty($item->equipments[0]))
                                                    <thead>
                                                    <tr class="d-flex px-3">
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-20">
                                                            Tên thiết bị
                                                        </th>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-20">
                                                            Phòng
                                                        </th>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-20">
                                                            Tình trạng
                                                        </th>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-20">
                                                            Trạng thái
                                                        </th>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-20"></th>
                                                    </tr>
                                                    </thead>
                                                    @endif
                                                    <tbody>
                                                    @foreach($item->equipments as $equipment)
                                                        <tr class="d-flex">
                                                            <td class="w-20 text-wrap">
                                                                <div class="d-flex px-4 py-1">
                                                                    <div
                                                                        class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm">{{$equipment->name}}</h6>
                                                                        <p class="text-xs text-secondary mb-0"></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="w-20 text-wrap">
                                                                <div class="d-flex px-4 py-1">
                                                                    <div
                                                                        class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm">{{$equipment->room->name ?? 'Chưa phân bổ'}}</h6>
                                                                        <p class="text-xs text-secondary mb-0"></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="w-20 text-wrap">
                                                                <div class="d-flex px-4 py-1">
                                                                    <div
                                                                        class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm">{{$equipment->status->condition_details}}</h6>
                                                                        <p class="text-xs text-secondary mb-0"></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="w-20 text-wrap">
                                                                <div class="d-flex px-4 py-1">
                                                                    <div
                                                                        class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm">{{$equipment->can_rent != 1 ? 'Đang cho mượn' : 'Có thể mượn' }}</h6>
                                                                        <p class="text-xs text-secondary mb-0"></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="w-20">
                                                                <div class="d-flex px-2 py-1">
                                                                    <div class="d-flex justify-content-center">
                                                                        <a type="button"
                                                                           href="{{ route('equipment_details.edit', ['id' => $equipment->id]) }}"
                                                                           class="btn bg-gradient-info my-1 mb-1 ms-1">Sửa</a>
                                                                        <button type="button"
                                                                                class="btn bg-gradient-danger my-1 mb-1 ms-1"
                                                                                onclick="DeleteConfirm('{{route('equipment_details.delete', ['id' => $equipment->id])}}')">
                                                                            Xoá
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <div class="pt-3 px-5">
                                                        <a href="{{ route('equipment_details.store', ['id' => $item->id]) }}" type="button"
                                                           class="btn bg-gradient-info">Thêm mới</a>
                                                    </div>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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

                var DeleteConfirm = (url) => {
                    swalWithBootstrapButtons.fire({
                        title: 'Bạn có chắc không?',
                        text: "Bạn không thể khôi phục lại thiết bị đã xoá!",
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
                                        text: "Thiết bị của bạn đã xoá.",
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
                                text: 'Thiết bị của bạn đã an toàn :)',
                                icon: 'error',
                                backdrop: false,
                            })
                        }
                    })
                };
            </script>
            <!-- Github buttons -->
            <script async defer src="{{asset('https://buttons.github.io/buttons.js')}}"></script>
@endsection
