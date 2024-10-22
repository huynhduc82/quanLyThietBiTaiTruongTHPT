@extends('layout.layout')

@section('title')
    Quản lý vai trò
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h2>Quản lý vai trò</h2>
                    </div>
                    <div class="row px-4 py-2">
                        <div class="col-5">

                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0 ">
                            <table class="table mb-0 w-100">
                                <thead>
                                <tr class="d-flex">
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-20">
                                        Tên người dùng
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-20">
                                        Vai trò
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
                                                    <h6 class="mb-0 text-sm">{{ $details->roles->first() ? $details->roles->first()->name : 'Chưa có vai trò' }}</h6>
                                                    <p class="text-xs text-secondary mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-7">
                                            <div class="d-block px-2 py-1">
                                                <div class="d-flex justify-content-center">
                                                    @role('SuperAdmin')
                                                    <a type="button"
                                                       href="{{ route('role.edit', ['id' => $details->id]) }}"
                                                       class="btn bg-gradient-info my-1 mb-1 ms-6">Sửa</a>
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
                var win = navigator.platform.indexOf('Win') > -1;
                if (win && document.querySelector('#sidenav-scrollbar')) {
                    var options = {
                        damping: '0.5'
                    }
                    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
                }
                document.getElementById('title-first').innerText = 'Vai trò'
                document.getElementById('title-second').innerText = 'Quản lý vai trò'
            </script>
            <!-- Github buttons -->
            <script async defer src="{{asset('https://buttons.github.io/buttons.js')}}"></script>
@endsection
