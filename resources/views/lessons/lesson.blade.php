@extends('layouts.new-master')

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

    @endsection
    <!-- logout -->
    @section('logout')
    <a href="{{ route('personal')}}" class="btn btn-primary">講師マイページ</a>
    <a href="{{ route('personal') }}" class="btn btn-secondary">ログアウト</a>
</div>
@endsection

<!-- ページネーション -->
@section('pagination')
<td>{{$lessons->links() }} </td>
@endsection

<!-- レッスン一覧表示 -->
@section('lesson')

@foreach ($lessons as $lesson)
<div class="card mb-4">
    <a href="{{ route('show', $lesson->id ) }}"><img class="card-img-top" width="200px" src="{{ Storage::url($lesson->img)}}" alt="..." /></a>
    <div class="card-body">
        <div class="small text-muted">{{ $lesson->id }}</div>
        <h2 class="card-title h4">{{ $lesson->lesson_name }}</h2>
        <p class="card-text">{{ $lesson->describe}}</p>
        <a class="btn btn-primary" href="{{ route('show', $lesson->id ) }}">詳細 →</a>
    </div>
</div>
@endforeach
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













































































































































































































































































<!-- テスト -->
@section('contents')
テスト
@endsection