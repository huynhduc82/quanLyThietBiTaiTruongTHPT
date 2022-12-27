@extends('layout.layout')

@section('title')
    Thêm mới giờ học
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="card w-70">
            <div class="card-header pb-2">
                <h3>Thêm mới giờ học</h3>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <form id="frm-equipment">
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Bài học</label>
                            <input type="text" class="form-control" placeholder="Bài học" id="name">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Thời gian bắt đầu</label>
                            <input type="time" class="form-control" placeholder="Thời gian bắt đầu" id="describe">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Thời gian kết thúc</label>
                            <input type="time" class="form-control" placeholder="Thời gian kết thúc" id="describe">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center py-1 col-9">
                        <button type="submit" class="btn bg-gradient-info my-4 mb-2">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('core/js/type_equipment/type_equipment_store.js')}}"></script>
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
        document.getElementById('title-first').innerText = 'Quản lý giờ học'
        document.getElementById('title-second').innerText = 'Thêm mới giờ học'
    </script>
@endsection
