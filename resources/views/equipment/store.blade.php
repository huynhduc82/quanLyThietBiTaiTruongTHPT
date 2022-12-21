@extends('layout.layout')

@section('title')
    Thêm thiết bị mới
@endsection

@section('content')
    <div class="container-fluid py-4">
        <form role="form text-left" class="w-70" >
            <h3>Thêm mới thiết bị</h3>
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
                <input type="file" class="form-control" placeholder="Hình ảnh thiết bị" aria-label="Số lượng thiết bị" >
            </div>
            <div class="text-center button">
                <button type="button" class="btn bg-gradient-info w-10 my-4 mb-2">Thêm</button>
            </div>
        </form>
    </div>
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
    <script>
        document.getElementById('title-first').innerText = 'Thiết bị'
        document.getElementById('title-second').innerText = 'Thêm mới thiết bị'
    </script>
@endsection
