@extends('layout.layout')

@section('title')
    Mượn trả thiết bị
@endsection

@section('content')
    <div class="container-fluid py-4 pb-6">
        <div class="row">
            <div class="card mb-4 col-12">
                <div class="card-header pb-2">
                    <h3>Quản lý thông tin phiếu mượn</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form id="frm-equipment">
                        <div class="row">
                            <div class="form-group px-4 col-6">
                                    <label class="col-form-label">Tên Khối Lớp</label>
                                    <select type="text" class="form-select" id="grade" onclick="filterClass()">
                                    @foreach($gradeData as $data)
                                        <option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                                    @endforeach
                                    </select>
                            </div>
                            <div class="form-group px-4 col-6">
                                    <label class="col-form-label">Tên Lớp Học</label>
                                    <select type="text" class="form-select" id="class">
                                    @foreach($classData as $data)
                                        <option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                                    @endforeach
                                    </select>
                            </div>
                            <div class="form-group px-4 col-6">
                                    <label class="col-form-label">Tên Phòng Học</label>
                                    <select type="text" class="form-select" id="describe" >
                                    @foreach($roomData as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                    </select>
                            </div>
                            <div class="form-group px-4 col-6">
                                    <label class="col-form-label">Mã Giáo Viên</label>
                                    <input type="text" class="form-control" placeholder="{{Auth::user()->id ?? 'Nhập mã giáo viên'}}" id="price">
                            </div>
                            <div class="form-group px-4 col-6">
                                <label class="col-form-label">Thời Gian Mượn </label>
                                <input type="text" class="form-control" placeholder="Nhập Thời Gian Mượn" id="price">
                            </div>
                            <div class="form-group px-4 col-6">
                                <label class="col-form-label">Tên Giáo Viên </label>
                                <input type="text" class="form-control" placeholder="{{Auth::user()->name ?? 'Nhập mã giáo viên'}}" id="price">
                            </div>
                            <div class="form-group px-4 col-6">
                                <label class="col-form-label">Môn học</label>
                                <select type="text" class="form-select" id="describe">
                                @foreach($courseData as $data)
                                    <option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group px-4 col-6">
                                <label class="col-form-label">Bài Học</label>
                                <select type="text" class="form-select" id="describe">
                                @foreach($courseDetailData as $data)
                                    <option value="{{ $data['id'] }}">{{ $data['describe'] }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group px-4 col-6">
                                    <label class="col-form-label">Thời Gian Trả Dự Kiến </label>
                                    <input type="date" class="form-control" placeholder="Nhập Thời Gian Dự Kiến" id="price">
                            </div>
                            <div class="d-flex justify-content-center py-1 col-12">
                                <button type="submit" class="btn bg-gradient-info my-4 mb-2">Thêm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row px-2 py-2">
                <div class="card w-100 col-4">
                    <div class="card-header pb-2">
                        <h3> Danh sách thiết bị</h3>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form id="frm-equipment">
                            <div class="form-group px-4">
                                <div class="col-9">
                                    <label class="col-form-label">Tên Thiết Bị</label>
                                    <input type="text" class="form-control" placeholder="Nhập Tên Thiết Bị" id="price">
                                </div>
                            </div>
                            <div class="form-group px-4">
                                <div class="col-9">
                                    <label class="col-form-label">Số Lượng Học Sinh</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Số lượng học sinh" aria-label="Recipient's username" aria-describedby="button-addon2">
                                        <button class="btn bg-gradient-info m-0" type="button" id="button-addon2">Tính số lượng thiết bị</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group px-4">
                                <div class="col-9">
                                    <label class="col-form-label">Số Lượng Thiết Bị Mượn</label>
                                    <input type="text" class="form-control" placeholder="Nhập Số Lượng Thiết Bị" id="price">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center py-1 col-9">
                                <button type="submit" class="btn bg-gradient-info my-4 mb-2">Thêm</button>
                                <button type="submit" class="btn bg-gradient-info my-4 mb-2 mx-4">Thêm nhanh</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Danh sách Thiết Bị Mượn </h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-20">Tên Thiết Bị </th>

                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-20">Số lượng</th>

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
@endsection

@section('footer_scripts')
<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script>
    let win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        let options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<script>
    function filterClass()
    {
        let id = $('#grade').val()

        let classData = {!! json_encode($classData) !!};

        let classFilter = classData.filter(function (values) {
            if (values['id'] === id) {
                return true;
            }
            return false;
        })

        console.log(classFilter)
    }
    $('#grade').find
</script>
<!-- Github buttons -->
<script async defer src="{{asset('https://buttons.github.io/buttons.js')}}"></script>
@endsection


