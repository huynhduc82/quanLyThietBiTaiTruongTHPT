@extends('layout.layout')

@section('title')
    Thêm mới lớp học
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="card w-70">
            <div class="card-header pb-2">
                <h3>Thêm mới lớp học</h3>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <form id="frm-class">
                    <div class="form-group px-4">
                        <div class="col-9">
                        <label class="col-form-label">Tên Khối Lớp</label>
                            <select type="text" class="form-select" id="grade" onclick="filterClass()">
                                @foreach($gradeData as $data)
                                    <option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Tên lớp</label>
                            <input type="text" class="form-control" placeholder="Tên lớp" id="name">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Sỉ số</label>
                            <input type="tex" class="form-control" placeholder="Sỉ số" id="number">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center py-1 col-9">
                        <button type="submit" class="btn bg-gradient-info my-4 mb-2">Thêm</button>
                    </div>
                    <div class="form-group px-4 col-6" style="margin: auto 0px">
                            <label style=" color: red" class="col-form-label" id="label-error"></label>
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
    <script type="text/javascript" src="{{ asset('core/js/class/class_store.js')}}"></script>
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
        document.getElementById('title-second').innerText = 'Thêm mới lớp học'
    </script>
@endsection
