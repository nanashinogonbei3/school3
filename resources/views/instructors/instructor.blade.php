@extends('layouts.app')
<style>
    .div_block {
        margin: auto;
        width: 212px;
        height: 286px;
        text-align: center;
        background-color: #F2D9BB;
        border: 0.1rem solid #CCB9AA;
        padding: 13px 5px 5px 5px;
        margin-left: 5px;
        margin-right: 3px;
        margin-bottom: 6px;
    }

    .img_div {
        display: flex;
        margin: auto;
        margin-bottom: 5px;
        height: 185px;
    }

    /*画像の縦横比を保持して、指定した高さ・横幅を超える分、リサイズして、トリミングする*/
    img {
        margin: auto;
        display: block;
        /*任意の横幅を指定*/
        width: 100%;
        /*任意の高さを指定*/
        height: 190px;
        object-fit: cover;
        border-radius: 10px;
    }

    .btn_div {
        position: absolute;
        top: 80px;
        left: 1px;
        margin-left: 20px;
        width: 350px;
        text-align: center;
    }

    .btn_div_r {
        position: absolute;
        top: 80px;
        left: 920px;
        margin-left: 20px;
        width: 350px;
        text-align: center;
    }

    .pagenator {
        margin: auto;
        width: 200px;
        margin-top: 24px;
        clear: both;
    }

    .box1 {
        margin: auto;
        margin-top: 50px;
        margin-bottom: 50px;
        width: 1100px;
        background-color: #FFFFFF;
    }

    .div_title {
        width: 1000px;
        height: 50px;
        background-color: #F2D9BB;
        border: 1px solid gainsboro;
    }
</style>

@section('content')

<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px">
            <h1 style="color:#555555; text-align:center; font-size:1.2em;
padding:24px 0px; font-weight:bold;">


                <h3>講師一覧</h3>

                <div class="btn_div">
                    <a href="{{ route('index') }}" class="btn btn-primary">講座一覧</a>
                    <a href="{{ route('index') }}" class="btn btn-primary">トップに戻る</a>
                </div>

                <div class="box1">
                    <div class="d-flex flex-row flex-wrap">

                        @foreach ($instructors as $instructor)

                        <div class="div_block">
                            <div class="img_div">
                                <img src="{{ Storage::url($instructor->img)}}" alt="" class="img_instructor">
                            </div>
                            <td>ID.{{ $instructor->id }}</td><br>
                            <td>{{ $instructor->last_name }}</td>
                            <td>{{ $instructor->first_name }}</td>
                            <td>
                                <a href="{{ route('introduce', $instructor->id ) }}" class="btn btn-primary">詳細</a>
                            </td>
                        </div>
                        @endforeach
                    </div>
                </div>
        </div>
    </div>

    <div class="pagenator">
        <td>{{$instructors->links() }} </td>
    </div>

    <div class="btn_div_r">

        <a href="{{ route('personal')}}" class="btn btn-primary">ログイン</a>

        <a href="{{ route('personal') }}" class="btn btn-secondary">ログアウト</a>

        <a href="{{ route('register')}}" class="btn btn-primary">登録</a>

    </div>

    @endsection