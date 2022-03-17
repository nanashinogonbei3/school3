<html>

<head>
    <title>Lesson Find</title>

</head>

<body>
    <!-- リンクバー -->
    @section('listlesson')
    <a class="nav-link" href="{{ url('/lessons/listlesson') }}">講座一覧</a>
    @endsection
    <!-- 講師 -->
    @section('instructor')
    <a class="nav-link" href="{{ url('/instructors/instructors') }}">講師一覧</a>
    @endsection
    <!-- アクセス -->
    @section('access')
    <a class="nav-link" href="{{ url('/lessons/img') }}">アクセス</a>
    @endsection


    @extends('layouts.pickup_list')

    <!-- instructors -->
    @section('instructors')
    <div>
        <a href="{{ url('/instructors/instructors') }}" class="btn btn-primary">講師一覧</a>
        @endsection
        <!-- to top -->
        @section('toTop')
        <a href="{{ route('index') }}" class="btn btn-primary">トップに戻る</a>
        @endsection
        <!-- logout -->
        @section('logout')
        <a href="{{ route('personal') }}" class="btn btn-secondary">ログアウト</a>
    </div>
    @endsection


    @section('serchlesson')
    <form action="{{ route('find') }}" method="post">
        @csrf
        <input type="text" name="input" value="{{$input}}">
        <input type="submit" value="find">
    </form>
    @endsection


    @section('lesson')

    <!-- 帰ってきた検索結果がもしもあれば、検索結果を表示する。 -->
    @if (isset($item))
    <table>
        <tr>
            <th></th>
            <th>レッスン名</th>
            <th>講習時間</th>
            <th>開催日</th>
            <th>講習費</th>
            <th>定員</th>
        </tr>
        <!-- lesson コントロールの serch メソッドの検索結果を表示 -->
        @foreach ($item as $v)
        <tr>
            <td><a href="{{ route('show', $v->id ) }}"><img src="{{ Storage::url($v->img)}}" alt=""></a></td>
            <td>{{$v->lesson_name}}</td>
            <td>{{$v->lesson_time}}分</td> &nbsp;&nbsp;
            <td>{{$v->event_date}}</td> &nbsp;&nbsp;&nbsp;
            <td>{{$v->fee}}円</td> &nbsp;&nbsp;
            <td>{{$v->capacity}}人</td>
        </tr>
        @endforeach
    </table>

    <td>{{ $item->links() }} </td>

    @endif


    @endsection


</body>

</html>