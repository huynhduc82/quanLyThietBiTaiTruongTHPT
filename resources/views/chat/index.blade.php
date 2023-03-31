@extends('layout.layout')

@section('title')
    Chat
@endsection

@section('content')
    <div class="container-fluid m-4 max-width-1150 bg-white blur shadow-blur border-radius-xl chat-container">
        <div class="row">
            <div class="col-3 border-end">
                <div class="row max-height-635">
                    @foreach($user as $item)
                        <div class="d-flex px-2 py-1 user" onclick="selectUser()">
                            <div>
                                <img src={{ $item->avatarInfo->url ?? asset('assets/img/default-avatar.jpg') }}
                                     class="chat-avatar">
                                <div class="online-circle" id="online-circle-{{ $item->id }}"></div>
                            </div>
                            <div class="d-flex flex-column justify-content-center mx-2">
                                <h6 class="mb-0 text-sm">{{  $item ? $item->name : '......'   }}</h6>
                                <p class="text-xs text-secondary mb-0">Đang hoạt động</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-9 justify-content-center align-items-center">
{{--                <h4 class="d-flex">Hãy chọn một đoạn chat hoặc bắt đầu cuộc trò chuyện mới</h4>--}}
                <div class="row border-bottom p-1 px-2">
                    <div class="d-flex px-2 py-1">
                        <div>
                            <img src="https://drive.google.com/uc?id=1SIdZ6av9hDJcifgn01ToVmfEURT4WOjb&export=media"
                                class="chat-avatar">
                            <div class="online-circle"></div>
                        </div>
                        <div class="d-flex flex-column justify-content-center mx-2">
                            <h6 class="mb-0 text-sm">Kitsune Yae</h6>
                            <p class="text-xs text-secondary mb-0">Đang hoạt động</p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center d-flex max-height-530 message-contain" id="message-contain">
                    @foreach($data as $item)
                        @if(\Illuminate\Support\Facades\Auth::user()->id !== $item->user->id)
                            <div class="d-flex px-2 message">
                                <div class="message-avatar-contain">
                                    <img src={{ $item->user->avatarInfo->url ?? asset('assets/img/default-avatar.jpg') }}
                                         class="message-avatar">
                                    <div class="online-circle" id="online-circle-{{ $item->user->id }}"></div>
                                </div>
                                <div class="p-2 px-3 bg-chat border-radius-2xl message-text-contain">
                                    <div class="mb-0 text-white message-text">{{$item->message}}</div>
                                </div>
                            </div>
                        @else
                            <div class="d-flex px-2 message flex-row-reverse">
                                <div class="message-avatar-contain">
                                    <img src={{ $item->user->avatarInfo->url ?? asset('assets/img/default-avatar.jpg') }}
                                         class="message-avatar">
                                    <div class="online-circle" id="online-circle-{{ $item->user->id }}"></div>
                                </div>
                                <div class="p-2 px-3 bg-chat border-radius-2xl message-text-contain-reverse">
                                    <div class="mb-0 text-white message-text">{{$item->message}}</div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row border-top bottom-0 align-items-end" id="messageContain">
                    <div class=" py-2">
                        <div class="input-group p-0 bg-transparent dropdown-hover">
                            <input type="text" class="form-control border" placeholder="Aa" aria-label="Nhập tìm kiếm..." aria-describedby="btnSearch" id="inputSendMessage" name="inputsendMessage">
                            <button type="submit" class="btn m-0 p-0 bg-transparent shadow-none ms-2" type="button" id="sendMessage" onclick="sendMessage()"><span class="border-0 text-body z-index-0"><i class="fas fa-paper-plane send-icon p-2" aria-hidden="true"></i></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js" integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    sendMessage()
                }
            });
            scrollToBottom()

            Echo.private('room.{{ \Illuminate\Support\Facades\Auth::user()->id }}').listen('MessageSend', (data) => {
                appendMessage(data['message'], false, {{ \Illuminate\Support\Facades\Auth::user()->id }})
                scrollToBottom()
            })
        })

        function sendMessage()
        {
            let message = inputSendMessage.val()
            if (!message)
            {

            }
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
                success: function (data) {
                    appendMessage(data['data'], true, {{ \Illuminate\Support\Facades\Auth::user()->id }})
                    $("#inputSendMessage").val('')
                    scrollToBottom()
                },
                error: function (error) {
                },
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }

        function appendMessage(data, self, id)
        {
            let message = document.createElement("div")
            if (self) {
                message.className = "d-flex px-2 message flex-row-reverse"
            } else {
                message.className = "d-flex px-2 message"
            }
            let avatar = document.createElement("div")
            avatar.className = "message-avatar-contain"
            let img = document.createElement("img")
            img.className = "message-avatar"
            let onlineCircle = document.createElement("div")
            onlineCircle.className = "online-circle"
            onlineCircle.id = "online-circle-" + id
            if (data.user.avatarInfo) {
                img.src = data.user.avatarInfo.url
            } else if (data.user.avatar_info) {
                img.src = data.user.avatar_info.url
            } else {
                img.src = "{!! asset('assets/img/default-avatar.jpg') !!}"
            }
            let text = document.createElement("div")
            text.className = "mb-0 text-white message-text"
            text.innerText = data.message
            let textContain = document.createElement("div")
            if (self) {
                textContain.className = "p-2 px-3 bg-chat border-radius-2xl message-text-contain-reverse"
            } else {
                textContain.className = "p-2 px-3 bg-chat border-radius-2xl message-text-contain"
            }


            avatar.appendChild(img)
            avatar.appendChild(onlineCircle)
            textContain.appendChild(text)
            message.appendChild(avatar)
            message.appendChild(textContain)
            document.getElementById("message-contain").appendChild(message)
        }

        function scrollToBottom()
        {
            let objDiv = document.getElementById("message-contain");
            objDiv.scrollTop = objDiv.scrollHeight;
        }

        function selectUser(id) {
            console.log(id)
        }
    </script>
@endsection

