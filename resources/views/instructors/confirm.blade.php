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
<title>{{ config('app.name') }}</title>

@section('content')

<div class="box">

<h3>講師新規登録の確認ページ</h3>

<form action="{{ route('inst_store')}}" method="post">
@csrf
<table class="table">
    <tr>
        <th>氏名</th>
        <th>名前</th>
        <th>職業</th>
        <th>メールアドレス</th>
        <th>電話番号</th>
        <th>パスワード</th>
        <th>プロフィール</th>
        <th>自己紹介</th>
        <th>{{-- 画像 --}}</th>

    </tr>
    <tr>
        <td>{{ $inputs['last_name'] }}</td>

        <td>{{ $inputs['first_name'] }}</td>

        <td>{{ $inputs['profession'] }}</td>

        <td>{{ $inputs['email'] }}</td>

        <td>{{ $inputs['phone_no'] }}</td>

        <td>・・・・・・</td>

        <td>{{ $inputs['profile'] }}</td>

        <td>{{ $inputs['introduction'] }}</td>


        <td><img src="{{ Storage::url($inputs['img'])}}" alt="" width="150px" height="auto"></td>


    <div class="form-group row mb-0">
        <button class="btn btn-primary" type="submit">送信</button>
    </div>
    </tr>
</table>
</form>

<a href="{{ route('inst_create')}}" class="btn btn-primary">戻る</a>

</div>

@endsection
