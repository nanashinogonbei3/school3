@extends('layouts.app')

<style>
    .div_block {
        width: 200px;
        height: 300px;
        text-align: center;
        background-color: #F2D9BB;
        border: 0.1rem solid #CCB9AA;
        padding: 5px;
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

        margin-left: 20px;
        width: 150px;
        text-align: center;
    }

    .text_center {
        margin: auto;
        width: 200px;
        margin-top: 24px;
    }

    .box {
        margin: auto;
        margin-top: 50px;
        width: 1200px;
    }

    .div_img {
        width: 250px;
        height: 250;
        border: 1px solid #F2D9BB;
        margin-bottom: 6px;
    }
</style>

@section('content')

<div class="box">

    <h3>新規講座作成の確認ページ</h3>

    <form action="{{ route('store')}}" method="post">
        @csrf
        <table class="table">
            <tr>
                <th>講座名</th>
                <th>カテゴリーID</th>
                <th>内容</th>
                <th>受講時間</th>
                <th>開催日</th>
                <th>受講費用</th>
                <th>受講定員数</th>
                <th></th>
                <!-- ↑画像 -->
            </tr>
            <tr>


                @foreach ($input as $key => $value)
                @if ($key == '_token')

                @elseif ($key == 'img')

                <td><img src="{{ Storage::url($value)}}" alt="" width="150px" height="auto"></td>

                @else

                <td>{{ $value }}</td>

                @endif

                @endforeach


                <div class="form-group row mb-0">
                    <button class="btn btn-primary" type="submit">送信</button>
                </div>
            </tr>
        </table>
    </form>

    <a href="{{ route('create')}}" class="btn btn-primary">戻る</a>

</div>

@endsection