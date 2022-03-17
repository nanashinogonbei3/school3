@extends('layouts.app')

<title>{{ config('app.name') }}</title>
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">

                    <form action="{{ route('inst_confirm') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">氏名</label>
                            <input type="text" name="last_name" id="title" class="form-control
        @error('last_name') is-invalid @enderror " value="{{ old('last_name') }}" aria-describedby="validateExpirationDate">
                            @error('last_name')
                            <div id="validateTitle" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="first_name">名前</label>
                            <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror " value="{{ old('first_name') }}" aria-describedby="validateExpirationDate">
                            @error('first_name')
                            <div id="validateExpirationDate" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- 職業 --}}
                        <div class="form-group">
                            <label for="profession">職業</label>
                            <input type="text" name="profession" id="profession" class="form-control @error('profession') is-invalid @enderror " value="{{ old('profession') }}" aria-describedby="validateExpirationDate">
                            @error('profession')
                            <div id="validateExpirationDate" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- メールアドレス --}}
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="text" name="email" id="first_name" class="form-control @error('email') is-invalid @enderror " value="{{ old('email') }}" aria-describedby="validateExpirationDate">
                            @error('email')
                            <div id="validateExpirationDate" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        {{-- 電話番号 --}}
                        <div class="form-group">
                            <label for="phone_no">電話番号</label>
                            <input type="text" name="phone_no" id="phone_no" class="form-control @error('phone_no') is-invalid @enderror " value="{{ old('phone_no') }}" aria-describedby="validateExpirationDate">
                            @error('phone_no')
                            <div id="validateExpirationDate" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- パスワード --}}
                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="text" name="password" id="first_name" class="form-control @error('password') is-invalid @enderror " value="{{ old('password') }}" aria-describedby="validateExpirationDate">
                            @error('password')
                            <div id="validateExpirationDate" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="completion_date">プロフィール</label>
                            <textarea name="profile" id="profile" rows="5" class="form-control @error('profile') is-invalid @enderror" aria-describedby="validateCompletionDate">{{ old('profile') }}</textarea>
                            @error('profile')
                            <div id="validateCompletionDate" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="introduction">自己紹介</label>
                            <textarea name="introduction" id="introduction" rows="5" class="form-control @error('introduction') is-invalid @enderror " aria-describedby="validateDescription">{{ old('introduction') }}</textarea>
                            @error('introduction')
                            <div id="validateDescription" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="completion_date">イメージ画像</label>
                            <input type="file" name="img" id="completion_date" class="form-control @error('img') is-invalid @enderror " value="{{ old('img') }}" aria-describedby="validateCompletionDate">
                            @error('img')
                            <div id="validateCompletionDate" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>



                        <button class="btn btn-primary" type="submit">送信</button>
                        <a href="{{ route('mylesson') }}" class="btn btn-secondary">戻る</a>
                    </form>


                    @endsection