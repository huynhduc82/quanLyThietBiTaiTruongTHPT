<link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

<div class="" style="background: #e6e6e6; color: #000000 !important;">
    <div class="container-md bg-white" id="main">
        <div class="row">
            <div class="pt-5 text-center" id="header">
                <p class="font-weight-bolder">CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM</p>
                <p class="font-weight-bolder">Độc lập - Tự do - Hạnh phúc</p>
                <p style="margin-left: 200px">..................., ngày ... tháng ... năm .......</p>
            </div>
            <div class="" id="content">
                <p class="text-center text-uppercase font-weight-bolder pt-3 pb-2" style="font-size: 18px">Phiếu đăng ký mượn thiết bị - đồ dùng dạy học</p>
                <p> <span class="font-weight-bolder">Họ tên giáo viên: </span> {{ $lendReturn->user->name }}</p>
                <p> <span class="font-weight-bolder"> Môn dạy: </span> {{ $lendReturn->course ? $lendReturn->course->name : '.........' }} </p>
                <table class="table w-100">
                    <thead>
                    <tr>
                        <th class="text-sm font-weight-bolder w-5">
                            STT
                        </th>
                        <th class="text-sm font-weight-bolder w-20">
                            Ngày mượn
                        </th>
                        <th class="text-sm font-weight-bolder w-20">
                            Ngày trả
                        </th>
                        <th class="text-sm font-weight-bolder w-20">
                            Tên thiết bị
                        </th>
                        <th class="text-sm font-weight-bolder w-20">
                            Tên bài dạy
                        </th>
                        <th class="text-sm font-weight-bolder w-5">
                            Số lượng
                        </th>
                        <th class="text-sm font-weight-bolder w-10">
                            Lớp
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lendReturn->details as $key=>$details)
                        <tr>
                            <td class="text-wrap p-0 w-5">
                                <div class="d-block">
                                    <div class="d-flex flex-column justify-content-center text-center">
                                        <p class="m-0"> {{ $key + 1  }} </p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-wrap p-0 w-20">
                                <div class="d-block">
                                    <div class="d-flex flex-column justify-content-center text-center">
                                        <p class="m-0">{{$lendReturn->pick_up_time}}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-wrap p-0 w-20">
                                <div class="d-block">
                                    <div class="d-flex flex-column justify-content-center text-center">
                                        <p class="m-0">{{$lendReturn->return_appointment_time}}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-wrap p-0 w-20">
                                <div class="d-block">
                                    <div class="d-flex flex-column justify-content-center text-center">
                                        <p class="m-0">{{$details->typeOfEquipment->name}}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-wrap p-0 w-20">
                                <div class="d-block">
                                    <div class="d-flex flex-column justify-content-center text-center">
                                        <p class="m-0">{{$details->courseDetails ? $details->courseDetails->describe : ''}}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-wrap p-0 w-5">
                                <div class="d-block">
                                    <div class="d-flex flex-column justify-content-center text-center">
                                        <p class="m-0">{{$details->typeOfEquipment->quantity}}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-wrap p-0 w-10">
                                <div class="d-block">
                                    <div class="d-flex flex-column justify-content-center text-center">
                                        <p class="m-0"> {{$lendReturn->class ? $lendReturn->class->name : ''}} </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mx-10" id="footer">
                <p class="m-0 text-center">Giáo viên</p>
                <p class="m-0 text-center">(Ký và ghi rõ họ tên)</p>
            </div>
        </div>
    </div>
</div>

<style>
    table, th, td {
        border: 1px solid !important;
    }
</style>


<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
    $(document).ready(function () {
        printPageArea('main')
    })
    function printPageArea (areaID){
        let printContent = document.getElementById(areaID).innerHTML;
        let originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>
