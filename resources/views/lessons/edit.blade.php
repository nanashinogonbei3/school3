<?php
set_time_limit(120);
?>

@extends('layouts.app')

<style>
    body {
        margin: auto;
        height: 1200px;
        width: 1200px;
        margin: 20px;
        margin-left: 100px;
        background-color: #CCB9AA;
    }

    .box3 {
        border: 1px dashed #B0BAC3;
        padding: 11px;
        margin-left: 100px;
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
        margin-left: -33px;
        width: 150px;
        text-align: center;
        clear: both;
        margin-top: 182px;
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
        float: right;
        margin-right: 130px;
    }

    .div_line {
        margin-top: 50px;
        border: solid 1px gray;
    }

    /* bootstrap のボタンをカスタマイズ */
    .btn-primary {
        background: #EEEC00;
        /* 好きな色; //ボタンの背景色 */
        color: yellowgreen
            /* 好きな色; //ボタンのテキストの色 */
    }
</style>

@section('content')

<div class="box">

    <div class="box3">
        <h3>講座を修正</h3>

        <form action="{{ route('update_get',$lesson) }}" method="post" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $lesson->id }}">
            <div class="form-group">
                <label for="lesson_name">講座名</label>
                <input type="text" name="lesson_name" size="100" id="lesson_name" class="form-control @error('lesson_name') is-invalid @enderror " value="{{ old('lesson_name', $lesson->lesson_name) }}">
            </div>

            <!-- カテゴリー一覧表示 -->
            <div class="form-group row">
                <label for="lesson_name" class="col-md-4 col-form-label text-md-right">カテゴリー</label>
                <select class="col-md-6" id="category_id" name="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}" value="{{ old('category_id') }}">
                    @foreach($category_list as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- カテゴリーおわり -->

            <div class="form-group">

                <label for="img">イメージ画像</label>
                <input type="file" name="img" accept="image/png, image/jpeg" class="form-control" value="{{ old('img') }}">
                <img src="{{ Storage::url($lesson->img)}}" alt="" width="150px" height="auto">
            </div>


            <div class="form-group">
                <label for="describe">説明</label>

                <input type="text" name="describe" id="describe" class="form-control @error('describe') is-invalid @enderror " value="{{ old('describe', $lesson->describe) }}">
            </div>

            <div class="form-group">
                <label for="lesson_time">受講時間</label>

                <input type="text" name="lesson_time" id="lesson_time" class="form-control @error('lesson_time') is-invalid @enderror " value="{{ old('lesson_time', $lesson->lesson_time) }}">
            </div>

            <div class="form-group">
                <label for="event_date">開催日</label>

                <input type="date" name="event_date" id="event_date" class="form-control @error('event_date') is-invalid @enderror " value="{{ old('event_date', $lesson->event_date) }}">
            </div>

            <div class="form-group">
                <label for="fee">受講費</label>

                <input type="text" name="fee" id="fee" class="form-control @error('fee') is-invalid @enderror " value="{{ old('fee', $lesson->fee) }}">
            </div>

            <div class="form-group">
                <label for="capacity">定員</label>

                <input type="text" name="capacity" id="fee" class="form-control @error('capacity') is-invalid @enderror " value="{{ old('capacity', $lesson->capacity) }}">
            </div>
            <div>
                <button class="btn btn-primary" type="submit">送信</button>
                <a href="{{ route('mylesson') }}" class="btn btn-secondary">戻る</a>
            </div>

    </div>
    </form>

</div>

@endsection