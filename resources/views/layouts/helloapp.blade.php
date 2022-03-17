<html>

<head>
    <!-- 3-26 87頁 -->
    <title>@yield('title')</title>
    <style>
        body {
            font-size: 16pt;
            color: #999;
            margin: 5px;
        }

        h1 {
            font-size: 50pt;
            text-align: right;
            color: #f6f6f6;
            margin: -20px 0px -30px 0px 0px;
            letter-spacing: -40pt;
        }

        ul {
            font-size: 12pt;
        }

        hr {
            margin: 25pt 100px;
            border-top: 1px dashed #ddd;
        }

        .menutitle {
            font-size: 14pt;
            font-weight: bold;
            margin: 0px;
        }

        .content {
            margin: 10px;
        }

        .footer {
            text-align: right;
            font-size: 10pt;
            margin: 10px;
            border-bottom: solid 1px #ccc;
            color: #ccc;
        }
    </style>
</head>

<body>
    <h1>@yield('title')</h1>
    @section('menubar')
    <h2 class="menutitle">※メニュー</h2>
    <ul>
        <li>@show</li>
    </ul>
    <hr size="1">
    <div class="content">
        @yield('content')
    </div>

    <div>
        @yield('pagination')
    </div>
    <div class="footer">
        @yield('footer')
    </div>


</body>

</html>