@extends('layout.layout')

@section('title')
    Báo hỏng thiết bị
@endsection

@section('content')
    <div class="container-fluid py-4 pb-6">
        <div class="row">
            <div class="card mb-4 col-12">
                <div class="card-header pb-2">
                    <h3>Quản lý thông tin phiếu báo hỏng thiết bị</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form id="frm-lend-return">
                        <div class="row">
                            <div class="form-group px-4 col-6">
                                <label class="col-form-label">Tên Phòng Học</label>
                                <select type="text" class="form-select" id="room">
                                    @foreach($roomData as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group px-4 col-6" style="margin: auto 0px">
                                <label style=" color: red" class="col-form-label" id="label-error"></label>
                            </div>
                            <div class="d-flex justify-content-center py-1 col-12">
                                <button type="submit" class="btn bg-gradient-info my-4 mb-2">Xác nhận báo hỏng thiết bị</button>
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
                            <button type="button" class="btn bg-gradient-info" id="add" onclick="AddEquipment()">Thêm</button>
                            <button type="button" class="btn bg-gradient-info" id="autoAdd" onclick="autoAddEquipment()">Thêm nhanh</button>
                            <button type="button" class="btn bg-gradient-danger" id="deleteEquipment" disabled="disabled" onclick="deleteEquipment()">Xoá</button>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0 ">
                                <table class="table mb-0 w-100" id="listEquipment">
                                    <thead>
                                    @if(!empty($data))
                                        <tr>
                                            <th class="w-5 p-0"></th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-30 ps-2">
                                                Tên thiết bị
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-6">
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
    <link href="https://cdn.datatables.net/select/1.5.0/css/select.dataTables.min.css" rel="stylesheet" />
    <script src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/table-to-json@1.0.0/lib/jquery.tabletojson.min.js" integrity="sha256-H8xrCe0tZFi/C2CgxkmiGksqVaxhW0PFcUKZJZo1yNU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('core/js/maintenance/maintenance_store.js')}}"></script>
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
        async function getEquipmentByRoomID()
        {
            let id = Number($('#room').val());
            let dataReturn = {}
            await $.ajax({
                url: '/' +
                    'api/equip/by-room-id/' + id ,
                dataType: 'json',
                enctype: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    for (let item of data['data'])
                    {
                        dataReturn[item.name] = item.name
                    }
                },
                error: function (error) {
                    $('#submit_error').text(error.responseJSON.message);
                },
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            return dataReturn;
        }

        async function getNumberEquipmentByName(name, room)
        {
            let dataReturn = {}
            await $.ajax({
                url: '/' +
                    'api/equip/by-name/' + name + '/' + room ,
                dataType: 'json',
                enctype: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    dataReturn = data['data'];
                },
                error: function (error) {
                    $('#submit_error').text(error.responseJSON.message);
                },
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            return dataReturn
        }

        async function AddEquipment()
        {
            let Id = Number($('#room').val());
            const { value : name } = await Swal.fire({
                title: 'Chọn thiết bị',
                input: 'select',
                inputOptions: await getEquipmentByRoomID(Id),
                inputPlaceholder: 'Chọn thiết bị',
                showCancelButton: true,
                backdrop: false,
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        resolve()
                    })
                }
            })

            if (name) {
                let Id = Number($('#room').val());
                await Swal.fire({
                    backdrop: false,
                    title: `Bạn đã chọn thiết bị: ${name}`
                })
                let newEquipment = await getNumberEquipmentByName(name, Id)
                let ListEquipment = $("#listEquipment").DataTable().rows().data().toArray();
                let data =  []
                data.push(newEquipment)
                for (let equipment of ListEquipment)
                {
                    data.push(equipment)
                }

                createDataTable(data)
            }
        }

        function autoAddEquipment()
        {
            let id = Number($('#room').val());
            let tableEquipment = []
            $.ajax({
                url: '/' +
                    'api/equip/by-room-id/' + id ,
                dataType: 'json',
                enctype: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    for (let item of data['data'])
                    {
                        tableEquipment.push(item);
                    }

                    createDataTable(tableEquipment)
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

        function createDataTable (data)
        {
            console.log(data)
            $('#listEquipment').DataTable({
                columnDefs: [
                    { targets: 0, className:  "ps-5 select-checkbox"},
                ],
                select: {
                    style:    'os',
                    selector: 'td:first-child'
                },
                order: [[ 1, 'asc' ]],
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
                    // { data: 'quantity' },
                    // { data: 'quantity_can_rent' },
                    // { data: 'unit' },
                    // { data: 'price' },
                    // { data: 'describe' },
                ],
            });
            $("#listEquipment tr").click(function() {
                $('#changeQuantity').removeAttr("disabled")
                $('#deleteEquipment').removeAttr("disabled")
            });
        }

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        let deleteEquipment = () => {
            swalWithBootstrapButtons.fire({
                title: 'Bạn có chắc không?',
                text: "Bạn có thể thêm thiết bị này lại vào lúc sau!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có, Hãy xoá đi!',
                cancelButtonText: 'Không, Huỷ bỏ!',
                reverseButtons: true,
                backdrop: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    let listEquipment = $("#listEquipment");
                    let Equipment = listEquipment.DataTable().rows({ selected: true }).data().toArray();
                    let ListEquipment = listEquipment.DataTable().rows().data().toArray();
                    const result = ListEquipment.filter(removeDuplicate);
                    function removeDuplicate(equipment) {
                        return equipment.id !== Equipment[0].id;
                    }
                    createDataTable(result)
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: 'Đã huỷ',
                        text: 'Thiết bị của bạn đã an toàn :)',
                        icon: 'error',
                        backdrop: false,
                    })
                }
            })
        };
    </script>
    <!-- Github buttons -->
    <script async defer src="{{asset('https://buttons.github.io/buttons.js')}}"></script>
    <script>
        document.getElementById('title-first').innerText = 'Đặt trước'
        document.getElementById('title-second').innerText = 'Báo hỏng thiết bị'
    </script>
@endsection


