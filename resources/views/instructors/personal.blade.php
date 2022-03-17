@extends('layouts.app')

<style>
    body {
        margin: auto;
        height: 811px;
    }
    .div_block {
        width: 200px;
        height: 300px;
        text-align: center;
        background-color: #F2D9BB;
        border: 0.1rem solid #CCB9AA;
        padding: 7px 5px 5px 5px;
        margin: 3px;
    }
    .img_div {
        margin: auto;
        margin-bottom: 5px;
        width: 180px;
        height: 185px;
        background-color: #ffffff;
        border-radius: 10% / 50%;
    }
    .btn_div {
        position: absolute;
        top: 410px;
        width: 400px;

        margin-left: -100px;
        text-align: center;
        clear: both;

        margin-bottom: 11px;
    }

    .btn_div_r {
        position: absolute;
        top: 80px;
        left: 1002px;
        margin-left: 20px;
        width: 350px;
        text-align: center;
    }
    .text_center {
        margin: auto;
        width: 200px;
        padding: 2px;
        margin-top: 31px;
    }
    .box {
        margin: auto;
        margin-top: 50px;
        width: 1200px;
        /* background-color: #CCB9AA; */

    }
    .div_img {
        display: inline-block;
        width: 250px;
        height: 250px;
        border: 1px solid #F2D9BB;
        margin-right: 200px;
    }
    .div_text {
        margin-left: 265px;
        margin-top: -23px;
        padding: 5px;
        display: inline-block;
        width: 1000px;
        height: 102px;
        border: 1px solid #F2D9BB;
    }
    .div_text3 {
        margin-left: 265px;
        margin-top: 6px;
        padding: 5px;
        display: inline-block;
        width: 1000px;
        height: 102px;
        border: 1px solid #F2D9BB;
    }
    dt {
        font-size: 21px;
    }
    .div_title {
        font-size: 24px;
        float: right;
        margin-right: 130px;
        /* background-color: #CCB9AA; */
    }
    .div_line {
        margin-top: 50px;
        border: solid 1px gray;
    }
    /* bootstrap のボタンをカスタマイズ */
    .btn-primary {
        background: #EEEC00;
        /* 好きな色; //ボタンの背景色 */
        color: yellowgreen;
        /* 好きな色; //ボタンのテキストの色 */
    }

    .div_inline {
        display: flex;
        /* 親要素にflexを追加。此れ一発で横並び。 */
        width: 380px;
        padding: 2px;
        margin: 5px;
    }
    .ml-2 {
        margin-left: 5px;
    }
    /*画像の縦横比を保持して、指定した高さ・横幅を超える分、リサイズして、トリミングする*/
    img {
        margin: auto;
        display: block;
        width: 161px;/*任意の横幅を指定*/
        height: 161px;/*任意の高さを指定*/
        object-fit: cover;
        border-radius: 10px;
    }

</style>

@section('content')

<div class="box">
    <div class="div_inline">
        <div>
            <a href="{{ route('create')}}" class="btn btn-primary">講座新規登録</a>
        </div>
    <div class="ml-2">
        <form action="{{ route('inst_edit') }}" method="get" class="form-inline">
            @csrf
            <input type="hidden" name="id" value="{{ Auth::user()->id }}">

            <button type="submit" class="btn btn-primary">講師登録内容編集</button>
        </form>
    </div>
</div>
    {{-- 〇〇先生、表示欄 --}}
    <div class="div_title">{{ $msg }}</div>


    <div class="div_line"></div>

<table>

   <table class="table">
    <tr>
        <th>id</th>
        <th>講座名</th>
        <th>カテゴリid</th>
        <!-- ↓画像 -->
        <th></th>
        <th>内容</th>
        <th>時間</th>
        <th>開催日</th>
        <th>受講費用</th>
        <th>定員</th>
    </tr>

    @foreach ($lessons as $lesson)
    <tr>
        <td>{{ $lesson->id }}</td>

        <td>{{ $lesson->lesson_name }}</td>

        <td></td>

        <td><img src="{{ Storage::url($lesson->img)}}" alt="" width="150px" height="auto"></td>

        <td>{{ $lesson->describe }}</td>

        <td>{{ $lesson->lesson_time }}</td>

        <td>{{ $lesson->event_date }}</td>

        <td>{{ $lesson->fee }}円</td>

        <td>{{ $lesson->capacity }}人</td>

        <td>
          <form action="{{ route('edit',$lesson) }}" method="get" class="form-inline">
            @csrf
            <input type="hidden" name="id" value="{{ $lesson->id }}">

            <button type="submit" class="btn btn-primary">編集</button>
          </form>
        </td>
        <td>
          {{-- 削除 --}}
          <form action="{{ route('del') }}" method="post">
            {{-- @method('DELETE') --}}
            @csrf
            <input type="hidden" name="id" value="{{ $lesson->id }}">
            <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？');">
            削除</button>
          </form>
        </td>
    </tr>
@endforeach
</table>

<div class="pagenater">
    <td>{{$lessons->links() }} </td>
</div>

<div class="btn_div_r">
    <a href="{{ route('personal') }}" class="btn btn-secondary">ログアウト</a>
</div>

@endsection
