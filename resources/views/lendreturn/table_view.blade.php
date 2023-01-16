<table class="table mb-0 w-100" id="equipment-table">
    <thead>
    @if(!empty($data))
        <tr class="d-block">
            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-10 px-3 py-2 pt-3">
                Người mượn
            </th>
            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-11 p-2 pt-3">
                Thời gian mượn
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-10 p-2 pt-3">
                Nhân viên cho mượn
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-10 p-2 pt-3">
                Nhân viên nhận trả
            </th>
            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-11 p-2 pt-3">
                Thời gian trả dự kiến
            </th>
            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-11 p-2 pt-3">
                Thời gian trả
            </th>
            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-10 p-2 pt-3">
                Phòng
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-12 pt-3">
            </th>
        </tr>
    @endif
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr class="d-block">
            <td class="text-wrap accordion-toggle w-10" data-bs-toggle="collapse"
                data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                <div class="d-block">
                    <div class="d-block justify-content-center">
                        <h6 class="mb-0 text-sm">{{$item->user->name}}</h6>
                        <p class="text-xs text-secondary mb-0"></p>
                    </div>
                </div>
            </td>
            <td class="accordion-toggle w-11" data-bs-toggle="collapse"
                data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                <div class="d-block">
                    <div class="d-flex flex-column justify-content-center text-center">
                        <h6 class="mb-0 text-sm">{{$item->pick_up_time}}</h6>
                        <p class="text-xs text-secondary mb-0"></p>
                    </div>
                </div>
            </td>
            <td class="accordion-toggle w-10" data-bs-toggle="collapse"
                data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                <div class="d-block">
                    <div class="d-block flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{$item->lender->name ?? '......'}}</h6>
                        <p class="text-xs text-secondary mb-0"></p>
                    </div>
                </div>
            </td>
            <td class="accordion-toggle w-10" data-bs-toggle="collapse"
                data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                <div class="d-block">
                    <div class="d-flex justify-content-center">
                        <h6 class="mb-0 text-sm">{{$item->returner ? $item->returner->name : 'Chưa trả'}}</h6>
                        <p class="text-xs text-secondary mb-0"></p>
                    </div>
                </div>
            </td>
            <td class="accordion-toggle w-11" data-bs-toggle="collapse"
                data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                <div class="d-block">
                    <div class="d-flex justify-content-center text-center">
                        <h6 class="mb-0 text-sm">{{$item->return_appointment_time}}</h6>
                        <p class="text-xs text-secondary mb-0"></p>
                    </div>
                </div>
            </td>
            <td class="text-wrap accordion-toggle w-11" data-bs-toggle="collapse"
                data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                <div class="d-block align-text-center">
                    <div class="d-flex justify-content-center text-center">
                        <h6 class="mb-0 text-sm">{{$item->return_time ?? 'Chưa trả' }}</h6>
                    </div>
                </div>
            </td>
            <td class="text-wrap accordion-toggle w-10" data-bs-toggle="collapse"
                data-bs-target="#demo{{ $item->id }}" aria-expanded="false">
                <div class="d-block align-text-center">
                    <div class="d-flex justify-content-center text-center">
                        <h6 class="mb-0 text-sm">{{$item->room ?? 'Ngoài trời' }}</h6>
                    </div>
                </div>
            </td>
            <td class="w-12">
                <div class="d-block">
                    <div class="d-flex justify-content-center">
                        {{--                                                    <a type="button"--}}
                        {{--                                                       href="{{ route('equipment.edit', ['id' => $item->id]) }}"--}}
                        {{--                                                       class="btn bg-gradient-info my-1 mb-1">Sửa</a>--}}
                        @if($item->status != 2)
                            <a type="button" class="btn bg-gradient-danger my-1 mb-1 ms-1"
                               href="{{ route('lend_return.returnView', ['id' => $item->id]) }}">
                                Trả
                            </a>
                        @else
                            <a type="button" class="btn bg-gradient-danger my-1 mb-1 ms-1 disabled"
                               href="{{ route('lend_return.returnView', ['id' => $item->id]) }}">
                                Trả
                            </a>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="12" class="hiddenRow">
                <div class="accordion-body collapse" id="demo{{ $item->id }}"
                     style="height: 0" aria-expanded="false">
                    <table class="table mb-0">
                        @if(!empty($item->details[0]))
                            <thead>
                            <tr class="d-flex px-3">
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-20">
                                    Tên thiết bị
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-20">
                                    Số lượng
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-20">
                                    Tình trạng
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-20">
                                    Trạng thái
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap w-20"></th>
                            </tr>
                            </thead>
                        @endif
                        <tbody>
                        @foreach($item->details as $details)
                            <tr class="d-flex">
                                <td class="w-20 text-wrap">
                                    <div class="d-flex px-4 py-1">
                                        <div
                                            class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$details->typeOfEquipment->name}}</h6>
                                            <p class="text-xs text-secondary mb-0"></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="w-20 text-wrap">
                                    <div class="d-flex px-4 py-1">
                                        <div
                                            class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$details->quantity}}</h6>
                                            <p class="text-xs text-secondary mb-0"></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="w-20 text-wrap">
                                    <div class="d-flex px-4 py-1">
                                        <div
                                            class="d-flex flex-column justify-content-center">
                                            {{--                                                                        <h6 class="mb-0 text-sm">{{$equipment->status->condition_details}}</h6>--}}
                                            <p class="text-xs text-secondary mb-0"></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="w-20 text-wrap">
                                    <div class="d-flex px-4 py-1">
                                        <div
                                            class="d-flex flex-column justify-content-center">
                                            {{--                                                                        <h6 class="mb-0 text-sm">{{$equipment->can_rent != 1 ? 'Đang cho mượn' : 'Có thể mượn' }}</h6>--}}
                                            <p class="text-xs text-secondary mb-0"></p>
                                        </div>
                                    </div>
                                </td>
                                {{--                                                            <td class="w-20">--}}
                                {{--                                                                <div class="d-flex px-2 py-1">--}}
                                {{--                                                                    <div class="d-flex justify-content-center">--}}
                                {{--                                                                        <a type="button"--}}
                                {{--                                                                           href="{{ route('equipment_details.edit', ['id' => $equipment->id]) }}"--}}
                                {{--                                                                           class="btn bg-gradient-info my-1 mb-1 ms-1">Sửa</a>--}}
                                {{--                                                                        <button type="button"--}}
                                {{--                                                                                class="btn bg-gradient-danger my-1 mb-1 ms-1">--}}
                                {{--                                                                                onclick="DeleteConfirm('{{route('equipment_details.delete', ['id' => $equipment->id])}}')">--}}
                                {{--                                                                            Xoá--}}
                                {{--                                                                        </button>--}}
                                {{--                                                                    </div>--}}
                                {{--                                                                </div>--}}
                                {{--                                                            </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

