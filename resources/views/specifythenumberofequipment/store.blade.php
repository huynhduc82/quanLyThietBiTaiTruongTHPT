@extends('layout.layout')

@section('title')
    Thêm mới số lợng thiết bị
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="card w-70">
            <div class="card-header pb-2">
                <h3>Thêm mới số lợng thiết bị</h3>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <form id="frm-number">
                    <div class="form-group px-4 col-9">
                        <label class="col-form-label">Tên Khối Lớp</label>
                        <select type="text" class="form-select" id="grade" onclick="filterClass()">
                            @foreach($gradeData as $data)
                                <option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group px-4 col-9">
                        <label class="col-form-label">Tên Lớp Học</label>
                        <select type="text" class="form-select" id="class">
                            @foreach($classData as $data)
                                <option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group px-4 col-9">
                        <label class="col-form-label">Môn học</label>
                        <select type="text" class="form-select" id="course" onclick="filterCourseDetail()">
                        </select>
                    </div>
                    <div class="form-group px-4 col-9">
                        <label class="col-form-label">Bài Học</label>
                        <select type="text" class="form-select" id="courseDetails">
                            @foreach($courseDetailData as $data)
                                <option value="{{ $data['id'] }}">{{ $data['describe'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
{{--                            <label class="col-form-label">Tên thiết bị</label>--}}
{{--                            <input type="text" class="form-control" placeholder="Tên thiết bị" id="name">--}}
                            <label class="col-form-label">Thiết bị</label>
                            <select type="text" class="form-select" id="equipment">
                                @foreach($typeOfEquipmentData as $data)
                                    <option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Số lượng</label>
                            <input type="text" class="form-control" placeholder="Số lượng" id ="quantity">
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
    <script type="text/javascript" src="{{ asset('core/js/number/number_store.js')}}"></script>
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
    </script>
    <script>
        document.getElementById('title-first').innerText = 'Quản lý số lượng thiết bị'
        document.getElementById('title-second').innerText = 'Thêm mới số lợng thiết bị'
    </script>
@endsection
