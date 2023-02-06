<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html { box-sizing: border-box; }

        *,
        *::before,
        *::after { box-sizing: inherit; }

        body * {
            margin: 0;
            padding: 0;
        }

        body {
            font: normal 100%/1.15 "Merriweather", serif;
            background: #fff url("{{ asset('assets/img/403-br.jpg') }}") repeat 0 0;
            color: #fff;
        }

        /* https://www.vecteezy.com/vector-art/87721-wood-fence-vectors */
        .wrapper {
            position: relative;
            max-width: 1298px;
            height: auto;
            margin: 2em auto 0 auto;
            background: transparent url("{{ asset('assets/img/403-2.png') }}") no-repeat center top 24em;
        }

        /* https://www.vecteezy.com/vector-art/237238-dog-family-colored-doodle-drawing */
        .box {
            max-width: 70%;
            min-height: 600px;
            margin: 0 auto;
            padding: 1em 1em;
            text-align: center;
            background: transparent url("{{ asset('assets/img/403-1.png') }}") no-repeat top 10em center;
        }

        h1 {
            margin: 0 0 1rem 0;
            font-size: 8em;
            text-shadow: 0 0 6px #8b4d1a;
        }

        p {
            margin-bottom: 0.5em;
            font-size: 1.75em;
            color: #ea8a1a;
        }

        p:first-of-type {
            margin-top: 16em;
            text-shadow: none;
        }

        p > a {
            border-bottom: 1px dashed #837256;
            font-style: italic;
            text-decoration: none;
            color: #837256;
        }

        p > a:hover { text-shadow: 0 0 3px #8b4d1a; }

        p img { vertical-align: bottom; }

        @media screen and (max-width: 600px) {
            .wrapper {
                background-size: 300px 114px;
                background-position: center top 22em;
            }

            .box {
                max-width: 100%;
                margin: 0 auto;
                padding: 0;
                background-size: 320px 185px;
            }

            p:first-of-type { margin-top: 12em; }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="box">
        <h1>403</h1>
        <p>Xin lỗi bạn không đủ quyền truy cập vào trang này hoặc bạn chưa đăng nhập</p>
        <p><a href="{{ route('dashboard.index') }}">Về trang chủ</a></p>
        <p>Hoặc</p>
        <p><a href="{{ route('login') }}">Đăng nhập</a> Hoặc <a href="{{ route('register') }}">Đăng ký</a></p>
    </div>
</div>
</body>
</html>

