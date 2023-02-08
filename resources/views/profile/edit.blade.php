@extends('layout.layout')

@section('title')
    Chỉnh sửa hồ sơ
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="card w-70">
            <div class="card-header pb-2">
                <h3>Chỉnh sửa hồ sơ</h3>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <form id="frm-user">
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">ID</label>
                            <input type="text" class="form-control not-allowed" disabled="disabled" placeholder="ID người dùng" id="id" value="{{ $data->id }}">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Tên người dùng</label>
                            <input type="text" class="form-control" placeholder="Tên người dùng" id="name" value="{{ $data->name }}">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Số điện thoại</label>
                            <input type="text" class="form-control" placeholder="Số điện thoại" id="phone" value="{{ $data->phone_number }}">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Ngày sinh</label>
                            <input type="date" class="form-control" placeholder="Ngày sinh" id ="dateOfBirth" value="{{ $data->date_of_birth }}">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">CMND/CCCD</label>
                            <input type="text" class="form-control" placeholder="CMND/CCCD" id="identification" value="{{ $data->identification }}">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Địa chỉ</label>
                            <input type="text" class="form-control" placeholder="Địa chỉ" id="address" value="{{ $data->address }}">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Email</label>
                            <input type="text" class="form-control" placeholder="Email" id="email" value="{{ $data->email }}">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Mô tả</label>
                            <input type="text" class="form-control" placeholder="Mô tả" id="information" value="{{ $data->information }}">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Avatar</label>
                            <input type="file" class="form-control" placeholder="Avatar" id="avatar">
                        </div>
                    </div><div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Background</label>
                            <input type="file" class="form-control" placeholder="Background" id="background">
                        </div>
                    </div><div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Facebook</label>
                            <input type="text" class="form-control" placeholder="Facebook" id="facebook" value="{{ $data->facebook }}">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Twitter</label>
                            <input type="text" class="form-control" placeholder="Twitter" id="twitter" value="{{ $data->twitter }}">
                        </div>
                    </div>
                    <div class="form-group px-4">
                        <div class="col-9">
                            <label class="col-form-label">Instagram</label>
                            <input type="text" class="form-control" placeholder="Instagram" id="instagram" value="{{ $data->instagram }}">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center py-1 col-9">
                        <button type="submit" class="btn bg-gradient-info my-4 mb-2">Xác nhận</button>
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
    <script type="text/javascript" src="{{ asset('core/js/user/user_edit.js')}}"></script>
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
        document.getElementById('title-second').innerText = 'Chỉnh sửa hồ sơ'
    </script>
@endsection
