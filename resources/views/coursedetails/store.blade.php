
@extends('layout.layout')

@section('title')
    Thêm mới chi tiết môn học
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="card w-70">
            <div class="card-header pb-2">
                <h3>Thêm mới chi tiết môn học</h3>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <form id="frm-course-details">
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Mã môn học</label>
                            <input type="text" class="form-control" placeholder="Mã môn học" id="id" disabled="disabled" value="{{ $id }}">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Bài học số </label>
                            <input type="text" class="form-control" placeholder="Tên chi tiết môn học" id="lesson">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Tên chi tiết môn học</label>
                            <input type="text" class="form-control" placeholder="Tên chi tiết môn học" id="name">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Cần thiết bị</label>
                            <input class="col-2 px-1" type="checkbox"  id="need_equipment">
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
    <script type="text/javascript" src="{{ asset('core/js/course_details/course.details.store.js')}}"></script>
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
        document.getElementById('title-second').innerText = 'Thêm mới môn học'
    </script>
@endsection
