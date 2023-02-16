@extends('layout.layout')

@section('title')
    Quản lý phòng học
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h2>Quản lý phòng học</h2>
                    </div>
                    <form id="frm-filter" action="{{ route('room.search-by-name') }}" method="GET">
                        <div class="row px-4 py-2">
                            <div class="col-5">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-outline-secondary m-0 p-0" type="button" id="btnSearch"><span class="input-group-text border-0 text-body z-index-0"><i class="fas fa-search" aria-hidden="true"></i></span></button>
                                    <input type="text" class="form-control px-2" placeholder="Nhập tìm kiếm..." aria-label="Nhập tìm kiếm..." aria-describedby="btnSearch" id="inputSearch" name="key">
                                </div>
                            </div>
                    </form>
                        <div class="col-5">
                            @role('SuperAdmin|admin|manage')
                            <a href="{{ route('room.store') }}" type="button" class="btn bg-gradient-info">Thêm
                                mới</a>
{{--                            <button class="btn bg-gradient-info mx-2"--}}
{{--                                    onclick="importExcel('{{route('room.import.excel')}}')"--}}
{{--                            >--}}
{{--                                Nhập bằng file Excel--}}
{{--                            </button>--}}
                            @endrole
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0 ">
                            <table class="table mb-0 w-100">
                                <thead>

                                <tr class="d-flex">

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-20">
                                        Tên phòng
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-20">
                                        Có thể mượn
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-20 text-wrap"></th>
                                </tr>
                                <tbody>
                                @foreach($data as $details)
                                    <tr class="d-flex">
                                        <td class="w-20 text-wrap">
                                            <div class="d-block px-4 py-1">
                                                <div
                                                    class="d-flex flex-column justify-content-center text-center">
                                                    <h6 class="mb-0 text-sm">{{$details->name}}</h6>
                                                    <p class="text-xs text-secondary mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-20 text-wrap">
                                            <div class="d-block px-4 py-1">
                                                <div
                                                    class="d-flex flex-column justify-content-center text-center">
                                                    <h6 class="mb-0 text-sm">{{$details->can_rent ? 'Có thể' : 'Không thể' }}</h6>
                                                    <p class="text-xs text-secondary mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-7">
                                            <div class="d-block px-2 py-1">
                                                <div class="d-flex justify-content-center">
                                                    @role('SuperAdmin|admin|manage')
                                                    <a type="button"
                                                       href="{{ route('room.edit', ['id' => $details->id]) }}"
                                                       class="btn bg-gradient-info my-1 mb-1 ms-6">Sửa</a>
                                                    <button type="button" class="btn bg-gradient-danger my-1 mb-1 ms-1"
                                                            onclick="DeleteConfirm('{{route('room.delete', ['id' => $details->id])}}')">
                                                        Xoá
                                                    </button>
                                                    @endrole
                                                </div>
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
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        text: "Bạn không thể khôi phục lại phòng học đã xoá!",
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
                                        text: "Phòng học của bạn đã xoá.",
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
                                text: 'Phòng học của bạn đã an toàn :)',
                                icon: 'error',
                                backdrop: false,
                            })
                        }
                    })
                };
</script>
<script>
    let importExcel = (url) => {
        Swal.fire({
            title: 'Chọn file excel',
            input: 'file',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            cancelButtonText: 'Huỷ',
            confirmButtonText: 'Đồng ý',
            showLoaderOnConfirm: true,
            backdrop: false,
            preConfirm: () => {
                let formData = new FormData();
                formData.append('file', Swal.getInput().files[0])
                return $.ajax({
                    url: url,
                    data: formData,
                    enctype: "multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function () {
                    },
                    error: function (error) {
                    },
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: `Đã nhập thiết bị bằng file excel thành công`,
                    backdrop: false,
                })
            }
        })
    };
</script>
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
