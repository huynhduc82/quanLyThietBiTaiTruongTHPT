@extends('layout.layout')

@section('title')
    Chỉnh sửa vai trò
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="card w-70">
            <div class="card-header pb-2">
                <h3>Chỉnh sửa vai trò</h3>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <form id="frm-role">
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">ID người dùng</label>
                            <input type="text" class="form-control" placeholder="Bài học" id="id" value="{{ $data->id }}" disabled="disabled">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Tên người dùng</label>
                            <input type="text" class="form-control" placeholder="Bài học" id="name" value="{{ $data->name }}" disabled="disabled">
                        </div>
                    </div>
                    <div class="form-check px-6">
                        <input class="form-check-input" type="radio" name="checkRole" id="admin" value="admin">
                        <label class="form-check-label" for="admin">
                            Admin
                        </label>
                    </div>
                    <div class="form-check px-6">
                        <input class="form-check-input" type="radio" name="checkRole" id="manage" value="manage">
                        <label class="form-check-label" for="manage">
                            Manage
                        </label>
                    </div>
                    <div class="form-check px-6">
                        <input class="form-check-input" type="radio" name="checkRole" id="teacher" value="teacher">
                        <label class="form-check-label" for="teacher">
                            Teacher
                        </label>
                    </div>
                    <div class="form-check px-6">
                        <input class="form-check-input" type="radio" name="checkRole" id="maintainer" value="maintainer">
                        <label class="form-check-label" for="maintainer">
                            Maintainer
                        </label>
                    </div>
                    <div>
                        <label class="form-check-label px-5 text-danger" id="lbl-error">
                        </label>
                    </div>
                    <div class="d-flex justify-content-center py-1 col-9">
                        <button id="btn-submit" type="submit" class="btn bg-gradient-info my-4 mb-2">Xác nhận</button>
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
    <script type="text/javascript" src="{{ asset('core/js/role/role.edit.js')}}"></script>
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
        document.getElementById('title-first').innerText = 'Vai trò'
        document.getElementById('title-second').innerText = 'Chỉnh sửa vai trò'
    </script>
    <script>
        $(document).ready(function(){
            checkRadio()
        })

        function checkRadio()
        {
            let role = {!!  $data->roles[0] ?? null!!};
            console.log(role.name)
            if (role.name === 'admin'){
                $("#admin").prop('checked', true);
            } else if (role.name === 'manage'){
                $("#manage").prop('checked', true);
            } else if (role.name === 'teacher'){
                $("#teacher").prop('checked', true);
            } else if (role.name === 'maintainer'){
                $("#maintainer").checked(true);
            } else if (role.name === 'SuperAdmin') {
                $('#btn-submit').prop('disabled', true);
                $("#lbl-error").text('Ban đã là quyền cao nhất xin quay lại trang trước')
            }
        }
    </script>
@endsection

