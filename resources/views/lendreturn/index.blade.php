@extends('layout.layout')

@section('title')
    Mượn trả thiết bị
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h2>Mượn trả thiết bị</h2>
                    </div>
                    <div class="row px-4 py-2">
                        <div class="col-5">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search"
                                                                            aria-hidden="true"></i></span>
                                <input type="text" class="form-control" placeholder="Nhập tìm kiếm...">
                            </div>
                        </div>
                        <div class="col-5">
                            <a href="{{ route('lend_return.store') }}" type="button" class="btn bg-gradient-info">Mượn
                                thiết bị</a>
                        </div>
                    </div>
                    <div class="px-4 py-0 w-70">
                        <form id="frm-filter">
                            <div class="border border-info rounded p-2 pb-3 row">
                                <div class="col-5">
                                    <label class="col-form-label" for="day_from">Từ ngày</label>
                                    <label for="day_from"></label><input type="date" class="form-control" id="day_from">
                                </div>
                                <div class="col-5">
                                    <label class="col-form-label" for="day_to">Tới ngày</label>
                                    <input type="date" class="form-control" id="day_to">
                                </div>
                                <div class="col-2" style="text-align: center; margin: auto 0">
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
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-10 px-3 py-2 pt-3">
                                            Người mượn
                                        </th>
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-11 p-2 pt-3">
                                            Thời gian mượn
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-10 p-2 pt-3">
                                            Nhân viên cho mượn
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-10 p-2 pt-3">
                                            Nhân viên nhận trả
                                        </th>
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-11 p-2 pt-3">
                                            Thời gian trả dự kiến
                                        </th>
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-11 p-2 pt-3">
                                            Thời gian trả
                                        </th>
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-10 p-2 pt-3">
                                            Phòng
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-12 pt-3">
                                        </th>
                                    </tr>
                                @endif
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr class="d-block">
                                        <td class="text-wrap accordion-toggle w-10" data-bs-toggle="collapse"
                                            data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                            <div class="d-block">
                                                <div class="d-block justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->user->name}}</h6>
                                                    <p class="text-xs text-secondary mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="accordion-toggle w-11" data-bs-toggle="collapse"
                                            data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                            <div class="d-block">
                                                <div class="d-flex flex-column justify-content-center text-center">
                                                    <h6 class="mb-0 text-sm">{{$item->pick_up_time}}</h6>
                                                    <p class="text-xs text-secondary mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="accordion-toggle w-10" data-bs-toggle="collapse"
                                            data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                            <div class="d-block">
                                                <div class="d-block flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->lender->name}}</h6>
                                                    <p class="text-xs text-secondary mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="accordion-toggle w-10" data-bs-toggle="collapse"
                                            data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                            <div class="d-block">
                                                <div class="d-flex justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->returner ? $item->returner->name : 'Chưa trả'}}</h6>
                                                    <p class="text-xs text-secondary mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="accordion-toggle w-11" data-bs-toggle="collapse"
                                            data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                            <div class="d-block">
                                                <div class="d-flex justify-content-center text-center">
                                                    <h6 class="mb-0 text-sm">{{$item->return_appointment_time}}</h6>
                                                    <p class="text-xs text-secondary mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-wrap accordion-toggle w-11" data-bs-toggle="collapse"
                                            data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                            <div class="d-block align-text-center">
                                                <div class="d-flex justify-content-center text-center">
                                                    <h6 class="mb-0 text-sm">{{$item->return_time ?? 'Chưa trả' }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-wrap accordion-toggle w-10" data-bs-toggle="collapse"
                                            data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                                            <div class="d-block align-text-center">
                                                <div class="d-flex justify-content-center text-center">
                                                    <h6 class="mb-0 text-sm">{{$item->room ?? 'Ngoài trời' }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-12">
                                            <div class="d-block">
                                                <div class="d-flex justify-content-center">
                                                    <a type="button"
                                                       href="{{ route('equipment.edit', ['id' => $item->id]) }}"
                                                       class="btn bg-gradient-info my-1 mb-1">Sửa</a>
                                                    <button type="button" class="btn bg-gradient-danger my-1 mb-1 ms-1"
                                                            onclick="DeleteConfirm('{{route('equipment.delete', ['id' => $item->id])}}')">
                                                        Trả
                                                    </button>
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
                                                    @foreach($item as $equipment)
                                                        <tr class="d-flex">
                                                            <td class="w-20 text-wrap">
                                                                <div class="d-flex px-4 py-1">
                                                                    <div
                                                                        class="d-flex flex-column justify-content-center">
{{--                                                                        <h6 class="mb-0 text-sm">{{$equipment->name}}</h6>--}}
                                                                        <p class="text-xs text-secondary mb-0"></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="w-20 text-wrap">
                                                                <div class="d-flex px-4 py-1">
                                                                    <div
                                                                        class="d-flex flex-column justify-content-center">
{{--                                                                        <h6 class="mb-0 text-sm">{{$equipment->room->name ?? 'Chưa phân bổ'}}</h6>--}}
                                                                        <p class="text-xs text-secondary mb-0"></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="w-20 text-wrap">
                                                                <div class="d-flex px-4 py-1">
                                                                    <div
                                                                        class="d-flex flex-column justify-content-center">
{{--                                                                        <h6 class="mb-0 text-sm">{{$equipment->status->condition_details}}</h6>--}}
                                                                        <p class="text-xs text-secondary mb-0"></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="w-20 text-wrap">
                                                                <div class="d-flex px-4 py-1">
                                                                    <div
                                                                        class="d-flex flex-column justify-content-center">
{{--                                                                        <h6 class="mb-0 text-sm">{{$equipment->can_rent != 1 ? 'Đang cho mượn' : 'Có thể mượn' }}</h6>--}}
                                                                        <p class="text-xs text-secondary mb-0"></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="w-20">
                                                                <div class="d-flex px-2 py-1">
                                                                    <div class="d-flex justify-content-center">
                                                                        <a type="button"
{{--                                                                           href="{{ route('equipment_details.edit', ['id' => $equipment->id]) }}"--}}
                                                                           class="btn bg-gradient-info my-1 mb-1 ms-1">Sửa</a>
                                                                        <button type="button"
                                                                                class="btn bg-gradient-danger my-1 mb-1 ms-1">
{{--                                                                                onclick="DeleteConfirm('{{route('equipment_details.delete', ['id' => $equipment->id])}}')">--}}
{{--                                                                            Xoá--}}
                                                                        </button>
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
        <script>
            $('#frm-filter').on('submit', function (e) {
                e.preventDefault();
                let dayFrom = $('#day_from').val();
                let dayTo = $('#day_to').val();

                $.ajax({
                    url: '/lend_return/by/day',
                    data: {
                        day_from : dayFrom,
                        day_to : dayTo,
                    },
                    success: function (data) {
                        $('#equipment-table').html(data.table_view)
                    },
                    error: function (error) {
                        $('#label-error').text(error.responseJSON.message);
                    },
                    type: 'GET',
                });
            })
        </script>
        <script>
            document.getElementById('title-first').innerText = 'Mượn trả'
            document.getElementById('title-second').innerText = 'Danh sách mượn trả'
        </script>
@endsection
