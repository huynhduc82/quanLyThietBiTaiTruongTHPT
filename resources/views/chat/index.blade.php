@extends('layout.layout')

@section('title')
    Chat
@endsection

@section('content')
    <div class="container-fluid m-4 max-width-1150 bg-white blur shadow-blur border-radius-xl chat-container">
        <div class="row border-bottom p-1 px-2">
            <div class="d-flex px-2 py-1">
                <div>
                    <img src="https://drive.google.com/uc?id=1SIdZ6av9hDJcifgn01ToVmfEURT4WOjb&export=media"
                        class="chat-avatar">
                </div>
                <div class="d-flex flex-column justify-content-center mx-2">
                    <h6 class="mb-0 text-sm">Kitsune Yae</h6>
                    <p class="text-xs text-secondary mb-0">Đang hoạt động</p>
                </div>
            </div>
        </div>
        <div class="row align-items-center d-flex max-height-530 message-contain">
            @foreach($data as $item)
                @if(\Illuminate\Support\Facades\Auth::user()->id !== $item->user->id)
                    <div class="d-flex px-2 message">
                        <div class="message-avatar-contain">
                            <img src={{ $item->user->avatarInfo->url }}
                                 class="message-avatar">
                        </div>
                        <div class="p-2 px-3 bg-chat border-radius-2xl message-text-contain">
                            <div class="mb-0 text-white message-text">{{$item->message}}</div>
                        </div>
                    </div>
                @else
                    <div class="d-flex px-2 message flex-row-reverse">
                        <div class="message-avatar-contain">
                            <img src={{ $item->user->avatarInfo->url }}
                                 class="message-avatar">
                        </div>
                        <div class="p-2 px-3 bg-chat border-radius-2xl message-text-contain-reverse">
                            <div class="mb-0 text-white message-text">{{$item->message}}</div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row border-top bottom-0 align-items-end w-98" style="position: fixed">
            <div class=" py-2">
                <div class="input-group p-0 bg-transparent dropdown-hover">
                    <input type="text" class="form-control border" placeholder="Aa" aria-label="Nhập tìm kiếm..." aria-describedby="btnSearch" id="inputSendMessage" name="inputsendMessage">
                    <button type="submit" class="btn m-0 p-0 bg-transparent shadow-none ms-2" type="button" id="sendMessage"><span class="input-group-text border-0 text-body z-index-0"><i class="fas fa-paper-plane" aria-hidden="true"></i></span></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
        document.getElementById('title-first').innerText = 'Chat'
        document.getElementById('title-second').innerText = 'Chat với quản lý'
    </script>
    <script>
        let inputSendMessage = $("#inputSendMessage")

        $(document).ready(function () {
            inputSendMessage[0].addEventListener("keyup", function(event) {
                if (event.key === "Enter") {
                    sendMessage(inputSendMessage.val())
                }
            });
        })

        function sendMessage(message)
        {
            let data = {}
            data.message = message
            $.ajax({
                url: '/chat/messages',
                data: JSON.stringify(data),
                dataType: 'json',
                enctype: "multipart/form-data",
                contentType: 'application/json',
                cache: false,
                processData: false,
                success: function () {
                    loadMessage()
                    $("#inputSendMessage").val('')
                },
                error: function (error) {
                },
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }

        async function loadMessage()
        {
            await $.ajax({
                url: '/chat/messages' ,
                dataType: 'json',
                enctype: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    console.log(data)
                },
                error: function (error) {
                },
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }
    </script>
@endsection

