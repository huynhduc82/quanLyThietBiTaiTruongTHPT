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
                    <form id="frm-lend-return">
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
                                <select type="text" class="form-select" id="room">
                                    @foreach($roomData as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group px-4 col-6">
                                <label class="col-form-label">Mã Giáo Viên</label>
                                <input type="text" class="form-control"
                                       placeholder="{{Auth::user()->id ?? 'Nhập mã giáo viên'}}" id="teacherId">
                            </div>
                            <div class="form-group px-4 col-6">
                                <label class="col-form-label">Thời Gian Mượn </label>
                                <input type="time" class="form-control" placeholder="Nhập Thời Gian Mượn" id="timeLend" disabled="disabled">
                            </div>
                            <div class="form-group px-4 col-6">
                                <label class="col-form-label">Tên Giáo Viên </label>
                                <input type="text" class="form-control"
                                       placeholder="{{Auth::user()->name ?? 'Nhập mã giáo viên'}}" id="teacherName">
                            </div>
                            <div class="form-group px-4 col-6">
                                <label class="col-form-label">Môn học</label>
                                <select type="text" class="form-select" id="course" onclick="filterCourseDetail()">
                                </select>
                            </div>
                            <div class="form-group px-4 col-6">
                                <label class="col-form-label">Bài Học</label>
                                <select type="text" class="form-select" id="courseDetails">
                                    @foreach($courseDetailData as $data)
                                        <option value="{{ $data['id'] }}">{{ $data['describe'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group px-4 col-6">
                                <label class="col-form-label">Thời Gian Trả Dự Kiến </label>
                                <input type="date" class="form-control" placeholder="Nhập Thời Gian Dự Kiến" id="returnAppointmentTime">
                            </div>
                            <div class="form-group px-4 col-6" style="margin: auto 0px">
                                <label style=" color: red" class="col-form-label" id="label-error"></label>
                            </div>
                            <div class="d-flex justify-content-center py-1 col-12">
                                <button type="submit" class="btn bg-gradient-info my-4 mb-2">Xác nhận mượn thiết bị</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h2>Danh sách thiết bị</h2>
                        </div>
                        <div class="px-4 py-2">
                            <button type="button" class="btn bg-gradient-info">Thêm</button>
                            <button type="button" class="btn bg-gradient-info" id="autoAdd" onclick="autoAddEquipment()">Thêm nhanh</button>
                            <button type="button" class="btn bg-gradient-info">Chọn từ danh sách</button>
                            {{--                                <button type="button" class="btn bg-gradient-info">Thêm mới</button>--}}
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0 ">
                                <table class="table mb-0 w-100" id="listEquipment">
                                    <thead>
                                    @if(!empty($data))
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-30">
                                                Tên thiết bị
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2
                                     w-6">
                                                Số lượng
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-9 text-wrap">
                                                Số lượng có thể mượn
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-6">
                                                Đơn vị tính
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3 w-7">
                                                Giá
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-25">
                                                Mô tả
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-7 text-wrap"></th>
                                        </tr>
                                    @endif
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/table-to-json@1.0.0/lib/jquery.tabletojson.min.js" integrity="sha256-H8xrCe0tZFi/C2CgxkmiGksqVaxhW0PFcUKZJZo1yNU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('core/js/lend_return/lend_return_store.js')}}"></script>

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
        function filterClass() {
            let classes = $('#class');
            classes.empty();
            let id = Number($('#grade').val());
            let classData = {!! json_encode($classData) !!};
            let classFilter = classData.filter(item => item.grade_id === id)
            $.each(classFilter, function (index, value) {
                classes.append(
                    `<option value="${value.id}">${value.name}</option>`
                )
            });
            filterCourse();
        }

        function filterCourse() {
            let id = Number($('#grade').val());
            let courseData = {!! json_encode($courseData) !!};
            let courseFilter = courseData.filter(item => item.grade_id === id)
            let course = $('#course');
            course.empty();
            $.each(courseFilter, function (index, value) {
                course.append(
                    `<option value="${value.id}">${value.name}</option>`
                )
            });
        }

        function filterCourseDetail() {
            let courseDetails = $('#courseDetails');
            courseDetails.empty();
            let id = Number($('#course').val());
            let courseDetailsData = {!! json_encode($courseDetailData) !!};
            let courseDetailsFilter = courseDetailsData.filter(item => item.course_id === id)
            $.each(courseDetailsFilter, function (index, value) {
                courseDetails.append(
                    `<option value="${value.id}">${value.describe}</option>`
                )
            });
        }

        $(document).ready(function () {
            filterCourse()
            filterCourseDetail()
        })

        function autoAddEquipment()
        {
            let id = Number($('#courseDetails').val());
            let tableEquipment = []
            let classId = Number($('#class').val());
            let classData = {!! json_encode($classData) !!};
            let classDataFilter = classData.find(item => item.id === classId)
            let number_of_pupils = classDataFilter.number_of_pupils;
            $.ajax({
                url: '/' +
                    'api/number-equipment/by-course-details-id/' + id ,
                dataType: 'json',
                enctype: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    for (let item of data['data'])
                    {
                        item.equipment.quantity = number_of_pupils/item.quantity;
                        tableEquipment.push(item.equipment);
                    }

                    $('#listEquipment').DataTable({
                        columnDefs: [
                            { targets: 0, className:  "ps-4"}
                        ],
                        destroy: true,
                        paging: false,
                        searching: false,
                        info: false,
                        data: tableEquipment,
                        columns: [
                            { data: 'name' },
                            { data: 'quantity' },
                            { data: 'quantity_can_rent' },
                            { data: 'unit' },
                            { data: 'price' },
                            { data: 'describe' },
                        ],
                    });
                },
                error: function (error) {
                    $('#submit_error').text(error.responseJSON.message);
                },
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        }
    </script>
    <!-- Github buttons -->
    <script async defer src="{{asset('https://buttons.github.io/buttons.js')}}"></script>
    <style>
    </style>
@endsection


