@extends('layouts.app')

<style>
    .div_block {
        width: 263px;
        height: 350px;
        text-align: center;
        background-color: #F2D9BB;
        border: 0.1rem solid #CCB9AA;
        margin-right: 16px;
   
    }
    .img_div {
        margin: auto;
        margin: 5px;
        width: 250px;
        height: 183px;
        background-color: #ffffff;
        border-radius: 10% / 50%;
        margin-bottom: 80px;
    }
    .btn_div {
        position: absolute;
        top: 750px;
        left: 151px;
        margin-left: -24px;
        width: 150px;
        text-align: center;
        clear: both;
        margin-top: 115px;
    }
    .text_center {
        margin: auto;
        width: 200px;
        padding: 2px;
        margin-top: 24px;
    }
    .box {
        margin: auto;
        margin-top: 50px;
        width: 1200px;
    }
    .box1 {
        margin: auto;
        margin-top: 50px;
        margin-bottom: 50px;
        width: 1100px;
        background-color: #FFFFFF;
    }
    .div_img {
        display: inline-block;
        width: 250px;
        height: 245px;
        border: 1px solid #F2D9BB;
        margin-right: 200px;
        padding-top: 10px;
        display: inline-block;
        
    }
    .div_text {
        margin-left: 265px;
        margin-top: -195px;
        margin-bottom: 5px;
        padding: 5px;
        display: inline-block;
        width: 830px;
        height: 115px;
        border: 1px solid #F2D9BB;
        margin-bottom: 10px;
    }
    .div_text3 {
        margin-left: 265px;
        margin-top: -65px;
        padding: 5px;
        display: inline-block;
        width: 830px;
        height: 115px;
        border: 1px solid #F2D9BB;
    }
    dt {
        font-size: 21px;
    }
        /*画像の縦横比を保持して、指定した高さ・横幅を超える分、リサイズして、トリミングする*/
        img {
        margin: auto;
        display: block;
        width: 100%;/*任意の横幅を指定*/
        height: 190px;/*任意の高さを指定*/
        object-fit: cover;
        border-radius: 10px;
    }

</style>

@section('content')

<div class="box">

<h3>講師の紹介</h3>

    <dt>No.{{ $instructors->id }}/{{ $instructors->profession }}:{{ $instructors->last_name }}{{ $instructors->first_name }}</dt>

  
    <div class="div_img">
        <img src="{{ Storage::url($instructors->img)}}" alt="" class="img_instructor">
    </dt>

    <div class="div_text">
        {{ $instructors->profile }}
    </div>
    <div class="div_text3">
        {{ $instructors->introduction}}
    </div>
</div>

<div class="box1">
    <div class="d-flex flex-row flex-wrap">
    @foreach ($lessons as $lesson)
            <div class="div_block">
                <div class="img_div">
                    <img src="{{ Storage::url($lesson->img)}}" alt="">
                </div>
                <td>{{ $lesson->id }}</td>
                <td>{{ $lesson->lesson_name }}</td><br>
                <a href="{{ route('show', $lesson->id ) }}" class="btn btn-outline-primary">詳細</a>
            </div>
    @endforeach

    </div>

</div>

<div class="btn_div">
    <a href="{{ route('instructors')}}" class="btn btn-primary">戻る</a>
</div>

@endsection
