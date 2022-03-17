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
        height: 250px;
        border: 1px solid #F2D9BB;
        margin-bottom: 6px;
    }

    img {
        width: 250px;
        height: 100%;
        object-fit: cover;
        border-radius: 6px;
    }
</style>

@section('content')

<div class="box">
    <a href="{{ route('introduce', $lessons->instructor_id ) }}" class="btn btn-primary">インストラクターの詳細</a>

    <h3>講座詳細</h3>


    <table class="table">
        <tr>
            <th>ID</th>
            <th>講座名</th>
            <th>講師ID</th>
            <th>内容</th>
            <th>受講時間</th>
            <th>開催日</th>
            <th>受講費用</th>
            <th>受講定員数</th>
        </tr>
        <tr>
            <td>{{ $lessons->id }}</td>
            <td>{{ $lessons->lesson_name }}</td>
            <td>{{ $lessons->instructor_id}}</td>
            <td>{{ $lessons->describe }}</td>
            <td>{{ $lessons->lesson_time }}分</td>
            <td>{{ $lessons->event_date }}</td>
            <td>{{ $lessons->fee}}円</td>
            <td>{{ $lessons->capacity }}人</td>
        </tr>

    </table>
    <div class="div_img"><img src="{{ Storage::url($lessons->img)}}" alt="" width="150px" height="auto"></div>



    <a href="{{ route('index')}}" class="btn btn-primary">戻る</a>
    {{-- <a href="/lessons" class="btn btn-primary">戻る</a> --}}

</div>

@endsection