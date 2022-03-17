@extends('layouts.pickup_list')
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>アクセス</title>
</head>

<body>
    <ul>
        @section('lesson')
            <!-- アクセス地図表示 -->
            <h5>梅田センタービル3F マナベル梅田スクールは阪急大阪梅田駅から徒歩5分です。</h5>
            @foreach($images as $image)
            <!-- 最後のひとつの画像だけを表示する -->
                @if ($loop->last)
                <img class="img_map" src="{{ Storage::url($image->image)}}" alt="">
                @endif
            @endforeach
        @endsection
    </ul>

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




    @section('toTop')
    <div><a href="{{ route('index') }}" class="btn btn-primary">トップに戻る</a></div>
    @endsection
</body>

</html>