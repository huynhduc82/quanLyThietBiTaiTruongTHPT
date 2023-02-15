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
                            <label class="col-form-label">Mã Mượn Trả</label>
                            <input type="text" class="form-control"
                                   value="{{ $lendReturn->id}}" id="ID" disabled="disabled">
                        </div>
                        <div class="form-group px-4 col-6">
                            <label class="col-form-label">Tên Người Mượn</label>
                            <input type="text" class="form-control"
                                   value="{{ $lendReturn->user->name}}" id="teacherId">
                        </div>
                        <div class="form-group px-4 col-6">
                            <label class="col-form-label">Tên Người Cho Mượn</label>
                            <input type="text" class="form-control"
                                   value="{{ $lendReturn->lender->name ?? '.......'}}" id="teacherId">
                        </div>
                        <div class="form-group px-4 col-6">
                            <label class="col-form-label">Phòng </label>
                            <input type="text" class="form-control"
                                   value="{{ $lendReturn->room->name ?? 'Ngoài trời' }}" id="teacherName">
                        </div>
                        <div class="form-group px-4 col-6">
                            <label class="col-form-label">Thời Gian Mượn </label>
                            <input type="datetime" class="form-control" placeholder="Nhập Thời Gian Mượn" id="timeLend"
                                   value="{{ $lendReturn->pick_up_time }}">
                        </div>
                        <div class="form-group px-4 col-6">
                            <label class="col-form-label">Thời Gian Trả Dự Kiến </label>
                            <input type="datetime" class="form-control" value="{{ $lendReturn->return_appointment_time }}" id="returnAppointmentTime">
                        </div>
                        <div class="form-group px-4 col-6" style="margin: auto 0px">
                            <label style=" color: red" class="col-form-label" id="label-error"></label>
                        </div>
                        <div class="d-flex justify-content-center py-1 col-12">
                            <button type="submit" class="btn bg-gradient-info my-4 mb-2">Xác nhận trả thiết bị</button>
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
                        <button type="button" id="brokenReport" class="btn bg-gradient-danger" disabled="disabled" onclick="brokenReport()">Báo hỏng</button>
{{--                        <button type="button" class="btn bg-gradient-info" id="autoAdd" onclick="autoAddEquipment()">Thêm nhanh</button>--}}
{{--                        <button type="button" class="btn bg-gradient-info">Chọn từ danh sách</button>--}}
{{--                                                        <button type="button" class="btn bg-gradient-info">Thêm mới</button>--}}
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0 ">
                            <table class="table mb-0 w-100 display" id="listEquipment">
                                <thead>
                                <tr>
                                    <th class="w-5 p-0"></th>
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
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-0 hidden" hidden="hidden" id="id">
                                    </th>
                                </tr>
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
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>--}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<link href="https://cdn.datatables.net/select/1.5.0/css/select.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/table-to-json@1.0.0/lib/jquery.tabletojson.min.js" integrity="sha256-H8xrCe0tZFi/C2CgxkmiGksqVaxhW0PFcUKZJZo1yNU=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('core/js/lend_return/lend_return_return.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    $(document).ready(function () {
        loadTableEquipment();
    });
    function loadTableEquipment()
    {
        let data = {!! json_encode($lendReturn->details) !!};
        let list = [];
        data.forEach(myFunction);
        function myFunction(items) {
            let item = {
                "name" : items.type_of_equipment.name,
                "quantity" : items.quantity,
                "quantity_can_rent" : items.type_of_equipment.quantity_can_rent,
                "unit" : items.type_of_equipment.unit,
                "price" : items.type_of_equipment.price,
                "describe" : items.type_of_equipment.describe,
                "type_of_equipment_id" : items.type_of_equipment.id,
                "id" : items.id,
            }
            list.push(item);
        }
        createDataTable(list)
    }

    function createDataTable(data)
    {
        $('#listEquipment').DataTable({
            columnDefs: [
                { targets: 0, className:  "ps-4 select-checkbox"}
            ],
            select: {
                style:    'os',
                selector: 'td:first-child'
            },
            destroy: true,
            paging: false,
            searching: false,
            info: false,
            data: data,
            columns: [
                {
                    data: null,
                    defaultContent: '',
                    className: 'select-checkbox',
                    orderable: false,
                },
                { data: 'name' },
                { data: 'quantity' },
                { data: 'quantity_can_rent' },
                { data: 'unit' },
                { data: 'price' },
                { data: 'describe' },
                { data: 'id',
                    visible: false,
                },
            ],
        });
        $("#listEquipment tr").click(function() {
            $('#brokenReport').removeAttr("disabled")
        });
    }


    async function brokenReport()
    {
        function loadRoom()
        {
            console.log(123123123);
        }
        const { value: formValues } = await Swal.fire({
            title: 'Chi tiết báo hỏng',
            showCloseButton: true,
            showCancelButton: true,
            backdrop: false,
            html:
                '<label for="swal-input2" class="col-form-label mt-2 px-6">Phòng</label><select id="swal-input2" class="swal2-select mt-2" onload="loadRoom()">' +
                '</select>' +
                '<label for="swal-input1" class="col-form-label">Tình trạng hiện tại</label><input id="swal-input1" class="swal2-input mt-2">' +
                '<label for="swal-input1" class="col-form-label mt-2 mb-1">Lý do đền bù</label><input id="swal-input4" class="swal2-input mt-2">' +
                '<label for="swal-input2" class="col-form-label mt-2">Phương cách đền bù</label><select id="swal-input2" class="swal2-select mt-2">' +
                    '<option value="money">Tiền mặt</option>' +
                    '<option value="equipment">Thiết bị</option>' +
                '</select>' +
                '<label for="swal-input1" class="col-form-label mt-2 mb-1">Số tiền hoặc số lượng</label><input id="swal-input3" class="swal2-input mt-2">'
            ,
            focusConfirm: false,
            preConfirm: () => {
                return {"status" : document.getElementById('swal-input1').value, "recoupMethod" : document.getElementById('swal-input2').value, "quantity" : document.getElementById('swal-input3').value, "reason" : document.getElementById('swal-input4').value};
            }
        })

        if (formValues) {
            let listEquipment = $("#listEquipment");
            let Equipment = listEquipment.DataTable().rows({ selected: true }).data().toArray();
            let ListEquipment = listEquipment.DataTable().rows({ selected: false }).data().toArray();
            let ID = Equipment[0].id;
            let data = {}
            data.status = formValues.status
            data.method = formValues.recoupMethod
            data.quantity = formValues.quantity
            data.reason = formValues.reason
            Swal.fire({'text' : JSON.stringify(data), backdrop: false})
            $.ajax({
                url: '/api/lend-return/broken/report/' + ID ,
                data: JSON.stringify(data),
                dataType: 'json',
                enctype: "multipart/form-data",
                contentType: 'application/json',
                cache: false,
                processData: false,
                success: function (data) {
                    createDataTable(ListEquipment)
                },
                error: function (error) {
                    $('#submit_error').text(error.responseJSON.message);
                },
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }
    }
</script>
<script>
    document.getElementById('title-first').innerText = 'Mượn trả'
    document.getElementById('title-second').innerText = 'Trả thiết bị'
</script>
<style>
</style>
@endsection


