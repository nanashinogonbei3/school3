@extends('layouts.pickup_list')
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
<!-- このページの説明 -->
<!-- web.php のRoute::post('/lessons/findcategory2',lessonコントローラーの
function categoryserch から帰ってきた検索結果がもしもあれば、検索結果を表示する。 -->
<!-- 帰ってきた検索結果がもしもあれば、検索結果を表示する。 -->

@section('lesson')
@if (isset($lessons))


@foreach ($lessons as $v)

<tr>

    <div class="card mb-4">

        <a href="{{ route('show', $v->id ) }}"><img class="card-img-top" src="{{ Storage::url($v->img)}}" alt="..." /></a>
        <div class="card-body">
            <div class="small text-muted">{{ $v->id }}</div>
            <h2 class="card-title h4">{{ $v->lesson_name }}</h2>
            <p class="card-text">{{ $v->describe}}</p>
            <a class="btn btn-primary" href="{{ route('show', $v->id ) }}">詳細 →</a>
        </div>

    </div>
    @endforeach
    @endif

    @endsection


    <!-- レッスンの曖昧検索 -->
    @section('serchlesson')
    <form action="{{ route('find') }}" method="get">
        @csrf
        <input type="text" name="input" value="{{$input}}">
        <input type="submit" value="find">
    </form>
    @endsection

    <!-- 講座カテゴリー一覧 -->
    @section('categories')
    @foreach($category_list as $key => $v)
    <li><a href="/lessons/findcategory2/{{ $key }}">{{ $v }}</a></li>
    @endforeach
    @endsection



    @section('pagination')
    <td>{{$lessons->links() }} </td>
    @endsection

    </body>

    </html>