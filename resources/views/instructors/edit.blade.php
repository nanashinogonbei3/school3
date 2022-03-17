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
    }

</style>

@section('content')

<div class="box">

<div class="box3">
<h3>講師の登録内容を修正します</h3>

<form action="{{ route('update',$instructor) }}" method="post" enctype="multipart/form-data">
    @csrf
    {{-- @method('PATCH') --}}
   {{-- <input type="hidden" name="id" value="{{ $instructor->id }}"> --}}
   <input type="hidden" name="id" value="{{ Auth::user()->id }}">
   <div class="form-group">
        <label for="last_name">氏名</label>
        <input type="text" name="last_name" size="100" id="last_name" class="form-control @error('last_name') is-invalid @enderror "
            value="{{ old('last_name', $instructor->last_name) }}" >
    </div>

    <div class="form-group">
        <label for="fist_name">名前</label>
        <input type="text" name="first_name" size="100" id="first_name" class="form-control @error('first_name') is-invalid @enderror "
            value="{{ old('first_name', $instructor->first_name) }}" >
    </div>

    <div class="form-group">
        <label for="email">e-mail</label>
        <input type="text" name="email" size="100" id="last_name" class="form-control @error('email') is-invalid @enderror "
            value="{{ old('email', $instructor->email) }}" >
    </div>

    <div class="form-group">
        <label for="password">password</label>
        <input type="text" name="password" size="100" id="password" class="form-control @error('password') is-invalid @enderror "
            value="{{ old('password', $instructor->password) }}" >
    </div>

    <div class="form-group">
        <label for="email">電話番号</label>
        <input type="text" name="phone_no" size="100" id="phone_no" class="form-control @error('phone_no') is-invalid @enderror "
            value="{{ old('phone_no', $instructor->phone_no) }}" >
    </div>

    <div class="form-group">
        <label for="profession">職業</label>

         <input type="text" name="profession" id="lesson_time" class="form-control @error('profession') is-invalid @enderror "
            value="{{ old('profession', $instructor->profession) }}" >
    </div>

    <div class="form-group">
        <label for="profile">プロファイル</label>

         <input type="text" name="profile" id="profile" class="form-control @error('profile') is-invalid @enderror "
            value="{{ old('profile', $instructor->profile) }}" >
    </div>

    <div class="form-group">
        <label for="introduction">自己紹介</label>

         <input type="text" name="introduction" id="introduction" class="form-control @error('introduction') is-invalid @enderror "
            value="{{ old('introduction', $instructor->introduction) }}" >
    </div>

    <div class="form-group">

        <label for="img">イメージ画像</label>
        <input type="file" name="img" id="img"
        class="form-control @error('expiration_date') is-invalid @enderror "
        value="{{ old('img', $instructor->img) }}">
        <img src="{{ Storage::url($instructor->img)}}" alt="" width="150px" height="auto">
    </div>

    <div>
        <button class="btn btn-primary" type="submit">送信</button>
        <a href="{{ route('mylesson') }}" class="btn btn-secondary">戻る</a>
    </div>

</div>
</form>

</div>

@endsection
